<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-file-text-o icon-title"></i> Laporan Data Obat Masuk dan Keluar
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Laporan</li>
        <li class="active">Data Obat Masuk dan Keluar</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <!-- Form Laporan -->
            <div class="box box-primary">
                <div class="box-body">
                    <!-- tampilan tabel obat -->
                    <table id="LaporanData" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Obat</th>
                                <th>Nama Obat</th>
                                <th>Golongan</th>
                                <th>Satuan</th>
                                <th>Jumlah Masuk</th>
                                <th>Jumlah Keluar</th>
                                <th>Sisa Stok</th>
                                <th>Tanggal Exp</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>User Input</th>
                                <th>User Output</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php
                            $no = 1;
                            // fungsi query untuk menampilkan data dari tabel obat
                            $query = mysqli_query($mysqli, "SELECT is_obat.kode_obat, is_obat.nama_obat, is_obat.golongan_obat, is_obat.satuan, is_obat_masuk.jumlah_masuk, is_obat_keluar.jumlah_keluar, is_obat.stok, is_obat_masuk.tanggal_exp, is_obat_masuk.tanggal_masuk, is_obat_keluar.tanggal_keluar, is_obat_masuk.created_user, is_obat_keluar.created_user, is_users.id_user, is_users.nama_user 
                            FROM is_obat 
                            JOIN is_obat_masuk ON is_obat.kode_obat = is_obat_masuk.kode_obat 
                            JOIN is_obat_keluar ON is_obat.kode_obat = is_obat_keluar.kode_obat
                            JOIN is_users ON is_users.id_user = is_obat_masuk.created_user
                            ")
                                or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));
                            // tampilkan data
                            while ($data = mysqli_fetch_assoc($query)) {
                                // $harga_beli = format_rupiah($data['harga_beli']);
                                // $harga_jual = format_rupiah($data['harga_jual']);
                                // menampilkan isi tabel dari database ke tabel di aplikasi
                                echo "<tr>
                      <td>$no</td>
                      <td>$data[kode_obat]</td>
                      <td>$data[nama_obat]</td>
                      <td>$data[golongan_obat]</td>
                      <td>$data[satuan]</td>
                      <td>$data[jumlah_masuk]</td>
                      <td>$data[jumlah_keluar]</td>
                      <td>$data[stok]</td>
                      <td>$data[tanggal_exp]</td>
                      <td>$data[tanggal_masuk]</td>
                      <td>$data[tanggal_keluar]</td>
                      <td>$data[nama_user]</td>
                      <td>$data[nama_user]</td>
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
</section><!-- /.content -->