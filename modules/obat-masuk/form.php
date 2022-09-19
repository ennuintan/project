<script type="text/javascript">
//tampilan seluruh obat
function tampil_obat(input) {
    var num = input.value;

    $.post("modules/obat-masuk/obat.php", {
        dataidobat: num,
    }, function(response) {
        $('#stok').html(response)

        document.getElementById('jumlah_masuk').focus();
    });
}

function cek_jumlah_masuk(input) {
    jml = document.formObatMasuk.jumlah_masuk.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
        alert('Jumlah Masuk Tidak Boleh Nol !!');
        input.value = input.value.substring(0, input.value.length - 1);
    }
}

function hitung_total_stok() {
    bil1 = document.formObatMasuk.stok.value;
    bil2 = document.formObatMasuk.jumlah_masuk.value;

    if (bil2 == "") {
        var hasil = "";
    } else {
        var hasil = eval(bil1) + eval(bil2);
    }

    document.formObatMasuk.total_stok.value = (hasil);
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
        <i class="fa fa-edit icon-title"></i> Input Data Obat Masuk
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="?module=obat_masuk"> Obat Masuk </a></li>
        <li class="active"> Tambah </li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" action="modules/obat-masuk/proses.php?act=insert"
                    method="POST" name="formObatMasuk">
                    <div class="box-body">
                        <?php
                            // fungsi untuk membuat kode transaksi
                            $query_id = mysqli_query($mysqli, "SELECT RIGHT(id,7) as kode FROM is_obat_masuk
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
                            <label class="col-sm-2 control-label">Obat</label>
                            <div class="col-sm-5">
                                <select class="chosen-select" name="kode_obat" data-placeholder="-- Pilih Obat --"
                                    onchange="tampil_obat(this)" autocomplete="off" required>
                                    <option value=""></option>
                                    <?php
                                        $query_obat = mysqli_query($mysqli, "SELECT kode_obat, nama_obat FROM is_obat ORDER BY nama_obat ASC")
                                            or die('Ada kesalahan pada query tampil obat: ' . mysqli_error($mysqli));
                                        while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                                            echo "<option value=\"$data_obat[kode_obat]\"> $data_obat[kode_obat] | $data_obat[nama_obat] </option>";
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
                                <a href="?module=obat_masuk" class="btn btn-default btn-reset">Batal</a>
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
        // fungsi query untuk menampilkan data dari tabel obat masuk
        $query = mysqli_query($mysqli, "SELECT a.kode_obat, b.id, a.nama_obat, b.tanggal_exp,b.tanggal_masuk,b.kode_obat,b.jumlah_masuk FROM is_obat as a join is_obat_masuk as b on a.kode_obat = b.kode_obat WHERE id='$_GET[id]'")
            or die('Ada kesalahan pada query tampil Data obat masuk : ' . mysqli_error($mysqli));
        $data  = mysqli_fetch_assoc($query);
    }
?>

<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Ubah Data Obat Masuk
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="?module=obat_masuk"> Obat Masuk </a></li>
        <li class="active"> Ubah Data Obat Masuk</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" action="modules/obat-masuk/proses.php?act=update"
                    method="POST" name="formObatMasuk">
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Masuk</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-date-format="dd-mm-yyyy"
                                    name="tanggal_masuk" autocomplete="off"
                                    value="<?php echo $data['tanggal_masuk']; ?>" readonly required>
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
                            <label class="col-sm-2 control-label">Obat</label>
                            <div class="col-sm-5">
                                <select class="chosen-select" name="kode_obat" data-placeholder="-- Pilih Obat --"
                                    onchange="tampil_obat(this)" autocomplete="off" required>
                                    <option> <?php echo $data['kode_obat']; ?> | <?php echo $data['nama_obat']; ?>
                                    </option>
                                    <?php
                                        $query_obat = mysqli_query($mysqli, "SELECT kode_obat, nama_obat FROM is_obat ORDER BY nama_obat ASC")
                                            or die('Ada kesalahan pada query tampil obat: ' . mysqli_error($mysqli));
                                        while ($data_obat = mysqli_fetch_assoc($query_obat)) {
                                            echo "<option value=\"$data_obat[kode_obat]\"> $data_obat[kode_obat] | $data_obat[nama_obat] </option>";
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>

                        <span id='stok'>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Stok</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="stokobat" name="stok" readonly required>
                                </div>
                            </div>
                        </span>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Jumlah Masuk</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="jumlah_masukobat" name="jumlah_masuk"
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
                                <a href="?module=obat_masuk" class="btn btn-default btn-reset">Batal</a>
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