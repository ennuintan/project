<script type="text/javascript">
function tampil_obat(input) {
    var num = input.value;
    $.post("modules/obat-keluar/obat.php", {
        dataidobat: num,
    }, function(response) {
        $('#stok').html(response)
        document.getElementById('jumlah_keluar').focus();
    });
}

function cek_jumlah_keluar(input) {
    jml = document.formObatKeluar.jumlah_keluar.value;
    bil1 = document.formObatKeluar.stok.value;
    var jumlah = eval(jml);
    if (jumlah < 1) {
        alert('Jumlah Keluar Tidak Boleh Nol !!');
        input.value = input.value.substring(0, input.value.length - 1);
    }
    if (jumlah > bil1) {
        alert('Jumlah Keluar Tidak Boleh Melebihi Stok !!');
        input.value = input.value.substring(0, input.value.length - 1);
    }
}

function hitung_total_stok() {
    bil1 = document.formObatKeluar.stok.value;
    bil2 = document.formObatKeluar.jumlah_keluar.value;

    if (bil2 == "") {
        var hasil = "";
    } else {
        var hasil = eval(bil1) - eval(bil2);
    }
    document.formObatKeluar.total_stok.value = (hasil);
}
</script>

<?php
// fungsi untuk pengecekan tampilan form
// jika form add data yang dipilih
if ($_GET['form'] == 'add') { ?>
<!-- tampilan form add data -->
<!-- Content Header (Page header) -->
<?php
    if (isset($_GET['id'])) {

        // fungsi query untuk menampilkan data dari tabel obat masuk
        $query = mysqli_query($mysqli, "SELECT a.kode_obat, a.nama_obat, b.tanggal_exp,b.tanggal_masuk,b.kode_obat,b.jumlah_masuk 
        FROM is_obat as a join is_obat_masuk as b on a.kode_obat = b.kode_obat WHERE id='$_GET[id]'")
            or die('Ada kesalahan pada query tampil Data obat masuk : ' . mysqli_error($mysqli));
        $data  = mysqli_fetch_assoc($query);
        $tanggal     = $data['tanggal_exp'];
        $exp         = explode('-', $tanggal);
        $tanggal_exp = $exp[2] . "-" . $exp[1] . "-" . $exp[0];
    }
    // fungsi untuk membuat kode transaksi
    $query_id = mysqli_query($mysqli, "SELECT RIGHT(id,7) as kode FROM is_obat_keluar
                                                ORDER BY id DESC LIMIT 1")
        or die('Ada kesalahan pada query tampil id : ' . mysqli_error($mysqli));
    ?>

<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Input Data Obat Keluar
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="?module=obat_keluar"> Obat Keluar </a></li>
        <li class="active"> Kurang</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" action="modules/obat-keluar/proses.php?act=insert"
                    method="POST" name="formObatKeluar">
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Keluar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-date-format="dd-mm-yyyy"
                                    name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Exp</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-date-format="dd-mm-yyyy" name="tanggal_exp"
                                    autocomplete="off" value="<?php echo $tanggal_exp ?>" readonly>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Obat</label>
                            <div class="col-sm-5">
                                <select class="chosen-select" name="kode_obat" data-placeholder="-- Pilih Obat --"
                                    onchange="tampil_obat(this)" autocomplete="off" value="<?= $data['kode_obat'] ?>">
                                    <option value="<?= $data['kode_obat'] ?>" readonly>
                                        <?php echo $data['kode_obat']; ?> |
                                        <?php echo $data['nama_obat']; ?></option>
                                </select>
                            </div>
                        </div>

                        <span id='stok'>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label">Stok Masuk</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="stokobat" name="stok"
                                        value="<?php echo $data['jumlah_masuk']; ?>" readonly>
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
                                <input type="hidden" name="id" value="<?= $_GET['id'] ?>" type="submit"
                                    class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                <button type="submit" class="btn btn-primary btn-submit" name="simpan"
                                    value="Simpan">simpan</button>
                                <a href="?module=pilih_obat_keluar" class="btn btn-default btn-reset">Batal</a>
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
elseif ($_GET['form'] == 'update') {
    if (isset($_GET['id'])) {
        // fungsi query untuk menampilkan data dari tabel obat masuk
        $query = mysqli_query($mysqli, "SELECT a.kode_obat, a.nama_obat, b.tanggal_exp,b.tanggal_masuk,b.kode_obat,b.jumlah_masuk,c.jumlah_keluar
        FROM is_obat as a 
        join is_obat_masuk as b on a.kode_obat = b.kode_obat
        join is_obat_keluar as c on b.id = c.id_obat_masuk 
        WHERE b.id='$_GET[id]'")
            or die('Ada kesalahan pada query tampil Data obat masuk : ' . mysqli_error($mysqli));
        $data  = mysqli_fetch_assoc($query);
        $tanggal     = $data['tanggal_exp'];
        $exp         = explode('-', $tanggal);
        $tanggal_exp = $exp[2] . "-" . $exp[1] . "-" . $exp[0];
    }
    // fungsi untuk membuat kode transaksi
    $query_id = mysqli_query($mysqli, "SELECT RIGHT(id,7) as kode FROM is_obat_keluar
                                                ORDER BY id DESC LIMIT 1")
        or die('Ada kesalahan pada query tampil id : ' . mysqli_error($mysqli));
?>

<section class="content-header">
    <h1>
        <i class="fa fa-edit icon-title"></i> Input Data Obat Keluar
    </h1>
    <ol class="breadcrumb">
        <li><a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a></li>
        <li><a href="?module=obat_keluar"> Obat Keluar </a></li>
        <li class="active"> Kurang</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" class="form-horizontal" action="modules/obat-keluar/proses.php?act=update"
                    method="POST" name="formObatKeluar">
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Keluar</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-date-format="dd-mm-yyyy"
                                    name="tanggal_keluar" autocomplete="off" value="<?php echo date("d-m-Y"); ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Tanggal Exp</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" data-date-format="dd-mm-yyyy" name="tanggal_exp"
                                    autocomplete="off" value="<?php echo $tanggal_exp ?>" readonly>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Obat</label>
                            <div class="col-sm-5">
                                <select class="chosen-select" name="kode_obat" data-placeholder="-- Pilih Obat --"
                                    onchange="tampil_obat(this)" autocomplete="off" value="<?= $data['kode_obat'] ?>">
                                    <option value="<?= $data['kode_obat'] ?>" readonly>
                                        <?php echo $data['kode_obat']; ?> |
                                        <?php echo $data['nama_obat']; ?></option>
                                </select>
                            </div>
                        </div>

                        <span id='stok'>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label">Stok Masuk</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="stok" name="stok"
                                        value="<?php echo $data['jumlah_masuk'] - $data['jumlah_keluar']; ?>" readonly>
                                </div>
                            </div>
                        </span>

                        <!-- <span id='stok_keluar'>
                            <div class=" form-group">
                                <label class="col-sm-2 control-label">Jumlah yang Sudah Keluar</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" id="stok_keluar"
                                        value="<?php echo $data['jumlah_keluar']; ?>" readonly>
                                </div>
                            </div>
                        </span> -->

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
                                <input type="hidden" name="id" value="<?= $_GET['id'] ?>" type="submit"
                                    class="btn btn-primary btn-submit" name="simpan" value="Simpan">
                                <button type="submit" class="btn btn-primary btn-submit" name="simpan"
                                    value="Simpan">simpan</button>
                                <a href="?module=pilih_obat_keluar" class="btn btn-default btn-reset">Batal</a>
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