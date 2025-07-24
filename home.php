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
    transition: all 0.8s ease-in-out;
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
  <button class="icon-btn" onclick="window.location.href='mycart.php'">🛒</button>

  <div class="user-dropdown">
    <?php if ($email): ?>
      <form action="profile.php" method="GET" style="display:inline;">
        <button class="icon-btn" title="My Profile">👤</button>
      </form>
    <?php else: ?>
      <button class="icon-btn" onclick="toggleDropdown()">👤</button>
      <div class="dropdown-menu" id="userMenu">
        <a href="login.php">User Login <i class="bi bi-box-arrow-in-right"></i></a>
        <a href="admin_login.php">Admin Login <i class="bi bi-box-arrow-in-right"></i></a>
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
  <img src="sliderimg.jpeg" class="active" alt="Slider 1">
  <img src="slider22.jpg" alt="Slider 2">
  <img src="slider33.jpg" alt="Slider 3">
</div>
<!--blank space   -->




<!-- Sale Banner with Countdown Overlay -->
<div style="position: relative; width: 100%; margin-top: 20px;">
  <img src="countdown.jpeg" alt="Sale Banner" style="width: 100%; height: auto; display: block;" class="animate">

  <!-- Countdown Overlay -->
  <div style="position: absolute; right: 50px; top: 50%; transform: translateY(-50%); color: black; text-align: center;">
    <h2 style="font-size: 32px; margin-bottom: 10px;">AFTER HOUR STEALS</h2>
    <p style="margin-bottom: 10px;">Auto-applied at checkout</p>
    <p style="font-size: 14px; margin-bottom: 20px;">Ends in</p>
    <div style="display: flex; gap: 20px; font-size: 24px;" id="countdown">
      <div><span id="hours">00</span><br><small>HOURS</small></div>
      <div><span id="minutes">00</span><br><small>MINUTES</small></div>
      <div><span id="seconds">00</span><br><small>SECONDS</small></div>
    </div>
    <button style="margin-top: 20px; padding: 10px 20px; background: white; color: black; font-weight: bold; border: none; cursor: pointer;">SHOP NOW <i class="bi bi-handbag-fill"></i> </button>
  </div>
</div>
    </br>
<!-- banner1-->
<video autoplay muted loop playsinline
  style="width: 100%; max-height: 500px; object-fit: cover; display: block; border-radius: 1px;"
  class="animate">
  <source src="h&m.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
    




<!-- Sale Banner  -->
<div style="position: relative; width: 100%; margin-top: 20px;">
  <img src="sale1.jpeg" alt="Sale Banner" style="width: 100%; height: auto; display: block;" class="animate">
    </br>
  <!-- banner1-->
<video autoplay muted loop playsinline
  style="width: 100%; max-height: 600px; object-fit: cover; display: block; border-radius: 1px;"
  class="animate">
  <source src="skechers.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
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

  // Slider logic
  const slides = document.querySelectorAll(".slider img");
  let index = 0;
  setInterval(() => {
    slides[index].classList.remove("active");
    index = (index + 1) % slides.length;
    slides[index].classList.add("active");
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

</script>



</body>
</html>
