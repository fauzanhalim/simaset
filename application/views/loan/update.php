<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Content Wrapper. Contains page content -->
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
              <li class="breadcrumb-item"><a href="<?=base_url('loan')?>"><?=$title?></a></li>
              <li class="breadcrumb-item active">Ubah Data</li>
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
          <h3 class="card-title">Form Ubah Data</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
            <div class="card-body">
            <?php if ($this->session->flashdata('success')) { ?>
              <div class="alert alert-success col-8"> 
                <?= $this->session->flashdata('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button> 
              </div>
            <?php unset($_SESSION['success']); } ?>
            <form action="<?=base_url('loan-update')?>" method="post">
              <input type="hidden" name="id_loan" value="<?=$item['id_loan'];?>">
              <div class="form-group row">
                <label for="name_loan" class="col-sm-2 col-form-label">Nama Peminjam</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" value="<?=$item['name_loan'];?>" name="name_loan" id="name_loan" placeholder="TPM/  /  /20XX" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="loan_date" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control" name="loan_date" value="<?=$item['loan_date'];?>" id="loan_date" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="return_date" class="col-sm-2 col-form-label">Tanggal Pengembalian</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control" name="return_date" value="<?=$item['return_date'];?>" id="return_date" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="return_date" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-6">
                  <select name="status" class="form-control" required>
                    <option value="">Pilih</option>
                    <option value="Dipinjam" <?=($item['status'] == 'Dipinjam')?'selected':'';?>>Dipinjam</option>
                    <option value="Dikembalikan" <?=($item['status'] == 'Dikembalikan')?'selected':'';?>>Dikembalikan</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="for_report" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-6">
                  <button type="submit" class="btn btn-info">Ubah</button>
                </div>
              </div>
            </form>              
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

      <div class="row">
        <div class="col-md-4">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Cari Barang</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="form-group">
                  <label for="code_id" class="col-form-label">Kode Barang</label>
                  <select name="code_id" id="code_id" class="form-control selectx" required>
                    <option value="">Pilih..</option>
                    <?php foreach ($aset as $key) { ?>
                      <option value="<?=$key['id_aset']?>"><?=$key['kode_aset'].' '.$key['nama_barang'];?></option>
                    <?php } ?>    
                  </select>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

        <div class="col-md-8">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Hasil Pencarian</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <form action="<?=base_url('bl-store')?>" method="post">
              <input type="hidden" name="id_aset" id="id_aset">
              <input type="hidden" name="id_loan" value="<?=$item['id_loan'];?>">
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="name">Kode Aset</label>
                    <input type="text" class="form-control" name="kode_aset" id="kode_aset" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="item">Nama Aset</label>
                    <input type="text" class="form-control" name="nama_barang" id="nama_barang" readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label for="volume">Stok</label>
                    <input type="text" class="form-control" name="volume" id="volume" readonly>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="harga">Harga</label>
                    <input type="text" class="form-control" name="harga" id="harga" readonly>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="amount">Jumlah Peminjaman</label>
                    <input type="text" class="form-control" name="amount" id="amount" autocomplete="off">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-4">
                    <label for="merek"></label>
                    <button type="submit" class="btn btn-success">
                      <i class="fa fa-cart-plus" aria-hidden="true"></i>
                      Tambah
                    </button>
                  </div>
                </div>
            </div>
          </form>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Barang</h3>

          <div class="card-tools">
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered table-sm mt-3">
            <thead>
              <tr>
                <th style="vertical-align: middle;" class="text-center">NO.</th>
                <th style="vertical-align: middle;" class="text-center">KODE ASET</th>
                <th style="vertical-align: middle;" class="text-center">NAMA ASET</th>
                <th style="vertical-align: middle;" class="text-center">JUMLAH</th>
                <th style="vertical-align: middle;" class="text-center">AKSI</th>
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
                  <td>
                      <a href="javascript:void(0);" data-toggle="modal" data-target="#modal-ubah<?=$row['id_bp'];?>" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i>
                      </a>
                      <a href="<?=base_url('bl-destroy/'.$row['id_bp'].'/'.$item['id_loan'])?>" class="btn btn-danger btn-sm tombol-hapus">
                          <i class="fas fa-trash"></i>
                        </a>
                  </td>
                </tr>
              <?php } ?>
              <tr>
                <td class="font-weight-bold" colspan="3">JUMLAH</td>
                <td class="text-center"><?=$total;?></td>
                <td colspan="3"></td>
              </tr>
            </tbody>          
          </table> 
          <br>
          <a href="<?=base_url('loan')?>" class="btn btn-danger">
            <i class="fas fa-undo"></i>&nbsp;Kembali
          </a>       
        </div>
        <!-- /.card-body -->
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php  
    foreach ($bk as $row) {
    $bp_id = $row['id_bp'];     
    $item_code = $row['kode_aset'];     
    $item_name = $row['nama_barang'];     
    $item_amount = $row['amount'];     
?>
  <div class="modal fade" id="modal-ubah<?=$bp_id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Data</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=base_url('bl-update')?>" method="post">
        <input type="hidden" name="id_bp" value="<?=$bp_id;?>">
        <input type="hidden" name="id_loan" value="<?=$item['id_loan'];?>">
        <div class="modal-body">
          <div class="form-group row">
              <label class="col-md-4 col-form-label">Kode Aset</label>
              <div class="col-md-8">
                <input type="text" name="kode_aset" value="<?=$item_code;?>" id="kode_aset" class="form-control" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-4 col-form-label">Nama Barang</label>
              <div class="col-md-8">
                <input type="text" name="item" value="<?=$item_name;?>" id="item" class="form-control" readonly>
              </div>
          </div>
          <div class="form-group row">
              <label class="col-md-4 col-form-label">Jumlah</label>
              <div class="col-md-8">
                <input type="text" name="amount" value="<?=$item_amount;?>" id="amount" class="form-control">
              </div>
          </div>               
        </div>
        <div class="modal-footer content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Ubah</button>
        </div>
        </form>
      </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>
<script src="<?=base_url()?>src/backend/plugins/select2/js/select2.full.min.js"></script>
<script>
  const formatRupiah = (money) => {
		return new Intl.NumberFormat('id-ID',
			{ style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }
		).format(money);
	}

  $(document).ready(function() {
    $('.selectx').select2({
      placeholder: "Pilih..",
      allowClear: true,
      theme: 'bootstrap4'
    });

    $('#code_id').change(function(){ 
        var id = $(this).val();
        $.ajax({
            url : "<?php echo site_url('aset/get_list_item');?>",
            method : "POST",
            data : {id: id},
            async : true,
            dataType : 'json',
            success: function(data){ 
                var i;
                var id = '';
                var kode = '';
                var name = '';
                var noreg = '';
                var vol = '';
                var price = '';

                for(i=0; i<data.length; i++){
                    id = data[i].id_aset;
                    kode = data[i].kode_aset;
                    name = data[i].nama_barang;
                    noreg = data[i].no_reg;
                    vol = data[i].volume;
                    price = data[i].harga;
                }
                document.getElementById("id_aset").value = id;
                document.getElementById("kode_aset").value = kode;
                document.getElementById("nama_barang").value = name;
                document.getElementById("no_reg").value = noreg;
                document.getElementById("volume").value = vol;
                document.getElementById("harga").value = price;
            }
        });
        return false;
    });
  });   
 
</script>