<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SmartPark Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', sans-serif;
            color: #1f3a5f;
        }
        .app-title { font-weight: 600; }
        .subtitle { color: #6c757d; margin-bottom: 30px; }
        .card-box {
            background: #fff;
            border-radius: 14px;
            padding: 22px;
            margin-bottom: 30px;
            border: 1px solid #e1e5ea;
            box-shadow: 0 6px 18px rgba(0,0,0,0.05);
        }
        .table-custom th {
            background: #1f3a5f;
            color: #fff;
            padding: 12px;
        }
        .table-custom td {
            padding: 12px;
            border-bottom: 1px solid #e1e5ea;
        }
        .badge-in { background:#2ecc71; padding:6px 14px; border-radius:20px; color:#fff; }
        .badge-out { background:#f1c40f; padding:6px 14px; border-radius:20px; color:#fff; }
        .badge-done { background:#3a6ea5; padding:6px 14px; border-radius:20px; color:#fff; }
    </style>
</head>

<body class="p-4">

<h2 class="app-title">🅿️ SmartPark</h2>
<p class="subtitle">Parking Management System</p>

<!-- KENDARAAN MASUK -->
<div class="card-box">
<h5>📥 Kendaraan Sedang Parkir</h5>

<table class="table table-custom">
<tr>
    <th>ID</th>
    <th>Card ID</th>
    <th>Check-In</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php if (!empty($in)): ?>
<?php foreach ($in as $r): ?>
<tr>
    <td><?= $r['id'] ?></td>
    <td><?= $r['card_id'] ?></td>
    <td><?= $r['checkin_time'] ?></td>
    <td><span class="badge-in">MASUK</span></td>
    <td>
        <a href="index.php?action=checkout&id=<?= $r['id'] ?>"
           class="btn btn-warning btn-sm">
           Scan Exit
        </a>
    </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="5" class="text-center">Tidak ada kendaraan</td>
</tr>
<?php endif; ?>
</table>
</div>

<!-- KENDARAAN KELUAR -->
<div class="card-box">
<h5>📤 Kendaraan Akan Keluar</h5>

<table class="table table-custom">
<tr>
    <th>ID</th>
    <th>Card ID</th>
    <th>Checkout</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

<?php if (!empty($out)): ?>
<?php foreach ($out as $r): ?>
<tr>
    <td><?= $r['id'] ?></td>
    <td><?= $r['card_id'] ?></td>
    <td><?= $r['checkout_time'] ?></td>
    <td><span class="badge-out">KELUAR</span></td>
    <td>
        <a href="index.php?action=open&id=<?= $r['id'] ?>"
           class="btn btn-success btn-sm">
           Buka Palang
        </a>
    </td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr>
    <td colspan="5" class="text-center">Tidak ada data</td>
</tr>
<?php endif; ?>
</table>
</div>

<!-- LOG PARKIR -->
<div class="card-box">
    <h5>📜 Log Parkir</h5>
    <table class="table table-custom">
        <thead>
            <tr>
                <th>ID</th>
                <th>Card ID</th>
                <th>Durasi</th>
                <th>Biaya</th>
                <th class="text-center">Aksi</th> 
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($log)): ?>
                <?php foreach ($log as $r): ?>
                <tr>
                    <td><?= htmlspecialchars($r['id']) ?></td>
                    <td><?= htmlspecialchars($r['card_id']) ?></td>
                    <td><?= htmlspecialchars($r['duration']) ?> jam</td>
                    <td>Rp <?= number_format($r['fee'], 0, ',', '.') ?></td>
                    <td class="text-center">
                        <a href="index.php?action=struk&id=<?= $r['id'] ?>" 
                           class="btn btn-primary btn-sm" 
                           target="_blank">
                           Cetak Struk
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">Belum ada log</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
