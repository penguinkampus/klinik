<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Dokter</h3>
		<a class="btn" href="dokter.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$kddokter	= mysql_real_escape_string($_GET['kddokter']);
$det		= mysql_query("SELECT * FROM dbdokter WHERE kddokter='$kddokter'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">Kode dokter</th>
			<td><?php echo $d['kddokter'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Dokter</th>
			<td><?php echo $d['nmdokter'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Lahir</th>
			<td><?php echo $d['tgllahir'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Spesialis</th>
			<td><?php echo $d['spesialis'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Jenis Kelamin</th>
			<td><?php echo $d['jnskelamin'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Alamat</th>
			<td><?php echo $d['alamat'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">No. Telp</th>
			<td><?php echo $d['notelp'] ?></td>
		</tr>
	</table>
	<?php
}
?>
</div>
</div>
