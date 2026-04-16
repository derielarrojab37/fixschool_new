<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data User - Fix School</title>
    <style>
        body { font-family: sans-serif; padding: 30px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { background-color: #f2f2f2; text-align: left; padding: 12px; border: 1px solid #ddd; }
        td { padding: 10px; border: 1px solid #ddd; font-size: 14px; }
        tr:nth-child(even) { background-color: #fafafa; }
        .footer { margin-top: 30px; text-align: right; font-size: 12px; }
    </style>
</head>
<body onload="window.print()">
    <div class="header">
        <h2 style="margin:0;">FIX SCHOOL MANAGEMENT</h2>
        <p style="margin:5px 0;">Laporan Data Pengguna Sistem</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th>Username</th>
                <th width="15%">Role</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($users)): $no = 1; foreach ($users as $u): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $u['nama'] ?></td>
                    <td><?= $u['email'] ?></td>
                    <td><?= $u['username'] ?></td>
                    <td><?= ucfirst($u['role']) ?></td>
                </tr>
            <?php endforeach; else: ?>
                <tr><td colspan="5" style="text-align:center;">Tidak ada data ditemukan</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada: <?= date('d/m/Y H:i:s') ?>
    </div>
</body>
</html>