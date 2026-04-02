<?php
session_start();
if (isset($_SESSION['full_name'])) {;
} else {
    header("Location:../login.php");
}
require("../db.php");
if (isset($_POST["submit"])) {
    $code_model = $_POST["code_model"];
    $braid = $_POST["braid"];
    $modname = $_POST["modname"];
    $color = $_POST["color"];
    $year = $_POST["year"];
    $price = $_POST["price"];
    $act = $_POST["act"];
    $stock = $_POST["stock"];
    $sql = "UPDATE tblModel SET braid=?, modname=?, color=?, year=?, price=?, act=?, stock=? WHERE code_model=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssdsii", $braid, $modname, $color, $year, $price, $act, $stock, $code_model);
    if ($stmt->execute()) {
        if (isset($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
            $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $picture = $code_model . "." . $extension;
            if (move_uploaded_file($_FILES['image']['tmp_name'], "../image/motorcycles/$picture")) {
                $conn->query("UPDATE tblModel SET picture='$picture' WHERE code_model=$code_model");
            }
        }
        header("Location: ../motos.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Motorcycle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/form.css?v=1.0">
    <script src="../assets/js/form.js"></script>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card rounded-4 shadow">
            <div class="bg-dark p-2 text-center m-0 rounded-top-4">
                <h3 class="text-center p-2 text-light fw-bold">Edit Motorcycle</h3>
            </div>
            <?php
            if (!isset($_POST["submit"])) {
                $code_model = $_GET["code_model"];
                $sql = "SELECT * FROM tblModel WHERE code_model=?;";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $code_model);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($row = $result->fetch_assoc()) {
                    $b = $row["braid"];
                    $m = $row["modname"];
                    $c = $row["color"];
                    $y = $row["year"];
                    $p = $row["price"];
                    $a = $row["act"];
                    $s = $row["stock"];
                    $pic = $row["picture"];
            ?>
                    <form method="post" class="p-4" enctype="multipart/form-data">
                        <input type="hidden" name="code_model" value="<?php echo $code_model; ?>">
                        <div class="mb-3">
                            <label for="braid" class="form-label text-muted fw-bold">Brand</label>
                            <select class="form-select" id="braid" name="braid" required>
                                <option value="">--Choose Brand--</option>
                                <?php
                                $sql = "SELECT * FROM tblBrand";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    if ($row["braid"] == $b) {
                                        echo ("<option value='" . $row["braid"] . "' selected>" . $row["braname"] . "</option>");
                                    } else {
                                        echo ("<option value='" . $row["braid"] . "'>" . $row["braname"] . "</option>");
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="modname" class="form-label text-muted fw-bold">Motorcycle</label>
                            <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="modname" name="modname" value="<?php echo ($m); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="color" class="form-label text-muted fw-bold">Color</label>
                            <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="color" name="color" value="<?php echo ($c); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="year" class="form-label shadow-none border-dark-subtle text-muted fw-bold">Year</label>
                            <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="year" name="year" value="<?php echo ($y); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label shadow-none border-dark-subtle text-muted fw-bold">Price</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start-pill shadow-none border-dark-subtle border-end-0 fw-bold text-muted">$</span>
                                <input type="text" class="form-control shadow-none border-dark-subtle border-start-0 rounded-end-pill" id="price" name="price" value="<?php echo ($p); ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="Act" class="form-label text-muted fw-bold">Action</label>
                            <select name="act" id="act" class="form-select shadow-none border-dark-subtle rounded-pill" required>
                                <option value="">Select Action</option>
                                <?php
                                if ($a == "New") {
                                    echo ("<option value='" . $a . "' selected>" . $a . "</option>");
                                    echo ("<option value='Used'>Used</option>");
                                } else {
                                    echo ("<option value='" . $a . "' selected>" . $a . "</option>");
                                    echo ("<option value='New'>New</option>");
                                }
                                ?>

                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label text-muted fw-bold">Stock</label>
                            <input type="number" class="form-control shadow-none border-dark-subtle rounded-pill" id="stock" name="stock" value="<?php echo ($s); ?>" required>
                        </div>

                        <div class="mb-4 text-center border rounded-4 p-2 shadow-sm upload-zone" onclick="document.getElementById('image').click();">
                            <input type="file" class="d-none" id="image" name="image" onchange="showimg()" accept="image/*">
                            <div class="upload-zone-content">
                                <div id="uploadPlaceholder" class="p-2 <?php echo !empty($pic) ? 'd-none' : ''; ?>">
                                    <i class="fa-solid fa-cloud-arrow-up text-primary mb-2" style="font-size: 3rem;"></i>
                                </div>
                                <img src="<?php echo !empty($pic) ? '../image/motorcycles/' . $pic : ''; ?>"
                                    id="previewImage"
                                    class="shadow-sm <?php echo empty($pic) ? 'd-none' : ''; ?>"
                                    style="width: 80px; height: 80px; object-fit: cover;"
                                    alt="Preview">
                            </div>
                            <p class="mb-0 text-muted small">Click to browse motorcycle photo</p>
                        </div>

                        <div class="d-flex gap-2 justify-content-around mt-3">
                            <input type="submit" value="Save Changes" name="submit" class="btn btn-success w-100 rounded-pill">
                            <a href="../motos.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
                        </div>
                    </form>
        </div>
<?php
                }
            }
?>
    </div>
    <script src="../assets/js/form.js"></script>
</body>

</html>