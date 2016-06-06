<?php
include('includes/functions.php');
?>
    <?php
session_start();
$sendMeToIndex = false;
include('includes/db_config.php');
/*if (isset($_POST['sakrij'])) {

$user=dajIdUsera($_SESSION["loggedUser"]);
if($user==$post[3]) oznaciProcitanim($_GET["postid"],2);
}*/if(!isset($_SESSION["loggedUser"])) header('Location: login.php');
if (isset($_POST['post'])) {
    date_default_timezone_set('Europe/Sarajevo');
    $postic = htmlentities($_POST['newEntry']);
    if (strlen($postic) < 201) {
        $sql = "INSERT INTO `comments`(`authorid`, `content`, `postid`,`commentid`,`date`,`status`) VALUES ('" . $_SESSION["loggedId"] . "','" . mysqli_real_escape_string($connection,$_POST['newEntry']) . "','" . mysqli_real_escape_string($connection,$_POST['idposta']) . "','" . mysqli_real_escape_string($connection,$_POST['idcom']) . "',NOW(),0)";
        if (mysqli_query($connection, $sql)) {
            
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    }
}
if (isset($_POST['obrisiKom'])&& isset($_GET["comid"]) ) {
   
    date_default_timezone_set('Europe/Sarajevo');
    $postic = $_GET['comid'];
    
    $sql = "DELETE FROM `comments` WHERE id=" . $postic;
    if (mysqli_query($connection, $sql)) {
       
    } else {
      
    }
}

if (!empty($_SESSION["loggedUser"])) {
    
    $query  = "SELECT * FROM users WHERE username = '" .mysqli_real_escape_string($connection, $_SESSION["loggedUser"]) . "' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) != 0) {
        $user                 = mysqli_fetch_row($result);
        $_SESSION["loggedId"] = $user[0];
        $_SESSION["rola"]     = $user[6];
    }
}
if (isset($_POST['post1'])) {
    date_default_timezone_set('Europe/Sarajevo');
    $postic =  htmlentities($_POST['newEntry']);
    if (strlen($postic) < 201) {
        $sql = "INSERT INTO `comments`(`authorid`, `content`, `postid`,`commentid`,`date`,`status`) VALUES ('" . mysqli_real_escape_string($connection,$_SESSION["loggedId"]). "','" . mysqli_real_escape_string($connection, htmlentities($_POST['newEntry'])) . "','" . mysqli_real_escape_string($connection,$_POST['idposta']) . "',NULL,NOW(),0)";
        if (mysqli_query($connection, $sql)) {
            
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    }
}



if (isset($_GET["postid"])) {
    $post      = dajPost($_GET["postid"]);
    $komentari = dajKomentare($_GET["postid"]);
    if (isset($_SESSION["loggedUser"])) {
        $user = dajIdUsera($_SESSION["loggedUser"]);
        if ($user == $post[3])
            oznaciProcitanim($_GET["postid"], 1);
    }
} else
    $sendMeToIndex = true;

if (!empty($_SESSION["loggedUser"]) && $sendMeToIndex) {
    //   header('Location: index.php');
}


?>
        

        <!doctype html>
        <html>

        <head>
            <title>
                <?php
echo "Comments";
?>
            </title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="stylesheet" type="text/css" href="css/logo.css">
            <script src="js/validation.js"></script>
            <script src="js/script.js"></script>
            <meta charset="utf-8">
        </head>

        <body>

            <?php
include 'includes/navbar.php';
?>

                <div id="posts">
                  

                      
                            <br>
                            <?php


$objavaUNizu = $post;
// echo $infoRacuna[1].$uname;

echo '<div class="post">' . '<div class="left">';
if (file_exists('images/users/' . $objavaUNizu[0] . '.jpg'))
    echo '<img alt="photo" class="photo" src="' . 'images/users/' . $objavaUNizu[0] . '.jpg' . '">';
echo '</div><div class="right">' . '<a class="username" href="profile.php?username=' . $objavaUNizu[0] . '">' . getFullnameByUsername($objavaUNizu[0]) . '</a>' . '<div class="date">' . $objavaUNizu[2] . '</div><div class="datepomocni">' . $objavaUNizu[2] . '</div><div class="proteklo">';
echo '</div><div class="content">' . $objavaUNizu[1] . '</div></div></div>
';

echo '<div class="post">';
                        
foreach ($komentari as $kom) {
    if ($kom[4] == null) {
        
          
        echo '<div class="right rightpost">' . '<a class="username usernamepost" href="#">' . $kom[0] . '</a>';
        if (isset($_SESSION["rola"] ) && $_SESSION["rola"] == 1) {echo ' <form style="float:right;" method="post" action="post.php?postid='.$kom[5].'&&comid=' . $kom[3] . '">
                                                 <input type="submit" name="obrisiKom" value="Delete"></form>';
    }
        echo '<div class="datep">' . $kom[2] . '</div><div class="content">' . $kom[1];
        echo '</div></div>';
        echo '<table style="padding:10px;"><tr><td>';
        echo '<form  onsubmit="sakrij(' . $kom[3] . '); return false;"><input type="submit" value="&darr;';
        if($objavaUNizu[0]==$_SESSION["loggedUser"])  echo '(+'.$kom[6].')"></form></td><td>';
        else echo '"></form></td><td>';
       
       if ($objavaUNizu[4] == 0) {     echo '<form  onsubmit="return odgovori(' . $kom[3] . '); "><input type="submit" value="Odgovori" ></form>';
            echo '</td></tr></table>';                  
            echo '<form action="post.php?postid=' . $kom[5] . '" method="post" class="' . $kom[3] . 'dugme" style="display: none;">
            <input class="none" type="text" name="idposta" value="' . $kom[5] . '">
             <input class="none" type="text" name="idcom" value="' . $kom[3] . '">
            
            <textarea class="podkomentarunos" rows="3" name="newEntry" maxlength="200"></textarea>
                                    <input class="contentsubmit podkomsub" type="submit" Value="Post" name="post"></form>';
    } }else {
        
     
        echo '<div  class="right podpost ' . $kom[4] . '" style="display: none;">' . '<a class="username usernamepost" href="#">' . $kom[0] . '</a>';
        if (isset($_SESSION["rola"] ) && $_SESSION["rola"] == 1) {echo ' <form style="float:right;" method="post" action="post.php?postid='.$kom[5].'&&comid=' . $kom[3] . '">
                                                 <input type="submit" name="obrisiKom" value="Delete"></form>';
    }
        echo '<div class="date">' . $kom[2] . '</div><div class="content">' . $kom[1];
        echo '</div>';
        
        
        echo '</div>';
    }
} 

    if ($objavaUNizu[4] == 0) { echo '<form action="post.php?postid=' . $_GET["postid"] . '" method="post">
            <input class="none" type="text" name="idposta" value="' . $_GET["postid"] . '">
            <textarea class="komentarunos" rows="3" name="newEntry" maxlength="200"></textarea>
                                    <input class="contentsubmit podkomsub" type="submit" Value="Post" name="post1"></form>';
                              }
echo '</div>';

?>

                </div>



        </body>

        </html>