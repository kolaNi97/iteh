<?php
require "php/config.php";
require "admin/template/header.php"; ?>

<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="admin/js/validacija.js"></script>

<div class="row">

  <div class="row_header">
    <h1>Unos novog filma</h1>
    <br><br><br>
  </div>

  <div class="col-sm-12">
          <div class="post3">
            <div class="col-sm-2">
          </div>
            <div class="col-sm-6" id = "fo">
              <?php
                  if(isset($_GET['poruka'])) {
                      $staPrikazati = $_GET['poruka'];
                      if($staPrikazati == "Uspešno ste dodali nov film!") {
                        ?>    <div class="alert alert-info alert-dismissible" role="alert">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
<br><br>
              <form id="form" class="form-horizontal" method="POST" action="insert.php">
                <div class="form-group">
                  <label for="filmNaziv" class="col-sm-2  control-label">Naziv filma:</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="NazivFilma" placeholder="Unesite naziv filma..." id="NazivFilma">
                  </div>
                </div>

                  <div class="form-group">
                      <label for="reziser" class="col-sm-2  control-label">Reziser:</label>
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
                                echo "<option value='$reziser->ReziserID'>$reziser->Ime $reziser->Prezime</option>";
                              }
                          ?>
                      </select>
                  </div>

                  </div>

                  <div class="form-group">
                    <label for="Trajanje" class="col-sm-2  control-label">Trajanje:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="Trajanje" placeholder="Unesite trajanje filma.." id="Trajanje">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="Cena" class="col-sm-2  control-label">Cena:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="Cena" placeholder="Unesite cenu filma..."  id="Cena">
                    </div>
                  </div>

                    <br>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                      <button type="submit" name="ubaci" class="btn btn-primary">Dodaj film</button>

                    </div>
                  </div>
                  </form>
              </form> <br><br>
          </div>
          <div class="col-sm-2">
            <img src="img/unos.jpg" alt="books" height="300px"/>
            <br><br><br>  <br><br><br>
        </div>


</div>
</div>
</div>

<br><br>


<?php require "admin/template/footer.php"; ?>
