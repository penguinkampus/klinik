<?php
include '../koneksi.php';
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Cetak Surat Sakit</h3>
                <a href="tambah-suratsakit.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Surat Sakit</a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No. Surat Sakit</th>
                            <th>No. Rekam Medis</th>
                            <th>Nama Pasien</th>
                            <th>Tanggal Surat Sakit</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $get = mysql_query("SELECT * FROM trsuratsakit a JOIN trmedis b ON a.nomedis = b.nomedis
                                            JOIN trdaftar c ON b.nodaftar = c.nodaftar 
                                            JOIN dbpasien d ON c.kdpasien = d.kdpasien"
                                            );
                          while ($tampil=mysql_fetch_array($get)) {
                        ?>
                            <tr>
                                <td><?php echo $tampil['nosuratsakit']; ?></td>
                                <td><?php echo $tampil['nomedis']; ?></td>
                                <td><?php echo $tampil['nmpasien']; ?></td>
                                <td><?php echo $tampil['tglsuratsakit']; ?></td>
                                <td align="center">
                                    <a href="det-rujukan.php?nosuratsakit=<?php echo $tampil['nosuratsakit'] ?>" class="btn btn-info btn-sm">Detail</a>
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
