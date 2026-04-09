<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Smart Parking Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:linear-gradient(135deg,#0f2c33,#123a44);
color:white;
padding:40px;
}

/* HEADER */

.header{
text-align:center;
margin-bottom:40px;
position:relative;
}

.header h1{
font-size:28px;
font-weight:600;
}

.logout{
position:absolute;
right:0;
top:0;
background:#ff5a4d;
padding:8px 18px;
border-radius:6px;
text-decoration:none;
color:white;
font-size:14px;
}

/* SECTION */

.section{
background:#0b232a;
padding:25px;
border-radius:12px;
margin-bottom:25px;
}

.section h2{
margin-bottom:15px;
}

/* TABLE */

table{
width:100%;
border-collapse:collapse;
}

th{
text-align:left;
padding:12px;
background:#13414a;
}

td{
padding:12px;
border-bottom:1px solid rgba(255,255,255,0.08);
}

tr:hover{
background:#0f3942;
}

/* BADGE */

.badge{
padding:5px 12px;
border-radius:20px;
font-size:12px;
}

.masuk{
background:#27ae60;
}

.done{
background:#3498db;
}

/* BUTTON */

.btn{
padding:6px 12px;
border-radius:6px;
text-decoration:none;
color:white;
font-size:12px;
}

.btn-exit{
background:#f39c12;
}

.btn-open{
background:#2ecc71;
}

.btn-print{
background:#3498db;
}

</style>
</head>

<body>


<!-- HEADER -->

<div class="header">

<a href="index.php?action=logout" class="logout">Logout</a>

<h1>Smart Parking Dashboard</h1>

</div>


<!-- KENDARAAN PARKIR -->

<div class="section">

<h2>Kendaraan Sedang Parkir</h2>

<table>

<thead>
<tr>
<th>ID</th>
<th>Card</th>
<th>Masuk</th>
<th>Status</th>
</tr>
</thead>

<tbody id="parkirTable"></tbody>

</table>

</div>


<!-- KENDARAAN AKAN KELUAR -->

<div class="section">

<h2>Kendaraan Akan Keluar</h2>

<table>

<thead>
<tr>
<th>ID</th>
<th>Card</th>
<th>Masuk</th>
<th>Keluar</th>
<th>Durasi</th>
<th>Biaya</th>
<th>Aksi</th>
</tr>
</thead>

<tbody id="checkoutTable"></tbody>

</table>

</div>


<!-- LOG PARKIR -->

<div class="section">

<h2>Log Parkir</h2>

<table>

<thead>
<tr>
<th>ID</th>
<th>Card</th>
<th>Masuk</th>
<th>Keluar</th>
<th>Durasi</th>
<th>Biaya</th>
<th>Status</th>
<th>Aksi</th>
</tr>
</thead>

<tbody id="logTable"></tbody>

</table>

</div>



<script>

function loadData(){

fetch("get_data.php")
.then(res=>res.json())
.then(data=>{

let parkir="";
let checkout="";
let log="";

/* kendaraan parkir */

data.in.forEach(row=>{

parkir+=`

<tr>

<td>${row.id}</td>
<td>${row.card_id}</td>
<td>${row.checkin_time}</td>

<td>
<span class="badge masuk">MASUK</span>
</td>


</tr>

`;

});


/* checkout */

data.out.forEach(row=>{

checkout+=`

<tr>

<td>${row.id}</td>
<td>${row.card_id}</td>
<td>${row.checkin_time}</td>
<td>${row.checkout_time}</td>
<td>${row.duration} jam</td>
<td>Rp ${row.fee}</td>

<td>

<a href="index.php?action=open&id=${row.id}" 
class="btn btn-open"
onclick="return confirm('Buka palang kendaraan ini?')">

Buka Palang

</a>

</td>

</tr>

`;

});


/* log */

data.log.forEach(row=>{

log+=`

<tr>

<td>${row.id}</td>
<td>${row.card_id}</td>
<td>${row.checkin_time}</td>
<td>${row.checkout_time}</td>
<td>${row.duration} jam</td>
<td>Rp ${row.fee}</td>

<td>
<span class="badge done">SELESAI</span>
</td>

<td>
<a href="index.php?action=struk&id=${row.id}" class="btn btn-print">
Cetak Struk
</a>
</td>

</tr>

`;

});


document.getElementById("parkirTable").innerHTML=parkir;
document.getElementById("checkoutTable").innerHTML=checkout;
document.getElementById("logTable").innerHTML=log;

});

}

/* refresh otomatis */

setInterval(loadData,3000);

loadData();

</script>

</body>
</html>