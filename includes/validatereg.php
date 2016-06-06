<?php
   include ('db_config.php');
    session_start();
    if(!empty($_SESSION["loggedUser"])) { 
        header('Location: ../index.php');
    }


$name=$_POST["name"];
    $uname =  htmlentities($_POST["username"]);

    $pword = hash("md5", htmlentities($_POST["pass"]);

$date= htmlentities($_POST["date"]);
if(!isset($_POST["web"])) $web= htmlentities($_POST["web"]); else $web="x";
   $email= htmlentities($_POST["email"]);
$ok=false;


 $query ="SELECT * FROM users WHERE username = '".$uname."' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) != 0) {
        header('Location: ../register.php?errTyp=1&name='.$name.'&userame='.$uname.'&web='.$web.'&email='.$email.'&date='.$date);
                $ok=true;
    }

if(!$ok){
      date_default_timezone_set('Europe/Sarajevo');
$sql = "INSERT INTO users (`username`, `fullname`, `password`, `email`, `dateofbirth`, `role`, `phone`, `description`) 
VALUES ('".mysqli_real_escape_string($connection,$uname)."','".mysqli_real_escape_string($connection,$name)."','".mysqli_real_escape_string($connection,$pword)."','".mysqli_real_escape_string($connection,$email)."','".mysqli_real_escape_string($connection,$date)."',2,NULL,NULL)";

if (mysqli_query($connection, $sql)) {
    
     header('Location: ../login.php?msgTyp=1');
} else {
    
}
    $errTyp = 2;  // 0-No error ; 1-Invalid password ; 3-invalid username
    
  
    

}

?>