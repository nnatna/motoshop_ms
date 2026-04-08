<div class="card table-responsive bg-white text-dark rounded-4 shadow-sm p-3">
    <h5 class="text-success text-center fw-bold">Employee Report</h5>
    <table class="table table-hover align-middle">
        <thead class="table-dark">
            <tr class="table-secondary">
                <th>ID</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Total Sold</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT u.userid, u.full_name, u.role, 
                COUNT(s.saleid) as total_sales_count, 
                COALESCE(SUM(s.amount), 0) as total_sales_amount
                FROM tbluser u
                LEFT JOIN tblSales s ON u.userid = s.userid AND s.saledate BETWEEN ? AND ?
                GROUP BY u.userid, u.full_name, u.role
                ORDER BY total_sales_amount DESC";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $start, $end);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['userid'] . "</td>";
                    echo "<td class='fw-medium'>" . $row['full_name'] . "</td>";
                    echo "<td class='fw-medium text-danger'>" . $row['role'] . "</td>";
                    echo "<td>" . $row['total_sales_count'] . "</td>";
                    echo "<td class='text-success fw-medium'>$" . number_format($row['total_sales_amount'], 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center py-4 text-muted'>No transactions found for this period.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>