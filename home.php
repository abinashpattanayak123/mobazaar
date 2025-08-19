<?php 
session_start(); 
require_once "db.php";

$email = isset($_SESSION["email"]) ? $_SESSION["email"] : null;  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>MoBazaar - Home</title>
  <link rel="icon" type="image/png" href="favlogo.jpeg">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    /* Reset & Base */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      background: #fff;
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
   top: 0;             /* This is required */
  z-index: 1000; 
   
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

    /* Slider */
    .slider {
      width: 100%;
      max-height: 400px;
      overflow: hidden;
      margin-top: 10px;
    }

    .slider img {
      width: 100%;
      height: 400px;
      object-fit: cover;
      display: none;
    }

    .slider img.active {
      display: block;
    }

    /* Product Section */
    .product-section {
      padding: 40px;
      background-color: #fff;
    }

    .section-title {
      text-align: center;
      color: #ff4d4d;
      margin-bottom: 30px;
      font-size: 28px;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
      gap: 25px;
    }

    .product-card {
      background-color: #f7f7f7;
      border-radius: 10px;
      padding: 15px;
      text-align: center;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
      transition: transform 0.2s ease-in-out;
    }

    .product-card:hover {
      transform: scale(1.03);
    }

    .product-card img {
      width: 100%;
      height: 200px;
      object-fit: contain;
      border-radius: 8px;
      background-color: #fff;
      margin-bottom: 10px;
    }

    .product-card h3 {
      margin: 10px 0 5px;
      font-size: 18px;
      color: #000;
    }

    .product-card .price {
      color: #ff4d4d;
      font-size: 16px;
      font-weight: bold;
    }

    .add-to-cart-btn {
      margin-top: 10px;
      padding: 8px 14px;
      background: #000;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .add-to-cart-btn:hover {
      background-color:rgb(0, 0, 0);
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
  a div:hover {
  transform: scale(1.05);
  transition: 0.3s ease;
  background-color: #cc0000;
}


  /* Page load fade-in animation */
  body {
    opacity: 0;
    animation: fadeInBody 1s ease-in-out forwards;
  }

  @keyframes fadeInBody {
    to {
      opacity: 1;
    }
  }

  /* Scroll animations */
  .animate {
    opacity: 0;
    transform: translateY(20px);
    transition: all 1.5s ease-in-out;
  }

  .animate.visible {
    opacity: 1;
    transform: translateY(0);
  }

  /* Button hover animation */
  button,
  .add-to-cart-btn {
    transition: transform 0.2s ease, background-color 0.3s ease;
  }

  button:hover,
  .add-to-cart-btn:hover {
    transform: scale(1.05);
    opacity: 0.9;
  }

  /* Image hover animation */
  .product-card img {
    transition: transform 0.3s ease;
  }

  .product-card:hover img {
    transform: scale(1.05);
  }

  /* Countdown digits animation */
  #countdown span {
    display: inline-block;
    animation: pulse 1s infinite alternate;
  }

  @keyframes pulse {
    to {
      transform: scale(1.1);
    }
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

  .hero-section {
  text-align: center;
  padding: 60px 20px 30px;
  background-color: #fff;
}

.hero-section h1 {
  font-size: 36px;
  font-weight: bold;
  margin-bottom: 10px;
  text-transform: uppercase;
}

.hero-section p {
  font-size: 16px;
  color: #555;
  margin-bottom: 40px;
}

.icon-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 20px;
  max-width: 1200px;
  margin: 0 auto;
}

.icon-card {
  position: relative;
  overflow: hidden;
  border-radius: 6px;
  transition: transform 0.3s ease;
}

.icon-card:hover {
  transform: scale(1.03);
}

.icon-card img {
  width: 100%;
  display: block;
  border-radius: 6px;
}

.icon-title {
  position: absolute;
  bottom: 15px;
  left: 15px;
  color: white;
  background-color: rgba(0, 0, 0, 0.6);
  padding: 6px 12px;
  font-size: 14px;
  font-weight: 600;
  border-radius: 4px;
  text-transform: uppercase;
}

.brand-row {
  width: 100%;
  
  padding: 20px 0;
  overflow-x: auto; /* enable horizontal scroll */
  white-space: nowrap;
}

