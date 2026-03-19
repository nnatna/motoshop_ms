
<!DOCTYPE html>
<html lang="km">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>បញ្ជីអតិថិជន | MotoShop</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kantumruy+Pro:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Kantumruy Pro', sans-serif; background-color: #f4f7f6; }
        .main-card { border: none; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .table thead { background-color: #f8f9fa; }
        .dataTables_filter input { border-radius: 20px; padding-left: 15px; border: 1px solid #ddd; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold"><i class="bi bi-people text-primary"></i> គ្រប់គ្រងអតិថិជន</h3>
        <a href="add.php" class="btn btn-primary px-4 shadow-sm">
            <i class="bi bi-person-plus-fill"></i> បន្ថែមអតិថិជន
        </a>
    </div>

    <div class="card main-card">
        <div class="card-body p-4">
            <div class="table-responsive">
                <table id="customerTable" class="table table-hover align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>ល.រ (ID)</th>
                            <th>ឈ្មោះអតិថិជន</th>
                            <th>លេខទូរស័ព្ទ</th>
                            <th>អាសយដ្ឋាន</th>
                            <th class="text-center">សកម្មភាព</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- <?php while($row = $result->fetch_assoc()): ?> -->
                        <tr>
                            <!-- <td>#<?php echo $row['id']; ?></td> -->
                            <!-- <?php echo $row['name']; ?> -->
                            <td class="fw-bold text-dark"></td>
                            <!-- <td><i class="bi bi-telephone text-muted"></i> <?php echo $row['phone']; ?></td> -->
                            <!-- <td><?php echo $row['address'] ?? '---'; ?></td> -->
                            <td class="text-center">
                                <!-- ?id=<?php echo $row['id']; ?> -->
                                <a href="customers/edit.php" class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i> កែប្រែ
                                </a>
                                <!-- =<?php echo $row['id']; ?> -->
                                <a href="customer/delete.php" 
                                   class="btn btn-sm btn-outline-danger" 
                                   onclick="return confirm('តើអ្នកពិតជាចង់លុបទិន្នន័យនេះមែនទេ?')">
                                    <i class="bi bi-trash"></i> លុប
                                </a>
                            </td>
                        </tr>
                        <!-- <?php endwhile; ?> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#customerTable').DataTable({
        "language": {
            "search": "ស្វែងរក:",
            "lengthMenu": "បង្ហាញ _MENU_ ជួរ",
            "zeroRecords": "មិនមានទិន្នន័យឡើយ",
            "info": "បង្ហាញពីជួរទី _START_ ដល់ _END_ នៃទិន្នន័យសរុប _TOTAL_ ជួរ",
            "infoEmpty": "មិនមានទិន្នន័យ",
            "paginate": {
                "first": "ដំបូង",
                "last": "ចុងក្រោយ",
                "next": "បន្ទាប់",
                "previous": "ថយក្រោយ"
            }
        },
        "order": [[0, "desc"]] // តម្រៀបលេខរៀង (ID) ពីធំទៅតូចជាមុន
    });
});
</script> 
</body>
</html>