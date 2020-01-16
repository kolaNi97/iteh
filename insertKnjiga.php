<?php
require "php/config.php";
require "admin/template/header.php"; ?>

<script src="js/jquery.validate.min.js"></script>
<script type="text/javascript" src="admin/js/validacija.js"></script>

<div class="row">

  <div class="row_header">
    <h1>Unos nove knjige</h1>
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
                      if($staPrikazati == "Uspešno ste dodali novu knjigu!") {
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
                  <label for="knjigaNaziv" class="col-sm-2  control-label">Naziv:</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="knjigaNaziv" placeholder="Unesite naziv knjige..." id="knjigaNaziv">
                  </div>
                </div>

                  <div class="form-group">
                      <label for="pisac" class="col-sm-2  control-label">Pisac:</label>
                      <div class="col-sm-8">
                      <select id="pisac" class="form-control" name="pisac">
                          <option value=''></option>
                          <?php
                              $urlZaSB = 'http://localhost/projekat/pisac.json';
                              $curlZaSB = curl_init($urlZaSB);
                              curl_setopt($curlZaSB, CURLOPT_RETURNTRANSFER, true);
                              curl_setopt($curlZaSB, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                              curl_setopt($curlZaSB, CURLOPT_HTTPGET, true);
                              $curl_odgovorSB = curl_exec($curlZaSB);
                              curl_close($curlZaSB);
                              $odgovorOdServisa = json_decode($curl_odgovorSB);
                              foreach($odgovorOdServisa->pisac as $pisac) {
                                echo "<option value='$pisac->pisacID'>$pisac->pisacIme $pisac->pisacPrezime</option>";

                              }
                          ?>
                      </select>
                  </div>

                  </div>

                  <div class="form-group">
                    <label for="knjigaIzdanje" class="col-sm-2  control-label">Izdanje:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="knjigaIzdanje" placeholder="Unesite izdanje knjige..." id="knjigaIzdanje">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="knjigaStanje" class="col-sm-2  control-label">Stanje:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="knjigaStanje" placeholder="Unesite stanje..."  id="knjigaStanje">
                    </div>
                  </div>
				  
					<div class="form-group">
                    <label for="knjigaCena" class="col-sm-2  control-label">Cena:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="knjigaSCena" placeholder="Unesite cenu..."  id="knjigaCena">
                    </div>
                  </div>



                  
                    <br>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                      <button type="submit" name="ubaci" class="btn btn-success">Dodaj knjigu</button>

                    </div>
                  </div>
                  </form>
              </form> <br><br>
          </div>
          <div class="col-sm-2">
            <img src="img/b4.jpg" alt="books" height="300px"/>
            <br><br><br>  <br><br><br>
        </div>


</div>
</div>
</div>

<br><br>


<?php require "admin/template/footer.php"; ?>
