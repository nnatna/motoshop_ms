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
</head>
<body class="bg-secondary-subtle">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card rounded-top-4 shadow border-0">
                    <div class="card-header bg-dark text-white text-center m-0 rounded-top-4">
                        <h3 class="mb-0 fw-bold">Edit Sales Record</h3>
                    </div>
                    <div class="card-body card rounded-bottom-1 p- bg-white ">
                        
                        <?php
                        require("../db.php");

                        $id = isset($_GET["saleid"]) ? $_GET["saleid"] : (isset($_POST["saleid"]) ? $_POST["saleid"] : "");

                        if (empty($id)) {
                            echo "<div class='alert alert-danger'><strong>Error:</strong> No Sale ID provided!</div>";
                            echo "<a href='../sales.php' class='btn btn-secondary w-100'>Back to Sales</a>";
                            exit();
                        }

                        if (!isset($_POST["submit"])) {
                            $sql = "SELECT * FROM tblSales WHERE saleid = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("i", $id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            
                            if ($row = $result->fetch_assoc()) {
                                $cusid = $row["cusid"];
                                $code_model = $row["code_model"];
                                $quantity = $row["quantity"];
                                $amount = $row["amount"];
                                // គណនាតម្លៃក្នុង ១ គ្រឿង (Unit Price) ទុកសម្រាប់គុណ
                                $unit_price = ($quantity > 0) ? ($amount / $quantity) : 0; 
                                $saledate = date('Y-m-d', strtotime($row["saledate"])); 
                        ?>
                                <form method="post">
                                    <input type="hidden" name="saleid" value="<?php echo $id; ?>">
                                    <input type="hidden" id="unit_price" value="<?php echo $unit_price; ?>">

                                    <div class="mb-3">
                                        <label class="form-label text-muted fw-bold">Customer ID</label>
                                        <input type="number" class="form-control shadow-none border-dark-subtle rounded-pill " name="cusid" value="<?php echo $cusid; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted fw-bold">Motorcycle Model ID</label>
                                        <input type="number" class="form-control shadow-none border-dark-subtle rounded-pill " name="code_model" value="<?php echo $code_model; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted fw-bold">Sale Date</label>
                                        <input type="date" class="form-control shadow-none border-dark-subtle rounded-pill " name="saledate" value="<?php echo $saledate; ?>" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label text-muted fw-bold">Quantity</label>
                                        <input type="number" id="qty" class="form-control shadow-none border-dark-subtle rounded-pill " name="quantity" value="<?php echo $quantity; ?>" required oninput="calculateTotal()">
                                    </div>

                                    <div class="mb-4">
                                        <label class="form-label text-muted fw-bold ">Total Amount ($)</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light ">$</span>
                                            <input type="number" id="total_amount" step="0.01" class="form-control  fw-bold text-success bg-light  " name="amount" value="<?php echo $amount; ?>" required readonly>
                                        </div>
                                    </div>
                    
                                    <div class="mb-3">
                            <!-- <label for="stock" class="form-label text-muted fw-bold">Sav Changes</label> -->
                        </div>
                        <div class="d-flex gap-2 justify-content-around mt-3">
                            <input type="submit" value="Save Changes" name="submit" class="btn btn-success w-100 rounded-pill">
                            <a href="../sales.php" class="btn btn-secondary w-100 rounded-pill">Cancel</a>
                        </div>
                                </form>
                        <?php
                            } else {
                                echo "<div class='alert alert-warning text-center'>Record ID: $id Not Found!</div>";
                            }
                        } else {
                            // ផ្នែក Update
                            $u_cusid = $_POST["cusid"];
                            $u_code_model = $_POST["code_model"];
                            $u_quantity = $_POST["quantity"];
                            $u_amount = $_POST["amount"];
                            $u_saledate = $_POST["saledate"];
                            $u_saleid = $_POST["saleid"];

                            $sql_update = "UPDATE tblSales SET cusid=?, code_model=?, quantity=?, amount=?, saledate=? WHERE saleid=?";
                            $stmt_up = $conn->prepare($sql_update);
                            $stmt_up->bind_param("iiidsi", $u_cusid, $u_code_model, $u_quantity, $u_amount, $u_saledate, $u_saleid);

                            if ($stmt_up->execute()) {
                                echo "<script>
                                        alert('Update Successful!'); 
                                        window.location.href='../sales.php'; 
                                      </script>";
                            } else {
                                echo "<div class='alert alert-danger'>Error Update: " . $conn->error . "</div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    function calculateTotal() {
        // ចាប់យកតម្លៃពី input qty និង unit_price
        let qty = document.getElementById('qty').value;
        let unitPrice = document.getElementById('unit_price').value;
        let totalField = document.getElementById('total_amount');

        // ប្រសិនបើ Qty ទំនេរ ឬតិចជាង ០ ឱ្យបង្ហាញ ០
        if (qty === "" || qty < 0) {
            totalField.value = "0.00";
            return;
        }

        // គណនាតម្លៃសរុប
        let total = parseFloat(qty) * parseFloat(unitPrice);
        
        // បញ្ចូលតម្លៃទៅក្នុងប្រឡង់ Total Amount (កំណត់យកក្បៀស ២ ខ្ទង់)
        totalField.value = total.toFixed(2);
    }
    </script>

</body>
</html>