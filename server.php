<?php
	require 'flight/Flight.php';
	require 'jsonindent.php';

	Flight::register('db', 'Database', array('bioskop'));
	$json_podaci = file_get_contents("php://input");
	Flight::set('json_podaci', $json_podaci);

	//vrati sve filmove
	Flight::route('GET /film.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
 
		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {
			$db->select(" film ", ' * ', "reziser", "reziserID", "reziserID", null, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"film":'. indent($json_niz) .' }';
			return false;
		}
		else {
			$pretraga = $_GET['search'];
			$db->select(" film ", ' * ', "reziser", "reziserID", "reziserID", " naziv LIKE '%". $pretraga ."%' " , null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"film":'. indent($json_niz) .' }';
			return false;
		}
	});
	//sve rezervacije sa korisnicima i knjigama
	Flight::route('GET /rezervacija.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {

			$db->select3(" rezervacija", 'Film.NazivFilma, Film.Trajanje, 225-count(kupovina.rezervacijaID) AS BrojSlobodnih,Film.Cena,Rezervacija.Datum,Rezervacija.RezervacijaID', "film", "filmID", "filmID", "kupovina", "rezervacijaID","rezervacijaID", null, null,"rezervacijaID");
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"rezervacija":'. indent($json_niz) .' }';
			return false;
		}
		
	});
	Flight::route('GET /kupovina.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {

			$db->select3(" kupovina", 'Film.NazivFilma, Film.Trajanje, Sala.BrojMesta-count(rezervacija.filmID) AS BrojSlobodnih,Film.Cena,Rezervacija.Datum,Rezervacija.RezervacijaID', "film", "filmID", "filmID", "sala", "salaID","salaID", null, null,null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"kupovina":'. indent($json_niz) .' }';
			return false;
		}
		
	});


	//vrati knjige odredjenog pisca
		Flight::route('GET /film/@reziserID.json', function($reziserID) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {
			$db->select(" film ", ' * ', "reziser", "ReziserID", "ReziserID", "Film.ReziserID = ". $reziserID, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"film":'. indent($json_niz) .' }';
			return false;
		}
		else {
			$pretraga = $_GET['search'];
			$db->select(" film ", ' * ', "reziser", "ReziserID", "ReziserID", " NazivFilma LIKE '%". $pretraga ."%' " , null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"film":'. indent($json_niz) .' }';
			return false;
		}
	});
		//vrati rezervacije odredjenog korisnika
		Flight::route('GET /kupovina/@id.json', function($id) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {
			$db->select2("Rezervacija", ' film.NazivFilma, rezervacija.Datum, kupovina.KupovinaID', "kupovina", "RezervacijaID", "RezervacijaID", "film","FilmID","FilmID","kupovina.KorisnikID = ". $id, null);
			//$db->select("kupovina", "*", null, null, null, "kupovina.KorisnikID = ".$id);
			//select rezervacija.Datum, film.NazivFilma from rezervacija join kupovina on(rezervacija.RezervacijaID=kupovina.RezervacijaID) join film on (rezervacija.FilmID=film.FilmID) where kupovina.KorisnikID=35 
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}

			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"kupovina":'. indent($json_niz) .' }';
			return false;
		}
		else {
			$pretraga = $_GET['search'];
			$db->select(" kupovina ", ' * ', "korisnici", "korisnik", "username", "kupovina.korisnik = ". $username, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"kupovina":'. indent($json_niz) .' }';
			return false;
		}
	});

	Flight::route('GET /film1/@filmID.json', function($filmID) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		$db->select(" film ", ' * ',  "reziser", "ReziserID", "ReziserID", "film.FilmID = ". $filmID, null);
		$red = $db->getResult()->fetch_object();
		$json_niz = json_encode($red,JSON_UNESCAPED_UNICODE);
		echo indent($json_niz);
		return false;
	});

		

