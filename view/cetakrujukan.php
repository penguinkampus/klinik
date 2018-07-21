<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="rujukan.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <?php
            $norujukan	= $_GET['norujukan'];
            $get = mysql_query("SELECT * FROM trsuratrujukan a JOIN trmedis b ON a.nomedis = b.nomedis
                                JOIN trdaftar c ON b.nodaftar = c.nodaftar 
                                JOIN dbpasien d ON c.kdpasien = d.kdpasien
                                JOIN detail_obat e ON b.nomedis = e.nomedis
                                WHERE a.norujukan='$norujukan'
                                GROUP BY a.nomedis
                              ");
            while ($tampil=mysql_fetch_array($get)) {
          ?>
          <div align="center">
            <b><u>SURAT RUJUKAN</u></b></br>
            <?php echo $tampil['norujukan']; ?>/<?php echo date("Y"); ?>
          </div>
        </div>
<div>
<p>
Yth. Dr. <?php echo $tampil['spesialis']; ?></br>
<?php echo $tampil['nmrumahsakit']; ?></br>
Di tempat
</br>
</br>
Mohon pemeriksaan dan penanganan lebih lanjut terhadap penderita:</br>
<table border="0" width="500px">
  <tr>
    <td><b>Nama Pasien</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['nmpasien']; ?></td>
  </tr>
  <tr>
    <td><b>Jenis Kelamin</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['jnskelamin']; ?></td>
  </tr>
  <tr>
    <td><b>Umur</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['umur']; ?></td>
  </tr>
  <tr>
    <td><b>Alamat</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['alamat']; ?></td>
  </tr>
</table>
<?php } ?>
</br>
</br>
<?php
  $norujukan	= $_GET['norujukan'];
  $get = mysql_query("SELECT * FROM trsuratrujukan a JOIN trmedis b ON a.nomedis = b.nomedis
                      JOIN trdaftar c ON b.nodaftar = c.nodaftar 
                      JOIN dbpasien d ON c.kdpasien = d.kdpasien
                      JOIN detail_obat e ON b.nomedis = e.nomedis
                      WHERE a.norujukan='$norujukan'
                    ");
  while ($tampil=mysql_fetch_array($get)) {
?>
Dengan hasil pemeriksaan sebagai berikut:</br>
<table border="0" width="300px">
  <tr>
    <td><b>1.</b> </td>
    <td><b>Hasil Anamnesa</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['keluhan']; ?></td>
  </tr>
  <tr>
    <td><b>2.</b> </td>
    <td><b>Diagnose</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['diagnosa']; ?></td>
  </tr>
  <tr>
    <td><b>3.</b> </td>
    <td><b>Pengobatan Sementara</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['nmobat']; ?></td>
  </tr>
</table>
<?php } ?>

Demikian atas kerjasamanya yang baik, kami ucapkan terimakasih.
<?php
  $norujukan	= $_GET['norujukan'];
  $get = mysql_query("SELECT * FROM trsuratrujukan a JOIN trmedis b ON a.nomedis = b.nomedis
                      JOIN trdaftar c ON b.nodaftar = c.nodaftar 
                      JOIN dbdokter d ON b.kddokter = d.kddokter
                      WHERE a.norujukan='$norujukan'
                      GROUP BY a.nomedis
                    ");
  while ($tampil=mysql_fetch_array($get)) {
?>
</br>
</br>
<div align="Right">
  Serpong, <?php echo $tampil['tglrujukan']; ?></br>
  Yang merujuk,</br>
  </br>
  </br>
  </br>
  <?php echo $tampil['nmdokter']; ?>
</div>
<?php } ?>
</p>
</div>

      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->



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