.brand-title {
  color: #fff;
  text-align: center;
  margin-bottom: 15px;
  font-size: 24px;
  letter-spacing: 2px;
}

/* Horizontal scroll container */
.brand-slider {
  display: flex;
  gap: 20px;
  padding: 0 20px;
}

/* Each brand card */
.brand-card {
  min-width: 150px;
  max-width: 200px;
  background: #fff;
  border-radius: 10px;
  padding: 10px;
  text-align: center;
  transition: transform 0.5s ease;
}

.brand-card img {
  width: 100%;
  height: auto;
  object-fit: contain;
  border-radius: 8px;
}

/* Hover effect */
.brand-card:hover {
  transform: scale(1.08);
}
.brand-row {
  overflow-x: auto;
  scrollbar-width: none; /* Firefox */
}

.brand-row::-webkit-scrollbar {
  display: none; /* Chrome, Safari */
}

.slider {
  width: 100%;
  max-height: 400px;
  overflow: hidden;
  position: relative;
}

.slider img {
  width: 100%;
  height: 400px;
  object-fit: cover;
  display: none;
}

.slider img.active {
  display: block;
}

/* Dots container */
.dots {
  text-align: center;
  margin-top: 10px;
}

/* Dot style */
.dot {
  height: 12px;
  width: 12px;
  margin: 0 5px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  cursor: pointer;
  transition: background-color 0.3s;
}

.dot.active {
  background-color: #333;
}

.banner {
  position: relative;
}

.shop-btn {
  position: absolute;
  bottom: 20px;
  left: 62%;
  background-color: #005336;
  color: white;
  border: none;
  padding: 12px 25px;
  font-size: 16px;
  border-radius: 1px;
  cursor: pointer;
  font-weight: bold;

  /* Initially hidden */
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.7s ease;
}

.banner:hover .shop-btn {
  opacity: 1;
  transform: translateY(0);
}

.banner {
  position: relative;
  width: 100%;
  margin-top: 20px;
  overflow: hidden;
}

.banner-img {
  width: 100%;
  display: block;
  height: auto;
}

/* Overlay styles */
.overlay {
  position: absolute;
  top: 1150px;
  bottom: 40px;
  left: 50%;
  transform: translateX(-45%);
  color: #b21313ff;
  text-align: center;
}

#countdown {
  display: flex;
  justify-content: center;
  gap: 20px;
  font-size: 24px;
}

.shop-btn1 {
  margin-top: 20px;
  padding: 10px 30px;
  background: #000033;
  color: white;
  font-weight: bold;
  border: none;
  cursor: pointer;
  border-radius: 10px;
  border: 2px solid red;
  

  /* Start hidden */
  opacity: 0;
  transform: translateY(20px);
  transition: all 1.0s ease;
}

/* USPA logo styles */
.uspa-logo {
  position: absolute;
  top: 1000px;
  left: 50%;
  transform: translate(-50%, -50%) scale(0);
  transition: all 2.0s ease;
  max-width: 150px;
  pointer-events: none;
}

/* Hover effects */
.banner1:hover .shop-btn1 {
  opacity: 1;
  transform: translateY(0);
}

.banner1.hovered .uspa-logo {
  transform: translate(-50%, -50%) scale(1);
}



  

  /* Button hover */
  #exploreBtn:hover {
    background-color: darkred;
    transform: scale(1.5);
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

  <button class="icon-btn">🤍</button>
  <button class="icon-btn" onclick="window.location.href='mycart.php'">🛒</button>

  <div class="user-dropdown">
    <?php if ($email): ?>
      <form action="profile.php" method="GET" style="display:inline;">
        <button class="icon-btn" title="My Profile">👤</button>
      </form>
    <?php else: ?>
      <button class="icon-btn" onclick="toggleDropdown()">👤</button>
      <div class="dropdown-menu" id="userMenu">
        <a href="login.php">User Login </a>
        <a href="admin_login.php">Admin Login </a>
      </div>
    <?php endif; ?>
  </div>
</div>

</header>
<br>
<h1><center>ᴇɴᴅ ᴏꜰ ꜱᴇᴀꜱᴏɴ ᴅᴇᴀʟꜱ</center></h1>

