<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1><?=$title?></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
            <li class="breadcrumb-item active"><?=$title?></li>
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
          <a href="<?=base_url('loan/add')?>" class="btn btn-block bg-gradient-primary">
            Tambah Data
          </a>
        </h3>

        <div class="card-tools">
          
        </div>
      </div>
          <div class="card-body">
              <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success col-12"> 
                  <?= $this->session->flashdata('success') ?>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button> 
                </div>
              <?php unset($_SESSION['success']); } ?>
            <form action="" method="POST">
              <div class="row">
                  <div class="col-4">
                    <input type="date" name="date1" class="form-control" required>
                  </div>
                  <div class="col-4">
                    <input type="date" name="date2" class="form-control" required>
                  </div>
                  <div class="col">
                    <button type="submit" name="filter" class="btn btn-block btn-outline-primary">Filter</button>
                  </div>
                  <div class="col">
                    <button type="reset" class="btn btn-block btn-outline-danger">Reset</button>
                  </div>              
              </div>
            </form>
            <br>  
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Nama</th>
                  <th>Peminjaman</th>
                  <th>Pengembalian</th>
                  <th>Jatuh Tempo</th>
                  <th>Tanggal Input</th>
                  <th>Status</th>
                  <th>Laporan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($item as $row): ?>               
                <tr>
                  <td><?=$no++;?></td>
                  <td><?=$row['name_loan'];?></td>
                  <td><?=date('d-m-Y',strtotime($row['loan_date']));?></td>
                  <td><?=date('d-m-Y',strtotime($row['return_date']));?></td>
                  <td>
                    <?php 
                      $diff = beda_waktu($row['loan_date'], $row['return_date']);
                      echo $diff['d'] . ' Hari ';
                    ?>
                  </td>
                  <td><?=date('d-m-Y H:i:s', strtotime($row['created_at']));?></td>
                  <td><?=$row['status'];?></td>
                  <td>
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-file-alt"></i> &nbsp; Pilih
                      </button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="<?=base_url('print-loan/'.$row['id_loan'])?>" target="_blank">Print</a>
                        <a class="dropdown-item" href="<?=base_url('export-loan/'.$row['id_loan'])?>">Export Excel</a>
                      </div>
                    </div>
                  </td>
                  <td>
                    <a href="<?=base_url('loan/show/'.$row['id_loan'])?>" data-toggle="tooltip" data-placement="bottom" title="Detail" class="btn btn-success btn-sm">
                      <i class="fas fa-eye"></i>
                    </a>
                    <a href="<?=base_url('loan/edit/'.$row['id_loan'])?>" data-toggle="tooltip" data-placement="bottom" title="Ubah" class="btn btn-info btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="<?=base_url('loan/destroy/'.$row['id_loan'])?>" data-toggle="tooltip" data-placement="bottom" title="Hapus" class="btn btn-danger btn-sm tombol-hapus">
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