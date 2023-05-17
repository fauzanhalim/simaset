<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
            <li class="breadcrumb-item active">Berwujud</li>
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
          <a href="<?=base_url('aset_wujud/tambah')?>" class="btn btn-block bg-gradient-primary">
            Tambah Aset
          </a>
        </h3>

        <div class="card-tools">
          <?php if (!empty($id_lokasi)): ?>
            <a href="<?=base_url('print-aset/'.$id_lokasi.'/'.$tahun_perolehan);?>" target="_blank" class="btn btn-danger">
              <i class="fa fa-print" aria-hidden="true"></i> Print
            </a>
            <a href="<?=base_url('export-aset/'.$id_lokasi.'/'.$tahun_perolehan);?>" class="btn btn-success">
              <i class="fa fa-file-excel" aria-hidden="true"></i> Export Excel
            </a>
          <?php else: ?>    
            <a href="<?=base_url('print-all-aset')?>" target="_blank" class="btn btn-danger">
              <i class="fa fa-print" aria-hidden="true"></i> Print
            </a>
            <a href="<?=base_url('export-all-aset')?>" class="btn btn-success">
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
            <form action="<?=base_url('print-selected-qrcode')?>" method="post" target="_blank">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>
                      <input type="checkbox" id="check-all">
                    </th>
                    <th>No.</th>
                    <th>Kode Aset</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Jumlah</th>
                    <th>Perolehan</th>
                    <!-- <th>QR Code</th> -->
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($aset as $row): ?>               
                <tr>
                  <td>
                      <input type='checkbox' class='check-item' name='id_aset[]' value='<?=$row['id_aset']?>'>
                  </td>
                  <td><?=$no++;?></td>
                  <td><?=$row['kode_aset'];?></td>
                  <td><?=$row['nama_barang'];?></td>
                  <td><?=$row['nama_lokasi'];?></td>
                  <td class="text-center"><?=$row['volume'];?></td>
                  <td><?=$row['tahun_perolehan'];?></td>
                  <!-- <td>
                    <?php if($row['qr_code'] != NULL){?>
                      <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-detail<?=$row['id_aset'];?>">
                        <img src="<?=base_url()?>src/img/qrcode/<?=$row['qr_code']; ?>" style="height:45px;">
                      </a>
                    <?php } ?>
                  </td> -->
                  <td>
                    <div class="btn-group" role="group">
                      <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                         <i class="fas fa-cog"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <a class="dropdown-item" href="<?=base_url('aset_wujud/detail/'.$row['id_aset'])?>">Detail</a>
                        <a class="dropdown-item" href="<?=base_url('aset_wujud/edit/'.$row['id_aset'])?>">Edit</a>
                        <a class="dropdown-item tombol-hapus" href="<?=base_url('aset_wujud/hapus/'.$row['id_aset'])?>">Hapus</a>
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
          <!-- <div class="card-footer">
              <button type="submit" class="btn btn-secondary">
                <i class="fa fa-qrcode" aria-hidden="true"></i> Cetak QR Code
              </button> 
          </div>
          </form>
    </div> -->
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<?php foreach ($aset as $row): 
  $aset_id = $row['id_aset'];  
  $aset_kode = $row['kode_aset'];  
  $qr = $row['qr_code'];  
?> 
  <div class="modal fade" id="modal-detail<?=$aset_id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">QR Code</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
          <div class="modal-body text-center">
              <img src="<?=base_url()?>src/img/qrcode/<?=$qr; ?>" style="width:250px;">
              <p><?=$aset_kode;?></p>        
          </div>
          <div class="modal-footer content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
          </div>
        </div>
        <!-- /.modal-content -->
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
        "sSearch": "Cari"
      }
    });
  });

  $(document).ready(function(){ 
    $("#check-all").click(function(){ 
      if($(this).is(":checked")) 
        $(".check-item").prop("checked", true); 
      else 
        $(".check-item").prop("checked", false); 
    });
  });
</script>