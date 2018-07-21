<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Surat Rujukan</h3>
		<a class="btn" href="rujukan.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$norujukan= mysql_real_escape_string($_GET['norujukan']);
$det = mysql_query("SELECT * FROM trsuratrujukan a JOIN trmedis b ON a.nomedis = b.nomedis
					JOIN trdaftar c ON b.nodaftar = c.nodaftar 
					JOIN dbpasien d ON c.kdpasien = d.kdpasien
					JOIN detail_obat e ON b.nomedis = e.nomedis
					WHERE a.norujukan='$norujukan'
					GROUP BY a.nomedis 
					")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">No. Surat Rujukan</th>
			<td><?php echo $d['norujukan'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Surat Rujukan</th>
			<td><?php echo $d['tglrujukan'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Pasien</th>
			<td><?php echo $d['nmpasien'] ?></td>
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
			<th class="col-md-3">Alamat</th>
			<td><?php echo $d['alamat'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Keluhan</th>
			<td><?php echo $d['keluhan'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Diagnosa</th>
			<td><?php echo $d['diagnosa'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Rumah Sakit Rujukan</th>
			<td><?php echo $d['nmrumahsakit'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Spesialis</th>
			<td><?php echo $d['spesialis'] ?></td>
		</tr>
	</table>
	<?php
}
?>
<table width="100%" class="table table">
	<tr align="center">
		<td align="center"><b>Pengobatan Sementara</b></td>
		<td align="center"><b>Nama Tindakan</b></td>
	</tr>
	<?php
	$norujukan= mysql_real_escape_string($_GET['norujukan']);
	$det = mysql_query("SELECT * FROM trsuratrujukan a JOIN trmedis b ON a.nomedis = b.nomedis
						JOIN trdaftar c ON b.nodaftar = c.nodaftar 
						JOIN dbpasien d ON c.kdpasien = d.kdpasien
						JOIN detail_obat e ON b.nomedis = e.nomedis
						WHERE a.norujukan='$norujukan'
						")or die(mysql_error());
	while($d=mysql_fetch_array($det)){
	?>
		<tr>
			<td align="center">
				<?php echo $d['kdobat'] ?>
			</td>
			<td align="center">
				<?php echo $d['nmobat'] ?>
			</td>
		</tr>
		<?php } ?>
</table>
</div>
</div>
