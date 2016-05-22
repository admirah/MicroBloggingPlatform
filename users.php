<?php include ('includes/functions.php'); ?>
   <?php session_start(); ?>
    <!doctype html>
    <html>

    <head>
        <title>
            Users

        </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/logo.css">
        <meta charset="utf-8">
    </head>

    <body>


        <?php include 'includes/navbar.php'; ?>
            <div id="posts">
                <table class="post users">
                    <tr>
                        <th>Full name</th>
                        <th>Username</th>
                        <th>Registration date</th>
                        <th>Age</th>
                        <th>Email</th>
                    </tr>



                    <tr>
                        <td>Admira Husić</td>
                        <td>admira</td>
                        <td>3.14.2016</td>
                        <td>21</td>
                        <td>admira@admira.com</td>
                    </tr>
                    <tr>
                        <td>Belmin Mustabašić</td>
                        <td>belmin</td>
                        <td>3.14.2016</td>
                        <td>21</td>
                        <td>belmin@gmail.com</td>
                    </tr>
                    <tr>
                        <td>Emina Huskić</td>
                        <td>minnie</td>
                        <td>3.14.2016</td>
                        <td>21</td>
                        <td>minnie@minnie.com</td>
                    </tr>
                    <tr>
                        <td>Vejsil Hrusić</td>
                        <td>bake</td>
                        <td>3.14.2016</td>
                        <td>21</td>
                        <td>bake@vejs.bake</td>
                    </tr>
                </table>
            </div>


    </body>

    </html>