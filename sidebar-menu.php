<?php
// fungsi pengecekan level untuk menampilkan menu sesuai dengan hak akses
// jika hak akses = Super Admin, tampilkan menu
if ($_SESSION['hak_akses'] == 'Super Admin') { ?>
<!-- sidebar menu start -->
<ul class="sidebar-menu">
    <li class="header">MAIN MENU</li>

    <?php
        // fungsi untuk pengecekan menu aktif
        // jika menu beranda dipilih, menu beranda aktif
        if ($_GET["module"] == "beranda") { ?>
    <li class="active">
        <a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a>
    </li>
    <?php
        }
        // jika tidak, menu home tidak aktif
        else { ?>
    <li>
        <a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a>
    </li>
    <?php
        }

        // jika menu data obat dipilih, menu data obat aktif
        if ($_GET["module"] == "obat" || $_GET["module"] == "form_obat") { ?>
    <li class="active">
        <a href="?module=obat"><i class="fa fa-medkit"></i> Data Obat </a>
    </li>
    <?php
        }
        // jika tidak, menu data obat tidak aktif
        else { ?>
    <li>
        <a href="?module=obat"><i class="fa fa-medkit"></i> Data Obat </a>
    </li>
    <?php
        }

        // jika menu data obat dipilih, menu data BHP aktif
        if ($_GET["module"] == "bhp" || $_GET["module"] == "form_bhp") { ?>
    <li class="active">
        <a href="?module=bhp"><i class="fa fa-medkit"></i> Data BHP </a>
    </li>
    <?php
        }
        // jika tidak, menu data BHP tidak aktif
        else { ?>
    <li>
        <a href="?module=bhp"><i class="fa fa-medkit"></i> Data BHP </a>
    </li>
    <?php
        }

        // jika menu data obat masuk dipilih, menu data obat masuk aktif
        if ($_GET["module"] == "obat_masuk" || $_GET["module"] == "form_obat_masuk") { ?>
    <li class="active">
        <a href="?module=obat_masuk"><i class="fa fa-sign-in"></i> Data Obat Masuk </a>
    </li>
    <?php
        }
        // jika tidak, menu data obat masuk tidak aktif
        else { ?>
    <li>
        <a href="?module=obat_masuk"><i class="fa fa-sign-in"></i> Data Obat Masuk </a>
    </li>
    <?php
        }

        // jika menu data obat keluar dipilih, menu data obat keluar aktif
        if ($_GET["module"] == "obat_keluar" || $_GET["module"] == "form_obat_keluar" || $_GET["module"] == "pilih_obat_keluar") { ?>
    <li class="active">
        <a href="?module=obat_keluar"><i class="fa fa-sign-out"></i> Data Obat Keluar </a>
    </li>
    <?php
        }
        // jika tidak, menu data obat Keluar tidak aktif
        else { ?>
    <li>
        <a href="?module=obat_keluar"><i class="fa fa-sign-out"></i> Data Obat Keluar </a>
    </li>
    <?php
        }

        // jika menu data BHP masuk dipilih, menu data BHP masuk aktif
        if ($_GET["module"] == "bhp_masuk" || $_GET["module"] == "form_bhp_masuk") { ?>
    <li class="active">
        <a href="?module=bhp_masuk"><i class="fa fa-sign-in"></i> Data BHP Masuk </a>
    </li>
    <?php
        }
        // jika tidak, menu data bhp masuk tidak aktif
        else { ?>
    <li>
        <a href="?module=bhp_masuk"><i class="fa fa-sign-in"></i> Data BHP Masuk </a>
    </li>
    <?php
        }

        // jika menu data BHP keluar dipilih, menu data BHP keluar aktif
        if ($_GET["module"] == "bhp_keluar" || $_GET["module"] == "form_bhp_keluar" || $_GET["module"] == "pilih_bhp_keluar") { ?>
    <li class="active">
        <a href="?module=bhp_keluar"><i class="fa fa-sign-out"></i> Data BHP Keluar </a>
    </li>
    <?php
        }
        // jika tidak, menu data bhp Keluar tidak aktif
        else { ?>
    <li>
        <a href="?module=bhp_keluar"><i class="fa fa-sign-out"></i> Data BHP Keluar </a>
    </li>
    <?php
        }

        // jika menu Laporan Stok obat dipilih, menu Laporan Stok obat aktif
        if ($_GET["module"] == "lap_stok") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan Keluar </a>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
            </li>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan bhp Masuk dipilih, menu Laporan Stok bhp aktif
        elseif ($_GET["module"] == "lap_stok_bhp") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li class="active"><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan Keluar </a>
            </li>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan obat Masuk dipilih, menu Laporan obat Masuk dan Keluaraktif
        elseif ($_GET["module"] == "lap_obat_masuk_dan_keluar") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li class="active"><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan
                    Keluar
                </a></li>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan BHP Masuk dipilih, menu Laporan BHP Masuk dan Keluaraktif
        elseif ($_GET["module"] == "lap_bhp_masuk_dan_keluar") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP</a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan
                    Keluar
                </a></li>
            <li class="active"><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan
                    Keluar </a>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan tidak dipilih, menu Laporan tidak aktif
        else { ?>
    <li class="treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan Keluar </a>
            </li>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
        </ul>
    </li>
    <?php
        }

        // jika menu user dipilih, menu user aktif
        if ($_GET["module"] == "user" || $_GET["module"] == "form_user") { ?>
    <li class="active">
        <a href="?module=user"><i class="fa fa-user"></i> Manajemen User</a>
    </li>
    <?php
        }
        // jika tidak, menu user tidak aktif
        else { ?>
    <li>
        <a href="?module=user"><i class="fa fa-user"></i> Manajemen User</a>
    </li>
    <?php
        }

        // jika menu ubah password dipilih, menu ubah password aktif
        if ($_GET["module"] == "password") { ?>
    <li class="active">
        <a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
    </li>
    <?php
        }
        // jika tidak, menu ubah password tidak aktif
        else { ?>
    <li>
        <a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
    </li>
    <?php
        }
        ?>
</ul>
<!--sidebar menu end-->
<?php
}
// jika hak akses = Manajer, tampilkan menu
elseif ($_SESSION['hak_akses'] == 'Manajer') { ?>
<!-- sidebar menu start -->
<ul class="sidebar-menu">
    <li class="header">MAIN MENU</li>

    <?php
        // fungsi untuk pengecekan menu aktif
        // jika menu beranda dipilih, menu beranda aktif
        if ($_GET["module"] == "beranda") { ?>
    <li class="active">
        <a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a>
    </li>
    <?php
        }
        // jika tidak, menu beranda tidak aktif
        else { ?>
    <li>
        <a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a>
    </li>
    <?php
        }

        // jika menu Laporan Stok obat dipilih, menu Laporan Stok obat aktif
        if ($_GET["module"] == "lap_stok") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan Keluar </a>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
            </li>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan bhp Masuk dipilih, menu Laporan Stok bhp aktif
        elseif ($_GET["module"] == "lap_stok_bhp") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li class="active"><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan Keluar </a>
            </li>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan obat Masuk dipilih, menu Laporan obat Masuk dan Keluaraktif
        elseif ($_GET["module"] == "lap_obat_masuk_dan_keluar") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li class="active"><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan
                    Keluar
                </a></li>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan BHP Masuk dipilih, menu Laporan BHP Masuk dan Keluaraktif
        elseif ($_GET["module"] == "lap_bhp_masuk_dan_keluar") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP</a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan
                    Keluar
                </a></li>
            <li class="active"><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan
                    Keluar </a>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan tidak dipilih, menu Laporan tidak aktif
        else { ?>
    <li class="treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan Keluar </a>
            </li>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
        </ul>
    </li>
    <?php
        }

        // jika menu ubah password dipilih, menu ubah password aktif
        if ($_GET["module"] == "password") { ?>
    <li class="active">
        <a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
    </li>
    <?php
        }
        // jika tidak, menu ubah password tidak aktif
        else { ?>
    <li>
        <a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
    </li>
    <?php
        }
        ?>
</ul>
<!--sidebar menu end-->
<?php
}
// jika hak akses = Gudang, tampilkan menu
if ($_SESSION['hak_akses'] == 'Gudang') { ?>
<!-- sidebar menu start -->
<ul class="sidebar-menu">
    <li class="header">MAIN MENU</li>

    <?php
        // fungsi untuk pengecekan menu aktif
        // jika menu beranda dipilih, menu beranda aktif
        if ($_GET["module"] == "beranda") { ?>
    <li class="active">
        <a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a>
    </li>
    <?php
        }
        // jika tidak, menu home tidak aktif
        else { ?>
    <li>
        <a href="?module=beranda"><i class="fa fa-home"></i> Beranda </a>
    </li>
    <?php
        }

        // jika menu data obat dipilih, menu data obat aktif
        if ($_GET["module"] == "obat" || $_GET["module"] == "form_obat") { ?>
    <li class="active">
        <a href="?module=obat"><i class="fa fa-medkit"></i> Data Obat </a>
    </li>
    <?php
        }
        // jika tidak, menu data obat tidak aktif
        else { ?>
    <li>
        <a href="?module=obat"><i class="fa fa-medkit"></i> Data Obat </a>
    </li>
    <?php
        }
        // jika menu data obat dipilih, menu data BHP aktif
        if ($_GET["module"] == "bhp" || $_GET["module"] == "form_bhp") { ?>
    <li class="active">
        <a href="?module=bhp"><i class="fa fa-medkit"></i> Data BHP </a>
    </li>
    <?php
        }
        // jika tidak, menu data BHP tidak aktif
        else { ?>
    <li>
        <a href="?module=bhp"><i class="fa fa-medkit"></i> Data BHP </a>
    </li>
    <?php
        }

        // jika menu data obat masuk dipilih, menu data obat masuk aktif
        if ($_GET["module"] == "obat_masuk" || $_GET["module"] == "form_obat_masuk") { ?>
    <li class="active">
        <a href="?module=obat_masuk"><i class="fa fa-sign-in"></i> Data Obat Masuk </a>
    </li>
    <?php
        }
        // jika tidak, menu data obat masuk tidak aktif
        else { ?>
    <li>
        <a href="?module=obat_masuk"><i class="fa fa-sign-in"></i> Data Obat Masuk </a>
    </li>
    <?php
        }

        // jika menu data obat keluar dipilih, menu data obat keluar aktif
        if ($_GET["module"] == "obat_keluar" || $_GET["module"] == "form_obat_keluar") { ?>
    <li class="active">
        <a href="?module=obat_keluar"><i class="fa fa-sign-out"></i> Data Obat Keluar</a>
    </li>
    <?php
        }
        // jika tidak, menu data obat masuk tidak aktif
        else { ?>
    <li>
        <a href="?module=obat_keluar"><i class="fa fa-sign-out"></i> Data Obat Keluar </a>
    </li>
    <?php
        }
        // jika menu data BHP masuk dipilih, menu data BHP masuk aktif
        if ($_GET["module"] == "bhp_masuk" || $_GET["module"] == "form_bhp_masuk") { ?>
    <li class="active">
        <a href="?module=bhp_masuk"><i class="fa fa-sign-in"></i> Data BHP Masuk </a>
    </li>
    <?php
        }
        // jika tidak, menu data bhp masuk tidak aktif
        else { ?>
    <li>
        <a href="?module=bhp_masuk"><i class="fa fa-sign-in"></i> Data BHP Masuk </a>
    </li>
    <?php
        }

        // jika menu data BHP keluar dipilih, menu data BHP keluar aktif
        if ($_GET["module"] == "bhp_keluar" || $_GET["module"] == "form_bhp_keluar") { ?>
    <li class="active">
        <a href="?module=bhp_keluar"><i class="fa fa-sign-out"></i> Data BHP Keluar </a>
    </li>
    <?php
        }
        // jika tidak, menu data bhp Keluar tidak aktif
        else { ?>
    <li>
        <a href="?module=bhp_keluar"><i class="fa fa-sign-out"></i> Data BHP Keluar </a>
    </li>
    <?php
        }

        // jika menu Laporan Stok obat dipilih, menu Laporan Stok obat aktif
        if ($_GET["module"] == "lap_stok") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li class="active"><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan Keluar </a>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
            </li>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan bhp Masuk dipilih, menu Laporan Stok bhp aktif
        elseif ($_GET["module"] == "lap_stok_bhp") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li class="active"><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan Keluar </a>
            </li>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan obat Masuk dipilih, menu Laporan obat Masuk dan Keluaraktif
        elseif ($_GET["module"] == "lap_obat_masuk_dan_keluar") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li class="active"><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan
                    Keluar
                </a></li>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan BHP Masuk dipilih, menu Laporan BHP Masuk dan Keluaraktif
        elseif ($_GET["module"] == "lap_bhp_masuk_dan_keluar") { ?>
    <li class="active treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP</a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan
                    Keluar
                </a></li>
            <li class="active"><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan
                    Keluar </a>
        </ul>
    </li>
    <?php
        }
        // jika menu Laporan tidak dipilih, menu Laporan tidak aktif
        else { ?>
    <li class="treeview">
        <a href="javascript:void(0);">
            <i class="fa fa-file-text"></i> <span>Laporan</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="?module=lap_stok"><i class="fa fa-circle-o"></i> Stok Obat </a></li>
            <li><a href="?module=lap_stok_bhp"><i class="fa fa-circle-o"></i> Stok BHP </a></li>
            <li><a href="?module=lap_obat_masuk_dan_keluar"><i class="fa fa-circle-o"></i> Obat Masuk dan Keluar </a>
            </li>
            <li><a href="?module=lap_bhp_masuk_dan_keluar"><i class="fa fa-circle-o"></i> BHP Masuk dan Keluar </a>
        </ul>
    </li>
    <?php
        }

        // jika menu ubah password dipilih, menu ubah password aktif
        if ($_GET["module"] == "password") { ?>
    <li class="active">
        <a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
    </li>
    <?php
        }
        // jika tidak, menu ubah password tidak aktif
        else { ?>
    <li>
        <a href="?module=password"><i class="fa fa-lock"></i> Ubah Password</a>
    </li>
    <?php
        }
        ?>
</ul>
<!--sidebar menu end-->
<?php
}
?>