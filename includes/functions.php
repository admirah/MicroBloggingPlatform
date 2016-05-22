<?php 
    function getFullnameByUsername($username) {
        $svikorisnici = file($_ENV['OPENSHIFT_DATA_DIR']."files/racuni.csv");
    
        foreach($svikorisnici as $korisnik) {

            $infoKorisnika = explode(",",$korisnik);

            if($infoKorisnika[1] == $username) {
                return $infoKorisnika[0];
            }

        }
        return false;

    }
function getPhoneNumber($username) {
    $sviBrojevi = file($_ENV['OPENSHIFT_DATA_DIR']."files/brojeviTelefona.csv");
    
        foreach($sviBrojevi as $broj) {

            $infoKorisnika = explode(",",$broj);

            if($infoKorisnika[0] == $username) {
                return $infoKorisnika[2];
            }

        }
        return false;
}

?>