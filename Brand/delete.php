
<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
require '../db.php';
if (($_SESSION["role"] ?? "User") == "Admin") {
    $braid = $_GET["braid"];
    $sql = "delete from tblbrand where braid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $braid);
    if ($stmt->execute()) {
        header("Location: ../brand.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $error = "You do not have permission to delete a brand.";
    header("Location: ../brand.php?error=" . urlencode($error));
    exit();
}
?>
