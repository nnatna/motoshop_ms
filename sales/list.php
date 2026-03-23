<div class="d-flex justify-content-between align-items-center mb-4">
    <h3><i class="bi bi-receipt-cutoff text-success"></i>Lists Motos</h3>
    <a href="motos\add.php" class="btn btn-success rounded-pill"><i class="bi-plus-circle"></i> Add New Moto</a>
</div>
<?php
$field = isset($_POST["txtfield"]) ? $_POST["txtfield"] : "";
$search = isset($_POST["txtsearch"]) ? $_POST["txtsearch"] : "";
$code_model = $field == 1 ? "Selected" : "";
$braname = $field == 2 ? "Selected" : "";
$modname = $field == 3 ? "Selected" : "";
$yearmade = $field == 4 ? "Selected" : "";
$price = $field == 5 ? "Selected" : "";
$Act = $field == 6 ? "Selected" : "";
?>
<fieldset>
    <legend class="text-start fw-bold text-dark mt-2">Lookup</legend>
    <form method="post" class="d-flex justify-content-between mb-3">
        <div class="text-start row g-3 align-items-center">
            <div class="col-auto">
                <select name="txtfield" class="form-select rounded-pill">
                    <option class="text-secondary">Choose field</option>
                    <option value="1" <?php echo ($code_model) ?>>Code</option>
                    <option value="2" <?php echo ($braname) ?>>Brand</option>
                    <option value="3" <?php echo ($modname) ?>>Model</option>
                    <option value="4" <?php echo ($yearmade) ?>>Year</option>
                    <option value="5" <?php echo ($price) ?>>Price</option>
                    <option value="6" <?php echo ($Act) ?>>Action</option>
                </select>
            </div>
            <div class="col-auto d-flex justify-content-between align-items-center gap-1 ">
                <input type="text" name="txtsearch" value="<?php echo ($search) ?>" class="form-control rounded-pill" placeholder="Search...">
                <a type="submit" name="btnsearch" value="Search" class='bi-search btn btn-outline-secondary rounded-circle'></a>
                <a type="submit" name="btnreset" value="Reset" class='bi-arrow-counterclockwise btn btn-danger rounded-circle'></a>
            </div>
        </div>
        <div class="text-end">
            <a type="submit" name="btnasc" value="A-Z" class='bi-sort-alpha-down btn btn-outline-success rounded-circle'></a>
            <a type="submit" name="btndesc" value="Z-A" class='bi-sort-alpha-up-alt btn btn-outline-danger rounded-circle'></a>
        </div>
    </form>
</fieldset>
<div>

</div>
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
        $sql = "SELECT m.code_model, b.braname, m.modname, m.color, m.yearmade, m.price, m.Act, m.stock 
                            FROM tblModel m 
                            JOIN tblBrand b ON m.braid = b.braid";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='aling-middle'>";
            echo "<td>" . $row["code_model"] . "</td>";
            echo "<td>" . $row["braname"] . "</td>";
            echo "<td>" . $row["modname"] . "</td>";
            echo "<td>" . $row["color"] . "</td>";
            echo "<td>" . $row["yearmade"] . "</td>";
            echo "<td>$" . number_format($row["price"], 2) . "</td>";
            echo "<td class='text-center'>" . $row["Act"] . "</td>";
            echo "<td>" . $row["stock"] . "</td>";
            echo "<td class='text-center'>
        <a href='EditModel.php?code_model=" . $row["code_model"] . "' class='bi bi-pencil-square btn btn-outline-primary rounded-circle'></a>
        <a href='DeleteModel.php?code_model=" . $row["code_model"] . "' class='bi bi-trash btn btn-outline-danger rounded-circle' onclick='return confirm(\"Are you sure you want to delete this model?\");'></a>
                        </td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>


<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#salesTable').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    });
</script>