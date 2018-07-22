<?php include '../koneksi.php'; ?>

 <?php
 $nokwitansi	= mysql_real_escape_string($_GET['nokwitansi']);

 $query = mysql_query("
 	SELECT * FROM trkwitansi a JOIN trmedis b ON a.nomedis = b.nomedis
					JOIN trdaftar c ON b.nodaftar = c.nodaftar
					JOIN dbpasien d ON c.kdpasien = d.kdpasien
					JOIN detail_obat e ON b.nomedis = e.nomedis
					JOIN detail_tindakan f ON b.nomedis = f.nomedis 
					WHERE nokwitansi='$nokwitansi'



 	");
 $data = mysql_fetch_array($query);
?> 

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Kwitansi</h3>
		<a class="btn" href="kwitansi.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

	<table class="table">
	<tr>
			<th class="col-md-3">No. Kwitansi</th>
			<td><?php echo $data['nokwitansi'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Kwitansi</th>
			<td><?php echo $data['tglkwitansi'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Pasien</th>
			<td><?php echo $data['nmpasien'] ?></td>
		</tr>

</table>
<hr>
	<table class="table">
<tr>

			<th class="col-md-2">Obat</th>
			<th class="col-md-2">Total Harga Obat</th>
			<th class="col-md-2">Tindakan</th>
			<th class="col-md-2">Total Harga Tindakan</th>
			<th class="col-md-3">Sub Total</th>
		</tr>
<?php
$nokwitansi	= mysql_real_escape_string($_GET['nokwitansi']);
$det = mysql_query("SELECT * FROM trkwitansi a JOIN trmedis b ON a.nomedis = b.nomedis
					JOIN trdaftar c ON b.nodaftar = c.nodaftar
					JOIN dbpasien d ON c.kdpasien = d.kdpasien
					JOIN detail_obat e ON b.nomedis = e.nomedis
					JOIN detail_tindakan f ON b.nomedis = f.nomedis 
					WHERE nokwitansi='$nokwitansi'
					")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	
	?>

		<tr>
			<td><?php echo $d['nmobat'] ?></td>
			<td>Rp. <?php echo $d['totalobat'] ?></td>
			<td><?php echo $d['nmtindakan'] ?></td>
			<td>Rp. <?php echo $d['totaltindakan'] ?></td>
			<td><b>Rp. <?php echo $data['subtotal'] ?></b></td>
		</tr>
	
	
	<?php
}
?>
<tr>	
			<td></td>
			<td></td>
			
			<td></td>
		</tr>
</table>
</div>
</div>
