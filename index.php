<?php
require "php/config.php";
require "korisnik/template/header.php";
?>
    <link rel="stylesheet" href="galerija/slideshow.css" />
		<script src="galerija/jquery.min.js"></script>
		<script src="galerija/imagesloaded.pkgd.min.js"></script>
    <script src="galerija/slideshow.js"></script>
    <script type="text/javascript">
			$(document).ready(function() {
				$('.slideshow .slide').click(function() {
					var num = $(this).index()+1;
					slideshow.slideNumber(num);
				});

				var slideshow = new Slideshow({
					id: 'slideshow_thumbs',
					mode: 'thumb_nails',
					align: 'center',
					loop: false,
					startingSlideNumber: 5,
					transition_delay: 400,
					multiple_slides: true,
					callback: function(obj) {
						var num = obj.slideNumber();
						var src = $('.slideshow .slide').eq(num-1).find('img').attr('src');
						src = src.replace('100/75', '500/300');
						$('.slideshow .fullsize').attr('src', src);
					}
				});
			});
		</script>
    <div class="container">
      <div class="row">

        <div class="row_header">
          <h1>BIOSKOP FON</h1>
          <br>
        </div>
          				<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">

                        <div class="post">
                              <div class="post_title">
                                <h2>Novo na repertoaru:</h2>
                              </div>
                              
                              <div id="slideshow_thumbs" class="slideshow" style = "margin-left:25%; margin-bottom: 20%;">
			<img class="fullsize" src="img/21.jpg" alt="" />
			<div class="wrapper" >
				<div class="slides">
					<div class="slide">
						<img src="img/8.jpg" />
					</div>
					<div class="slide">
						<img src="img/21.jpg" />
					</div>
					<div class="slide">
						<img src="img/22.jpg" />
					</div>
					<div class="slide">
						<img src="img/23.jpg" />
					</div>
					<div class="slide">
						<img src="img/21.jpg" />
					</div>
					<div class="slide">
						<img src="img/24.jpg" />
					</div>
					<div class="slide">
						<img src="img/10.jpg" />
					</div>
					<div class="slide">
						<img src="img/8.jpg" />
					</div>
					<div class="slide">
						<img src="img/7.jpg" />
					</div>
			
			</div>
		</div>                              </div>
                        </div>
                        <br><br><br>
                          <h2>Vesti</h2>
                          <br><br>
                        <div class="post">
                              <div class="row" id="vesti">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="thumbnail">
                                      <div class="post_title">
                                        WAR
                                      </div>
                                      <img src="img/9.jpg" class="img-responsive" alt="negujemo" style="border-radius:8px;">
                                      <div class="caption">
                                        <p>
                                        Redateljice Chloe Zhao, koja je režirala kritički hvaljeni Sundance film The Rider i produciran od Kevina Feigea, The Eternals dolazi u U.S. kina 06. studenog 2020.”

                                        I dok je The Eternals na pravom putu za izlazak u studenom ove godine, nedavno smo saznali da je drugi Marvelov film, Doctor Strange in The Multiverse of Madness, ušao u probleme kada je izgubio redatelja. Iz Marvel Studiosa nas uvjeravaju da to neće stvoriti probleme, da će brzo naći redatelja i da će film doći u kina na dogovoreni datum.
                                        </p>
                                        <details><summary>Opširinije</summary>
                                        <p>
                                        Izvrsna glumačka postava uključuju Richarda Maddena kao svemoćnog Ikarisa, Gemmu Chan kao Sersi koja voli čovječanstvo, Kumaila Nanjianija kao kozmičkog Kingoa, Lauren Ridloff kao super brze Makkari, Brian Tyree Henry kao inteligentni izumitelj Phastos, Salma Hayek kao mudri i duhovni vođa Ajak, Lia McHugh kao vječno mlada Sprite, Don Lee kao moćni Gilgamesh, Barry Keoghan kao dugo rezervirani Druig i Angelina Jolie kao žestoka ratnica Thena. Kit Harrington glumi Danea Whitmana.
                        
                                          </p>
                                        </details>
                                    <div class="text-right">
                                        <p>12.01.2020.</p>
                                      </div>
                                      </div>
                                    </div>
                                  </div>
                                  <br><br>
                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="thumbnail">
                                      <div class="post_title">
                                        LORD OF DRUGS
                                        </div>
                                      <img src="img/10.jpg" class="img-responsive" alt="negujemo" style="border-radius:8px;">
                                      <div class="caption">
                                        <p>
                                        Ako ostavimo slike po strani, dugo već vremena nismo čuli neke korisne službene informacije o Marvelovom The Eternals filmu, a sada je napokon prvi sinopsis pronašao put online.
                                           </p>
                                        <details><summary>Opširinije</summary>
                                        <p>
                                        Disney je objavio ovu radnju ukratko i dok ne ide u puno detalja, daje nam bolju ideju o tome što možemo očekivati od priče.
                                        Mi smo već znali da će se ovi drevni izvanzemaljski heroji boriti protiv starih neprijatelja Devianta, ali prema ovome, “neočekivana tragedija” će dovesti do ponovnog sukoba. Može li to biti povezano s Avengers: Endgame filmom na neki način?                                           </p>
                                        </details>
                                    <div class="text-right">
                                        <p>15.01.2020.</p>
                                      </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                                      <div class="thumbnail">
                                        <div class="post_title">
                                          SLUGA
                                        </div>
                                        <img src="img/11.jpg" class="img-responsive" alt="negujemo" style="border-radius:8px;">
                                        <div class="caption">
                                          <p>
                                          “Marvel Studios The Eternals prikazuje uzbudljivi novi tim Super Heroja u Marvelovom Filmskom Svemiru, drevne izvanzemaljce koji su živjeli na Zemlji u tajnosti tisućama godina. Nakon tragedija u Avengers: Endgame, ne očekivana tragedija natjera ih da izađu iz sjene kako bi se ujedinili protiv najstarijeg neprijatelja čovječanstva,  The Deviants.
                                            </p>
                                          <details>

                                            <summary>Opširinije</summary>
                                          <p>Izvrsna glumačka postava uključuju Richarda Maddena kao svemoćnog Ikarisa, Gemmu Chan kao Sersi koja voli čovječanstvo, Kumaila Nanjianija kao kozmičkog Kingoa, Lauren Ridloff kao super brze Makkari, Brian Tyree Henry kao inteligentni izumitelj Phastos, Salma Hayek kao mudri i duhovni vođa Ajak, Lia McHugh kao vječno mlada Sprite, Don Lee kao moćni Gilgamesh, Barry Keoghan kao dugo rezervirani Druig i Angelina Jolie kao žestoka ratnica Thena. Kit Harrington glumi Danea Whitmana.
                                             </p>
                                          </details>
                                      <div class="text-right">
                                          <p>14.01.2020.</p>
                                        </div>
                                        </div>
                                      </div>
                                    </div>
                                    



                                    </div>
                        </div>
                        <br><br><br>
                </div>


                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                  <br><br><br>

                  <!-- Facebook -->
                     <a href="http://www.facebook.com/sharer.php?u=https://localhost/domaci3JS/main.php" target="nesto">
                         <img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
                     </a>


                     <!-- Google+ -->
                      <a href="https://plus.google.com/share?url=https://simplesharebuttons.com" target="_blank">
                          <img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
                      </a>

                      <!-- Twitter -->
                      <a href="https://twitter.com/share?url=https://simplesharebuttons.com&amp;text=Simple%20Share%20Buttons&amp;hashtags=simplesharebuttons" target="_blank">
                          <img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
                      </a>

                      <!-- Pinterest -->
                      <a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                          <img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
                      </a>
                      <br>
                      <br><br>
                              <h2>Novosti</h2>
                                  <br>
                                  <h4><a href="http://www.rodacineplex.com/repertoar" target="_blank">
                          TOP 10 FILMOVA ZA 2020. GODINU
                            <div class="sidebar_text">
                            Najbolje filmove 2020. godine. U članku se nalazi preko 80 filmova. Članak ćemo nadopunjavati kako novi filmovi budu dolazili. Klikom na naslov filma idete na njegovu cijelu recenziju. Filmove s ocjenom ispod 7 nismo stavljali na popis, a svakako će se ovdje naći po nešto za svakoga. Na popisu najboljih filmova 2019. i 2020. godine, a i najboljih filmova 2018. godine nalaze se svi filmski žanrovi, pa što god da tražite za pogledati, nešto ćete naći. Najbolji filmovi 2019. godine još se nadopunjuju filmovima, najbolji filmovi 2020. godine nam tek dolaze, ali pripremamo teren, dok su najbolji filmovi 2018. godine dodani svi. 
                          </div>
                          <hr>


                          <h4><a href="http://www.rodacineplex.com/repertoar" target="_blank">
                          TOP 10 FILMOVA ZA 2020. GODINU
                            <div class="sidebar_text">
                            Najbolje filmove 2020. godine. U članku se nalazi preko 80 filmova. Članak ćemo nadopunjavati kako novi filmovi budu dolazili. Klikom na naslov filma idete na njegovu cijelu recenziju. Filmove s ocjenom ispod 7 nismo stavljali na popis, a svakako će se ovdje naći po nešto za svakoga. Na popisu najboljih filmova 2019. i 2020. godine, a i najboljih filmova 2018. godine nalaze se svi filmski žanrovi, pa što god da tražite za pogledati, nešto ćete naći. Najbolji filmovi 2019. godine još se nadopunjuju filmovima, najbolji filmovi 2020. godine nam tek dolaze, ali pripremamo teren, dok su najbolji filmovi 2018. godine dodani svi. 
                          </div>
                          <hr>

                          <h4><a href="http://www.rodacineplex.com/repertoar" target="_blank">
                          TOP 10 FILMOVA ZA 2020. GODINU
                          </a></h4>
                          <div class="sidebar_text">
                          Najbolje filmove 2020. godine. U članku se nalazi preko 80 filmova. Članak ćemo nadopunjavati kako novi filmovi budu dolazili. Klikom na naslov filma idete na njegovu cijelu recenziju. Filmove s ocjenom ispod 7 nismo stavljali na popis, a svakako će se ovdje naći po nešto za svakoga. Na popisu najboljih filmova 2019. i 2020. godine, a i najboljih filmova 2018. godine nalaze se svi filmski žanrovi, pa što god da tražite za pogledati, nešto ćete naći. Najbolji filmovi 2019. godine još se nadopunjuju filmovima, najbolji filmovi 2020. godine nam tek dolaze, ali pripremamo teren, dok su najbolji filmovi 2018. godine dodani svi. 
                          <hr>
                  </div>
	    </div>
		</div>
    <?php
    require "korisnik/template/footer.php";
    ?>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $('.carousel').carousel({
            interval: 5000
        })
    </script>
  </body>
</html>
