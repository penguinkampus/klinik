<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Surat Sakit</h3>
		<a class="btn" href="suratsakit.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$nosuratsakit = mysql_real_escape_string($_GET['nosuratsakit']);
$det = mysql_query("SELECT * FROM trsuratsakit a JOIN trmedis b ON a.nomedis = b.nomedis
					JOIN trdaftar c ON b.nodaftar = c.nodaftar 
					JOIN dbpasien d ON c.kdpasien = d.kdpasien 
					WHERE nosuratsakit='$nosuratsakit'
					")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>
	<table class="table">
		<tr>
			<th class="col-md-3">No. Surat Sakit</th>
			<td><?php echo $d['nosuratsakit'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Surat Sakit</th>
			<td><?php echo $d['tglsuratsakit'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Pasien</th>
			<td><?php echo $d['nmpasien'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Umur</th>
			<td>Rp. <?php echo $d['umur'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Pekerjaan</th>
			<td><?php echo $d['pekerjaan'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Lama Hari</th>
			<td><?php echo $d['lamahari'] ?> hari</td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Awal</th>
			<td><?php echo $d['tglawal'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Akhir</th>
			<td><?php echo $d['tglakhir'] ?></td>
		</tr>
		
	</table>
	<?php
}
?>
</div>
</div>
