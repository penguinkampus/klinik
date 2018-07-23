<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $tgl_awal   = $_POST['tgl_awal'];
  // $tgl_akhir  = $_POST['tgl_akhir'];

  $simpan = mysql_query("
      SELECT * FROM trmedis a 
JOIN detail_obat b ON a.nomedis = b.nomedis
      WHERE a.tglmedis <= '$tgl_awal' ");
  if ($simpan) {
    echo "<script>alert('Laporan Penyewaan Siap di Cetak!');window.location='cetaklaprekapobat.php?tgl_awal=$tgl_awal';</script>";
  } else {
    echo "<script>alert('Laporan Penyewaan Gagal di Cetak!');window.location='laprekapobat.php';</script>";
  }
}
?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Cetak Laporan Rekapitulasi Medis</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="text-input">Tanggal Periode</label>
          <div class="col-md-3">
            <input type="date" id="tgl_awal" name="tgl_awal" class="form-control" required>
          </div>
        </div>
     

        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="text-input"></label>
          <div class="col-md-5">
            <button type="submit" name="submit" class="btn btn-primary">CETAK</button>
          </div>
        </div>
      </form>
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
