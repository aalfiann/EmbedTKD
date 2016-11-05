<?php 
/*
The MIT License (MIT)

Copyright (c) 2014 - 2016 M ABD AZIZ ALFIAN (https://about.me/azizalfian)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
*/

include 'config.php';
?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/tkd.ico">

    <title><?=$sitetitle?></title>

    <!-- Bootstrap core CSS -->
    <?php
      if (empty($_GET['theme']))
      {
        echo '<link href="assets/css/bootstrap.min.css" rel="stylesheet">';
      }
      else
      {
        if ($_GET['theme']=='dark')
        {
          echo '<link href="assets/css/bootstrap-dark.min.css" rel="stylesheet">';
        }
        else
        {
          echo '<link href="assets/css/bootstrap.min.css" rel="stylesheet">';
        }
      }
    ?>
    

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!--CSS untuk auto completion-->
	  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />     
	

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" <?php if($_GET['m']==1) echo 'class="active"'; else if(empty($_GET['m'])) echo 'class="active"';?>><a href="#tarif" aria-controls="tarif" role="tab" data-toggle="tab">CEK TARIF</a></li>
        <li role="presentation" <?php if($_GET['m']==2) echo 'class="active"';?>><a href="#resi" aria-controls="resi" role="tab" data-toggle="tab">CEK RESI</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <!-- TAB TARIF -->
        <div role="tabpanel" class="tab-pane <?php if($_GET['m']==1) echo 'active'; else if(empty($_GET['m'])) echo 'active';?>" id="tarif">
          <br>
          <?php if(isset($_GET['submittarif'])) 
          {
            $url = $api."?mode=tarif&origin=".urlencode($_GET['origin'])."&destinasi=".urlencode($_GET['destinasi'])."&weight=".$_GET['berat']."";	
          	$data = json_decode(curl_get_contents($url));
          	if (!empty($data))
            {
              if ($data->{'status'} == "success")
              {
                echo '<a href="'.$website.'?m=1&theme='.((!empty($_GET['theme']))?$_GET['theme']:'').'" alt="Kembali ke Halaman Awal"><< Kembali ke Halaman Awal</a>
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <th>Produk</th>
                          <th>Kelurahan Tujuan</th>
                          <th>Kabupaten / Kota</th>
                          <th>Biaya Kirim</th>
                          <th>Estimasi</th>
                        </thead>
                        <tbody>';
                foreach ($data->results as $name => $value) 
	              {
                  echo '<tr>';
                  echo '<td>' . $value->{'Produk'} .'</td>';
            			echo '<td>' . $value->{'Daerah Tujuan'} .'</td>';
                  echo '<td>' . $value->{'Kabupaten / Kota'} .'</td>';
                	echo '<td>' . $value->{'Biaya_Kirim'} .'</td>';
            	    echo '<td>' . $value->{'Estimasi'} .'</td>';
        	    		echo '</tr>';              
                }
                echo '</tbody>
                    </table>
                  </div>
                </div>';
              }
              else
              {
                echo '<a href="'.$website.'?m=1&theme='.((!empty($_GET['theme']))?$_GET['theme']:'').'" alt="Kembali ke Halaman Awal"><< Kembali ke Halaman Awal</a><br>
                Message: '.$data->{'message'};
              }
            }
          }
          else 
          {
            echo '<form method="get" action="'.$_SERVER['PHP_SELF'].'">
              <div class="form-group" hidden>
                <input name="m" type="text" class="form-control text-uppercase origin" value="1">
                <input name="theme" type="text" class="form-control text-uppercase origin" value="'.((!empty($_GET['theme']))?$_GET['theme']:'').'">
              </div>
              <div class="form-group">
                <label>Origin</label>
                <input name="origin" type="text" class="form-control text-uppercase origin" placeholder="KOTA ANDA" value="" required>
              </div>
              <div class="form-group">
                <label>Destinasi</label>
                <input name="destinasi" type="text" class="form-control text-uppercase destinasi" placeholder="KOTA / KABUPATEN" value="" required>
              </div>
              <div class="form-group">
                  <label>Berat Kg</label>
                  <input name="berat" type="text" class="form-control text-uppercase destinasi" placeholder="1" value="1" required>
             </div>
             <div class="form-group text-center">
                  <input name="submittarif" type="submit" class="btn btn-primary col-md-12 col-xs-12" value="CEK TARIF"></input>
             </div>
           </form>';
          }
        ?>
        </div>
        
        <!-- TAB RESI -->
        <div role="tabpanel" class="tab-pane <?php if($_GET['m']==2) echo 'active';?>" id="resi">
          <br>
          <?php if(isset($_GET['submitconnote'])) 
          {
            $url = $api."?mode=statusconnote&connote=".$_GET['connote']."";	
          	$data = json_decode(curl_get_contents($url));
          	if (!empty($data))
            {
              if ($data->{'status'} == "success")
              {
                echo '<a href="'.$website.'?m=2&theme='.((!empty($_GET['theme']))?$_GET['theme']:'').'" alt="Kembali ke Halaman Awal"><< Kembali ke Halaman Awal</a>
                  <div class="col-md-12">
                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
                          <tr><td>No Connote</td> <td>: '.$data->results[0]->{'Connote'}.'</td></tr>
                          <tr><td>Referensi ID</td> <td>: '.$data->results[0]->{'ReferensiID'}.'</td></tr>
                          <tr><td>Origin</td> <td>: '.$data->results[0]->{'Origin'}.'</td></tr>
                          <tr><td>Daerah Tujuan</td> <td>: '.$data->results[0]->{'Destinasi'}.'</td></tr>
                          <tr><td>Kel. / Kab. Tujuan</td> <td>: '.$data->results[0]->{'Tujuan'}.'</td></tr>
                          <tr><td>Produk / Service</td> <td>: '.$data->results[0]->{'Produk'}.'</td></tr>
                          <tr><td>No Polis</td> <td>: '.$data->results[0]->{'No Polis'}.'</td></tr>
                          <tr><td>Status Delivery</td> <td>: <b>'.$data->results[0]->{'Status Delivery'}.'</b></td></tr>
                        </tbody>
                      </table>
                    </div>
                  </div>';
              }
              else
              {
                echo '<a href="'.$website.'?m=2&theme='.((!empty($_GET['theme']))?$_GET['theme']:'').'" alt="Kembali ke Halaman Awal"><< Kembali ke Halaman Awal</a><br>
                Message: '.$data->{'message'};
              }
            }
          }
          else
          {
            echo '<form method="get" action="'.$_SERVER['PHP_SELF'].'"> 
            <div class="form-group" hidden>
              <input name="m" type="text" class="form-control text-uppercase origin" value="2">
              <input name="theme" type="text" class="form-control text-uppercase origin" value="'.((!empty($_GET['theme']))?$_GET['theme']:'').'">
            </div>
            <div class="form-group">
              <label>No Resi / Connote</label>
              <input name="connote" type="text" class="form-control border-input text-uppercase" placeholder="No Resi / Connote Anda" value="" maxlength="12" required>
            </div>
            <div class="form-group text-center">
              <input name="submitconnote" type="submit" class="btn btn-primary col-md-12 col-xs-12" value="CEK RESI"></input>
            </div>
          </form>';
          }
          ?>

        </div>

      </div>

    </div> <!-- /container -->

    <footer class="footer text-center">
      <div class="container">
      <hr>
        <p class="text-muted">Widget by <a href="https://tkd.co.id/" target="_blank">TKD Express</a>.</p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="assets/js/ie10-viewport-bug-workaround.js"></script>
    <!-- Start JQuery untuk completion-->
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.2/jquery-ui.min.js"></script> 
		<script type="text/javascript">
		$(function() {
    
	    	//origin
	    	$(".origin").autocomplete({
    	    	source: "origin.php",
	    	    minLength: 3
	    	});

			//destinasi
	    	$(".destinasi").autocomplete({
    	    	source: "destinasi.php",
	        	minLength: 3
		    });                

		});
		</script>
  </body>
</html>
