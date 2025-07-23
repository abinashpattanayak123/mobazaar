<?php
session_start();
require_once "db.php";

// Redirect if no ID is set
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  header("Location: admin_manage_product.php");
  exit();
}

$product_id = intval($_GET['id']);

// Fetch current product data
$stmt = $conn->prepare("SELECT * FROM product WHERE product_id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
  echo "Product not found.";
  exit();
}

// Update on form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = $_POST['name'];
  $category = $_POST['category'];
  $gender = $_POST['gender'];
  $description = $_POST['description'];
  $price = $_POST['price'];
  $stock = $_POST['stock'];
  $color = $_POST['color'];

  $stmt = $conn->prepare("UPDATE product SET name = ?, category = ?, gender = ?, description = ?, price = ?, stock = ?, color = ? WHERE product_id = ?");
  $stmt->bind_param("ssssdisi", $name, $category, $gender, $description, $price, $stock, $color, $product_id);
  $stmt->execute();
  $stmt->close();

  header("Location: admin_manage_product.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Update Product - MoBazaar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff;
      padding: 40px;
      color: #000;
    }

    h2 {
      color: red;
      text-align: center;
      margin-bottom: 30px;
    }

    form {
      max-width: 600px;
      margin: auto;
      background: #f9f9f9;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }

    input, textarea, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    button {
      padding: 10px 20px;
      background-color: #000;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }

    button:hover {
      background-color: red;
    }
  </style>
</head>
<body>

<h2>✏️ Update Product</h2>

<form method="POST">
  <label for="name">Product Name</label>
  <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

  <label for="category">Category</label>
  <select id="category" name="category" required>
    <option value="Shirt" <?php if ($product['category'] === 'Shirt') echo 'selected'; ?>>Shirt</option>
    <option value="Pant" <?php if ($product['category'] === 'T-Shirt') echo 'selected'; ?>>T-Shirt</option>
    <option value="Shoe" <?php if ($product['category'] === 'Polo-Neck') echo 'selected'; ?>>Polo-Neck</option>
    <option value="Pant" <?php if ($product['category'] === 'Formal-Pant') echo 'selected'; ?>>Formal-Pant</option>
    <option value="Shoe" <?php if ($product['category'] === 'Casual-Pant') echo 'selected'; ?>>Casual-Pant</option>
    <option value="Pant" <?php if ($product['category'] === 'Jeans') echo 'selected'; ?>>Jeans</option>
    <option value="Shoe" <?php if ($product['category'] === 'Shorts') echo 'selected'; ?>>Shorts</option>
    <option value="Pant" <?php if ($product['category'] === 'Formal-Shoe') echo 'selected'; ?>>Formal-Shoe</option>
    <option value="Shoe" <?php if ($product['category'] === 'Casual-Shoe') echo 'selected'; ?>>Casual-Shoe</option>
    <option value="Pant" <?php if ($product['category'] === 'Accessories') echo 'selected'; ?>>Accessories</option>
    <option value="Pant" <?php if ($product['category'] === 'Sports-Shoe') echo 'selected'; ?>>Sports-Shoe</option>
    <option value="Shoe" <?php if ($product['category'] === 'Sports-Tshirt') echo 'selected'; ?>>Sports-Tshirt</option>
    <option value="Pant" <?php if ($product['category'] === 'Sports-Pant') echo 'selected'; ?>>Sports-Pant</option>
  </select>

  <label for="gender">Gender</label>
  <select id="gender" name="gender">
    <option value="Men" <?php if ($product['gender'] === 'Men') echo 'selected'; ?>>Men</option>
    <option value="Women" <?php if ($product['gender'] === 'Women') echo 'selected'; ?>>Women</option>
    <option value="Unisex" <?php if ($product['gender'] === 'Unisex') echo 'selected'; ?>>Unisex</option>
  </select>

  <label for="description">Description</label>
  <textarea id="description" name="description" rows="4"><?php echo $product['description']; ?></textarea>

  <label for="price">Price</label>
  <input type="number" id="price" name="price" value="<?php echo $product['price']; ?>" required>

  <label for="stock">Stock</label>
  <input type="number" id="stock" name="stock" value="<?php echo $product['stock']; ?>" required>

  <label for="color">Color</label>
  <input type="text" id="color" name="color" value="<?php echo $product['color']; ?>">

  <button type="submit">💾 Save Changes</button>
</form>

</body>
</html>