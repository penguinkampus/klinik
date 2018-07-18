<?php include '../koneksi.php'; ?>

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3><span class="glyphicon glyphicon-list-alt"></span>  Detail Rekam Medis</h3>
                <a class="btn pull-right" href="rekmedis.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a></br>

                <?php
		$kdmedis = mysql_real_escape_string($_GET['kdmedis']);
		$detail	= mysql_fetch_array(mysql_query("SELECT * FROM trmedis a JOIN trdaftar b ON a.kddaftar = b.kddaftar
												JOIN dbpasien c ON b.kdpasien = c.kdpasien
												JOIN dbdokter d ON a.kddokter = d.kddokter 
												WHERE a.kdmedis='$kdmedis'"));	
		?>

                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="text-input">Kode Rekam Medis</label>
                        <div class="col-md-3">
                            <input type="text" id="kdmedis" name="kdmedis" class="form-control" placeholder="No. SPSK" value="<?php echo $detail['kdmedis'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="text-input">Tanggal Rekam Medis</label>
                        <div class="col-md-4">
                            <input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Tanggal SPSK" value="<?php echo $detail['tglmedis'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="text-input">Kode Daftar</label>
                        <div class="col-md-5">
                            <input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Nama Penyewa" value="<?php echo $detail['kddaftar'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="text-input">Nama Pasien</label>
                        <div class="col-md-2">
                            <input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Lama Sewa" value="<?php echo $detail['nmpasien'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="text-input">Umur</label>
                        <div class="col-md-3">
                            <input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Jam Keluar" value="<?php echo $detail['umur'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="text-input">Keluhan</label>
                        <div class="col-md-2">
                            <input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Jenis Bayar" value="<?php echo $detail['keluhan'] ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 form-control-label" for="text-input">Nama Dokter</label>
                        <div class="col-md-4">
                            <input type='text' id="no_spsk" name="no_spsk" class="form-control" placeholder="Total Harga" value="<?php echo $detail['nmdokter'] ?>" readonly>
                        </div>
                    </div>

                    <table width="100%" class="table table">
                        <tr align="center">
                            <td align="center"><b>Kode Tindakan</b></td>
                            <td align="center"><b>Nama Tindakan</b></td>
                            <td align="center"><b>Harga Tindakan</b></td>
                        </tr>
                        <?php
			$kdmedis = mysql_real_escape_string($_GET['kdmedis']);
			$det = mysql_query("SELECT * FROM trmedis a 
								JOIN detail_tindakan b ON a.kdmedis = b.kdmedis
								JOIN dbtindakan c ON b.kdtindakan = c.kdtindakan WHERE a.kdmedis='$kdmedis'")or die(mysql_error());
			while($d=mysql_fetch_array($det)){
			?>
                            <tr>
                                <td align="center">
                                    <?php echo $d['kdtindakan'] ?>
                                </td>
                                <td align="center">
                                    <?php echo $d['nmtindakan'] ?>
                                </td>
                                <td align="center">
                                    <?php echo $d['harga'] ?>
                                </td>
                            </tr>
                            <?php	} ?>
                    </table>

                    <hr>

                    <table width="100%" class="table table">
                        <tr align="center">
                            <td align="center"><b>Kode Obat</b></td>
                            <td align="center"><b>Nama Obat</b></td>
                            <td align="center"><b>Harga Obat</b></td>
                        </tr>
                        <?php
			$kdmedis = mysql_real_escape_string($_GET['kdmedis']);
			$det = mysql_query("SELECT * FROM trmedis a 
								JOIN detail_obat b ON a.kdmedis = b.kdmedis
								JOIN dbobat c ON b.kdobat = c.kdobat WHERE a.kdmedis='$kdmedis'")or die(mysql_error());
			while($d=mysql_fetch_array($det)){
			?>
                            <tr>
                                <td align="center">
                                    <?php echo $d['kdobat'] ?>
                                </td>
                                <td align="center">
                                    <?php echo $d['nmobat'] ?>
                                </td>
                                <td align="center">
                                    <?php echo $d['harga'] ?>
                                </td>
                            </tr>
                            <?php	} ?>
                    </table>
            </div>
        </div>
