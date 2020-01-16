<?php
require "php/config.php";
require "admin/template/header.php"; ?>

<script type="text/javascript" src="admin/js/validacija.js"></script>

<div class="row">

  <div class="row_header">
    <h1>Izmena podataka o knjizi</h1>
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
                      if($staPrikazati == "Uspešno ste izvršili izmenu podataka o knjizi!") {
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
                  $knjigaID = $_GET['knjigaID'];
                  $url = 'http://localhost/projekat/knjige/'. $knjigaID .'.json';
                  $curl = curl_init($url);
                  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
                  curl_setopt($curl, CURLOPT_HTTPGET, true);
                  $curl_odgovor = curl_exec($curl);
                  curl_close($curl);
                  $k = json_decode($curl_odgovor);
              ?>
<br><br>
              <form id="form" class="form-horizontal" method="POST" action="update.php?knjigaID=<?php echo "$k->knjigaID";?>">
                <div class="form-group">
                  <label for="knjigaNaziv" class="col-sm-2  control-label">Naziv knjige:</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" name="knjigaNaziv" placeholder="Unesite naziv knjige..." id="knjigaNaziv"value="<?php echo "$k->knjigaNaziv";?>">
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
                                echo "<option value='$pisac->pisacID' ";
                                if($k->pisacID == $pisac->pisacID) {
                                    echo "selected";
                                }
                                echo ">$pisac->pisacIme $pisac->pisacPrezime</option>";
                            }
                        ?>
                      </select>
                  </div>

                  </div>

                  <div class="form-group">
                    <label for="knjigaIzdanje" class="col-sm-2  control-label">Izdanje:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="knjigaIzdanje" placeholder="Unesite izdanje knjige..." id="knjigaIzdanje"value="<?php echo "$k->knjigaIzdanje";?>">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="knjigaTiraz" class="col-sm-2  control-label">Tiraž:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="knjigaTiraz" placeholder="Unesite tiraž..."  id="knjigaTiraz"value="<?php echo "$k->knjigaTiraz";?>">
                    </div>
                  </div>



                  <div class="form-group">
                    <label for="knjigaStanje" class="col-sm-2  control-label">Količina:</label>
                    <div class="col-sm-8">
                      <input type="text" class="form-control" name="knjigaStanje" placeholder="Unesite količinu..." id="knjigaStanje" value="<?php echo "$k->knjigaStanje";?>">
                    </div>
                  </div>



                  <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-8">
                      <button type="submit" name="sacuvaj" class="btn btn-success">Sačuvaj izmene</button>
                    </div>
                  </div>
                  <br>
              </form>
          </div>
          <div class="col-sm-2">
            <img src="img/b4.jpg" alt="books" height="300px"/>
            <br><br>
        </div>


</div>

</div>

</div>
<br><br>
<?php require "admin/template/footer.php"; ?>
