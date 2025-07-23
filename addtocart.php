<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['email'])) {
    // If user is not logged in, redirect to login
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];

// Get the product ID from URL
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']);
    $val = isset($_GET['val']) ? intval($_GET['val']) : 0;

    // Check if product already in cart for this user
    $checkSql = "SELECT * FROM cart_table WHERE user_email = ? AND product_id = ?";
    $stmt = $conn->prepare($checkSql);
    $stmt->bind_param("si", $email, $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // If already in cart, increase quantity
        $updateSql = "UPDATE cart_table SET quantity = quantity + 1 WHERE user_email = ? AND product_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("si", $email, $product_id);
        $updateStmt->execute();
    } else {
        // Insert new entry
        $insertSql = "INSERT INTO cart_table (user_email, product_id, quantity) VALUES (?, ?, 1)";
        $insertStmt = $conn->prepare($insertSql);
        $insertStmt->bind_param("si", $email, $product_id);
        $insertStmt->execute();
    }

    // Redirect back to  page
   if ($val === 1) {
    $_SESSION['cart_success'] = "Product added to cart successfully!";
    header("Location: product_details.php?product_id=$product_id");
    exit;
} else {
    //header("Location: home.php");
    exit;
}
}
?>
