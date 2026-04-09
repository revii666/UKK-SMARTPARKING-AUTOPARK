<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>AutoPark Login</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Inter',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:linear-gradient(135deg,#0f2c33,#123a44);
}

/* CONTAINER */

.container{
width:820px;
height:480px;
display:flex;
border-radius:20px;
overflow:hidden;
box-shadow:0 25px 50px rgba(0,0,0,0.35);
background:white;
}

/* LEFT BRAND */

.left{
flex:1;
background:linear-gradient(135deg,#0f2c33,#123a44);
color:white;
display:flex;
flex-direction:column;
justify-content:center;
align-items:center;
padding:40px;
text-align:center;
}

.left img{
width:90px;
margin-bottom:20px;
}

.left h1{
font-size:26px;
font-weight:600;
margin-bottom:10px;
}

.left p{
font-size:14px;
opacity:0.8;
}

/* RIGHT LOGIN */

.right{
flex:1;
display:flex;
flex-direction:column;
justify-content:center;
padding:50px;
}

.right h2{
margin-bottom:25px;
color:#123a44;
}

/* INPUT */

.form-group{
margin-bottom:18px;
}

.form-group label{
font-size:13px;
color:#444;
display:block;
margin-bottom:6px;
}

.form-group input{
width:100%;
padding:11px;
border:1px solid #ddd;
border-radius:8px;
outline:none;
transition:0.2s;
}

.form-group input:focus{
border-color:#0f766e;
}

/* PASSWORD ICON */

.password-box{
position:relative;
}

.password-toggle{
position:absolute;
right:10px;
top:50%;
transform:translateY(-50%);
cursor:pointer;
font-size:13px;
color:#666;
}

/* BUTTON */

.login-btn{
margin-top:10px;
width:100%;
padding:12px;
border:none;
border-radius:8px;
background:#0f766e;
color:white;
font-weight:500;
cursor:pointer;
transition:0.2s;
}

.login-btn:hover{
background:#0d5e58;
}

/* ERROR */

.error{
background:#ffe5e5;
color:#d60000;
padding:8px;
border-radius:6px;
margin-bottom:10px;
font-size:13px;
text-align:center;
}

</style>
</head>

<body>

<div class="container">

<!-- LEFT -->

<div class="left">

<img src="/smart_parking/public/assets/logo.png" alt="AutoPark Logo">

<h1>AutoPark</h1>

<p>Smart Parking Management System</p>

</div>

<!-- RIGHT -->

<div class="right">

<h2>Login</h2>

<?php if(isset($error)): ?>
<div class="error"><?= $error ?></div>
<?php endif; ?>

<form method="POST">

<div class="form-group">
<label>Username</label>
<input type="text" name="username" required>
</div>

<div class="form-group password-box">
<label>Password</label>
<input type="password" name="password" id="password" required>
<span class="password-toggle" onclick="togglePassword()">Show</span>
</div>

<button class="login-btn">Masuk</button>

</form>

</div>

</div>

<script>

function togglePassword(){

var pass=document.getElementById("password");

if(pass.type==="password"){
pass.type="text";
}else{
pass.type="password";
}

}

</script>

</body>
</html>