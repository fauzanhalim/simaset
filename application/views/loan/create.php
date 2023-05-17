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
              <li class="breadcrumb-item active">Tambah Data</li>
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
          <h3 class="card-title">Form Tambah Data</h3>

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
              <div class="form-group row">
                <label for="name_loan" class="col-sm-2 col-form-label">Nama Peminjam</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="name_loan" id="name_loan" placeholder="Masukan Nama.." autofocus required>
                </div>
              </div>
              <div class="form-group row">
                <label for="loan_date" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control" name="loan_date" id="loan_date" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="return_date" class="col-sm-2 col-form-label">Tanggal Pengembalian</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control" name="return_date" id="return_date" required>
                </div>
              </div>           
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
                  <label for="code_id" class="col-form-label">Kode Aset</label>
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
              <input type="hidden" name="id_aset" id="id_aset">
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
                    <button type="button" class="btn btn-success" id="btn_cart">
                      <i class="fa fa-cart-plus" aria-hidden="true"></i>
                      Tambah
                    </button>
                  </div>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Barang</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-danger btn-sm" id="btn_reset">
              <i class="fas fa-sync"></i> Reset Data
            </button>
          </div>
        </div>
        <div class="card-body">
          <table class="table table-striped table-bordered table-sm">
            <thead>
              <tr>
                <th style="vertical-align: middle;">KODE ASET</th>
                <th style="vertical-align: middle;">NAMA ASET</th>
                <th style="vertical-align: middle;" class="text-center">JUMLAH</th>
                <th style="vertical-align: middle;">AKSI</th>
              </tr>
            </thead>
            <tbody id="show_data"></tbody>          
          </table>        
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- MODAL EDIT -->
  <form>
    <div class="modal fade" id="Modal_Edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <input type="hidden" name="id_edit" id="id_edit">
          <div class="modal-body">
			  <div class="form-group row">
                  <label class="col-md-4 col-form-label">Kode Barang</label>
                  <div class="col-md-8">
                    <input type="text" name="kode_edit" id="kode_edit" class="form-control" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-md-4 col-form-label">Nama Barang</label>
                  <div class="col-md-8">
                    <input type="text" name="name_edit" id="name_edit" class="form-control" readonly>
                  </div>
              </div>
              <div class="form-group row">
                  <label class="col-md-4 col-form-label">Jumlah</label>
                  <div class="col-md-8">
                    <input type="text" name="amount_edit" id="amount_edit" class="form-control">
                  </div>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" id="btn_update" class="btn btn-primary">Ubah</button>
          </div>
        </div>
      </div>
    </div>
  </form>
<!--END MODAL EDIT-->
<!--MODAL DELETE-->
  <form>
    <div class="modal fade" id="Modal_Delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <strong>Apakah kamu yakin ingin menghapus data?</strong>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="id_delete" id="id_delete" class="form-control">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" id="btn_delete" class="btn btn-danger">Hapus</button>
          </div>
        </div>
      </div>
    </div>
  </form>
<!--END MODAL DELETE-->
<!--MODAL RESET-->
  <form>
    <div class="modal fade" id="Modal_Reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reset Data</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                <strong>Apakah kamu yakin ingin mereset data barang?</strong>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            <button type="button" id="btn_action_reset" class="btn btn-danger">Reset</button>
          </div>
        </div>
      </div>
    </div>
  </form>
