<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="rekmedis.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <div align="center">
            <b><u>REKAM MEDIS</u></b>
          </div>
        </div>
<?php
$nomedis	= $_GET['nomedis'];
$get = mysql_query("SELECT * FROM trmedis a JOIN trdaftar b ON a.nodaftar = b.nodaftar
                    JOIN dbpasien c ON b.kdpasien = c.kdpasien
                    JOIN dbdokter d ON a.kddokter = d.kddokter 
                    WHERE a.nomedis='$nomedis'
                  ");
while ($tampil=mysql_fetch_array($get)) {
?>
<table border="0" width="300px">
  <tr>
    <td><b>No.</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['nomedis']; ?></td>
  </tr>
  <tr>
    <td><b>Nama Pasien</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['nmpasien']; ?></td>
  </tr>
  <tr>
    <td><b>Umur</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['umur']; ?></td>
  </tr>
  <tr>
    <td><b>Jenis Kelamin</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['jnskelamin']; ?></td>
  </tr>
  <tr>
    <td><b>Alamat</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['alamat']; ?></td>
  </tr>
</table>

<table width="100%" border="1" cellspacing="0">
  <tr>
    <td align="center"><b>Tanggal</b></td>
    <td align="center"><b>Anamnesis</b></td>
    <td align="center"><b>Diagnosa</b></td>
  </tr>
  <tr>
    <?php
    $no = 1;
    $get = mysql_query("SELECT * FROM trmedis a JOIN trdaftar b ON a.nodaftar = b.nodaftar
                        JOIN dbpasien c ON b.kdpasien = c.kdpasien
                        JOIN dbdokter d ON a.kddokter = d.kddokter 
                        WHERE a.nomedis='$nomedis'
                      ");
    while ($tampil=mysql_fetch_array($get)) {
    ?>
    <td align="center"><?php echo $tampil['tglmedis']; ?>.</td>
    <td align="center"><?php echo $tampil['keluhan']; ?></td>
    <td align="center"><?php echo $tampil['diagnosa']; ?></td>
  </tr>
  <?php } ?>
  
<br>
</div>

      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->

<?php } ?>

<textarea id="printing-css" style="display:none;">.no-print{display:none}</textarea>
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
<script type="text/javascript">
//<![CDATA[
function printDiv(elementId) {
    var a = document.getElementById('printing-css').value;
    var b = document.getElementById(elementId).innerHTML;
    window.frames["print_frame"].document.title = document.title;
    window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
    window.frames["print_frame"].window.focus();
    window.frames["print_frame"].window.print();
}
//]]>
</script>
