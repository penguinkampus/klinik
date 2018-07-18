<?php
include '../koneksi.php';

$tgl    = date('Y-m-d');
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT kdmedis FROM trmedis ORDER BY kdmedis DESC LIMIT 1");
    $jumlahrecord = mysql_num_rows($query);
    if($jumlahrecord == 0)
        $nomor=1;
    else
    {
        $row=mysql_fetch_array($query);
        $nomor=intval(substr($row[0],strlen($awalan)))+1;
    }
    if($lebar>0)
        $angka = $awalan.str_pad($nomor,$lebar,"0",STR_PAD_LEFT);
    else
        $angka = $awalan.$nomor;

    return $angka;
}

// delete tindakan dari temp_tindakan
if (isset($_GET['kdtindakan'])){
  $kdtindakan = $_GET['kdtindakan'];
  mysql_query("DELETE FROM temp_tindakan WHERE kdtindakan='$kdtindakan'");
}

// delete obat dari temp_obat
if (isset($_GET['kdobat'])){
  $kdobat = $_GET['kdobat'];
  mysql_query("DELETE FROM temp_obat WHERE kdobat='$kdobat'");
}

// tambah tindakan ke temp_tindakan
if (isset($_POST['tambah'])) {
  $kdtindakan = $_POST['kdtindakan'];
  $nmtindakan = $_POST['nmtindakan'];
  $harga = $_POST['harga'];

  $cekid = mysql_query("SELECT * FROM temp_tindakan WHERE kdtindakan = '$kdtindakan'");
  if (mysql_num_rows($cekid) <> 0) {
    echo "<script>alert('Tindakan Sudah di input!');window.location='tambah-rekmedis.php';</script>";
  } else {
    $tambah = mysql_query("INSERT INTO temp_tindakan VALUES(
                            '$kdtindakan', 
                            '$nmtindakan', 
                            '$harga'
                            )");
  }
}

// tambah obat ke temp_obat
if (isset($_POST['tambahobat'])) {
  $kdobat = $_POST['kdobat'];
  $nmobat = $_POST['nmobat'];
  $harga = $_POST['harga'];

  $tambah = mysql_query("INSERT INTO temp_obat VALUES(
                            '$kdobat', 
                            '$nmobat', 
                            '$harga'
                            )");
}

if (isset($_POST['submit'])) {
  $gettindakan = mysql_fetch_array(mysql_query("SELECT kdtindakan FROM temp_tindakan"));
  $kdmedis = $_POST['kdmedis'];
  $tglmedis = $_POST['tglmedis'];
  $kddaftar = $_POST['kddaftar'];
  $nmpasien = $_POST['nmpasien'];
  $umur = $_POST['umur'];
  $keluhan = $_POST['keluhan']; 
  $kddokter = $_POST['kddokter'];
  $nmdokter = $_POST['nmdokter'];
  $spesialis = $_POST['spesialis'];
  $diagnosa = $_POST['diagnosa'];

  $cekid = mysql_query("SELECT * FROM trmedis WHERE kdmedis = '$kdmedis'");
  if (mysql_num_rows($cekid) <> 0) {
    echo "<script>alert('Rekam Medis Sudah di Input!');window.location='tambah-rekmedis.php';</script>";
  } elseif (empty($kdmedis)) {
    echo "<script>alert('Silahkan isi semua data!');window.location='tambah-rekmedis.php';</script>";
  } else {
  $simpan = mysql_query("INSERT INTO trmedis VALUES(
                        '$kdmedis', 
                        '$tglmedis', 
                        '$kddaftar', 
                        '$diagnosa',
                        '$kddokter'
                        )");
  }

    if($simpan == 1){
      $simtindakan = mysql_query("SELECT * FROM temp_tindakan");
      while ($t=mysql_fetch_row($simtindakan)) {

      mysql_query("INSERT INTO detail_tindakan VALUES (
                  '$kdmedis',
                  '$t[0]',
                  '$t[1]',
                  '$t[2]'
                  )");
    }
  }

    if($simpan == 1){
      $simobat = mysql_query("SELECT * FROM temp_obat");
      while ($o=mysql_fetch_row($simobat)) {
        mysql_query("INSERT INTO detail_obat VALUES (
                    '$kdmedis',
                    '$o[0]',
                    '$o[1]',
                    '$o[2]'
                    )");
      }
      echo "<script>alert('Data Rekam Medis Berhasil di Input!');window.location='rekmedis.php';</script>";
      mysql_query("TRUNCATE TABLE temp_tindakan");
      mysql_query("TRUNCATE TABLE temp_obat");
    } else {
      echo "<script>alert('Data GAGAL di Simpan!');</script>";
    }
}

