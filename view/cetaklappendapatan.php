<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="lappendapatan.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <hr>
          <div align="center">
            <b><u>Laporan Pendapatan</u></b>
          </div>
        </div>

<div>
  <?php
  $tgl_awal = Date_create($_GET['tgl_awal']);
  $tgl_akhir= Date_create($_GET['tgl_akhir']);
  $tawal    = Date_format($tgl_awal, "d-m-Y");
  $takhir   = Date_format($tgl_akhir, "d-m-Y");
  $date1    = Date_format($tgl_awal, "Y-m-d");
  $date2    = Date_format($tgl_akhir, "Y-m-d");
  ?>
  <br>
    <b>Periode :</b> <?php echo $tawal; ?> <b>S.D.</b> <?php echo $takhir; ?>
  <br>

<table width="100%" border="1" cellspacing="0">
  <tr>
    <td align="center"><b>No.</b></td>
    <td align="center"><b>Tanggal Kwitansi</b></td>
    <td align="center"><b>Nama Pasien</b></td>
    <td align="center"><b>Diagnosa</b></td>
    <td align="center"><b>Harga</b></td>
  </tr>
  <tr>
    <?php
    $no = 1;
   
    $get = mysql_query("
          
           SELECT * from trkwitansi a
      JOIN trmedis b ON a.nomedis = b.nomedis
      JOIN trdaftar c ON b.nodaftar = c.nodaftar
      WHERE 
      a.tglkwitansi >= '$date1' AND a.tglkwitansi <= '$date2' 
       GROUP BY a.nokwitansi


          ");
    while ($tampil=mysql_fetch_array($get)) {
      $gt = $tampil['subtotal'];
    ?>
    <td align="center">
    <?php
        echo $no++;
      
      ?></td>
    <td align="center">
      <?php 
          echo $tampil['nokwitansi'];
   
      ?></td>
    <td><?php echo $tampil['nmpasien']; ?></td>
        <td><?php echo $tampil['diagnosa']; ?></td>
            <td align="center">Rp. <?php echo $tampil['subtotal']; ?></td>
   </tr>
  <?php  } ?>
  <tr>
                <td colspan="4" align="center"><b>Sub Total</b></td>
                        <td  align="center"><b>Rp. <?php echo $gt; ?></b></td>
                      </tr>
</table>

<div align="right">
  <table width="150px" border="0" height="150px">
    <tr>
      <td align="center"><b>Staff Admin</b></td>
    </tr>
    <tr>
      <td align="center">( <?php echo $_SESSION['login_user']; ?> )</td>
    </tr>
  </table>
</div>
  </div>
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
