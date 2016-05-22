<?php include ('includes/functions.php'); ?>
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
        $showDesc ='The user has not entered any description.';
        $sviOpisi = file($_ENV['OPENSHIFT_DATA_DIR']."files/opisiProfila.csv");
        foreach($sviOpisi as $opis) {
            $infoRacuna = explode(",",$opis);
            if($infoRacuna[0] == $showUsername) {
                $showDesc = $infoRacuna[1];
                break;
            }
        }
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
    $showDesc ='<a href="dodajOpis.php">Add description</a>';
        $sviOpisi = file($_ENV['OPENSHIFT_DATA_DIR']."files/opisiProfila.csv");
        foreach($sviOpisi as $opis) {
            $infoRacuna = explode(",",$opis);
            if($infoRacuna[0] == $showUsername) {
                $showDesc = $infoRacuna[1];
                break;
            }
        }
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


if(isset($_POST['post'])) {
          date_default_timezone_set('Europe/Sarajevo');
    $postic = str_replace(",","&comma;",$_POST['newEntery']);
    $postic = str_replace(array("\r", "\n")," ", $postic);
        if($postic.length < 201) {
            $novaObjava = htmlentities($_SESSION['loggedUser']) . "," . htmlentities($postic) . "," . htmlentities(date("m.d.Y H:i")) . "\r\n";
            $sveObjave = file_get_contents($_ENV['OPENSHIFT_DATA_DIR']."files/objave.csv"); 
           $sveObjave=$novaObjava . $sveObjave;
           file_put_contents($_ENV['OPENSHIFT_DATA_DIR']."files/objave.csv",$sveObjave);
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
                                    <?php echo $showName; ?>
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



                                </form>
                            </div>
                        </div>
                        <?php } ?>
                            <br>
                            <?php
                    $sveObjave = file($_ENV['OPENSHIFT_DATA_DIR']."files/objave.csv");
    
    foreach($sveObjave as $objava) {
        
        $objavaUNizu = explode(",",$objava);
       // echo $infoRacuna[1].$uname;
        if($objavaUNizu[0] == $showUsername) {
            echo '<div class="post">' . '<div class="left">';
            echo $link;
            echo '</div><div class="right">' . '<a class="username" href="#">' . $showName . '</a>' . '<div class="datepomocni">'; 
            echo $objavaUNizu[2].'</div> <div class="proteklo"></div>';
            echo '<div class="date">'.$objavaUNizu[2].'</div><div class="content">' . $objavaUNizu[1];  
            echo '</div></div></div>';
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