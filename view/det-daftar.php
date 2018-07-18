<?php include '../koneksi.php'; ?>

<div id="page-wrapper">
<div class="row">
	<div class="col-lg-12">
		<h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Daftar</h3>
		<a class="btn pull-right" href="daftar.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a></br>

		<?php
		$nodaftar		= mysql_real_escape_string($_GET['nodaftar']);
		$detail			= mysql_fetch_array(mysql_query("SELECT * FROM trdaftar a JOIN dbpasien b ON a.kdpasien = b.kdpasien WHERE a.nodaftar='$nodaftar'"));
		?>
		<table class="table">
			<tr>
				<th class="col-md-3">Kode Daftar</th>
				<td><?php echo $detail['nodaftar'] ?></td>
			</tr>
			<tr>
				<th class="col-md-3">Tanggal Daftar</th>
				<td><?php echo $detail['tgldaftar'] ?></td>
			</tr>
			<tr>
				<th class="col-md-3">Kode Pasien</th>
				<td><?php echo $detail['kdpasien'] ?></td>
			</tr>
			<tr>
				<th class="col-md-3">Nama Pasien</th>
				<td><?php echo $detail['nmpasien'] ?></td>
			</tr>
			<tr>
				<th class="col-md-3">Golongan Darah</th>
				<td><?php echo $detail['goldarah'] ?></td>
			</tr>
			<tr>
				<th class="col-md-3">Umur</th>
				<td><?php echo $detail['umur'] ?></td>
			</tr>
			<tr>
				<th class="col-md-3">Keluhan</th>
				<td><?php echo $detail['keluhan'] ?></td>
			</tr>
		</table>
	</div>
</div>
