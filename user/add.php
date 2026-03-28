<?php
session_start();
if (isset($_SESSION['full_name'])) {;
} else {
    header("Location:../login.php");
} ?>
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
    <style>
        body {
            background-color: #f4f6f9;
        }

        .card {
            min-width: 400px;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card rounded-4 shadow">
            <div class="bg-dark p-2 text-center m-0 rounded-top-4">
                <h3 class="text-center text-light fw-bold p-2">Add New User</h3>
            </div>
            <form method="post" class="p-4">
                <div class="mb-3">
                    <label for="full_name" class="form-label text-muted fw-bold">Full Name</label>
                    <input type="text" class="form-control rounded-pill" id="full_name" name="full_name" placeholder="Enter full name" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label text-muted fw-bold">Username</label>
                    <input type="text" class="form-control rounded-pill" id="username" name="username" placeholder="Enter username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label text-muted fw-bold">Password</label>
                    <input type="password" class="form-control rounded-pill" id="password" name="password" placeholder="Enter password" required>
                </div>
                <div class="mb-3">
                    <label for="cpassword" class="form-label text-muted fw-bold">Confirm Password</label>
                    <input type="password" class="form-control rounded-pill" id="cpassword" name="cpassword" placeholder="Enter confirm password" required>
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label text-muted fw-bold">Role</label>
                    <select class="form-select rounded-pill" id="role" name="role" required>
                        <option value="">Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                    </select>
                </div>
                <div class="d-flex gap-2 justify-content-around mb-3">
                    <input type="submit" value="Save" name="btnsubmit" class="btn btn-success w-100 rounded-pill">
                    <a href="../user.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
                </div>
            </form>
            <?php
            if (isset($_POST['btnsubmit'])) {
                require("../db.php");
                $fullname = $_POST["full_name"];
                $username = $_POST["username"];
                $password = $_POST["password"];
                $cpassword = $_POST["cpassword"];
                $role = $_POST["role"];
                if ($password != $cpassword) {
                    die("<p style='color:red;'>password and con-password not match!!</p>");
                }
                $sql = "INSERT INTO tbluser(full_name,username, password, role) VALUES(?,?,?,?);";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $fullname, $username, md5($password), $role);
                if ($stmt->execute() == true) {
                    header("Location: ../user.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            ?>
        </div>
    </div>
</body>

</html>