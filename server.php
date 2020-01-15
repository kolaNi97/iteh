<?php
	require 'flight/Flight.php';
	require 'jsonindent.php';

	Flight::register('db', 'Database', array('knjizara'));
	$json_podaci = file_get_contents("php://input");
	Flight::set('json_podaci', $json_podaci);

	//vrati sve knjige
	Flight::route('GET /knjiga.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {
			$db->select(" knjiga ", ' * ', "pisac", "pisacID", "pisacID", null, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"knjiga":'. indent($json_niz) .' }';
			return false;
		}
		else {
			$pretraga = $_GET['search'];
			$db->select(" knjiga ", ' * ', "pisac", "pisacID", "pisacID", " knjigaNaziv LIKE '%". $pretraga ."%' " , null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"knjiga":'. indent($json_niz) .' }';
			return false;
		}
	});
	//sve rezervacije sa korisnicima i knjigama
	Flight::route('GET /kupovina.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {
			$db->select2(" kupovina", ' * ', "knjiga", "knjigaID", "knjigaID", "korisnici", "korisnik","username", null, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"kupovina":'. indent($json_niz) .' }';
			return false;
		}
		
	});
Flight::route('GET /kupovina.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		
			$db->select(" kupovina ", ' * ', "knjiga", "knjigaID", "knjigaID", null, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"kupovina":'. indent($json_niz) .' }';
			return false;
		
	});
	//vrati knjige odredjenog pisca
		Flight::route('GET /knjiga/@pisacID.json', function($pisacID) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {
			$db->select(" knjiga ", ' * ', "pisac", "pisacID", "pisacID", "knjiga.pisacID = ". $pisacID, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"knjiga":'. indent($json_niz) .' }';
			return false;
		}
		else {
			$pretraga = $_GET['search'];
			$db->select(" knjiga ", ' * ', "pisac", "pisacID", "pisacID", " knjigaNaziv LIKE '%". $pretraga ."%' " , null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			echo '{'.'"knjiga":'. indent($json_niz) .' }';
			return false;
		}
	});
		//vrati rezervacije odredjenog korisnika
		Flight::route('GET /kupovina/@username.json', function($username) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);

		if(!isset($_GET['search'])) {
			$db->select(" kupovina ", ' * ', "korisnici", "korisnik", "username", "kupovina.korisnik = '". $username."'", null);
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

	Flight::route('GET /knjige/@knjigaID.json', function($knjigaID) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();
		$db->select(" knjiga ", ' * ',  "pisac", "pisacID", "pisacID", "knjiga.knjigaID = ". $knjigaID, null);
		$red = $db->getResult()->fetch_object();
		$json_niz = json_encode($red,JSON_UNESCAPED_UNICODE);
		echo indent($json_niz);
		return false;
	});

		

//vrati pisca
	Flight::route('GET /pisac.json', function() {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		$podaci_json = Flight::get("json_podaci");
		$podaci = json_decode($podaci_json);
		$db->select(" pisac ", '*', "", "", "", null, null);
		$niz = array();
		while($red = $db->getResult()->fetch_object()) {
			$niz[] = $red;
		}
		$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
		echo '{'.'"pisac":'. indent($json_niz) .' }';
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
	Flight::route('PUT /knjiga/@knjigaID', function($knjigaID) {
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
			if(!property_exists($podaci,'knjigaNaziv') || !property_exists($podaci,'knjigaIzdanje') || !property_exists($podaci,'knjigaTiraz') ||  !property_exists($podaci,'knjigaStanje') || !property_exists($podaci,'pisacID')) {
				$odgovor["poruka"] = "Nisu prosleđeni odgovarajući podaci!";
				$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
				echo $json_odgovor;
				return false;
			}
			else {
				if($db->update("knjiga", $knjigaID, array('knjigaNaziv','knjigaIzdanje','knjigaTiraz','knjigaStanje','pisacID'),array($podaci->knjigaNaziv, $podaci->knjigaIzdanje,$podaci->knjigaTiraz, $podaci->knjigaStanje,$podaci->pisacID))) {
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

	Flight::route('POST /knjiga', function() {
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
			if(!property_exists($podaci,'knjigaNaziv') || !property_exists($podaci,'knjigaIzdanje') || !property_exists($podaci,'knjigaTiraz') ||  !property_exists($podaci,'knjigaStanje') || !property_exists($podaci,'pisacID')) {
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
				if($db->insert("knjiga","knjigaNaziv,knjigaIzdanje,knjigaTiraz,knjigaStanje,pisacID",array($podaci_query['knjigaNaziv'], $podaci_query['knjigaIzdanje'],$podaci_query['knjigaTiraz'],$podaci_query['knjigaStanje'],$podaci_query['pisacID']))) {
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
	Flight::route('POST /kupovina', function() {
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
			if(!property_exists($podaci,'knjigaID') || !property_exists($podaci,'korisnik') || !property_exists($podaci,'datum') ) {
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
				if($db->insert("kupovina","knjigaID,korisnik,datum",array($podaci_query['knjigaID'], $podaci_query['korisnik'],$podaci_query['datum']))) {
					$odgovor["poruka"] = "Uspešno ste kupili knjigu! ";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
				else {
					$odgovor["poruka"] = "Došlo je do greške prilikom kupovine!";
					$json_odgovor = json_encode($odgovor,JSON_UNESCAPED_UNICODE);
					echo $json_odgovor;
					return false;
				}
			}
		}
	});

	Flight::route('DELETE /knjiga/@knjigaID', function($knjigaID) {
		header("Content-Type: application/json; charset=utf-8");
		$db = Flight::db();

		if($db->delete("knjiga", array("knjigaID"),array($knjigaID))) {
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

		if (!isset($_GET['pisac'])) {
			$db->select(" knjiga ", ' * ', "pisac", "pisacID", "pisacID", null, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			$JSONprikaz = '{  "cols": [{"label":"Knjiga","type":"string"}, {"label":"Stanje","type":"number"}], "rows":[ ';
			foreach($niz as $key => $value) {
				$JSONprikaz = $JSONprikaz .'{"c":[{"v":"'. $value->knjigaNaziv .'"},{"v":'. $value->knjigaStanje .'}]},';
			}
			echo $JSONprikaz .']}';
			return false;
		}
		else {
			$pisac = $_GET['pisac'];
			$db->select(" knjiga ", ' * ', "pisac", "pisacID", "pisacID", "knjiga.pisacID=". $pisac, null);
			$niz = array();
			while($red = $db->getResult()->fetch_object()) {
				$niz[] = $red;
			}
			$json_niz = json_encode($niz,JSON_UNESCAPED_UNICODE);
			$JSONprikaz = '{  "cols": [{"label":"Knjiga","type":"string"}, {"label":"Stanje","type":"number"}], "rows":[ ';
			foreach($niz as $key => $value) {
				$JSONprikaz = $JSONprikaz .'{"c":[{"v":"'. $value->knjigaNaziv .'"},{"v":'. $value->knjigaStanje .'}]},';
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
