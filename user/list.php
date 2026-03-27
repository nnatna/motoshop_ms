<div class="d-flex justify-content-between align-items-center mb-1">
    <div>
        <h3 class="fw-bold text-success"><i class="fa-solid fa-user me-1"></i>List Of Users</h3>
        <p class="text-muted">List all user transactions in the shop</p>
    </div>
    <div>
        <a href="./user/add.php" class="btn btn-success rounded-pill fw-bold"><i class="bi-plus-circle"></i> User</a>
    </div>
</div>

<?php
$field = isset($_POST["txtfield"]) ? $_POST["txtfield"] : "";
$search = isset($_POST["txtsearch"]) ? $_POST["txtsearch"] : "";
$userid = $field == 1 ? "Selected" : "";
$full_name = $field == 2 ? "Selected" : "";
$username = $field == 3 ? "Selected" : "";
$role = $field == 4 ? "Selected" : "";
?>
<fieldset>
    <form method="post" class="d-flex justify-content-between mb-3">
        <div class="text-start row g-3 align-items-center">
            <div class="col-auto">
                <select name="txtfield" class="form-select shadow-none border-dark-subtle rounded-pill">
                    <option class="text-secondary">Choose field</option>
                    <option value="1" <?php echo ($userid) ?>>ID</option>
                    <option value="2" <?php echo ($full_name) ?>>Full Name</option>
                    <option value="3" <?php echo ($username) ?>>Username</option>
                    <option value="4" <?php echo ($role) ?>>Role</option>
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
<div>

</div>
<table id="Table" class="table table-hover text-center align-middle mb-0">
    <thead>
        <tr class="table-secondary fs-5">
            <th>ID</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Password</th>
            <th>Role</th>
            <th class="text-center">Options</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require("db.php");

        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $start = ($page - 1) * $limit;
        $total_results = $conn->query("SELECT COUNT(*) as id FROM tbluser")->fetch_assoc()['id'];
        $pages = ceil($total_results / $limit);
        $sql = "SELECT * FROM tbluser";
        //search
        if (isset($_POST['btnsearch'])) {
            $field = $_POST['txtfield'];
            $text = $_POST['txtsearch'];
            switch ($field) {
                case '1':
                    $sql .= " WHERE userid LIKE '%$text%'";
                    break;
                case '2':
                    $sql .= " WHERE full_name LIKE '%$text%'";
                    break;
                case '3':
                    $sql .= " WHERE username LIKE '%$text%'";
                    break;
                case '4':
                    $sql .= " WHERE role LIKE '%$text%'";
                    break;
            }
        }
        //sort asc
        if (isset($_POST['btnasc'])) {
            $field = $_POST['txtfield'];
            switch ($field) {
                case '1':
                    $sql .= " ORDER BY userid ASC";
                    break;
                case '2':
                    $sql .= " ORDER BY full_name ASC";
                    break;
                case '3':
                    $sql .= " ORDER BY username ASC";
                    break;
                case '4':
                    $sql .= " ORDER BY role ASC";
                    break;
            }
        }
        //sort desc
        if (isset($_POST['btndesc'])) {
            $field = $_POST['txtfield'];
            switch ($field) {
                case '1':
                    $sql .= " ORDER BY userid DESC";
                    break;
                case '2':
                    $sql .= " ORDER BY full_name DESC";
                    break;
                case '3':
                    $sql .= " ORDER BY username DESC";
                    break;
                case '4':
                    $sql .= " ORDER BY role DESC";
                    break;
                case '5':
            }
        }

        $sql .= " LIMIT $start, $limit";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["userid"] . "</td>";
            echo "<td>" . $row["full_name"] . "</td>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td class='text-muted'>" . $row["password"] . "</td>";
            echo "<td class='text-danger fw-medium'>" . $row["role"] . "</td>";
            echo "<td>
            <a href='./user/edit.php?userid=" . $row["userid"] . "' class='btn btn-outline-success rounded-circle'>
            <i class='fa-solid fa-pen-to-square'></i>
            </a>
            <a href='./user/delete.php?userid=" . $row["userid"] . "' class='btn btn-outline-danger rounded-circle' onclick='return confirm(\"Are you sure?\");'>
            <i class='fa-solid fa-trash-can'></i>
            </a>
          </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<?php include 'layout/Pagination.php'; ?>