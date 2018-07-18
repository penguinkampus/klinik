<?php
include '../koneksi.php';

// Fungsi Autonumber
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT kdpasien FROM dbpasien ORDER BY kdpasien DESC LIMIT 1");
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

// Simpan
if (isset($_POST['submit'])) {
  $kdpasien     = $_POST['kdpasien'];
  $nmpasien     = ucwords($_POST['nmpasien']);
  $tgllahir     = $_POST['tgllahir'];
  $alamat       = ucwords($_POST['alamat']);
  $goldarah     = $_POST['goldarah'];
  $jnskelamin   = $_POST['jnskelamin'];
  $umur         = $_POST['umur'];
  $notelp       = $_POST['notelp'];
  

  // $cekno = mysql_query("SELECT * FROM pasien WHERE no_ktpsim = '$no_ktpsim'");  
  // if (mysql_num_rows($cekno) <> 0) {
  //   echo "<script>alert('pasien Sudah di Input!');window.location='tambah-pasien.php';</script>";
  // } else {
  //   $simpan = mysql_query("INSERT INTO pasien VALUES ('$id_pasien', '$nama_pasien', '$no_ktpsim', '$jenkel', '$alamat', '$no_telp', '$email')");
  // }
  $simpan = mysql_query("INSERT INTO dbpasien VALUES (
                          '$kdpasien' 
                          , '$nmpasien'
                          , '$tgllahir'
                          , '$alamat'
                          , '$goldarah'
                          , '$jnskelamin'
                          , '$umur'
                          , '$notelp'
                        )");

  if ($simpan) {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='pasien.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');window.location='tambah-pasien.php';</script>";
  }
}
?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Pasien</h3>
    </div>
  </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Tambah Pasien</strong>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
              <form action="tambah-pasien.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Kode Pasien</label>
                  <div class="col-md-3">
                    <input type="text" id="text-input" name="kdpasien" class="form-control" value="<?php echo autonumber("klinik", "kdpasien", 4, "KP") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Pasien</label>
                  <div class="col-md-5">
                    <input type="text" id="text-input" name="nmpasien" class="form-control" placeholder="Nama pasien" maxlength="50" onkeyup="validHuruf(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal Lahir</label>
                  <div class="col-md-3">
                    <input type="date" id="text-input" name="tgllahir" class="form-control" placeholder="Tanggal Lahir" maxlength="16" onkeyup="validAngka(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Alamat</label>
                  <div class="col-md-6">
                    <textarea id="textarea-input" name="alamat" rows="3" class="form-control" placeholder="Alamat" maxlength="80" required></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Golongan Darah</label>
                  <div class="col-md-2">
                    <input type="text" id="text-input" name="goldarah" class="form-control" placeholder="Golongan Darah" maxlength="2">
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
                  <label class="col-md-2 form-control-label" for="text-input">Umur</label>
                  <div class="col-md-2">
                    <input type="text" id="text-input" name="umur" class="form-control" placeholder="Umur" maxlength="2" onkeyup="validAngka(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Telepon</label>
                  <div class="col-md-3">
                    <input type="text" id="text-input" name="notelp" class="form-control" placeholder="Nomor Telepon" maxlength="12" onkeyup="validAngka(this)" required>
                    <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                  </div>
                </div>
                

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="pasien.php" type="reset" class="btn btn-default">BATAL</a>
                    <button type="submit" name="submit" class="btn btn-primary">SIMPAN</button>
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

  //valiadasi huruf
  function validHuruf(a)
  {
    if(!/^[a-zA-Z]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }
</script>
<!--End of Code JS Validation-->
