<?php include ('includes/functions.php'); ?>
<?php session_start(); 
$mgs="";

if(isset($_POST['descSubmit'])) {
      date_default_timezone_set('Europe/Sarajevo');
        $postic = str_replace(",","&comma;",$_POST['desc']);
    $novaObjava =htmlentities($_SESSION['loggedUser']) . "," . htmlentities($postic) . "\r\n";
    $sveObjave = file_get_contents($_ENV['OPENSHIFT_DATA_DIR']."files/opisiProfila.csv"); 
   $sveObjave=$novaObjava . $sveObjave;
   file_put_contents($_ENV['OPENSHIFT_DATA_DIR']."files/opisiProfila.csv",$sveObjave);
    header('Location: profile.php');
}
?>

    <!doctype html>
    <html>

    <head>
        <title>
            Profile

        </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/logo.css">
        <script src="js/validation.js"></script>

        <meta charset="utf-8">
    </head>

    <body>



        <?php include 'includes/navbar.php'; ?>

            <div id="posts">

                <div class="post">
                    <div class="antiLR">
                        <form action="dodajOpis.php" method="post" enctype="multipart/form-data">
                            Enter your profile descroption:
                            <textarea class="contentpost" rows="3" name="desc" maxlength="120"></textarea>
                            <input class="contentsubmit" type="submit" title="Post" name="descSubmit">
                            <label>
                                Max 120 characters
                                <br>
                                <?php echo $mgs; ?>
                            </label>
                        </form>
                    </div>
                </div>
                <br>




            </div>



    </body>

    </html>