<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-home icon-title"></i> Beranda
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p style="font-size:15px">
                    <i class="icon fa fa-user"></i> Selamat datang
                    <strong><?php echo $_SESSION['nama_user']; ?></strong> di Sistem Informasi Manajemen obat dan
                    BHP(Barang habis Pakai).
                </p>
            </div>
        </div>
    </div>

    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#2E8B57;color:#fff" class="small-box">
                <div class="inner">
                    <?php
                    // fungsi query untuk menampilkan data dari tabel obat
                    $query = mysqli_query($mysqli, "SELECT COUNT(kode_obat) as jumlah FROM is_obat")
                        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));

                    // tampilkan data
                    $data = mysqli_fetch_assoc($query);
                    ?>
                    <h3><?php echo $data['jumlah']; ?></h3>
                    <p>Jumlah Nama Obat</p>
                </div>
                <div class="icon">
                    <i class="fa fa-medkit"></i>
                </div>
                <?php
                if ($_SESSION['hak_akses'] != 'Manajer') { ?>
                <a href="?module=form_obat&form=add" class="small-box-footer" title="Tambah Data"
                    data-toggle="tooltip"><i class="fa fa-medkit"></i></a>
                <?php
                } else { ?>
                <a class="small-box-footer"><i class="fa"></i></a>
                <?php
                }
                ?>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#6B8E23;color:#fff" class="small-box">
                <div class="inner">
                    <?php
                    // fungsi query untuk menampilkan data dari tabel obat masuk
                    $query = mysqli_query($mysqli, "SELECT sum(jumlah_masuk) as jumlah FROM is_obat_masuk")
                        or die('Ada kesalahan pada query tampil Data obat Masuk: ' . mysqli_error($mysqli));

                    // tampilkan data
                    $data = mysqli_fetch_assoc($query);
                    ?>
                    <h3><?php echo $data['jumlah']; ?></h3>
                    <p>Stok Obat Masuk</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
                <?php
                if ($_SESSION['hak_akses'] != 'Manajer') { ?>
                <a href="?module=form_obat_masuk&form=add" class="small-box-footer" title="Tambah Data"
                    data-toggle="tooltip"><i class="fa fa-sign-in"></i></a>
                <?php
                } else { ?>
                <a class="small-box-footer"><i class="fa"></i></a>
                <?php
                }
                ?>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#FFA500;color:#fff" class="small-box">
                <div class="inner">
                    <?php
                    // fungsi query untuk menampilkan data dari tabel obat
                    $query = mysqli_query($mysqli, "SELECT sum(jumlah_keluar) as jumlah FROM is_obat_keluar")
                        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));

                    // tampilkan data
                    $data = mysqli_fetch_assoc($query);

                    //tambahan perubahan 
                    ?>
                    <h3><?php echo $data['jumlah']; ?></h3>
                    <p>Stok Obat Keluar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-out"></i>
                </div>
                <?php
                if ($_SESSION['hak_akses'] != 'Manajer') { ?>
                <a href="?module=form_obat_keluar&form=add" class="small-box-footer" title="Tambah Data"
                    data-toggle="tooltip"><i class="fa fa-sign-out"></i></a>
                <?php
                } else { ?>
                <a class="small-box-footer"><i class="fa"></i></a>
                <?php
                }
                ?>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#808000;color:#fff" class="small-box">
                <div class="inner">
                    <?php
                    // fungsi query untuk menampilkan data dari tabel obat
                    $query1 = mysqli_query($mysqli, "SELECT sum(jumlah_masuk) as jumlah FROM is_obat_masuk")
                        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));

                    $query2 = mysqli_query($mysqli, "SELECT sum(jumlah_keluar) as jumlah FROM is_obat_keluar")
                        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));

                    // tampilkan data
                    $data1 = mysqli_fetch_assoc($query1);
                    $data2 = mysqli_fetch_assoc($query2);

                    //tambahan perubahan 
                    ?>
                    <h3><?php echo $data1['jumlah'] - $data2['jumlah'] ?></h3>
                    <p>Jumlah Akhir Stok Obat</p>

                </div>
                <div class="icon">
                    <i class="fa fa-folder"></i>
                </div>
                <a class="small-box-footer"><i class="fa"></i></a>
            </div>
        </div><!-- ./col -->

        <!-- Data BHP -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#008b8b;color:#fff" class="small-box">
                <div class="inner">
                    <?php
                    // fungsi query untuk menampilkan data dari tabel BHP
                    $query = mysqli_query($mysqli, "SELECT COUNT(kode_bhp) as jumlah FROM is_bhp")
                        or die('Ada kesalahan pada query tampil Data BHP: ' . mysqli_error($mysqli));

                    // tampilkan data
                    $data = mysqli_fetch_assoc($query);
                    ?>
                    <h3><?php echo $data['jumlah']; ?></h3>
                    <p>Jumlah BHP</p>
                </div>
                <div class="icon">
                    <i class="fa fa-medkit"></i>
                </div>
                <?php
                if ($_SESSION['hak_akses'] != 'Manajer') { ?>
                <a href="?module=form_bhp&form=add" class="small-box-footer" title="Tambah Data"
                    data-toggle="tooltip"><i class="fa fa-medkit"></i></a>
                <?php
                } else { ?>
                <a class="small-box-footer"><i class="fa"></i></a>
                <?php
                }
                ?>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#FF4500;color:#fff" class="small-box">
                <div class="inner">
                    <?php
                    // fungsi query untuk menampilkan data dari tabel BHP masuk
                    $query = mysqli_query($mysqli, "SELECT sum(jumlah_masuk) as jumlah FROM is_bhp_masuk")
                        or die('Ada kesalahan pada query tampil Data BHP Masuk: ' . mysqli_error($mysqli));

                    // tampilkan data
                    $data = mysqli_fetch_assoc($query);
                    ?>
                    <h3><?php echo $data['jumlah']; ?></h3>
                    <p>Stok BHP Masuk</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
                <?php
                if ($_SESSION['hak_akses'] != 'Manajer') { ?>
                <a href="?module=form_bhp_masuk&form=add" class="small-box-footer" title="Tambah Data"
                    data-toggle="tooltip"><i class="fa fa-sign-in"></i></a>
                <?php
                } else { ?>
                <a class="small-box-footer"><i class="fa"></i></a>
                <?php
                }
                ?>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#D2691E;color:#fff" class="small-box">
                <div class="inner">
                    <?php
                    // fungsi query untuk menampilkan data dari tabel BHP
                    $query = mysqli_query($mysqli, "SELECT sum(jumlah_keluar) as jumlah FROM is_bhp_keluar")
                        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));

                    // tampilkan data
                    $data = mysqli_fetch_assoc($query);

                    //tambahan perubahan 
                    ?>
                    <h3><?php echo $data['jumlah']; ?></h3>
                    <p>Stok BHP Keluar</p>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-out"></i>
                </div>
                <?php
                if ($_SESSION['hak_akses'] != 'Manajer') { ?>
                <a href="?module=form_bhp_keluar&form=add" class="small-box-footer" title="Tambah Data"
                    data-toggle="tooltip"><i class="fa fa-sign-out"></i></a>
                <?php
                } else { ?>
                <a class="small-box-footer"><i class="fa"></i></a>
                <?php
                }
                ?>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div style="background-color:#8B0000;color:#fff" class="small-box">
                <div class="inner">
                    <?php
                    // fungsi query untuk menampilkan data dari tabel obat
                    $query1 = mysqli_query($mysqli, "SELECT sum(jumlah_masuk) as jumlah FROM is_bhp_masuk")
                        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));

                    $query2 = mysqli_query($mysqli, "SELECT sum(jumlah_keluar) as jumlah FROM is_bhp_keluar")
                        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));

                    // tampilkan data
                    $data1 = mysqli_fetch_assoc($query1);
                    $data2 = mysqli_fetch_assoc($query2);

                    //tambahan perubahan 
                    ?>
                    <h3><?php echo $data1['jumlah'] - $data2['jumlah'] ?></h3>
                    <p>Jumlah Akhir Stok BHP</p>
                </div>
                <div class="icon">
                    <i class="fa fa-folder"></i>
                </div>
                <a class="small-box-footer"><i class="fa"></i></a>
            </div>
        </div><!-- ./col -->

        <!-- <div class="col-lg-3 col-xs-6">
            <div style="background-color:#f39c12;color:#fff" class="small-box">
                <div class="inner">
                    <?php
                    $query = mysqli_query($mysqli, "SELECT COUNT(kode_obat) as jumlah FROM is_obat")
                        or die('Ada kesalahan pada query tampil Data Obat: ' . mysqli_error($mysqli));
                    $data = mysqli_fetch_assoc($query);
                    ?>
                    <h3><?php echo $data['jumlah']; ?></h3>
                    <p>Laporan Stok Obat</p>
                </div>
                <div class="icon">
                    <i class="fa fa-file-text-o"></i>
                </div>
                <a href="?module=lap_stok" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i
                        class="fa fa-print"></i></a>
            </div>
        </div> -->

        <!-- <div class="col-lg-3 col-xs-6">
            <div style="background-color:#dd4b39;color:#fff" class="small-box">
                <div class="inner">
                    <?php
                    $query = mysqli_query($mysqli, "SELECT COUNT(kode_transaksi) as jumlah FROM is_obat_masuk")
                        or die('Ada kesalahan pada query tampil Data obat Masuk: ' . mysqli_error($mysqli));
                    $data = mysqli_fetch_assoc($query);
                    ?>
                    <h3><?php echo $data['jumlah']; ?></h3>
                    <p>Laporan Obat Masuk</p>
                </div>
                <div class="icon">
                    <i class="fa fa-clone"></i>
                </div>
                <a href="?module=lap_obat_masuk" class="small-box-footer" title="Cetak Laporan" data-toggle="tooltip"><i
                        class="fa fa-print"></i></a>
            </div>
        </div> -->
    </div><!-- /.row -->
</section><!-- /.content -->