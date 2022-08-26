<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan pesan = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk insert, update, dan delete
else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['simpan'])) {
            // ambil data hasil submit dari form
            $tanggal1        = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_exp']));
            $exp1             = explode('-', $tanggal1);
            $tanggal_exp   = $exp1[2] . "-" . $exp1[1] . "-" . $exp1[0];

            $tanggal2         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
            $exp2             = explode('-', $tanggal2);
            $tanggal_keluar   = $exp2[2] . "-" . $exp2[1] . "-" . $exp2[0];

            $kode_bhp       = mysqli_real_escape_string($mysqli, trim($_POST['kode_bhp']));
            $jumlah_keluar    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
            $total_stok      = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));

            $created_user    = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel bhp keluar
            $query = mysqli_query($mysqli, "INSERT INTO is_bhp_keluar(tanggal_exp,tanggal_keluar,kode_bhp,jumlah_keluar,created_user) 
                                            VALUES('$tanggal_exp','$tanggal_keluar','$kode_bhp','$jumlah_keluar','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {
                // perintah query untuk mengubah data pada tabel bhp
                $query1 = mysqli_query($mysqli, "UPDATE is_bhp SET stok        = '$total_stok'
                                                              WHERE kode_bhp   = '$kode_bhp'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query1) {
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=bhp_keluar&alert=1");
                }
            }
        }
    } elseif ($_GET['act'] == 'update') {
        if (isset($_POST['simpan'])) {
            if (isset($_POST['kode_bhp'])) {
                // ambil data hasil submit dari form
                $kode_bhp  = mysqli_real_escape_string($mysqli, trim($_POST['kode_bhp']));
                $nama_bhp  = mysqli_real_escape_string($mysqli, trim($_POST['nama_bhp']));
                $golongan_bhp  = mysqli_real_escape_string($mysqli, trim($_POST['golongan_bhp']));
                $satuan     = mysqli_real_escape_string($mysqli, trim($_POST['satuan']));

                $updated_user = $_SESSION['id_user'];

                // perintah query untuk mengubah data pada tabel bhp
                $query = mysqli_query($mysqli, "UPDATE is_bhp SET  nama_bhp       = '$nama_bhp',
                                                                    golongan_bhp   = '$golongan_bhp',
                                                                    satuan          = '$satuan',
                                                                    updated_user    = '$updated_user'
                                                              WHERE kode_bhp       = '$kode_bhp'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query) {
                    // jika berhasil tampilkan pesan berhasil update data
                    header("location: ../../main.php?module=bhp&alert=2");
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['id'])) {
            $kode_bhp = $_GET['id'];

            // perintah query untuk menghapus data pada tabel bhp
            $query = mysqli_query($mysqli, "DELETE FROM is_bhp WHERE kode_bhp='$kode_bhp'")
                or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));

            // cek hasil query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil delete data
                header("location: ../../main.php?module=bhp&alert=3");
            }
        }
    }
}