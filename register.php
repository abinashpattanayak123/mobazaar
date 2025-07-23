<?php
require_once "db.php";
if (isset($_POST['submit'])) {
  $fullname = $_POST['fullname'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $alt_mobile = $_POST['alt_mobile'];
  $gender = $_POST['gender'];
  $state = $_POST['state'];
  $address = $_POST['address'];
  $pincode = $_POST['pincode'];
  $age = $_POST['age'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];

  // Optional: Check password match
  if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match');</script>";
  } else {
    // database insertion
    $qry = "INSERT INTO customer(name, email, mobile, alt_mobile, gender, state, address, pincode, age, password) 
            VALUES('$fullname', '$email', '$mobile', '$alt_mobile', '$gender', '$state', '$address', '$pincode', '$age', '$password')";
    $res = $conn->query($qry);
    if ($res) {
        header("Location: login.php?msg=success");
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
   
  }
}
?>
