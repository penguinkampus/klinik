<?php
include '../koneksi.php';
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Cetak Surat Resep</h3>
                <a href="tambah-resep.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Bukti Denda</a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No. Resep</th>
                            <th>No. Rekam Medis</th>
                            <th>No. Daftar</th>
                            <th>Tanggal Resep</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $get = mysql_query("SELECT * FROM trsuratresep a JOIN trmedis b ON a.kdmedis = b.kdmedis
                                              JOIN trdaftar c ON b.kddaftar = c.kddaftar 
                                              JOIN dbpasien d ON c.kdpasien = d.kdpasien
                                              JOIN detail_obat e ON b.kdmedis = e.kdmedis");
                          while ($tampil=mysql_fetch_array($get)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $tampil['noresep']; ?>
                                </td>
                                <td>
                                    <?php echo $tampil['nomedis']; ?>
                                </td>
                                <td>
                                    <?php echo $tampil['nodaftar']; ?>
                                </td>
                                <td>
                                    <?php echo $tampil['tglresep']; ?>
                                </td>
                                <td align="center">
                                    <a href="det-bukden.php?noresep=<?php echo $tampil['noresep'] ?>" class="btn btn-info btn-sm">Detail</a>
                                </td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->