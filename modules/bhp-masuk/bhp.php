<?php
session_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";

if (isset($_POST['dataidbhp'])) {
  $kode_bhp = $_POST['dataidbhp'];

  // fungsi query untuk menampilkan data dari tabel bhp
  $query = mysqli_query($mysqli, "SELECT kode_bhp,nama_bhp,satuan,stok FROM is_bhp WHERE kode_bhp='$kode_bhp'")
    or die('Ada kesalahan pada query tampil data bhp: ' . mysqli_error($mysqli));

  // tampilkan data
  $data = mysqli_fetch_assoc($query);

  $stok   = $data['stok'];
  $satuan = $data['satuan'];
  $stoknull = 0;

  if ($stok != '') {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='$stok' readonly>
                    <span class='input-group-addon'>$satuan</span>
                  </div>
                </div>
              </div>";
  } elseif ($stok == null) {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='$stoknull' readonly>
                    <span class='input-group-addon'>$satuan</span>
                  </div>
                </div>
              </div>";
  } else {
    echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='Stok bhp tidak ditemukan' readonly>
                    <span class='input-group-addon'>Satuan bhp tidak ditemukan</span>
                  </div>
                </div>
              </div>";
  }
}