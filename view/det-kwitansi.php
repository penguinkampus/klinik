<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Kwitansi</h3>
		<a class="btn" href="kwitansi.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

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
	<table class="table">
		<tr>
			<th class="col-md-3">No. Kwitansi</th>
			<td><?php echo $d['nokwitansi'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Tanggal Kwitansi</th>
			<td><?php echo $d['tglkwitansi'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Nama Pasien</th>
			<td><?php echo $d['nmpasien'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Pembayaran Obat</th>
			<td><?php echo $d['nmobat'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Pembayaran Tindakan</th>
			<td><?php echo $d['nmtindakan'] ?></td>
		</tr>
		<tr>
			<th class="col-md-3">Total Harga</th>
			<td>Rp. <?php echo $d['subtotal'] ?></td>
		</tr>
	</table>
	<?php
}
?>
</div>
</div>
