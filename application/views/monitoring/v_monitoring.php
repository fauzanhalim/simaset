<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Monitoring</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
            <li class="breadcrumb-item active">Monitoring</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="flash-data" data-flashdata="<?=$this->session->flashdata('sukses');?>"></div>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <a href="<?=base_url('monitoring/tambah')?>" class="btn btn-block bg-gradient-primary">
                Tambah Data
              </a>
            </h3>

            <div class="card-tools">
              <?php if (!empty($id_lokasi)): ?>
                <a href="<?=base_url('print-monitoring/'.$id_lokasi.'/'.$tahun_perolehan);?>" target="_blank" class="btn btn-danger">
                  <i class="fa fa-print" aria-hidden="true"></i> Print
                </a>
                <a href="<?=base_url('export-monitoring/'.$id_lokasi.'/'.$tahun_perolehan);?>" class="btn btn-success">
                  <i class="fa fa-file-excel" aria-hidden="true"></i> Export Excel
                </a>
              <?php else: ?>  
                <a href="<?=base_url('print-all-monitoring')?>" target="_blank" class="btn btn-danger">
                  <i class="fa fa-print" aria-hidden="true"></i> Print
                </a>
                <a href="<?=base_url('export-all-monitoring')?>" class="btn btn-success">
                  <i class="fa fa-file-excel" aria-hidden="true"></i> Export Excel
                </a>
              <?php endif; ?>  
            </div>
          </div>
          <div class="card-body"> 
            <form action="" method="post">
              <div class="row">
                  <div class="col-4">
                      <select name="id_lokasi" class="form-control" required>
                        <option value="">Lokasi Aset..</option>
                        <option value="all">-- Semua Data --</option>
                        <?php foreach ($lokasi as $row): ?>
                          <option value="<?=$row['id_lokasi'];?>"><?=$row['nama_lokasi'];?></option>
                        <?php endforeach ?>                              
                      </select>
                  </div>
                  <div class="col-4">
                    <select name="tahun_perolehan" class="form-control" required>
                      <option value="">Tahun Perolehan..</option>
                      <option value="all">-- Semua Data --</option>
                      <?php 
                      for($i = 2015; $i <= date('Y'); $i++){
                        echo "<option value='$i'>$i</option>";
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col">
                    <button type="submit" name="filter" class="btn btn-block btn-outline-primary">Filter</button>
                  </div>
                  <div class="col">
                    <button type="reset" class="btn btn-block btn-outline-danger">Reset</button>
                  </div>              
              </div>
            </form>  
            <br/>
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Lokasi</th>
                    <th>Perolehan</th>
                    <th>Kondisi</th>
                    <th>Jenis Aset</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($mt as $row): ?>               
                  <tr>
                    <td><?=$no++;?></td>
                    <td><?=$row['kode_aset'];?></td>
                    <td><?=$row['nama_barang'];?></td>
                    <td><?=$row['nama_lokasi'];?></td>
                    <td><?=$row['tahun_perolehan'];?></td>
                    <td><?=$row['kondisi'];?></td>
                    <td><?=$row['jenis_aset'];?></td>
                    <td>
                      <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-cog"></i>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                          <a class="dropdown-item" href="<?=base_url('monitoring/detail/'.$row['id_monitoring'])?>">Detail</a>
                          <a class="dropdown-item" href="<?=base_url('monitoring/edit/'.$row['id_monitoring'])?>">Edit</a>
                          <a class="dropdown-item tombol-hapus" href="<?=base_url('monitoring/hapus/'.$row['id_monitoring'])?>">Hapus</a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>           
          </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <script src="<?=base_url()?>src/backend/plugins/datatables/jquery.dataTables.js"></script>
  <script src="<?=base_url()?>src/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script>
    $(function () {
      $("#example1").DataTable({
        "language": {
          "sSearch": "Cari"
        }
      });
    });
  </script>
