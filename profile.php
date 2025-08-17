<?php 
session_start(); 



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Profile - MoBazaar</title>
   <link rel="icon" type="image/png" href="favlogo.jpeg">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: Arial, sans-serif;
      background-color: #fff;
      color: #000;
    }

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
      height: 50px;
      width: auto;
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
      flex-wrap: wrap;
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

    /* Profile Page Layout */
    .container {
      display: flex;
      min-height: 90vh;
    }

    .sidebar {
      width: 220px;
      background-color: #f5f5f5;
      padding: 30px 20px;
      border-right: 1px solid #ddd;
    }

    .sidebar h3 {
      margin-bottom: 30px;
      font-size: 20px;
    }

    .sidebar a {
      display: block;
      padding: 12px;
      margin-bottom: 10px;
      color: #000;
      text-decoration: none;
      font-weight: bold;
      border-radius: 5px;
    }

    .sidebar a:hover,
    .sidebar a.active {
      background-color: #000;
      color: #fff;
    }

    .main-content {
      flex: 1;
      padding: 40px;
    }

    .main-content h1 {
      font-size: 30px;
      margin-bottom: 10px;
    }

    .main-content p {
      color: #555;
      margin-bottom: 30px;
    }

    .trending {
      display: flex;
      gap: 20px;
      flex-wrap: wrap;
    }

    .product-card {
  width: 180px;
  height: 180px; /* make it square */
  background-color: #f9f9f9;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
  text-align: center;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.product-card img {
  width: 100%;
  height: 100%;
  object-fit: contain; /* keeps the aspect ratio */
  border-radius: 8px;
}

    .discount {
      background-color: red;
      color: #fff;
      font-size: 12px;
      padding: 2px 6px;
      border-radius: 4px;
      display: inline-block;
      margin-bottom: 5px;
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

  .faq-section {
  margin-top: 40px;
  background: #f9f9f9;
  padding: 25px;
  border-radius: 10px;
  box-shadow: 0 0 8px rgba(0,0,0,0.1);
}

.faq-section h2 {
  margin-bottom: 20px;
  font-size: 22px;
  color: #000;
}

.faq {
  margin-bottom: 20px;
}

.faq h4 {
  font-size: 16px;
  font-weight: bold;
  margin-bottom: 8px;
}

.faq p {
  font-size: 14px;
  color: #555;
  line-height: 1.5;
}

.faq-links {
  margin-top: 15px;
}

.faq-links a {
  text-decoration: none;
  font-weight: bold;
}

.faq-links a.deactivate {
  color: blue;
}

.faq-links a.delete {
  color: red;
}
  </style>
</head>
<body>

  <!-- Header -->
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
      <button class="icon-btn">🤍</button>
      <button class="icon-btn" onclick="window.location.href='mycart.php'">🛒</button>
      <div class="user-dropdown">
        <form action="profile.php" method="GET" style="display:inline;">
          <button class="icon-btn" title="Go to profile">👤</button>
        </form>
      </div>
    </div>
  </header>

  <div class="container">
    <div class="sidebar">
      <h3>👤 Account</h3>
      <a href="#" class="active">Account Overview</a>
      <a href="my_orders.php"><i class="bi bi-box-seam"></i> My Orders</a>
      <a href="my_info.php"><i class="bi bi-info-circle"></i> My Info</a>
      <a href="#"><i class="bi bi-heart"></i> Wishlist</a>
      <a href="#"><i class="bi bi-gear"></i> Account Settings</a>
      <br><br>
      <a href="logout.php" style="color: red; font-weight: bold; font-size:20px; padding:11px 30px; display:inline-block;"><i class="bi bi-power"></i> Logout</a>
    </div>

    <div class="main-content">
      <h1>Hello, <?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'User'; ?></h1>
      <p>Account Overview</p>

      <h2>TRENDING NOW</h2>
      <div class="trending">
        <div class="product-card">
          <span class="discount">-33%</span>
          <img src="salelogo.jpeg" alt="Product 1" />
        </div>
        <div class="product-card">
          <span class="discount">-50%</span>
          <img src="salelogo2.jpeg" alt="Product 2" />
        </div>
        <div class="product-card">
          <span class="discount">-25%</span>
          <img src="salelogo3.jpeg" alt="Product 3" />
        </div>
        <div class="product-card">
          <span class="discount">-15%</span>
          <img src="salelogo4.jpeg" alt="Product 4" />
        </div>
      </div>
    </div> 
    
  </div>
 

  
 <!-- FAQ Section -->
<div class="faq-section">
  <h2>FAQs</h2>
  
  <div class="faq">
    <h4>What happens when I update my email address (or mobile number)?</h4>
    <p>Your login email id (or mobile number) changes, likewise. You'll receive all your account-related communication on your updated email address (or mobile number).</p>
  </div>

  <div class="faq">
    <h4>When will my MoBazaar account be updated with the new email address (or mobile number)?</h4>
    <p>It happens as soon as you confirm the verification code sent to your email (or mobile) and save the changes.</p>
  </div>

  <div class="faq">
    <h4>What happens to my existing MoBazaar account when I update my email address (or mobile number)?</h4>
    <p>Updating your email address (or mobile number) doesn’t invalidate your account. Your account remains fully functional. You'll continue seeing your order history, saved information and personal details.</p>
  </div>

  <div class="faq">
    <h4>Does my Seller account get affected when I update my email address?</h4>
    <p>MoBazaar has a 'single sign-on' policy. Any changes will reflect in your Seller account also.</p>
  </div>

  <div class="faq-links">
    <a href="#" class="deactivate">Deactivate Account</a> |
    <a href="#" class="delete">Delete Account</a>
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
  <button style="padding:10px 20px; border:1px solid white; background:none; color:white; border-radius:5px; font-size:16px; display: inline-flex; align-items: center; gap: 6px;">
    <img src="https://upload.wikimedia.org/wikipedia/commons/b/bc/Flag_of_India.png" 
         alt="India Flag" 
         style="height:16px; width:auto; vertical-align:middle;">
    INDIA
  </button>
    <p style="margin-top:10px; font-size:14px;">© MoBazaar 2025. All rights reserved.</p>
  </div>
</footer>
<script>
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
