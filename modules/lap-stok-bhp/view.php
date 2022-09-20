<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-file-text-o icon-title"></i> Laporan Stok BHP
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda</a></li>
        <li class="active">Laporan</li>
        <li class="active">Stok BHP</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
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
                                <th>Stok</th>
                                <th>Satuan</th>
                            </tr>
                        </thead>
                        <!-- tampilan tabel body -->
                        <tbody>
                            <?php
                            $no = 1;
                            // fungsi query untuk menampilkan data dari tabel bhp
                            $query = mysqli_query($mysqli, "SELECT kode_bhp,nama_bhp,satuan,stok FROM is_bhp ORDER BY nama_bhp ASC")
                                or die('Ada kesalahan pada query tampil Data bhp: ' . mysqli_error($mysqli));
                            // tampilkan data
                            while ($data = mysqli_fetch_assoc($query)) {
                                // $harga_beli = format_rupiah($data['harga_beli']);
                                // $harga_jual = format_rupiah($data['harga_jual']);
                                // menampilkan isi tabel dari database ke tabel di aplikasi
                                echo "<tr>
                      <td>$no</td>
                      <td>$data[kode_bhp]</td>
                      <td>$data[nama_bhp]</td>
                      <td>$data[stok]</td>
                      <td>$data[satuan]</td>
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
</section>

<!-- DataTables -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css" /> -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" /> -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" />

<script type="text/javascript">
$(document).ready(function() {
    $('#example1').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>