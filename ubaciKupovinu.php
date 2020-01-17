<?php
require 'php/config.php';
    $kupovina;
$rezervacijaID = $_GET['rezervacijaID'];


//$url='http://localhost/projekat/rezervacija/'.$rezervacijaID;

$korisnik =$_SESSION['username'];
$korisnikID = $_SESSION['id'];

//$datum = date("Y/m/d");

    if(isset($rezervacijaID) && isset($korisnikID) ) {
        $kupovina= '{"rezervacijaID": "'. $rezervacijaID .'","korisnikID": "'.  $korisnikID .'"}';
    }
    else {
        $kupovina = '{"Greška, nisu uneti svi podaci!"}';
    }
    header("Location: pom.php");

    $url = 'http://localhost/projekat/rezervacija';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $kupovina);

    $curl_odgovor = curl_exec($curl);
    curl_close($curl);
    $json_objekat = json_decode($curl_odgovor);

    if (isset($json_objekat)) {
        header("Location: rezervacija.php?poruka=$json_objekat->poruka");
    }
?>
