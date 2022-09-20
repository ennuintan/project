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

            $id_bhp_masuk   = $_POST['id'];
            // ambil data hasil submit dari form
            $tanggal1        = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_exp']));
            $exp1            = explode('-', $tanggal1);
            $tanggal_exp     = $exp1[2] . "-" . $exp1[1] . "-" . $exp1[0];

            $tanggal2        = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
            $exp2            = explode('-', $tanggal2);
            $tanggal_keluar  = $exp2[2] . "-" . $exp2[1] . "-" . $exp2[0];

            $kode_bhp       = mysqli_real_escape_string($mysqli, trim($_POST['kode_bhp']));
            $jumlah_keluar   = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
            // $total_stok      = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));

            $created_user    = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel bhp keluar
            $query = mysqli_query($mysqli, "INSERT INTO is_bhp_keluar(id_bhp_masuk,tanggal_exp,tanggal_keluar,kode_bhp,jumlah_keluar,created_user) 
                                            VALUES('$id_bhp_masuk','$tanggal_exp','$tanggal_keluar','$kode_bhp','$jumlah_keluar','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {

                $query1 = mysqli_query($mysqli, "SELECT * FROM is_bhp  WHERE kode_bhp = '$kode_bhp'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                while ($data = mysqli_fetch_assoc($query1)) {
                    // var_dump($data);
                    // die();
                    $stok          = $data['stok'];

                    // perintah query untuk mengubah data pada tabel bhp
                    $query2 = mysqli_query($mysqli, "UPDATE is_bhp SET stok = '$stok' - '$jumlah_keluar' WHERE kode_bhp = '$kode_bhp'")
                        or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
                    // cek query
                    if ($query2) {
                        // jika berhasil tampilkan pesan berhasil simpan data
                        header("location: ../../main.php?module=bhp_keluar&alert=1");
                    }
                }
            }
        }
    } elseif ($_GET['act'] == 'update') {
        if (isset($_POST['simpan'])) {

            $id_bhp_masuk   = $_POST['id'];
            // ambil data hasil submit dari form
            $tanggal1        = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_exp']));
            $exp1            = explode('-', $tanggal1);
            $tanggal_exp     = $exp1[2] . "-" . $exp1[1] . "-" . $exp1[0];

            $tanggal2        = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
            $exp2            = explode('-', $tanggal2);
            $tanggal_keluar  = $exp2[2] . "-" . $exp2[1] . "-" . $exp2[0];

            $kode_bhp       = mysqli_real_escape_string($mysqli, trim($_POST['kode_bhp']));
            $jumlah_keluar   = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));

            $created_user    = $_SESSION['id_user'];

            // perintah query untuk menyimpan data ke tabel bhp keluar
            $query = mysqli_query($mysqli, "INSERT INTO is_bhp_keluar(id_bhp_masuk,tanggal_exp,tanggal_keluar,kode_bhp,jumlah_keluar,created_user) 
                                            VALUES('$id_bhp_masuk','$tanggal_exp','$tanggal_keluar','$kode_bhp','$jumlah_keluar','$created_user')")
                or die('Ada kesalahan pada query insert : ' . mysqli_error($mysqli));

            // cek query
            if ($query) {

                $query1 = mysqli_query($mysqli, "SELECT * FROM is_bhp  WHERE kode_bhp = '$kode_bhp'")
                    or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

                while ($data = mysqli_fetch_assoc($query1)) {
                    // var_dump($data);
                    // die();
                    $stok          = $data['stok'];

                    // perintah query untuk mengubah data pada tabel bhp
                    $query2 = mysqli_query($mysqli, "UPDATE is_bhp SET stok = '$stok' - '$jumlah_keluar' WHERE kode_bhp = '$kode_bhp'")
                        or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
                    // cek query
                    if ($query2) {
                        // jika berhasil tampilkan pesan berhasil simpan data
                        header("location: ../../main.php?module=bhp_keluar&alert=1");
                    }
                }
            }
        }
    } elseif ($_GET['act'] == 'delete') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // perintah query untuk mengambil data bhp keluar
            $query = mysqli_query($mysqli, "SELECT * FROM is_bhp_keluar JOIN is_bhp ON is_bhp_keluar.kode_bhp=is_bhp.kode_bhp WHERE is_bhp_keluar.id = '$id' GROUP BY is_bhp.kode_bhp")
                or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));

            while ($data = mysqli_fetch_assoc($query)) {
                // var_dump($data);
                // die();
                $jumlah_keluar = $data['jumlah_keluar'];
                $stok          = $data['stok'];
                $kode_bhp     = $data['kode_bhp'];

                if ($query) {
                    // perintah query untuk mengubah data pada tabel bhp
                    $query1 = mysqli_query($mysqli, "UPDATE is_bhp SET stok = '$stok' + '$jumlah_keluar' WHERE kode_bhp = '$kode_bhp'")
                        or die('Ada kesalahan pada query update : ' . mysqli_error($mysqli));
                    // die();

                    if ($query1) {
                        // perintah untuk hapus data pada tabel bhp keluar
                        $query2 = mysqli_query($mysqli, "DELETE FROM is_bhp_keluar WHERE id='$id'")
                            or die('Ada kesalahan pada query delete : ' . mysqli_error($mysqli));
                        // jika berhasil tampilkan pesan berhasil delete data
                        header("location: ../../main.php?module=bhp_keluar&alert=3");
                    }
                }
            }
        }
    }
}