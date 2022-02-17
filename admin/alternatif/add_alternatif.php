<?php include_once '../conf/function.php' ?>
<?php include_once '../template/header.php'; ?>
<?php

if (isset($_POST['submit'])) {

  if (tambahKriteria($_POST) > 0) {

    echo  "
          <script>
            alert('Data Berhasil Ditambahkan!');
            document.location.href = 'http://localhost/smart/admin/alternatif'
          </script>";
  } else {
    echo 'Data gagal ditambahkan';
  }
}

?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>ALternatif</h1>
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
        <h3 class="card-title">Title</h3>

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
        <div class="card">
          <div class="card-header" style="background-color: #afe0db;">
            <h3 class="card-title">Input Alternatif</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form action="" method="post">
            <div class="card-body">
              <div class="form-group">
                <label for="bibit">Bibit</label>
                <input type="text" class="form-control" id="bibit" autocomplete="off" name="nama_bibit" required>
              </div>
              <div class="form-group">
                <label for="ph_tanah">Ph Tanah</label>
                <input type="text" name="ph_tanah" class="form-control" id="ph_tanah" required>
                <span class="text-monospace text-danger"> Input Ph Tanah hanya bisa dari 5.00 sampai 7.00 </span>
              </div>
              <div class="form-group">
                <label for="tekstur_tanah">Tekstur Tanah</label>
                <select name="tekstur_tanah" id="cabang" class="form-control">
                  <option value="lempung">Lempung</option>
                  <option value="sekam bakar">Sekam Bakar</option>
                  <option value="gembur">Gembur</option>
                </select>
              </div>
              <div class="form-group">
                <div class="form-group">
                  <label for="usia">Usia (Bulan)</label>
                  <input type="text" name="usia" class="form-control" id="usia">
                  <span class="text-monospace text-danger"> jika bilangan decimal gunakan titik (.) </span>
                </div>
                <label for="batang">Batang</label>
                <select name="batang" id="batang" class="form-control">
                  <option value="beranting">Beranting</option>
                  <option value="berjamur">Berjamur</option>
                  <option value="berkayu keras">Berkayu Keras</option>
                </select>
              </div>
              <div class="form-group">
                <label for="pupuk">pupuk</label>
                <select name="pupuk" id="pupuk" class="form-control">
                  <option value="pupuk perangsang bunga">Pupuk Perangsang Bunga</option>
                  <option value="kompos">Kompos</option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <button type="submit" class="btn" name="submit" style="background-color: #afe0db;">Simpan</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.card-body -->
      <!-- <div class="card-footer">
    Footer
  </div> -->
      <!-- /.card-footer-->
    </div>
    <!-- /.card -->
    <script>
      function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
          textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
              this.oldValue = this.value;
              this.oldSelectionStart = this.selectionStart;
              this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
              this.value = this.oldValue;
              this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
              this.value = "";
            }
          });
        });
      }

      setInputFilter(document.getElementById("ph_tanah"), function(value) {
        return /^-?\d*[.,]?\d*$/.test(value) && (value === "" || parseFloat(value) <= 7.00) && (value === "" || parseFloat(value) >= 5);
      });
      setInputFilter(document.getElementById("usia"), function(value) {
        return /^-?\d*[.,]?\d*$/.test(value);
      });
      $('#usia').change(function() {
        if (document.getElementById('usia').value < 4) {
          console.log('oke');
          document.getElementById('usia').value = "";
        }

      })
      document.getElementById('usia').addEventListener('keypress', function() {})
    </script>
    <?php include_once '../template/footer.php' ?>