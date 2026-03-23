<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Motorcycle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/form.css">
</head>

<body>
    <div class="container bg-light p-0 rounded mt-5 shadow w-25">
        <div class="bg-dark p-2 text-center m-0 rounded-top">
            <h3 class="text-center text-light fw-bold">Add New Motorcycle</h3>
        </div>
        <form method="post" class="p-4">
            <div class="mb-3">
                <label for="braid" class="form-label fw-bold">Brand</label>
                <select class="form-select" id="braid" name="braid" required>
                    <option value="">--Choose Brand--</option>
                    <?php
                    require("../db.php");
                    $sql = "SELECT * FROM tblBrand";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        echo ("<option value='" . $row['braid'] . "'>" . $row['braname'] . "</option>");
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="modname" class="form-label fw-bold">Model</label>
                <input type="text" class="form-control" id="modname" name="modname" placeholder="Enter model name"required>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label fw-bold">Color</label>
                <input type="text" class="form-control" id="color" name="color" placeholder="Enter name color" required>
            </div>
            <div class="mb-3">
                <label for="year" class="form-label fw-bold">Year</label>
                <input type="text" class="form-control" id="year" name="year" placeholder="Enter manufacturing year"required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label fw-bold">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Enter price"required>
            </div>
            <div class="mb-3">
                <label for="Act" class="form-label fw-bold">Action</label>
                <select name="act" id="act" class="form-select" required>
                    <option value="">--Choose Action--</option>
                    <option value="New">New</option>
                    <option value="Used">Used</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="stock" class="form-label fw-bold">Stock</label>
                <input type="nember" class="form-control" id="stock" name="stock" placeholder="Enter stock" required>
            </div>

            <div class="d-flex gap-2 justify-content-start mt-3">
                <input type="submit" value="Save" name="submit" class="btn btn-primary">
                <a href="../motos.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
        <?php
            if (isset($_POST["submit"])) {
                require("../db.php");
                $braid = $_POST["braid"];
                $modname = $_POST["modname"];
                $color = $_POST["color"];
                $year = $_POST["year"];
                $price = $_POST["price"];
                $act = $_POST["act"];
                $stock = $_POST["stock"];
                $sql = "INSERT INTO tblMOdel (braid, modname, color, `year`, price, act, stock) 
                        VALUES(?,?,?,?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("isssdsi", $braid, $modname, $color, $year, $price, $act, $stock);
                if ($stmt->execute() == true) {
                    header("Location: ../motos.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        ?>
    </div>
</body>
</html>