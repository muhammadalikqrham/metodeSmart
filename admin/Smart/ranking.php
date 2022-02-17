<?php include_once '../conf/function.php' ?>
<?php include_once '../template/header.php'; ?>
<?php
$ph_tanah = [];
$teksturTanah = [];
$usia = [];
$batang = [];
$pupuk = [];
$normPh_tanah = [];
$normUsia = [];
$normTeksturTanah = [];
$normPupuk = [];
$normBatang = [];
$V = [];

$bobot = query("SELECT * FROM tb_alternatif");
$bobotAlt = query("SELECT * FROM tb_bobotkriteria");
$jml = count($bobot);
// var_dump($bobot);
// echo $jml;
foreach ($bobot as $row) {
  // var_dump($row);    
  // tinggi
  if ($row['ph_tanah'] >= 5 && $row['ph_tanah'] < 6) {
    array_push($ph_tanah, 3);
  } elseif ($row['ph_tanah'] >= 6 && $row['ph_tanah'] < 7) {
    array_push($ph_tanah, 2);
  } elseif ($row['ph_tanah'] >= 7 && $row['ph_tanah'] <= 7.8) {
    array_push($ph_tanah, 1);
  }
  // usia
  if ($row['usia'] >= 4 && $row['usia'] <= 6) {
    array_push($usia, 3);
  } elseif ($row['usia'] >= 7 && $row['usia'] <= 9) {
    array_push($usia, 2);
  } elseif ($row['usia'] >= 10) {
    array_push($usia, 1);
  }
  // Daun
  if ($row['Tekstur_tanah'] == 'lempung') {
    array_push($teksturTanah, 3);
  } elseif ($row['Tekstur_tanah'] == 'sekam bakar') {
    array_push($teksturTanah, 2);
  } elseif ($row['Tekstur_tanah'] == 'gembur') {
    array_push($teksturTanah, 1);
  }
  // cabang
  if ($row['pupuk'] == 'pupuk perangsang bunga') {
    array_push($pupuk, 3);
  } elseif ($row['pupuk'] == 'kompos') {
    array_push($pupuk, 2);
  }
  // batang
  if ($row['batang'] == 'beranting') {
    array_push($batang, 3);
  } elseif ($row['batang'] == 'berjamur') {
    array_push($batang, 2);
  } elseif ($row['batang'] == 'berkayu keras') {
    array_push($batang, 1);
  }
}
for ($i = 0; $i < $jml; $i++) {
  array_push($normPh_tanah, ($ph_tanah[$i] - min($ph_tanah)) / (max($ph_tanah) - min($ph_tanah)) * 1);
  array_push($normTeksturTanah, (($teksturTanah[$i] - min($teksturTanah)) / (max($teksturTanah) - min($teksturTanah))));
  array_push($normUsia, ($usia[$i] - min($usia)) / (max($usia) - min($usia)));
  array_push($normBatang, ($batang[$i] - min($batang)) / (max($batang) - min($batang)));
  array_push($normPupuk, ($pupuk[$i] - min($pupuk)) / (max($pupuk) - min($pupuk)));
}
// var_dump($normPupuk);
// exit;
$i = 0;
for ($i = 0; $i < $jml; $i++) {
  $countPref = (($normPh_tanah[$i] * (float)$bobotAlt[0]['nilai_bobot']) + ($normTeksturTanah[$i] * (float)$bobotAlt[1]['nilai_bobot']) + ($normUsia[$i] * (float)$bobotAlt[2]['nilai_bobot']) + ($normBatang[$i] * (float)$bobotAlt[3]['nilai_bobot']) + ($normPupuk[$i] * (float)$bobotAlt[4]['nilai_bobot']));
  array_push($V, $countPref);
  array_push($bobot[$i], $countPref);
}
// var_dump($V);
for ($i = 0; $i < $jml; $i++) {
  $rank = 1;
  for ($j = 0; $j < $jml; $j++) {
    if ($bobot[$i][0] < $bobot[$j][0]) {
      $rank++;
    } elseif ($i == $j) {
      continue;
    } elseif ($bobot[$i][0] == $bobot[$j][0] && $i > $j) {
      $rank++;
    }
  }
  array_push($bobot[$i], $rank);
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>HASIL PERHITUNGAN</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Blank Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Hasil Perhitungan Smart</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <!-- /.card -->

        <div class="card">
          <div class="card-header" style="background-color: #afe0db;">
            Hasil Perhitungan dengan Metode Smart
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="card-header">
              <h1>Tabel Preferensi</h1>
            </div>
            <table id="example1" class="table table-bordered table-striped">
              <thead align="center">
                <tr>
                  <th>No.</th>
                  <th>Nama Alternatif</th>
                  <th>C1</th>
                  <th>C2</th>
                  <th>C3</th>
                  <th>C4</th>
                  <th>C5</th>
                  <th>Nilai Preferensi(V)</th>
                  <th>Rank</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                for ($i = 0; $i < $jml; $i++) :
                ?>
                  <?php
                  foreach ($bobot as $row) :
                  ?>
                    <tr>
                      <?php if ($row[1] == ($i + 1)) : ?>
                        <td><?= $i + 1 ?></td>
                        <td><?= $row['nama_alternatif'] ?></td>
                        <td><?= (float)$normPh_tanah[$i] * (float)$bobotAlt[0]['nilai_bobot'] ?></td>
                        <td><?= (float) $normTeksturTanah[$i] * (float)$bobotAlt[0]['nilai_bobot']; ?></td>
                        <td><?= (float) $normUsia[$i] * (float)$bobotAlt[0]['nilai_bobot']; ?></td>
                        <td><?= (float) $normBatang[$i] * (float)$bobotAlt[0]['nilai_bobot']; ?></td>
                        <td><?= (float) $normPupuk[$i] * (float)$bobotAlt[0]['nilai_bobot']; ?></td>
                        <td><?= $row[0]; ?></td>
                        <td><?= $row[1];  ?></td>
                      <?php endif; ?>
                    </tr>
                  <?php endforeach; ?>
                <?php endfor; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.card -->
      <?php include_once '../template/footer.php' ?>