<!-- Offer Circles Section -->
<div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; margin: 30px 0;">
  <a href="#" style="text-decoration: none;">
    <div style="width: 120px; height: 120px; border-radius: 50%; background: red; color: white; display: flex; align-items: center; justify-content: center; text-align: center; font-weight: bold; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
      FIRST TIME<br>ON DISCOUNT
    </div>
  </a>
  <a href="#" style="text-decoration: none;">
    <div style="width: 120px; height: 120px; border-radius: 50%; background: red; color: white; display: flex; align-items: center; justify-content: center; text-align: center; font-weight: bold; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
      BUY 2 & GET<br>EXTRA 20% OFF
    </div>
  </a>
  <a href="#" style="text-decoration: none;">
    <div style="width: 120px; height: 120px; border-radius: 50%; background: red; color: white; display: flex; align-items: center; justify-content: center; text-align: center; font-weight: bold; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
      SNEAKERS<br>UNDER ₹3999
    </div>
  </a>
  <a href="#" style="text-decoration: none;">
    <div style="width: 120px; height: 120px; border-radius: 50%; background: red; color: white; display: flex; align-items: center; justify-content: center; text-align: center; font-weight: bold; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
      SPORTS SHOES<br>UNDER ₹3499
    </div>
  </a>
  <a href="#" style="text-decoration: none;">
    <div style="width: 120px; height: 120px; border-radius: 50%; background: red; color: white; display: flex; align-items: center; justify-content: center; text-align: center; font-weight: bold; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
      MUST HAVE<br>SLIDES
    </div>
  </a>
  <a href="#" style="text-decoration: none;">
    <div style="width: 120px; height: 120px; border-radius: 50%; background: red; color: white; display: flex; align-items: center; justify-content: center; text-align: center; font-weight: bold; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
      BACKPACKS
    </div>
  </a>
</div>

<!-- Image Slider -->
<div class="slider animate">
  <img src="https://sslimages.shoppersstop.com/sys-master/root/h72/hb3/32097849770014/levis-web_a1.jpg" class="active" alt="Slider 1">
  <img src="https://media.licdn.com/dms/image/v2/C511BAQF-foLFSXDfNw/company-background_10000/company-background_10000/0/1583990454485/lee_cooper_apparel_footwear_cover?e=2147483647&v=beta&t=FAaeSal_4Y1grFVGF8z8OxyJ3aAgLg7GIi2VSfvTj2A" alt="Slider 1">
  <img src="https://m.media-amazon.com/images/S/aplus-media-library-service-media/7594ac93-e64f-4462-8c05-7ebf21935573.__CR0,0,970,300_PT0_SX970_V1___.jpg" alt="Slider 2">
  <img src="https://images.jdmagicbox.com/comp/temp/deals/fb90a89cf53f36dd2a8ee02c796f10ea-2iztp.jpg" alt="Slider 3">
  <img src="https://www.designeroutletkrakow.pl/fileadmin/user_upload/ros/shops/header_image_-_2340%C3%97585_tommy_hilfiger.jpg" alt="Slider 3">
  <img src="https://3alababak.com/cdn/shop/collections/1d04c876-ee7c-4085-a3ae-3eed92367c1d.__CR0_0_970_300_PT0_SX970_V1____1.jpg?v=1697149921" alt="Slider 3">
</div>
<!--scroller work   -->
<div class="dots">
  <span class="dot active"></span>
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
</div>



<!-- Sale Banner with Countdown Overlay -->
<div class="banner1">
  <img src="uspa-poster.jpg" alt="Sale Banner" class="banner-img">

  <!-- Countdown Overlay -->
  <div class="overlay">
    <p>GET 33% OFF ON EVERY PRODUCT</p>
    <div id="countdown">
      <div><span id="hours">00</span><br><small>HOURS</small></div>
      <div><span id="minutes">00</span><br><small>MINUTES</small></div>
      <div><span id="seconds">00</span><br><small>SECONDS</small></div>
    </div>
    <button class="shop-btn1">
      SHOP NOW <i class="bi bi-handbag-fill"></i>
    </button>
  </div>

  <!-- USPA Logo -->
  <img src="uspa.png" alt="USPA Logo" class="uspa-logo">
