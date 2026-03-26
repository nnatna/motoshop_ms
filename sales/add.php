    <?php 
    require("../db.php"); 
    if (isset($_POST["btn_save_all"])) {
        // ១. ចាប់យកទិន្នន័យអតិថិជន
        $cname = trim($_POST["new_cusname"]);
        $cgen  = $_POST["new_gender"];
        $cph   = trim($_POST["new_phone"]);
        $caddr = trim($_POST["new_address"]);

        // ២. ចាប់យកទិន្នន័យការលក់
        $mid = $_POST["code_model"];
        $qty = $_POST["quantity"];
        $amt = $_POST["final_amount"];

        if (empty($cph) || empty($mid)) {
            echo "<script>alert('សូមបំពេញព័ត៌មានឱ្យបានគ្រប់គ្រាន់!'); window.history.back();</script>";
            exit();
        }

        $conn->begin_transaction();

        try {
            $checkCus = $conn->prepare("SELECT cusid FROM tblCustomers WHERE phone = ?");
            $checkCus->bind_param("s", $cph);
            $checkCus->execute();
            $resCheck = $checkCus->get_result();

            if ($resCheck->num_rows > 0) {
                $rowCus = $resCheck->fetch_assoc();
                $target_cusid = $rowCus['cusid'];
            } else {
                $sqlCus = "INSERT INTO tblCustomers (cusname, gender, phone, address) VALUES (?, ?, ?, ?)";
                $stCus = $conn->prepare($sqlCus);
                $stCus->bind_param("ssss", $cname, $cgen, $cph, $caddr);
                $stCus->execute();
                $target_cusid = $conn->insert_id;
            }

            $sqlSale = "INSERT INTO tblSales (cusid, code_model, quantity, amount) VALUES (?, ?, ?, ?)";
            $stSale = $conn->prepare($sqlSale);
            $stSale->bind_param("iiid", $target_cusid, $mid, $qty, $amt);
            $stSale->execute();

            $conn->commit();
            echo "<script>alert('រក្សាទុកជោគជ័យ!'); window.location='../sales.php';</script>";

        } catch (Exception $e) {
            $conn->rollback();
            echo "<script>alert('មានបញ្ហា: " . $e->getMessage() . "');</script>";
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sale Management System</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <style>
            body { background-color: #f4f7f6; font-family: 'Segoe UI', sans-serif; }
            .main-card { border: none; border-radius: 12px; overflow: hidden; max-width: 950px; margin: 40px auto; }
            .card-header { background-color: #343a40; color: white; text-align: center; padding: 15px; }
            .section-title { font-size: 1rem; font-weight: 700; color: #0d6efd; border-bottom: 2px solid #e9ecef; padding-bottom: 10px; margin-bottom: 20px; }
            .divider-right { border-left: 1px solid #dee2e6; padding-left: 30px; }
            .total-amount { color: #28a745; font-size: 2.8rem; font-weight: bold; }
            @media (max-width: 768px) { .divider-right { border-left: none; border-top: 1px solid #dee2e6; padding-top: 20px; } }
        </style>
    </head>
    <body>
    <div class="container">
        <form method="post" action="">
            <div class="card main-card shadow-lg">
                <div class="card-header">
                    <h4>CUSTOMER & SALE REGISTRATION</h4>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <h6 class="section-title"><i class="bi bi-person-plus-fill"></i> Step 1: Customer Info</h6>
                            <div class="mb-3">
                                <label class="form-label">Customer Name</label>
                                <input type="text" class="form-control" name="new_cusname" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label>
                                <select class="form-select" name="new_gender">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text" class="form-control" name="new_phone" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <textarea class="form-control" name="new_address" rows="2"></textarea>
                            </div>
                        </div>

                        <div class="col-md-6 divider-right">
                            <h6 class="section-title text-success"><i class="bi bi-cart-check"></i> Step 2: Sale Details</h6>
                            <div class="mb-3">
                                <label class="form-label">Motorcycle Model</label>
                                <select class="form-select" name="code_model" id="moto_model" required>
                                    <option value="">-- Select Model --</option>
                                    <?php
                                    $resMod = $conn->query("SELECT code_model, modname, price FROM tblModel");
                                    while ($row = $resMod->fetch_assoc()) {
                                        echo "<option value='".$row['code_model']."' data-price='".$row['price']."'>".$row['modname']." ($".$row['price'].")</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" name="quantity" id="quantity" value="1" min="1" required>
                            </div>

                            <div class="text-center p-3 bg-light rounded border my-3">
                                <div class="small fw-bold text-muted">TOTAL PAYABLE</div>
                                <div class="total-amount" id="total_text">$0.00</div>
                                <input type="hidden" name="final_amount" id="final_amount" value="0">
                            </div>

                            <div class="d-flex gap-2">
                                <a href="../sales.php" class="btn btn-outline-secondary w-50 py-3 fw-bold">
                                    <i class="bi bi-x-circle"></i> CANCEL
                                </a>
                                <button type="submit" name="btn_save_all"  class="btn btn-success w-50 py-3 fw-bold">
                                    <i class="bi bi-save"></i> SAVE DATA
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        const modelSelect = document.getElementById('moto_model');
        const qtyInput = document.getElementById('quantity');
        const txtDisplay = document.getElementById('total_text');
        const valInput = document.getElementById('final_amount');

        function calculate() {
            const selectedOption = modelSelect.options[modelSelect.selectedIndex];
            const price = selectedOption ? selectedOption.getAttribute('data-price') : 0;
            const total = (price || 0) * qtyInput.value;
            txtDisplay.innerText = '$' + total.toLocaleString('en-US', {minimumFractionDigits: 2});
            valInput.value = total;
        }
        modelSelect.addEventListener('change', calculate);
        qtyInput.addEventListener('input', calculate);
    </script>

    </body>
    </html>