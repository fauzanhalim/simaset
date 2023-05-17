<style>
  .mytable{
    font-size: 13px;
  }
</style>
<div class="row">
	<div class="col text-center">
		<strong>LAPORAN PEMINJAMAN BARANG</strong>
	</div>
</div>
<div class="row pt-3">
	<div class="col">
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
    <table class="table table-bordered table-sm mt-3">
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
</div>
<div class="row pt-4">
	<div class="col-md-8">
		
	</div>
	<div class="col-md-4 text-center">
		<p>Banten, <?=tgl_indo(date('Y-m-d'))?></p>
		<p class="ex1">Yang Menerima</p>
		__________________
	</div>
</div> 
			
  