<?php
include '../koneksi.php';
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Cetak Surat Resep</h3>
              <!--   <a href="tambah-resep.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Surat Resep</a> -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                        <!--     <th>No. Resep</th> -->
                            <th>No. Rekam Medis</th>
                            <th>No. Daftar</th>
                            <th>Tanggal Resep</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $get = mysql_query("SELECT * FROM trmedis a 
                                            JOIN trdaftar b ON a.nodaftar = b.nodaftar 
                                            JOIN dbpasien c ON b.kdpasien = c.kdpasien
                                            JOIN dbdokter d ON a.kddokter = d.kddokter");
                          while ($tampil=mysql_fetch_array($get)) {
                        ?>
                            <tr>
                                <td>
                                    <?php echo $tampil['nomedis']; ?>
                                </td>
                                <td>
                                    <?php echo $tampil['nodaftar']; ?>
                                </td>
                                <td>
                                    <?php echo $tampil['tglmedis']; ?>
                                </td>
                                <td align="center">
                                    <a href="det-resep.php?nomedis=<?php echo $tampil['nomedis'] ?>" class="btn btn-info btn-sm">Detail</a>
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
    
