<?php
session_start();
require_once "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_term'])) {
    $search_term = trim($_POST['search_term']);
    $search_term = $conn->real_escape_string($search_term);

    $sql = "SELECT * FROM product 
            WHERE name LIKE '%$search_term%' 
               OR category LIKE '%$search_term%' 
               OR gender LIKE '%$search_term%'";
    $result = $conn->query($sql);
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Search Results - MoBazaar</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 30px;
      background-color: #fff;
    }

    /* RING LOADER */
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
      transition: transform 0.2s ease;
    }

    .product-card:hover {
      transform: scale(1.03);
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

    .buy-btn {
      padding: 8px 12px;
      background-color: #d10000;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
    }

    .buy-btn:hover {
      background-color: #a80000;
    }
 

/* Product card hover */
.product-card {
  transition: transform 0.3s, box-shadow 0.3s;
}

.product-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
}

/* Buy Now button hover effect */
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

<!-- Loader Ring -->
<div class="loader-container" id="loader">
  <div class="ring"></div>
</div>

<!-- Main Search Result Content -->
<div id="main-content">
  <h2>Search Results for "<?php echo htmlspecialchars($search_term); ?>"</h2>

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
      <p>No products found matching "<?php echo htmlspecialchars($search_term); ?>".</p>
    <?php endif; ?>
  </div>
</div>

<script>
// Wait 2 seconds, then hide loader and show results
window.addEventListener('load', function () {
  setTimeout(function () {
    document.getElementById('loader').style.display = 'none';
    document.getElementById('main-content').style.display = 'block';
  }, 2000);
});
</script>

</body>
</html>
