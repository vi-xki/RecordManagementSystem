<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Data Management</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f8f9fa; margin: 0; padding: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; background: #667eea; padding: 20px; color: white; border-radius: 6px; }
        .section { background: white; padding: 20px; margin-top: 20px; border-radius: 6px; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 10px; text-align: left; }
        thead { background-color: #667eea; color: white; }
        tbody tr:nth-child(even) { background-color: #f2f2f2; }
        tbody tr:hover { background-color: #e2e8f0; }
        .btn { padding: 10px 15px; border: none; border-radius: 4px; background: #667eea; color: white; cursor: pointer; }
        .btn:hover { background: #5a67d8; }
        .btn-secondary { background: #6c757d; }
        .message { color: green; margin-bottom: 10px; }
        .filters input { padding: 8px; width: 100%; margin-bottom: 10px; }
        .filters { display: flex; gap: 10px; flex-wrap: wrap; }
    </style>
</head>
<body>

    <div class="header">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?></h2>
        <a href="<?php echo site_url('auth/logout'); ?>" class="btn btn-secondary">Logout</a>
    </div>

    <?php if ($this->session->flashdata('message')): ?>
        <div class="message"><?php echo $this->session->flashdata('message'); ?></div>
    <?php endif; ?>

    <div class="section">
        <h3>Upload CSV File</h3>
        <form method="POST" action="<?php echo site_url('dashboard/upload'); ?>" enctype="multipart/form-data">
            <input type="file" name="file" accept=".csv" required>
            <button class="btn" type="submit">Upload</button>
        </form>
        <p style="font-size: 12px; color: gray;">File must contain: Name, Email, Phone, Department, Salary</p>
    </div>


    <div class="section">
        <h3>Employee Records</h3>

            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Salary</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                            <td>$<?php echo number_format($row['salary'], 2); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($row['created_at'])); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($row['updated_at'])); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

    </div>

</body>
</html>
