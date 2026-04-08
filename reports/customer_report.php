<div class="card table-responsive bg-white rounded-4 shadow-sm p-3" id="sales_report">
    <h5 class="text-success text-center fw-bold">Customer Report</h5>
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr class="table-secondary">
                <th>Date</th>
                <th>Customer</th>
                <th>Motorcycle</th>
                <th>Qty</th>
                <th>Total Amount</th>
                <th>Seller</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT saledate, cusname, braname, modname, quantity, amount, full_name 
            FROM vcustomer_report 
            WHERE saledate BETWEEN ? AND ?
            ORDER BY saledate DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $start, $end);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . date('d-M-Y H:i', strtotime($row['saledate'])) . "</td>";
                    echo "<td class='fw-medium'>" . $row['cusname'] . "</td>";
                    echo "<td>" . $row['braname'] . " " . $row['modname'] . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td class='text-success fw-medium'>$" . number_format($row['amount'], 2) . "</td>";
                    echo "<td class='fw-medium text-muted'>" . $row['full_name'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center py-4 text-muted'>No transactions found for this period.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>