</div>

    
    <!-- Sale Banner  -->
<div style="position: relative; width: 100%; margin-top: 20px; overflow: hidden;" class="banner">
  <img src="https://m.media-amazon.com/images/G/31/img2020/fashion/MA2020/ApparelP0/4._CB426496737_.jpg" 
       alt="Sale Banner" 
       style="width: 100%; height: auto; display: block;" 
       class="animate">

  <!-- Button -->
  <button class="shop-btn">
    SHOP NOW <i class="bi bi-handbag-fill"></i>
  </button>
</div>
   
</br>

<!-- Video Banner with Overlay  united colous benetton-->
<div style="position: relative; width: 100%; max-height: 600px; overflow: hidden;">

  <!-- Background video -->
  <video autoplay muted loop playsinline
    style="width: 100%; height: 100%; object-fit: cover; display: block; transition: all 2.6s ease-in-out;">
    <source src="ucb1.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>

  <!-- Overlay with text & button -->
  <div style="
    position: absolute;
    top: 0; left: 170px;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0); 
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: black;
    padding: 20px;
  ">
    
    <!-- Logo -->
    <img src="https://1000logos.net/wp-content/uploads/2020/03/United-Colors-of-Benetton-Logo-1971.png" 
         alt="United Colors of Benetton"
         id="logo"
         style="
           width: 250px; 
           margin-bottom: 5px; 
           opacity: 0.8; 
           transform: scale(1); 
           transition: all 0.6s ease-in-out;
         ">

    <!-- Subheading -->
    <p style="max-width: 700px; font-size: 18px; line-height: 1.5; margin-bottom: 25px;">
      The perennial appeal of Geranium Leaf. First introduced in 1998, our Geranium Leaf Body Care 
      range has grown into a quartet of verdant formulations that remain fresh, vibrant and green.
    </p>

    <!-- Button -->
    <button style="
      background-color: green;
      color: white;
      border: none;
      padding: 12px 35px;
      font-size: 16px;
      border-radius: 2px;
      cursor: pointer;
      font-weight: bold;
      transition: 0.5s ease;
    " id="exploreBtn">
      EXPLORE NOW →
    </button>
  </div>
</div>

    <!--puma banner -->
<div style="position: relative; width: 100%; margin-top: 20px;">
  <img src="https://50-sport.com/wp-content/uploads/2020/02/PUMA_05_CREATIVE04.jpg" alt="Sale Banner" style="width: 100%; height: auto; display: block;" class="animate">
  <!-- Villain banner -->
<div style="position: relative; width: 100%; margin-top: 20px;">
  <!-- Background Image -->
  <img src="villain bg2.jpg" alt="Sale Banner" style="width: 100%; height: auto; display: block;" class="animate">

  <!-- Image placeholder over wood stand -->
  <img id="perfumeImage" src="" 
       style="position: absolute; 
              bottom: 280px; 
              left: 210px; 
              width: 230px; 
              height: 350px; 
              object-fit: contain; 
              display: none; 
              transition: opacity 0.5s ease;" />

  <!-- Buttons Overlay -->
  <div style="position: absolute; bottom: 290px; right: 170px; display: flex; flex-direction: column; align-items: flex-start; gap: 10px;">
    <div id="perfumeButtons" style="display: flex; gap: 10px;">
      <button onclick="showPerfume('villain black1.png','BLACK','descBlack', this)" 
              class="perfume-btn" style="padding: 10px 20px; background: black; color: white; border: 2px solid transparent; border-radius: 5px; cursor: pointer;">BLACK</button>
      <button onclick="showPerfume('villain hydra1.png','HYDRA','descHydra', this)" 
              class="perfume-btn" style="padding: 10px 20px; background: rgba(31, 11, 86, 1); color: white; border: 2px solid transparent; border-radius: 5px; cursor: pointer;">HYDRA</button>
      <button onclick="showPerfume('villain snake.png','SNAKE','descSnake', this)" 
              class="perfume-btn" style="padding: 10px 20px; background: rgba(158, 3, 3, 1); color: white; border: 2px solid transparent; border-radius: 5px; cursor: pointer;">SNAKE</button>
      <button onclick="showPerfume('villain desire.png','DESIRE','descDesire', this)" 
              class="perfume-btn" style="padding: 10px 20px; background: rgba(82, 7, 195, 1); color: white; border: 2px solid transparent; border-radius: 5px; cursor: pointer;">DESIRE</button>
      <button onclick="showPerfume('villain oud.png','OUD','descOud', this)" 
              class="perfume-btn" style="padding: 10px 20px; background: rgba(220, 176, 33, 1); color: white; border: 2px solid transparent; border-radius: 5px; cursor: pointer;">OUD</button>
    </div>
