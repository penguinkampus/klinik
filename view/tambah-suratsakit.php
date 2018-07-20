<?php
include '../koneksi.php';

$tgl    = date('Y-m-d');
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT nosuratsakit FROM trsuratsakit ORDER BY nosuratsakit DESC LIMIT 1");
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
  $nosuratsakit = $_POST['nosuratsakit'];
  $tglsuratsakit = $_POST['tglsuratsakit'];
  $nomedis = $_POST['nomedis'];
  $nodaftar = $_POST['nodaftar'];
  $tglawal = $_POST['tglawal'];
  $tglakhir = $_POST['tglakhir'];
  $lamahari = $_POST['lamahari'];

  $simpan   = mysql_query("INSERT INTO trsuratsakit VALUES (
                          '$nosuratsakit',
                          '$tglsuratsakit',
                          '$nomedis',
                          '$nodaftar',
                          '$tglawal',
                          '$tglakhir',
                          '$lamahari'
                          )");

  if ($simpan) {
    echo "<script>alert('Data BERHASIL di Simpan!');window.location='suratsakit.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Simpan!');</script>";
  }
}

?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Surat Sakit</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>Tambah Surat Sakit</strong>
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form action="tambah-suratsakit.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No Surat Sakit</label>
                  <div class="col-md-3">
                    <input type="text" id="nosuratsakit" name="nosuratsakit" class="form-control" placeholder="No Surat Sakit" value="<?php echo autonumber("klinik", "nosuratsakit", 4, "NS") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal</label>
                  <div class="col-md-4">
                    <input type="date" id="tglsuratsakit" name="tglsuratsakit" class="form-control" value="<?php echo $tgl; ?>" readonly>
                  </div>
                </div>

                <hr>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No Rekam Medis</label>
                  <div class="col-md-3">
                    <input type="text" id="nomedis" name="nomedis" class="form-control" placeholder="No Rekam Medis" readonly>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No Pendaftaran</label>
                  <div class="col-md-5">
                    <input type="text" id="nodaftar" name="nodaftar" class="form-control" placeholder="No Pendaftaran" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Nama Pasien</label>
                  <div class="col-md-5">
                    <input type="text" id="nmpasien" name="nmpasien" class="form-control" placeholder="Nama Pasien" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Umur</label>
                  <div class="col-md-3">
                    <input type="text" id="umur" name="umur" class="form-control" placeholder="Umur" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Pekerjaan</label>
                  <div class="col-md-5">
                    <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" placeholder="Pekerjaan" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Alamat</label>
                  <div class="col-md-5">
                    <textarea rows="3" type="text" id="alamat" name="alamat" class="form-control" placeholder="Alamat" readonly></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal Awal</label>
                  <div class="col-md-3">
                    <input type="date" id="tglawal" name="tglawal" class="form-control" value="<?php echo $tgl; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal Akhir</label>
                  <div class="col-md-3">
                    <input type="date" id="tglakhir" name="tglakhir" class="form-control" onchange="total_hari();" value="<?php echo $tgl; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Lama Hari</label>
                  <div class="col-md-2">
                    <input type="text" id="lamahari" name="lamahari" class="form-control" placeholder="Lama Hari" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="suratsakit.php" type="reset" class="btn btn-default">BATAL</a>
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
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Data Rekam Medis</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover" id="dataTablesPenyewa">
                <thead>
                  <tr>
                    <th>No Rekam Medis</th>
                    <th>No Pendaftaram</th>
                    <th>Nama Pasien</th>
                    <th>Umur</th>
                    <th>Pekerjaan</th>
                    <th>Alamat</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $get = mysql_query("SELECT * FROM trmedis a JOIN trdaftar b ON a.nodaftar = b.nodaftar
                                      JOIN dbpasien c ON b.kdpasien = c.kdpasien
                                      WHERE nomedis NOT IN (SELECT nomedis FROM trsuratsakit)
                                    ");
                  while ($tampil=mysql_fetch_array($get)) {
                  ?>
                  <tr>
                    <td id='nomedis_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['nomedis']; ?></td>
                    <td id='nodaftar_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['nodaftar']; ?></td>
                    <td id='nmpasien_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['nmpasien']; ?></td>
                    <td id='umur_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['umur']; ?></td>
                    <td id='pekerjaan_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['pekerjaan']; ?></td>
                    <td id='alamat_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['alamat']; ?></td>
                    <td><button onclick="pilihMedis('<?php echo $tampil['nomedis']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
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

  //fungsi lama sewa dari tanggal
  function total_hari(){
	    date_1 = $('#tglawal').val();
	    date_2 = $('#tglakhir').val();
			var date1 = new Date(date_1);
			var date2 = new Date(date_2);
			var timeDiff = Math.abs(date2.getTime() - date1.getTime());
			var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
      if(diffDays == 0){
        diffDays = 1;
      }
      $('#lamahari').val(diffDays);
	}

 //ambil data dari modal medis
 function pilihMedis(nomedis){
    nomedis = $('#nomedis_'+nomedis).html();
    nodaftar = $('#nodaftar_'+nomedis).html();
    nmpasien = $('#nmpasien_'+nomedis).html();
    umur = $('#umur_'+nomedis).html();
    pekerjaan = $('#pekerjaan_'+nomedis).html();
    alamat = $('#alamat_'+nomedis).html();
    $('#nomedis').val(nomedis);
    $('#nodaftar').val(nodaftar);
    $('#nmpasien').val(nmpasien);
    $('#umur').val(umur);
    $('#pekerjaan').val(pekerjaan);
    $('#alamat').val(alamat);
    $('#myModal').modal('hide');
  }
  </script>
  <!--End of Code JS Validation-->
