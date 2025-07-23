<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MoBazaar Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
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
      width: 100%;
      max-width: 400px;
    }

    .login-box h2 {
      text-align: center;
      margin-bottom: 25px;
      color:rgb(203, 7, 7);
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

    input[type="text"]:focus,
    input[type="password"]:focus {
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
      background-color:rgb(251, 10, 10);
      color: #000;
      border: none;
      padding: 10px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }

    .login-btn:hover {
      background-color:rgb(215, 4, 4);
    }

    .register-link {
      text-align: center;
      margin-top: 15px;
    }

    .register-link a {
      color:rgb(237, 52, 6);
      text-decoration: none;
    }

    .register-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-box">
    <h2>Login to MoBazaar</h2>
    <form method="POST" action="login.php">
      <div class="form-group">
        <label for="userid">Email ID <i class="bi bi-envelope-at"></i></label>
        <input type="text" id="userid" name="email" required />
      </div>

      <div class="form-group">
        <label for="password">Password <i class="bi bi-lock"></i></label>
        <input type="password" id="password" name="password" required />
      </div>

      <div class="checkbox-group">
        <input type="checkbox" id="showPassword" onclick="togglePassword()" />
        <label for="showPassword">Show Password</label>
      </div>

      <button type="submit" class="login-btn" name="login">Login </button>
    </form>

    <div class="register-link">
      New User? <a href="register.html">Register Here</a>
    </div>
  </div>

  <?php
  session_start();
require_once "db.php"; // Assuming this file contains database connection details

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $dis = "SELECT * FROM customer";
    $ress = $conn->query($dis);
    if ($ress->num_rows > 0) {
        while ($data = $ress->fetch_assoc()) {
             if($data['email']==$email && $data['password']==$password ){
              $_SESSION['email'] = $email; // Set session variable for emailid
              header("Location: home.php");
              exit;
             }
        }
    } 
    // If user not found or login fails, redirect back to login page
    header("Location: login.php?error=1");
    exit;
}
  
  
  
  ?>

  <script>
    function togglePassword() {
      const passwordField = document.getElementById("password");
      if (passwordField.type === "password") {
        passwordField.type = "text";
      } else {
        passwordField.type = "password";
      }
    }
  </script>

</body>
</html>
