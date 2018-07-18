<?php include '../koneksi.php'; ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Rekam Medis</h3>
                <a href="tambah-rekmedis.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Medis</a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>No Rekam Medis</th>
                            <th>No Daftar</th>
                            <th>Nama Pasien</th>
                            <th>Nama Dokter</th>
                            <th>Tanggal</th>
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
                                <td align="center">
                                    <?php echo $tampil['nomedis']; ?>
                                </td>
                                <td align="center">
                                    <?php echo $tampil['nodaftar']; ?>
                                </td>
                                <td>
                                    <?php echo $tampil['nmpasien']; ?>
                                </td>
                                <td>
                                    <?php echo $tampil['nmdokter']; ?>
                                </td>
                                <td align="center">
                                    <?php echo $tampil['tglmedis']; ?>
                                </td>
                                <td align="center">
                                    <a href="det-rekmedis.php?nomedis=<?php echo $tampil['nomedis'] ?>" class="btn btn-info btn-sm">Detail</a>
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
