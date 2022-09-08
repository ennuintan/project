<?php
session_start();
ob_start();

// Panggil koneksi database.php untuk koneksi database
require_once "../../config/database.php";
// panggil fungsi untuk format tanggal
include "../../config/fungsi_tanggal.php";
// panggil fungsi untuk format rupiah
include "../../config/fungsi_rupiah.php";

$hari_ini = date("d-m-Y");

$no = 1;
// fungsi query untuk menampilkan data dari tabel bhp
$query = mysqli_query($mysqli, "SELECT kode_bhp,nama_bhp,golongan_bhp,satuan,stok FROM is_bhp ORDER BY nama_bhp ASC")
    or die('Ada kesalahan pada query tampil Data bhp: ' . mysqli_error($mysqli));
$count  = mysqli_num_rows($query);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- Bagian halaman HTML yang akan konvert -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>LAPORAN STOK BHP</title>
    <link rel="stylesheet" type="text/css" href="../../assets/css/laporan.css" />
</head>

<body>
    <div id="title">
        LAPORAN STOK BHP
    </div>

    <hr><br>

    <div id="isi">
        <table width="100%" border="0.3" cellpadding="0" cellspacing="0">
            <thead style="background:#e8ecee">
                <tr class="tr-title">
                    <th height="20" align="center" valign="middle">NO.</th>
                    <th height="20" align="center" valign="middle">KODE BHP</th>
                    <th height="20" align="center" valign="middle">NAMA BHP</th>
                    <th height="20" align="center" valign="middle">GOLONGAN</th>
                    <th height="20" align="center" valign="middle">STOK</th>
                    <th height="20" align="center" valign="middle">SATUAN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // tampilkan data
                while ($data = mysqli_fetch_assoc($query)) {
                    // menampilkan isi tabel dari database ke tabel di aplikasi
                    echo "  <tr>
                        <td width='40' height='13' align='center' valign='middle'>$no</td>
                        <td width='80' height='13' align='center' valign='middle'>$data[kode_bhp]</td>
                        <td style='padding-left:5px;' width='180' height='13' valign='middle'>$data[nama_bhp]</td>
                        <td width='80' height='13' align='center' valign='middle'>$data[golongan_bhp]</td>
                        <td style='padding-right:10px;' width='80' height='13' align='right' valign='middle'>$data[stok]</td>
                        <td width='80' height='13' align='center' valign='middle'>$data[satuan]</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>

        <div id="footer-tanggal">
            Bandarlampung, <?php echo tgl_eng_to_ind("$hari_ini"); ?>
        </div>
        <div id="footer-jabatan">
            Pimpinan
        </div>

        <div id="footer-nama">
            Ennuy, S.Kom.
        </div>
    </div>
</body>

</html><!-- Akhir halaman HTML yang akan di konvert -->
<?php
$filename = "LAPORAN STOK BHP.pdf"; //ubah untuk menentukan nama file pdf yang dihasilkan nantinya
//==========================================================================================================
$content = ob_get_clean();
$content = '<page style="font-family: freeserif">' . ($content) . '</page>';
// panggil library html2pdf
// require_once('../../assets/plugins/html2pdf-master/html2pdf.class.php');
require_once('../../assets/plugins/html2pdf_v4.03/html2pdf.class.php');
try {
    $html2pdf = new HTML2PDF('P', 'F4', 'en', false, 'ISO-8859-15', array(10, 10, 10, 10));
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output($filename);
} catch (HTML2PDF_exception $e) {
    echo $e;
}
?>