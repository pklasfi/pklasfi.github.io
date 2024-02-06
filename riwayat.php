<?php
include 'connection.php';
$query_show=mysqli_query($connect,"SELECT * FROM boking_riwayat");
$query_ruang=mysqli_query($connect,"SELECT * FROM ruang");
date_default_timezone_set('Asia/Jakarta');
$result= mysqli_fetch_ALL($query_show, MYSQLI_ASSOC);
$ruang= mysqli_fetch_ALL($query_ruang, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat</title>
    
    <script defer src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script defer src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script defer src="table.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="/asset/output.css">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<a href="index.html"><img src="imah-removebg-preview.png" width="100 " right="100"> </a></h3>
    <div class="mx-6">
        <table  id="example" class="table table-striped w-full " >
            <thead>
            <tr>
                <th class="border border-slate-300 text-center p-2">No.</th>
                <th class="border border-slate-300 text-center p-2">Nama</th>
                <th class="border border-slate-300 text-center p-2">No Telpon</th>
                <th class="border border-slate-300 text-center p-2">Divisi</th>
                <th class="border border-slate-300 text-center p-2">Mulai Booking</th>
                <th class="border border-slate-300 text-center p-2">Selesai Booking</th>
                <th class="border border-slate-300 text-center p-2">Booking Ruang</th>
                <th class="border border-slate-300 text-center p-2">Status</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                $num = 0;
                foreach($result as $hasil): ?>
            <tr >
                <td  class="border border-slate-300 text-center p-2"><?php echo $num+=1; ?></td>
                <td  class="border border-slate-300 text-center p-2"><?php echo $hasil['nama']; ?></td>
                <td  class="border border-slate-300 text-center p-2"><?php echo $hasil['no_telp']; ?></td>
                <td  class="border border-slate-300 text-center p-2"><?php echo $hasil['divisi']; ?></td>
                <td  class="border border-slate-300 text-center p-2"><?php echo $hasil['start_time']; ?></td>
                <td  class="border border-slate-300 text-center p-2"><?php echo $hasil['end_time']; ?></td>
                <td  class="border border-slate-300 text-center p-2"><?php 
                echo $ruang[intval($hasil['ruang_id'])-1]['nama_ruangan'];
                
                ?></td>
                <td  class="border border-slate-300 text-center p-2"><?php
                $current_time =new DateTime();
                $end = new DateTime($hasil['end_time']);
                if ($current_time >= $end) {
                    echo '<div class="w-fit bg-red-700 text-white font-bold px-4 py-1 rounded-full">SELESAI</div>';
                }else{
                    echo '<div class="w-fit bg-blue-700 text-white font-bold px-4 py-1 rounded-full">BELUM</div>';
                }?></td>
                
            </tr>
            <?php endforeach; ?>
            </tbody>
            
            
            
        </table>
    </div>
</body>

</html>