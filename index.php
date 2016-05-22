<?php include ('includes/functions.php'); ?>
    <?php session_start(); 
$_SESSION['abecedno']=1;


function cmp($a, $b)
{
    $niz=explode(',',$a);
    $niz1=explode(',',$b);
   
    return (strtolower($niz[1]) < strtolower($niz1[1])) ? -1 : 1;
}
/* if(isset($_SESSION['abecedno']) && isset($_SESSION['abecedno'])==2)){
     usort($sveObjave, "cmp");

     
 }*/
    if(isset($_POST['post'])) {
          date_default_timezone_set('Europe/Sarajevo');
    $postic = str_replace(",","&comma;",$_POST['noviUnos']);
    $postic = str_replace(array("\r", "\n")," ", $postic);
        if($postic.length < 201) {
            $novaObjava = htmlentities($_SESSION['loggedUser']) . "," . htmlentities($postic) . "," . htmlentities(date("m.d.Y H:i")) . "\r\n";
            $sveObjave = file_get_contents($_ENV['OPENSHIFT_DATA_DIR']."files/objave.csv"); 
           $sveObjave=$novaObjava . $sveObjave;
           file_put_contents($_ENV['OPENSHIFT_DATA_DIR']."files/objave.csv",$sveObjave);
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
            
            <?php include 'includes/navbar.php'; ?>
<div class="date datenone"></div>

                <div id="posts">
                    <?php 
                
        if(!empty($_SESSION["loggedUser"])) {
            $filename = 'images/users/'.$_SESSION['loggedUser'].'.jpg';
            if (file_exists($filename)) {
                $postoji = 1;
            } else {
                    $postoji = 0;
            }

        ?>
                        
                           
                           <div class="post">
                            <form  onsubmit="return indexValidation()" action="index.php" method="post">
                                <div class="left">
                                    <?php if($postoji==1) {?><img alt="photo" class="photo" src="images/users/<?php echo $_SESSION["loggedUser"]; ?>.jpg">
                                        <?php } ?>
                                </div>
                                <div class="right">
                                    <a class="username" href="#">
                                        <?php echo getFullnameByUsername($_SESSION["loggedUser"]); ?>
                                    </a>

                                    <textarea class="contentpost" name="noviUnos" rows="3" maxlength="200"></textarea>
                                    <input class="contentsubmit" name="post" type="submit" title="Post">
                                </div>
                            </form>
                        </div>
                        <?php } ?>






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
                    $sveObjave = file($_ENV['OPENSHIFT_DATA_DIR']."files/objave.csv");
                    if(isset($_GET['abecedno']) && $_GET['abecedno']=="ABC")
                        usort($sveObjave,"cmp");

                    foreach($sveObjave as $objava) {
                        $objavaUNizu = explode(",",$objava);
                        echo '<div class="post">' . '<div class="left">';
                        if(file_exists('images/users/'.$objavaUNizu[0].'.jpg')) echo '<img alt="photo" class="photo" src="'.'images/users/'.$objavaUNizu[0].'.jpg'.'">';
                        echo '</div><div class="right">' . '<a class="username" href="profile.php?username='. $objavaUNizu[0] .'">' . getFullnameByUsername($objavaUNizu[0]) . '</a>' . '<div class="date">' . $objavaUNizu[2].'</div><div class="datepomocni">' . $objavaUNizu[2].'</div><div class="proteklo">';
                        echo '</div><div class="content">' . $objavaUNizu[1] . '</div></div></div>';
                    }

                ?>
                                <!--
                    <div class="post">
                        <div class="left"><img alt="photo" class="photo" src="images/admira.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">admira</a>

                            <div class="proteklo"></div>
                            <div class="datepomocni">4 .3.2016 18:42</div>
                            <div class="date">4.3.2016 18:42</div>
                            <div class="content">Validacijo validacijo</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img alt="photo" class="photo" src="images/admira.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">admira</a>

                            <div class="proteklo"></div>
                            <div class="datepomocni">4.2.2016 20:42</div>
                            <div class="date">4.2.2016 20:42</div>
                            <div class="content">Validacijo validacijo</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img alt="photo" class="photo" src="images/admira.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">admira</a>

                            <div class="proteklo"></div>
                            <div class="datepomocni">4.2.2016 19:42</div>
                            <div class="date">4.2.2016 19:42</div>
                            <div class="content">Wt al the way</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img alt="photo" class="photo" src="images/emina.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">minnie</a>

                            <div class="proteklo"></div>
                            <div class="datepomocni">4.1.2016 23:42</div>
                            <div class="date">4.1.2016 23:42</div>
                            <div class="content">Salvador Dali da je bio obrazovan znao bi da se dali pise odvojeno</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img alt="photo" class="photo" src="images/emina.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">minnie</a>

                            <div class="proteklo"></div>
                            <div class="datepomocni">4.1.2016 23:42</div>
                            <div class="date">4.1.2016 23:42</div>
                            <div class="content">Salvador Dali da je bio obrazovan znao bi da se dali pise odvojeno</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img alt="photo" class="photo" src="images/emina.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">minnie</a>

                            <div class="proteklo"></div>
                            <div class="datepomocni">4.1.2016 23:42</div>
                            <div class="date">4.1.2016 23:42</div>
                            <div class="content">Salvador Dali da je bio obrazovan znao bi da se dali pise odvojeno</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img alt="photo" class="photo" src="images/emina.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">minnie</a>

                            <div class="proteklo"></div>
                            <div class="datepomocni">3.18.2016 23:42</div>
                            <div class="date">3.18.2016 23:42</div>
                            <div class="content">Salvador Dali da je bio obrazovan znao bi da se dali pise odvojeno</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img alt="photo" class="photo" src="images/admira.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">admira</a>
                            <div class="datepomocni">3.14.2016 14:06</div>

                            <div class="proteklo"></div>
                            <div class="date">3.14.2016 14:06</div>
                            <div class="content">I dalje pravim svoj tvitercic! -.-'</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img alt="photo" class="photo" src="images/belmin.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">belmin</a>

                            <div class="proteklo"></div>
                            <div class="datepomocni">3.14.2016 14:06</div>
                            <div class="date">3.14.2016 14:06</div>
                            <div class="content">Život je ono što se desi između momenata koje si planirao</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img class="photo" alt="photo" src="images/emina.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">minnie</a>

                            <div class="proteklo"></div>
                            <div class="datepomocni">3.14.2016 14:06</div>
                            <div class="date">3.14.2016 14:06</div>
                            <div class="content">Ugani koljeno. Koljeno u Gani</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img class="photo" alt="photo" src="images/admira.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">admira</a>
                            <div class="proteklo"></div>

                            <div class="datepomocni">3.14.2016 14:06</div>
                            <div class="date">3.14.2016 14:06</div>
                            <div class="content">Pravim svoj tvitercic! :D</div>
                        </div>
                    </div>
                    <div class="post">
                        <div class="left"><img class="photo" alt="photo" src="images/bake.PNG"></div>
                        <div class="right">
                            <a class="username" href="#">bake</a>

                            <div class="proteklo"></div>
                            <div class="datepomocni">3.14.2016 14:06</div>
                            <div class="date">3.14.2016 13:06</div>
                            <div class="content">Bolje biti jedan dan bogat, nego cijeli život siromašan.</div>
                        </div>
                    </div>


-->
                </div>



        </body>

        </html>