<?php 
require '../db.php';
$id = isset($_GET["id"]) ? $_GET["id"] : (isset($_GET["cusid"]) ? $_GET["cusid"] : null);

if ($id) {
    $sql = "DELETE FROM tblCustomers WHERE cusid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

   if ($stmt->execute() == true) {
    header("Location: ../customer.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

} else {
    echo "No ID provided for deletion.";
}