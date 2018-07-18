<?php include '../koneksi.php';

if (isset($_GET['kdpetugas'])){
  $kdpetugas = $_GET['kdpetugas'];
  mysql_query("DELETE FROM dbpetugas WHERE kdpetugas='$kdpetugas'");
}

?>
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Petugas</h3>
      <a href="tambah-petugas.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Petugas</a>
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
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
            <th>No. Telp</th>
            <th>Level</th>        
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM dbpetugas");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['kdpetugas']; ?></td>
            <td><?php echo $tampil['nmpetugas']; ?></td>
            <td><?php echo $tampil['jnskelamin']; ?></td>
            <td><?php echo $tampil['alamat']; ?></td>
            <td align="center"><?php echo $tampil['notelp']; ?></td>
            <td><?php echo $tampil['level']; ?></td>
            <td align="center">
              <a href="edit-petugas.php?kdpetugas=<?php echo $tampil['kdpetugas']; ?>" class="btn btn-warning btn-sm">Edit</a>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='petugas.php?kdpetugas=<?php echo $tampil['kdpetugas']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
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
