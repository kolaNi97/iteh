<?php
require "php/config.php";
require "admin/template/header.php";
?>

<script>
       function pretrazi(tekst) {
           var bodyTabele = document.getElementById('ajaxPodaci');
           var url = "http://localhost/projekat/knjiga/'.$pisacID.'.json?search="+ tekst;
           $.getJSON(url, function(odgovorServisa) {
               bodyTabele.innerHTML = "";
               $.each(odgovorServisa.knjiga,function(i, knjiga) {
                   $("#ajaxPodaci").append("<tr>"+
                           "<td><a href='updateKnjiga.php?knjigaID="+ knjiga.knjigaID +"'><button class='btn btn-info'>Izmena</button></a></td>"+
                           "<td>"+ knjiga.knjigaNaziv +"</td> "+
                           "<td>"+ knjiga.knjigaIzdanje +"</td>"+
                           "<td>"+ knjiga.knjigaTiraz +"</td>"+

                           "<td>"+ knjiga.knjigaStanje +"</td>" +
                           "<td>"+ knjiga.pisacIme + " " +knjiga.pisacPrezime +"</td>" +

                           "<td><a href='delete.php?knjigaID="+ knjiga.knjigaID +"'><button class='btn btn-danger'>Brisanje</button></a></td>"+
                           "</tr>");
               })
           });
       }
   </script>


   <div class="row">

     <div class="row_header">
       <h1>Izmena i brisanje knjiga</h1>
       <br>
     </div>
               <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="height:460px">

                 <div class="post2">
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

                     <div class="search"
                         <label for="radio" ><b>Za pretragu unesite naziv knjige: </b></label>
                         <input type="text" name="textSearch" id="textSearch" onkeyup="pretrazi(this.value)" style="color:#000;">
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

                                     <th>Stanje na lageru</th>
                                     <th>Ime i prezime pisca</th>
                                     <th>Brisanje</th>
                                 </tr>
                             </thead>
                             <tbody id="ajaxPodaci">
                                 <?php
                                     foreach($json_objekat->knjiga as $knjiga) {
                                         echo "<tr>
                                                 <td><a href='updateKnjiga.php?knjigaID=". $knjiga->knjigaID ."'><button class='btn btn-info'>Izmeni</button></a></td>
                                                 <td>$knjiga->knjigaNaziv</td>
                                                 <td>$knjiga->knjigaIzdanje</td>
                                                 <td>$knjiga->knjigaStanje</td>
                                                 <td>$knjiga->knjigaCena</td>
                                                 <td>$knjiga->pisacIme $knjiga->pisacPrezime</td>

                                                 <td><a href='delete.php?knjigaID=". $knjiga->knjigaID ."'><button class='btn btn-danger'>Obriši</button></a></td>
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
