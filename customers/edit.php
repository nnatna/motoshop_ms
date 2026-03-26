<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>
<body>
    <div class="container bg-light p-0 rounded mt-5 shadow w-50">
        <div class="bg-dark p-2 text-center m-0 rounded-top">
            <h3 class="text-center text-light fw-bold">Edit Customer Information</h3>
        </div>

        <?php
        // ២. ទាញទិន្នន័យចាស់មកបង្ហាញក្នុង Form
        require("../db.php");
        $cusid = $_GET["id"];
        $sql = "SELECT * FROM tblCustomers WHERE cusid=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $cusid);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($row = $result->fetch_assoc()) {
            $n = $row["cusname"];
            $g = $row["gender"];
            $p = $row["phone"];
            $a = $row["address"];
        ?>

        <form method="post" class="p-4">
            <div class="mb-3">
                <label for="cusname" class="form-label fw-bold">Customer Name</label>
                <input type="text" class="form-control" id="cusname" name="cusname" value="<?= htmlspecialchars($n) ?>" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label fw-bold">Gender</label>
                <select name="gender" id="gender" class="form-select" required>
                    <option value="Male" <?= ($g == 'Male') ? 'selected' : '' ?>>Male</option>
                    <option value="Female" <?= ($g == 'Female') ? 'selected' : '' ?>>Female</option>
                    <option value="Other" <?= ($g == 'Other') ? 'selected' : '' ?>>Other</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label fw-bold">Phone Number</label>
                <input type="text" class="form-control" id="phone" name="phone" value="<?= htmlspecialchars($p) ?>" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label fw-bold">Address</label>
                <textarea class="form-control" id="address" name="address" rows="2" required><?= htmlspecialchars($a) ?></textarea>
            </div>

            <div class="d-flex gap-2 justify-content-start mt-3">
                <button type="submit" name="submit" class="btn btn-primary px-4">Save Changes</button>
                <a href="../customer.php" class="btn btn-secondary px-4">Cancel</a>
            </div>
        </form>
        <?php

// ១. ត្រួតពិនិត្យការ Save (Update) នៅខាងលើគេបង្អស់ ដើម្បីចៀសវាង Error Header
if (isset($_POST["submit"])) {
    require("../db.php");
    $cusid = $_GET["id"]; // ប្រើ id ដែលបញ្ជូនតាម URL
    $cusname = $_POST["cusname"];
    $gender  = $_POST["gender"];
    $phone   = $_POST["phone"];
    $address = $_POST["address"];

    $sql = "UPDATE tblCustomers SET cusname=?, gender=?, phone=?, address=? WHERE cusid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $cusname, $gender, $phone, $address, $cusid);

    if ($stmt->execute()) {
        header("Location: ../customer.php");
        exit();
    } else {
        $error_msg = "Error updating record: " . $conn->error;
    }
}
?>

        <?php 
        } else {
            echo "<div class='p-4 text-center text-danger'>Customer not found!</div>";
        }
        ?>
    </div>
</body>
</html>