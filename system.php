<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
require "db.php";
if (isset($_POST['btnsubmit'])) {
    if (($_SESSION["role"] ?? "User") == "Admin") {
        $shop = $_POST['shop'];

        $sql = "UPDATE tbllogo SET shop=? WHERE id=1";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $shop);
        if ($stmt->execute()) {
            if (isset($_FILES['logo']) && !empty($_FILES['logo']['tmp_name'])) {
                $ext = pathinfo($_FILES['logo']['name'], PATHINFO_EXTENSION);
                $logo = "logo." . $ext;
                if (move_uploaded_file($_FILES['logo']['tmp_name'], "image/logo/" . $logo)) {
                    $conn->query("UPDATE tbllogo SET logo='$logo' WHERE id=1");
                }
            }
            $success = "Settings updated successfully!";
        } else {
            $error = "Error updating settings: " . $conn->error;
        }
    } else {
        $error = "You do not have permission to update settings.";
    }
}
$sql = "SELECT * FROM tbllogo WHERE id = 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$id = $stmt->get_result()->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto Shop Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/layout.css?v=<?php echo time() ?>">
    <script src="./assets/js/layout.js?v=<?php echo time() ?>"></script>
    <script src="./assets/js/form.js?v=<?php echo time() ?>"></script>
</head>

<body>
    <?php include 'layout/header.php'; ?>
    <div class="main-wrapper">
        <?php include 'layout/sidebar.php'; ?>
        <main class="content-wrapper d-flex">
            <div class="col-lg-3 p-4">
                <div>
                    <h3 class="fw-bold text-success"><i class="fa-solid fa-gear me-1"></i>Settings</h3>
                    <p class="text-muted">Manage system settings and configurations</p>
                </div>
                <?php include 'layout/setting_sidebar.php'; ?>
            </div>
            <div class="col-lg-9 p-4 border-start">
                <div class="d-flex justify-content-center align-items-center">
                    <div class="col-md-6">
                        <div class="text-center">
                            <div class="position-relative d-inline-block">
                                <img src="image/logo/<?php echo $id['logo'] ?: 'default.jpg'; ?>"
                                    id="picture"
                                    class="rounded-circle img-thumbnail"
                                    style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;"
                                    onclick="document.getElementById('logo').click();">
                                <div class="position-absolute bottom-0 end-0 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                    style="width: 40px; height: 40px; cursor: pointer; border: 3px solid white;"
                                    onclick="document.getElementById('logo').click();">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>
                            <p class="text-muted small mt-2">Click Logo to change</p>
                        </div>


                        <form method="post" class="p-4" enctype="multipart/form-data">
                            <div class="mb-3">
                                <?php if (isset($error)): ?>
                                    <div class="alert alert-danger py-2 text-center"><?php echo $error; ?></div>
                                <?php endif; ?>
                                <?php if (isset($success)): ?>
                                    <div class="alert alert-success py-2 text-center"><?php echo $success; ?></div>
                                <?php endif; ?>
                            </div>
                            <input type="file" name="logo" id="logo" class="d-none" onchange="showimg()" accept="image/*">

                            <div class="mb-3">
                                <label class="form-label text-muted fw-bold d-block text-start">Shop Name</label>
                                <input type="text" class="form-control rounded-pill shadow-none border-dark-subtle"
                                    name="shop" value="<?php echo $id['shop']; ?>" required>
                            </div>

                            <div class="d-flex gap-2 justify-content-around mt-3">
                                <button type="submit" name="btnsubmit" class="btn btn-success w-100 rounded-pill fw-bold">Update Settings</button>
                                <a href="settings.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include 'layout/footer.php'; ?>
</body>

</html>