<?php
session_start();
include("db.php");

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Fetch orders with product image and customer address
$sql = "SELECT o.order_id, o.product_name, o.product_quantity, o.total_amount, o.product_id, 
               o.order_date, p.product_image, c.address
        FROM `order` o
        JOIN `product` p ON o.product_id = p.product_id
        JOIN `customer` c ON o.customer_email = c.email
        WHERE o.customer_email = ?
        ORDER BY o.order_date DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Orders - MoBazaar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            padding: 20px;
        }
        h2 {
            color: #b30000;
            margin-bottom: 30px;
        }
        .order {
            border: 1px solid #ccc;
            border-left: 6px solid #b30000;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .order img {
            width: 100px;
            height: auto;
            margin-right: 20px;
            border: 1px solid #ddd;
        }
        .details {
            flex-grow: 1;
        }
        .details p {
            margin: 5px 0;
        }
        .status {
            color: green;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h2>My Orders</h2>

<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="order">
            <img src="product_images/<?php echo htmlspecialchars($row['product_image']); ?>" alt="Product Image"
                 onerror="this.onerror=null;this.src='default.jpg';">
            <div class="details">
                <p><strong>Order ID:</strong> <?php echo htmlspecialchars($row['order_id']); ?></p>
                <p><strong>Product:</strong> <?php echo htmlspecialchars($row['product_name']); ?></p>
                <p><strong>Quantity:</strong> <?php echo htmlspecialchars($row['product_quantity']); ?></p>
                <p><strong>Total Paid:</strong> ₹<?php echo htmlspecialchars($row['total_amount']); ?></p>
                <p><strong>Ordered On:</strong> <?php echo htmlspecialchars($row['order_date']); ?></p>
                <p><strong>Delivery Address:</strong> <?php echo htmlspecialchars($row['address']); ?></p>
                <p><strong>Status:</strong> <span class="status">Ordered</span></p>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>

</body>
</html>
