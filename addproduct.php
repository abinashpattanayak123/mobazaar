<?php
session_start();
require_once "db.php";

if (!isset($_SESSION['is_admin'])) {
  header("Location: admin_login.php");
  exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $product_id = $_POST['product_id'];
  $name = $_POST['name'];
  $category = $_POST['category'];
  $gender = $_POST['gender'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $stock = $_POST['stock'];
  $color = $_POST['color'];

  // Upload images
  $image1 = $_FILES['image']['name'];
  $image2 = $_FILES['image2']['name'];
  $image3 = $_FILES['image3']['name'];
  $image4 = $_FILES['image4']['name'];

  $tmp1 = $_FILES['image']['tmp_name'];
  $tmp2 = $_FILES['image2']['tmp_name'];
  $tmp3 = $_FILES['image3']['tmp_name'];
  $tmp4 = $_FILES['image4']['tmp_name'];

  $path1 = "uploads/" . basename($image1);
  $path2 = "uploads/" . basename($image2);
  $path3 = "uploads/" . basename($image3);
  $path4 = "uploads/" . basename($image4);

  if (
    move_uploaded_file($tmp1, $path1) &&
    move_uploaded_file($tmp2, $path2) &&
    move_uploaded_file($tmp3, $path3) &&
    move_uploaded_file($tmp4, $path4)
  ) {
    $sql = "INSERT INTO product (product_id, name, category, gender, description, price, stock, color, product_image, product_image2, product_image3, product_image4) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssisssss", $product_id, $name, $category, $gender, $description, $price, $stock, $color, $image1, $image2, $image3, $image4);

    if ($stmt->execute()) {
      echo "<script>alert('Product added successfully');</script>";
    } else {
      echo "<script>alert('Failed to add product');</script>";
    }
  } else {
    echo "<script>alert('One or more image uploads failed');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Product - MoBazaar Admin</title>
  <link rel="stylesheet" href="admin_dashboard.css">
  <style>
    .form-container {
      max-width: 700px;
      margin: 40px auto;
      background-color: #1a1a1a;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(255, 69, 0, 0.3);
    }
    .form-container h2 {
      color: #ff4d4d;
      text-align: center;
      margin-bottom: 20px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #fff;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: none;
      outline: none;
    }
    input[type="file"] {
      background-color: #fff;
      color: #000;
    }
    .submit-btn {
      background-color: #ff3333;
      color: #fff;
      padding: 12px 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .submit-btn:hover {
      background-color: #cc0000;
    }
  </style>
</head>
<body>
  <header class="admin-header">
    <h1>MoBazaar Admin Panel</h1>
    <form action="admin_logout.php" method="post">
      <button class="logout-btn" type="submit">Logout</button>
    </form>
  </header>

  <div class="form-container">
    <h2>Add Product</h2>
    <form action="addproduct.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <label for="product_id">Product ID</label>
        <input type="text" id="product_id" name="product_id" required>
      </div>

      <div class="form-group">
        <label for="name">Product Name</label>
        <input type="text" id="name" name="name" required>
      </div>

      <div class="form-group">
        <label for="category">Category</label>
        <select id="category" name="category" required>
          <option value="">--Select--</option>
          <option value="Shirt">Shirt</option>
          <option value="T-Shirt">T-Shirt</option>
          <option value="Polo-Neck">Polo-Neck</option>
           <option value="Formal-Pant">Formal-Pant</option>
          <option value="Casual-Pant">Casual-Pant</option>
          <option value="Jeans">Jeans</option>
           <option value="Shorts">Shorts</option>
          <option value="Formal-Shoe">Formal-Shoe</option>
          <option value="Casual-Shoe">Casual-Shoe</option>
          <option value="Accessories">Accessories</option>
          <option value="Sports-Shoe">Sports-Shoe</option>
          <option value="Sports-Tshirt">Sports-Tshirt</option>
          <option value="Sports-Pant">Sports-Pant</option>
        </select>
      </div>

      <div class="form-group">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" required>
          <option value="">--Select--</option>
          <option value="Men">Men</option>
          <option value="Women">Women</option>
          <option value="Unisex">Unisex</option>
        </select>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" rows="4" required></textarea>
      </div>

      <div class="form-group">
        <label for="price">Price (₹)</label>
        <input type="number" id="price" name="price" required>
      </div>

      <div class="form-group">
        <label for="stock">Stock</label>
        <input type="number" id="stock" name="stock" required>
      </div>

      <div class="form-group">
        <label for="color">Color</label>
        <input type="text" id="color" name="color" required>
      </div>

      <div class="form-group">
        <label for="image">Product Image 1</label>
        <input type="file" id="image" name="image" accept="image/*" required>
      </div>

      <div class="form-group">
        <label for="image2">Product Image 2</label>
        <input type="file" id="image2" name="image2" accept="image/*" required>
      </div>

      <div class="form-group">
        <label for="image3">Product Image 3</label>
        <input type="file" id="image3" name="image3" accept="image/*" required>
      </div>

      <div class="form-group">
        <label for="image4">Product Image 4</label>
        <input type="file" id="image4" name="image4" accept="image/*" required>
      </div>

      <div class="form-group" style="text-align:center;">
        <button class="submit-btn" type="submit" name="submit">Add Product</button>
      </div>
    </form>
  </div>
</body>
</html>
