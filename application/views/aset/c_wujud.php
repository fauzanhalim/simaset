<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Aset Berwujud</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Data Aset</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('aset_wujud')?>">Berwujud</a></li>
              <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="flash-data-gagal" data-flashdatagagal="<?=$this->session->flashdata('gagal');?>"></div>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form Tambah Data</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <?php if (validation_errors()): ?>
            <div class="alert alert-danger col-md-8 alert-dismissible">                
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?= validation_errors(); ?>
            </div>
          <?php endif ?>
          <form class="form-horizontal" action="<?=base_url('aset_wujud/simpan')?>" autocomplete="off" method="post">
            <div class="card-body">
              <div class="form-group row">
                <label for="id_barang" class="col-sm-2 col-form-label">Nama Aset</label>
                <div class="col-sm-6">
                  <select name="id_barang" class="selectx form-control" required>
                      <option value="">Pilih..</option>
                      <?php foreach ($brg as $row): ?>
                        <option value="<?=$row['id_barang'];?>"><?=$row['nama_barang'];?></option>
                      <?php endforeach ?> 
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="volume" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-6">
                  <input type="number" class="form-control" name="volume" min="0" placeholder="Masukan Jumlah.." required>
                </div>
              </div>
              <div class="form-group row">
                <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                <div class="col-sm-6">
                  <select name="satuan" class="form-control" required>
                    <option value="">Pilih..</option>
                    <option value="Buah">Buah</option>
                    <option value="Lembar">Lembar</option>
                    <option value="Unit">Unit</option>
                    <option value="Lokal">Lokal</option>
                    <option value="Cm2">Cm2</option>     
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                <div class="col-sm-6">
                   <select name="kondisi" class="form-control" required>
                    <option value="">Pilih..</option>
                    <option value="Baik">Baik</option>
                    <option value="Renovasi">Renovasi</option>
                    <option value="Rusak">Rusak</option>     
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="id_lokasi" class="col-sm-2 col-form-label">Lokasi Aset</label>
                <div class="col-sm-6">
                  <select name="id_lokasi" class="form-control selectx" required>
                    <option value="">Pilih..</option>
                    <?php foreach ($lokasi as $row): ?>
                      <option value="<?=$row['id_lokasi'];?>"><?=$row['nama_lokasi'];?></option>
                    <?php endforeach ?>      
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="umur_ekonomis" class="col-sm-2 col-form-label">Umur Ekonomis</label>
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="number" name="umur_ekonomis" placeholder="1/2/3/.." class="form-control">
                    <div class="input-group-append">
                      <span class="input-group-text">Tahun</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Nilai Aset</label>
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" name="harga" class="form-control" placeholder="0000" required>
                </div>
                </div>
              </div> 
              <!-- <div class="form-group row">
                <label for="tanggal_terima" class="col-sm-2 col-form-label">Generate QR Code?</label>
                <div class="col-sm-6">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="generate" id="generate">
                    <label class="form-check-label" for="generate">
                      Ya
                    </label>
                  </div>
                </div>
              </div>            -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <a href="<?=base_url('aset_wujud')?>">
                <button type="button" class="btn btn-danger">Kembali</button>
              </a>
              <button type="submit" class="btn btn-info">Simpan</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <script src="<?=base_url()?>src/backend/plugins/select2/js/select2.full.min.js"></script>
  <script>
    function myFunction() {
      var copyText = document.getElementById("myInput");
      copyText.select();
      copyText.setSelectionRange(0, 99999)
      document.execCommand("copy");
      alert("Teks berhasil disalin: " + copyText.value);
    }

    $("#form-input").css("display","none");
       
    $(".ket").click(function(){ 
      if ($("input[name='ket']:checked").val() == "Dipinjam" ) { 
        $("#form-input").slideDown("fast"); 
      } else {
        $("#form-input").slideUp("fast"); 
      }
    });

    $(document).ready(function() {
      $('.selectx').select2({
        placeholder: "Pilih..",
        allowClear: true,
        theme: 'bootstrap4'
      });
    });
  </script>
