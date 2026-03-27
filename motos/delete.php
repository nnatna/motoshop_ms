<?php require '../db.php';
$code_model = $_GET["code_model"];
$sql = "delete from tblModel where code_model=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $code_model);
if ($stmt->execute() == true) {
    header("Location: ../motos.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
