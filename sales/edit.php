<?php
session_start();
if (!isset($_SESSION['full_name'])) {
    header("Location:../login.php");
    exit();
}
require("../db.php");
$saleid = isset($_GET["saleid"]) ? $_GET["saleid"] : (isset($_POST["saleid"]) ? $_POST["saleid"] : "");

if (isset($_POST["submit"])) {
    $cusname = $_POST["cusname"];
    $cusid = $_POST["cusid"];
    $stmt_c = $conn->prepare("SELECT cusid FROM tblcustomers WHERE cusname = ?");
    $stmt_c->bind_param("s", $cusname);
    $stmt_c->execute();
    $res_c = $stmt_c->get_result();
    if ($row_c = $res_c->fetch_assoc()) {
        $cusid = $row_c["cusid"];
    }

    $code_model = $_POST["code_model"];
    $quantity = $_POST["quantity"];
    $amount = $_POST["amount"];
    date_default_timezone_set('Asia/Phnom_Penh');
    $saledate = date("Y-m-d H:i:s");

    $sql_update = "UPDATE tblSales SET cusid=?, code_model=?, quantity=?, amount=?, saledate=?, userid=? WHERE saleid=?";
    $stmt_up = $conn->prepare($sql_update);
    $stmt_up->bind_param("iiidsii", $cusid, $code_model, $quantity, $amount, $saledate, $_SESSION['userid'], $saleid);
    if ($stmt_up->execute()) {
        header("Location: ../sales.php");
        exit();
    } else {
        $error_db = "Error: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sales Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/form.css<?php time() ?>">
    <script src="../assets/js/form.js?v=1.0"></script>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="card rounded-4 shadow">
            <div class="bg-dark p-2 text-center m-0 rounded-top-4">
                <h3 class="text-center p-2 text-light fw-bold">Edit Sales Record</h3>
            </div>
            <?php
            $sql = "SELECT s.*, c.cusname FROM tblSales s JOIN tblcustomers c ON s.cusid = c.cusid WHERE s.saleid = ?;";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $saleid);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                $cusid = $row["cusid"];
                $cusname = $row["cusname"];
                $code_model = $row["code_model"];
                $quantity = $row["quantity"];
                $amount = $row["amount"];
            ?>
                <?php if (isset($error_db)): ?>
                    <div class="alert alert-danger mx-4 mt-2"><?php echo $error_db; ?></div>
                <?php endif; ?>
                <form method="post" class="p-4">
                    <input type="hidden" name="saleid" value="<?php echo $saleid; ?>">
                    <input type="hidden" name="cusid" value="<?php echo $cusid; ?>">

                        <div class="mb-3">
                            <label for="brandInput" class="form-label text-muted fw-bold">Customer</label>
                            <input class="form-control shadow-none border-dark-subtle rounded-pill" list="brandList" id="brandInput"
                                name="cusname" value="<?php echo ($cusname) ?>" placeholder="Select or type a customer..." required>
                            <datalist id="brandList">
                                <?php
                                $sql = "SELECT * FROM tblcustomers";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();

                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['cusname'] . "' data-id='" . $row['cusid'] . "'>";
                                }

                                ?>
                            </datalist>
                        </div>

                        <div class="mb-3">
                            <label for="modname" class="form-label text-muted fw-bold">Motorcycle</label>
                            <select name="code_model" id="model_code" class="form-select shadow-none border-dark-subtle rounded-pill" onchange="calculateTotal()">
                                <option value="">Select Motorcycle</option>
                                <?php
                                $sql = "SELECT * FROM tblModel";
                                $stmt = $conn->prepare($sql);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while ($row = $result->fetch_assoc()) {
                                    if ($row['code_model'] == $code_model) {
                                        echo "<option value='" . $row['code_model'] . "' data-price='" . $row['price'] . "' selected>" . $row['modname'] . " - " . $row['color'] . " - " . $row['year'] . " - ($" . $row['price'] . ")</option>";
                                    } else {
                                        echo "<option value='" . $row['code_model'] . "' data-price='" . $row['price'] . "'>" . $row['modname'] . " - " . $row['color'] . " - " . $row['year'] . " - ($" . $row['price'] . ")</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-muted fw-bold">Quantity</label>
                            <input type="number" id="qty" class="form-control shadow-none border-dark-subtle rounded-pill " name="quantity"
                                value="<?php echo $quantity; ?>" required oninput="calculateTotal()">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" id="total_amount" name="amount" value="<?php echo $amount; ?>">
                            <div class="alert alert-info mt-3 py-2 border-0 shadow-sm rounded-pill text-center">
                                <i class="bi bi-info-circle-fill me-2"></i>Total Calculation: <strong>$<span id="display_amount"><?php echo number_format($amount, 2); ?></span></strong>
                            </div>
                        </div>
                        <div class="mb-3">
                        </div>
                        <div class="d-flex gap-2 justify-content-around mt-3">
                            <input type="submit" value="Save Changes" name="submit" class="btn btn-success w-100 rounded-pill">
                            <a href="../sales.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
                        </div>

                    </form>
            <?php
            }
            ?>
        </div>

    </div>


    <script src="../assets/js/form.js"></script>

</body>

</html>