<!--END MODAL RESET-->
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
                var vol = '';
                var price = '';

                for(i=0; i<data.length; i++){
                    id = data[i].id_aset;
                    kode = data[i].kode_aset;
                    name = data[i].nama_barang;
                    vol = data[i].volume;
                    price = data[i].harga;
                }
                document.getElementById("id_aset").value = id;
                document.getElementById("kode_aset").value = kode;
                document.getElementById("nama_barang").value = name;
                document.getElementById("volume").value = vol;
                document.getElementById("harga").value = price;
            }
        });
        return false;
    });

    show_item();

    function show_item(){
      $.ajax({
        type  : 'GET',
        url   : '<?php echo site_url('cart')?>',
        async : true,
        dataType : 'json',
        success : function(data){

          var name_loan = document.getElementById('name_loan').value;
          var loan_date = document.getElementById('loan_date').value;
          var return_date = document.getElementById('return_date').value;

          var html = '';
          var i;

          var total = 0;

          for(i=0; i < data.length; i++){
            total += parseInt(data[i].amount);
            html += '<tr>'+
                      '<td>'+data[i].kode_aset+'</td>'+
                      '<td>'+data[i].nama_barang+'</td>'+
                      '<td class="text-center">'+data[i].amount+'</td>'+
                      '<td>'+
                        '<a href="javascript:void(0);" class="btn btn-primary btn-sm item_edit" data-id="'+data[i].id_cart+'" data-kode="'+data[i].kode_aset+'" data-name="'+data[i].nama_barang+'"  data-amount="'+data[i].amount+'"><i class="fas fa-edit"></i></span></a>'+' '+
                        '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-id="'+data[i].id_cart+'"><i class="fas fa-trash"></i></a>'+
                      '</td>'+
                    '</tr>';
          }
          html += '<tr>'+
                    '<td colspan="2"><b>JUMLAH</b></td>'+
                    '<td class="text-center">'+parseInt(total)+'</td>'+
                    '<td></td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td colspan="3"></td>'+
                    '<td>'+	
                      '<form action="<?=base_url('loan-store')?>" method="POST">';
                    for(i=0; i < data.length; i++){
                      html += '<input type="hidden" name="aset_id[]" value="'+data[i].aset_id+'">'+
                          '<input type="hidden" name="amount[]" value="'+data[i].amount+'">';
                    }					
                    html +=	'<input type="hidden" name="name_loan" value="'+name_loan+'">'+
                          '<input type="hidden" name="loan_date" value="'+loan_date+'">'+
                          '<input type="hidden" name="return_date" value="'+return_date+'">';
                    if(data.length > 0){
                      html +=		'<button type="submit" class="btn btn-sm btn-primary">Simpan Data</button>';
                    }
                    html +=	'</form>'+
                      '</td>'+
                '</tr>';
          $('#show_data').html(html);
        }
      });
    }
    
    $('#btn_cart').on('click',function(){
      var aset_id = $('#id_aset').val();
      var name_loan = $('#name_loan').val();
      var loan_date = $('#loan_date').val();
      var return_date = $('#return_date').val();
      var amount = $('#amount').val();
      var stok = $('#volume').val();

      if (
          name_loan != 0 && 
          loan_date != 0 && 
          return_date != 0 &&
          amount != 0 
        ) {
          if (amount > stok) {
            alert('Jumlah peminjaman melebihi stok barang !');
          } else {
            $.ajax({
              type : "POST",
              url  : "<?php echo site_url('cart-store')?>",
              dataType : "JSON",
              data : {
                aset_id:aset_id, 
                amount:amount, 
              },
              success: function(data){
                show_item();
              }
            });	
          }
      } else {
        alert('Anda harus mengisi data dengan lengkap !');
      }
      return false;
    });

    $('#show_data').on('click','.item_edit',function(){
        var id = $(this).data('id');
        var kode = $(this).data('kode');
        var name = $(this).data('name');
        var amount = $(this).data('amount');
          
        $('#Modal_Edit').modal('show');
        $('[name="id_edit"]').val(id);
        $('[name="kode_edit"]').val(kode);
        $('[name="name_edit"]').val(name);
        $('[name="amount_edit"]').val(amount);
    });

    $('#btn_update').on('click',function(){
      var id = $('#id_edit').val();
      var amount = $('#amount_edit').val();

      $.ajax({
          type : "POST",
          url  : "<?php echo site_url('cart-update')?>",
          dataType : "JSON",
          data : {
            id:id, 
            amount:amount
          },
          success: function(data){
              $('[name="id_edit"]').val("");
              $('[name="kode_edit"]').val("");
              $('[name="name_edit"]').val("");
              $('[name="amount_edit"]').val("");
              $('#Modal_Edit').modal('hide');
              show_item();
          }
      });
      return false;
    });

    $('#show_data').on('click','.item_delete',function(){
        var id = $(this).data('id');
          
        $('#Modal_Delete').modal('show');
        $('[name="id_delete"]').val(id);
    });

    $('#btn_delete').on('click',function(){
      var id = $('#id_delete').val();
      $.ajax({
          type : "POST",
          url  : "<?php echo site_url('cart-delete')?>",
          dataType : "JSON",
          data : {id:id},
          success: function(data){
              $('[name="id_delete"]').val("");
              $('#Modal_Delete').modal('hide');
              show_item();
          }
      });
      return false;
    });

    $('#btn_reset').on('click', function(){
		  $('#Modal_Reset').modal('show');
	  });

    $('#btn_action_reset').on('click', function(){
      $.ajax({
        type : "POST",
        url  : "<?php echo site_url('cart-reset')?>",
        dataType : "JSON",
        success: function(data){
          $('#Modal_Reset').modal('hide');
          show_item();
        }
      });
      return false;
	  });
  });   
 
</script>