<br>
    <!-- Perfume Description -->
    <div id="perfumeDetails" 
         style="position: absolute; bottom: -150px; right: 10px; max-width: 800px; background: rgba(0,0,0,0); padding: 15px; border-radius: 8px; color: white; text-align: center;">
      <h2 id="perfumeTitle" style="margin: 0; font-size: 20px;"></h2>

      <p id="descBlack" style="display:none; margin-top: 8px; font-size: 14px; line-height: 1.5;">
        Villain Black – Bold and classic fragrance for everyday wear.Bold and classic fragrance for everyday wear.
      </p>
      <p id="descHydra" style="display:none; margin-top: 8px; font-size: 14px; line-height: 1.5;">
        Villain Hydra – Fresh aquatic notes with long-lasting energy that keeps you active all day.
      </p>
      <p id="descSnake" style="display:none; margin-top: 8px; font-size: 14px; line-height: 1.5;">
        Villain Snake – Intense spicy notes crafted for daring personalities who love standing out.
      </p>
      <p id="descDesire" style="display:none; margin-top: 8px; font-size: 14px; line-height: 1.5;">
        Villain Desire – Romantic fragrance with sweet floral tones, perfect for date nights.
      </p>
      <p id="descOud" style="display:none; margin-top: 8px; font-size: 14px; line-height: 1.5;">
        Villain Oud – Premium body essence with a rich aura, crafted for luxury lovers.
      </p>

     
      <!-- Buy Now Button -->
  <button id="buyNowBtn"
        onmouseover="this.style.boxShadow='0 0 20px 5px gold';"
        onmouseout="this.style.boxShadow='';"
        style="margin-top: 15px; padding: 10px 45px; font-size: 14px;
               background: yellow; color: maroon; font-weight: bold;
               border: none; border-radius: 50px; cursor: pointer;
               display: none; transition: box-shadow .3s ease;">
  Get Now <i class="bi bi-lightning-fill"></i>
</button>
    </div>
    
    
  </div>
</div>

   
<!-- Sale Banner  -->
<div style="position: relative; width: 100%; margin-top: 20px; overflow: hidden;">
  <img src="https://www.tcmall.uz/_next/image?url=https%3A%2F%2Ftcmall.uz%2Fstrapi%2Fuploads%2FTH_UZB_web_1920h640_Arina_Starczeva_f52c095f75.jpg&w=3840&q=75" 
       alt="Sale Banner" 
       style="width: 100%; height: auto; display: block;" 
       class="animate">

  <!-- Overlay button -->
  <button style="
    position: absolute;
    bottom: 15%;         /* adjust vertical position */
    right: 19%;          /* adjust horizontal position */
    transform: translateY(50%);
    background-color: #c01a1aff;  /* Tommy Hilfiger navy */
    color: white;
    border: none;
    padding: 10px 17px;
    font-size: 18px;
    border-radius: 1px;
    cursor: pointer;
    font-weight: bold;
    border: 1px solid white;
  ">
    Get Now <i class="bi bi-arrow-bar-right"></i>
  </button>
</div>

  <!-- Red line -->
<hr style="border: none; height: 4px; background-color: #C8252C; margin: 10px 0;">

<!-- Navy blue line -->
<hr style="border: none; height: 4px; background-color: #08233D; margin: 10px 0;">

