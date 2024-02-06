<?php
$connect = mysqli_connect('localhost', 'root', '', 'ruangan');
if (!$connect) {
    exit("tidak terkoneksi...");
}
