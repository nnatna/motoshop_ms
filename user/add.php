<?php
session_start();
if (isset($_SESSION['full_name'])) {;
} else {
    header("Location:../login.php");
}
if (isset($_POST['btnsubmit'])) {
    require("../db.php");
    $fullname = $_POST["full_name"];
    $username = $_POST["username"];

    $sql_check = "SELECT username FROM tbluser WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($row = $result_check->fetch_assoc()) {
        $error_username = "Username already exists. Please choose another.";
    }

    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $role = $_POST["role"];

    if ($password != $cpassword) {
        $error_password = "Passwords do not match!";
    }

    if (!isset($error_username) && !isset($error_password)) {
        $hashed_password = md5($password);
        $sql = "INSERT INTO tbluser(full_name,username, password, role) VALUES(?,?,?,?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $fullname, $username, $hashed_password, $role);

        if ($stmt->execute()) {
            $last_id = $conn->insert_id;
            if (isset($_FILES['profile']) && !empty($_FILES['profile']['tmp_name'])) {
                $extension = pathinfo($_FILES['profile']['name'], PATHINFO_EXTENSION);
                $profile_img = "profile" . $last_id . "." . $extension;
                move_uploaded_file($_FILES['profile']['tmp_name'], "../image/profile/$profile_img");
                $conn->query("UPDATE tbluser SET profile_img='$profile_img' WHERE userid=$last_id");
            }
            header("Location: ../user.php");
            exit();
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/form.css?v=1.0">
    <script src="../assets/js/form.js?v=1.0"></script>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card rounded-4 shadow">
            <div class="bg-dark p-2 text-center m-0 rounded-top-4">
                <h3 class="text-center text-light fw-bold p-2">Add New User</h3>
            </div>

            <form method="post" class="p-4" enctype="multipart/form-data">
                <div class="mb-3 text-center">
                    <div class="position-relative d-inline-block">
                        <img src="../image/profile/<?php echo isset($profile_img) ? $profile_img : 'default.jpg' ?>"
                            id="picture"
                            class="rounded-circle img-thumbnail"
                            style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;"
                            onclick="document.getElementById('profile').click();"
                            title="Click to change photo">
                        <div class="position-absolute bottom-0 end-0 bg-dark text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                            style="width: 40px; height: 40px; cursor: pointer; border: 3px solid white;"
                            onclick="document.getElementById('profile').click();">
                            <i class="fa-solid fa-camera"></i>
                        </div>
                    </div>
                    <p class="text-muted small mt-2">Click image to upload new photo</p>
                </div>
                <div>
                    <?php
                    if (isset($error_username)) {
                        echo "<div class='alert alert-danger p-1 text-center'>$error_username</div>";
                    }
                    if (isset($error_password)) {
                        echo "<div class='alert alert-danger p-1 text-center'>$error_password</div>";
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="full_name" class="form-label text-muted fw-bold">Full Name</label>
                    <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="full_name" name="full_name" placeholder="Enter full name" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label text-muted fw-bold">Username</label>
                    <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="username" name="username" placeholder="Enter username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-muted fw-bold">Password</label>
                    <input type="password" class="form-control shadow-none border-dark-subtle rounded-pill" id="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label text-muted fw-bold">Confirm Password</label>
                    <input type="password" class="form-control shadow-none border-dark-subtle rounded-pill" id="cpassword" name="cpassword" placeholder="Enter confirm password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label text-muted fw-bold">Role</label>
                    <select class="form-select shadow-none border-dark-subtle rounded-pill" id="role" name="role" required>
                        <option value="">Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="mb-3">
                    <input type="file" class="form-control d-none" id="profile" name="profile" onchange="showimg()" accept="image/*">
                </div>
                <div class="d-flex gap-2 justify-content-around mb-3">
                    <input type="submit" value="Save" name="btnsubmit" class="btn btn-success w-100 rounded-pill">
                    <a href="../user.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>