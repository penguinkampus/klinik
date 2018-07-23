<?php
include '../koneksi.php';

$tgl    = date('Y-m-d');
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT nodaftar FROM trdaftar ORDER BY nodaftar DESC LIMIT 1");
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
  $nodaftar   = $_POST['nodaftar'];
  $kdpasien   = $_POST['kdpasien'];
  $tgldaftar  = $_POST['tgldaftar'];
  $nmpasien   = $_POST['nmpasien'];
  $goldarah   = $_POST['goldarah'];
  $umur       = $_POST['umur'];
  $keluhan    = ucwords($_POST['keluhan']);

  $simpan   = mysql_query("INSERT INTO trdaftar VALUES (
                          '$nodaftar',
                          '$tgldaftar',
                          '$kdpasien',
                          '$nmpasien',
                          '$goldarah',
                          '$umur',
                          '$keluhan'
                          )");

  if ($simpan) {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='daftar.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');window.location='tambah-daftar.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Pendaftaran</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Tambah Daftar</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form action="tambah-daftar.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No Daftar</label>
                  <div class="col-md-3">
                    <input type="text" id="nodaftar" name="nodaftar" class="form-control" placeholder="No Daftar" value="<?php echo autonumber("klinik", "nodaftar", 4, "ND") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal</label>
                  <div class="col-md-4">
                    <input type="date" id="tgldaftar" name="tgldaftar" class="form-control" value="<?php echo $tgl; ?>" readonly>
                  </div>
                </div>

                <hr>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Kode Pasien</label>
                  <div class="col-md-3">
                    <input type="text" id="kdpasien" name="kdpasien" class="form-control" placeholder="Kode Pasien" readonly required>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Pasien</label>
                  <div class="col-md-5">
                    <input type="text" id="nmpasien" name="nmpasien" class="form-control" placeholder="Nama pasien" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Golongan Darah</label>
                  <div class="col-md-5">
                    <input type="text" id="goldarah" name="goldarah" class="form-control" placeholder="Golongan Darah" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Umur</label>
                  <div class="col-md-3">
                    <input type="text" id="umur" name="umur" class="form-control" placeholder="Umur" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Keluhan</label>
                  <div class="col-md-5">
                    <textarea rows="3" type="text" id="keluhan" name="keluhan" class="form-control" placeholder="Keluhan" required></textarea>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="daftar.php" type="reset" class="btn btn-default">BATAL</a>
                    <button name="submit" type="submit" class="btn btn-primary">CETAK</button>
                  </div>
                </div>
              </form>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Penyewa -->
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Data Pasien</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTablesPenyewa">
                <thead>
                  <tr>
                    <th>KD Pasien</th>
                    <th>Nama Pasien</th>
                    <th>Golongan Darah</th>
                    <th>Umur</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $get = mysql_query("SELECT * FROM dbpasien");
                  while ($tampil=mysql_fetch_array($get)) {
                  ?>
                  <tr>
                    <td id='kdpasien_<?php echo $tampil['kdpasien'];?>'><?php echo $tampil['kdpasien']; ?></td>
                    <td id='nmpasien_<?php echo $tampil['kdpasien'];?>'><?php echo $tampil['nmpasien']; ?></td>
                    <td id='goldarah_<?php echo $tampil['kdpasien'];?>'><?php echo $tampil['goldarah']; ?></td>
                    <td id='umur_<?php echo $tampil['kdpasien'];?>'><?php echo $tampil['umur']; ?></td>
                    <td><button onclick="pilihPasien('<?php echo $tampil['kdpasien']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
                  </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-wrapper -->

  <!--Code JS Validation-->
  <script language='javascript'>
  function validAngka(a)
  {
    if(!/^[0-9.]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }

  //ambil data dari modal penyewa
  function pilihPasien(kdpasien){
    kdpasien     = $('#kdpasien_'+kdpasien).html();
    nmpasien     = $('#nmpasien_'+kdpasien).html();
    goldarah     = $('#goldarah_'+kdpasien).html();
    umur         = $('#umur_'+kdpasien).html();
    $('#kdpasien').val(kdpasien);
    $('#nmpasien').val(nmpasien);
    $('#goldarah').val(goldarah);
    $('#umur').val(umur);
    $('#myModal2').modal('hide');
  }
  </script>
  <!--End of Code JS Validation-->
