<?php 
require "php/config.php"; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>BookCorner</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <script>
           function pretrazi(tekst) {
               var bodyTabele = document.getElementById('ajaxPodaci');
               var url = "http://localhost/projekat/knjiga/'.$pisacID.'.json?search="+ tekst;
               $.getJSON(url, function(odgovorServisa) {
                   bodyTabele.innerHTML = "";
                   $.each(odgovorServisa.knjiga,function(i, knjiga) {
                       $("#ajaxPodaci").append("<tr>"+
                               "<td><a href='updateKnjiga.php?knjigaID="+ knjiga.knjigaID +"'><button class='button-update'>Izmena</button></a></td>"+
                               "<td>"+ knjiga.knjigaNaziv +"</td> "+
                               "<td>"+ knjiga.knjigaIzdanje +"</td>"+
                               "<td>"+ knjiga.knjigaTiraz +"</td>"+
                               "<td>"+ knjiga.knjigaCena +"</td>" +
                               "<td>"+ knjiga.knjigaStanje +"</td>" +
                               "<td>"+ knjiga.pisacIme + " " +knjiga.pisacPrezime +"</td>" +
                               "<td><a href='delete.php?knjigaID="+ knjiga.knjigaID +"'><button class='button-delete'>Brisanje</button></a></td>"+
                               "</tr>");
                   })
               });
           }
       </script>
  </head>
  <body id="main_body">
    <div id="header">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
           <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">
                <img id="logo" src="img/book.png" alt="knjiga_logo"/>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              
               <?php
          if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {   /*proverava da li ima sesije odnosno da li je neko ulogovan,ako je ulogovan onda otvara mogucnost Izlaza a ako nije onda otvara mogucnost za ulaz i registraciju*/
            ?>
            
            <li><a href="izmenaBrisanje.php">Izmena/brisanje</a></li>
            <li><a href="insertKnjiga.php">Unos</a></li>
            <li><a href="vizuelizacija.php">Vizuelizacija(Stanje na lageru)</a></li>

            <?php
          }else{
            ?>
            <li><a href="Ulaz/index.php" >Log in</a></li>
           
            <?php
          }
          ?>
              
            </ul>
            <?php 
 if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {   /*proverava da li ima sesije odnosno da li je neko ulogovan,ako je ulogovan onda otvara mogucnost Izlaza a ako nije onda otvara mogucnost za ulaz i registraciju*/
           
             ?>
            <ul class="nav navbar-nav navbar-right">
                
                 <a class="navbar-brand" href="index.php">
                 
                 <?php
        if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
          echo '<li><a href="http://'.$SYS_baseurl.$SYS_pocdir.'Profil"><b>'.$_SESSION['username'].'↓</b></a>';
         
          }
          echo "</li>";
        
        ?>

                 <li><a href="<?php echo "http://".$SYS_baseurl.$SYS_pocdir."Izlaz";?>" >Log out</a></li>
                     <img id="logo" src="img/book.png" alt="knjiga_logo"/>
                 </a>
           </ul>
           <?php }
           ?>
            
          </div>
      </div>
      
      </nav>
    </div>

<div id="container">
  <div class="container_header">
    <br>
    <h1>Izmena/brisanje knjiga</h1>
    <br>
  </div>
  <div id="container-left" class="col-sm-10">
      <div class="post3">
          <div class="post_body3">
            <?php
                if(isset($_GET['poruka'])) {
                    $staPrikazati = $_GET['poruka'];
                    if($staPrikazati == "Uspešno ste izvršili izmenu podataka o knjizi!") {
                    ?>    <div class="alert alert-info alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong> <?php echo $staPrikazati  ?> </strong>
                        </div>
                        <?php
                    }
                    else {
                      ?>    <div class="alert alert-success alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong> <?php echo $staPrikazati  ?></strong>
                    </div>
                    <?php
                   }
                }
            ?>
              <div
                  <label for="radio"><b>Za pretragu unesite naziv knjige: </b></label>
                  <input type="text" name="textSearch" id="textSearch" onkeyup="pretrazi(this.value)">
              </div> <br>
              <?php
                  $url = 'http://localhost/projekat/knjiga.json';
                  $curl = curl_init($url);
                  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                  curl_setopt($curl, CURLOPT_HTTPGET, true);

                  $curl_odgovor = curl_exec($curl);
                  curl_close($curl);
                  $json_objekat = json_decode($curl_odgovor);
              ?>
              <div class="datagrid">
                  <table id="listaKnjiga">
                      <thead>
                          <tr>
                              <th>Izmena</th>
                              <th>Naziv knjige</th>
                              <th>Izdanje</th>
                              <th>Tiraž</th>
                              <th>Cena</th>
                              <th>Stanje na lageru</th>
                              <th>Ime i prezime pisca</th>
                              <th>Brisanje</th>
                          </tr>
                      </thead>
                      <tbody id="ajaxPodaci">
                          <?php
                              foreach($json_objekat->knjiga as $knjiga) {
                                  echo "<tr>
                                          <td><a href='updateKnjiga.php?knjigaID=". $knjiga->knjigaID ."'><button class='button-update'>Izmeni</button></a></td>
                                          <td>$knjiga->knjigaNaziv</td>
                                          <td>$knjiga->knjigaIzdanje</td>
                                          <td>$knjiga->knjigaTiraz</td>
                                          <td>$knjiga->knjigaCena</td>
                                          <td>$knjiga->knjigaStanje</td>
                                          <td>$knjiga->pisacIme $knjiga->pisacPrezime</td>
                                          <td><a href='delete.php?knjigaID=". $knjiga->knjigaID ."'><button class='button-delete'>Obriši</button></a></td>
                                      </tr>";
                              }
                          ?>
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
  <div id="containerselect-right" class="col-sm-2">
    <h4>Dodaj novu knjigu</h4>
    <div class="right-pic-insert">
      <a href='insertKnjiga.php'>
         <img src="img/b3.jpeg" alt="books" width="220px" style="padding-left:20px;" />
         <p class="description"> <b><b>+ Dodaj</p>
       </a>

    </div>
  </div>
  </div>


<div id="main_footer" class="col-lg-12 col-xs-12" >
    (2016)Designed by Jelena Spasić
</div>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('.carousel').carousel({
            interval: 5000
        })
    </script>
  </body>
</html>
