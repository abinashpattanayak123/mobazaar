<?php
session_start();
require_once "db.php";

if (isset($_GET['gender']) && isset($_GET['category'])) {
    $gender = $conn->real_escape_string(trim($_GET['gender']));
    $category = $conn->real_escape_string(trim($_GET['category']));

    $sql = "SELECT * FROM product 
            WHERE gender = '$gender' 
              AND category = '$category'";
    $result = $conn->query($sql);
} else {
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title><?php echo ucfirst($gender) . ' - ' . ucfirst($category); ?> | MoBazaar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #fff;
    }

    .loader-container {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background-color: rgba(255,255,255,0.9);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
    }

    .ring {
      width: 60px;
      height: 60px;
      border: 6px solid #ccc;
      border-top-color: #d10000;
      border-radius: 50%;
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      to { transform: rotate(360deg); }
    }

    #main-content {
      display: none;
    }

    .product-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 20px;
    }

    .product-card {
      border: 1px solid #ddd;
      border-radius: 12px;
      padding: 10px;
      width: 200px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
    }

    .product-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }

    .product-image {
      width: 100%;
      height: 180px;
      object-fit: cover;
      border-radius: 8px;
    }

    .product-name {
      font-weight: bold;
      color: #d10000;
      margin: 10px 0 5px;
      font-size: 16px;
    }

    .product-price {
      color: green;
      margin-bottom: 10px;
      font-weight: bold;
    }

    .buy-now-btn {
      background-color: #e60000;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      transition: transform 0.2s ease, background-color 0.3s ease;
      cursor: pointer;
    }

    .buy-now-btn:hover {
      background-color: #c40000;
      transform: scale(1.05);
    }
  </style>
</head>
<body>

<!-- Loader -->
<div class="loader-container" id="loader">
  <div class="ring"></div>
</div>

<!-- Main Content -->
<div id="main-content">
  <h2><?php echo ucfirst($gender) . "'s " . ucfirst($category); ?> Collection</h2>

  <div class="product-container">
    <?php if ($result && $result->num_rows > 0): ?>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="product-card">
          <?php if (!empty($row['product_image'])): ?>
            <img src="uploads/<?php echo $row['product_image']; ?>" class="product-image" alt="Product Image">
          <?php else: ?>
            <img src="uploads/no-image.png" class="product-image" alt="No Image">
          <?php endif; ?>
          <div class="product-name"><?php echo $row['name']; ?></div>
          <div class="product-price">₹<?php echo $row['price']; ?></div>
          <button class="buy-now-btn" onclick="window.location.href='product_details.php?product_id=<?php echo $row['product_id']; ?>'">Buy Now</button>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <p>No products found for <?php echo htmlspecialchars($gender . ' - ' . $category); ?>.</p>
    <?php endif; ?>
  </div>
</div>

<script>
window.addEventListener('load', function () {
  setTimeout(function () {
    document.getElementById('loader').style.display = 'none';
    document.getElementById('main-content').style.display = 'block';
  }, 2000);
});
</script>

</body>
</html>
