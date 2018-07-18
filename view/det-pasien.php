<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Pasien</h3>
		<a class="btn" href="pasien.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$kdpasien	= mysql_real_escape_string($_GET['kdpasien']);
$det		= mysql_query("SELECT * FROM dbpasien WHERE kdpasien='$kdpasien'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">Kode Pasien</th>
			<td><?php echo $d['kdpasien'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Pasien</th>
			<td><?php echo $d['nmpasien'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Lahir</th>
			<td><?php echo $d['tgllahir'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Alamat</th>
			<td><?php echo $d['alamat'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Golongan Darah</th>
			<td><?php echo $d['goldarah'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Jenis Kelamin</th>
			<td><?php echo $d['jnskelamin'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Umur</th>
			<td><?php echo $d['umur'] ?></td>
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
