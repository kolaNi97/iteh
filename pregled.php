<?php
require "php/config.php";
require "korisnik/template/header.php";
?>

<script src="DataTables-1.10.10/media/js/jquery.js"></script>
    <script src="js2/jquery.min.js"></script>
    <script src="jeditable/jquery.jeditable.js"></script>
    <script src="DataTables-1.10.10/media/js/jquery.dataTables.min.js"></script>
    <script src="DataTables-1.10.10\extensions\plugins\integration\jqueryui\dataTables.jqueryui.js"></script>
    <script src="DataTables-1.10.10\extensions\editable\jquery.dataTables.editable.js"></script>
    <script src="DataTables-1.10.10/extensions/editable/jquery.dataTables.editable.js"></script>

    <link rel="stylesheet" type="text/css" href="DataTables-1.10.10/media/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="DataTables-1.10.10/extensions/plugins/integration/jqueryui/dataTables.jqueryui.css">
    <link rel="stylesheet" type="text/css" href="jquery-ui-themes-1.11.4/themes/vader/jquery-ui.css">

    <script src = "DataTables-1.10.10/extensions/plugins/integration/bootstrap/3/dataTables.bootstrap.js"></script>
    <link rel="stylesheet" href="DataTables-1.10.10/extensions/plugins/integration/bootstrap/3/dataTables.bootstrap.css">



    <script>

     $(document).ready(function(){
      $(".tabela").DataTable({
     	 "columns": [
                 { "title": "Naziv filma" },
                 { "title": "Reziser" },
                 { "title": "Trajanje" },
				          { "title": "Cena(RSD)" }
             ],
             "order": [[ 0, "asc" ]],
             "language": {
                     "url": "DataTables-1.10.10/i18n/serbian.json"
                 }
     	});
     });
     </script>
 <body id="main_body">
   <br><br><br><br>

<?php

    	$mysqli = new mysqli($mysql_server, $mysql_user, $mysql_password, $mysql_db);
  	?>
<table class="tabela display" width="80%" >

  <tbody>

    <?php
        $url = 'http://localhost/projekat/film.json';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_HTTPGET, true);

        $curl_odgovor = curl_exec($curl);
        curl_close($curl);
        $json_objekat = json_decode($curl_odgovor);
        foreach($json_objekat->film as $film) {
    ?>

  	<tr id="<?php echo $film->FilmID;?>">
    	<td><?php echo $film->NazivFilma;?></td>
  		<td><?php echo $film->Ime. ' ' . $film->Prezime;?></td>
  		<td><?php echo $film->Trajanje;?></td>
		  <td><?php echo $film->Cena;?></td>
  	</tr>

<?php
}

 ?>




  </tbody>
  </table>
<br><br><br><br>
<?php require "korisnik/template/footer.php"; ?>



  </body>
