<?php


if (isset($_REQUEST["idposta"])) {
    
    include('../includes/db_config.php');
    session_start();
      
        
        if (isset($_SESSION["rola"]) && $_SESSION["rola"]==1){
            
            $sql = 'UPDATE `posts` SET `status`='.mysqli_real_escape_string($connection,$_GET["klik"]).' WHERE id=' .mysqli_real_escape_string($connection, $_GET["idposta"]);
            
            if (mysqli_query($connection, $sql)) {
           
            } else {
                
            }
        }
       
    }

?>