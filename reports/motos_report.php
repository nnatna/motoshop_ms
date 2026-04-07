<div class="card table-responsive bg-white rounded-4 shadow-sm p-3" id="sales_report">
    <h5 class="text-success text-center fw-bold">Motorcycle Report</h5>
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr class="table-secondary">
                <th>Code</th>
                <th>Motorcycle</th>
                <th>Year</th>
                <th>Price</th>
                <th>Total Sold</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT m.code_model, b.braname, m.modname, m.color, m.year, m.price, 
            COALESCE(SUM(s.quantity), 0) AS total_sold, 
            COALESCE(SUM(s.amount), 0) as total_amount
            FROM tblSales s
            JOIN tblModel m ON s.code_model = m.code_model
            JOIN tblBrand b ON m.braid = b.braid
            WHERE s.saledate BETWEEN ? AND ?
            GROUP BY m.code_model, b.braname, m.modname, m.color, m.year, m.price
            ORDER BY total_amount DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $start, $end);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['code_model'] . "</td>";
                    echo "<td class='fw-medium'>" . $row['braname'] . " " . $row['modname'] . " - " . $row['color'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td class='text-success fw-medium'>$" . number_format($row['price'], 2) . "</td>";
                    echo "<td>" . $row['total_sold'] . "</td>";
                    echo "<td class='text-success fw-medium'>$" . number_format($row['total_amount'], 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center py-4 text-muted'>No transactions found for this period.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>