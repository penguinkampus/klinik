<?php
include '../koneksi.php';

if (isset($_POST['submit'])) {
  $tahun   = $_POST['tahun'];

  $simpan = mysql_query("SELECT c.nmobat,
                        COUNT(b.kdobat) AS total
                        FROM trmedis a JOIN detail_obat b ON a.nomedis = b.nomedis JOIN dbobat c ON b.kdobat = c.kdobat
                        WHERE YEAR(a.tglmedis) = '$tahun'
                        GROUP BY c.nmobat");
  if ($simpan) {
    echo "<script>alert('Laporan Rekapitulasi Obat Siap di Cetak!');window.location='cetaklaprekapobat.php?tahun=$tahun';</script>";
  } else {
    echo "<script>alert('Laporan Rekapitulasi Obat Gagal di Cetak!');window.location='laprekapobat.php';</script>";
  }
}
?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Cetak Laporan Rekapitulasi Obat</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
        <div class="form-group row">
          <label class="col-md-2 form-control-label" for="text-input">Tahun</label>
          <div class="col-md-3">
          <select id="tahun" name="tahun" class="form-control">
              <script>
              //menampilkan tahun
              var date  = new Date();
              var tahun = date.getFullYear();
              for (var i = 2017; i < tahun+1; i++) {
                document.write('<option value="'+i+'">'+i+'</option>');
              }
              </script>
            </select>
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

