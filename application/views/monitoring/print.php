<?php 
  $app = $this->db->get_where('setup', array('id' => 1))->row_array();
?>
<div class="row">
	<div class="col text-center">
		<strong>Laporan Monitoring Aset</strong>
	</div>
</div>
<div class="row pt-3">
	<div class="col">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>KOMPONEN</th>
                    <th>KERUSAKAN</th>
                    <th>FAKTOR YANG MEMPENGARUHI</th>
                    <th>MONITORING</th>
                    <th>PEMELIHARAAN YANG HARUS DILAKUKAN</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach ($mnt as $mt): ?>               
                <tr>
                    <td rowspan="5">
                        <p><?=$no++.'. ';?> <?=$mt['nama_barang']?></p>
                        <img src="<?=base_url()?>src/img/aset/<?=$mt['foto']?>" alt="" style="width:100px;height:100px;">
                    </td>
                    <td><?=$mt['kerusakan']?></td>
                    <td rowspan="4"><?=$mt['faktor']?></td>
                    <td rowspan="4"><?=$mt['monitoring']?></td>
                    <td rowspan="4"><?=$mt['pemeliharaan']?></td>
                </tr>
                <tr>                 
                    <td><b>AKIBAT YANG TERJADI</b></td>           
                </tr>
                <tr>                 
                    <td><?=$mt['akibat']?></td>           
                </tr>
                <tr>                 
                    <td><b>JUMLAH KERUSAKAN</b></td>           
                </tr>
                <tr>                 
                    <td><?=$mt['jml_rusak']?> <?=$mt['satuan']?></td>           
                    <th>LOKASI ASET</th>
                    <td colspan="2"><?=$mt['nama_lokasi']?></td>           
                </tr>
                <?php endforeach ?>
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
  