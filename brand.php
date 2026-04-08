<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
require "db.php";
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}
if (isset($_POST['btnsubmit'])) {
    if (($_SESSION["role"] ?? "User") == "Admin") {
    $braname = $_POST['braname'];

    $sql = "INSERT INTO tblbrand (braname) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $braname);
    if ($stmt->execute()) {
        $success = "Brand added successfully!";
    } else {
        $error = "Error adding brand: " . $conn->error;
    }
} else {
    $error = "You do not have permission to add a brand.";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moto Shop Management System</title>
    <link rel="stylesheet" href="../assets/bootstrap-5.3.8/css/bootstrap.min.css?v=<?php echo time() ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/layout.css?v=1">
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
                        <h4 class="fw-bold text-success">
                            <i class="fa-solid fa-tags me-1"></i>Brand Settings
                        </h4>
                        <p class="text-muted">Manage motorcycle brands and their details</p>

                        <form method="post" class="d-flex justify-content-md-start align-items-center mb-4" enctype="multipart/form-data">
                            <input type="text" name="braname" class="form-control rounded-start-pill shadow-none border-dark-subtle" placeholder="Brand Name" required>
                            <button type="submit" name="btnsubmit" class="btn btn-success rounded-end-pill fw-bold">
                                <i class="bi-plus-circle me-1"></i>
                            </button>
                        </form>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger py-2 mx-4 text-center"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success py-2 mx-4 text-center"><?php echo $success; ?></div>
                        <?php endif; ?>
                        <div class="card table-responsive bg-white rounded-4 p-3">
                            <table class="table table-hover align-middle">
                                <tr class="table-secondary">
                                    <th>Brand ID</th>
                                    <th>Brand Name</th>
                                    <th class="text-center">Options</th>
                                </tr>
                                <?php
                                $sql = "SELECT * FROM tblbrand";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row['braid'] . "</td>";
                                    echo "<td>" . $row['braname'] . "</td>";
                                    echo "<td class='text-center'>
                            <a href='Brand/edit.php?braid=" . $row["braid"] . "' class='btn btn-outline-success rounded-circle'>
                            <i class='fa-solid fa-pen-to-square'></i>
                            </a>
                            <a href='Brand/delete.php?braid=" . $row["braid"] . "' class='btn btn-outline-danger rounded-circle' onclick='return confirm(\"Delete this Brand?\");'>
                            <i class='fa-solid fa-trash-can' name='btndelete'></i>
                            </a>
                            </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include 'layout/footer.php'; ?>
</body>

</html>