<!-- card category section -->
<div class="hero-section">
  <h1>ICONS, REINVENTED</h1>
  <p>SHOP THE LATEST & GREATEST</p>

  <div class="icon-grid">
    <div class="icon-card">
      <img src="addcard7.jpg" alt="Puma for Scuderia">
      <div class="icon-title">PUMA FOR SCUDERIA</div>
    </div>
    <div class="icon-card">
      <img src="addcard10.jpg" alt="City Away Kit">
      <div class="icon-title">CITY AWAY KIT</div>
    </div>
    <div class="icon-card">
      <img src="addcard9.jpg" alt="Palermo">
      <div class="icon-title">PALERMO</div>
    </div>
    <div class="icon-card">
      <img src="addcard11.jpg" alt="Nitro">
      <div class="icon-title">NITRO</div>
    </div>
  </div>
</div>
<!-- Full Width Brand Row -->
 <center><h1>TOP BRANDS</h1></center>
<section class="brand-row">
  
  <div class="brand-slider">
     <div class="brand-card">
      <img src="Levis.png" alt="levis">
    </div>
    <div class="brand-card">
      <img src="Adidas.png" alt="Adidas">
    </div>
   
    <div class="brand-card">
      <img src="h&m.png" alt="H&M">
    </div>
    <div class="brand-card">
      <img src="th.png" alt="tommy Hilfiger">
    </div>
    <div class="brand-card">
      <img src="lacoste.png" alt="Lacoste">
    </div>
    <div class="brand-card">
      <img src="gucci.png" alt="Gucci">
    </div>
    <div class="brand-card">
      <img src="nike.png" alt="Nike">
    </div>
    <div class="brand-card">
      <img src="lc.png" alt="Lee Cooper">
    </div>
    <div class="brand-card">
      <img src="lp.png" alt="Louis Phillipe">
    </div>
    <div class="brand-card">
      <img src="uspa1.png" alt="USPA">
    </div>
    <div class="brand-card">
      <img src="bh.png" alt="Being Human">
    </div>
    <div class="brand-card">
      <img src="https://images.seeklogo.com/logo-png/52/1/versace-logo-png_seeklogo-523045.png" alt="USPA">
    </div>
    <div class="brand-card">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQSJDr0LdgPDdZ876hZcoO4H7rVjx85ayCgDA&s" alt="Being Human">
    </div>
    <div class="brand-card">
      <img src="https://images.seeklogo.com/logo-png/37/2/dnmx-logo-png_seeklogo-376164.png" alt="Louis Phillipe">
    </div>
    <div class="brand-card">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyfbPZoMgvopvvCFxTQw8OJlaKvTNGzdID5A&s" alt="USPA">
    </div>
    <div class="brand-card">
      <img src="https://images.seeklogo.com/logo-png/33/1/united-colors-of-benetton-logo-png_seeklogo-334181.png" alt="Being Human">
    </div>
    <div class="brand-card">
      <img src="https://images.seeklogo.com/logo-png/61/2/wrogn-black-logo-png_seeklogo-619818.png" alt="USPA">
    </div>
    <div class="brand-card">
      <img src="https://assets.upstox.com/content/assets/images/logos/NSE_EQ%7CINE611L01021.png" alt="Being Human">

  </div>
</section>

<!-- Product Cards -->
<?php
$sql = "SELECT * FROM product";
$result = $conn->query($sql);
?>
<div class="product-section">
  <h2 class="section-title">All Products</h2>
  <div class="product-grid">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="product-card animate" onclick="window.location.href='product_details.php?product_id=<?php echo $row['product_id']; ?>'">
  <img src="uploads/<?php echo $row['product_image']; ?>" alt="Product Image">
  <h3><?php echo htmlspecialchars($row['name']); ?></h3>
  
  <p class="price">₹<?php echo $row['price']; ?></p>
  
  <button class="add-to-cart-btn"
    onclick="event.stopPropagation(); productdetails(<?php echo $row['product_id']; ?>);">
    Buy Now <i class="bi bi-lightning-fill"></i></i>
  </button>
</div>

    <?php endwhile; ?>
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

  let currentIndex = 0;
let slides = document.querySelectorAll(".slider img");
let dots = document.querySelectorAll(".dot");

function showSlide(index) {
  slides.forEach((slide, i) => {
    slide.classList.remove("active");
    dots[i].classList.remove("active");
    if (i === index) {
      slide.classList.add("active");
      dots[i].classList.add("active");
    }
  });
}

