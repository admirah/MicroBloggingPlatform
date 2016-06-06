<?php



    
    include('../includes/db_config.php');
    session_start();
    $query  = "SELECT COUNT(*) FROM comments c, posts p, users u WHERE c.postid=p.id AND p.authorid=u.id AND u.username='".mysqli_real_escape_string($connection,$_SESSION["loggedUser"])."' AND c.procitan IS NULL";
    $result = mysqli_query($connection, $query);
    if ( $user = mysqli_fetch_row($result)) {
  
        $_SESSION["notif"]=$user[0];
         echo $user[0];
        }
        
    

?>