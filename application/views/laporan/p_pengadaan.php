<?php 
  $app = $this->db->get_where('setup', array('id' => 1))->row_array();
?>
<div class="row">
	<div class="col text-center">
		<strong>LAPORAN PENGADAAN ASET</strong>
	</div>
</div>
<div class="row pt-3">
	<div class="col">
		<table class="table table-bordered table-sm">
			<thead>
				<th>NO.</th>
				<th>PENEMPATAN</th>
				<th>NAMA ASET</th>
				<th>TANGGAL</th>
				<th style="text-align: center;">JUMLAH</th>
				<th style="text-align: center;">HARGA (Rp.)</th>
				<th style="text-align: center;">TOTAL (Rp.)</th>
			</thead>
			<tbody>
				<?php 
				$sum=0; 
				$no=1; 
					foreach ($aset as $row): 
				$sum+=$row['volume']*$row['harga_satuan'];			
				?>		
				<tr>
					<td><?=$no++;?></td>
					<td><?=$row['nama_lokasi']?></td>
					<td><?=$row['nama_aset']?></td>
					<td><?=date('d-m-Y', strtotime($row['created_at']));?></td>
					<td style="text-align: center;"><?=$row['volume']?></td>
					<td style="text-align: right;"><?=laporan($row['harga_satuan'])?></td>
					<td style="text-align: right;"><?=laporan($row['volume']*$row['harga_satuan'])?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="6"><b>Jumlah</b></td>
					<td style="text-align: right;"><?=laporan($sum);?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<div class="row pt-4">
	<div class="col-md-8">
		
	</div>
	<div class="col-md-4 text-center">
		<p><?=$app['city'];?>, <?=tgl_indo(date('Y-m-d'))?></p>
		<p class="ex1">Ketua Yayasan </p>
		____________</br>
	</div>
</div> 							
