<?php
include('includes/db_config.php');
include('includes/functions.php');
?>
    <?php
session_start();
$_SESSION['abecedno'] = 1;



/* if(isset($_SESSION['abecedno']) && isset($_SESSION['abecedno'])==2)){
usort($sveObjave, "cmp");


}*/
if (isset($_POST['post'])) {
    $postic =  htmlentities($_POST['noviUnos']);
     $x=0;
    if(isset($_POST["kom"]) && $_POST["kom"]=="on") $x=1;
  
    
    if (strlen($postic) < 201) {
        $sql = "INSERT INTO `posts`(`authorid`, `content`, `dateposted`, `status`) VALUES ('" . mysqli_real_escape_string($connection,$_SESSION["loggedId"]) . "','" . mysqli_real_escape_string($connection, htmlentities($_POST['noviUnos'])) . "',NOW(),".mysqli_real_escape_string($connection,$x).")";
        if (mysqli_query($connection, $sql)) {
         
            
            
        } else {
            
        }
    }
    
    
}
if (isset($_POST['obrisiPost'])&& isset($_GET["postid"]) ) {
   
    date_default_timezone_set('Europe/Sarajevo');
    $postic = $_GET['postid'];
    
    $sql = "DELETE FROM `posts` WHERE id=" . mysqli_real_escape_string($connection,$postic);
    if (mysqli_query($connection, $sql)) {
      
        
    } else {
        
    }
}




?>

        <!DOCTYPE html>
        <html>

        <head>
            <title>
                Home

            </title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="stylesheet" type="text/css" href="css/logo.css">
            <script src="js/script.js"></script>
            <script src="js/validation.js"></script>
            <meta charset="utf-8">
        </head>

        <body>
            
            <?php
include 'includes/navbar.php';
?>
<div class="date datenone"></div>

                <div id="posts">
                    <?php

if (!empty($_SESSION["loggedUser"])) {
    
    $query  = "SELECT * FROM users WHERE username = '" . mysqli_real_escape_string($connection,$_SESSION["loggedUser"]) . "' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) != 0) {
        $user                 = mysqli_fetch_row($result);
        $_SESSION["loggedId"] = $user[0];
        $_SESSION["rola"]     = $user[6];
    }
    $filename = 'images/users/' . $_SESSION['loggedUser'] . '.jpg';
    if (file_exists($filename)) {
        $postoji = 1;
    } else {
        $postoji = 0;
    }
    
?>
                        
                           
                           <div class="post">
                            <form  onsubmit="return indexValidation()" action="index.php" method="post">
                                <div class="left">
                                    <?php
    if ($postoji == 1) {
?><img alt="photo" class="photo" src="images/users/<?php
        echo $_SESSION["loggedUser"];
?>.jpg">
                                        <?php
    }
?>
                                </div>
                                <div class="right">
                                    <a class="username" href="#">
                                        <?php
    echo getFullnameByUsername($_SESSION["loggedUser"]);
?>
                                    </a>

                                    <textarea class="contentpost" name="noviUnos" rows="3" maxlength="200"></textarea>
                                    <input type="checkbox" title="Approve comments" name="kom"> Disable comments
                                    <input class="contentsubmit" name="post" type="submit" title="Post">
                                </div>
                            </form>
                        </div>
                        <?php
}
?>






                            <div class="selectbutton">
                                <form  action="index.php"  method="get">
                                    <input type="submit" name="abecedno" value="ABC">

                                    <input type="submit" value="Date" name="abecedno">
                                    <select onchange="show(value)">
                                        <option value='sve'> All</option>
                                        <option value='danas'> Today</option>
                                        <option value='sedam'>Week</option>
                                        <option value='mjesec'>Month</option>
                                    </select>
                                </form>

                            </div>


                            <!-- OBJAVE -->

                            <?php
$sveObjave = getObjave();
if (isset($_GET['abecedno']) && $_GET['abecedno'] == "ABC")
 $sveObjave = getObjaveABC();

while ($objavaUNizu = mysqli_fetch_row($sveObjave)) {
    echo '<div class="post">' . '<div class="left">';
    if (file_exists('images/users/' . $objavaUNizu[0] . '.jpg'))
        echo '<img alt="photo" class="photo" src="' . 'images/users/' . $objavaUNizu[0] . '.jpg' . '">';
    echo '</div><div class="right">' . '<a class="username" href="profile.php?username=' . $objavaUNizu[0] . '">' . $objavaUNizu[0]. '</a>' ;
   if(isset($_SESSION["loggedUser"] ) && $objavaUNizu[0]==$_SESSION["loggedUser"])    echo '<a class="username" href="post.php?postid=' . $objavaUNizu[3] . '"> +(' . $objavaUNizu[5]. ')</a>'; 
      echo  '<div class="date">' . $objavaUNizu[2] . '</div><div class="datepomocni">' . $objavaUNizu[2] . '</div><div class="proteklo">';
    echo '</div><a class="username content" href="post.php?postid=' . $objavaUNizu[3] . '">' . $objavaUNizu[1] . '</a></div>';
   if (isset($_SESSION["rola"] ) && $_SESSION["rola"] == 1) {
      echo '<table class="floatright">
           <tr> <td>';
           echo '<input type="checkbox" name="odobrikom"';
       if ($objavaUNizu[4]==1) echo 'checked="on"';
       
           echo 'onclick="odobriKomentare(' . $objavaUNizu[3] . ',this)">Disable comments';

       echo '</td><td>';
        echo ' <form method="post" action="index.php?postid=' . $objavaUNizu[3] . '">
                                                 <input type="submit" name="obrisiPost" value="Delete"></form>';
  echo' </td>     </tr>
       </table>';
    }
    echo '</div>';
}


?>
                   
                </div>



        </body>

        </html>