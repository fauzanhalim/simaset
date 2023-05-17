<?php 
  $app = $this->db->get_where('setup', array('id' => 1))->row_array();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?=base_url()?>src/backend/dist/img/favicon.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title><?=$app['name_app'];?> | Detail Data</title>
  </head>
  <body>
    
    <section>
      <nav class="navbar navbar-expand-lg fixed-top navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">
            <img src="<?=base_url()?>src/img/logo/<?=$app['picture'];?>" width="30" height="30" class="d-inline-block align-top" alt="">
             <?=$app['name_app'];?>
          </a>
        </div>
      </nav>
    </section>

    <section class="detail-aset mt-5">
      <div class="container">
        <div class="row pt-4">
          <div class="col">
            <h4 align="center">Detail Data Aset</h4>
            <br/>
            <table class="table table-striped" id="users">
              <tbody>
                <?php foreach($aset as $d){?>                 
                  <tr>                    
                    <td width="100px">Kode Aset</td>
                    <td width="50px">:</td>
                    <td><?=$d['kode_aset'] ?></td>
                  </tr>
                  <tr>                       
                    <td width="100px">Nama Aset</td>
                    <td width="50px">:</td>
                    <td><?=$d['nama_barang'] ?></td>
                  </tr>
                  <tr>
                    <td width="200px">Kategori Aset</td>
                    <td width="50px">:</td>
                    <td><?=$d['kode_kategori'] ?> - <?=$d['nama_kategori'] ?></td>
                  </tr>
                  <tr>
                    <td width="100px">Merek</td>
                    <td width="50px">:</td>
                    <td><?=$d['merek'] ?></td>
                  </tr>
                  <tr>
                    <td width="100px">Kondisi</td>
                    <td width="50px">:</td>
                    <td><?=$d['kondisi'] ?></td>
                  </tr>
                  <tr>
                    <td width="100px">Tahun Perolehan</td>
                    <td width="50px">:</td>
                    <td><?=$d['tahun_perolehan'] ?></td>
                  </tr>
                  <tr>
                    <td width="100px">Lokasi Aset</td>
                    <td width="50px">:</td>
                    <td><?=$d['nama_lokasi'] ?></td>
                  </tr>                 
                  <tr>
                    <td width="100px">Satuan</td>
                    <td width="50px">:</td>
                    <td><?=$d['satuan'];?></td>
                  </tr>
                  <tr>
                    <td width="100px">Jumlah</td>
                    <td width="50px">:</td>
                    <td><?=$d['volume'] ?></td>
                  </tr>
                  <tr>
                    <td width="100px">Nilai Aset</td>
                    <td width="50px">:</td>
                    <td><?=rupiah($d['harga']);?></td>
                  </tr>
                  <tr>
                    <td width="100px">Total Nilai Aset</td>
                    <td width="50px">:</td>
                    <td><?=rupiah($d['harga']*$d['volume']);?></td>
                  </tr>
                  <tr>
                    <td width="100px">Status Aset</td>
                    <td width="50px">:</td>
                    <td><?=$d['status_aset'];?></td>
                  </tr>
                  <tr>
                    <td width="100px">Umur Ekonomis</td>
                    <td width="50px">:</td>
                    <td><?=$d['umur_ekonomis'];?> Tahun</td>
                  </tr>
                  <tr>
                    <td width="100px">Masa Pemakaian</td>
                    <td width="50px">:</td>
                    <td>
                      <?php
                      $usia = date('Y')-$d['tahun_perolehan'];
                      if ($usia < 0) {
                        echo " Aset sudah melewati umur ekonomis";
                      } else {
                        echo $usia," Tahun";
                      }                         
                      ?>
                    </td>
                  </tr>
                  <tr>
                      <td width="100px">Foto Barang</td>
                      <td width="50px">:</td>
                      <td>
                        <img src="<?=base_url();?>src/img/barang/<?=$d['picture'];?>" style="height: 200px;" class="img-rounded">
                      </td>
                  </tr>
                <?php } ?>     
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </section>


  </body>
</html>