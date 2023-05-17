<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?=$title;?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('loan')?>"><?=$title;?></a></li>
              <li class="breadcrumb-item active">Detail</li>
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
          <h3 class="card-title">
            <a href="<?=base_url('loan')?>" class="btn btn-danger btn-sm">
              <i class="fas fa-undo"></i>Kembali
            </a>
          </h3>

          <div class="card-tools">
            <a href="<?=base_url('print-loan/'.$item['id_loan'])?>" target="_blank" class="btn btn-secondary btn-sm">
              <i class="fa fa-print" aria-hidden="true"></i> Print
            </a>
            <a href="<?=base_url('export-loan/'.$item['id_loan'])?>" class="btn btn-success btn-sm">
              <i class="fa fa-file-excel" aria-hidden="true"></i> Export Excel
            </a>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-borderless table-sm">
            <tbody>
                <tr>                    
                    <td width="180px">Nama Peminjam</td>
                    <td width="25px">:</td>
                    <td><?=$item['name_loan'];?></td>
                </tr>
                <tr>                    
                    <td width="180px">Tanggal Peminjaman</td>
                    <td width="25px">:</td>
                    <td><?=$item['loan_date'];?></td>
                </tr>
                <tr>                    
                    <td width="180px">Tanggal Pengembalian</td>
                    <td width="25px">:</td>
                    <td><?=$item['return_date'];?></td>
                </tr>   
            </tbody>
          </table>
          <table class="table table-striped table-bordered table-sm mt-3">
            <thead>
              <tr>
                <th style="vertical-align: middle;" class="text-center">NO.</th>
                <th style="vertical-align: middle;" class="text-center">KODE ASET</th>
                <th style="vertical-align: middle;" class="text-center">NAMA ASET</th>
                <th style="vertical-align: middle;" class="text-center">JUMLAH</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $no=1; 
                $total=0; 
                  foreach ($bk as $row) { 
                $total += $row['amount'];  
              ?>
                <tr>
                  <td class="text-center"><?=$no++;?></td>
                  <td><?=$row['kode_aset'];?></td>
                  <td><?=$row['nama_barang'];?></td>
                  <td class="text-center"><?=$row['amount'];?></td>
                </tr>
              <?php } ?>
              <tr>
                <td class="font-weight-bold" colspan="3">JUMLAH</td>
                <td class="text-center"><?=$total;?></td>
              </tr>
            </tbody>          
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
