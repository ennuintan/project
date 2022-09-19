<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-sign-out icon-title"></i> Data Obat Keluar

        <a class="btn btn-primary btn-social pull-right" href="?module=pilih_obat_keluar"
            title="Tambah Data Obat Keluar" data-toggle="tooltip">
            <i class="fa fa-plus"></i> Keluar
        </a>
    </h1>

</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php
            // fungsi untuk menampilkan pesan
            // jika alert = "" (kosong)
            // tampilkan pesan "" (kosong)
            if (empty($_GET['alert'])) {
                echo "";
            }
            // jika alert = 1
            // tampilkan pesan Sukses "Data Obat keluar berhasil disimpan"
            elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Obat keluar berhasil disimpan.
            </div>";
            }
            // jika alert = 2
            // tampilkan pesan Sukses "Data obat keluar berhasil diubah"
            elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Obat keluar berhasil diubah.
            </div>";
            }
            // jika alert = 3
            // tampilkan pesan Sukses "Data Obat keluar berhasil dihapus"
            elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Obat keluar berhasil dihapus.
            </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <!-- tampilan tabel Obat -->
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th class="center">Tanggal Exp</th>
                                <th class="center">Tanggal Keluar</th>
                                <th class="center">Kode Obat</th>
                                <th class="center">Nama Obat</th>
                                <th class="center">Jumlah Keluar</th>
                                <th class="center">Satuan</th>
                                <th class="center">User</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php
                            $no = 1;
                            // fungsi query untuk menampilkan data dari tabel obat keluar
                            $query = mysqli_query($mysqli, "SELECT a.id, a.tanggal_exp, a.tanggal_keluar,a.kode_obat,a.jumlah_keluar,b.kode_obat,b.nama_obat,b.satuan, c.nama_user
                                            FROM is_obat_keluar as a JOIN is_obat as b ON a.kode_obat=b.kode_obat
                                            JOIN is_users as c ON c.id_user = a.created_user ORDER BY id DESC")
                                or die('Ada kesalahan pada query tampil Data Obat Keluar: ' . mysqli_error($mysqli));

                            // tampilkan data
                            while ($data = mysqli_fetch_assoc($query)) {
                                $tanggal         = $data['tanggal_keluar'];
                                $exp             = explode('-', $tanggal);
                                $tanggal_keluar   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

                                $tanggal         = $data['tanggal_exp'];
                                $exp             = explode('-', $tanggal);
                                $tanggal_exp   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

                                // menampilkan isi tabel dari database ke tabel di aplikasi
                                echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='100' class='center'>$tanggal_exp</td>
                      <td width='80' class='center'>$tanggal_keluar</td>
                      <td width='80' class='center'>$data[kode_obat]</td>
                      <td width='200'>$data[nama_obat]</td>
                      <td width='100' align='center'>$data[jumlah_keluar]</td>
                      <td width='80' class='center'>$data[satuan]</td>
                      <td width='80' class='center'>$data[nama_user]</td>
                      <td class='center' width='80'>
                        <div>
                        ";
                            ?>
                            <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm"
                                href="modules/obat-keluar/proses.php?act=delete&id=<?php echo $data['id']; ?>"
                                onclick="return confirm('Anda yakin ingin menghapus obat <?php echo $data['nama_obat']; ?> ?');">
                                <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                            </a>
                            <?php
                                echo "    </div>
                    </tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section><!-- /.content