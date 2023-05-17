<?php 
  $app = $this->db->get_where('setup', array('id' => 1))->row_array();
?>
<div class="row">
	<div class="col text-center">
		<strong>Laporan Detail Asset Sarana & Prasarana</strong>
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
                <th class="text-center">HARGA (Rp.)</th>
                <th class="text-center">TOTAL HARGA (Rp.)</th>
			</thead>
			<tbody>
            <?php 
                $no=1;
                $sum=0;
                $jml=0;  
                foreach ($aset as $row): 
                $sum += $row['volume']*$row['harga'];
                $jml += $row['volume'];
            ?>                 
                <tr>
                    <td><?=$no++;?></td>
                    <td><?=$row['nama_barang']?></td>
                    <td><?=$row['nama_lokasi']?></td>
                    <td class="text-center"><?=$row['volume']?></td>
                    <td class="text-right"><?=laporan($row['harga'])?></td>
                    <td class="text-right"><?=laporan($row['volume']*$row['harga'])?></td>
                </tr>
                <?php endforeach ?>
                <tr>
                    <td colspan="3"><b>JUMLAH TOTAL</b></td>
                    <td class="text-center"><?=$jml;?></td>
                    <td></td>
                    <td class="text-right"><?=laporan($sum);?></td>
                </tr>
            </tbody>
		</table>
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
  