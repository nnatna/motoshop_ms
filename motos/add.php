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
    <title>Add New Motorcycle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
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
                <h3 class="text-center text-light fw-bold p-2">Add New Motorcycle</h3>
            </div>
            <form method="post" class="p-4">
                <div class="mb-3">
                    <label for="brandInput" class="form-label text-muted fw-bold">Brand</label>
                    <input class="form-control shadow-none border-dark-subtle rounded-pill" list="brandList" id="brandInput" name="braname" placeholder="Select or type a brand..." required>

                    <datalist id="brandList">
                        <?php
                        require("../db.php");
                        $sql = "SELECT * FROM tblBrand";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['braname'] . "' data-id='" . $row['braid'] . "'>";
                        }
                        ?>
                    </datalist>
                </div>
                <div class="mb-3">
                    <label for="modname" class="form-label text-muted fw-bold">Model</label>
                    <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="modname" name="modname" placeholder="Enter model name" required>
                </div>
                <div class="mb-3">
                    <label for="color" class="form-label text-muted fw-bold">Color</label>
                    <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="color" name="color" placeholder="Enter name color" required>
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label text-muted fw-bold ">Year</label>
                    <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="year" name="year" placeholder="Enter manufacturing year" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label text-muted fw-bold">Price($)</label>
                    <input type="text" class="form-control shadow-none border-dark-subtle rounded-pill" id="price" name="price" placeholder="Enter price" required>
                </div>
                <div class="mb-3">
                    <label for="Act" class="form-label text-muted fw-bold">Action</label>
                    <select name="act" id="act" class="form-select shadow-none border-dark-subtle rounded-pill" required>
                        <option value="">Select Action</option>
                        <option value="New">New</option>
                        <option value="Used">Used</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stock" class="form-label text-muted fw-bold">Stock</label>
                    <input type="nember" class="form-control shadow-none border-dark-subtle rounded-pill" id="stock" name="stock" placeholder="Enter stock" required>
                </div>

                <div class="d-flex gap-2 justify-content-around  mt-3">
                    <input type="submit" value="Save" name="submit" class="btn btn-success w-100 rounded-pill">
                    <a href="../motos.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST["submit"])) {
            require("../db.php");

            $braid = isset($_POST["braid"]) ? $_POST["braid"] : null;
            $braname = isset($_POST["braname"]) ? $_POST["braname"] : null;

            if (empty($braid) && !empty($braname)) {
                $sql_check = "SELECT braid FROM tblBrand WHERE braname = ?";
                $stmt_check = $conn->prepare($sql_check);
                $stmt_check->bind_param("s", $braname);
                $stmt_check->execute();
                $result_check = $stmt_check->get_result();

                if ($row = $result_check->fetch_assoc()) {
                    $braid = $row["braid"]; 
                } else {

                    $sql_ins_brand = "INSERT INTO tblBrand (braname) VALUES (?)";
                    $stmt_ins = $conn->prepare($sql_ins_brand);
                    $stmt_ins->bind_param("s", $braname);
                    $stmt_ins->execute();
                    $braid = $conn->insert_id;
                }
            }
            $modname = $_POST["modname"];
            $color   = $_POST["color"];
            $year    = $_POST["year"];
            $price   = $_POST["price"];
            $act     = $_POST["act"];
            $stock   = $_POST["stock"];

            $sql = "INSERT INTO tblModel (braid, modname, color, `year`, price, act, stock) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssdsi", $braid, $modname, $color, $year, $price, $act, $stock);

            if ($stmt->execute()) {
                header("Location: ../motos.php");
                exit();
            } else {
                echo "Error: " . $conn->error;
            }
        }
        ?>
    </div>
</body>

</html>