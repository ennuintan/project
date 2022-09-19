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
            $exp1            = explode('-', $tanggal1);
            $tanggal_exp     = $exp1[2] . "-" . $exp1[1] . "-" . $exp1[0];

            $tanggal2        = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_masuk']));
            $exp2            = explode('-', $tanggal2);
            $tanggal_masuk   = $exp2[2] . "-" . $exp2[1] . "-" . $exp2[0];

            $kode_obat       = mysqli_real_escape_string($mysqli, trim($_POST['kode_obat']));
            $jumlah_masuk    = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_masuk']));
            $total_stok      = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));

            $created_user    = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel obat masuk
            $query = mysqli_query($mysqli, "INSERT INTO is_obat_masuk(tanggal_exp,tanggal_masuk,kode_obat,jumlah_masuk,created_user) 
                                            VALUES('$tanggal_exp','$tanggal_masuk','$kode_obat','$jumlah_masuk','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {
                // perintah query untuk mengubah data pada tabel obat
                $query1 = mysqli_query($mysqli, "UPDATE is_obat SET stok        = '$total_stok'
                                                              WHERE kode_obat   = '$kode_obat'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                // cek query
                if ($query1) {
                    // jika berhasil tampilkan pesan berhasil simpan data
                    header("location: ../../main.php?module=obat_masuk&alert=1");
                }
            }
        }
    } elseif ($_GET['act'] == 'update') {
        if (isset($_POST['simpan'])) {
            // if (isset($_POST['id'])) {
            // ambil data hasil submit dari form
            $id             = mysqli_real_escape_string($mysqli, trim($_POST['id']));
            $tanggal_exp    = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_exp']));
            $kode_obat      = mysqli_real_escape_string($mysqli, trim($_POST['kode_obat']));
            $jumlah_masuk   = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_masuk']));

            // perintah query untuk mengubah data pada tabel obat masuk
            $query = mysqli_query($mysqli, "UPDATE is_obat_masuk SET tanggal_exp  = '$tanggal_exp',
                                                                         kode_obat    = '$kode_obat',
                                                                         jumlah_masuk = '$jumlah_masuk',
                                                                   WHERE id           = '$id'")
                or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {
                // jika berhasil tampilkan pesan berhasil update data
                header("location: ../../main.php?module=obat_masuk&alert=2");
                // }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // perintah query untuk mengambil data obat masuk
            $query = mysqli_query($mysqli, "SELECT * FROM is_obat_masuk JOIN is_obat ON is_obat_masuk.kode_obat=is_obat.kode_obat WHERE is_obat_masuk.id = '$id' GROUP BY is_obat.kode_obat")
                or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

            while ($data = mysqli_fetch_assoc($query)) {
                // var_dump($data);
                // die();
                $jumlah_masuk = $data['jumlah_masuk'];
                $stok         = $data['stok'];
                $kode_obat    = $data['kode_obat'];

                if ($query) {
                    // perintah query untuk mengubah data pada tabel obat
                    $query1 = mysqli_query($mysqli, "UPDATE is_obat SET stok = '$stok' - '$jumlah_masuk' WHERE kode_obat = '$kode_obat'")
                        or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
                    // die();

                    if ($query1) {
                        // perintah untuk hapus data pada tabel obat masuk
                        $query2 = mysqli_query($mysqli, "DELETE FROM is_obat_masuk WHERE id='$id'")
                            or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
                        // jika berhasil tampilkan pesan berhasil delete data
                        header("location: ../../main.php?module=obat_masuk&alert=3");
                    }
                }
            }
        }
    }
}