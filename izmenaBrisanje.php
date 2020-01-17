<?php
require "php/config.php";
require "admin/template/header.php";
?>




   <div class="row">

     <div class="row_header">
       <h1>Izmena i brisanje filmova</h1>
       <br>
     </div>
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height:460px">

                 <div class="post2">
                   <?php
                       if(isset($_GET['poruka'])) {
                           $staPrikazati = $_GET['poruka'];
                           if($staPrikazati == "Uspešno ste izvršili izmenu podataka o filmu!") {
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
    <br>
                     <?php
                         $url = 'http://localhost/projekat/film.json';
                         $curl = curl_init($url);
                         curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                         curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                         curl_setopt($curl, CURLOPT_HTTPGET, true);

                         $curl_odgovor = curl_exec($curl);
                         curl_close($curl);
                         $json_objekat = json_decode($curl_odgovor);
                     ?>
                     <div class="datagrid">
                         <table id="listaFilmova">
                             <thead>
                                 <tr>
                                     <th>Izmena</th>
                                     <th>Naziv filma</th>
                                     <th>Trajanje</th>
                                     <th>Cena(RSD)</th>
                                     <th>Režiser</th>
                                     <th>Brisanje</th>
                                 </tr>
                             </thead>
                             <tbody id="ajaxPodaci">
                                 <?php
                                     foreach($json_objekat->film as $film) {
                                         echo "<tr>
                                                 <td><a href='updateFilm.php?filmID=". $film->FilmID ."'><button class='btn btn-info'>Izmeni</button></a></td>
                                                 <td>$film->NazivFilma</td>
                                                 <td>$film->Trajanje</td>
                                                 <td>$film->Cena</td>
                                                 <td>$film->Ime $film->Prezime</td>

                                                 <td><a href='delete.php?filmID=". $film->FilmID ."'><button class='btn btn-danger'>Obriši</button></a></td>
                                             </tr>";
                                     }
                                 ?>
                             </tbody>
                         </table>
                     </div>

                    </div>
            </div>
   </div>

   <?php require "admin/template/footer.php"; ?>
