<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $kdpetugas    	= $_POST['kdpetugas'];
  $nmpetugas  	  = ucwords($_POST['nmpetugas']);
  $jnskelamin    	= $_POST['jnskelamin'];
  $tgllahir    	  = $_POST['tgllahir'];
  $alamat         = ucwords($_POST['alamat']);
  $notelp	        = $_POST['notelp'];
  $level        	= $_POST['level'];
  $username			  = $_POST['username'];
  $password       = $_POST['password'];

  $update = mysql_query("UPDATE dbpetugas SET 
                        kdpetugas='$kdpetugas'
                        , nmpetugas='$nmpetugas'
                        , jnskelamin='$jnskelamin'
                        , tgllahir='$tgllahir'
                        , alamat='$alamat'
                        , notelp='$notelp'
                        , level='$level'
                        , username='$username'
                        , password='$password' 
                        WHERE kdpetugas='$kdpetugas'");
  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='petugas.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='edit-petugas.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class="col-lg-12">
  	<h3></h3>
  </div>

  <?php
  $kdpetugas   = mysql_real_escape_string($_GET['kdpetugas']);
  $det         = mysql_query("SELECT * FROM dbpetugas WHERE kdpetugas='$kdpetugas'")or die(mysql_error());
  while($d=mysql_fetch_array($det)){
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Edit Petugas</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
  	          <form action="edit-petugas.php" method="POST">
  		          <table class="table">
            			<tr>
            				<th class="col-md-2">Kode Petugas</th>
            				<td><input type="text" class="form-control" name="kdpetugas" value="<?php echo $d['kdpetugas'] ?>" readonly></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Nama Petugas</th>
            				<td><input type="text" class="form-control" name="nmpetugas" value="<?php echo $d['nmpetugas'] ?>" maxlength="50" required></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Jenis Kelamin</th>
                    <td>
                      <select id="select" name="jnskelamin" class="form-control">
                      <option value="">Pilih Jenis Kelamin</option>
                      <option <?php if( $d['jnskelamin']=='Laki-laki'){echo "selected"; } ?> value="Laki-laki">Laki-laki</option>
                      <option <?php if( $d['jnskelamin']=='Perempuan'){echo "selected"; } ?> value="Perempuan">Perempuan</option>
                    </select>
                  </td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Tanggal Lahir</th>
            				<td><input type="date" class="form-control" name="tgllahir" value="<?php echo $d['tgllahir'] ?>" required></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Alamat</th>
            				<td><textarea type="text" rows="3" class="form-control" name="alamat" maxlength="80" required><?php echo $d['alamat'] ?></textarea>
            			</tr>
                  <tr>
            				<th class="col-md-2">No. Telp</th>
            				<td><input type="text" class="form-control" name="notelp" value="<?php echo $d['notelp'] ?>" maxlength="12" required></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Level</th>
            				<td><input type="text" class="form-control" name="level" value="<?php echo $d['level'] ?>" maxlength="50" required></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">username</th>
            				<td><input type="text" class="form-control" name="username" value="<?php echo $d['username'] ?>" maxlength="15" required></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">password</th>
            				<td><input type="password" class="form-control" name="password" value="<?php echo $d['password'] ?>" maxlength="20" required></td>
            			</tr>
            			<tr>
            				<td></td>
            				<td>
                      <a href="petugas.php" type="reset" class="btn btn-default">BATAL</a>
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
