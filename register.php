<?php include ('includes/functions.php'); ?>
    <?php

    session_start();
    if(!empty($_SESSION["loggedUser"])) { header('Location: index.php'); } 
    
        
    
?>

    <!doctype html>
    <html>

    <head>
        <title>
            Register
        </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/logo.css">
        <meta charset="utf-8">
        <script src="js/validation.js"></script>
    </head>

    <body class="loginbody">


        <?php include 'includes/navbar.php'; ?>
            <div id="posts">
                <form class="post loginform " name="forma" onsubmit=" return registerValidation(); alert(registerValidation());" method="post" action="includes/validatereg.php">
                    <table class="loginform">
                        <tr>
                            <td>
                                <label>Full name:</label>
                            </td>
                            <td>
                                <input type="text" name="name" id="name" onkeypress="validation(this)" onfocusout="validation(this)" value="<?php if(isset($_GET['errTyp'])) {echo $_GET['name'];} ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Username:</label>
                            </td>
                            <td>
                                <input type="text" name="username" id="username" onkeypress="validation(this)" onfocusout="validation(this)" value="<?php if(isset($_GET['errTyp'])) {echo $_GET['userame'];} ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Password:</label>
                            </td>
                            <td>
                                <input placeholder="Must be 4-8 characters long" type="password" name="pass" id="pass" onkeypress="validation(this)" onfocusout="validation(this)">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date of birth:</label>
                            </td>
                            <td>
                                <input type="date" name="date" id="date" onkeypress="validation(this)" onfocusout="validation(this)" value="<?php if(isset($_GET['errTyp'])) {echo $_GET['date'];} ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email:</label>
                            </td>
                            <td>
                                <input type="email" name="email" id="email" onkeypress="validation(this)" onfocusout="validation(this)" value="<?php if(isset($_GET['errTyp'])) {echo $_GET['email'];} ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Website (optional):</label>
                            </td>
                            <td>
                                <input type="url" name="web" id="web" onkeypress="validation(this)" onfocusout="validation(this)">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label id="usernameajax">
                                    <?php if(isset($_GET['errTyp'])) {echo "Username already taken!";} ?>
                                </label>
                                <label id="labeladate">Hey! You are not 18 yet! You can't submit form!</label>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" id="dugmic" name="register">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>



    </body>

    </html>