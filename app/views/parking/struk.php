<!DOCTYPE html>
<html>
<head>
    <title>Struk Parkir</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f5f7fa;
        }
        .struk {
            width: 320px;
            margin: 40px auto;
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #ddd;
        }
        h3 {
            text-align: center;
            margin-bottom: 5px;
        }
        .line {
            border-top: 1px dashed #aaa;
            margin: 10px 0;
        }
        .row {
            display: flex;
            justify-content: space-between;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 12px;
            color: #666;
        }
        button {
            width: 100%;
            margin-top: 15px;
            padding: 8px;
        }
    </style>
</head>
<body>

<div class="struk">
    <h3>🅿️ SMARTPARK</h3>
    <div class="line"></div>

    <div class="row"><span>ID</span><span><?= $data['id'] ?></span></div>
    <div class="row"><span>RFID</span><span><?= $data['card_id'] ?></span></div>
    <div class="row"><span>Masuk</span><span><?= $data['checkin_time'] ?></span></div>
    <div class="row"><span>Keluar</span><span><?= $data['checkout_time'] ?></span></div>

    <div class="line"></div>

    <div class="row"><span>Durasi</span><span><?= $data['duration'] ?> jam</span></div>
    <div class="row"><strong>Total</strong>
        <strong>Rp <?= number_format($data['fee']) ?></strong>
    </div>

    <button onclick="window.print()">🖨️ Cetak</button>

    <div class="footer">
        Terima kasih 🙏<br>
        Parkir Aman & Nyaman
    </div>
</div>

</body>
</html>
