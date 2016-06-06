<?php
    include ('db_config.php');
    session_start();
    if(!empty($_SESSION["loggedUser"])) { 
        header('Location: ../index.php');
    }
    $uname = strtolower( htmlentities($_POST["uname"]));
    $pword =  htmlentities($_POST["pword"]);
    $errTyp = 2;  // 0-No error ; 1-Invalid password ; 3-invalid username
    
    $query ="SELECT * FROM users WHERE username = '".mysqli_real_escape_string($connection,$uname)."' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_row($result);
        if($user[3] != hash("md5",$pword)) {
            var_dump($user);
            $errTyp = 1;
            header('Location: ../login.php?errTyp=1');
        }
        else {
            $errTyp = 0;
            $_SESSION["loggedUser"] = $user[1];
            if($user[6]==1) header('Location: ../index.php');
            else header('Location: ../index.php');
        }
        
    }
    
  if($errTyp==2) header('Location: ../login.php?errTyp=2');
    
mysqli_close($connection);
?>