dots.forEach((dot, index) => {
  dot.addEventListener("click", () => {
    currentIndex = index;
    showSlide(currentIndex);
  });
});

// Auto play slider every 3s
setInterval(() => {
  currentIndex = (currentIndex + 1) % slides.length;
  showSlide(currentIndex);
}, 3000);
  function productdetails(productId) {
    // Redirect silently or send an AJAX request (optional)
    window.location.href = 'product_details.php?product_id=' + productId;
  }


  
  const countdownDate = new Date(new Date().getTime() + 10 * 60 * 60 * 1000); // 10 hours from now

  const countdownFunction = setInterval(() => {
    const now = new Date().getTime();
    const distance = countdownDate - now;

    const hours = String(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))).padStart(2, '0');
    const minutes = String(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60))).padStart(2, '0');
    const seconds = String(Math.floor((distance % (1000 * 60)) / 1000)).padStart(2, '0');

    document.getElementById("hours").innerText = hours;
    document.getElementById("minutes").innerText = minutes;
    document.getElementById("seconds").innerText = seconds;

    if (distance < 0) {
      clearInterval(countdownFunction);
      document.getElementById("countdown").innerHTML = "<p>Offer Ended</p>";
    }
  }, 1000);


  // Scroll animation logic
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
    }
  });
}, { threshold: 0.1 });

document.querySelectorAll('.animate').forEach(el => observer.observe(el));

// help button scrol down page
function scrollToBottom(event) {
    event.preventDefault(); // prevent default link action
    window.scrollTo({
      top: document.body.scrollHeight,
      behavior: 'smooth' // for smooth scrolling
    });
  }
  

// Select elements
const banner = document.querySelector('.banner1');
const uspaLogo = document.querySelector('.uspa-logo');

// Flag to keep logo displayed after first hover
let logoShown = false;

banner.addEventListener('mouseenter', () => {
  document.querySelector('.shop-btn1').style.opacity = '1';
  document.querySelector('.shop-btn1').style.transform = 'translateY(0)';

  // Show USPA logo only once
  if (!logoShown) {
    banner.classList.add('hovered');
    logoShown = true;
  }
});

banner.addEventListener('mouseleave', () => {
  // Hide SHOP NOW button
  document.querySelector('.shop-btn1').style.opacity = '0';
  document.querySelector('.shop-btn1').style.transform = 'translateY(20px)';
});



function showPerfume(imageSrc, title, descId, btnElement) {
  // Update bottle image
  const img = document.getElementById("perfumeImage");
  img.src = imageSrc;
  img.style.display = "block";

  // Update title
  document.getElementById("perfumeTitle").innerText = title;

  // Hide all descriptions
  document.querySelectorAll("#perfumeDetails p").forEach(p => p.style.display = "none");

  // Show only the selected one
  document.getElementById(descId).style.display = "block";
  document.getElementById("buyNowBtn").style.display = "inline-block";

  // Highlight active button
  const buttons = document.querySelectorAll(".perfume-btn");
  buttons.forEach(btn => btn.style.border = "2px solid transparent");
  btnElement.style.border = "2px solid white"
}

// Show Black by default
window.onload = function() {
  const firstBtn = document.querySelector(".perfume-btn");
  showPerfume('villain black1.png','BLACK','descBlack', firstBtn);

  const logo = document.getElementById("logo");
    logo.style.opacity = "1";
    logo.style.transform = "scale(1)";
};

 // Logo hover effect with JS
  const logo = document.getElementById("logo");

  logo.addEventListener("mouseover", () => {
    logo.style.opacity = "1";
    logo.style.transform = "scale(1.1)";
  });

  logo.addEventListener("mouseout", () => {
    logo.style.opacity = "0.8";
    logo.style.transform = "scale(0.9)";
  });

  // Button hover effect with JS (instead of inline)
  const exploreBtn = document.getElementById("exploreBtn");

  exploreBtn.addEventListener("mouseover", () => {
    exploreBtn.style.backgroundColor = "darkred";
  });

  exploreBtn.addEventListener("mouseout", () => {
    exploreBtn.style.backgroundColor = "green";
  });
  
</script>



</body>
</html>
