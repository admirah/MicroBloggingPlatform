<?php
    session_start();
    if(!empty($_SESSION["loggedUser"])) { 
        header('Location: ../index.php');
    }


$name=$_POST["name"];
    $uname = $_POST["username"];

    $pword = hash("md5",$_POST["pass"]);

$date=$_POST["date"];
if(!isset($_POST["web"])) $web=$_POST["web"]; else $web="x";
   $email=$_POST["email"];
$ok=false;


 $sviRacuni = file($_ENV['OPENSHIFT_DATA_DIR']."/files/racuni.csv");
    
    foreach($sviRacuni as $racun) {
        
        $infoRacuna = explode(",",$racun);
       // echo $infoRacuna[1].$uname;
        if($infoRacuna[1] == $uname) {
        header('Location: ../register.php?errTyp=1&name='.$name.'&userame='.$uname.'&web='.$web.'&email='.$email.'&date='.$date);
                $ok=true;
            break;
        }
    }

if(!$ok){
      date_default_timezone_set('Europe/Sarajevo');
$red=htmlentities($name) . "," . htmlentities($uname). "," . htmlentities($pword). "," . htmlentities($date). "," . htmlentities($email). "," . htmlentities($web)."\r\n";
    $errTyp = 2;  // 0-No error ; 1-Invalid password ; 3-invalid username
    
    $sviRacuni = file_get_contents($_ENV['OPENSHIFT_DATA_DIR']."/files/racuni.csv"); 
   $sviRacuni.=$red;
   file_put_contents($_ENV['OPENSHIFT_DATA_DIR']."/files/racuni.csv",$sviRacuni);
   
    
 header('Location: ../login.php?msgTyp=1');
}

?>