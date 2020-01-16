<?php
require "php/config.php";
require "korisnik/template/header.php";
?>
   <div class="row">

     <div class="row_header">
       <h1>Kupite knjige</h1>
       <br>
     </div>
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height:480px;">

                 <div class="post2">
                 <?php
   echo '<script>console.log('.$_SESSION['id'].')</script>';
?>
                   <?php
                       if(isset($_GET['poruka'])) {
                           $staPrikazati = $_GET['poruka'];
                           if($staPrikazati == "Uspešno ste rezervisali!") {
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


                     <?php
                         $url = 'http://localhost/projekat/rezervacija.json';
                         $curl = curl_init($url);
                         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                         curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                         curl_setopt($curl, CURLOPT_HTTPGET, true);

                         $curl_odgovor = curl_exec($curl);
                         curl_close($curl);
                         $json_objekat = json_decode($curl_odgovor);
                     ?>
                     <div class="datagrid" style="max-height:500px;">
                         <table id="listaKnjiga">
                             <thead>
                                 <tr>
                                     <th>Naziv filma</th>
                                     <th>Trajanje</th>
                                     <th>Broj slobodnih mesta</th>
									 <th>Cena(RSD)</th>
                                     <th>Vreme</th>
                                     <th>Kupovina</th>
                                 </tr>
                             </thead>
                             <tbody id="ajaxPodaci">
                                 <?php
                                     foreach($json_objekat->rezervacija as $rezervacija) {
                                         echo "<tr>
                                                 <td>$rezervacija->NazivFilma</td>
                                                 <td>$rezervacija->Trajanje</td>
                                                 <td>$rezervacija->BrojSlobodnih</td>
                                                 <td>$rezervacija->Cena</td>
                                                 <td>$rezervacija->Datum</td>

                                                 ";

              if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
                          if($_SESSION['status']=='Admin'){
                                                echo " <td><button class='btn btn-primary disabled'>Kupi</button></td>
                                             </tr>";
                                     }

                          else{
                             
                              $urlZaSB = 'http://localhost/projekat/kupovina.json';
                              $curlZaSB = curl_init($urlZaSB);
                              curl_setopt($curlZaSB, CURLOPT_RETURNTRANSFER, true);
                              curl_setopt($curlZaSB, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                              curl_setopt($curlZaSB, CURLOPT_HTTPGET, true);
                              $curl_odgovorSB = curl_exec($curlZaSB);
                              curl_close($curlZaSB);
                              $odgovorOdServisa = json_decode($curl_odgovorSB);

                                    echo " <td><a href='ubaciKupovinu.php?rezervacijaID=". $rezervacija->RezervacijaID ."'><button  class='btn btn-primary'>Kupi</button></a></td>
                                             </tr>";                                    
                                     }
                                   }                          
                                 }
                                 ?>
                             </tbody>
                         </table>
                     </div>

                    </div>
            </div>
   </div>
<br><br><br><br><br><br>
}
<?php require "korisnik/template/footer.php"; ?>
