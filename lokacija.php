<?php
require "php/config.php";
require "korisnik/template/header.php";
?>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyANEoZ8RYqsd3TLyJX6CS1hcADO4wewpAg&sensor=true"></script>
<script>
    function initialize() {
        var mapOptions = {
            center: new google.maps.LatLng(44.7981873,20.4689813),
            zoom: 13,
            zoomControl: true,
            zoomControlOptions: { position: google.maps.ControlPosition.TOP_RIGHT }

        };
        var map = new google.maps.Map(document.getElementById("map-canvas"),mapOptions);
        var url = "http://localhost/projekat/lokacije.json";
        var myloc = new Array();
        $.getJSON(url, function(lokacije) {
            $.each (lokacije.marker,function(i, marker){
                kreirajMarker = new google.maps.Marker({
                    position: new google.maps.LatLng(marker.latitude,marker.longitude),
                    map: map,
                    icon: 'img/book1.png',
                    title: marker.naziv
                });
            })
        });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

  <body id="main_body">
    <div class="container">
      <div class="row">
        <div class="row_header">
          <h1>Dobrodošli u BookCorner!</h1>
          <br> <br> <br>
        </div>
                  <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                        <div class="post">
                                      <div id="map-canvas"></div>

                        </div>
                        <br><br><br>
                </div>

                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="text-align:center;">
                  <div class="cta-inner text-center rounded">
        <h2 class="section-heading mb-5">
          
          <span class="section-heading-lower">Posetite nas</span>
        </h2>
        <ul class="list-unstyled list-hours mb-5 text-left mx-auto">
          <li class="list-unstyled-item list-hours-item d-flex today">
            Ponedeljak
            <span class="ml-auto">9:00-19:00</span>
          </li>
          <li class="list-unstyled-item list-hours-item d-flex">
            Utorak
            <span class="ml-auto">9:00-19:00</span>
          </li>
          <li class="list-unstyled-item list-hours-item d-flex">
            Sreda
            <span class="ml-auto">9:00-19:00</span>
          </li>
          <li class="list-unstyled-item list-hours-item d-flex">
            Četvrtak
            <span class="ml-auto">9:00-19:00</span>
          </li>
          <li class="list-unstyled-item list-hours-item d-flex">
            Petak
            <span class="ml-auto">9:00-19:00</span>
          </li>
          <li class="list-unstyled-item list-hours-item d-flex">
            Subota
            <span class="ml-auto">9:00-14:00</span>
          </li>
          <li class="list-unstyled-item list-hours-item d-flex">
            Nedelja
            <span class="ml-auto">9:00-14:00</span>
          </li>

        </ul>
        <p class="address mb-5">
          <em>
            <strong>Kneza Miloša 43</strong>
          </em>
        </p><p class="address mb-5">
          <em>
            <strong>Bulevar Kralja Aleksandra 53 </strong>
          </em>
        </p></p><p class="address mb-5">
          <em>
            <strong> Bulevar Oslobođenja 219</strong>
          </em>
        </p></p><p class="address mb-5">
          <em>
            <strong> Gospodara Vučića 78</strong>
          </em>
        </p>
        <p class="address mb-5">
          <em>
            <strong>Bulevar Mihajla Pupina 17</strong>
            <br> 11 000, BEOGRAD
          </em>
        </p>
        <p class="mb-0">
          <large>
            <em>Pozovite:</em>
          </large>
          <br>
          (+381) 11 3252-464<br>
          (+381) 64 564-23-86
        </p>
        <p class="mb-0">
          <large>
            <em><br>Imate neka pitanja za nas? Posaljite nam mejl:</em><br>
          </large>
          <a href="kontakt@knjizaraMS.rs">kontakt@knjizaraMS.rs</a>
        </p>
      </div>

                  </div>
      </div>
    </div>
  </body>





<?php

require 'korisnik/template/footer.php'; ?>
