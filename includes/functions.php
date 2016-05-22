<?php 
    function getFullnameByUsername($username) {
        $svikorisnici = file("files/racuni.csv");
    
        foreach($svikorisnici as $korisnik) {

            $infoKorisnika = explode(",",$korisnik);

            if($infoKorisnika[1] == $username) {
                return $infoKorisnika[0];
            }

        }
        return false;

    }
function getPhoneNumber($username) {
    $sviBrojevi = file("files/brojeviTelefona.csv");
    
        foreach($sviBrojevi as $broj) {

            $infoKorisnika = explode(",",$broj);

            if($infoKorisnika[0] == $username) {
                return $infoKorisnika[2];
            }

        }
        return false;
}

?>