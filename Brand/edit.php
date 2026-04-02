<?php
session_start();
if (isset($_SESSION['full_name'])) {
} else {
    header("Location:../login.php");
}
if (($_SESSION["role"] ?? "User") == "Admin") {
} else {
    $error = "You do not have permission to edit this brand.";
    header("Location: ../brand.php?error=" . urlencode($error));
    exit();
}
require("../db.php");
if (isset($_POST['submit'])) {
    require("../db.php");
    $braid = $_POST["braid"];
    $braname = $_POST["brname"];

    $sql_check = "SELECT braname FROM tblbrand WHERE braname = ? AND braid != ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("si", $braname, $braid);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($row = $result_check->fetch_assoc()) {
        $error_msg = "Brand name already exists. Please choose another.";
    }
    $sql = "UPDATE tblbrand SET braname=? WHERE braid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $braname, $braid);
    if ($stmt->execute()) {
        header("Location: ../brand.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Brand</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/form.css">
    <script src="../assets/js/form.js"></script>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow rounded-4">
            <div class="bg-dark p-2 text-center m-0 rounded-top-4">
                <h3 class="text-center text-light fw-bold">Edit Brand</h3>
            </div>

            <?php
            require("../db.php");
            $braid = $_GET["braid"];
            $sql = "SELECT * FROM tblbrand WHERE braid=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $braid);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                $b = $row["braname"];
            ?>

                <form method="post" class="p-4">
                    <div>
                        <?php
                        if (isset($error_msg)) {
                            echo "<div class='alert alert-danger p-1 text-center'>$error_msg</div>";
                        }
                        ?>
                    </div>
                    <input type="hidden" name="braid" value="<?= htmlspecialchars($braid) ?>">
                    <div class="mb-3">
                        <label for="braname" class="form-label text-muted fw-bold">Brand Name</label>
                        <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="braname" name="brname" value="<?= htmlspecialchars($b) ?>" required>
                    </div>

                    <div class="d-flex gap-2 justify-content-start mt-3">
                        <button type="submit" name="submit" class="btn btn-success w-100 rounded-pill">Save Changes</button>
                        <a href="../brand.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
                    </div>
                </form>
        </div>
    <?php
            }
    ?>
    </div>
</body>

</html>