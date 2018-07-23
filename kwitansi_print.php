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
 <?php
 $kwitansi_no = $_GET['kwitansi_no'];

 $query = mysql_query("SELECT * FROM kwitansi JOIN invoice ON kwitansi.invoice_id=invoice.invoice_id WHERE kwitansi_no='$kwitansi_no'");
 $data = mysql_fetch_array($query);

  $query_pelanggan = mysql_query("SELECT * FROM pelanggan WHERE pelanggan_id='".$data['pelanggan_id']."'");
  $data_pelanggan = mysql_fetch_array($query_pelanggan);
?> 

<table border="0" width="100%">
  <tr>
   <td><img alt="" src="../img/ngt.jpg"></td>
    <td width="400px" colspan="2" align="center"><h3><u>KWITANSI</u></h3></td>
     
  </tr>
  <tr>
    <td>PT.NETSOURCE GLOBAL TECH.</td>
    <td colspan="2" align="center"><?php echo $data['kwitansi_no']; ?></td>

   
  </tr>
  <tr>
    <td>JL.RAYA RAGUNAN NO.29A PASAR MINGGU</td>
    <td></td>
     <td></td>
  </tr>
  <tr>
    <td>JAKARTA SELATAN -12540 TELP/FAX 021 - 7892268</td>
     <td align="center" colspan="2"><?php echo date('m-d-Y', strtotime($data['kwitansi_tgl'])); ?></td>

  </tr>
  <tr>
    <td> &nbsp</td>
    <td> </td>
     <td></td>
  </tr>
</table>
<table border="0" width="">
  <tr>
    <td width="150px">&nbsp</td>
    <td width="">&nbsp</td>
     <td width="">&nbsp</td>
  </tr>
  <tr>
    <td>Nama Pelanggan  </td>
     <td >:</td>
      <td><?php echo $data_pelanggan['pelanggan_nama']; ?></td>
  </tr>
  <tr>
    <td>Alamat Pelanggan </td>
    <td>:</td>
     <td> <?php echo $data_pelanggan['pelanggan_alamat']; ?></td>
  </tr>
  <tr>
    <td>Telp  </td>
    <td>:</td>
     <td><?php echo $data_pelanggan['pelanggan_tlpn']; ?></td>
  </tr>
   <tr>
    <td>Pembayaran untuk  </td>
    <td>:</td>
     <td><?php echo $data['pembayaran_untuk']; ?></td>
  </tr>
</table>
<br/><br/>
kwitansi barang : 

<table class="table" border="1" width="100%">
    <thead>
      <tr>
      <th>No.</th>
        <th>Nomor Barang</th>
        <th>Nama Barang</th>
        <th>Jenis Barang</th>
        <th>Deskripsi</th>
        <th>Harga Satuan</th>
                <th>Qty</th>
                <th>Total Harga Barang </th>

     

      </tr>
    </thead>
    <tbody>
      <?php
      $no=1;
      $total_harga = 0;
       $PPN = 0;
       $gt = 0;
      $get = mysql_query("SELECT * FROM sppb_barang JOIN barang ON sppb_barang.barang_no=barang.barang_no JOIN jenis ON barang.jenisbarang_no=jenis.jenisbarang_no WHERE sppb_no='$data[sppb_no]'");
      while ($tampil=mysql_fetch_array($get)) {
      	$total_harga += $tampil['sppb_barang_price_total'];
                $ppn = $total_harga* 0.1;
                $gt = $total_harga + $ppn
      ?>
      <tr class="success">
      <td><?php echo $no;?></td>
        <td><?php echo $tampil['barang_no']; ?></td>
        <td><?php echo $tampil['barang_nama']; ?></td>
        <td><?php echo $tampil['jenisbarang_nama']; ?></td>

        <td><?php echo $tampil['barang_deskripsi']; ?></td>
        <td><?php echo ($tampil['sppb_barang_price_total'] / $tampil['sppb_barang_qty']); ?></td>
         <td><?php echo $tampil['sppb_barang_qty']; ?></td>
           <td><?php echo $tampil['sppb_barang_price_total']; ?></td>
      

      </tr>
<?php $no++;?>
<?php
 } ?>
  <tr class="success">
           <td colspan="6" style="text-align: right;"></td>
         <td colspan="" style="text-align: right;">Total</td>
            <td><?php echo $total_harga; ?></td>
      

      </tr>

<tr class="success">
           <td colspan="6" style="text-align: right;"></td>
         <td colspan="" style="text-align: right;">PPN</td>
            <td><?php echo $ppn; ?></td>
      

      </tr >

        <tr class="success">
           <td colspan="6" style="text-align: right;"></td>
         <td colspan="" style="text-align: right;"><b>Grand Total</td>
            <td><b><?php echo $gt; ?></td>
      

      </tr>
    <tr class="success">
           <td colspan="6" style="text-align: right;"></td>
         <td colspan="" style="text-align: right;"><b>Terbilang</td>
            <td><b><?php echo Terbilang($gt); ?> Rupiah </td>
      

      </tr>


    </tbody>
  </table>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>


  <br>
<table border="0" width="100%">
  <tr>
    <td width="200px" align="right" >Best Regards,</td>
    <td>&nbsp</td>
     <td width="300px"></td>
  </tr>
  <tr>
    <td>&nbsp</td>
     <td width="500px"></td>
      <td></td>
  </tr>
  <tr>
    <td>&nbsp</td>
    <td>&nbsp</td>
     <td>&nbsp</td>
  </tr>
    <tr>
    <td>&nbsp</td>
    <td>&nbsp</td>
     <td>&nbsp</td>
  </tr>
    <tr>
    <td>&nbsp</td>
    <td>&nbsp</td>
     <td>&nbsp</td>
  </tr>
    <tr>
    <td><u></u></td>
    <td>&nbsp</td>
     <td>&nbsp</td>
  </tr>
  <tr>
    < <td width="200px" align="right" >Date <?php echo date('m-d-Y');?></td>
    <td></td>
     <td></td>
  </tr>
</table>

<script>
window.print();
</script>