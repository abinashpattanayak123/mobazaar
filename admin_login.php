<?php
session_start();

// If already logged in, redirect directly to dashboard
if (isset($_SESSION['is_admin'])) {
    header("Location: admin_dashboard.php");
    exit;
}

// Login logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin_login'])) {
    $email = $_POST['admin_email'];
    $password = $_POST['admin_password'];

    // Hardcoded credentials
    $adminEmail = "admin@gmail.com";
    $adminPassword = "admin";

    if ($email === $adminEmail && $password === $adminPassword) {
        $_SESSION['is_admin'] = true; // Start admin session
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login - MoBazaar</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background-color: #000;
      color: #fff;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .login-box {
      background-color: #111;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(255, 69, 0, 0.3);
      max-width: 400px;
      width: 90%;
    }
    .login-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color: rgb(203, 7, 7);
    }
    .form-group {
      margin-bottom: 18px;
    }
    label {
      display: block;
      margin-bottom: 6px;
      font-weight: bold;
    }
    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
    }
    input:focus {
      outline: none;
      border: 2px solid red;
    }
    .checkbox-group {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 20px;
    }
    .login-btn {
      width: 100%;
      background-color: rgb(251, 10, 10);
      color: #000;
      border: none;
      padding: 10px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }
    .login-btn:hover {
      background-color: rgb(215, 4, 4);
    }
    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="login-box">
    <h2>Admin Login</h2>
    <form method="POST" action="admin_login.php">
      <div class="form-group">
        <label for="admin_email">Admin Email</label>
        <input type="text" id="admin_email" name="admin_email" required />
      </div>

      <div class="form-group">
        <label for="admin_password">Password</label>
        <input type="password" id="admin_password" name="admin_password" required />
      </div>

      <div class="checkbox-group">
        <input type="checkbox" id="showPassword" onclick="togglePassword()" />
        <label for="showPassword">Show Password</label>
      </div>

      <button type="submit" class="login-btn" name="admin_login">Login</button>
      <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
      <?php endif; ?>
    </form>
  </div>

  <script>
    function togglePassword() {
      const password = document.getElementById("admin_password");
      password.type = password.type === "password" ? "text" : "password";
    }
  </script>
</body>
</html>
