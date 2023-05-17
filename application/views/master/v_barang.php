<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Barang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item active">Barang</li>
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
          <a href="<?=base_url('barang/tambah')?>" class="btn btn-block bg-gradient-primary">
            Tambah Barang
          </a>
        </h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Merek</th>
                    <th>Tahun Perolehan</th>
                    <th>Foto Barang</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach ($barang as $row): ?>
                  <tr>
                    <td><?=$no++;?></td>
                    <td><?=$row['nama_kategori'];?></td>
                    <td><?=$row['nama_barang'];?></td>
                    <td><?=$row['merek'];?></td>
                    <td><?=$row['tahun_perolehan'];?></td>
                    <td>
                      <?php if($row['picture']){?>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-ubah<?=$row['id_barang'];?>">
                          <img src="<?=base_url();?>src/img/barang/<?=$row['picture'];?>" style="height: 50px;" class="img-rounded">
                        </a>
                      <?php } ?>  
                    </td>
                    <td>
                       <a href="<?=base_url('barang/edit/'.$row['id_barang'])?>" class="btn btn-info btn-sm">
                          <i class="fas fa-edit"></i>
                        </a>
                        <a href="<?=base_url('barang/hapus/'.$row['id_barang'])?>" class="btn btn-danger btn-sm tombol-hapus">
                          <i class="fas fa-trash"></i>
                        </a>
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
<?php 
  $no=1;
  foreach ($barang as $row): 
    $barang_id = $row['id_barang'];
    $barang_pc = $row['picture'];
?>
<div class="modal fade" id="modal-ubah<?=$barang_id;?>">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <img src="<?=base_url();?>src/img/barang/<?=$barang_pc;?>" class="img-rounded" style="width: 350px;">
        </div>              
      </div>
        <div class="modal-footer content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </form>
  </div>
  <!-- /.modal-dialog -->
</div>
<?php endforeach ?>
<script src="<?=base_url()?>src/backend/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>src/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "language": {
        "zeroRecords": "Data masih kosong",
        "sSearch": "Cari"
      }
    });
  });
</script>