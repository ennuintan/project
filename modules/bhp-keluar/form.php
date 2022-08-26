<script type="text/javascript">
function tampil_bhp(input) {
    var num = input.value;

    $.post("modules/bhp-keluar/bhp.php", {
        dataidbhp: num,
    }, function(response) {
        $('#stok').html(response)

        document.getElementById('jumlah_keluar').focus();
    });
}

function cek_jumlah_keluar(input) {
    jml = document.formbhpKeluar.jumlah_keluar.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
        alert('Jumlah Keluar Tidak Boleh Nol !!');
        input.value = input.value.substring(0, input.value.length - 1);
    }
}

function hitung_total_stok() {
    bil1 = document.formbhpKeluar.stok.value;
    bil2 = document.formbhpKeluar.jumlah_keluar.value;

    if (bil2 == "") {
        var hasil = "";
    } else {
        var hasil = eval(bil1) - eval(bil2);
    }

    document.formbhpKeluar.total_stok.value = (hasil);
}
</script>

<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') { ?>
<!-- tampilan form add data -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Input Data bhp Keluar
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="?module=bhp_keluar"> bhp Keluar </a></li>
        <li class="active"> Tambah </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" action="modules/bhp-keluar/proses.php?act=insert"
                    method="POST" name="formbhpKeluar">
                    <div class="box-body">
                        <?php
                            // fungsi untuk membuat kode transaksi
                            $query_id = mysqli_query($mysqli, "SELECT RIGHT(id,7) as kode FROM is_bhp_keluar
                                                ORDER BY id DESC LIMIT 1")
                                or die('Ada kesalahan pada query tampil id : ' . mysqli_error($mysqli));
                            ?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Keluar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy"
                                    name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Exp</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy"
                                    name="tanggal_exp" autocomplete="off" required>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">bhp</label>
                            <div class="col-sm-5">
                                <select class="chosen-select" name="kode_bhp" data-placeholder="-- Pilih bhp --"
                                    onchange="tampil_bhp(this)" autocomplete="off" required>
                                    <option value=""></option>
                                    <?php
                                        $query_bhp = mysqli_query($mysqli, "SELECT kode_bhp, nama_bhp FROM is_bhp ORDER BY nama_bhp ASC")
                                            or die('Ada kesalahan pada query tampil bhp: ' . mysqli_error($mysqli));
                                        while ($data_bhp = mysqli_fetch_assoc($query_bhp)) {
                                            echo "<option value=\"$data_bhp[kode_bhp]\"> $data_bhp[kode_bhp] | $data_bhp[nama_bhp] </option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>

                        <span id='stok'>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Stok</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="stok" name="stok" readonly required>
                                </div>
                            </div>
                        </span>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jumlah Keluar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="jumlah_keluar" name="jumlah_keluar"
                                    autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)"
                                    onkeyup="hitung_total_stok(this)&cek_jumlah_keluar(this)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Total Stok</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="total_stok" name="total_stok" readonly
                                    required>
                            </div>
                        </div>

                    </div><!-- /.box body -->

                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                <a href="?module=bhp_keluar" class="btn btn-default btn-reset">Batal</a>
                            </div>
                        </div>
                    </div><!-- /.box footer -->
                </form>
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section><!-- /.content -->
<?php
}
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'edit') { ?>
<!-- tampilan form add data -->
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Input Data bhp Keluar
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="?module=bhp_keluar"> bhp Keluar </a></li>
        <li class="active"> Tambah </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" action="modules/bhp-keluar/proses.php?act=insert"
                    method="POST" name="formbhpKeluar">
                    <div class="box-body">
                        <?php
                            // fungsi untuk membuat kode transaksi
                            $query_id = mysqli_query($mysqli, "SELECT RIGHT(id,7) as kode FROM is_bhp_keluar
                                                ORDER BY id DESC LIMIT 1")
                                or die('Ada kesalahan pada query tampil id : ' . mysqli_error($mysqli));
                            ?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Keluar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy"
                                    name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Exp</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy"
                                    name="tanggal_exp" autocomplete="off" required>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">bhp</label>
                            <div class="col-sm-5">
                                <select class="chosen-select" name="kode_bhp" data-placeholder="-- Pilih bhp --"
                                    onchange="tampil_bhp(this)" autocomplete="off" required>
                                    <option value=""></option>
                                    <?php
                                        $query_bhp = mysqli_query($mysqli, "SELECT kode_bhp, nama_bhp FROM is_bhp ORDER BY nama_bhp ASC")
                                            or die('Ada kesalahan pada query tampil bhp: ' . mysqli_error($mysqli));
                                        while ($data_bhp = mysqli_fetch_assoc($query_bhp)) {
                                            echo "<option value=\"$data_bhp[kode_bhp]\"> $data_bhp[kode_bhp] | $data_bhp[nama_bhp] </option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>

                        <span id='stok'>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Stok</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="stok" name="stok" readonly required>
                                </div>
                            </div>
                        </span>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jumlah Keluar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="jumlah_keluar" name="jumlah_keluar"
                                    autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)"
                                    onkeyup="hitung_total_stok(this)&cek_jumlah_keluar(this)" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Sisa Stok</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="total_stok" name="total_stok" readonly
                                    required>
                            </div>
                        </div>

                    </div><!-- /.box body -->

                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                <a href="?module=bhp_keluar" class="btn btn-default btn-reset">Batal</a>
                            </div>
                        </div>
                    </div><!-- /.box footer -->
                </form>
            </div><!-- /.box -->
        </div>
        <!--/.col -->
    </div> <!-- /.row -->
</section><!-- /.content -->
<?php
}
?>