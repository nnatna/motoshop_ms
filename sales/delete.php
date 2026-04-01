<?php 
require '../db.php';
if (isset($_GET["id"])) {
    $saleid = $_GET["id"];
    $sql_check = "SELECT quantity, code_model FROM tblSales WHERE saleid = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $saleid);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    
    if ($row_check = $result_check->fetch_assoc()) {
        $quantity = (int)$row_check['quantity'];
        $code_model = (int)$row_check['code_model'];
        $sql_update = "UPDATE tblModel SET stock = stock + ? WHERE code_model = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $quantity, $code_model);
        $stmt_update->execute();
    }
    $sql = "DELETE FROM tblSales WHERE saleid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $saleid);
    if ($stmt->execute()) {
        header("Location: ../sales.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>