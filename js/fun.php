<?php


if (isset($_REQUEST["idposta"])) {
    
    include('../includes/db_config.php');
    session_start();
    $query  = "SELECT u.username FROM users u, posts p, comments c WHERE c.commentid = " . mysqli_real_escape_string($connection,$_REQUEST["idposta"]) . " AND c.postid=p.id AND p.authorid=u.id LIMIT 1";
    $result = mysqli_query($connection, $query);
    if ( $user = mysqli_fetch_row($result) and $user[0]==$_SESSION["loggedUser"]) {
       
        
        if ($user && $user[0] == $_SESSION["loggedUser"]) {
            
            $sql = 'UPDATE `comments` SET `procitan`=1 WHERE commentid=' . mysqli_real_escape_string($connection,$_GET["idposta"]) . ' AND procitan IS NULL';
            
            if (mysqli_query($connection, $sql)) {
                
            } else {
                
            }
        }
       
    }
}
?>