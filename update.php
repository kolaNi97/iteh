<?php
    $knjigaUpdate;
    $knjigaID = $_GET['knjigaID'];
    if(isset($_POST['knjigaNaziv']) && isset($_POST['knjigaIzdanje']) && isset($_POST['knjigaTiraz'])  && isset($_POST['knjigaStanje']) && isset($_POST['pisac'])) {
        $knjigaUpdate = '{"knjigaNaziv": "'. $_POST['knjigaNaziv'] .'","knjigaIzdanje": "'. $_POST['knjigaIzdanje'] .'", "knjigaTiraz":"'. $_POST['knjigaTiraz'] .'", "knjigaStanje":"'. $_POST['knjigaStanje'] .'","pisacID":"'. $_POST['pisac'] .'"}';
    }
    else {
        $knjigaUpdate = '{"Greška, nisu uneti svi podaci!"}';
    }
    $url = 'http://localhost/projekat/knjiga/'. $knjigaID;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-Type: application/json'));
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($curl, CURLOPT_POSTFIELDS, $knjigaUpdate);

    $curl_odgovor = curl_exec($curl);
    curl_close($curl);
    $json_objekat = json_decode($curl_odgovor);

    if (isset($json_objekat)) {
            header("Location: izmenaBrisanje.php?poruka=$json_objekat->poruka");
    }
?>
