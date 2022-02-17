<?php include_once '../conf/function.php' ?>
<?php include_once '../template/header.php'; ?>
<?php

$bobot = query("SELECT * FROM tb_alternatif");

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Alternatif</h1>
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
        <h3 class="card-title">Tabel Data Alternatif</h3>

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
        <a href="http://localhost/smart/admin/alternatif/add_alternatif.php" class="btn" style="background-color: #afe0db;"><i class="fas fa-plus mr-3"></i>Tambah Alternatif</a>
        <div class="card mt-3">
          <div class="card-header" style="background-color: #afe0db;">
            <h3 class="card-title">Data Alternatif</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama Alternatif</th>
                  <th>Ph Tanah</th>
                  <th>Tekstur Tanah</th>
                  <th>Usia</th>
                  <th>Batang</th>
                  <th>Pupuk</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                foreach ($bobot as $row) :
                ?>
                  <tr>
                    <td><?= ++$no ?></td>
                    <td><?= $row['nama_alternatif'] ?></td>
                    <td><?= $row['ph_tanah'] ?></td>
                    <td><?= $row['Tekstur_tanah'] ?></td>
                    <td><?= $row['usia'], ' Bulan' ?></td>
                    <td><?= $row['batang'] ?></td>
                    <td><?= $row['pupuk'] ?></td>
                    <td align="center">
                      <a href="edit_alternatif.php?id=<?= $row['id_alternatif'] ?>" class="btn btn-success btn-sm"> <i class="fas fa-edit"></i></a>
                      <a href="hapus.php?id=<?= $row['id_alternatif'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini ?')"> <i class="fas fa-trash"></i></a>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.card -->
      <?php include_once '../template/footer.php' ?>