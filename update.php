<?php
    $filmUpdate;
    $filmID = $_GET['filmID'];
    if(isset($_POST['NazivFilma']) && isset($_POST['Trajanje']) && isset($_POST['Cena']) ) {
        $filmUpdate = '{"NazivFilma": "'. $_POST['NazivFilma'] .'","Trajanje": "'. $_POST['Trajanje'] .'", "Cena":"'. $_POST['Cena'] .'","ReziserID":"'. $_POST['Reziser'] .'"}';
    }
    else {
        $filmUpdate = '{"Greška, nisu uneti svi podaci!"}';
    }
    $url = 'http://localhost/projekat/film/'. $filmID;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $filmUpdate);

    $curl_odgovor = curl_exec($curl);
    curl_close($curl);
    $json_objekat = json_decode($curl_odgovor);

    if (isset($json_objekat)) {
            header("Location: izmenaBrisanje.php?poruka=$json_objekat->poruka");
    }
?>
