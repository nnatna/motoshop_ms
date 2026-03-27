<?php
if (isset($_POST['submit'])) {
    $u = $_POST["username"];
    $p = md5($_POST["password"]);
    $sql = "SELECT userid, full_name, role FROM tbluser WHERE username=? AND password=?;";
    require("db.php");
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $u, $p);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($row = $result->fetch_assoc()) {
        session_start();
        $_SESSION['userid'] = $row['userid'];
        $_SESSION['full_name'] = $row['full_name'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        header("Location: ./index.php");
    } else {
       $error = "Invalid username or password!!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motoshop Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="./assets/css/layout.css">
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
                <div class="mb-2">
                    <i class="bi bi-person-circle text-light" style="font-size: 3rem;"></i>
                </div>
                <h3 class="text-center text-light fw-bold p-2">MotoShop</h3>
            </div>
            <form method="post" class="p-4">
                <div class="mb-4 text-center">
                    <p class="fw-bold text-muted">Login to your account</p>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger py-2 small"><?php echo $error; ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text border-end-0 rounded-start-pill border-dark-subtle text-secondary">
                            <i class="bi bi-person"></i>
                        </span>
                        <input type="text" class="form-control border-start-0 rounded-end-pill shadow-none border-dark-subtle" name="username" placeholder="Username" required>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text border-end-0 rounded-start-pill border-dark-subtle text-secondary">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" class="form-control border-start-0 rounded-end-pill shadow-none border-dark-subtle" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="mb-4">
                    <input type="submit" value="Login" name="submit" class="btn btn-success w-100 rounded-pill fw-bold">
                </div>
            </form>
        </div>
    </div>

</body>

</html>