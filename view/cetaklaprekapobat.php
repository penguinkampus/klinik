<?php
include '../koneksi.php';

?>
<!-- Chart Style -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.js"></script>
<script src="../dist/js/utils.js"></script>
<style>
canvas {
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
}
</style>
<!-- End Chart Style -->
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="laprekapobat.php">Kembali</a>
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
            <b><u>LAPORAN REKAPITULASI OBAT</u></b>
          </div>
        </div>

<div>
  <?php
  $tahun   = $_GET['tahun'];
  ?>
  <br>
    <center><b>Periode:</b> <?php echo $tahun; ?></center>
  <br>

  <div align="center">
    <div id="container" style="width: 75%;">
        <canvas id="canvas"></canvas>
    </div>
  </div>
  <br>

<table width="400px" border="1" cellspacing="0" align="center">
  <tr>
    <td align="center"><b>No.</b></td>
    <td align="center"><b>Nama Obat</b></td>
    <td align="center"><b>Total</b></td>
  </tr>
  <tr>
    <?php
    $no = 1;
    $get = mysql_query("SELECT c.nmobat,
                        COUNT(b.kdobat) AS total
                        FROM trmedis a JOIN detail_obat b ON a.nomedis = b.nomedis JOIN dbobat c ON b.kdobat = c.kdobat
                        WHERE YEAR(a.tglmedis) = '$tahun'
                        GROUP BY c.nmobat");
    while ($tampil=mysql_fetch_array($get)) {
    ?>
    <td align="center"><?php echo $no++; ?></td>
    <td><?php echo $tampil['nmobat']; ?></td>
    <td align="center"><?php echo $tampil['total']; ?></td>
  </tr>
  <?php } ?>
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

  //ChartJS
  <?php
  $a = mysql_query("SELECT c.nmobat,
  COUNT(b.kdobat) AS total
  FROM trmedis a JOIN detail_obat b ON a.nomedis = b.nomedis JOIN dbobat c ON b.kdobat = c.kdobat
  WHERE YEAR(a.tglmedis) = '$tahun'
  GROUP BY c.nmobat");
  $b = mysql_query("SELECT c.nmobat,
  COUNT(b.kdobat) AS total
  FROM trmedis a JOIN detail_obat b ON a.nomedis = b.nomedis JOIN dbobat c ON b.kdobat = c.kdobat
  WHERE YEAR(a.tglmedis) = '$tahun'
  GROUP BY c.nmobat");
  ?>
  var ctx = document.getElementById("canvas");
            var canvas = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [<?php while ($x = mysql_fetch_array($a)) { echo '"' . $x['nmobat'] . '",';}?>],
                    datasets: [{
                            label: [<?php while ($x = mysql_fetch_array($a)) { echo '"' . $x['nmobat'] . '",';}?>],
                            data: [<?php while ($xx = mysql_fetch_array($b)) { echo '"' . $xx['total'] .'",';}?>],

                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderWidth: 1
                        }]
                },
                options: {
                    scales: {
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                    }
                }
            });

</script>