?>

    <div id="page-wrapper">
        <div class='row'>
            <div class='col-lg-12'>
                <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Rekam Medis</h3>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong>Tambah Rekam Medis</strong>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="tambah-rekmedis.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Kode Tindakan</label>
                                        <div class="col-md-2">
                                            <input type="text" id="kdtindakan" name="kdtindakan" class="form-control" placeholder="Kode Tindakan" readonly>
                                        </div>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal3">CARI</button>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Nama Tindakan</label>
                                        <div class="col-md-4">
                                            <input type="text" id="nmtindakan" name="nmtindakan" class="form-control" placeholder="Nama Tindakan" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Harga</label>
                                        <div class="col-md-3">
                                            <input type="text" id="harga" name="harga" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <button type="submit" name="tambah" id="tambah" class="btn btn-default">TAMBAH</button>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input"></label>
                                        <div class="col-md-10 table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode Tindakan</th>
                                                    <th>Nama Tindakan</th>
                                                    <th>Harga</th>
                                                    <th>Opsi</th>
                                                </tr>
                                                <tr>
                                                    <?php
                          $no = 1;
                          $get = mysql_query("SELECT * FROM temp_tindakan");
                          while ($tampil=mysql_fetch_array($get)) {
                          ?>
                                                        <td>
                                                            <?php echo $no++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $tampil['kdtindakan']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $tampil['nmtindakan']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $tampil['harga']; ?>
                                                        </td>
                                                        <td><a onclick="{ location.href='tambah-rekmedis.php?kdtindakan=<?php echo $tampil['kdtindakan']; ?>' }" class="btn btn-danger btn-xs">Hapus</a></td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </form>

                                <hr>

                                <form action="tambah-rekmedis.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Kode Obat</label>
                                        <div class="col-md-2">
                                            <input type="text" id="kdobat" name="kdobat" class="form-control" placeholder="Kode Obat" readonly>
                                        </div>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal4">CARI</button>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Nama Obat</label>
                                        <div class="col-md-4">
                                            <input type="text" id="nmobat" name="nmobat" class="form-control" placeholder="Nama Obat" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Harga</label>
                                        <div class="col-md-3">
                                            <input type="text" id="hargaobat" name="harga" class="form-control" placeholder="Harga" readonly>
                                        </div>
                                        <button type="submit" name="tambahobat" id="tambah" class="btn btn-default">TAMBAH</button>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input"></label>
                                        <div class="col-md-10 table-responsive">
                                            <table class="table">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Kode Obat</th>
                                                    <th>Nama Obat</th>
                                                    <th>Harga</th>
                                                    <th>Opsi</th>
                                                </tr>
                                                <tr>
                                                    <?php
                          $no = 1;
                          $get = mysql_query("SELECT * FROM temp_obat");
                          while ($tampil=mysql_fetch_array($get)) {
                          ?>
                                                        <td>
                                                            <?php echo $no++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $tampil['kdobat']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $tampil['nmobat']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $tampil['harga']; ?>
                                                        </td>
                                                        <td><a onclick="{ location.href='tambah-rekmedis.php?kdobat=<?php echo $tampil['kdobat']; ?>' }" class="btn btn-danger btn-xs">Hapus</a></td>
                                                </tr>
                                                <?php } ?>
                                            </table>
                                        </div>
                                    </div>
                                </form>

                                <hr>

                                <form action="tambah-rekmedis.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                                    <!-- <div class="col-lg-12"> -->
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Kode Rekam Medis</label>
                                        <div class="col-md-3">
                                            <input type="text" id="text-input" name="kdmedis" class="form-control" value="<?php echo autonumber(" klinik ", "kdmedis ", 4, "RM ") ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Tanggal</label>
                                        <div class="col-md-4">
                                            <input type="date" id="text-input" name="tglmedis" class="form-control" value="<?php echo $tgl; ?>" readonly>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Kode Daftar</label>
                                        <div class="col-md-3">
                                            <input type="text" id="kddaftar" name="kddaftar" class="form-control" placeholder="Kode Daftar" readonly>
                                        </div>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">CARI</button>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Nama Pasien</label>
                                        <div class="col-md-5">
                                            <input type="text" id="nmpasien" name="nmpasien" class="form-control" placeholder="Nama Pasien" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Umur</label>
                                        <div class="col-md-5">
                                            <input type="text" id="umur" name="umur" class="form-control" placeholder="Umur" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Keluhan</label>
                                        <div class="col-md-5">
                                            <input type="text" id="keluhan" name="keluhan" class="form-control" placeholder="Keluhan" readonly>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Kode Dokter</label>
                                        <div class="col-md-5">
                                            <input type="text" id="kddokter" name="kddokter" class="form-control" placeholder="Kode Dokter" readonly>
                                        </div>
                                        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2">CARI</button>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Nama Dokter</label>
                                        <div class="col-md-5">
                                            <input type="text" id="nmdokter" name="nmdokter" class="form-control" placeholder="Nama Dokter" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Spesialis</label>
                                        <div class="col-md-5">
                                            <input type="text" id="spesialis" name="spesialis" class="form-control" placeholder="Spesialis" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input">Diagnosa</label>
                                        <div class="col-md-5">
                                            <textarea type="text" rows="3" id="diagnosa" name="diagnosa" class="form-control" placeholder="Diagnosa"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-2 form-control-label" for="text-input"></label>
                                        <div class="col-md-5">
                                            <a href="rekmedis.php" type="reset" class="btn btn-default">BATAL</a>
                                            <button name="submit" type="submit" class="btn btn-primary">SIMPAN</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Pendaftaran-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Pilih Pendaftaran</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>KD Daftar</th>
                                                <th>Nama Pasien</th>
                                                <th>Umur</th>
                                                <th>Keluhan</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                    $get = mysql_query("SELECT * FROM trdaftar a 
                                                  JOIN dbpasien b ON a.kdpasien = b.kdpasien 
                                                  WHERE a.kddaftar 
                                                    NOT IN (SELECT kddaftar FROM trmedis) 
                                                    ORDER BY a.kddaftar DESC");
                    while ($tampil=mysql_fetch_array($get)) {
                    ?>
                                                <tr>
                                                    <td id='kddaftar_<?php echo $tampil[' kddaftar '];?>'>
                                                        <?php echo $tampil['kddaftar']; ?>
                                                    </td>
                                                    <td align="center" id='nmpasien_<?php echo $tampil[' kddaftar '];?>'>
                                                        <?php echo $tampil['nmpasien']; ?>
                                                    </td>
                                                    <td align="center" id='umur_<?php echo $tampil[' kddaftar '];?>'>
                                                        <?php echo $tampil['umur']; ?>
                                                    </td>
                                                    <td id='keluhan_<?php echo $tampil[' kddaftar '];?>'>
                                                        <?php echo $tampil['keluhan']; ?>
                                                    </td>
                                                    <td align="center">
                                                        <button onclick="pilihDaftar('<?php echo $tampil['kddaftar']; ?>')" class="btn btn-info btn-xs">Pilih</button>
                                                    </td>
                                                </tr>
                                                <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Dokter -->
        <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Pilih Dokter</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-dokter">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode Dokter</th>
                                                <th>Nama Dokter</th>
                                                <th>Spesialis Dokter</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                    $no = 1;
                    $get = mysql_query("SELECT * FROM dbdokter");
                    while ($tampil=mysql_fetch_array($get)) {
                    ?>
                                                <tr>
                                                    <td align="center">
                                                        <?php echo $no++; ?>
                                                    </td>
                                                    <td align="center" id='kddokter_<?php echo $tampil[' kddokter '];?>'>
                                                        <?php echo $tampil['kddokter']; ?>
                                                    </td>
                                                    <td id='nmdokter_<?php echo $tampil[' kddokter '];?>'>
                                                        <?php echo $tampil['nmdokter']; ?>
                                                    </td>
                                                    <td align="center" id='spesialis_<?php echo $tampil[' kddokter '];?>'>
                                                        <?php echo $tampil['spesialis']; ?>
                                                    </td>
                                                    <td align="center">
                                                        <button onclick="pilihDokter('<?php echo $tampil['kddokter']; ?>')" class="btn btn-info btn-xs">Pilih</button>
                                                    </td>
                                                </tr>
                                                <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Tindakan -->
        <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Pilih Tindakan</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-tindakan">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode Tindakan</th>
                                                <th>Nama Tindakan</th>
                                                <th>Harga Tindakan</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                    $no = 1;
                    $get = mysql_query("SELECT * FROM dbtindakan WHERE kdtindakan NOT IN (SELECT kdtindakan FROM temp_tindakan)");
                    while ($tampil=mysql_fetch_array($get)) {
                    ?>
                                                <tr>
                                                    <td align="center">
                                                        <?php echo $no++; ?>
                                                    </td>
                                                    <td align="center" id='kdtindakan_<?php echo $tampil[' kdtindakan '];?>'>
                                                        <?php echo $tampil['kdtindakan']; ?>
                                                    </td>
                                                    <td id='nmtindakan_<?php echo $tampil[' kdtindakan '];?>'>
                                                        <?php echo $tampil['nmtindakan']; ?>
                                                    </td>
                                                    <td align="center" id='harga_<?php echo $tampil[' kdtindakan '];?>'>
                                                        <?php echo $tampil['harga']; ?>
                                                    </td>
                                                    <td align="center">
                                                        <button onclick="pilihTindakan('<?php echo $tampil['kdtindakan']; ?>')" class="btn btn-info btn-xs">Pilih</button>
                                                    </td>
                                                </tr>
                                                <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Obat -->
        <div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Pilih Obat</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-obat">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kode Obat</th>
                                                <th>Nama Obat</th>
                                                <th>Harga Obat</th>
                                                <th>Opsi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                    $no = 1;
                    $get = mysql_query("SELECT * FROM dbobat WHERE kdobat NOT IN (SELECT kdobat FROM temp_obat)");
                    while ($tampil=mysql_fetch_array($get)) {
                    ?>
                                                <tr>
                                                    <td align="center">
                                                        <?php echo $no++; ?>
                                                    </td>
                                                    <td align="center" id='kdobat_<?php echo $tampil[' kdobat '];?>'>
                                                        <?php echo $tampil['kdobat']; ?>
                                                    </td>
                                                    <td id='nmobat_<?php echo $tampil[' kdobat '];?>'>
                                                        <?php echo $tampil['nmobat']; ?>
                                                    </td>
                                                    <td align="center" id='hargaobat_<?php echo $tampil[' kdobat '];?>'>
                                                        <?php echo $tampil['harga']; ?>
                                                    </td>
                                                    <td align="center">
                                                        <button onclick="pilihObat('<?php echo $tampil['kdobat']; ?>')" class="btn btn-info btn-xs">Pilih</button>
                                                    </td>
                                                </tr>
                                                <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /#page-wrapper -->

    <!--Code JS Validation-->
    <script language='javascript'>
        function validAngka(a) {
            if (!/^[0-9.]+$/.test(a.value)) {
                a.value = a.value.substring(0, a.value.length - 1000);
            }
        }

        //ambil data dari modal pendaftaran
        function pilihDaftar(kddaftar) {
            kddaftar = $('#kddaftar_' + kddaftar).html();
            nmpasien = $('#nmpasien_' + kddaftar).html();
            umur = $('#umur_' + kddaftar).html();
            keluhan = $('#keluhan_' + kddaftar).html();
            $('#kddaftar').val(kddaftar);
            $('#nmpasien').val(nmpasien);
            $('#umur').val(umur);
            $('#keluhan').val(keluhan);
            $('#myModal').modal('hide');
        }

        //ambil data dari modal dokter
        function pilihDokter(kddokter) {
            kddokter = $('#kddokter_' + kddokter).html();
            nmdokter = $('#nmdokter_' + kddokter).html();
            spesialis = $('#spesialis_' + kddokter).html();
            $('#kddokter').val(kddokter);
            $('#nmdokter').val(nmdokter);
            $('#spesialis').val(spesialis);
            $('#myModal2').modal('hide');
        }

        //ambil data dari modal tindakan
        function pilihTindakan(kdtindakan) {
            kdtindakan = $('#kdtindakan_' + kdtindakan).html();
            nmtindakan = $('#nmtindakan_' + kdtindakan).html();
            harga = $('#harga_' + kdtindakan).html();
            $('#kdtindakan').val(kdtindakan);
            $('#nmtindakan').val(nmtindakan);
            $('#harga').val(harga);
            $('#myModal3').modal('hide');
        }

        //ambil data dari modal tindakan
        function pilihObat(kdobat) {
            kdobat = $('#kdobat_' + kdobat).html();
            nmobat = $('#nmobat_' + kdobat).html();
            harga = $('#hargaobat_' + kdobat).html();
            $('#kdobat').val(kdobat);
            $('#nmobat').val(nmobat);
            $('#hargaobat').val(harga);
            $('#myModal4').modal('hide');
        }
    </script>
    <!--End of Code JS Validation-->
