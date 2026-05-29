<?php

date_default_timezone_set("Asia/Jakarta");

$conn = mysqli_connect("localhost","root","","rental_game");

$weekday_ps = 10000;
$weekend_ps = 12000;

$weekday_bilyar = 35000;
$weekend_bilyar = 40000;

$koin_dingdong = 2000;

$total = 0;
$kembalian = 0;

if(isset($_POST['hitung'])){

$kategori = $_POST['kategori'];
$item = $_POST['item'];
$hari = $_POST['hari'];

$qty = $_POST['qty'];

$metode = $_POST['metode'];

$bayar = $_POST['bayar'];

$diskon = $_POST['diskon'];

$diskon_custom = $_POST['diskon_custom'];

$harga = 0;

// PS
if(
$kategori == "PS4" ||
$kategori == "PS5" ||
$kategori == "Simulator"
){

if($hari == "weekday"){
$harga = $weekday_ps;
}else{
$harga = $weekend_ps;
}

}

// Bilyar
if($kategori == "Bilyar"){

if($hari == "weekday"){
$harga = $weekday_bilyar;
}else{
$harga = $weekend_bilyar;
}

}

// Dingdong
if($kategori == "Dingdong"){
$harga = $koin_dingdong;
}

// Minuman
if($item == "Mineral"){ $harga = 4000; }

if($item == "Milku Coklat"){ $harga = 6000; }

if($item == "Milku Strawberry"){ $harga = 6000; }

if($item == "Floridina"){ $harga = 5000; }

if($item == "Fanta"){ $harga = 5000; }

if($item == "Sprite"){ $harga = 5000; }

$total = $harga * $qty;

$potongan = ($total * $diskon) / 100;

$total_bayar = $total - $potongan - $diskon_custom;

$kembalian = $bayar - $total_bayar;

$tanggal = date("Y-m-d");

$jam = date("H:i:s");

mysqli_query($conn,"
INSERT INTO transaksi
(
kategori,
item,
hari,
qty,
metode,
total,
bayar,
kembalian,
tanggal,
jam
)

VALUES
(
'$kategori',
'$item',
'$hari',
'$qty',
'$metode',
'$total_bayar',
'$bayar',
'$kembalian',
'$tanggal',
'$jam'
)
");

}

function getTotal($conn,$kategori,$metode){

$q = mysqli_query($conn,"
SELECT SUM(total) as total
FROM transaksi
WHERE kategori='$kategori'
AND metode='$metode'
");

$d = mysqli_fetch_assoc($q);

return $d['total'] ?? 0;

}

$ps4_cash = getTotal($conn,"PS4","Cash");
$ps4_qris = getTotal($conn,"PS4","QRIS");

$ps5_cash = getTotal($conn,"PS5","Cash");
$ps5_qris = getTotal($conn,"PS5","QRIS");

$sim_cash = getTotal($conn,"Simulator","Cash");
$sim_qris = getTotal($conn,"Simulator","QRIS");

$bilyar_cash = getTotal($conn,"Bilyar","Cash");
$bilyar_qris = getTotal($conn,"Bilyar","QRIS");

// Dingdong
$dingdong_cash = getTotal($conn,"Dingdong","Cash");
$dingdong_qris = getTotal($conn,"Dingdong","QRIS");

// Minuman
$minuman_cash = getTotal($conn,"Minuman","Cash");
$minuman_qris = getTotal($conn,"Minuman","QRIS");

?>

<!DOCTYPE html>
<html>
<head>

<title>Rental Game</title>

<style>

body{
font-family:Arial;
background:#f1f1f1;
}

.box{
width:800px;
margin:auto;
background:white;
padding:20px;
border-radius:10px;
}

input,select,button{
width:100%;
padding:10px;
margin-top:10px;
}

button{
background:blue;
color:white;
border:none;
}

.timer-box{

border:1px solid #ccc;

padding:15px;

margin-top:15px;

border-radius:10px;

background:#fafafa;

}

.rekap{
background:#fff3cd;
padding:15px;
margin-top:20px;
border-radius:10px;
}

table{
width:100%;
margin-top:20px;
}

</style>

</head>

<body>

<div class="box">

<h1>Kasir Rental Game</h1>

<form method="POST">

<label>Kategori</label>

<select name="kategori">

<option>PS4</option>
<option>PS5</option>
<option>Simulator</option>
<option>Bilyar</option>
<option>Dingdong</option>
<option>Minuman</option>

</select>

<label>Item</label>

<select name="item">

<option>PS4 05</option>
<option>PS4 06</option>
<option>PS4 07</option>
<option>PS4 08</option>
<option>PS4 09</option>

<option>PS4 12</option>
<option>PS4 13</option>
<option>PS4 14</option>
<option>PS4 15</option>
<option>PS4 16</option>

<option>PS5 01</option>
<option>PS5 02</option>
<option>PS5 03</option>
<option>PS5 04</option>

<option>PS5 10</option>
<option>PS5 11</option>

<option>Simulator 17</option>
<option>Simulator 18</option>

<option>Simulator LT2 01</option>
<option>Simulator LT2 02</option>

<option>Bilyar LT1 01</option>
<option>Bilyar LT1 02</option>
<option>Bilyar LT1 03</option>

<option>Bilyar LT2 03</option>
<option>Bilyar LT2 04</option>
<option>Bilyar LT2 05</option>

<option>Klik Dingdong</option>

<option>Mineral</option>
<option>Milku Coklat</option>
<option>Milku Strawberry</option>
<option>Floridina</option>
<option>Fanta</option>
<option>Sprite</option>

</select>

<label>Hari</label>

<select name="hari">

<option value="weekday">Weekday</option>
<option value="weekend">Weekend</option>

</select>

<label>Jam / Qty</label>

<input type="number" name="qty">

<label>Pembayaran</label>

<select name="metode">

<option>Cash</option>
<option>QRIS</option>

</select>

<label>Diskon %</label>

<select name="diskon">

<option value="0">0%</option>
<option value="5">5%</option>
<option value="10">10%</option>
<option value="15">15%</option>
<option value="20">20%</option>
<option value="25">25%</option>

</select>

<label>Diskon Custom</label>

<input type="number"
name="diskon_custom"
value="0">

<label>Bayar</label>

<input type="number" name="bayar">

<button type="submit" name="hitung">
Simpan
</button>

</form>

<?php if($total > 0){ ?>

<div class="rekap">

<h2>Hasil Transaksi</h2>

<p>Kategori :
<?= $kategori ?></p>

<p>Item :
<?= $item ?></p>

<p>Hari :
<?= $hari ?></p>

<p>Jam / Qty :
<?= $qty ?></p>

<p>Pembayaran :
<?= $metode ?></p>

<hr>

<p>Total Awal :
Rp <?= number_format($total) ?></p>

<p>Diskon :
<?= $diskon ?>%</p>

<p>Diskon Custom :
Rp <?= number_format($diskon_custom) ?></p>

<hr>

<p>Total Bayar :
Rp <?= number_format($total_bayar) ?></p>

<p>Uang Bayar :
Rp <?= number_format($bayar) ?></p>

<p>Kembalian :
Rp <?= number_format($kembalian) ?></p>

<hr>

<p>Tanggal :
<?= $tanggal ?></p>

<p>Jam :
<?= $jam ?></p>

</div>

<?php } ?>

<div class="rekap">

<h2>Rekap Pembayaran</h2>

<h3>PS4</h3>
<p>Cash : Rp <?= number_format($ps4_cash) ?></p>
<p>QRIS : Rp <?= number_format($ps4_qris) ?></p>

<hr>

<h3>PS5</h3>
<p>Cash : Rp <?= number_format($ps5_cash) ?></p>
<p>QRIS : Rp <?= number_format($ps5_qris) ?></p>

<hr>

<h3>Simulator</h3>
<p>Cash : Rp <?= number_format($sim_cash) ?></p>
<p>QRIS : Rp <?= number_format($sim_qris) ?></p>

<hr>

<h3>Bilyar</h3>
<p>Cash : Rp <?= number_format($bilyar_cash) ?></p>
<p>QRIS : Rp <?= number_format($bilyar_qris) ?></p>

<hr>

<h3>Dingdong</h3>

<p>Cash :
Rp <?= number_format($dingdong_cash) ?></p>

<p>QRIS :
Rp <?= number_format($dingdong_qris) ?></p>

<hr>

<h3>Minuman</h3>

<p>Cash :
Rp <?= number_format($minuman_cash) ?></p>

<p>QRIS :
Rp <?= number_format($minuman_qris) ?></p>

</div>

<h2>Timer Room Lengkap</h2>

<!-- PS4 05-09 -->

<div class="timer-box">
<h3>PS4 05</h3>
<input type="number" id="ps405">
<button onclick="startTimer('ps405','timer405')">Mulai</button>
<h2 id="timer405">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS4 06</h3>
<input type="number" id="ps406">
<button onclick="startTimer('ps406','timer406')">Mulai</button>
<h2 id="timer406">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS4 07</h3>
<input type="number" id="ps407">
<button onclick="startTimer('ps407','timer407')">Mulai</button>
<h2 id="timer407">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS4 08</h3>
<input type="number" id="ps408">
<button onclick="startTimer('ps408','timer408')">Mulai</button>
<h2 id="timer408">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS4 09</h3>
<input type="number" id="ps409">
<button onclick="startTimer('ps409','timer409')">Mulai</button>
<h2 id="timer409">00:00:00</h2>
</div>

<!-- PS4 12-16 -->

<div class="timer-box">
<h3>PS4 12</h3>
<input type="number" id="ps412">
<button onclick="startTimer('ps412','timer412')">Mulai</button>
<h2 id="timer412">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS4 13</h3>
<input type="number" id="ps413">
<button onclick="startTimer('ps413','timer413')">Mulai</button>
<h2 id="timer413">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS4 14</h3>
<input type="number" id="ps414">
<button onclick="startTimer('ps414','timer414')">Mulai</button>
<h2 id="timer414">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS4 15</h3>
<input type="number" id="ps415">
<button onclick="startTimer('ps415','timer415')">Mulai</button>
<h2 id="timer415">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS4 16</h3>
<input type="number" id="ps416">
<button onclick="startTimer('ps416','timer416')">Mulai</button>
<h2 id="timer416">00:00:00</h2>
</div>

<!-- PS5 01-04 -->

<div class="timer-box">
<h3>PS5 01</h3>
<input type="number" id="ps501">
<button onclick="startTimer('ps501','timer501')">Mulai</button>
<h2 id="timer501">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS5 02</h3>
<input type="number" id="ps502">
<button onclick="startTimer('ps502','timer502')">Mulai</button>
<h2 id="timer502">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS5 03</h3>
<input type="number" id="ps503">
<button onclick="startTimer('ps503','timer503')">Mulai</button>
<h2 id="timer503">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS5 04</h3>
<input type="number" id="ps504">
<button onclick="startTimer('ps504','timer504')">Mulai</button>
<h2 id="timer504">00:00:00</h2>
</div>

<!-- PS5 10-11 -->

<div class="timer-box">
<h3>PS5 10</h3>
<input type="number" id="ps510">
<button onclick="startTimer('ps510','timer510')">Mulai</button>
<h2 id="timer510">00:00:00</h2>
</div>

<div class="timer-box">
<h3>PS5 11</h3>
<input type="number" id="ps511">
<button onclick="startTimer('ps511','timer511')">Mulai</button>
<h2 id="timer511">00:00:00</h2>
</div>

<!-- Simulator -->

<div class="timer-box">
<h3>Simulator 17</h3>
<input type="number" id="sim17">
<button onclick="startTimer('sim17','timersim17')">Mulai</button>
<h2 id="timersim17">00:00:00</h2>
</div>

<div class="timer-box">
<h3>Simulator 18</h3>
<input type="number" id="sim18">
<button onclick="startTimer('sim18','timersim18')">Mulai</button>
<h2 id="timersim18">00:00:00</h2>
</div>

<!-- Simulator LT2 -->

<div class="timer-box">
<h3>Simulator LT2 01</h3>
<input type="number" id="simlt201">
<button onclick="startTimer('simlt201','timersimlt201')">Mulai</button>
<h2 id="timersimlt201">00:00:00</h2>
</div>

<div class="timer-box">
<h3>Simulator LT2 02</h3>
<input type="number" id="simlt202">
<button onclick="startTimer('simlt202','timersimlt202')">Mulai</button>
<h2 id="timersimlt202">00:00:00</h2>
</div>

<!-- Bilyar LT1 -->

<div class="timer-box">
<h3>Bilyar LT1 01</h3>
<input type="number" id="b101">
<button onclick="startTimer('b101','timerb101')">Mulai</button>
<h2 id="timerb101">00:00:00</h2>
</div>

<div class="timer-box">
<h3>Bilyar LT1 02</h3>
<input type="number" id="b102">
<button onclick="startTimer('b102','timerb102')">Mulai</button>
<h2 id="timerb102">00:00:00</h2>
</div>

<div class="timer-box">
<h3>Bilyar LT1 03</h3>
<input type="number" id="b103">
<button onclick="startTimer('b103','timerb103')">Mulai</button>
<h2 id="timerb103">00:00:00</h2>
</div>

<!-- Bilyar LT2 -->

<div class="timer-box">
<h3>Bilyar LT2 03</h3>
<input type="number" id="b203">
<button onclick="startTimer('b203','timerb203')">Mulai</button>
<h2 id="timerb203">00:00:00</h2>
</div>

<div class="timer-box">
<h3>Bilyar LT2 04</h3>
<input type="number" id="b204">
<button onclick="startTimer('b204','timerb204')">Mulai</button>
<h2 id="timerb204">00:00:00</h2>
</div>

<div class="timer-box">
<h3>Bilyar LT2 05</h3>
<input type="number" id="b205">
<button onclick="startTimer('b205','timerb205')">Mulai</button>
<h2 id="timerb205">00:00:00</h2>
</div>

<audio id="alarm">
<source src="alarm.mp3">
</audio>

<h2>Riwayat Transaksi</h2>

<form method="GET">

<input type="date" name="cari_tanggal">

<button type="submit">
Cari Tanggal
</button>

</form>

<table border="1" cellpadding="8">

<tr>
<th>Tanggal</th>
<th>Jam</th>
<th>Item</th>
<th>Metode</th>
<th>Total</th>
</tr>

<?php

if(isset($_GET['cari_tanggal'])){

$tanggal_cari = $_GET['cari_tanggal'];

$data = mysqli_query($conn,"
SELECT * FROM transaksi
WHERE tanggal='$tanggal_cari'
ORDER BY id DESC
");

}else{

$data = mysqli_query($conn,"
SELECT * FROM transaksi
ORDER BY id DESC
");

}

while($d = mysqli_fetch_array($data)){

?>

<tr>

<td><?= $d['tanggal'] ?></td>
<td><?= $d['jam'] ?></td>
<td><?= $d['item'] ?></td>
<td><?= $d['metode'] ?></td>

<td>
Rp <?= number_format($d['total']) ?>
</td>

</tr>

<?php } ?>

</table>

</div>

<script>

function startTimer(inputId, timerId){

let menit =
document.getElementById(inputId).value;

let waktu = menit * 60;

let timer = setInterval(function(){

let jam =
Math.floor(waktu / 3600);

let menit2 =
Math.floor((waktu % 3600) / 60);

let detik =
waktu % 60;

document.getElementById(timerId).innerHTML =

String(jam).padStart(2,'0')
+ ":" +

String(menit2).padStart(2,'0')
+ ":" +

String(detik).padStart(2,'0');

waktu--;

if(waktu < 0){

clearInterval(timer);

document.getElementById("alarm").play();

alert(timerId + " habis!");

}

},1000);

}

</script>

</body>
</html>