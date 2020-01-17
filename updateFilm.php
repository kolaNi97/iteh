<?php
require "php/config.php";
require "admin/template/header.php"; ?>

<script type="text/javascript" src="admin/js/validacija.js"></script>

<div class="row" style = "margin-bottom: 10%;">

  <div class="row_header">
    <h1>Izmena podataka o filmu</h1>
    <br><br><br>
  </div>

  <div class="col-sm-12">
          <div class="post3">
            <div class="col-sm-2">
          </div>
            <div class="col-sm-6">
              <?php
                  if(isset($_GET['poruka'])) {
                      $staPrikazati = $_GET['poruka'];
                      if($staPrikazati == "Uspešno ste izvršili izmenu podataka o filmu!") {
                      ?>
                         <div class="alert alert-info alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong> <?php echo $staPrikazati  ?> </strong>
                          </div>
                          <?php
                      }
                      else {
                        ?>    <div class="alert alert-danger alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <strong> <?php echo $staPrikazati  ?></strong>
                      </div>
                      <?php
                     }
                  }
              ?>
              <?php
                  $actual_link = "http://$_SERVER[HTTP_HOST]";
                  $filmID = $_GET['filmID'];
                  $url = 'http://localhost/projekat/film1/'. $filmID .'.json';
                  $curl = curl_init($url);
                  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                  curl_setopt($curl, CURLOPT_HTTPGET, true);
                  $curl_odgovor = curl_exec($curl);
                  curl_close($curl);
                  $k = json_decode($curl_odgovor);
              ?>
<br><br>
              <form id="form" class="form-horizontal" method="POST" action="update.php?filmID=<?php echo "$k->FilmID";?>">
                <div class="form-group">
                  <label for="filmNaziv" class="col-sm-2  control-label">Naziv filma:</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="NazivFilma" placeholder="Unesite naziv filma..." id="filmNaziv"value="<?php echo "$k->NazivFilma";?>">
                  </div>
                </div>

                  <div class="form-group">
                      <label for="Reziser" class="col-sm-2  control-label">Reziser:</label>
                      <div class="col-sm-8">
                      <select id="Reziser" class="form-control" name="Reziser">
                        <option value=''></option>
                        <?php
                            $urlZaSB = 'http://localhost/projekat/reziser.json';
                            $curlZaSB = curl_init($urlZaSB);
                            curl_setopt($curlZaSB, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($curlZaSB, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                            curl_setopt($curlZaSB, CURLOPT_HTTPGET, true);
                            $curl_odgovorSB = curl_exec($curlZaSB);
                            curl_close($curlZaSB);
                            $odgovorOdServisa = json_decode($curl_odgovorSB);
                            foreach($odgovorOdServisa->reziser as $reziser) {
                                echo "<option value='$reziser->ReziserID' ";
                                if($k->ReziserID == $reziser->ReziserID) {
                                    echo "selected";
                                }
                                echo ">$reziser->Ime $reziser->Prezime</option>";
                            }
                        ?>
                      </select>
                  </div>

                  </div>

                  <div class="form-group">
                    <label for="filmTrajanje" class="col-sm-2  control-label">Trajanje:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="Trajanje" placeholder="Unesite trajanje filma..." id="filmTrajanje"value="<?php echo "$k->Trajanje";?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="filmCena" class="col-sm-2  control-label">Cena:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="Cena" placeholder="Unesite cenu..."  id="filmCena"value="<?php echo "$k->Cena";?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                      <button type="submit" name="sacuvaj" class="btn btn-primary">Sačuvaj izmene</button>
                    </div>
                  </div>
                  <br>
                  <br>
              </form>
          </div>
          <div class="col-sm-2">
            <img src="img/3.jpg" alt="books" height="300px"/>
            <br><br>
        </div>


</div>

</div>

</div>
<br><br>
<?php require "admin/template/footer.php"; ?>
