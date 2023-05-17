<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

     <style>
      tr.border_bottom {
        border:1pt solid black;
      }
    </style>

    <title><?=$title;?></title>
  </head>
  <body>
    
    <div class="container">
      <div class="row">
        <?php foreach ($aset as $row) {?>
        <div class="col-md-2" style="margin-top: 33px;">
          <table>
            <tr class="border_bottom">
              <td>
                <img class="card-img-top" src="<?=base_url().'src/img/qrcode/'.$row['qr_code'];?>" style="width:150px;" alt="Card image cap">
                <p style="font-size:8px;text-align:center"><?=$row['kode_aset'];?></p>
              </td>
            </tr>
          </table>
        </div>
        <?php } ?>
      </div>
    </div>

    <script>
      window.print();
      window.onafterprint = window.close;
    </script>
    
  </body>
</html>