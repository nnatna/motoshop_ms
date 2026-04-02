<?php
if (isset($_POST["submit"])) {
    require("../db.php");
    $cusname = $_POST["cusname"];
    $gender  = $_POST["gender"];
    $phone   = $_POST["phone"];

    $sql_check = "SELECT phone FROM tblCustomers WHERE phone = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $phone);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($row = $result_check->fetch_assoc()) {
        $error_phone = "Phone number already exists. Please choose another";
    }

    if (!isset($error_phone)) {
        $address = $_POST["address"];

        $sql = "INSERT INTO tblCustomers (cusname, gender, phone, `address`)
             VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $cusname, $gender, $phone, $address);

        if ($stmt->execute() == true) {
            header("Location: ../customer.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Customer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/form.css?v=1">
    <script src="../assets/js/form.js?v=1"></script>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card rounded-4 shadow">
            <div class="bg-dark p-2 text-center m-0 rounded-top-4">
                <h3 class="text-center text-light fw-bold p-2">Add New Customer</h3>
            </div>

            <form method="post" class="p-4">
                <div class="mb-3">
                    <?php
                    if (isset($error_phone)) {
                        echo "<div class='alert alert-danger p-1 text-center'>$error_phone</div>";
                    }
                    ?>
                </div>
                <div class="mb-3">
                    <label for="cusname" class="form-label text-muted fw-bold">Customer Name</label>
                    <input type="text" class="form-control" id="cusname" name="cusname" placeholder="Enter customer name" required>
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label text-muted fw-bold">Gender</label>
                    <select name="gender" id="gender" class="form-select" required>
                        <option value="">Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label text-muted fw-bold">Phone Number</label>
                    <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="phone" name="phone" placeholder="Enter phone number" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label text-muted fw-bold">Address</label>
                    <textarea class="form-control shadow-none border-dark-subtle rounded-3" id="address" name="address" rows="2" placeholder="Enter address" required></textarea>
                </div>

                <div class="d-flex gap-2 justify-content-around  mt-4">
                    <button type="submit" name="submit" class="btn btn-success w-100 rounded-pill">Save</button>
                    <a href="../customer.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>