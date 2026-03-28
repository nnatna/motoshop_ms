<?php require_once dirname(__DIR__) . "/db.php"; ?>

<?php
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$start = $_POST['startdate'] ?? date('Y-m-01');
$end = $_POST['enddate'] ?? date('Y-m-t');

$sql_income = "SELECT SUM(amount) as total FROM tblsales 
               WHERE saledate BETWEEN '$start' AND '$end'";
$res_income = mysqli_query($conn, $sql_income);
$total_income = mysqli_fetch_assoc($res_income)['total'] ?? 0;


$sql_recent = "SELECT * FROM tblsales 
               WHERE saledate BETWEEN '$start' AND '$end' 
               ORDER BY saledate DESC";
$res_recent = mysqli_query($conn, $sql_recent);

$res_brands = mysqli_query($conn, "SELECT COUNT(braid) as total FROM tblbrand");
$total_brands = mysqli_fetch_assoc($res_brands)['total'] ?? 0;

$res_stock = mysqli_query($conn, "SELECT SUM(stock) as total FROM tblmodel
                                  JOIN tblsales ON tblmodel.code_model = tblsales.code_model
                                  WHERE saledate BETWEEN '$start' AND '$end'");
$total_stock = mysqli_fetch_assoc($res_stock)['total'] ?? 0;

$res_low_stock = mysqli_query($conn, "SELECT COUNT(code_model) as total FROM tblmodel WHERE stock <= 5");
$low_stock_count = mysqli_fetch_assoc($res_low_stock)['total'] ?? 0;

$res_customers = mysqli_query($conn, "SELECT COUNT(cusid) as total FROM tblcustomers");
$total_customers = mysqli_fetch_assoc($res_customers)['total'] ?? 0;
//chart data
$sql = "SELECT braname as label, SUM(amount) as y 
        FROM tblsales 
        JOIN tblmodel ON tblsales.code_model = tblmodel.code_model 
        JOIN tblbrand ON tblmodel.braid = tblbrand.braid 
        WHERE saledate BETWEEN '$start' AND '$end' 
        GROUP BY braname";

$result = mysqli_query($conn, $sql);
$dataPoints = array();

while ($row = mysqli_fetch_assoc($result)) {
    $dataPoints[] = array(
        "label" => $row['label'],
        "y" => (float)$row['y']
    );
}
?>