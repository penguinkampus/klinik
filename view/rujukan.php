<?php
include '../koneksi.php';
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Cetak Surat Rujukan</h3>
                <a href="tambah-rujukan.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Surat Rujukan</a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No. Surat Rujukan</th>
                            <th>No. Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Surat Rujukan</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $get = mysql_query("SELECT * FROM trsuratrujukan a JOIN trmedis b ON a.nomedis = b.nomedis
                                              JOIN trdaftar c ON b.nodaftar = c.nodaftar 
                                              JOIN dbpasien d ON c.kdpasien = d.kdpasien
                                              JOIN detail_obat e ON b.nomedis = e.nomedis");
                          while ($tampil=mysql_fetch_array($get)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $tampil['norujukan']; ?>
                                </td>
                                <td>
                                    <?php echo $tampil['nomedis']; ?>
                                </td>
                                <td>
                                    <?php echo $tampil['nmpasien']; ?>
                                </td>
                                <td>
                                    <?php echo $tampil['tglrujukan']; ?>
                                </td>
                                <td align="center">
                                    <a href="det-rujukan.php?norujukan=<?php echo $tampil['norujukan'] ?>" class="btn btn-info btn-sm">Detail</a>
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
