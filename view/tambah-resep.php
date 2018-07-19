<?php
include '../koneksi.php';

$tgl    = date('Y-m-d');
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT noresep FROM trsuratresep ORDER BY noresep DESC LIMIT 1");
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

// if (isset($_POST['submit'])) {
//   $nodaftar   = $_POST['nodaftar'];
//   $kdpasien   = $_POST['kdpasien'];
//   $tgldaftar  = $_POST['tgldaftar'];
//   $nmpasien   = $_POST['nmpasien'];
//   $goldarah   = $_POST['goldarah'];
//   $umur       = $_POST['umur'];
//   $keluhan    = ucwords($_POST['keluhan']);

//   $simpan   = mysql_query("INSERT INTO trdaftar VALUES (
//                           '$nodaftar'
//                           , '$kdpasien'
//                           , '$tgldaftar'
//                           , '$nmpasien'
//                           , '$goldarah'
//                           , '$umur'
//                           , '$keluhan'
//                           )");

//   if ($simpan) {
//     echo "<script>alert('Data BERHASIL di Simpan!');window.location='daftar.php';</script>";
//   } else {
//     echo "<script>alert('Data GAGAL di Simpan!');window.location='tambah-daftar.php';</script>";
//   }
// }

?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Surat Resep</h3>
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
                  <label class="col-md-2 form-control-label" for="text-input">No Resep</label>
                  <div class="col-md-3">
                    <input type="text" id="noresep" name="noresep" class="form-control" placeholder="No Surat Resep" value="<?php echo autonumber("klinik", "noresep", 4, "NR") ?>" readonly>
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
                  <label class="col-md-2 form-control-label" for="text-input">No Rekam Medis</label>
                  <div class="col-md-3">
                    <input type="text" id="nomedis" name="nomedis" class="form-control" placeholder="No Rekam Medis" readonly>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2">CARI</button>
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
                  <label class="col-md-2 form-control-label" for="text-input">Keluhan</label>
                  <div class="col-md-5">
                    <textarea rows="3" type="text" id="keluhan" name="keluhan" class="form-control" placeholder="Keluhan" readonly></textarea>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Diagnosa</label>
                  <div class="col-md-5">
                    <textarea rows="3" type="text" id="diagnosa" name="diagnosa" class="form-control" placeholder="Diagnosa" readonly></textarea>
                  </div>
                </div>

                <table width="100%" class="table table">
                        <tr align="center">
                            <td align="center"><b>Kode Obat</b></td>
                            <td align="center"><b>Nama Obat</b></td>
                            <td align="center"><b>Harga Obat</b></td>
                        </tr>
                        <?php
                        $nomedis = mysql_real_escape_string($_GET['nomedis']);
                        $det = mysql_query("SELECT * FROM trmedis a 
                                            JOIN detail_obat b ON a.nomedis = b.nomedis
                                            JOIN dbobat c ON b.kdobat = c.kdobat WHERE a.nomedis='$nomedis'")or die(mysql_error());
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
                    <th>No Pendaftaran</th>
                    <th>Nama Pasien</th>
                    <th>Umur</th>
                    <th>Keluhan</th>
                    <th>Diagnosa</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $get = mysql_query("SELECT * FROM trmedis a JOIN trdaftar b ON a.nodaftar = b.nodaftar
                                      JOIN dbpasien c ON b.kdpasien = c.kdpasien");
                  while ($tampil=mysql_fetch_array($get)) {
                  ?>
                  <tr>
                    <td id='nomedis_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['nomedis']; ?></td>
                    <td id='nodaftar_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['nodaftar']; ?></td>
                    <td id='nmpasien_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['nmpasien']; ?></td>
                    <td id='umur_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['umur']; ?></td>
                    <td id='keluhan_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['keluhan']; ?></td>
                    <td id='diagnosa_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['diagnosa']; ?></td>
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

  //ambil data dari modal penyewa
  function pilihMedis(nomedis){
    nomedis = $('#nomedis_'+nomedis).html();
    nodaftar = $('#nodaftar_'+nomedis).html();
    nmpasien = $('#nmpasien_'+nomedis).html();
    umur = $('#umur_'+nomedis).html();
    keluhan = $('#keluhan_'+nomedis).html();
    diagnosa = $('#diagnosa_'+nomedis).html();
    $('#nomedis').val(nomedis);
    $('#nodaftar').val(nodaftar);
    $('#nmpasien').val(nmpasien);
    $('#umur').val(umur);
    $('#keluhan').val(keluhan);
    $('#diagnosa').val(diagnosa);
    $('#myModal2').modal('hide');
  }
  </script>
  <!--End of Code JS Validation-->
