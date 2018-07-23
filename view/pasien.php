<?php
include '../koneksi.php';

// Fungsi Delete
if (isset($_GET['kdpasien'])){
  $kdpasien = $_GET['kdpasien'];
  mysql_query("DELETE FROM dbpasien WHERE kdpasien='$kdpasien'");
}

?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Pasien</h3>
      <a href="tambah-pasien.php" style="margin-bottom:20px" class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Pasien</a>
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
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php $get = mysql_query("SELECT * FROM dbpasien");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td align="center"><?php echo $tampil['kdpasien']; ?></td>
            <td><?php echo $tampil['nmpasien']; ?></td>
            <td align="center"><?php echo $tampil['tgllahir']; ?></td>
            <td><?php echo $tampil['alamat']; ?></td>
            <td align="center"><?php echo $tampil['jnskelamin']; ?></td>
            <td align="center">
              <a href="det-pasien.php?kdpasien=<?php echo $tampil['kdpasien']; ?>" class="btn btn-info btn-sm">Detail</a>
              <a href="edit-pasien.php?kdpasien=<?php echo $tampil['kdpasien']; ?>" class="btn btn-warning btn-sm">Edit</a>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='pasien.php?kdpasien=<?php echo $tampil['kdpasien']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
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
