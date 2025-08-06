<?php
require_once "db.php";

// Fetch sales data from order table
$sql = "SELECT product_name, product_quantity, order_date FROM `order` ORDER BY order_date ASC";
$result = $conn->query($sql);

$salesData = [];
$chartData = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $salesData[] = $row;

        // Grouping quantity by date for the chart
        $date = $row['order_date'];
        $chartData[$date] = ($chartData[$date] ?? 0) + $row['product_quantity'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sales Status - MoBazaar</title>
     <link rel="icon" type="image/png" href="favlogo.jpeg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            margin-top: 40px;
        }
        h2 {
            color: #d32f2f;
            margin-bottom: 30px;
        }
        th {
            background-color: #d32f2f;
            color: white;
        }
        canvas {
            background: #fff;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 30px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sales Status - MoBazaar</h2>

        <!-- Chart -->
        <canvas id="salesChart" width="400" height="150"></canvas>

        <!-- Sales Table -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity Sold</th>
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($salesData)): ?>
                    <?php foreach ($salesData as $sale): ?>
                        <tr>
                            <td><?= htmlspecialchars($sale['product_name']) ?></td>
                            <td><?= $sale['product_quantity'] ?></td>
                            <td><?= $sale['order_date'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3" class="text-center">No sales yet.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Chart Script -->
    <script>
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_keys($chartData)) ?>,
                datasets: [{
                    label: 'Total Quantity Sold per Date',
                    data: <?= json_encode(array_values($chartData)) ?>,
                    backgroundColor: 'rgba(211, 47, 47, 0.7)',
                    borderColor: '#b71c1c',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Quantity Sold'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>
