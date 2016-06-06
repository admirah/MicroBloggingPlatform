<?php 
include('includes/db_config.php');
include('includes/functions.php'); ?>
    <?php session_start();
$sendMeToLogin = true;
if(isset($_GET['username']) && !empty($_SESSION["loggedUser"]) && $_GET['username']==$_SESSION["loggedUser"]) {
    header('Location: profile.php');
}
if(isset($_GET['username'])) {
    if(getFullnameByUsername($_GET['username'])) {
        $loggedProfile=false;
        $sendMeToLogin=false;
        $showUsername=$_GET['username'];
        $showName = getFullnameByUsername($_GET['username']);
        
     
     
        if(dajOpis($showUsername)) {
              $showDesc=dajOpis($showUsername);
        }
        else $showDesc ='The user has not entered any description.';
       
        if(getPhoneNumber($showUsername)) {
            $showNumber = getPhoneNumber($showUsername);
        }
        else $showNumber = 'User has no number';
        
        $filename = 'images/users/'.$showUsername.'.jpg';
        if (file_exists($filename)) {
            $link = '<img alt="photo" class="photo" src="'.$filename.'">';
        } else {
                $link ="";
        }
    }
    else $sendMeToLogin = true;
}
else if(empty($_SESSION["loggedUser"]) && $sendMeToLogin) {
    header('Location: login.php');
}
else {
    $loggedProfile = true;
    $showUsername = $_SESSION["loggedUser"];
    $showName = getFullnameByUsername($_SESSION["loggedUser"]);
      if(dajOpis($showUsername)) {
              $showDesc=dajOpis($showUsername);
        }
    else
    $showDesc ='<a href="dodajOpis.php">Add description</a>';
    
         if(getPhoneNumber($showUsername)) {
            $showNumber = getPhoneNumber($showUsername);
        }
        else $showNumber = '<a href="unosBroja.php">Add a phone number</a>';
        $filename = 'images/users/'.$showUsername.'.jpg';
        if (file_exists($filename)) {
            $link = '<img alt="photo" class="photo" src="'.$filename.'">';
        } else {
                $link = '<a href="uploadPhoto.php" class="uploadPhoto">+</a>';
        }
}
if (!empty($_SESSION["loggedUser"])) {
    
    $query  = "SELECT * FROM users WHERE username = '" . mysqli_real_escape_string($connection,$_SESSION["loggedUser"]) . "' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if (mysqli_num_rows($result) != 0) {
        $user                 = mysqli_fetch_row($result);
    
        $_SESSION["loggedId"] = $user[0];
        $_SESSION["rola"]     = $user[6];
    }
}
    

if(isset($_POST['post'])) {
          date_default_timezone_set('Europe/Sarajevo');
    $x=0;
    if(isset($_POST["kom"]) && $_POST["kom"]=="on") $x=1;
     date_default_timezone_set('Europe/Sarajevo');
  $postic=htmlentities($_POST['newEntery']);
    if (strlen($postic) < 201) {
        $sql = "INSERT INTO `posts`(`authorid`, `content`, `dateposted`, `status`) VALUES ('" . mysqli_real_escape_string($connection,$_SESSION["loggedId"]) . "','" . mysqli_real_escape_string($connection, htmlentities($_POST['newEntery'])) . "',NOW(),".mysqli_real_escape_string($connection,$x).")";
        if (mysqli_query($connection, $sql)) {
            
            
        } else {
            
        }
    }
    
        
}


?>
        

        <!doctype html>
        <html>

        <head>
            <title>
                <?php echo $showName; ?>
            </title>
            <link rel="stylesheet" type="text/css" href="css/style.css">
            <link rel="stylesheet" type="text/css" href="css/logo.css">
            <script src="js/validation.js"></script>
            <script src="js/script.js"></script>
            <meta charset="utf-8">
        </head>

        <body>



            <?php include 'includes/navbar.php'; ?>

                <div id="posts">
                    <div class="post">

                        <div class="left">
                            <?php echo $link; ?>
                        </div>
                        <div class="right">
                            <ul class="batn-kontener">
                                <li class="batn facebookli"><a href="https://www.facebook.com/admira.husic.16">Facebook</a></li>
                                <li class="batn instagramli"><a href="https://www.instagram.com/admirahusic/">Instagram</a></li>
                                <li class="batn twitterli"><a href="https://twitter.com/admirahu">Twitter</a></li>
                            </ul>
                            <div class="nonbatnarea">
                                <a class="username" href="#">
                                    <?php echo $showName;
                                   
                                    ?>
                             <?php echo '  <form method="post" style="display:inline" action="edituser.php?userid='.  $_SESSION["loggedId"] .'"> <input type="submit" value="Edit"></form>';?>
                                </a>
                               

                                <div class="date">
                                    @
                                    <?php echo $showUsername . ' ' . $showNumber; ?>

                                </div>
                                <div class="opisProfila">
                                    <?php echo $showDesc; ?>
                                </div>
                               
                            </div>
                        </div>
                          
                    </div>
                   
                    <?php if ($loggedProfile) { ?>
                        <div class="post">
                            <div class="antiLR">
                                <form onsubmit=" return profileValidation()" method="post" action="profile.php">
                                    <textarea class="contentpost" rows="3" name="newEntery" maxlength="200"></textarea>
                                    <input class="contentsubmit" type="submit" title="Post" name="post">
                                    <input type="checkbox" title="Approve comments" name="kom">Disable comments
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                            <br>
                            <?php
                    $sveObjave = getObjave();
    
 
        
       // echo $infoRacuna[1].$uname;
         while($objavaUNizu = mysqli_fetch_row($sveObjave))  {
        if($objavaUNizu[0] == $showUsername) {
            echo '<div class="post">' . '<div class="left">';
            echo $link;
            echo '</div><div class="right">' . '<a class="username" href="#">' .$objavaUNizu[0] . '</a>' ;
            if($objavaUNizu[0]==$_SESSION["loggedUser"])    echo '<a class="username" href="post.php?postid=' . $objavaUNizu[3] . '"> +(' . $objavaUNizu[5]. ')</a>'; 
                echo'<div class="datepomocni">'; 
             
            echo $objavaUNizu[2].'</div> <div class="proteklo"></div>';
            echo '<div class="date">'.$objavaUNizu[2];
               echo '</div><a class="username content" href="post.php?postid='.$objavaUNizu[3].'">' . $objavaUNizu[1];  
            echo '</a></div>';
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
    }
                
                ?>



                                <!--
                <div class="post">
                    <div class="left"><img alt="photo" class="photo" src="images/admira.PNG"></div>
                    <div class="right">
                        <a class="username" href="#">admira</a>
                        <div class="date">3.14.2016 14:06</div>
                        <div class="content">Pravim svoj tvitercic! :D</div>
                    </div>
                </div>
-->


                </div>



        </body>

        </html>