<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard - MoBazaar</title>
  <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['is_admin'])) {
    header("Location: admin_login.php");
    exit;
}
?>
  <header class="admin-header">
    <h1>MoBazaar Admin Panel</h1>
    <form action="admin_logout.php" method="post">
      <button class="logout-btn" type="submit">Logout</button>
    </form>
  </header>

  <main class="admin-main">
    <h2 class="dashboard-title">Dashboard Overview</h2>
    <div class="card-container">
      <a href="addproduct.php" class="card">
        <h3>Add Data</h3>
        <p>Add new products or categories</p>
      </a>

      <a href="admin_manage_product.php" class="card">
        <h3>Modify Data</h3>
        <p>View all available data</p>
      </a>

      <a href="show_customers.php" class="card">
        <h3>Show Customers</h3>
        <p>View all registered customers</p>
      </a>

      <a href="delete_customer.php" class="card">
        <h3>Delete Customer</h3>
        <p>Remove specific customer data</p>
      </a>

      <a href="sale_entry.php" class="card">
        <h3>Sale Entry</h3>
        <p>Insert sales records</p>
      </a>

      <a href="sales_status.php" class="card">
        <h3>Sales Status</h3>
        <p>View sales summaries</p>
      </a>
    </div>
  </main>
</body>
</html>
