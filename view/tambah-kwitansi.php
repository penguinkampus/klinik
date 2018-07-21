<?php
include '../koneksi.php';

$tgl    = date('Y-m-d');
function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT nokwitansi FROM trkwitansi ORDER BY nokwitansi DESC LIMIT 1");
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
  $nokwitansi = $_POST['nokwitansi'];
  $tglkwitansi = $_POST['tglkwitansi'];
  $nomedis = $_POST['nomedis'];
  $totalobat = $_POST['totalobat'];
  $totaltindakan = $_POST['totaltindakan'];
  $subtotal  = $_POST['subtotal'];

  $simpan = mysql_query("INSERT INTO trkwitansi VALUES(
                        '$nokwitansi', 
                        '$tglkwitansi', 
                        '$nomedis',
                        '$totalobat',
                        '$totaltindakan',
                        '$subtotal'
                        )");

  if ($simpan) {
    echo "<script>alert('Data Kwitansi Siap di Cetak!');window.location='kwitansi.php';</script>";
  } else {
    echo "<script>alert('Data Kwitansi Gagal di Cetak!');window.location='tambah-kwitansi.php';</script>";
  }
}

?>

<div id="page-wrapper">
  <div class='row'>
    <div class='col-lg-12'>
      <h3 class="page-header"><span class="glyphicon glyphicon-file"></span> Form Kwitansi</h3>
    </div>
  </div>

      <div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>Tambah Kwitansi</strong>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-12">
              <form action="tambah-kwitansi.php" method="POST" enctype="multipart/form-data" class="form-horizontal ">
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Kwitansi</label>
                  <div class="col-md-3">
                    <input type="text" id="nokwitansi" name="nokwitansi" class="form-control" value="<?php echo autonumber("klinik", "nokwitansi", 4, "NK") ?>" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Tanggal</label>
                  <div class="col-md-4">
                    <input type="date" id="tglkwitansi" name="tglkwitansi" class="form-control" value="<?php echo $tgl; ?>" readonly>
                  </div>
                </div>

                <hr>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Rekam Medis</label>
                  <div class="col-md-3">
                    <input type="text" id="nomedis" name="nomedis" class="form-control" placeholder="No Rekam Medis" readonly>
                  </div>
                  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">CARI</button>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">No. Pendaftaran</label>
                  <div class="col-md-3">
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
                  <label class="col-md-2 form-control-label" for="text-input">Total Obat</label>
                  <div class="col-md-3">
                    <input type="text" id="totalobat" name="totalobat" class="form-control" placeholder="Total Harga" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Total Tindakan</label>
                  <div class="col-md-3">
                    <input type="text" id="totaltindakan" name="totaltindakan" class="form-control" placeholder="Total Harga" readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input">Total Harga</label>
                  <div class="col-md-3">
                    <input type="text" id="subtotal" name="subtotal" class="form-control" placeholder="Total Harga" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-md-2 form-control-label" for="text-input"></label>
                  <div class="col-md-5">
                    <a href="kwitansi.php" type="reset" class="btn btn-default">BATAL</a>
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pilih Rekam Medis</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive">
            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
              <thead>
                <tr>
                  <th>No. Rekam Medis</th>
                  <th>No. Pendaftaran</th>
                  <th>Nama Pasien</th>
                  <th>Total Obat</th>
                  <th>Total Tindakan</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $get = mysql_query("SELECT DISTINCT *,
                                    (SELECT SUM(harga) from trmedis xa JOIN detail_obat xb ON xa.nomedis = xb.nomedis where xa.nomedis = a.nomedis ) totalobat,
                                    (SELECT SUM(harga) from trmedis xa JOIN detail_tindakan xc ON xa.nomedis = xc.nomedis where xa.nomedis = a.nomedis ) totaltindakan
                                    FROM trmedis a JOIN trdaftar b ON a.nodaftar = b.nodaftar
                                        JOIN dbpasien c ON b.kdpasien = c.kdpasien
                                        JOIN detail_obat d ON a.nomedis = d.nomedis
                                        JOIN detail_tindakan e ON a.nomedis = e.nomedis
                                        WHERE a.nomedis NOT IN (SELECT nomedis FROM trkwitansi)
                                        GROUP BY a.nomedis                    
                                  ");
                while ($tampil=mysql_fetch_array($get)) {
                ?>
                <tr>
                  <td id='nomedis_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['nomedis']; ?></td>
                  <td id='nodaftar_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['nodaftar']; ?></td>
                  <td id='nmpasien_<?php echo $tampil['nomedis'];?>'><?php echo $tampil['nmpasien']; ?></td>
                  <td id='totalobat_<?php echo $tampil['nomedis'];?>'> <?php echo $tampil['totalobat']; ?></td>
                  <td id='totaltindakan_<?php echo $tampil['nomedis'];?>'> <?php echo $tampil['totaltindakan']; ?></td>
                  <td align="center"><button onclick="pilihMedis('<?php echo $tampil['nomedis']; ?>')" class="btn btn-info btn-xs">Pilih</button></td>
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

//ambil data dari modal mobil
function pilihMedis(nomedis){
  nomedis = $('#nomedis_'+nomedis).html();
  nodaftar = $('#nodaftar_'+nomedis).html();
  nmpasien  = $('#nmpasien_'+nomedis).html();
  totalobat = $('#totalobat_'+nomedis).html();
  totaltindakan = $('#totaltindakan_'+nomedis).html();
  var totalobat1 = parseInt(totalobat);
  var totaltindakan1 = parseInt(totaltindakan);
  var subtotal = (totalobat1+totaltindakan1);
  $('#nomedis').val(nomedis);
  $('#nodaftar').val(nodaftar);
  $('#nmpasien').val(nmpasien);
  $('#totalobat').val(totalobat);
  $('#totaltindakan').val(totaltindakan);
  $("#subtotal").val(subtotal);
  $('#myModal').modal('hide');
}
</script>
<!--End of Code JS Validation-->
