<?php
require '../db.php';
$id = isset($_GET["id"]) ? $_GET["id"] : (isset($_GET["cusid"]) ? $_GET["cusid"] : null);

if ($id) {
    $sql_check = "SELECT cusid FROM tblCustomers WHERE cusid = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($row_check = $result_check->fetch_assoc()) {
        $sql_sales = "SELECT COUNT(*) as total FROM tblSales WHERE cusid = ?";
        $stmt_sales = $conn->prepare($sql_sales);
        $stmt_sales->bind_param("i", $id);
        $stmt_sales->execute();
        if ($stmt_sales->get_result()->fetch_assoc()['total'] > 0) {
            $error = "Cannot delete customer because they have existing sales records. Delete the sales history first.";
            header("Location: ../customer.php?error=" . urlencode($error));
            exit();
        }

        $sql = "DELETE FROM tblCustomers WHERE cusid = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute() == true) {
            header("Location: ../customer.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $error = "Customer with ID " . $id . " not found.";
        header("Location: ../customer.php?error=" . urlencode($error));
        exit();
    }
} else {
    echo "No ID provided for deletion.";
}