//vrati pisca
	Flight::route('GET /reziser.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);
		$db->select(" reziser ", '*', "", "", "", null, null);
		$niz = array();
		while($red = $db->getResult()->fetch_object()) {
			$niz[] = $red;
		}
		$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
		echo '{'.'"reziser":'. indent($json_niz) .' }';
		return false;
	});
	//vrati korisnika
Flight::route('GET /korisnik.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);
		$db->select(" korisnici ", '*', "", "", "", null, null);
		$niz = array();
		while($red = $db->getResult()->fetch_object()) {
			$niz[] = $red;
		}
		$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
		echo '{'.'"korisnik":'. indent($json_niz) .' }';
		return false;
	});
	Flight::route('PUT /film/@filmID', function($filmID) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if($podaci == null) {
			$odgovor["poruka"] = "Podaci nisu prosleđeni!";
			$json_odgovor = json_encode($odgovor);
			echo $json_odgovor;
		}
		else {
			if(!property_exists($podaci,'NazivFilma') || !property_exists($podaci,'Trajanje') || !property_exists($podaci,'Cena')  || !property_exists($podaci,'ReziserID')) {
				$odgovor["poruka"] = "Nisu prosleđeni odgovarajući podaci!";
				$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			}
			else {
				if($db->update("film", $filmID, array('NazivFilma','Trajanje','ReziserID','Cena'),array($podaci->NazivFilma, $podaci->Trajanje,$podaci->ReziserID, $podaci->Cena))) {
					$odgovor["poruka"] = "Uspešno ste izvršili izmenu podataka o knjizi!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
				else {
					$odgovor["poruka"] = "Došlo je do greške pri pokušaju izmene podataka o knjizi!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
			}
		}
	});

	Flight::route('POST /film', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if($podaci == null) {
		$odgovor["poruka"] = "Podaci nisu prosleđeni!";
		$json_odgovor = json_encode($odgovor);
		echo $json_odgovor;
		return false;
		}
		else {
			if(!property_exists($podaci,'NazivFilma') || !property_exists($podaci,'Trajanje') || !property_exists($podaci,'Cena') ||  !property_exists($podaci,'ReziserID')) {
				$odgovor["poruka"] = "Nisu uneti ispravni podaci!";
				$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			}
			else {
				$podaci_query = array();
				foreach($podaci as $k=>$v) {
					$v = "'". $v ."'";
					$podaci_query[$k] = $v;
				}
				if($db->insert("film","NazivFilma,Trajanje,ReziserID,Cena",array($podaci_query['NazivFilma'], $podaci_query['Trajanje'],$podaci_query['ReziserID'],$podaci_query['Cena']))) {
					$odgovor["poruka"] = "Uspešno ste dodali novu knjigu!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
				else {
					$odgovor["poruka"] = "Došlo je do greške pri pokušaju unosa nove knjige!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
			}
		}
	});
	Flight::route('POST /rezervacija', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if($podaci == null) {
		$odgovor["poruka"] = "Podaci nisu prosleđeni!";
		$json_odgovor = json_encode($odgovor);
		echo $json_odgovor;
		return false;
		}
		else {
			if(!property_exists($podaci,'rezervacijaID') || !property_exists($podaci,'korisnikID') ) {
				$odgovor["poruka"] = "Nisu uneti ispravni podaci!";
				$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			}
			else {
				$podaci_query = array();
				foreach($podaci as $k=>$v) {
					$v = "'". $v ."'";
					$podaci_query[$k] = $v;
				}
				if($db->insert("kupovina",'korisnikID,rezervacijaID',array($podaci_query['korisnikID'], $podaci_query['rezervacijaID']))) {
					$odgovor["poruka"] = "Uspešno ste kupili knjigu! ";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
				else {
					$odgovor["poruka"] = "Već ste rezervisali tu projekciju!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
			}
		}
	});

	Flight::route('DELETE /film/@filmID', function($filmID) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		if($db->delete("film", array("filmID"),array($filmID))) {
			$odgovor["poruka"] = "Knjiga je uspešno obrisana!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		}
		else {
			$odgovor["poruka"] = "Došlo je do greške pri pokušaju brisanja knjige!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		}
	});
	Flight::route('DELETE /kupovina/@kupovinaID', function($kupovinaID) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		if($db->delete("kupovina", array("kupovinaID"),array($kupovinaID))) {
			$odgovor["poruka"] = "Kupovina je otkazana!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		}
		else {
			$odgovor["poruka"] = "Došlo je do greške pri pokušaju otkazivanja kupovine!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		}
	});

	Flight::route('GET /vizuelizacija.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		if (!isset($_GET['reziser'])) {
			$db->select(" film ", ' * ', "reziser", "ReziserID", "ReziserID", null, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			$JSONprikaz = '{  "cols": [{"label":"Knjiga","type":"string"}, {"label":"Stanje","type":"number"}], "rows":[ ';
			foreach($niz as $key => $value) {
				$JSONprikaz = $JSONprikaz .'{"c":[{"v":"'. $value->NazivFilma .'"},{"v":'. $value->Trajanje .'}]},';
			}
			echo $JSONprikaz .']}';
			return false;
		}
		else {
			$reziser = $_GET['reziser'];
			$db->select(" film ", ' * ', "reziser", "reziserID", "reziserID", "reziser.ReziserID=". $reziser, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			$JSONprikaz = '{  "cols": [{"label":"Knjiga","type":"string"}, {"label":"Stanje","type":"number"}], "rows":[ ';
			foreach($niz as $key => $value) {
				$JSONprikaz = $JSONprikaz .'{"c":[{"v":"'. $value->NazivFilma .'"},{"v":'. $value->Trajanje .'}]},';
			}
			echo $JSONprikaz .']}';
			return false;
		}
	});

	Flight::route('GET /lokacije.json', function(){
		header("Content-Type: application/json; charset=utf-8");

		echo  '{"marker":[
				  {
				    "latitude":"44.8065155",
				    "longitude":"20.4590829",
				    "naziv":"BookCorner1 - Kneza Miloša 43 "
				  },
				  {
				    "latitude":"44.8057246",
				    "longitude":"20.4741383",
				    "naziv":"BookCorner2 - Bulevar Kralja Aleksandra 53"
				  },
				  {
				    "latitude":"44.7812137",
				    "longitude":"20.4672414",
				    "naziv":"BookCorner3 - Bulevar Oslobođenja 219"
				  },
				  {
				    "latitude":"44.7915081",
				    "longitude":"20.478071",
				    "naziv":"BookCorner4 - Gospodara Vučića 78"
				  },
				  {
				    "latitude":"44.8132988",
				    "longitude":"20.4313796",
				    "naziv":"BookCorner5 - Bulevar Mihajla Pupina 17"
				  }
			]}';
		return false;
	});

	Flight::start();



                      // header('Content-Type: application/json; charset=utf-8_croatian_ci');
$table = $db_table;
$primaryKey = 'knjigaID';

/*$columns = array(
array(
        'db' => 'knjigaID',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row ) {
            return $d;
        }
      ),
          array( 'db' => 'knjigaID', 'dt' => 0 ),
          array( 'db' => 'knjigaNaziv',  'dt' => 1 ),
          array( 'db' => 'knjigaIzdanje',   'dt' => 2 ),
          array( 'db' => 'knjigaTiraz',  'dt' => 3 ),
          array( 'db' => 'knjigaCena',  'dt' => 4 ),
          array( 'db' => 'knjigaStanje',  'dt' => 5 ),
          array( 'db' => 'pisacID',   'dt' => 6 )
);
$sql_details = array(
    'user' => $$mysql_user,
    'pass' => $mysql_password,
    'db'   => $mysql_db,
    'host' => $mysql_server
);
require( 'DataTables-1.10.10/examples/server_side/scripts/ssp.class.php' );

*/
?>
