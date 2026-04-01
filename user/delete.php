<?php require '../db.php';
$userid = $_GET["userid"];
$sql = "delete from tblUser where userid=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
if ($stmt->execute() == true) {
    header("Location: ../user.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}