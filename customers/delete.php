<?php 
require '../db.php';

// ១. ពិនិត្យមើលថា តើក្នុង URL គេប្រើពាក្យ 'id' ឬ 'cusid'
// បើក្នុងប៊ូតុងលុបសរសេរថា delete.php?id=... ត្រូវប្រើ $_GET["id"]
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