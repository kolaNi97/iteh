<?php
	require 'flight/Flight.php';
	require 'jsonindent.php';

	Flight::register('db', 'Database', array('bioskop'));
	$json_podaci = file_get_contents("php://input");
	Flight::set('json_podaci', $json_podaci);

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
	
	Flight::route('GET /rezervacija.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {

			$db->select4(" rezervacija", ' Film.NazivFilma, Film.Trajanje, 225-count(kupovina.rezervacijaID) AS BrojSlobodnih,Film.Cena,Rezervacija.Datum,Rezervacija.RezervacijaID', "film", "FilmID", "FilmID", "kupovina", "RezervacijaID","RezervacijaID", null, null,"rezervacija.RezervacijaID");
		
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
		
		Flight::route('GET /kupovina/@id.json', function($id) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {
			$db->select2("Rezervacija", ' film.NazivFilma, rezervacija.Datum, kupovina.KupovinaID', "kupovina", "RezervacijaID", "RezervacijaID", "film","FilmID","FilmID","kupovina.KorisnikID = ". $id, null);
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
					$odgovor["poruka"] = "Uspešno ste izvršili izmenu podataka o filmu!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
				else {
					$odgovor["poruka"] = "Došlo je do greške pri pokušaju izmene podataka o filmu!";
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
					$odgovor["poruka"] = "Uspešno ste dodali nov film!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
				else {
					$odgovor["poruka"] = "Došlo je do greške pri pokušaju unosa novog filma!";
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
					$odgovor["poruka"] = "Uspešno ste rezervisali kartu! ";
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
			$odgovor["poruka"] = "Film je uspešno obrisan!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		}
		else {
			$odgovor["poruka"] = "Došlo je do greške! Film se ne može obrisati jer je zakazano prikazivanje.";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		}
	});
	Flight::route('DELETE /kupovina/@kupovinaID', function($kupovinaID) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		if($db->delete("kupovina", array("kupovinaID"),array($kupovinaID))) {
			$odgovor["poruka"] = "Rezervacija je otkazana!";
			$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
			echo $json_odgovor;
			return false;
		}
		else {
			$odgovor["poruka"] = "Došlo je do greške pri pokušaju otkazivanja rezervacije!";
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
			$JSONprikaz = '{  "cols": [{"label":"Film","type":"string"}, {"label":"Trajanje","type":"number"}], "rows":[ ';
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
			$JSONprikaz = '{  "cols": [{"label":"Film","type":"string"}, {"label":"Trajanje","type":"number"}], "rows":[ ';
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
				    "latitude":"44.772982",
				    "longitude":"20.475144",
				    "naziv":"BIOSKOP FON - Jove Ilića 154 "
				  },
				  {
				    "latitude":"44.816227",
				    "longitude":"20.438095",
				    "naziv":"BIOSKOP FON - Bulevar Mihajla Pupina 4"
				  },
				  {
				    "latitude":"44.817378",
				    "longitude":"20.508983",
				    "naziv":"BIOSKOP FON - Višnjička 84"
				  }
			]}';
		return false;
	});

	Flight::start();

$table = $db_table;
$primaryKey = 'filmID';
?>
