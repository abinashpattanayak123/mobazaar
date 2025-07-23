<?php
session_start();
require_once "db.php";

if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
  die("Invalid Product ID");
}

$product_id = intval($_GET['product_id']);

$sql = "SELECT * FROM product WHERE product_id = $product_id";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
  die("Product not found.");
}

$product = $result->fetch_assoc();
$email = isset($_SESSION["email"]) ? $_SESSION["email"] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?php echo htmlspecialchars($product['name']); ?> - MoBazaar</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #fff;
      color: #000;
    }

    /* Navbar */
     .navbar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: #000;
  padding: 20px 30px;
  color: white;
  position: sticky;
  top: 0;
  z-index: 999;
}

    .logo {
      height: 40px;
      width: auto;
      padding: 0 20px;
      object-fit: contain;
    }

    .nav-links {
      display: flex;
      gap: 18px;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      font-weight: 500;
      position: relative;
    }

    .nav-links a:hover::after {
      content: '';
      position: absolute;
      bottom: -6px;
      left: 0;
      width: 100%;
      height: 2px;
      background: red;
    }

    .navbar-right {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .search-input {
      padding: 5px 10px;
      border-radius: 5px;
      border: none;
    }

    .search-input:focus {
      outline: none;
      border: 2px solid red;
    }

    .icon-btn {
      background: none;
      border: none;
      color: white;
      font-size: 18px;
      cursor: pointer;
    }

    .user-dropdown {
      position: relative;
    }

    .dropdown-menu {
      display: none;
      position: absolute;
      top: 45px;
      right: 0;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 6px;
      min-width: 140px;
      z-index: 100;
    }

    .dropdown-menu a {
      display: block;
      padding: 10px 15px;
      color: #000;
      text-decoration: none;
      font-weight: 500;
    }

    .dropdown-menu a:hover {
      background-color: #f2f2f2;
    }

    /* Product Page */
    .product-page {
      display: flex;
      flex-wrap: wrap;
      max-width: 1200px;
      margin: 40px auto;
      padding: 20px;
      gap: 40px;
    }

    .left-images {
      flex: 1;
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .left-images img {
      width: 100%;
      height: auto;
      object-fit: cover;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .right-details {
      flex: 1;
    }

    .right-details h1 {
      font-size: 28px;
      margin-bottom: 10px;
    }

    .price {
      font-size: 24px;
      color: red;
      margin: 15px 0;
      font-weight: bold;
    }

    .stock {
      font-size: 14px;
      color: green;
      margin-bottom: 10px;
    }

    .out-of-stock {
      color: red;
    }

    .color-section {
      margin: 15px 0;
    }

    .color-box {
      width: 25px;
      height: 25px;
      display: inline-block;
      margin-right: 10px;
      border-radius: 50%;
      border: 2px solid #000;
    }

    .description {
      font-size: 16px;
      margin: 20px 0;
      line-height: 1.5;
    }

    .buttons {
      display: flex;
      gap: 20px;
      margin-top: 20px;
    }

    .buttons button {
      padding: 10px 20px;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .buttons {
  display: flex;
  gap: 20px;
  margin-top: 20px;
}

.buttons button {
  flex: 1;
}


    .add-cart {
      background-color: #000;
      color: #fff;
    }

    .buy-now {
      background-color: red;
      color: #fff;
    }

    @media (max-width: 768px) {
      .product-page {
        flex-direction: column;
      }

      .left-images {
        grid-template-columns: 1fr 1fr;
      }
    }
    .dropdown {
    position: relative;
  }

  .dropdown-content {
    display: none;
    position: absolute;
    top: 100%;
    left: 0;
    background-color: #fff;
    min-width: 200px;
    padding: 20px;
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    z-index: 10;
    color: black;
    font-size: 14px;
  }

  .dropdown:hover .dropdown-content {
    display: flex;
    gap: 40px;
  }

  .dropdown-column {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .dropdown-column a {
    color: black;
    text-decoration: none;
  }

  .dropdown-column a:hover {
    text-decoration: underline;
    color: red;
  }
  .search-form {
    position: relative;
    display: flex;
    align-items: center;
  }

  .search-input {
    padding: 10px 40px 10px 15px;
    border: 1px solid #ccc;
    border-radius: 20px;
    outline: none;
    width: 200px;
  }

  .search-form button {
    position: absolute;
    right: 10px;
    background: none;
    border: none;
    color: #555;
    font-size: 18px;
    cursor: pointer;
  }

  .search-form button:hover {
    color: red;
  }
  </style>
</head>
<body>

<!-- Navbar -->
<header class="navbar">
  <div class="navbar-left">
    <img src="mobazaar.png" alt="MoBazaar" class="logo" />
  </div>
  <nav class="nav-links">
  <a href="home.php">Home</a>

  <div class="dropdown">
    <a href="#">Men</a>
    <div class="dropdown-content">
      <div class="dropdown-column">
        <h3>Categories</h3>
        <a>Shirts</a>
        <a href="#">Polo Shirts</a>
        <a href="#">T-Shirts</a>
        <a href="#">Jeans</a>
        <a href="#">Trousers</a>
        <a href="#">Outerwear</a>
        <a href="#">Trackpants</a>
        <a href="#">Shorts</a>
      </div>
      <div class="dropdown-column">
        <strong>Curations For You</strong>
        <a href="#">Outdoor</a>
        <a href="#">USPA Sport</a>
        <a href="#">Work and Wander</a>
        <a href="#">135 Year Anniversary</a>
        <a href="#">Black and White</a>
        <a href="#">Premium Polo Shirts</a>
      </div>
    </div>
  </div>

  <div class="dropdown">
    <a href="#">Women</a>
    <div class="dropdown-content">
      <div class="dropdown-column">
        <h3>Explore</h3>
        <a href="#">Tops</a>
        <a href="#">Jeans</a>
        <a href="#">T-Shirts</a>
        <a href="#">Shirts</a>
        <a href="#">Dresses</a>
        <a href="#">Skirts</a>
      </div>
    </div>
  </div>

<div class="dropdown">
  <a href="#">Sports</a>
  <div class="dropdown-content">
      <div class="dropdown-column">
        <h3>Explore</h3>
        <a href="#">Tops</a>
        <a href="#">Jeans</a>
        <a href="#">T-Shirts</a>
        <a href="#">Shirts</a>
        <a href="#">Dresses</a>
        <a href="#">Skirts</a>
      </div>
    </div>
</div>
<div class="dropdown">
  <a href="#">Lifestyle</a>
  <div class="dropdown-content">
      <div class="dropdown-column">
        <h3>Explore</h3>
        <a href="#">Tops</a>
        <a href="#">Jeans</a>
        <a href="#">T-Shirts</a>
        <a href="#">Shirts</a>
        <a href="#">Dresses</a>
        <a href="#">Skirts</a>
      </div>
    </div>
</div>

  <div class="dropdown">
    <a href="#">Kids</a>
    <div class="dropdown-content">
      <div class="dropdown-column">
        <strong>Kidswear</strong>
        <a href="#">Polo Shirts</a>
        <a href="#">Shirts</a>
        <a href="#">T-Shirts</a>
        <a href="#">Dresses</a>
        <a href="#">Shorts</a>
        <a href="#">2 Piece</a>
      </div>
    </div>
  </div>

  <a href="#">Sale</a>
  <a href="#">Offers</a>
</nav>
  <div class="navbar-right">
   <form action="search.php" method="POST" class="search-form">
  <input type="text" name="search_term" placeholder="Search" class="search-input" required/>
  <button type="submit" title="Search"><i class="bi bi-search"></i></button>
</form>
    <button class="icon-btn">❤️</button>
    <button class="icon-btn" onclick="window.location.href='mycart.php'">🛒</button>
    <div class="user-dropdown">
      <?php if ($email): ?>
        <form action="profile.php" method="GET" style="display:inline;">
          <button class="icon-btn" title="my profile">👤</button>
        </form>
      <?php else: ?>
        <button class="icon-btn" onclick="toggleDropdown()">👤</button>
        <div class="dropdown-menu" id="userMenu">
          <a href="login.php">User Login</a>
          <a href="admin_login.php">Admin Login</a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</header>

<!-- Product Details Section -->
<div class="product-page">
  <div class="left-images">
    <img src="uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Image 1">
    <img src="uploads/<?php echo htmlspecialchars($product['product_image2']); ?>" alt="Image 2">
    <img src="uploads/<?php echo htmlspecialchars($product['product_image3']); ?>" alt="Image 3">
    <img src="uploads/<?php echo htmlspecialchars($product['product_image4']); ?>" alt="Image 4">
  </div>

  <div class="right-details">
    <h1><?php echo htmlspecialchars($product['name']); ?></h1>
    <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px;">
  <div style="background-color: #388e3c; color: white; padding: 2px 6px; border-radius: 4px; font-weight: bold; font-size: 14px;">
    <i class="bi bi-star-fill"></i> 4.2
  </div>
  <div style="color: #878787; font-size: 14px;">3,22,667 Ratings & 20,891 Reviews</div>
  <div style="color: #2e7eed; font-size: 13px; margin-left: auto;">
    
  </div>
</div>

    

   <!-- Stock + Color + Assured Section -->
<div style="display: flex; align-items: center; gap: 20px; margin-bottom: 15px;">
  <div class="stock <?php echo ($product['stock'] > 0) ? '' : 'out-of-stock'; ?>" style="font-size: 14px;">
    <?php echo ($product['stock'] > 0) ? 'In Stock' : 'Out of Stock'; ?>
  </div>

  <div style="display: flex; align-items: center; gap: 4px;">
    <strong style="font-size: 14px;">Color:</strong>
    <div class="color-box" style="background-color: <?php echo htmlspecialchars($product['color']); ?>;"></div>
    
  </div>

  <div style="color: #2e7eed; font-size: 14px;">
    <i class="bi bi-patch-check-fill" style="color:#2e7eed;"></i> Assured
  </div>
</div>
<div style="margin: 20px 0;">
  <div style="color: green; font-size: 16px; font-weight: bold;">Special price</div>
  <div style="font-size: 22px; font-weight: bold; color: red;">₹<?php echo htmlspecialchars($product['price']); ?> <span style="text-decoration: line-through; font-size: 16px; color: gray;"><?php echo htmlspecialchars($product['price'] *2); ?></span> <span style="color: green; font-size: 16px;">50% off</span></div>
  <div style="margin-top: 6px; font-size: 12px; color: #555;">+ ₹19 Protect Promise Fee <a href="#" style="color: blue;">Learn more</a></div>

  <div style="margin-top: 20px;">
    <strong style="font-size: 15px;">Available offers</strong>
    <ul style="margin-top: 10px; padding-left: 20px; list-style: none;">
      <li style="margin-bottom: 10px;">
        <span style="color: green;"><i class="bi bi-tag-fill"></i> Bank Offer</span> 5% cashback on Flipkart Axis Bank Credit Card <a href="#" style="color: blue;">T&C</a>
      </li>
      <li style="margin-bottom: 10px;">
        <span style="color: green;"><i class="bi bi-tag-fill"></i> Bank Offer</span> 5% cashback on Axis Bank Flipkart Debit Card up to ₹750 <a href="#" style="color: blue;">T&C</a>
      </li>
      <li style="margin-bottom: 10px;">
        <span style="color: green;"><i class="bi bi-tag-fill"></i> Bank Offer</span> 10% off up to ₹1,250 on Axis Bank Credit Card Txns, Min Value: ₹4,990 <a href="#" style="color: blue;">T&C</a>
      </li>
      <li>
        <span style="color: green;"><i class="bi bi-tag-fill"></i> Special Price</span> Get extra 62% off (price inclusive of cashback/coupon) <a href="#" style="color: blue;">T&C</a>
      </li>
    </ul>
    <a href="#" style="color: blue; font-size: 14px;">View more offers</a>
  </div>
</div>
    

    <div class="description">
      <?php echo nl2br(htmlspecialchars($product['description'])); ?>
    </div>

    <div class="buttons">
      <button class="add-cart" onclick="event.stopPropagation(); addToCart(<?php echo $product['product_id']; ?>);">
  Add to Cart <i class="bi bi-cart3"></i>
</button>
      <button class="buy-now">Buy Now <i class="bi bi-bag-check"></i></button>
    </div>
  </div>
</div>

<!-- Footer -->
<footer style="background:#000; color:white; padding:50px 30px;">
  <div style="display:flex; flex-wrap:wrap; justify-content:space-between; gap:30px; max-width:1200px; margin:auto;">
    <!-- Support -->
    <div>
      <h3 style="margin-bottom:15px;">SUPPORT <i class="bi bi-info-circle-fill"></i></h3>
      <ul style="list-style:none; padding:0;">
        <li><a href="#" style="color:white; text-decoration:none;">Contact Us</a></li>
        <li><a href="#" style="color:white; text-decoration:none;">Promotions & Sale</a></li>
        <li><a href="#" style="color:white; text-decoration:none;">Track Order</a></li>
        <li><a href="#" style="color:white; text-decoration:none;">Shoe Care</a></li>
        <li><a href="#" style="color:white; text-decoration:none;">Return & Exchange</a></li>
        <li><a href="#" style="color:white; text-decoration:none;">Sitemap</a></li>
      </ul>
    </div>

    <!-- About -->
    <div>
      <h3 style="margin-bottom:15px;">ABOUT <i class="bi bi-file-person-fill"></i></h3>
      <ul style="list-style:none; padding:0;">
        <li><a href="#" style="color:white; text-decoration:none;">Company</a></li>
        <li><a href="#" style="color:white; text-decoration:none;">Careers</a></li>
        <li><a href="#" style="color:white; text-decoration:none;">Press Center</a></li>
        <li><a href="#" style="color:white; text-decoration:none;">Sustainability</a></li>
        <li><a href="#" style="color:white; text-decoration:none;">Investors</a></li>
      </ul>
    </div>

    <!-- Stay Up to Date -->
    <div>
      <h3 style="margin-bottom:15px;">STAY UP TO DATE</h3>
      <div style="display:flex; gap:10px;">
        <i class="bi bi-instagram"></i>Instagram
        <i class="bi bi-youtube"></i>YouTube
        <i class="bi bi-facebook"></i>Facebook
      </div>
    </div>

    <!-- Explore -->
    <div>
      <h3 style="margin-bottom:15px;">EXPLORE</h3>
      <div style="display:flex; flex-direction:column; gap:10px;">
        <button style="padding:8px 16px; border:1px solid white; background:none; color:white; border-radius:5px;">APP</button>
        <button style="padding:8px 16px; border:1px solid white; background:none; color:white; border-radius:5px;">TRACK</button>
      </div>
    </div>
  </div>

  <div style="margin-top:40px; text-align:center; border-top:1px solid #444; padding-top:20px;">
    <button style="padding:10px 20px; border:1px solid white; background:none; color:white; border-radius:5px;">
      🇮🇳 INDIA
    </button>
    <p style="margin-top:10px; font-size:14px;">© MoBazaar 2025. All rights reserved.</p>
  </div>
</footer>
<!-- Scripts -->
<script>
  function toggleDropdown() {
    const menu = document.getElementById("userMenu");
    menu.style.display = menu.style.display === "block" ? "none" : "block";
  }

  document.addEventListener("click", function (event) {
    const menu = document.getElementById("userMenu");
    const icon = document.querySelector(".user-dropdown button");
    if (event.target !== icon && !menu.contains(event.target)) {
      menu.style.display = "none";
    }
  });
  function addToCart(productId) {
    // Redirect silently or send an AJAX request (optional)
    window.location.href = 'addtocart.php?product_id=' + productId + '&val=1';
  }
</script>


<?php if (isset($_SESSION['cart_success'])): ?>
  <script>
    window.onload = function () {
      const toast = document.createElement("div");
      toast.innerText = "<?php echo $_SESSION['cart_success']; ?>";
      toast.style.position = "fixed";
      toast.style.bottom = "30px";
      toast.style.right = "30px";
      toast.style.background = "green";
      toast.style.color = "white";
      toast.style.padding = "15px 20px";
      toast.style.borderRadius = "5px";
      toast.style.boxShadow = "0 2px 10px rgba(0,0,0,0.2)";
      toast.style.zIndex = "9999";
      toast.style.fontWeight = "bold";
      toast.style.fontFamily = "Arial, sans-serif";
      document.body.appendChild(toast);
      
      setTimeout(() => toast.remove(), 3000);
    };
  </script>
  <?php unset($_SESSION['cart_success']); ?>
<?php endif; ?>

</body>
</html>
