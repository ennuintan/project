<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-file-text-o icon-title"></i> Laporan Data BHP Masuk dan Keluar
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Laporan</li>
        <li class="active">Data BHP Masuk dan Keluar</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">

            <!-- Form Laporan -->
            <div class="box box-primary">
                <div class="box-body">
                    <!-- tampilan tabel bhp -->
                    <table id="LaporanData" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode BHP</th>
                                <th>Nama BHP</th>
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
                            // fungsi query untuk menampilkan data dari tabel bhp
                            $query = mysqli_query($mysqli, "SELECT is_bhp.kode_bhp, is_bhp.nama_bhp, is_bhp.golongan_bhp, is_bhp.satuan, is_bhp_masuk.jumlah_masuk, is_bhp_keluar.jumlah_keluar, is_bhp.stok, is_bhp_masuk.tanggal_exp, is_bhp_masuk.tanggal_masuk, is_bhp_keluar.tanggal_keluar, is_bhp_masuk.created_user, is_bhp_keluar.created_user, is_users.id_user, is_users.nama_user  
                            FROM is_bhp 
                            JOIN is_bhp_masuk ON is_bhp.kode_bhp = is_bhp_masuk.kode_bhp 
                            JOIN is_bhp_keluar ON is_bhp.kode_bhp = is_bhp_keluar.kode_bhp
                            JOIN is_users ON is_users.id_user = is_bhp_masuk.created_user
                            ")
                                or die('Ada kesalahan pada query tampil Data bhp: ' . mysqli_error($mysqli));
                            // tampilkan data
                            while ($data = mysqli_fetch_assoc($query)) {
                                // $harga_beli = format_rupiah($data['harga_beli']);
                                // $harga_jual = format_rupiah($data['harga_jual']);
                                // menampilkan isi tabel dari database ke tabel di aplikasi
                            ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $data['kode_bhp'] ?></td>
                                <td><?= $data['nama_bhp'] ?></td>
                                <td><?= $data['golongan_bhp'] ?></td>
                                <td><?= $data['satuan'] ?></td>
                                <td><?= $data['jumlah_masuk'] ?></td>
                                <td><?= $data['jumlah_keluar'] ?></td>
                                <td><?= $data['stok'] ?></td>
                                <td><?= $data['tanggal_exp'] ?></td>
                                <td><?= $data['tanggal_masuk'] ?></td>
                                <td><?= $data['tanggal_keluar'] ?></td>
                                <td><?= $data['nama_user'] ?></td>
                                <td><?= $data['nama_user'] ?></td>
                            </tr>
                            <?php
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