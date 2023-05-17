<?php 
  $app = $this->db->get_where('setup', array('id' => 1))->row_array();
?>
<div class="row">
	<div class="col text-center">
		<h5>BERITA ACARA PENGHAPUSAN ASET</h5>
	</div>
</div>
<div class="row">
	<div class="col text-left">
		<p>Pada hari ini tanggal <?=tgl_indo(date('Y-m-d'));?> bertempat di <?=$app['name_institute'];?> telah melaksanakan penghapusan aset berupa :</p>
	</div>
</div>
<div class="row pt-3">
	<div class="col">
		<table class="table table-bordered table-sm">
			<thead>
				<th>NO.</th>
				<th>NAMA</th>
				<th>LOKASI</th>
				<th style="text-align: center;">JUMLAH</th>
				<th style="text-align: center;">HARGA (Rp.)</th>
				<th style="text-align: center;">JUMLAH (Rp.)</th>
			</thead>
			<tbody>
				<?php 
				$sum=0; 
				$no=1; 
					foreach ($aset as $row): 
				$sum+=$row['jumlah']*$row['harga'];			
				?>		
				<tr>
					<td><?=$no++;?></td>
					<td><?=$row['nama_barang']?></td>
					<td><?=$row['nama_lokasi']?></td>
					<td style="text-align: center;"><?=$row['jumlah']?></td>
					<td style="text-align: right;"><?=laporan($row['harga'])?></td>
					<td style="text-align: right;"><?=laporan($row['jumlah']*$row['harga'])?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5"><b>Jumlah</b></td>
					<td style="text-align: right;"><?=laporan($sum);?></td>
				</tr>
			</tfoot>
		</table>
	</div>
</div>
<div class="row">
	<div class="col text-left">
	<p>Aset tersebut telah diperiksa dan terdapat rusak/cacat produksi dan tidak memungkinkan untuk digunakan kembali</p>
	</div>
</div>
<div class="row">
	<div class="col text-left">
	<p>Demikian Berita Acara ini kami buat berdasarkan keadaan yang sebenarnya. Atas perhatian dan kerjasamanya kami mengucapkan terima kasih.</p>
	</div>
</div>
<div class="row pt-4">
	<div class="col-md-8">
		
	</div>
	<div class="col-md-4 text-center">
		<p><?=$app['city'];?>, <?=tgl_indo(date('Y-m-d'))?></p>
		<p class="ex1">Kepala Bagian</p>
		________________</br>
	</div>
</div> 								
  