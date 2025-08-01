<?php
session_start();
require_once "db.php";

// Delete success message
if (isset($_GET['deleted']) && $_GET['deleted'] === "1") {
    echo "<script>alert('Customer deleted successfully');</script>";
}

// Fetch customers
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>MoBazaar - Customer List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            color: #d32f2f;
            margin-bottom: 30px;
        }
        .table {
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        th {
            background-color: #d32f2f;
            color: white;
        }
        td {
            vertical-align: middle;
        }
        .btn-delete {
            background-color: #d32f2f;
            color: white;
            border: none;
            padding: 5px 10px;
        }
        .btn-delete:hover {
            background-color: #b71c1c;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Customer Details - MoBazaar</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Alt Mobile</th>
                    <th>Gender</th>
                    <th>State</th>
                    <th>Address</th>
                    <th>Pincode</th>
                    <th>Age</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['mobile']) ?></td>
                            <td><?= htmlspecialchars($row['alt_mobile']) ?></td>
                            <td><?= htmlspecialchars($row['gender']) ?></td>
                            <td><?= htmlspecialchars($row['state']) ?></td>
                            <td><?= htmlspecialchars($row['address']) ?></td>
                            <td><?= htmlspecialchars($row['pincode']) ?></td>
                            <td><?= htmlspecialchars($row['age']) ?></td>
                            <td>
                                <form method="POST" action="delete_customer.php" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                    <input type="hidden" name="email" value="<?= htmlspecialchars($row['email']) ?>">
                                    <button type="submit" class="btn btn-delete btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="10" class="text-center">No customers found</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
