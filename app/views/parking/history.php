<h2 class="app-title">🅿️ SmartPark</h2>
<p class="subtitle">Check Out Kendaraan</p>

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
    <td><?= htmlspecialchars($r['id']) ?></td>
    <td><?= htmlspecialchars($r['card_id']) ?></td>
    <td><?= htmlspecialchars($r['checkout_time']) ?></td>
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
