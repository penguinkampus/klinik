<?php
include '../koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT kdpetugas FROM dbpetugas ORDER BY kdpetugas DESC LIMIT 1");
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
  $kdpetugas  = $_POST['kdpetugas'];
  $nmpetugas  = ucwords($_POST['nmpetugas']);
  $jnskelamin = $_POST['jnskelamin'];
  $tgllahir   = $_POST['tgllahir'];
  $alamat     = ucwords($_POST['alamat']);
  $notelp     = $_POST['notelp'];
  $level      = $_POST['level'];
  $username   = $_POST['username'];
  $password   = $_POST['password'];

  $cekuser = mysql_query("SELECT * FROM dbpetugas WHERE username = '$username' and nmpetugas = '$nmpetugas'");
  if (mysql_num_rows($cekuser) <> 0) {
    echo "<script>alert('Petugas Sudah di Input!');window.location='tambah-petugas.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO dbpetugas VALUES (
                          '$kdpetugas'
                          , '$nmpetugas'
                          , '$jnskelamin'
                          , '$tgllahir'
                          , '$alamat'
                          , '$notelp'
                          , '$level'
                          , '$username'
                          , '$password'
                          )");
  }

  if ($simpan) {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='petugas.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');window.location='tambah-petugas.php';</script>";
  }
}
?>
<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Petugas</h3>
    </div>
  </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Tambah Petugas</strong>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
              <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Kode Petugas</label>
                  <div class="col-md-3">
                    <input type="text" id="text-input" name="kdpetugas" class="form-control" value="<?php echo autonumber("klinik", "kdpetugas", 4, "PT") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Petugas</label>
                  <div class="col-md-5">
                    <input type="text" id="text-input" name="nmpetugas" class="form-control" placeholder="Nama Petugas" maxlength="50" onkeyup="validHuruf(this)" required>
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
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal Lahir</label>
                  <div class="col-md-3">
                    <input type="date" id="text-input" name="tgllahir" class="form-control" placeholder="Tanggal Lahir" maxlength="16" onkeyup="validAngka(this)" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Alamat</label>
                  <div class="col-md-5">
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
                  <label class="col-md-2 form-control-label" for="text-input">Level</label>
                  <div class="col-md-5">
                    <input type="text" id="text-input" name="level" class="form-control" placeholder="Level" maxlength="50" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Username</label>
                  <div class="col-md-5">
                    <input type="text" id="text-input" name="username" class="form-control" placeholder="Username" maxlength="15" required>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Password</label>
                  <div class="col-md-5">
                    <input type="password" id="text-input" name="password" class="form-control" placeholder="Password" maxlength="20" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="petugas.php" type="reset" class="btn btn-default">BATAL</a>
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
