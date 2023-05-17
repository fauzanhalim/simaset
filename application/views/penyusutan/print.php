<?php 
  $app = $this->db->get_where('setup', array('id' => 1))->row_array();
?>
<div class="row">
	<div class="col text-center">
		<strong>Laporan Penyusutan Asset Sarana & Prasarana</strong>
	</div>
</div>
<div class="row pt-3">
	<div class="col">
		<table class="table table-bordered table-sm">
			<thead>
				<th style="vertical-align: middle;">NO.</th>
				<th style="vertical-align: middle;">KODE ASET</th>
				<th style="vertical-align: middle;">NAMA</th>
                <th style="vertical-align: middle;">LOKASI</th>
				<th style="text-align: center;">JUMLAH</th>
                <th class="text-center; vertical-align: middle;">HARGA (Rp.)</th>
                <th class="text-center; vertical-align: middle;">PENYUSUTAN (Rp.)</th>
                <th class="text-center; vertical-align: middle;">NILAI AKHIR (Rp.)</th>
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
                    <td><?=$row['kode_aset']?></td>
                    <td><?=$row['nama_barang']?></td>
                    <td><?=$row['nama_lokasi']?></td>
                    <td class="text-center"><?=$row['volume']?></td>
                    <td class="text-right"><?=laporan($row['harga'])?></td>
                    <td class="text-right">
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

                        echo laporan($akumulasi_penyusutan);
                      
                      ?>
                    </td>
                    <td class="text-right"><?=laporan($nilai_aset)?></td>
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
  