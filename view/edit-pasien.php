<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $kdpasien 	    = $_POST['kdpasien'];
  $nmpasien   	  = ucwords($_POST['nmpasien']);
  $tgllahir       = $_POST['tgllahir'];
  $alamat       	= ucwords($_POST['alamat']);
  $goldarah			  = $_POST['goldarah'];
  $jnskelamin		  = $_POST['jnskelamin'];
  $umur           = $_POST['umur'];
  $notelp         = $_POST['notelp'];
  
  $update = mysql_query("UPDATE dbpasien SET 
                        kdpasien  ='$kdpasien'
                      , nmpasien  ='$nmpasien'
                      , tgllahir  ='$tgllahir '
                      , alamat    ='$alamat'
                      , goldarah  ='$goldarah'
                      , jnskelamin='$jnskelamin'
                      , umur      ='$umur'
                      , notelp    ='$notelp' 
                      WHERE kdpasien='$kdpasien'");
  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='pasien.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='edit_pasien.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class="col-lg-12">
  	<h3></h3>
  </div>

  <?php
  $kdpasien  = mysql_real_escape_string($_GET['kdpasien']);
  $det        = mysql_query("SELECT * FROM dbpasien WHERE kdpasien='$kdpasien'")or die(mysql_error());
  while($d=mysql_fetch_array($det)){
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Edit pasien</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
  	          <form action="edit-pasien.php" method="POST">
  		          <table class="table">
            			<tr>
            				<th class="col-md-2">Kode Pasien</th>
            				<td><input type="text" class="form-control" name="kdpasien" value="<?php echo $d['kdpasien'] ?>" readonly></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Nama Pasien</th>
            				<td><input type="text" class="form-control" name="nmpasien" value="<?php echo $d['nmpasien'] ?>" maxlength="50" required></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Tanggal Lahir</th>
            				<td><input type="date" class="form-control" name="tgllahir" value="<?php echo $d['tgllahir'] ?>" required></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Alamat</th>
            				<td><textarea rows="3" type="text" class="form-control" name="alamat" maxlength="80" required><?php echo $d['alamat'] ?></textarea></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Golongan Darah</th>
            				<td><input type="text" class="form-control" name="goldarah" value="<?php echo $d['goldarah'] ?>" maxlength="50"></td>
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
            				<th class="col-md-2">Umur</th>
            				<td><input type="text" class="form-control" name="umur" onkeyup="validAngka(this)" maxlength="12" value="<?php echo $d['umur'] ?>" required></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">No. Telp</th>
            				<td><input type="text" class="form-control" name="notelp" onkeyup="validAngka(this)" maxlength="12" value="<?php echo $d['notelp'] ?>" required></td>
            			</tr>
                  
            			<tr>
            				<td></td>
            				<td>
                      <a href="pasien.php" type="reset" class="btn btn-default">BATAL</a>
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
