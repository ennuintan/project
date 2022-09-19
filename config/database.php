<?php
// deklarasi parameter koneksi database
// Database Putra
$server   = "localhost";
$username = "root";
$password = "admin";
$database = "persediaan_obat";

// Database Ennuy
// $server   = "localhost";
// $username = "root"; 
// $password = "";
// $database = "persediaan_obat_TERBARU";


// koneksi database
$mysqli = new mysqli($server, $username, $password, $database);

// cek koneksi
if ($mysqli->connect_error) {
    die('Koneksi Database Gagal : ' . $mysqli->connect_error);
}