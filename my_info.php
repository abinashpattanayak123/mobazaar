<?php 
session_start(); 
require_once "db.php";

$email = $_SESSION['email'];  

// ✅ Handle Update Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = $_POST['name'];
    $mobile  = $_POST['mobile'];
    $address = $_POST['address'];

    $updateSql = "UPDATE customer SET name=?, mobile=?, address=? WHERE email=?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssss", $name, $mobile, $address, $email);

    if ($stmt->execute()) {
        $successMsg = "Profile updated successfully!";
    } else {
        $errorMsg = "Error updating profile.";
    }
}

// ✅ Fetch Current Data
$sql = "SELECT * FROM customer WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("No user found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Profile - MoBazaar</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f8f8f8;
      margin: 0;
      padding: 0;
    }
    .profile-container {
      max-width: 600px;
      margin: 50px auto;
      background: #fff;
      border: 2px solid #e60000;
      border-radius: 12px;
      padding: 25px;
      box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
    }
    h2 {
      color: #e60000;
      text-align: center;
      margin-bottom: 20px;
    }
    label {
      font-weight: bold;
      color: #333;
    }
    input, textarea {
      width: 100%;
      padding: 10px;
      margin: 8px 0 15px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }
    input[readonly] {
      background: #f0f0f0;
      cursor: not-allowed;
    }
    button {
      background: #e60000;
      color: white;
      font-size: 16px;
      padding: 12px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: 0.3s;
      width: 100%;
    }
    button:hover {
      background: black;
    }
    .msg {
      text-align: center;
      margin-bottom: 15px;
      font-weight: bold;
    }
    .success { color: green; }
    .error { color: red; }
  </style>
</head>
<body>
  <div class="profile-container">
    <h2> My Information </h2>

    <?php if(isset($successMsg)) echo "<p class='msg success'>$successMsg</p>"; ?>
    <?php if(isset($errorMsg)) echo "<p class='msg error'>$errorMsg</p>"; ?>

    <form method="post">
      <label>Name:</label>
      <input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>

      <label>Email:</label>
      <input type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" readonly>

      <label>Phone:</label>
      <input type="text" name="mobile" value="<?php echo htmlspecialchars($row['mobile']); ?>" required>

      <label>Address:</label>
      <textarea name="address" rows="3" required><?php echo htmlspecialchars($row['address']); ?></textarea>

      <button type="submit">Update Profile <i class="bi bi-database-fill-down"></i></button>
    </form>
  </div>
</body>
</html>
