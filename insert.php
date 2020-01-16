<?php
    $film;
    if(isset($_POST['NazivFilma']) && isset($_POST['Trajanje']) &&  isset($_POST['Cena'])) {
        $film= '{"NazivFilma": "'. $_POST['NazivFilma'] .'","Trajanje": "'. $_POST['Trajanje'] .'", "Cena":"'. $_POST['Cena'] .'","ReziserID":"'. $_POST['Reziser'] .'"}';
    }
    else {
        $film = '{"Greška, nisu uneti svi podaci!"}';
    }

    $url = 'http://localhost/projekat/film';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $film);

    $curl_odgovor = curl_exec($curl);
    curl_close($curl);
    $json_objekat = json_decode($curl_odgovor);

    if (isset($json_objekat)) {
        header("Location: insertKnjiga.php?poruka=$json_objekat->poruka");
    }
?>
