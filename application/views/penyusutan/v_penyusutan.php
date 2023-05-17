<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Penyusutan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
            <li class="breadcrumb-item active">Penyusutan</li>
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
          Data Penyusutan Aset
        </h3>

        <div class="card-tools">
          <?php if (!empty($id_lokasi)): ?>
            <a href="<?=base_url('print-penyusutan/'.$id_lokasi.'/'.$tahun_perolehan)?>" target="_blank" class="btn btn-danger btn-sm">
              <i class="fa fa-print" aria-hidden="true"></i> Print
            </a>
            <a href="<?=base_url('export-penyusutan/'.$id_lokasi.'/'.$tahun_perolehan)?>" class="btn btn-success btn-sm">
              <i class="fa fa-file-excel" aria-hidden="true"></i> Export Excel
            </a>
          <?php else: ?>  
            <a href="<?=base_url('print-all-penyusutan')?>" target="_blank" class="btn btn-danger btn-sm">
              <i class="fa fa-print" aria-hidden="true"></i> Print
            </a>
            <a href="<?=base_url('export-all-penyusutan')?>" class="btn btn-success btn-sm">
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
                    <th>Nama Aset</th>
                    <th>Lokasi</th>
                    <th>Perolehan</th>
                    <th>Masa Manfaat</th>
                    <th>Pemakaian</th>
                    <th>Penyusutan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $no=1; foreach ($pys as $row): ?>               
                  <tr>
                    <td><?=$no++;?></td>
                    <td><?=$row['nama_barang'];?></td>
                    <td><?=$row['nama_lokasi'];?></td>
                    <td><?=$row['tahun_perolehan'];?></td>
                    <td><?=$row['umur_ekonomis'];?> Tahun</td>
                    <td>
                        <?php
                            $usia = date('Y')- ($row['tahun_perolehan']-1);
                            
                            if ($usia > $row['umur_ekonomis']) {
                              echo "<font color='red'>",$usia," Tahun</font>";
                            } else {
                              echo $usia," Tahun";
                            }                         
                          ?>
                    </td>
                    <td>
                      <?php
                      
                        //Rumus
                        $tahun_skrg_x = date("Y");
                        $rentang_x = ($tahun_skrg_x-$row['tahun_perolehan'])+1;
                        if($rentang_x > $row['umur_ekonomis']){
                          $rentang_x = $row['umur_ekonomis'];
                        }

                        //Rumus
                        $tarif_penyusutan= (100/100)/$row['umur_ekonomis'];
                        $nilai_sisa = $tarif_penyusutan*$row['harga'];
                        $penyusutan = ($row['harga']-$nilai_sisa)/$row['umur_ekonomis'];
                        $akumulasi_penyusutan = $penyusutan* $rentang_x; 
                        $nilai_aset = $row['harga']-$akumulasi_penyusutan;

                        echo rupiah($akumulasi_penyusutan);
                      
                      ?>                    
                    </td>
                    <td>
                      <a href="<?=base_url('penyusutan/detail/'.$row['id_aset'])?>" class="btn btn-success btn-sm">
                        <i class="fas fa-eye"></i>
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
<script>
  $('.tombol-penghapusan').on('click',function(e){

    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
      title: 'Apakah anda yakin?',
      text: "Aset akan dihapuskan",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus Aset!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.value) {
        document.location.href = href;
      }
    })
  });
</script>