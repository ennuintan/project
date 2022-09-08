<?php
// deklarasi parameter koneksi database
$server   = "localhost";
$username = "root"; // disesuaikan dengan username phpmyadmin masing-masing
$password = "";
$database = "persediaan_obat_TERBARU";

// koneksi database
$mysqli = new mysqli($server, $username, $password, $database);

// cek koneksi
if ($mysqli->connect_error) {
    die('Koneksi Database Gagal : ' . $mysqli->connect_error);
}