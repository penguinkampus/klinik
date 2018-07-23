<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $kddokter    	= $_POST['kddokter'];
  $nmdokter     = ucwords($_POST['nmdokter']);
  $tgllahir     = strtoupper($_POST['tgllahir']);
  $spesialis		= ucwords($_POST['spesialis']);
  $jnskelamin	  = $_POST['jnskelamin'];
  $alamat       = $_POST['alamat'];
  $notelp       = $_POST['notelp'];

  $update = mysql_query("UPDATE dbdokter SET 
                          kddokter ='$kddokter'
                        , nmdokter ='$nmdokter'
                        , tgllahir ='$tgllahir'
                        , spesialis ='$spesialis'
                        , jnskelamin ='$jnskelamin'
                        , alamat ='$alamat'
                        , notelp ='$notelp'
                        WHERE kddokter='$kddokter'");
  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='dokter.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='edit-dokter.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class="col-lg-12">
  	<h3></h3>
  </div>

  <?php
  $kddokter    = mysql_real_escape_string($_GET['kddokter']);
  $det        = mysql_query("SELECT * FROM dbdokter WHERE kddokter='$kddokter'")or die(mysql_error());
  while($d=mysql_fetch_array($det)){
  ?>
  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Edit Dokter</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
  	          <form action="edit-dokter.php" method="POST">
  		          <table class="table">
            			<tr>
            				<th class="col-md-2">Kode Dokter</th>
            				<td><input type="text" class="form-control" name="kddokter" value="<?php echo $d['kddokter'] ?>" readonly></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Nama dokter</th>
            				<td><input type="text" class="form-control" name="nmdokter" value="<?php echo $d['nmdokter'] ?>" maxlength="35"></td>
            			</tr>
            			<tr>
            				<th class="col-md-2">Tanggal Lahir</th>
            				<td><input type="date" class="form-control" name="tgllahir" value="<?php echo $d['tgllahir'] ?>" ></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">Spesialis</th>
            				<td><input type="text" class="form-control" name="spesialis" value="<?php echo $d['spesialis'] ?>" maxlength="10"></td>
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
            				<th class="col-md-2">Alamat</th>
            				<td><input type="text" class="form-control" name="alamat" value="<?php echo $d['alamat'] ?>" maxlength="12"></td>
            			</tr>
                  <tr>
            				<th class="col-md-2">No. Telp</th>
            				<td><input type="text" class="form-control" name="notelp" value="<?php echo $d['notelp'] ?>" maxlength="12"></td>
            			</tr>
            			<tr>
            				<td></td>
            				<td>
                      <a href="dokter.php" type="reset" class="btn btn-default">BATAL</a>
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
