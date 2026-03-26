<div class="d-flex justify-content-between align-items-center mb-1">
    <div>
        <h3 class="fw-bold text-success"><i class="bi bi-people-fill"></i> Customer List</h3>
        <p class="text-muted">Manage all customer information in the system</p>
    </div>
    <div>
        <a href="customers/add.php" class="btn btn-success rounded-pill fw-bold">
            <i class="bi-plus-circle"></i> Add Customer
        </a>
    </div>
</div>

<?php


// ចាប់យកតម្លៃសម្រាប់ Search និង Sort
$field = isset($_POST["txtfield"]) ? $_POST["txtfield"] : "";
$search = isset($_POST["txtsearch"]) ? $_POST["txtsearch"] : "";

// កំណត់ចំណងជើងជម្រើស Select
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
                <select name="txtfield" class="form-select rounded-pill">
                    <option value="">Choose field</option>
                    <option value="1" <?= $sel_id ?>>ID</option>
                    <option value="2" <?= $sel_name ?>>Name</option>
                    <option value="3" <?= $sel_gender ?>>Gender</option>
                    <option value="4" <?= $sel_phone ?>>Phone</option>
                    <option value="5" <?= $sel_address ?>>Address</option>
                </select>
            </div>

            <div class="col-auto d-flex gap-1">
                <input type="text" name="txtsearch" value="<?= htmlspecialchars($search) ?>" 
                       class="form-control rounded-pill" placeholder="Search...">
                
                <button type="submit" name="btnsearch" class="btn btn-outline-secondary rounded-circle">
                    <i class="bi-search"></i>
                </button>

                <button type="submit" name="btnreset" class="btn btn-danger rounded-circle">
                    <i class="bi-arrow-counterclockwise"></i>
                </button>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" name="btnasc" class="btn btn-outline-success rounded-circle">
                <i class="bi-sort-alpha-down"></i>
            </button>
            <button type="submit" name="btndesc" class="btn btn-outline-danger rounded-circle">
                <i class="bi-sort-alpha-up-alt"></i>
            </button>
        </div>
    </form>
</fieldset>

<table id="Table" class="table table-hover text-center align-middle mb-0">
    <thead>
        <tr class="table-secondary fs-5">
            <th>ID</th>
            <th> Name</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Address</th>
            <th class="text-center">Options</th>
        </tr>
    </thead>
   <tbody>
    <?php
    require("db.php");

    // ១. កំណត់តម្លៃ Pagination (ទំព័រ)
    $limit = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($page - 1) * $limit;

    // ២. មុខងារ Search (ទាញយកពី POST)
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

    // ៣. មុខងារ Sort (លំដាប់លំដោយ)
    $order = " ORDER BY cusid DESC"; // តម្លៃដើម (Default)
    if ((isset($_POST['btnasc']) || isset($_POST['btndesc'])) && !empty($_POST['txtfield'])) {
        $field = $_POST['txtfield'];
        $cols = ["1"=>"cusid", "2"=>"cusname", "3"=>"gender", "4"=>"phone", "5"=>"address"];
        
        if (array_key_exists($field, $cols)) {
            $sortType = isset($_POST['btnasc']) ? "ASC" : "DESC";
            $order = " ORDER BY " . $cols[$field] . " $sortType";
        }
    }

    // ៤. រាប់ចំនួនសរុបសម្រាប់ Pagination (ប្រើក្នុង Pagination.php)
    $total_query = $conn->query("SELECT COUNT(*) as total FROM tblCustomers $where");
    $total_res = ($total_query) ? $total_query->fetch_assoc()['total'] : 0;
    $pages = ceil($total_res / $limit);

    // ៥. ទាញទិន្នន័យពិតប្រាកដ
    $final_sql = "SELECT * FROM tblCustomers $where $order LIMIT $start, $limit";
    $result = $conn->query($final_sql);

    // ៦. បង្ហាញទិន្នន័យក្នុង Table
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?= $row["cusid"] ?></td>
                <td class="text-start"><?= htmlspecialchars($row["cusname"]) ?></td>
                <td><?= $row["gender"] ?></td>
                <td><?= $row["phone"] ?></td>
                <td><?= htmlspecialchars($row["address"]) ?></td>
                <td class="text-center">
                    <a href="./customers/edit.php?id=<?= $row["cusid"] ?>" 
                       class="bi bi-pencil-square btn btn-outline-primary rounded-circle"></a>
                    
                    <a href="./customers/delete.php?id=<?= $row["cusid"] ?>" 
                       class="bi bi-trash btn btn-outline-danger rounded-circle" 
                       onclick="return confirm('Are you sure you want to delete this customer?');"></a>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<tr><td colspan='6' class='py-4 text-danger'>No records found!</td></tr>";
    }
    ?>
</tbody>
</table>

<?php include 'layout/Pagination.php'; ?>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>