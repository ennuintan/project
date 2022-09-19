<?php
/* panggil file database.php untuk koneksi ke database */
require_once "config/database.php";
/* panggil file fungsi tambahan */
require_once "config/fungsi_tanggal.php";
require_once "config/fungsi_rupiah.php";

// fungsi untuk pengecekan status login user 
// jika user belum login, alihkan ke halaman login dan tampilkan message = 1
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
	echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
}
// jika user sudah login, maka jalankan perintah untuk pemanggilan file halaman konten
else {
	// jika halaman konten yang dipilih beranda, panggil file view beranda
	if ($_GET['module'] == 'beranda') {
		include "modules/beranda/view.php";
	}

	// jika halaman konten yang dipilih obat, panggil file view obat
	elseif ($_GET['module'] == 'obat') {
		include "modules/obat/view.php";
	}

	// jika halaman konten yang dipilih bhp, panggil file view bhp
	elseif ($_GET['module'] == 'bhp') {
		include "modules/bhp/view.php";
	}

	// jika halaman konten yang dipilih form obat, panggil file form obat
	elseif ($_GET['module'] == 'form_obat') {
		include "modules/obat/form.php";
	}

	// jika halaman konten yang dipilih form bhp, panggil file form bhp
	elseif ($_GET['module'] == 'form_bhp') {
		include "modules/bhp/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih obat masuk, panggil file view obat masuk
	elseif ($_GET['module'] == 'obat_masuk') {
		include "modules/obat-masuk/view.php";
	}

	// jika halaman konten yang dipilih form obat masuk, panggil file form obat masuk
	elseif ($_GET['module'] == 'form_obat_masuk') {
		include "modules/obat-masuk/form.php";
	}

	// jika halaman konten yang dipilih bhp masuk, panggil file view bhp masuk
	elseif ($_GET['module'] == 'bhp_masuk') {
		include "modules/bhp-masuk/view.php";
	}

	// jika halaman konten yang dipilih form bhp masuk, panggil file form bhp masuk
	elseif ($_GET['module'] == 'form_bhp_masuk') {
		include "modules/bhp-masuk/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih obat keluar, panggil file view obat masuk
	elseif ($_GET['module'] == 'obat_keluar') {
		include "modules/obat-keluar/view.php";
	}

	// jika halaman konten yang dipilih form obat keluar, panggil file form obat keluar
	elseif ($_GET['module'] == 'form_obat_keluar') {
		include "modules/obat-keluar/form.php";
	}
	// jika halaman konten yang dipilih form obat keluar, panggil file form obat keluar
	elseif ($_GET['module'] == 'pilih_obat_keluar') {
		include "modules/obat-keluar/pilih.php";
	}

	// jika halaman konten yang dipilih bhp keluar, panggil file view bhp masuk
	elseif ($_GET['module'] == 'bhp_keluar') {
		include "modules/bhp-keluar/view.php";
	}

	// jika halaman konten yang dipilih form bhp keluar, panggil file form bhp keluar
	elseif ($_GET['module'] == 'form_bhp_keluar') {
		include "modules/bhp-keluar/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih laporan stok, panggil file view laporan stok
	elseif ($_GET['module'] == 'lap_stok') {
		include "modules/lap-stok/view.php";
	}
	elseif ($_GET['module'] == 'lap_stok_bhp') {
		include "modules/lap-stok-bhp/view.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih laporan obat masuk, panggil file view laporan obat masuk
	elseif ($_GET['module'] == 'lap_obat_masuk_dan_keluar') {
		include "modules/lap-obat-masuk-dan-keluar/view.php";
	}

	// jika halaman konten yang dipilih laporan bhp masuk, panggil file view laporan bhp masuk
	elseif ($_GET['module'] == 'lap_bhp_masuk_dan_keluar') {
		include "modules/lap-bhp-masuk-dan-keluar/view.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih laporan obat keluar, panggil file view laporan obat keluar
	// elseif ($_GET['module'] == 'lap_obat_keluar') {
	// 	include "modules/lap-obat-keluar/view.php";
	// }
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih user, panggil file view user
	elseif ($_GET['module'] == 'user') {
		include "modules/user/view.php";
	}

	// jika halaman konten yang dipilih form user, panggil file form user
	elseif ($_GET['module'] == 'form_user') {
		include "modules/user/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih profil, panggil file view profil
	elseif ($_GET['module'] == 'profil') {
		include "modules/profil/view.php";
	}

	// jika halaman konten yang dipilih form profil, panggil file form profil
	elseif ($_GET['module'] == 'form_profil') {
		include "modules/profil/form.php";
	}
	// -----------------------------------------------------------------------------

	// jika halaman konten yang dipilih password, panggil file view password
	elseif ($_GET['module'] == 'password') {
		include "modules/password/view.php";
	}
}