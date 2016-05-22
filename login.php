<?php include ('includes/functions.php'); ?>
    <?php

    session_start();
    if(!empty($_SESSION["loggedUser"])) { header('Location: index.php'); } else {
        
    
?>


    <!doctype html>
    <html>

    <head>
        <title>
            Login
        </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/logo.css">
        <script src="js/validation.js"></script>

        <meta charset="utf-8">
    </head>

    <body class="loginbody">

        <?php include 'includes/navbar.php'; ?>
            <div id="posts">

                <div class="bodylogin ">
                    <div class="logoframe logoframelogo">

                        <div class="oko okologin">
                            <div class="okoleft"></div>

                            <div class="okoright"></div>
                        </div>
                    </div>

                </div>

                <h1>hayii</h1>
                <form class="post loginform " onsubmit="return loginValidation()" action="includes/validate.php" method="post">
                    <table class="loginform">
                        <tr>
                            <td>
                                <label for="uname">Username:</label>
                            </td>
                            <td>
                                <input type="text" name="uname">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label for="pword">Password:</label>
                            </td>
                            <td>
                                <input type="password" name="pword">
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?php
         if(!empty($_REQUEST["msgTyp"])) echo "Registration successful! Login to continue.";
       if(!empty($_REQUEST["errTyp"])) {if ($_REQUEST["errTyp"]==1) echo "Incorect password!"; else if ($_REQUEST["errTyp"]==2) echo "Username does not exist!";}?>
                            </td>
                        </tr>
                    </table>

                </form>
            </div>



    </body>

    </html>

    <?php } ?>
