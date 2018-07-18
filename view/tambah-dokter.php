<?php
include '../koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT kddokter FROM dbdokter ORDER BY kddokter DESC LIMIT 1");
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

if (isset($_POST['submit'])) {
  $kddokter     = $_POST['kddokter'];
  $nmdokter     = ucwords($_POST['nmdokter']);
  $tgllahir     = $_POST['tgllahir'];
  $spesialis    = ucwords($_POST['spesialis']);
  $jnskelamin   = $_POST['jnskelamin'];
  $alamat       = $_POST['alamat'];
  $notelp       = $_POST['notelp'];

  // $cekno = mysql_query("SELECT * FROM dokter WHERE no_pol = '$no_pol'");
  // if (mysql_num_rows($cekno) <> 0) {
  //   echo "<script>alert('dokter Sudah di Input!');window.location='tambah-dokter.php';</script>";
  // } else {
    $simpan = mysql_query("INSERT INTO dbdokter VALUES (
                          '$kddokter'
                          , '$nmdokter'
                          , '$tgllahir'
                          , '$spesialis'
                          , '$jnskelamin'
                          , '$alamat'
                          , '$notelp'
                          )");
  // }

  if ($simpan) {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='dokter.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');window.location='tambah-dokter.php';</script>";
  }
}
?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form dokter</h3>
    </div>
  </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Tambah dokter</strong>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
              <form action="tambah-dokter.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Kode Dokter</label>
                  <div class="col-md-3">
                    <input type="text" id="kddokter" name="kddokter" class="form-control" value="<?php echo autonumber("klinik", "kddokter", 4, "DK") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Dokter</label>
                  <div class="col-md-5">
                    <input type="text" id="nmdokter" name="nmdokter" class="form-control" placeholder="Nama Dokter" maxlength="35" onkeyup="validHuruf(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal Lahir</label>
                  <div class="col-md-3">
                    <input type="date" id="tgllahir" name="tgllahir" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Spesialis</label>
                  <div class="col-md-4">
                    <input type="text" id="spesialis" name="spesialis" class="form-control" placeholder="Spesialis" maxlength="30" onkeyup="validHuruf(this)">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Jenis Kelamin</label>
                  <div class="col-md-3">
                    <select id="select" name="jnskelamin" class="form-control">
                      <option value="">Pilih Jenis Kelamin</option>
                      <option value="Laki-laki">Laki-laki</option>
                      <option value="Perempuan">Perempuan</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Alamat</label>
                  <div class="col-md-6">
                    <textarea id="textarea-input" name="alamat" rows="3" class="form-control" placeholder="Alamat" maxlength="80" required></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Telepon</label>
                  <div class="col-md-3">
                    <input type="text" id="text-input" name="notelp" class="form-control" placeholder="Nomor Telepon" maxlength="12" onkeyup="validAngka(this)" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="dokter.php" type="reset" class="btn btn-default">BATAL</a>
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
<!-- /#page-wrapper -->

<!--Code JS Validation-->
<script language='javascript'>
  //validasi angka
  function validAngka(a)
  {
    if(!/^[0-9.]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }

  //validasi huruf
  function validHuruf(a)
  {
    if(!/^[a-zA-Z]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }
</script>
<!--End of Code JS Validation-->
