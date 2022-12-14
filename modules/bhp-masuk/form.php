<script type="text/javascript">
function tampil_bhp(input) {
    var num = input.value;

    $.post("modules/bhp-masuk/bhp.php", {
        dataidbhp: num,
    }, function(response) {
        $('#stok').html(response)

        document.getElementById('jumlah_masuk').focus();
    });
}

function cek_jumlah_masuk(input) {
    jml = document.formbhpMasuk.jumlah_masuk.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
        alert('Jumlah Masuk Tidak Boleh Nol !!');
        input.value = input.value.substring(0, input.value.length - 1);
    }
}

function hitung_total_stok() {
    bil1 = document.formbhpMasuk.stok.value;
    bil2 = document.formbhpMasuk.jumlah_masuk.value;

    if (bil2 == "") {
        var hasil = "";
    } else {
        var hasil = eval(bil1) + eval(bil2);
    }

    document.formbhpMasuk.total_stok.value = (hasil);
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
        <i class="fa fa-edit icon-title"></i> Input Data BHP Masuk
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="?module=bhp_masuk"> bhp Masuk </a></li>
        <li class="active"> Tambah </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" action="modules/bhp-masuk/proses.php?act=insert" method="POST"
                    name="formbhpMasuk">
                    <div class="box-body">
                        <?php
                            // fungsi untuk membuat kode transaksi
                            $query_id = mysqli_query($mysqli, "SELECT RIGHT(id,7) as kode FROM is_bhp_masuk
                                                ORDER BY id DESC LIMIT 1")
                                or die('Ada kesalahan pada query tampil id : ' . mysqli_error($mysqli));
                            ?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Masuk</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy"
                                    name="tanggal_masuk" autocomplete="off" value="<?php echo date("d-m-Y"); ?>"
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
                            <label class="col-sm-2 control-label">Jumlah Masuk</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="jumlah_masuk" name="jumlah_masuk"
                                    autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)"
                                    onkeyup="hitung_total_stok(this)&cek_jumlah_masuk(this)" required>
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
                                <a href="?module=bhp_masuk" class="btn btn-default btn-reset">Batal</a>
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
// jika form edit data yang dipilih
// isset : cek data ada / tidak
elseif ($_GET['form'] == 'edit') {
    if (isset($_GET['id'])) {
        // fungsi query untuk menampilkan data dari tabel bhp masuk
        $query = mysqli_query($mysqli, "SELECT a.kode_bhp, b.id, a.nama_bhp, b.tanggal_exp,b.tanggal_masuk,b.kode_bhp,b.jumlah_masuk FROM is_bhp as a join is_bhp_masuk as b on a.kode_bhp = b.kode_bhp WHERE id='$_GET[id]'")
            or die('Ada kesalahan pada query tampil Data bhp masuk : ' . mysqli_error($mysqli));
        $data  = mysqli_fetch_assoc($query);
    }
?>

<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Ubah Data BHP Masuk
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="?module=bhp_masuk"> bhp Masuk </a></li>
        <li class="active"> Ubah Data bhp Masuk</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" action="modules/bhp-masuk/proses.php?act=update" method="POST"
                    name="formbhpMasuk">
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Masuk</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy"
                                    name="tanggal_masuk" autocomplete="off"
                                    value="<?php echo $data['tanggal_masuk']; ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Exp</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control date-picker" data-date-format="dd-mm-yyyy"
                                    name="tanggal_exp" autocomplete="off" value="<?php echo $data['tanggal_exp']; ?>"
                                    required>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">bhp</label>
                            <div class="col-sm-5">
                                <select class="chosen-select" name="kode_bhp" data-placeholder="-- Pilih bhp --"
                                    onchange="tampil_bhp(this)" autocomplete="off" required>
                                    <option> <?php echo $data['kode_bhp']; ?> | <?php echo $data['nama_bhp']; ?>
                                    </option>
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
                                    <input type="text" class="form-control" id="stokbhp" name="stok" readonly required>
                                </div>
                            </div>
                        </span>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jumlah Masuk</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="jumlah_masukbhp" name="jumlah_masuk"
                                    autocomplete="off" onKeyPress="return goodchars(event,'0123456789',this)"
                                    onkeyup="hitung_total_stok(this)&cek_jumlah_masuk(this)"
                                    value="<?php echo $data['jumlah_masuk']; ?>" required>
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
                                <a href="?module=bhp_masuk" class="btn btn-default btn-reset">Batal</a>
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