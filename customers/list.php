<div class="d-flex justify-content-between align-items-center mb-1">
    <div>
        <h3 class="fw-bold text-success"><i class="fa-solid fa-user-group me-1"></i>List Of Customers</h3>
        <p class="text-muted">Manage all customer information in the system</p>
    </div>
    <div>
        <a href="customers/add.php" class="btn btn-success rounded-pill fw-bold">
            <i class="bi bi-plus-circle me-1"></i>Customer
        </a>
    </div>
</div>

<?php



$field = isset($_POST["txtfield"]) ? $_POST["txtfield"] : "";
$search = isset($_POST["txtsearch"]) ? $_POST["txtsearch"] : "";

$sel_id      = ($field == "1") ? "selected" : "";
$sel_name    = ($field == "2") ? "selected" : "";
$sel_gender  = ($field == "3") ? "selected" : "";
$sel_phone   = ($field == "4") ? "selected" : "";
$sel_address = ($field == "5") ? "selected" : "";
?>
<fieldset>
    <form method="post" class="d-flex justify-content-between mb-3">
        <div class="text-start row g-3 align-items-center">
            <div class="col-auto">
                <select name="txtfield" class="form-select shadow-none border-dark-subtle rounded-pill">
                    <option value="">Choose field</option>
                    <option value="1" <?= $sel_id ?>>ID</option>
                    <option value="2" <?= $sel_name ?>>Name</option>
                    <option value="3" <?= $sel_gender ?>>Gender</option>
                    <option value="4" <?= $sel_phone ?>>Phone</option>
                    <option value="5" <?= $sel_address ?>>Address</option>
                </select>
            </div>

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

<div class="card table-responsive bg-white rounded-4 p-3">
    <table id="Table" class="table table-hover align-middle">
    <thead>
        <tr class="table-secondary">
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Phone Number</th>
            <th>Address</th>
            <th class="text-center">Options</th>
        </tr>
    </thead>
   <tbody>
    <?php
    require("db.php");

    $limit = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    
    $where = "";
    if (isset($_POST['btnsearch']) && !empty($_POST['txtfield']) && !empty($_POST['txtsearch'])) {
        $field = $_POST['txtfield'];
        $search = $_POST['txtsearch'];
        $cols = ["1"=>"cusid", "2"=>"cusname", "3"=>"gender", "4"=>"phone", "5"=>"address"];
        
        if (array_key_exists($field, $cols)) {
            $colName = $cols[$field];
            $where = " WHERE $colName LIKE '%" . $conn->real_escape_string($search) . "%'";
        }
    }

  
    $order = " ORDER BY cusid DESC"; 
    if ((isset($_POST['btnasc']) || isset($_POST['btndesc'])) && !empty($_POST['txtfield'])) {
        $field = $_POST['txtfield'];
        $cols = ["1"=>"cusid", "2"=>"cusname", "3"=>"gender", "4"=>"phone", "5"=>"address"];
        
        if (array_key_exists($field, $cols)) {
            $sortType = isset($_POST['btnasc']) ? "ASC" : "DESC";
            $order = " ORDER BY " . $cols[$field] . " $sortType";
        }
    }

    
    $total_query = $conn->query("SELECT COUNT(*) as total FROM tblCustomers $where");
    $total_res = ($total_query) ? $total_query->fetch_assoc()['total'] : 0;
    $pages = ceil($total_res / $limit);


    $final_sql = "SELECT * FROM tblCustomers $where $order LIMIT $start, $limit";
    $result = $conn->query($final_sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>#" . $row["cusid"] . "</td>";
            echo "<td class='fw-medium'>" . $row["cusname"] . "</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["phone"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td class='text-center'>
                <a href='./customers/edit.php?cusid=" . $row["cusid"] . "' class='btn btn-outline-success rounded-circle'>
                <i class='fa-solid fa-pen-to-square'></i>
                </a>
                <a href='./customers/delete.php?cusid=" . $row["cusid"] . "' class='btn btn-outline-danger rounded-circle' onclick='return confirm(\"Are you sure?\");'>
                <i class='fa-solid fa-trash-can'></i>
                </a>
            </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6' class='py-4 text-danger'>No records found!</td></tr>";
    }
    ?>
</tbody>
</table>
</div>

<?php include 'layout/Pagination.php'; ?>