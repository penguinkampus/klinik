<?php
include '../koneksi.php';

if (isset($_GET['kddokter'])){
  $kddokter = $_GET['kddokter'];
  mysql_query("DELETE FROM dbdokter WHERE kddokter='$kddokter'");
}

?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Dokter</h3>
      <a href="tambah-dokter.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Dokter</a>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Spesialis</th>
            <th>Jenis Kelamin</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM dbdokter");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['kddokter']; ?></td>
            <td><?php echo $tampil['nmdokter']; ?></td>
            <td align="center"><?php echo $tampil['spesialis']; ?></td>
            <td align="center"><?php echo $tampil['jnskelamin']; ?></td>
            <td align="center">
              <a href="det-dokter.php?kddokter=<?php echo $tampil['kddokter'] ?>" class="btn btn-info btn-sm">Detail</a>
              <a href="edit-dokter.php?kddokter=<?php echo $tampil['kddokter'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='dokter.php?kddokter=<?php echo $tampil['kddokter']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
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
