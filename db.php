<?php
$host = "127.0.0.1";
$user = "root";
$password = "";
$dbname = "mobazaar";

try {
    $conn = new mysqli($host, $user, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
    //echo "✅ Connection successful!";
} catch (Exception $e) {
    
    echo "❌ Error: " . $e->getMessage();
}
?>
