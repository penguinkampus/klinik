<?php
include '../koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT kdtindakan FROM dbtindakan ORDER BY kdtindakan DESC LIMIT 1");
    $jumlahrecord = mysql_num_rows($query);
    if($jumlahrecord == 0)
        $nomor=1;
    else
    {
        $row=mysql_fetch_array($query);
        $nomor=intval(substr($row[0],strlen($awalan)))+1;
    }
    if($lebar>0)
        $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
    else
        $angka = $awalan.$nomor;

    return $angka;
}


if (isset($_POST['submit'])) {
  $id_tindakan     = $_POST['kdtindakan'];
  $nama_tindakan   = ucwords($_POST['nmtindakan']);
  $keterangan = ucwords($_POST['keterangan']);
  $harga        = $_POST['harga'];
  
  $cekno = mysql_query("SELECT * FROM dbtindakan WHERE nmtindakan = '$nama_tindakan'");

  if (mysql_num_rows($cekno) <> 0) {
    echo "<script>alert('tindakan Sudah di Input!');window.location='tindakan.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO dbtindakan VALUES ('$id_tindakan', '$nama_tindakan', '$keterangan', '$harga')");

  }

  if ($simpan) {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='tindakan.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');window.location='tindakan.php';</script>";
  }
}
  

//$id_tindakan = $_GET['kdtindakan'];
//mysql_query("DELETE FROM tindakan WHERE id_tindakan='$id_tindakan'");
?>

<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Tindakan</h3>
      <button style='margin-bottom:20px' data-toggle='modal' data-target='#myModal' class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Tindakan</button>
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
            <th>Keterangan</th>
            <th>Harga</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM dbtindakan");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['kdtindakan']; ?></td>
            <td><?php echo $tampil['nmtindakan']; ?></td>
            <td><?php echo $tampil['keterangan']; ?></td>
            <td align="center">Rp. <?php echo $tampil['harga']; ?></td>
            <td align="center">
              <a href="edit-tindakan.php?id_tindakan=<?php echo $tampil['id_tindakan'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='tindakan.php?id_tindakan=<?php echo $tampil['id_tindakan']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
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

  <!-- modal input -->
  <div id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Tambah tindakan</h4>
        </div>
        <div class="modal-body">
          <form action="tindakan.php" method="POST">
            <div class="form-group">
              <label>ID tindakan</label>
              <input name="kdtindakan" type="text" class="form-control" value="<?php echo autonumber("dbtindakan", "kdtindakan", 2, "SP") ?>" readonly>
            </div>
            <div class="form-group">
              <label>Nama tindakan</label>
              <input name="nmtindakan" type="text" class="form-control" placeholder="Nama tindakan" maxlength="50" onkeyup="validHuruf(this)" required>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea id="textarea-input" name="keterangan" rows="3" class="form-control" placeholder="Keterangan" maxlength="80" required></textarea>
            </div>
            <div class="form-group">
              <label>Tarif</label>
              <input name="harga" type="text" class="form-control" placeholder="Tarif" maxlength="12" onkeyup="validAngka(this)" required>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <input name="submit" type="submit" class="btn btn-primary" value="Simpan">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /#page-wrapper -->

<!--Code JS Validation-->
<script language='javascript'>
  // //validasi angka
  // function validAngka(a)
  // {
  //   if(!/^[0-9.]+$/.test(a.value))
  //   {
  //     a.value = a.value.substring(0,a.value.length-1000);
  //   }
  // }

  // //validasi huruf
  // function validHuruf(a)
  // {
  //   if(!/^[a-zA-Z]+$/.test(a.value))
  //   {
  //     a.value = a.value.substring(0,a.value.length-1000);
  //   }
  // }
</script>
<!--End of Code JS Validation-->
