<?php include ('includes/functions.php'); ?>
<?php session_start(); 
$mgs="";
 include ('includes/db_config.php');

if(isset($_POST['descSubmit'])) {
      date_default_timezone_set('Europe/Sarajevo');
  
    $sql = "UPDATE users SET description='".mysqli_real_escape_string($connection, htmlentities($_POST['desc']))."' WHERE username='".mysqli_real_escape_string($connection,$_SESSION["loggedUser"])."'";


if (mysqli_query($connection, $sql)) {
        header('Location: profile.php');
} else {
    
}

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