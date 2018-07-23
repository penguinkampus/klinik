<?php
include '../koneksi.php';

?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="lapdaftar.php">Kembali</a>
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
            <h1><b>Nomor Antrian Klinik</b></h1>
          </div>
        </div>
    

<div align="center">

    <?php
    $no = 1;
   
    $get = mysql_query("
           SELECT nodaftar from trdaftar ");
              while ($tampil=mysql_fetch_array($get)) {
                 $gt = $tampil['nodaftar'];
?>
<?php
}?>
<div >
<h1><?php echo substr($gt,3,5) ?></h1>
</div>
<h4>Kamis Siap Melayani Anda </h4>
<div>

<div align="right">
  <?php
  date_default_timezone_set("Asia/Jakarta");

echo  " Print Date "; 
echo date(" Y/m/d | ");
echo date(" h:i:sa ");
?>
</div>

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
