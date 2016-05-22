<?php
    session_start();
    if(!empty($_SESSION["loggedUser"])) { 
        header('Location: ../index.php');
    }
    $uname = $_POST["uname"];
    $pword = $_POST["pword"];
    $errTyp = 2;  // 0-No error ; 1-Invalid password ; 3-invalid username
    
    $sviRacuni = file($_ENV['OPENSHIFT_DATA_DIR']."/files/racuni.csv");
    
    foreach($sviRacuni as $racun) {
        
        $infoRacuna = explode(",",$racun);
        
        if($infoRacuna[1] == $uname) {
            
            if($infoRacuna[2] == hash("md5",$pword)) {
                $_SESSION["loggedUser"] = $uname;
                $errTyp = 0;
                break;
            }
            else {
                
                $errTyp = 1;
            }
        }
        
    }
  if($errTyp==0)  header('Location: ../index.php');
else if($errTyp==1)  header('Location: ../login.php?errTyp=1');
   else header('Location: ../login.php?errTyp=2');
    

?>