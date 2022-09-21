<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-sign-in icon-title"></i> Data BHP Masuk

        <a class="btn btn-primary btn-social pull-right" href="?module=bhp_keluar" title="Tambah Data"
            data-toggle="tooltip">
            <i class="fa fa-backward"></i> Kembali
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
            // tampilkan pesan Sukses "Data bhp Masuk berhasil disimpan"
            elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data bhp Masuk berhasil disimpan.
            </div>";
            }
            // jika alert = 2
            // tampilkan pesan Sukses "Data bhp Masuk berhasil diubah"
            elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data bhp Masuk berhasil diubah.
            </div>";
            }
            // jika alert = 3
            // tampilkan pesan Sukses "Data bhp Masuk berhasil dihapus"
            elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data bhp Masuk berhasil dihapus.
            </div>";
            }
            ?>

            <div class="box box-primary">
                <div class="box-body">
                    <!-- tampilan tabel bhp -->
                    <table id="dataTables1" class="table table-bordered table-striped table-hover">
                        <!-- tampilan tabel header -->
                        <thead>
                            <tr>
                                <th class="center">No.</th>
                                <th class="center">Tanggal Exp</th>
                                <th class="center">Tanggal Masuk</th>
                                <th class="center">Nama BHP</th>
                                <th class="center">Banyak BHP Masuk</th>
                                <th class="center">Banyak BHP Keluar</th>
                                <th class="center">Satuan</th>
                                <th class="center">Status Exp</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php
                            $no = 1;
                            // fungsi query untuk menampilkan data dari tabel bhp
                            $query = mysqli_query($mysqli, "SELECT 
                            a.id, a.tanggal_exp, a.tanggal_masuk,a.kode_bhp,a.jumlah_masuk, SUM(c.jumlah_keluar) as jumlah_keluar,b.kode_bhp,b.nama_bhp,b.satuan
                                                        FROM is_bhp_masuk as a 
                                                        JOIN is_bhp as b ON b.kode_bhp = a.kode_bhp 
                                                        LEFT JOIN is_bhp_keluar as c ON c.id_bhp_masuk = a.id
                                                        GROUP BY a.id")
                                or die('Ada kesalahan pada query tampil Data bhp Masuk: ' . mysqli_error($mysqli));

                            // tampilkan data
                            while ($data = mysqli_fetch_assoc($query)) {
                                // var_dump($data);
                                $tanggal         = $data['tanggal_masuk'];
                                $exp             = explode('-', $tanggal);
                                $tanggal_masuk   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

                                $tanggal         = $data['tanggal_exp'];
                                $exp             = explode('-', $tanggal);
                                $tanggal_exp     = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

                                // menggunakan hari
                                $masaaktif = $tanggal_exp;
                                $tgl = date("d-m-Y");
                                $masaberlaku = strtotime($masaaktif) - strtotime($tgl);
                                $hasil = $masaberlaku / (24 * 60 * 60);
                                // menampilkan isi tabel dari database ke tabel di aplikasi

                                // menggunakan tahun,bulan,hari
                                $sekarang   = date("m");
                                $awal       = new DateTime($tanggal_exp);
                                $akhir      = new DateTime(); // Waktu sekarang
                                $diff       = $awal->diff($akhir);

                                $startdate  = $tanggal_exp;
                                $expire     = strtotime($startdate);
                                $now        = date("d-m-Y");
                                $today      = strtotime($now);

                            ?>
                            <tr>
                                <td width='30' class='center'><?= $no ?></td>
                                <td width='100' class='center'><?= $tanggal_exp ?></td>
                                <td width='80' class='center'><?= $tanggal_masuk ?></td>
                                <td width='200' class='center'><?= $data['nama_bhp'] ?></td>
                                <td width='80' class='center'><?= $data['jumlah_masuk'] ?></td>

                                <?php if ($data['jumlah_keluar'] == NULL) { ?>
                                <td width='80' class='center'> 0 </td>
                                <?php
                                    } else { ?>
                                <td width='80' class='center'><?= $data['jumlah_keluar'] ?></td>
                                <?php
                                    }
                                    ?>
                                <td width='80' class='center'><?= $data['satuan'] ?></td>
                                <td width='80' class='center'>

                                    <?php if (($diff->y) == NULL && ($diff->m) == $sekarang) { ?>
                                    <?= $diff->format('%m bulan %d hari'); ?>

                                    <?php } elseif ($expire < $today) { ?>
                                    Sudah Exp

                                    <?php } elseif (($diff->y) == NULL && ($diff->m) == NULL) { ?>
                                    <?= $diff->format('%d hari'); ?>

                                    <?php } elseif (($diff->y) == NULL) { ?>
                                    <?= $diff->format('%m bulan %d hari'); ?>

                                    <?php } else {
                                            echo $diff->format('%y tahun %m bulan %d hari');
                                        } ?>

                                </td>
                                <td class='center' width='80'>
                                    <div>
                                        <?php
                                            if ($data['jumlah_masuk'] == $data['jumlah_keluar']) {
                                            ?>
                                        Stok Habis
                                        <?php
                                            } elseif ($data['jumlah_keluar'] == NULL) {
                                            ?>
                                        <a data-toggle="tooltip" data-placement="top" title="Keluar"
                                            style="margin-right:5px" class="btn btn-danger btn-sm"
                                            href="?module=form_bhp_keluar&form=add&id=<?php echo $data['id']; ?>">
                                            <i style="color:#fff" class="glyphicon glyphicon-arrow-right"></i>
                                        </a>
                                        <?php
                                            } else {
                                            ?>
                                        <a data-toggle="tooltip" data-placement="top" title="Keluar"
                                            style="margin-right:5px" class="btn btn-warning btn-sm"
                                            href="?module=form_bhp_keluar&form=update&id=<?php echo $data['id']; ?>">
                                            <i style="color:#fff" class="glyphicon glyphicon-arrow-right"></i>
                                        </a>
                                        <?php
                                            }
                                            ?>
                                    </div>
                                </td>
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
</section><!-- /.content