<?php
include '../koneksi.php';

?>
<?php function Terbilang($satuan)
{
$huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
if ($satuan < 12)
return " " . $huruf[$satuan];
elseif ($satuan < 20)
return Terbilang($satuan - 10) . "Belas";
elseif ($satuan < 100)
return Terbilang($satuan / 10) . " Puluh" . Terbilang($satuan % 10);
elseif ($satuan < 200)
return " Seratus" . Terbilang($satuan - 100);
elseif ($satuan < 1000)
return Terbilang($satuan / 100) . " Ratus" . Terbilang($satuan % 100);
elseif ($satuan < 2000)
return " Seribu" . Terbilang($satuan - 1000);
elseif ($satuan < 1000000)
return Terbilang($satuan / 1000) . " Ribu" . Terbilang($satuan % 1000);
elseif ($satuan < 1000000000)
return Terbilang($satuan / 1000000) . " Juta" . Terbilang($satuan % 1000000);
elseif ($satuan <= 1000000000)
echo "Maaf Tidak Dapat di Prose Karena Jumlah Uang Terlalu Besar ";
}
?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header">
        <a class="btn btn-defaul" href="kwitansi.php">Kembali</a>
        <a class="btn btn-default no-print" href="javascript:printDiv('area-1');">Print</a>
      </h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div id="area-1">
        <div>
          <div align="center">
            <b><u>KWITANSI</u></b>
          </div>
        </div>
<?php
$nokwitansi	= $_GET['nokwitansi'];
$get = mysql_query("SELECT * FROM trkwitansi a JOIN trmedis b ON a.nomedis = b.nomedis 
                    JOIN trdaftar c ON b.nodaftar = c.nodaftar
                    JOIN dbpasien d ON c.kdpasien = d.kdpasien
                    WHERE a.nokwitansi = '$nokwitansi'"
                  );
while ($tampil=mysql_fetch_array($get)) {
?>
<div>
<table border="0" width="100%">
  <tr>
    <td><b>No. Kwitansi</b> </td>
    <td>:</td>
    <td><?php echo $tampil['nokwitansi']; ?></td>
    <td><b>Telah terima dari</b> </td>
    <td>:</td>
    <td><?php echo $tampil['nmpasien']; ?></td>
  </tr>
  <tr>
    <td><b>Tanggal</b> </td>
    <td>:</td>
    <?php
      $tglkwitansi = Date_create($tampil['tglkwitansi']);
      $tglkwt       = Date_format($tglkwitansi, 'd/m/Y');
    ?>
    <td><?php echo $tglkwt; ?></td>
    <td><b>Sejumlah Uang</b> </td>
    <td>:</td>
    <td>Rp. <?php echo $tampil['subtotal']; ?></td>
  </tr>
</div>

<table width="100%" border="1" cellspacing="0">
  <br>
  <tr>
    <td align="center"><b>No.</b></td>
    <td align="center"><b>Pembayaran Obat</b></td>
    <td align="center"><b>Pembayaran Tindakan</b></td>
    <td align="center"><b>Harga Obat</b></td>
    <td align="center"><b>Harga Tindakan</b></td>
  </tr>
  <tr>
    <?php
    $no = 1;

    $get = mysql_query ("
    SELECT *,e.harga as hargaobat, f.harga as hargatindakan FROM trkwitansi a JOIN trmedis b ON a.nomedis = b.nomedis 
    JOIN trdaftar c ON b.nodaftar = c.nodaftar
    JOIN dbpasien d ON c.kdpasien = d.kdpasien
    JOIN detail_obat e ON b.nomedis = e.nomedis
    JOIN detail_tindakan f ON b.nomedis = f.nomedis
    WHERE a.nokwitansi = '$nokwitansi'
    
    ");
    $nmobat = 'aaaa'; 
    while ($tampil=mysql_fetch_array($get)) {
    ?>
    <td align="center"><?php echo $no++; ?>.</td>
    <td align="center">
    <?php echo $tampil['nmobat']; ?>
    
    </td>
    <td align="center">
    <?php echo $tampil['nmtindakan']; ?>
    
    </td>
    <td align="center">Rp. <?php echo $tampil['hargaobat']; ?></td>
    <td align="center">Rp. <?php echo $tampil['hargatindakan']; ?></td>
  </tr>
  <?php } ?>

  <?php
  $tampil = mysql_fetch_array(mysql_query("SELECT * FROM trkwitansi a JOIN trmedis b ON a.nomedis = b.nomedis 
  JOIN trdaftar c ON b.nodaftar = c.nodaftar
  JOIN dbpasien d ON c.kdpasien = d.kdpasien
  WHERE a.nokwitansi = '$nokwitansi'")
  );
  ?>
  <tr>
    <td colspan="3" rowspan="3"></td>
    <td><b>S U B T O T A L</b></td>
    <td align="center"><b>Rp. <?php echo $tampil['subtotal']; ?></b></td>
  </tr>
  <tr>
    <td><b>T E R B I L A N G</b></td>
    <td><b><?php echo Terbilang($tampil['subtotal']); ?></b></td>
  </tr>

</table>
<br>

<table width="100%" border="0" height="150px">
  <tr>
    <td align="center" width="250px"><b>Pasien</b></td>
    <th></th>
    <td align="center" width="250px"><b>Admin</b></td>
  </tr>
  <tr>
    <td align="center">( <?php echo $tampil['nmpasien']; ?> )</td>
    <td align="center"></td>
    <td align="center">( <?php echo $_SESSION['login_user']; ?> )</td>
  </tr>
</table>
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
