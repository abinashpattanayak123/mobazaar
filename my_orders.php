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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f3f6;
              margin: 0;
             padding: 0;
        }
        h2 {
            color: #d32f2f;
            margin-bottom: 30px;
        }
        .order-card {
            background-color: #fff;
            border-radius: 6px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        .order-card img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 20px;
            border: 1px solid #ddd;
        }
        .order-details {
            flex: 1;
        }
        .order-details h3 {
            margin: 0;
            font-size: 16px;
        }
        .order-details p {
            margin: 6px 0;
            color: #333;
            font-size: 14px;
        }
        .order-status {
    text-align: right;
    font-size: 15px; /* increased */
}
.order-status .status {
    font-size: 16px; /* slightly bolder */
    font-weight: bold;
    margin-bottom: 6px;
    color: green;
}
.order-status small {
    font-size: 15px;
    color: #333;
}

/* navbar */
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
    .logo { height: 40px; width: auto; padding: 0 20px; object-fit: contain; }
    .nav-links { display: flex; gap: 18px; }
    .nav-links a { color: white; text-decoration: none; font-weight: 500; position: relative; }
    .nav-links a:hover::after {
      content: ''; position: absolute; bottom: -6px; left: 0; width: 100%; height: 2px; background: red;
    }
    .navbar-right { display: flex; align-items: center; gap: 10px; }
    .search-input { padding: 5px 10px; border-radius: 5px; border: none; }
    .search-input:focus { outline: none; border: 2px solid red; }
    .icon-btn { background: none; border: none; color: white; font-size: 18px; cursor: pointer; }
    .user-dropdown { position: relative; }
    .dropdown-menu {
      display: none; position: absolute; top: 45px; right: 0; background-color: #fff;
      border: 1px solid #ccc; border-radius: 6px; min-width: 140px; z-index: 100;
    }
    .dropdown-menu a {
      display: block; padding: 10px 15px; color: #000; text-decoration: none; font-weight: 500;
    }
    .dropdown-menu a:hover { background-color: #f2f2f2; }
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
    <a href="">Men</a>
    <div class="dropdown-content">
      <div class="dropdown-column">
        <h3>Categories</h3>
        <a href="category_view.php?gender=men&category=shirt">Shirt</a>
        <a href="category_view.php?gender=men&category=Polo-Neck">Polo-Neck</a>
        <a href="category_view.php?gender=men&category=T-Shirts">T-Shirts</a>
        <a href="category_view.php?gender=men&category=Jeans">Jeans</a>
        <a href="category_view.php?gender=men&category=Formal-Pant">Formal-Pant</a>
        <a href="category_view.php?gender=men&category=Casual-Pant">Casual-Pant</a>
        <a href="category_view.php?gender=men&category=Shorts">Shorts</a>
        <a href="category_view.php?gender=men&category=Formal-Shoe">Formal-Shoe</a>
        <a href="category_view.php?gender=men&category=Casual-Shoe">Casual-Shoe</a>
        
      </div>
    </div>
  </div>

  <div class="dropdown">
    <a href="#">Women</a>
    <div class="dropdown-content">
      <div class="dropdown-column">
         <h3>Categories</h3>
        <a href="category_view.php?gender=women&category=shirt">Shirt</a>
        <a href="category_view.php?gender=women&category=Polo-Neck">Polo-Neck</a>
        <a href="category_view.php?gender=women&category=T-Shirts">T-Shirts</a>
        <a href="category_view.php?gender=women&category=Jeans">Jeans</a>
        <a href="category_view.php?gender=women&category=Formal-Pant">Formal-Pant</a>
        <a href="category_view.php?gender=women&category=Casual-Pant">Casual-Pant</a>
        <a href="category_view.php?gender=women&category=Shorts">Shorts</a>
        <a href="category_view.php?gender=women&category=Formal-Shoe">Formal-Shoe</a>
        <a href="category_view.php?gender=women&category=Casual-Shoe">Casual-Shoe</a>
      </div>
    </div>
  </div>

<div class="dropdown">
  <a href="#">Sports</a>
  <div class="dropdown-content">
      <div class="dropdown-column">
        <h3>Explore</h3>
        <a href="category_view.php?gender=men&category=Sports-Shoe">Men Sports-Shoe</a>
        <a href="category_view.php?gender=women&category=Sports-Shoe">Women Sports-Shoe</a>
        <a href="category_view.php?gender=men&category=Sports-Tshirt">Men Sports_Tshirts</a>
        <a href="category_view.php?gender=women&category=Sports-Tshirt">Women Sports_Tshirts</a>
        <a href="category_view.php?gender=men&category=Sports-Pant"> men Sports_Pants</a>
        <a href="category_view.php?gender=women&category=Sports-Pant">Women Sports_Pants</a>
        
      </div>
    </div>
</div>

<div class="dropdown">
  <a href="#">Lifestyle</a>
  
</div>
  <a href="#">Sale</a>
  <a href="#" onclick="scrollToBottom(event)">Help</a>
</nav>
  <div class="navbar-right">
    <form action="search.php" method="POST" class="search-form">
  <input type="text" name="search_term" placeholder="Search" class="search-input" required/>
  <button type="submit" title="Search"><i class="bi bi-search"></i></button>
</form>
    <button class="icon-btn">❤️</button>
    <button class="icon-btn"><a href="mycart.php" style="color: white; text-decoration: none;">🛒</a></button>
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

<h2>&nbsp; &nbsp;My Orders <i class="bi bi-box-seam"></i></h2>

<?php if ($result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="order-card">
            <img src="uploads/<?php echo htmlspecialchars($row['product_image']); ?>" 
                 alt="Product Image" 
                 onerror="this.onerror=null;this.src='default.jpg';">
            <div class="order-details">
                <h3><?php echo htmlspecialchars($row['product_name']); ?></h3>
                <p>Order ID: <?php echo htmlspecialchars($row['order_id']); ?></p>
                <p>Quantity: <?php echo htmlspecialchars($row['product_quantity']); ?></p>
                <p>Total Paid: ₹<?php echo htmlspecialchars($row['total_amount']); ?></p>
            </div>
            <div class="order-status">
                <div class="status">Ordered <i class="bi bi-check-circle-fill"></i></div><br>
                <small><i class="bi bi-calendar"></i> <b>Ordered On :</b> <?php echo htmlspecialchars($row['order_date']); ?></small><br>
                <small><i class="bi bi-house-door"></i> <b>Address:</b> <?php echo htmlspecialchars($row['address']); ?></small>
            </div>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>No orders found.</p>
<?php endif; ?>


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

  // help button scrol down page
function scrollToBottom(event) {
    event.preventDefault(); // prevent default link action
    window.scrollTo({
      top: document.body.scrollHeight,
      behavior: 'smooth' // for smooth scrolling
    });
  }
</script>
</body>
</html>
