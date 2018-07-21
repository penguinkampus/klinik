<?php
include '../koneksi.php';
session_start();
if (isset($_SESSION['login_user'])) {

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Dashboard - Klinik</title>
        <!-- Bootstrap Core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
    </head>

    <body>

        <div id="wrapper">

            <?php include 'header.php'; ?>

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">

                            <li>
                                <a href="index.php"><i class="glyphicon glyphicon-tasks"></i> DASHBOARD</a>
                            </li>
                            <li>
                                <a href="#"><i class="glyphicon glyphicon-inbox"></i> MASTER<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../master/pasien.php'><i class='fa fa-edit'></i> Entry Data Pasien</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../master/dokter.php'><i class='fa fa-edit'></i> Entry Data Dokter</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../master/obat.php'><i class='fa fa-edit'></i> Entry Data Obat</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../master/tindakan.php'><i class='fa fa-edit'></i> Entry Data Tindakan</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../master/petugas.php'><i class='fa fa-edit'></i> Entry Data Petugas</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="glyphicon glyphicon-inbox"></i> TRANSAKSI<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../transaksi/daftar.php'><i class='fa fa-edit'></i> Entry Pendaftaran</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../transaksi/rekmedis.php'><i class='fa fa-edit'></i> Entry Rekam Medis</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../transaksi/resep.php'><i class='fa fa-edit'></i> Cetak Resep</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../transaksi/kwitansi.php'><i class='fa fa-edit'></i> Cetak Kwitansi</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../transaksi/rujukan.php'><i class='fa fa-edit'></i> Cetak Surat Rujukan</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../transaksi/suratsakit.php'><i class='fa fa-edit'></i> Cetak Surat Sakit</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                            <li>
                                <a href="#"><i class="glyphicon glyphicon-inbox"></i> LAPORAN<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../laporan/lapdaftar.php'><i class='fa fa-edit'></i> Cetak Lap. Pendaftaran</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../laporan/laprujukan.php'><i class='fa fa-edit'></i> Cetak Lap. Surat Rujukan</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../laporan/lapsuratsakit.php'><i class='fa fa-edit'></i> Cetak Lap. Surat Sakit</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../laporan/lappendapatan.php'><i class='fa fa-edit'></i> Cetak Lap. Pendapatan</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../laporan/laprekapobat.php'><i class='fa fa-edit'></i> Laporan Rekapitulasi Obat</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='nav-link' href='../laporan/laprekapmedis.php'><i class='fa fa-edit'></i> Laporan Rekapitulasi Rekam Medis</a>
                                    </li>
                                </ul>
                                <!-- /.nav-second-level -->
                            </li>
                        </ul>
                    </div>
                    <!-- /.sidebar-collapse -->
                </div>
                <!-- /.navbar-static-side -->
                </nav>

                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Dashboard</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-comments fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                                <!-- <?php
                    $x=mysql_query("SELECT COUNT(id_penyewa) AS Jumlah FROM penyewa");
                    $xx=mysql_fetch_array($x);
                    echo "<b>".$xx['Jumlah']."</b>";
                  ?> -->
                                            </div>
                                            <div>Pasien Baru!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="../master/penyewa.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-tasks fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                                <!-- <?php
                    $x=mysql_query("SELECT COUNT(id_mobil) AS Jumlah FROM mobil");
                    $xx=mysql_fetch_array($x);
                    echo "<b>".$xx['Jumlah']."</b>";
                  ?> -->
                                            </div>
                                            <div>Rekam Medis Baru!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="../master/mobil.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-shopping-cart fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                                <!-- <?php
                    $x=mysql_query("SELECT COUNT(no_spsk) AS Jumlah FROM spsk");
                    $xx=mysql_fetch_array($x);
                    echo "<b>".$xx['Jumlah']."</b>";
                  ?> -->
                                            </div>
                                            <div>Surat Rujukan Baru!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="../transaksi/spsk.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-support fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">
                                                <!-- <?php
                    $x=mysql_query("SELECT COUNT(no_pengembalian) AS Jumlah FROM pengembalian");
                    $xx=mysql_fetch_array($x);
                    echo "<b>".$xx['Jumlah']."</b>";
                  ?> -->
                                            </div>
                                            <div>Kwitansi Baru!</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="../transaksi/pengembalian.php">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /#page-wrapper -->
        </div>

        <!-- /#wrapper -->

        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
        <script src="../vendor/metisMenu/metisMenu.min.js"></script>
        <script src="../vendor/raphael/raphael.min.js"></script>
        <script src="../vendor/morrisjs/morris.min.js"></script>
        <script src="../data/morris-data.js"></script> -->
        <!-- Custom Theme JavaScript -->
        <script src="../dist/js/sb-admin-2.js"></script>

    </body>

    </html>
    <?php
} else {
  header("location: login.php");
}
?>
