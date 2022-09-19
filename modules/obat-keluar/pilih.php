<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-sign-in icon-title"></i> Data Obat Masuk

        <a class="btn btn-primary btn-social pull-right" href="?module=obat_keluar" title="Tambah Data"
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
            // tampilkan pesan Sukses "Data Obat Masuk berhasil disimpan"
            elseif ($_GET['alert'] == 1) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Obat Masuk berhasil disimpan.
            </div>";
            }
            // jika alert = 2
            // tampilkan pesan Sukses "Data obat Masuk berhasil diubah"
            elseif ($_GET['alert'] == 2) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Obat Masuk berhasil diubah.
            </div>";
            }
            // jika alert = 3
            // tampilkan pesan Sukses "Data Obat Masuk berhasil dihapus"
            elseif ($_GET['alert'] == 3) {
                echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Obat Masuk berhasil dihapus.
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
                                <th class="center">Tanggal Masuk</th>
                                <th class="center">Nama Obat</th>
                                <th class="center">Banyak Obat Masuk</th>
                                <th class="center">Satuan</th>
                                <th class="center">Status Exp</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php
                            $no = 1;
                            // fungsi query untuk menampilkan data dari tabel obat
                            $query = mysqli_query($mysqli, "SELECT a.id, a.tanggal_exp, a.tanggal_masuk,a.kode_obat,a.jumlah_masuk,b.kode_obat,b.nama_obat,b.satuan,c.nama_user
                                            FROM is_obat_masuk as a JOIN is_obat as b ON a.kode_obat=b.kode_obat
                                            JOIN is_users as c ON c.id_user = a.created_user ORDER BY id DESC")
                                or die('Ada kesalahan pada query tampil Data Obat Masuk: ' . mysqli_error($mysqli));

                            // tampilkan data
                            while ($data = mysqli_fetch_assoc($query)) {
                                $tanggal         = $data['tanggal_masuk'];
                                $exp             = explode('-', $tanggal);
                                $tanggal_masuk   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

                                $tanggal         = $data['tanggal_exp'];
                                $exp             = explode('-', $tanggal);
                                $tanggal_exp   = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

                                $masaaktif = $tanggal_exp;
                                $sekarang = date("d-m-Y");
                                $masaberlaku = strtotime($masaaktif) - strtotime($sekarang);
                                $hasil = $masaberlaku / (24 * 60 * 60);
                                // menampilkan isi tabel dari database ke tabel di aplikasi
                                echo


                                "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='100' class='center'>$tanggal_exp</td>
                      <td width='80' class='center'>$tanggal_masuk</td>
                      <td width='200' class='center'>$data[nama_obat]</td>
                      <td width='80' class='center'>$data[jumlah_masuk]</td>
                      <td width='80' class='center'>$data[satuan]</td>
                      <td width='80' class='center'>
                      $hasil Hari Lagi
                      </td>                     
                      <td class='center' width='80'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Keluar' style='margin-right:5px' class='btn btn-danger btn-sm' href='?module=form_obat_keluar&form=add&id=$data[id]'>
                              <i style='color:#fff' class='glyphicon glyphicon-arrow-right'></i>
                          </a>";
                            ?>
                            <?php
                                echo "    </div>
                      </td>
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