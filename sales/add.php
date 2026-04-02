<?php
session_start();
if (!isset($_SESSION['full_name'])) {
    header("Location:../login.php");
    exit();
}

$amount = 0;

if (isset($_POST["submit"])) {
    require("../db.php");

    $cusid = isset($_POST["cusid"]) ? $_POST["cusid"] : null;
    $cusname = isset($_POST["cusname"]) ? $_POST["cusname"] : null;
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : null;
    $phone = isset($_POST["phone"]) ? $_POST["phone"] : null;
    $address = isset($_POST["address"]) ? $_POST["address"] : null;

    if (empty($cusid) && !empty($cusname)) {
        $sql_check = "SELECT cusid FROM tblcustomers WHERE cusname = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $cusname);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($row = $result_check->fetch_assoc()) {
            $cusid = $row["cusid"];
        } else {
            $sql_ins_brand = "INSERT INTO tblcustomers (cusname, gender, phone, address) VALUES (?, ?, ?, ?)";
            $stmt_ins = $conn->prepare($sql_ins_brand);
            $stmt_ins->bind_param("ssss", $cusname, $gender, $phone, $address);
            $stmt_ins->execute();
            $cusid = $conn->insert_id;
        }
    }

    $quantity = (int)$_POST["quantity"];

    $sql_check = "SELECT stock FROM tblModel WHERE code_model = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("i", $_POST["model_code"]);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();
    $row_check = $result_check->fetch_assoc();
    $stock = $row_check ? (int)$row_check['stock'] : 0;
    if ($quantity > $stock) {
        $error_db = "Error: Quantity exceeds available stock.";
    } else {
        $sql_update = "UPDATE tblModel SET stock = stock - ? WHERE code_model = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("ii", $quantity, $_POST["model_code"]);
        $stmt_update->execute();

        $model_code = $_POST["model_code"];

        $sql_price = "SELECT price FROM tblModel WHERE code_model = ?";
        $stmt_price = $conn->prepare($sql_price);
        $stmt_price->bind_param("i", $model_code);
        $stmt_price->execute();
        $res_price = $stmt_price->get_result();
        $row_price = $res_price->fetch_assoc();
        $price = $row_price ? $row_price['price'] : 0;

        $amount = $quantity * $price;
        date_default_timezone_set('Asia/Phnom_Penh');
        $saledate = date("Y-m-d H:i:s");

        $sql = "INSERT INTO tblSales (cusid, code_model, quantity, amount, saledate, userid) 
        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiidsi", $cusid, $model_code, $quantity, $amount, $saledate, $_SESSION['userid']);
        if ($stmt->execute()) {
            header("Location:../sales.php");
            exit();
        } else {
            $error_db = "Error: Sale not saved. " . $conn->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Motorcycle</title>
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
                <h3 class="text-center text-light fw-bold p-2">Add New Sale</h3>
            </div>
            <div class="px-4 mt-4 mb-0">
                <?php if (isset($error_db)): ?>
                    <div class="alert alert-danger text-center m-0" role="alert"><?php echo $error_db; ?></div>
                <?php endif; ?>
            </div>
            <form method="post" class="p-4 mt-0">
                <div class="mb-3">
                    <label for="brandInput" class="form-label text-muted fw-bold">Customer</label>
                    <input class="form-control shadow-none border-dark-subtle rounded-pill" list="brandList" id="brandInput" name="cusname" placeholder="Select or type a customer..." required>

                    <datalist id="brandList">
                        <?php
                        require("../db.php");
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
                <a class="btn border-dark-subtle w-100 rounded-pill text-muted" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    <i class="bi bi-person-plus-fill me-1"></i>New Customer
                </a>
                <div class="collapse" id="collapseExample">
                    <div class="mb-3">
                        <label for="gender" class="form-label text-muted fw-bold">Gender</label>
                        <select name="gender" id="gender" class="form-select shadow-none border-dark-subtle rounded-pill">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label text-muted fw-bold">Phone Number</label>
                        <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="phone" name="phone" placeholder="Enter phone number">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label text-muted fw-bold">Address</label>
                        <textarea class="form-control rounded-3 shadow-none border-dark-subtle" id="address" name="address" rows="2" placeholder="Enter address"></textarea>
                    </div>

                </div>

                <div class="mb-3">
                    <label for="modname" class="form-label text-muted fw-bold">Motorcycle</label>
                    <select name="model_code" id="model_code" class="form-select shadow-none border-dark-subtle rounded-pill" onchange="calculateTotal()">
                        <option value="">Select Motorcycle</option>
                        <?php
                        require("../db.php");
                        $sql = "SELECT * FROM tblModel";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='"
                                . $row['code_model'] . "' data-price='"
                                . $row['price'] . "'>"
                                . $row['modname'] . " - "
                                . $row['color'] . " - "
                                . $row['year'] . " 
                                - ($" . $row['price'] . ")</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label fw-bold">Quantity</label>
                    <input type="number" class="form-control rounded-pill" id="qty" name="quantity" min="1" oninput="calculateTotal()">
                </div>
                <div class="mb-3">
                    <input type="hidden" id="total_amount" name="amount" value="<?php echo $amount; ?>">
                    <div class="alert alert-info mt-3 py-2 border-0 shadow-sm rounded-pill text-center">
                        <i class="bi bi-info-circle-fill me-2"></i>Total Calculation: <strong>$<span id="display_amount"><?php echo number_format($amount, 2); ?></span></strong>
                    </div>
                </div>

                <div class="d-flex gap-2 justify-content-around  mt-3">
                    <input type="submit" value="Save" name="submit" class="btn btn-success w-100 rounded-pill">
                    <a href="../sales.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
                </div>
            </form>
        </div>

    </div>
    <script src="../assets/js/form.js"></script>

</body>

</html>