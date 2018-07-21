<?php include '../koneksi.php'; ?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Kwitansi</h3>
      <a href="tambah-kwitansi.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Kwitansi</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>No. Kwitansi</th>
            <th>No. Rekam Medis</th>
            <th>Nama Pasien</th>
            <th>Total Harga</th>
            <th>Tanggal</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM trkwitansi a JOIN trmedis b ON a.nomedis = b.nomedis
                              JOIN trdaftar c ON b.nodaftar = c.nodaftar
                              JOIN dbpasien d ON c.kdpasien = d.kdpasien
                            ");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['nokwitansi']; ?></td>
            <td><?php echo $tampil['nomedis']; ?></td>
            <td><?php echo $tampil['nmpasien']; ?></td>
            <td align="center">Rp. <?php echo $tampil['subtotal']; ?></td>
            <td><?php echo $tampil['tglkwitansi']; ?></td>
            <td align="center">
              <a href="det-kwitansi.php?nokwitansi=<?php echo $tampil['nokwitansi'] ?>" class="btn btn-info btn-sm">Detail</a>
              <a href="cetakkwitansi.php?nokwitansi=<?php echo $tampil['nokwitansi'] ?>" class="btn btn-warning btn-sm">Cetak</a>
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
