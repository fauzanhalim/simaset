<?php 
  $app = $this->db->get_where('setup', array('id' => 1))->row_array();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="<?=base_url()?>src/css/laporan.css">

    <title><?=$title;?></title>

    <link rel="shortcut icon" href="<?=base_url()?>src/img/logo/<?=$app['picture'];?>">
  </head>
  <body>
  	<div class="container">
      <div class="row pt-4">
  			<div class="col-md-1">
  				<img src="<?=base_url()?>src/img/logo/<?=$app['picture'];?>" class="kiri" alt="">		
  			</div>
  			<div class="col-md-11">
  				<h4 class="a mt-3"><?=$app['name_institute'];?></h4>
  				<p class="alamat"><?=$app['address'];?></p>
  			</div>
  		</div>
  		<hr style="border: 1px solid black;">
  		
  	