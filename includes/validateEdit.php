<?php
   include ('db_config.php');
    session_start();
   if(!isset($_SESSION["loggedUser"])) header('Location: login.php');
$query ="SELECT * FROM users WHERE username = '".mysqli_real_escape_string($connection,$_SESSION["loggedUser"])."' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_row($result);
          
            if($user[6]!=1) header('Location: index.php');
        }

$name= htmlentities($_POST["name"]);
    $uname =  htmlentities($_POST["username"]);
$id=$_POST["userid"];
    $pword = htmlentities( $_POST["pass"]);

$date= htmlentities($_POST["date"]);

   $email= htmlentities($_POST["email"]);
$ok=false;

 $query ="SELECT * FROM users WHERE username = '".mysqli_real_escape_string($connection,$uname)."' AND id<>".mysqli_real_escape_string($connection,$id)." LIMIT 1";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) != 0) {
        header('Location: ../edituser.php?errTyp=1&&userid='.$id);
                $ok=true;
    }

if(!$ok){
    if($pword=="") {$sql ='UPDATE `users` SET `username`="'.mysqli_real_escape_string($connection,$uname).'",`fullname`="'.mysqli_real_escape_string($connection,$name).'",`email`="'.mysqli_real_escape_string($connection,$email).'",`dateofbirth`="'.mysqli_real_escape_string($connection,$date).'" 
WHERE id='.$id;}
    else{
$sql ='UPDATE `users` SET `username`="'.mysqli_real_escape_string($connection,$uname).'",`fullname`="'.mysqli_real_escape_string($connection,$name).'",`password`="'.mysqli_real_escape_string($connection,$pword).'",`email`="'.mysqli_real_escape_string($connection,$email).'",`dateofbirth`="'.mysqli_real_escape_string($connection,$date).'" 
WHERE id='.$id;}

if (mysqli_query($connection, $sql)) {
  
     header('Location: ../users.php');
} else {

}
   
  
    

}

?>