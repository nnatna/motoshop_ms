<div class="d-flex justify-content-between align-items-center mb-1">
    <div>
        <h3 class="fw-bold text-success"><i class="fa-solid fa-cart-shopping me-1"></i>List Of Sales</h3>
        <p class="text-muted">List all sales sales transactions</p>
    </div>
    <div>
        <a href="sales/add.php" class="btn btn-success rounded-pill fw-bold"><i class="bi-plus-circle me-1"></i>Sale</a>
    </div>
</div>
<?php
require("db.php");
//Search & Sort
$field  = isset($_POST["txtfield"]) ? $_POST["txtfield"] : "";
$search = isset($_POST["txtsearch"]) ? $_POST["txtsearch"] : "";

$saleid_sel  = $field == 1 ? "selected" : "";
$cusname_sel = $field == 2 ? "selected" : "";
$modname_sel = $field == 3 ? "selected" : "";
$date_sel    = $field == 4 ? "selected" : "";

//sort
$sort_column = "s.saleid";
if ($field == "2") $sort_column = "c.cusname";
if ($field == "3") $sort_column = "m.modname";
if ($field == "4") $sort_column = "s.saledate";

$sort_order = "DESC";
if (isset($_POST['btnasc'])) $sort_order = "ASC";
if (isset($_POST['btndesc'])) $sort_order = "DESC";
?>

<fieldset>
    <form method="post" class="d-flex justify-content-between mb-3">
        <div class="text-start row g-3 align-items-center">
            <div class="col-auto">
                <select name="txtfield" class="form-select rounded-pill" required>
                    <option value="">Choose field</option>
                    <option value="1" <?php echo $saleid_sel ?>>Sale ID</option>
                    <option value="2" <?php echo $cusname_sel ?>>Customer</option>
                    <option value="3" <?php echo $modname_sel ?>>Motorcycle</option>
                    <option value="4" <?php echo $date_sel ?>>Sale Date</option>
                </select>
            </div>

            <div class="col-auto d-flex justify-content-between align-items-center gap-1">
                <div class="col-auto d-flex justify-content-between align-items-center">
                    <input type="text" name="txtsearch"
                        value="<?php echo ($search) ?>"
                        class="form-control shadow-none border-dark-subtle rounded-start-pill border-end-0" placeholder="Search...">

                    <button type="submit" name="btnsearch" class="btn text-secondary shadow-none border-dark-subtle rounded-end-pill border-start-0">
                        <i class="bi-search"></i>
                    </button>
                </div>
                <div class="col-auto">
                    <button type="submit" name="btnreset" class="btn btn-danger rounded-circle">
                        <i class="fa-solid fa-rotate"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" name="btnasc" class="btn btn-outline-success rounded-circle">
                <i class="fa-solid fa-arrow-down-a-z"></i>
            </button>

            <button type="submit" name="btndesc" class="btn btn-outline-danger rounded-circle">
                <i class="fa-solid fa-arrow-down-z-a"></i>
            </button>
        </div>
    </form>
</fieldset>

<table class="table table-hover text-center align-middle mb-0">
    <thead>
        <tr class="table-secondary fs-5">
            <th class="text-center">ID</th>
            <th class="text-center">Customer</th>
            <th class="text-center">Model</th>
            <th class="text-center">Qty</th>
            <th class="text-center">Amount</th>
            <th class="text-center">Sale Date</th>
            <th class="text-center">Options</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;

        $sql_base = "FROM tblSales s 
                     JOIN tblCustomers c ON s.cusid = c.cusid 
                     JOIN tblModel m ON s.code_model = m.code_model";

        $where = "";
        //search
        if (!empty($search) && !empty($field)) {
            switch ($field) {
                case '1':
                    $where = " WHERE s.saleid LIKE '%$search%'";
                    break;
                case '2':
                    $where = " WHERE c.cusname LIKE '%$search%'";
                    break;
                case '3':
                    $where = " WHERE m.modname LIKE '%$search%'";
                    break;
                case '4':
                    $where = " WHERE s.saledate LIKE '%$search%'";
                    break;
            }
        }

        $order_by = " ORDER BY $sort_column $sort_order";

        $sql_total = "SELECT COUNT(*) as total " . $sql_base . $where;
        $total_results = $conn->query($sql_total)->fetch_assoc()['total'];
        $pages = ceil($total_results / $limit);

        $sql_final = "SELECT s.saleid, c.cusname, m.modname, s.quantity, s.amount, s.saledate " .
            $sql_base . $where . $order_by . " LIMIT $start, $limit";

        $result = $conn->query($sql_final);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>#" . $row["saleid"] . "</td>";
                echo "<td>" . $row["cusname"] . "</td>";
                echo "<td>" . $row["modname"] . "</td>";
                echo "<td>" . $row["quantity"] . "</td>";
                echo "<td class='fw-medium text-success'>$" . number_format($row["amount"], 2) . "</td>";
                echo "<td>" . date('d-M-Y H:i', strtotime($row["saledate"])) . "</td>";
                echo "<td>
                        <a href='sales/edit.php?saleid=" . $row["saleid"] . "' class='btn btn-outline-success rounded-circle'>
                        <i class='fa-solid fa-pen-to-square'></i>
                        </a>
                        <a href='sales/delete.php?id=" . $row["saleid"] . "' class='btn btn-outline-danger rounded-circle' onclick='return confirm(\"Delete this record?\");'>
                        <i class='fa-solid fa-trash-can'></i>
                        </a>
                    </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='text-center py-4 text-muted'>No results found for \"<strong>$search</strong>\"</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'layout/Pagination.php'; ?>