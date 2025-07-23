<?php
session_start();
require_once "db.php";

$email = $_SESSION['email'] ?? null;
if (!$email) {
  header("Location: login.php");
  exit();
}

// Fetch user address
$address = '';
$stmt = $conn->prepare("SELECT address FROM customer WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($address);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Payment - MoBazaar</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap CSS for Spinner -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #fff;
      margin: 0;
      padding: 30px;
      color: #000;
      animation: fadeIn 0.8s ease;
    }

    h2 {
      color: red;
      text-align: center;
      margin-bottom: 30px;
      animation: slideDown 0.6s ease;
    }

    .payment-options {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      margin-bottom: 40px;
    }

    .payment-option {
      padding: 15px 30px;
      background: #000;
      color: white;
      border: 2px solid transparent;
      font-size: 16px;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .payment-option:hover,
    .payment-option.selected {
      background: red;
      border-color: black;
      transform: scale(1.05);
    }

    .address-box {
      max-width: 600px;
      margin: auto;
      background: #f4f4f4;
      padding: 20px;
      border-left: 5px solid red;
      border-radius: 6px;
      margin-bottom: 30px;
      position: relative;
      animation: slideUp 0.5s ease;
    }

    .address-box input[type="text"] {
      width: 100%;
      padding: 10px;
      font-size: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
      background: #fff;
      transition: border 0.3s;
    }

    .edit-btn {
      position: absolute;
      top: 15px;
      right: 15px;
      background: red;
      color: #fff;
      border: none;
      padding: 6px 12px;
      border-radius: 4px;
      cursor: pointer;
      font-size: 14px;
    }

    .edit-btn:hover {
      background-color: #c40000;
    }

    .place-order-btn {
      display: block;
      margin: auto;
      padding: 12px 30px;
      font-size: 18px;
      background-color: #000;
      color: white;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: 0.3s;
    }

    .place-order-btn:hover {
      background-color: red;
      transform: scale(1.05);
    }

    .popup {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.6);
      justify-content: center;
      align-items: center;
      z-index: 999;
    }

    .popup-content {
      background: white;
      padding: 30px 40px;
      border-radius: 10px;
      text-align: center;
      animation: fadeIn 0.4s ease;
    }

    .popup-content h3 {
      color: red;
      margin-bottom: 10px;
    }

    @keyframes fadeIn {
      from { transform: scale(0.8); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    @keyframes slideDown {
      from { transform: translateY(-20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideUp {
      from { transform: translateY(20px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }
  </style>
</head>
<body>

<h2>Choose Payment Method</h2>

<div class="payment-options">
  <button class="payment-option" onclick="selectPayment(this)">Cash on Delivery <i class="bi bi-wallet2"></i></button>
  <button class="payment-option" onclick="selectPayment(this)">Credit Card <i class="bi bi-credit-card"></i></button>
  <button class="payment-option" onclick="selectPayment(this)">Debit Card <i class="bi bi-credit-card-2-front"></i></button>
  <button class="payment-option" onclick="selectPayment(this)">UPI <i class="bi bi-paypal"></i></button>
  <button class="payment-option" onclick="selectPayment(this)">Net Banking <i class="bi bi-bank"></i></button>
</div>

<div class="address-box">
  <label for="address" style="font-weight: bold; margin-bottom: 8px; display: block;">Shipping Address:</label>
  <input type="text" id="address" value="<?php echo htmlspecialchars($address); ?>" readonly>
  <button class="edit-btn" onclick="editAddress()">Edit <i class="bi bi-pencil"></i></button>
</div>

<!-- Updated Button with Spinner -->
<button class="place-order-btn" onclick="placeOrder()" id="placeOrderBtn">
  <span id="orderSpinner" class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true"></span>
  <span id="orderText">Place Order</span> <i class="bi bi-check-circle"></i>
</button>

<!-- Thank You Popup -->
<div class="popup" id="popup">
  <div class="popup-content">
    <h3>Thank You!</h3>
    <p>Thank you for choosing <strong>MoBazaar</strong> 🛍️</p>
  </div>
</div>

<script>
  function selectPayment(btn) {
    document.querySelectorAll('.payment-option').forEach(opt => opt.classList.remove('selected'));
    btn.classList.add('selected');
  }

  function editAddress() {
    const input = document.getElementById("address");
    if (input.hasAttribute("readonly")) {
      input.removeAttribute("readonly");
      input.focus();
    } else {
      input.setAttribute("readonly", true);
      // You can use AJAX here to save the address if needed
    }
  }

  function placeOrder() {
    const btn = document.getElementById("placeOrderBtn");
    const spinner = document.getElementById("orderSpinner");
    const text = document.getElementById("orderText");

    // Show spinner and disable button
    spinner.classList.remove("d-none");
    text.textContent = "Placing...";
    btn.disabled = true;

    // Simulate 3-second delay before popup
    setTimeout(() => {
      spinner.classList.add("d-none");
      const popup = document.getElementById("popup");
      popup.style.display = "flex";

      // Redirect to home after 2.5 seconds
      setTimeout(() => {
        popup.style.display = "none";
        window.location.href = "home.php";
      }, 2500);
    }, 3000);
  }
</script>

</body>
</html>
