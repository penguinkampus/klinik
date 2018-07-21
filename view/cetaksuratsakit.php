<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="suratsakit.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <?php
            $nosuratsakit	= $_GET['nosuratsakit'];
            $get = mysql_query("SELECT * FROM trsuratsakit a JOIN trmedis b ON a.nomedis = b.nomedis
                                JOIN trdaftar c ON b.nodaftar = c.nodaftar 
                                JOIN dbpasien d ON c.kdpasien = d.kdpasien 
                                JOIN dbdokter e ON b.kddokter = e.kddokter
                                WHERE nosuratsakit='$nosuratsakit'
                              ");
            while ($tampil=mysql_fetch_array($get)) {
          ?>
          <div align="center">
            <b><u>SURAT KETERANGAN SAKIT</u></b>
            </br>
            </br>
            </br>
          </div>
        </div>
<div>
<p>
Dengan ini menerangkan bahwa berdasarkan hasil pemeriksaan yang telah dilakukan kepada pasien:
</br>
<table border="0" width="500px">
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
    <td><b>Pekerjaan</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['pekerjaan']; ?></td>
  </tr>
  <tr>
    <td><b>Alamat</b> </td>
    <td>:</td>
    <td>&nbsp;<?php echo $tampil['alamat']; ?></td>
  </tr>
</table>
</br>
Diberikan istirahat sakit selama <?php echo $tampil['lamahari'] ?> hari 
terhitung mulai tanggal <?php echo $tampil['tglawal'] ?> 
s/d tanggal <?php echo $tampil['tglakhir'] ?>
</br>
Demikian surat keterangan ini di berikan untuk diketahui dan dipergunakan sebaik-baiknya.
</br>
</br>
</br>
<div align="Right">
  Serpong, <?php echo $tampil['tglsuratsakit']; ?></br>
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
