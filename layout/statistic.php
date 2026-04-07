<?php require_once dirname(__DIR__) . "/db.php"; ?>

<?php
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$start = $_POST['startdate'] ?? date('Y-m-01');
$end = $_POST['enddate'] ?? date('Y-m-t');

$sql_income = "SELECT SUM(amount) as total FROM tblsales 
               WHERE saledate BETWEEN ? AND ?";
$stmt_income = $conn->prepare($sql_income);
$stmt_income->bind_param("ss", $start, $end);
$stmt_income->execute();
$total_income = $stmt_income->get_result()->fetch_assoc()['total'] ?? 0;


$sql_recent = "SELECT * FROM tblsales 
               WHERE saledate BETWEEN ? AND ? 
               ORDER BY saledate DESC";
$stmt_recent = $conn->prepare($sql_recent);
$stmt_recent->bind_param("ss", $start, $end);
$stmt_recent->execute();
$res_recent = $stmt_recent->get_result();

$res_brands = mysqli_query($conn, "SELECT COUNT(braid) as total FROM tblbrand");
$total_brands = mysqli_fetch_assoc($res_brands)['total'] ?? 0;

$res_stock = mysqli_query($conn, "SELECT SUM(stock) as total FROM tblmodel");
$total_stock = mysqli_fetch_assoc($res_stock)['total'] ?? 0;

$threshold = 5;
$sql_low_stock = "SELECT COUNT(*) as total FROM tblmodel WHERE stock <= ?";
$stmt_low = $conn->prepare($sql_low_stock);
$stmt_low->bind_param("i", $threshold);
$stmt_low->execute();
$low_stock_count = $stmt_low->get_result()->fetch_assoc()['total'] ?? 0;

$sql_sold = "SELECT SUM(quantity) as total FROM tblsales
             WHERE saledate BETWEEN ? AND ?";
$stmt_sold = $conn->prepare($sql_sold);
$stmt_sold->bind_param("ss", $start, $end);
$stmt_sold->execute();
$total_sold = $stmt_sold->get_result()->fetch_assoc()['total'] ?? 0;

$sql_hard = "SELECT COUNT(*) as total FROM tblmodel m 
             LEFT JOIN tblsales s ON m.code_model = s.code_model AND s.saledate BETWEEN ? AND ? 
             WHERE s.code_model IS NULL";
$stmt_hard = $conn->prepare($sql_hard);
$stmt_hard->bind_param("ss", $start, $end);
$stmt_hard->execute();
$hard_to_sell_count = $stmt_hard->get_result()->fetch_assoc()['total'] ?? 0;

$res_customers = mysqli_query($conn, "SELECT COUNT(cusid) as total FROM tblcustomers");
$total_customers = mysqli_fetch_assoc($res_customers)['total'] ?? 0;
//chart data
$sql_brand = "SELECT braname as label, SUM(amount) as y 
        FROM tblsales 
        JOIN tblmodel ON tblsales.code_model = tblmodel.code_model 
        JOIN tblbrand ON tblmodel.braid = tblbrand.braid 
        WHERE saledate BETWEEN ? AND ? 
        GROUP BY braname";

$stmt_brand = $conn->prepare($sql_brand);
$stmt_brand->bind_param("ss", $start, $end);
$stmt_brand->execute();
$result_brand = $stmt_brand->get_result();
$dataPoints = array();

while ($row = mysqli_fetch_assoc($result_brand)) {
    $dataPoints[] = array(
        "label" => $row['label'],
        "y" => (float)$row['y']
    );
}

// Employee chart data
$sql_employee = "SELECT u.full_name as label, SUM(s.amount) as y 
        FROM tblsales s 
        JOIN tbluser u ON s.userid = u.userid 
        WHERE s.saledate BETWEEN ? AND ? 
        GROUP BY u.userid, u.full_name";

$stmt_employee = $conn->prepare($sql_employee);
$stmt_employee->bind_param("ss", $start, $end);
$stmt_employee->execute();
$result_employee = $stmt_employee->get_result();
$employeeDataPoints = array();

while ($row = mysqli_fetch_assoc($result_employee)) {
    $employeeDataPoints[] = array(
        "label" => $row['label'],
        "y" => (float)$row['y']
    );
}
?>