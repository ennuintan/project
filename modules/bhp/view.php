<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-folder-o icon-title"></i> Data BHP

        <a class="btn btn-primary btn-social pull-right" href="?module=form_bhp&form=add" title="Tambah Data"
            data-toggle="tooltip">
            <i class="fa fa-plus"></i> Tambah
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
      // tampilkan pesan Sukses "Data bhp baru berhasil disimpan"
      elseif ($_GET['alert'] == 1) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data BHP baru berhasil disimpan.
            </div>";
      }
      // jika alert = 2
      // tampilkan pesan Sukses "Data bhp berhasil diubah"
      elseif ($_GET['alert'] == 2) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data BHP berhasil diubah.
            </div>";
      }
      // jika alert = 3
      // tampilkan pesan Sukses "Data bhp berhasil dihapus"
      elseif ($_GET['alert'] == 3) {
        echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data BHP berhasil dihapus.
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
                                <th class="center">Kode</th>
                                <th class="center">Nama</th>
                                <th class="center">Golongan</th>
                                <th class="center">Stok</th>
                                <th class="center">Satuan</th>
                                <th class="center">Action</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php
              $no = 1;
              // fungsi query untuk menampilkan data dari tabel bhp
              $query = mysqli_query($mysqli, "SELECT kode_bhp,nama_bhp,golongan_bhp,satuan,stok FROM is_bhp ORDER BY kode_bhp DESC")
                or die('Ada kesalahan pada query tampil Data bhp: ' . mysqli_error($mysqli));

              // tampilkan data
              while ($data = mysqli_fetch_assoc($query)) {
                // $harga_beli = format_rupiah($data['harga_beli']);
                // $harga_jual = format_rupiah($data['harga_jual']);
                // menampilkan isi tabel dari database ke tabel di aplikasi
                echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='80' class='center'>$data[kode_bhp]</td>
                      <td width='180'>$data[nama_bhp]</td>
                      <td width='80' class='center'>$data[golongan_bhp]</td>
                      <td width='80' align='center'>$data[stok]</td>
                      <td width='80' class='center'>$data[satuan]</td>
                      <td class='center' width='80'>
                        <div>
                          <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-primary btn-sm' href='?module=form_bhp&form=edit&id=$data[kode_bhp]'>
                              <i style='color:#fff' class='glyphicon glyphicon-edit'></i>
                          </a>";
              ?>
                            <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm"
                                href="modules/bhp/proses.php?act=delete&id=<?php echo $data['kode_bhp']; ?>"
                                onclick="return confirm('Anda yakin ingin menghapus bhp <?php echo $data['nama_bhp']; ?> ?');">
                                <i style="color:#fff" class="glyphicon glyphicon-trash"></i>
                            </a>
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