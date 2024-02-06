<?php
include 'connection.php';
date_default_timezone_set('Asia/Jakarta');
if (isset($_POST['submit'])) {
  $nama = $_POST['name'];
  $telp = $_POST['telp'];
  $divisi = $_POST['divisi'];
  $start = $_POST['start'];
  $end = $_POST['end'];
  $ruang = $_POST['ruang'];
  var_dump($_POST['ruang']);
  $query = mysqli_query($connect, "INSERT INTO boking_riwayat SET nama='$nama', no_telp='$telp', divisi='$divisi',start_time='$start', end_time='$end', ruang_id='$ruang'");
  $query_ruang = mysqli_query($connect, "UPDATE  ruang SET status=1 WHERE id=$ruang");
  if ($query) {
    
    if($query_ruang){
      header('Location:riwayat.php');
    }
  }
}

$current_time =new DateTime();

//ASI
$query_cek_status_asi=mysqli_query($connect,"SELECT end_time FROM boking_riwayat  WHERE ruang_id='1' ORDER BY id DESC LIMIT 1");
$asi= mysqli_fetch_ALL($query_cek_status_asi, MYSQLI_ASSOC);
if ($asi != null) {
  $endasi = new DateTime($asi[0]['end_time']);
  if ($current_time >= $endasi) {
    $query_ruang = mysqli_query($connect, "UPDATE  ruang SET status=0 WHERE id='1'");
    if($query_ruang){
      
    }
  }
}



//IT
$query_cek_status_it=mysqli_query($connect,"SELECT end_time FROM boking_riwayat  WHERE ruang_id='2' ORDER BY id DESC LIMIT 1");
$it= mysqli_fetch_ALL($query_cek_status_it, MYSQLI_ASSOC);
if ($it != null) {
  $endit = new DateTime($it[0]['end_time']);
  if ($current_time >= $endit) {
    $query_ruang = mysqli_query($connect, "UPDATE  ruang SET status=0 WHERE id='2'");
    if($query_ruang){
      
    }
  }
}


// //DATIS
$query_cek_status_datis=mysqli_query($connect,"SELECT end_time FROM boking_riwayat  WHERE ruang_id='3' ORDER BY id DESC LIMIT 1");
$datis= mysqli_fetch_ALL($query_cek_status_datis, MYSQLI_ASSOC);
if ($datis != null) {
  $enddatis = new DateTime($datis[0]['end_time']);
  if ($current_time >= $enddatis) {
    $query_ruang = mysqli_query($connect, "UPDATE  ruang SET status=0 WHERE id='3'");
    if($query_ruang){
      
    }
  }
}


// //TU
$query_cek_status_tu=mysqli_query($connect,"SELECT end_time FROM boking_riwayat  WHERE ruang_id='4' ORDER BY id DESC LIMIT 1");
$tu= mysqli_fetch_ALL($query_cek_status_tu, MYSQLI_ASSOC);
if ($tu != null) {
  $endtu = new DateTime($tu[0]['end_time']);
  if ($current_time >= $endtu) {
    $query_ruang = mysqli_query($connect, "UPDATE  ruang SET status=0 WHERE id='4'");
    if($query_ruang){
      
    }
  }
}

$query_ruang=mysqli_query($connect,"SELECT status FROM ruang");
$ruang_status= mysqli_fetch_ALL($query_ruang, MYSQLI_ASSOC);

?>



<!DOCTYPE html>
<html>
<style>
  input[type=text],
  select {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #f7f3f3;
    border-radius: 4px;
    box-sizing: border-box;
  }

  input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  input[type=submit]:hover {
    background-color: #45a049;
  }

  div {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
  }
</style>
<body>

  <h3>SILAHKAN RESERVASI TERLEBIH DAHULU</h3>
 
  <div>
    <form method="post">
      <label for="fname">NAMA LENGKAP</label>
      <input type="text" id="fname" name="name" placeholder="Nama Anda.." required>

      <label for="telp">NOMER TELP0N</label>
      <input type="text" id="telp" name="telp" placeholder="NO Telpon Anda.." required>

      <label for="divisi">DIVISI</label>
      <input type="text" id="divisi" name="divisi" placeholder="Divisi.." required>

      <label>JADWAL BOOKING</label>
      <p>MULAI : <input type="datetime-local" name="start" required></p>
      <p>SELESAI : <input type="datetime-local" name="end" required></p>
      <label for="ruang">BOOKING RUANG</label>
      <select id="ruang" name="ruang">
        <option >Pilih Ruangan</option>
        <option <?php
        if ($ruang_status[0]['status'] == '1') {
          echo 'disabled';
        }
        ?> value="1">APLIKASI (ASI)</option>
        <option
        <?php 
        if ($ruang_status[1]['status'] == '1') {
          echo 'disabled';
        }
        ?>
        value="2">INFRASTRUKTUR TEKNOLOGI (IT)</option>
        <option
        <?php 
        if ($ruang_status[2]['status'] == '1') {
          echo 'disabled';
        }
        ?>
        value="3">DATA STATISTIK (DATIS)</option>
        <option 
        <?php 
        if ($ruang_status[3]['status'] == '1') {
          echo 'disabled';
        }
        ?>
        value="4">TATA USAHA (TU)</option>

        <input type="submit" name="submit" value="Submit"><br><br>                                      
        <a href="index.html">KEMBALI KEBERANDA </a></h3>
        <h3>HARAP TELITI SAAT MENGISI DATA!</h3>
    </form>
  </div>
    </style>
</body>

</html>