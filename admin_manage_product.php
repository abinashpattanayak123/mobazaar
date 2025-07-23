<?php
session_start();
require_once "db.php";

// Delete product if delete is requested
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
  $delete_id = intval($_GET['delete']);
  $stmt = $conn->prepare("DELETE FROM product WHERE product_id = ?");
  $stmt->bind_param("i", $delete_id);
  $stmt->execute();
  $stmt->close();
  header("Location: admin_manage_product.php");
  exit();
}

// Fetch all products
$result = $conn->query("SELECT * FROM product");
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Manage Products - MoBazaar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #fff;
      margin: 0;
      padding: 30px;
      color: #000;
    }

    h2 {
      color: red;
      text-align: center;
      margin-bottom: 30px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px 10px;
      border: 1px solid #ccc;
      text-align: center;
    }

    th {
      background-color: #000;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .btn {
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }

    .btn-update {
      background-color: #000;
      color: white;
    }

    .btn-update:hover {
      background-color: red;
    }

    .btn-delete {
      background-color: red;
      color: white;
    }

    .btn-delete:hover {
      background-color: #c40000;
    }

    img.thumbnail {
      width: 60px;
      height: 60px;
      object-fit: cover;
      border-radius: 4px;
    }
  </style>
</head>
<body>

<h2>📦 Manage Products</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Category</th>
    <th>Gender</th>
    <th>Description</th>
    <th>Price</th>
    <th>Stock</th>
    <th>Color</th>
    <th>Image</th>
    <th>Action</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row['product_id']; ?></td>
      <td><?php echo htmlspecialchars($row['name']); ?></td>
      <td><?php echo $row['category']; ?></td>
      <td><?php echo $row['gender']; ?></td>
      <td><?php echo substr($row['description'], 0, 40); ?>...</td>
      <td>₹<?php echo $row['price']; ?></td>
      <td><?php echo $row['stock']; ?></td>
      <td><?php echo $row['color']; ?></td>
      <td>
        <?php if ($row['product_image']): ?>
          <img class="thumbnail" src="uploads/<?php echo $row['product_image']; ?>" alt="Product">
        <?php else: ?>
          N/A
        <?php endif; ?>
      </td>
      <td>
        <a href="admin_update_product.php?id=<?php echo $row['product_id']; ?>">
          <button class="btn btn-update">Update</button>
        </a>
        <a href="admin_manage_product.php?delete=<?php echo $row['product_id']; ?>" onclick="return confirm('Delete this product?');">

          <button class="btn btn-delete">Delete</button>
        </a>
      </td>
    </tr>
  <?php endwhile; ?>
</table>

</body>
</html>
