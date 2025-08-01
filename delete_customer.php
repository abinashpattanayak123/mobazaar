<?php
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];

    $stmt = $conn->prepare("DELETE FROM customer WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        header("Location: show_customers.php?deleted=1");
        exit();
    } else {
        echo "Error deleting customer.";
    }
}
?>
