<?php require_once dirname(__DIR__) . "/db.php"; ?>

<?php
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$res_income = mysqli_query($conn, "SELECT SUM(amount) as total FROM tblsales");
$total_income = mysqli_fetch_assoc($res_income)['total'] ?? 0;

$res_brands = mysqli_query($conn, "SELECT COUNT(braid) as total FROM tblbrand");
$total_brands = mysqli_fetch_assoc($res_brands)['total'] ?? 0;

$res_stock = mysqli_query($conn, "SELECT SUM(stock) as total FROM tblmodel");
$total_stock = mysqli_fetch_assoc($res_stock)['total'] ?? 0;

$res_customers = mysqli_query($conn, "SELECT COUNT(cusid) as total FROM tblcustomers");
$total_customers = mysqli_fetch_assoc($res_customers)['total'] ?? 0;

$res_low_stock = mysqli_query($conn, "SELECT COUNT(code_model) as total FROM tblmodel WHERE stock <= 5");
$low_stock_count = mysqli_fetch_assoc($res_low_stock)['total'] ?? 0;
?>