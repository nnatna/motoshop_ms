<div class="d-flex justify-content-between align-items-center mb-1">
    <div>
        <h3 class="fw-bold text-success"><i class="fa-solid fa-motorcycle me-1"></i>List Of Motorcycles</h3>
        <p class="text-muted">List all motorcycle transactions in the shop</p>
    </div>
    <div>
        <a href="motos\add.php" class="btn btn-success rounded-pill fw-bold"><i class="bi-plus-circle"></i> Motorcycle</a>
    </div>
</div>

<?php
$field = isset($_POST["txtfield"]) ? $_POST["txtfield"] : "";
$search = isset($_POST["txtsearch"]) ? $_POST["txtsearch"] : "";
$code_model = $field == 1 ? "Selected" : "";
$braname = $field == 2 ? "Selected" : "";
$modname = $field == 3 ? "Selected" : "";
$year = $field == 4 ? "Selected" : "";
$price = $field == 5 ? "Selected" : "";
$act = $field == 6 ? "Selected" : "";
?>

<fieldset>
    <form method="post" class="d-flex justify-content-between mb-3">
        <div class="text-start row g-3 align-items-center">
            <div class="col-auto">
                <select name="txtfield" class="form-select shadow-none border-dark-subtle rounded-pill">
                    <option class="text-secondary">Choose field</option>
                    <option value="1" <?php echo ($code_model) ?>>Code</option>
                    <option value="2" <?php echo ($braname) ?>>Brand</option>
                    <option value="3" <?php echo ($modname) ?>>Model</option>
                    <option value="4" <?php echo ($year) ?>>Year</option>
                    <option value="5" <?php echo ($price) ?>>Price</option>
                    <option value="6" <?php echo ($act) ?>>Action</option>
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

<table id="Table" class="table table-hover text-center align-middle mb-0">
    <thead>
        <tr class="table-secondary fs-5">
            <th>Code</th>
            <th>Brand</th>
            <th>Model</th>
            <th>Color</th>
            <th>Year</th>
            <th>Price</th>
            <th>Action</th>
            <th>Stock</th>
            <th class="text-center">Options</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require("db.php");

        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;
        $total_results = $conn->query("SELECT COUNT(*) as id FROM tblModel")->fetch_assoc()['id'];
        $pages = ceil($total_results / $limit);
        $sql = "SELECT m.code_model, b.braname, m.modname, m.color, m.year, m.price, m.act, m.stock 
        FROM tblModel m 
        JOIN tblBrand b ON m.braid = b.braid";
        //search
        if (isset($_POST['btnsearch'])) {
            $field = $_POST['txtfield'];
            $text = $_POST['txtsearch'];
            switch ($field) {
                case '1':
                    $sql .= " WHERE m.code_model LIKE '%$text%'";
                    break;
                case '2':
                    $sql .= " WHERE b.braname LIKE '%$text%'";
                    break;
                case '3':
                    $sql .= " WHERE m.modname LIKE '%$text%'";
                    break;
                case '4':
                    $sql .= " WHERE m.year LIKE '%$text%'";
                    break;
                case '5':
                    $sql .= " WHERE m.price LIKE '%$text%'";
                    break;
                case '6':
                    $sql .= " WHERE m.act LIKE '%$text%'";
                    break;
            }
        }
        //sort asc
        if (isset($_POST['btnasc'])) {
            $field = $_POST['txtfield'];
            switch ($field) {
                case '1':
                    $sql .= " ORDER BY m.code_model ASC";
                    break;
                case '2':
                    $sql .= " ORDER BY b.braname ASC";
                    break;
                case '3':
                    $sql .= " ORDER BY m.modname ASC";
                    break;
                case '4':
                    $sql .= " ORDER BY m.year ASC";
                    break;
                case '5':
                    $sql .= " ORDER BY m.price ASC";
                    break;
                case '6':
                    $sql .= " ORDER BY m.act ASC";
                    break;
            }
        }
        //sort desc
        if (isset($_POST['btndesc'])) {
            $field = $_POST['txtfield'];
            switch ($field) {
                case '1':
                    $sql .= " ORDER BY m.code_model DESC";
                    break;
                case '2':
                    $sql .= " ORDER BY b.braname DESC";
                    break;
                case '3':
                    $sql .= " ORDER BY m.modname DESC";
                    break;
                case '4':
                    $sql .= " ORDER BY m.year DESC";
                    break;
                case '5':
                    $sql .= " ORDER BY m.price DESC";
                    break;
                case '6':
                    $sql .= " ORDER BY m.act DESC";
                    break;
            }
        }

        $sql .= " LIMIT $start, $limit";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>#" . $row["code_model"] . "</td>";
            echo "<td>" . $row["braname"] . "</td>";
            echo "<td>" . $row["modname"] . "</td>";
            echo "<td>" . $row["color"] . "</td>";
            echo "<td>" . $row["year"] . "</td>";
            echo "<td class='text-success fw-medium'>$" . number_format($row["price"], 2) . "</td>";
            echo "<td>" . $row["act"] . "</td>";
            echo "<td>" . $row["stock"] . "</td>";
            echo "<td class='text-center'>
            <a href='./motos/edit.php?code_model=" . $row["code_model"] . "' class='btn btn-outline-success rounded-circle'>
            <i class='fa-solid fa-pen-to-square'></i>
            </a>
            <a href='./motos/delete.php?code_model=" . $row["code_model"] . "' class='btn btn-outline-danger rounded-circle' onclick='return confirm(\"Are you sure?\");'>
            <i class='fa-solid fa-trash-can'></i>
            </a>
          </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<?php include 'layout/Pagination.php'; ?>