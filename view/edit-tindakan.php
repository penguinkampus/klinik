<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $kdtindakan     = $_POST['kdtindakan'];
  $nmtindakan   = ($_POST['nmtindakan']);
  $keterangan = ($_POST['keterangan']);
  $harga  = $_POST['harga'];

  $update = mysql_query("UPDATE dbtindakan SET kdtindakan='$kdtindakan', nmtindakan='$nmtindakan', keterangan='$keterangan', harga='$harga' WHERE kdtindakan='$kdtindakan'");

  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='tindakan.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='edit-tindakan.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class="col-lg-12">
    <h3></h3>
  </div>

  <?php
  $kdtindakan   = mysql_real_escape_string($_GET['kdtindakan']);
  $det        = mysql_query("SELECT * FROM dbtindakan WHERE kdtindakan='$kdtindakan'")or die(mysql_error());
  while($d=mysql_fetch_array($det)){
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Edit Supir</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form action="edit-tindakan.php" method="POST">
                <table class="table">
                  <tr>
                    <th class="col-md-2">Kode Tindakan</th>
                    <td><input type="text" class="form-control" name="kdtindakan" value="<?php echo $d['kdtindakan']; ?>" readonly></td>
                  </tr>
                  <tr>
                    <th class="col-md-2">Nama Tindakan</th>
                    <td><input type="text" class="form-control" name="nmtindakan" value="<?php echo $d['nmtindakan']; ?>" maxlength="50" required></td>
                  </tr>
                  <tr>
                    <th class="col-md-2">Keterangan</th>
                    <td><textarea rows="3" type="text" class="form-control" name="keterangan" maxlength="80" required><?php echo $d['keterangan']; ?></textarea>
                  </tr>
                  <tr>
                    <th class="col-md-2">Biaya</th>
                    <td><input type="text" class="form-control" name="harga" value="<?php echo $d['harga']; ?>" maxlength="12" onkeyup="validAngka(this)" required></td>
                  </tr>
                  
                  <tr>
                    <td></td>
                    <td>
                      <a href="tindakan.php" type="reset" class="btn btn-default">BATAL</a>
                      <button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>
                    </td>
                  </tr>
                </table>
              </form>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /#page-wrapper -->

<!--Code JS Validation-->
<script language='javascript'>
function validAngka(a)
{
  if(!/^[0-9.]+$/.test(a.value))
  {
    a.value = a.value.substring(0,a.value.length-1000);
  }
}
</script>
<!--End of Code JS Validation-->
