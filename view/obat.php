<!-- <?php
include '../koneksi.php';

function autonumber($tabel, $kolom, $lebar=0, $awalan='')
{
    $query= mysql_query("SELECT kdobat FROM dbobat ORDER BY kdobat DESC LIMIT 1");
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

// Fungsi Tambah Obat
if (isset($_POST['submit'])) {
  $kdobat     = $_POST['kdobat'];
  $nmobat     = ucwords($_POST['nmobat']);
  $stok       = $_POST['stok'];
  $exp        = $_POST['exp'];
  $keterangan = $_POST['keterangan'];
  $harga      = $_POST['harga'];

  $cekno = mysql_query("SELECT * FROM dbobat WHERE nmobat = '$nmobat'");
  if (mysql_num_rows($cekno) <> 0) {
    echo "<script>alert('Obat Sudah di Input!');window.location='obat.php';</script>";
  } else {
    $simpan = mysql_query("INSERT INTO dbobat VALUES(
                          '$kdobat'
                          , '$nmobat'
                          , '$stok'
                          , '$exp'
                          , '$keterangan'
                          , '$harga'
                          )");
  }

  if ($simpan) {
    echo "Data BERHASIL di Simpan!";
  } else {
    echo "Data GAGAL di Simpan!";
  }
}

if (isset($_POST['update'])) {
  $id_obat  = $_POST['id_obat'];
  $nama_obat= ucwords($_POST['nama_obat']);

  $update = mysql_query("UPDATE obat SET id_obat='$id_obat', nama_obat='$nama_obat' WHERE id_obat='$id_obat'");
  if ($update) {
    echo "<script>alert('Data BERHASIL di Update!');window.location='obat.php';</script>";
  } else {
    echo "<script>alert('Data GAGAL di Update!');window.location='obat.php';</script>";
  }
}

$id_obat = $_GET['id_obat'];
mysql_query("DELETE FROM obat WHERE id_obat='$id_obat'");
?> -->
<div id="page-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header"><span class="glyphicon glyphicon-briefcase"></span> Data Obat</h3>
      <button style='margin-bottom:20px' data-toggle='modal' data-target='#myModal' class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span> Tambah Obat</button>
    </div>
    <!-- /.col-lg-12 -->
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-12">
      <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
        <thead>
          <tr>
            <th>Kode</th>
            <th>Nama</th>
            <th>Stok</th>
            <th>Kadaluarsa</th>
            <th>Keterangan</th>
            <th>Harga</th>
            <th>Opsi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $get = mysql_query("SELECT * FROM dbobat");
          while ($tampil=mysql_fetch_array($get)) {
          ?>
          <tr>
            <td><?php echo $tampil['kdobat']; ?></td>
            <td><?php echo $tampil['nmobat']; ?></td>
            <td><?php echo $tampil['stok']; ?></td>
            <td><?php echo $tampil['exp']; ?></td>
            <td><?php echo $tampil['keterangan']; ?></td>
            <td><?php echo $tampil['harga']; ?></td>
            <td align="center">
              <button onclick="pilihobat('<?php echo $tampil['kdobat']; ?>')" data-toggle="modal" data-target="#ModalEdit" class="btn btn-warning btn-sm">Edit</button>
              <a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini?')){ location.href='obat.php?kdobat=<?php echo $tampil['kdobat']; ?>' }" class="btn btn-danger btn-sm">Hapus</a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
    </table>
    <!-- /.table-responsive -->
  </div>
  <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<!-- Tambah Obat -->
<div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Tambah Obat</h4>
      </div>
      <div class="modal-body">
        <form action="obat.php" method="POST">
          <div class="form-group">
            <label>Kode Obat</label>
            <input name="kdobat" type="text" class="form-control" placeholder="kode Obat" value="<?php echo autonumber("klinik", "kdobat", 4, "OB") ?>" readonly>
          </div>
          <div class="form-group">
            <label>Nama Obat</label>
            <input name="nmobat" type="text" class="form-control" placeholder="Nama Obat" maxlength="50" required>
          </div>
          <div class="form-group">
            <label>Stok Obat</label>
            <input name="stok" type="text" class="form-control" placeholder="Stok Obat" maxlength="50" required>
          </div>
          <div class="form-group">
            <label>Expired Obat</label>
            <input name="exp" type="date" class="form-control" placeholder="Expired Obat" maxlength="50">
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <input name="keterangan" type="text" class="form-control" placeholder="Keterangan Obat" maxlength="50" required>
          </div>
          <div class="form-group">
            <label>Harga Obat</label>
            <input name="harga" type="text" class="form-control" placeholder="Harga Obat" maxlength="50" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <input name="submit" type="submit" class="btn btn-primary" value="Simpan">
        </div>
      </form>
    </div>
  </div>
</div>

<!-- modal edit -->
<div id="ModalEdit" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Edit obat</h4>
      </div>
      <div class="modal-body">
        <form action="obat.php" method="POST">
          <div class="form-group">
            <label>ID obat</label>
            <input id="kdobat" name="kdobat" type="text" class="form-control" placeholder="ID obat" readonly>
          </div>
          <div class="form-group">
            <label>Nama obat</label>
            <input id="nmobat" name="nmobat" type="text" class="form-control" placeholder="Nama obat" onkeyup="validHuruf(this)" required>
          </div>
          <div class="form-group">
            <label>Stok</label>
            <input id="stok" name="stok" type="text" class="form-control" placeholder="Nama obat" onkeyup="validHuruf(this)" required>
          </div>
          <div class="form-group">
            <label>Kadaluarsa</label>
            <input id="exp" name="exp" type="text" class="form-control" placeholder="Nama obat" onkeyup="validHuruf(this)" required>
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <input id="keterangan" name="keterangan" type="text" class="form-control" placeholder="Nama obat" onkeyup="validHuruf(this)" required>
          </div>
          <div class="form-group">
            <label>Harga</label>
            <input id="harga" name="harga" type="text" class="form-control" placeholder="Nama obat" onkeyup="validHuruf(this)" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <input name="update" type="submit" class="btn btn-primary" value="Update">
        </div>
      </form>
    </div>
  </div>
</div>

</div>
<!-- /#page-wrapper -->

<script>
  //ambil data dari tabel
  function pilihobat(kdobat){
    kdobat     = $('#kdobat_'+kdobat).html();
    nmobat     = $('#nmobat_'+kdobat).html();
    stok       = $('#stok_'+kdobat).html();
    exp        = $('#exp_'+kdobat).html();
    keterangan = $('#keterangan_'+kdobat).html();
    harga      = $('#harga_'+kdobat).html();
    $('#kdobat').val(kdobat);
    $('#nmobat').val(nmobat);
    $('#stok').val(stok);
    $('#exp').val(exp);
    $('#keterangan').val(keterangan);
    $('#harga').val(harga);
  }


  //validasi huruf
  function validHuruf(a)
  {
    if(!/^[a-zA-Z]+$/.test(a.value))
    {
      a.value = a.value.substring(0,a.value.length-1000);
    }
  }
</script
