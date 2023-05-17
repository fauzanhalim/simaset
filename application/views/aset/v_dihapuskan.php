<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Aset Dihapuskan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Data Aset</a></li>
            <li class="breadcrumb-item active">Dihapuskan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="flash-data" data-flashdata="<?=$this->session->flashdata('sukses');?>"></div>
  <div class="flash-data-gagal" data-flashdatagagal="<?=$this->session->flashdata('gagal');?>"></div>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
        </h3>

        <div class="card-tools">
          <?php if (!empty($id_lokasi)): ?>
            <a href="<?=base_url('print-dihapuskan/'.$id_lokasi.'/'.$tgl_penghapusan)?>" target="_blank" class="btn btn-danger">
              <i class="fa fa-print" aria-hidden="true"></i> Print
            </a>
          <?php else: ?>
            <a href="<?=base_url('print-all-dihapuskan')?>" target="_blank" class="btn btn-danger">
              <i class="fa fa-print" aria-hidden="true"></i> Print
            </a>
          <?php endif; ?>   
        </div>
        </div>
          <div class="card-body">
            <form action="" method="POST">
              <div class="row">
                <div class="col-5">
                  <select name="id_lokasi" class="form-control" required>
                    <option value="">Pilih Lokasi..</option>
                    <option value="all">-- Semua Data --</option>
                    <?php foreach ($lokasi as $row): ?>
                      <option value="<?=$row['id_lokasi'];?>"><?=$row['nama_lokasi'];?></option>
                    <?php endforeach ?>      
                  </select>
                </div>
                <div class="col-5">
                  <select name="tgl_penghapusan" class="form-control" required>
                      <option value="">Tahun Penghapusan..</option>
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
                  <th>Nama</th>
                  <th>Volume</th>
                  <th>Lokasi</th>
                  <th>Nilai Aset</th>
                  <th>Penghapusan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($aset as $row): ?>               
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$row['kode_aset'];?></td>
                  <td><?=$row['nama_barang'];?></td>
                  <td><?=$row['jumlah'];?></td>
                  <td><?=$row['nama_lokasi'];?></td>
                  <td><?=rupiah($row['harga']);?></td>
                  <td><?=date('d-m-Y', strtotime($row['tgl_penghapusan']));?></td>
                  <td>
                    <a href="<?=base_url('aset_dihapuskan/detail/'.$row['id_penghapusan'])?>" class="btn btn-success btn-sm">
                      <i class="fas fa-eye"></i>
                    </a>
                    <?php if ($this->session->userdata('role')=='1'): ?>
                    <a href="<?=base_url('destroy-aset/'.$row['id_penghapusan'])?>" class="btn btn-danger btn-sm tombol-hapus">
                        <i class="fas fa-trash"></i>
                      </a>
                    <?php endif ?>  
                  </td>
                </tr>
                <?php endforeach ?>
                </tbody>
              </table>
             </div>
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