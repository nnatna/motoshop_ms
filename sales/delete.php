<?php 
require '../db.php';
if (isset($_GET["id"])) {
    $saleid = $_GET["id"];
    $sql_check = "SELECT quantity, code_model FROM tblSales WHERE saleid = ?";
    $stmt_check = $conn->prepare($sql_check);
    if (!$stmt_check) {
        echo "Error preparing statement for check: " . $conn->error;
        exit();
    }
    $stmt_check->bind_param("i", $saleid);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($row_check = $result_check->fetch_assoc()) {
        $quantity = (int) $row_check['quantity'];
        $code_model = (int) $row_check['code_model'];
        
        // Update stock in tblModel
        $sql_update = "UPDATE tblModel SET stock = stock + ? WHERE code_model = ?";
        $stmt_update = $conn->prepare($sql_update);
        if (!$stmt_update) {
            echo "Error preparing statement for update: " . $conn->error;
            $stmt_check->close();
            exit();
        }
        $stmt_update->bind_param("ii", $quantity, $code_model);
        if (!$stmt_update->execute()) {
            echo "Error updating stock: " . $stmt_update->error;
            $stmt_update->close();
            $stmt_check->close();
            exit();
        }
        $stmt_update->close();
    }
    $stmt_check->close(); // Close the check statement

    // Delete the sales record
    $sql_delete = "DELETE FROM tblSales WHERE saleid = ?";
    $stmt_delete = $conn->prepare($sql_delete);
    if (!$stmt_delete) {
        echo "Error preparing statement for delete: " . $conn->error;
        exit();
    }
    $stmt_delete->bind_param("i", $saleid);
    if ($stmt_delete->execute()) {
        header("Location: ../sales.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . $stmt_delete->error;
    }
    $stmt_delete->close();
}
$conn->close();
?>