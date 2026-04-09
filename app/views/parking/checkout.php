<h2 class="app-title">🅿️ SmartPark</h2>
<p class="subtitle">Check In Kendaraan</p>

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
    <td><?= htmlspecialchars($r['id']) ?></td>
    <td><?= htmlspecialchars($r['card_id']) ?></td>
    <td><?= htmlspecialchars($r['checkin_time']) ?></td>
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
