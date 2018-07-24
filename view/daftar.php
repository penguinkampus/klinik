<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Pendaftaran</h3>
      <a href="tambah-daftar.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Daftar</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>No. Daftar</th>
            <th>Tanggal Daftar</th>
            <th>Nama Pasien</th>
            <th>Umur</th>
            <th>Keluhan</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM trdaftar a JOIN dbpasien b ON a.kdpasien = b.kdpasien");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['nodaftar']; ?></td>
            <td><?php echo $tampil['tgldaftar']; ?></td>
            <td><?php echo $tampil['nmpasien']; ?></td>
            <td><?php echo $tampil['umur']; ?></td>
            <td><?php echo $tampil['keluhan']; ?></td>
            <td align="center">
              <a href="det-daftar.php?nodaftar=<?php echo $tampil['nodaftar'] ?>" class="btn btn-info btn-sm">Detail</a>
              <a href="cetakantrian.php?nodaftar=<?php echo $tampil['nodaftar'] ?>" class="btn btn-warning btn-sm">Cetak Antrian</a> 
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
