<?php include ('includes/functions.php'); ?>
    <?php
         include ('includes/db_config.php');
    session_start();
if(!isset($_SESSION["loggedUser"])) header('Location: login.php');
$query ="SELECT * FROM users WHERE username = '".mysqli_real_escape_string($connection,$_SESSION["loggedUser"])."' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_row($result);
            $id=$_GET["userid"];
            if($user[6]!=1 && $id!=$user[0] ) header('Location: index.php');
        
        }
    $id=$_GET["userid"];

 $query ="SELECT * FROM users WHERE id = '".mysqli_real_escape_string($connection,$id)."' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_row($result);
        }
        
    
?>

    <!doctype html>
    <html>

    <head>
        <title>
          Edit
        </title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/logo.css">
        <meta charset="utf-8">
        <script src="js/validation.js"></script>
    </head>

    <body class="loginbody">


        <?php include 'includes/navbar.php'; ?>
            <div id="posts">
                <form class="post loginform " name="forma" onsubmit=" return editValidation(); alert(editValidation());" method="post" action="includes/validateEdit.php">
                    <table class="loginform">
                         <tr class="none">
                            <td>
                                <label>Full name:</label>
                            </td>
                            <td>
                                <input type="text" name="userid" value="<?php  echo $user[0];?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Full name:</label>
                            </td>
                            <td>
                                <input type="text" name="name" id="name" onkeypress="validationn(this)" onfocusout="validationn(this)" value="<?php  echo $user[2];?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Username:</label>
                            </td>
                            <td>
                                <input type="text" name="username" id="username" onkeypress="validationn(this)" onfocusout="validationn(this)" value="<?php echo $user[1]; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Password:</label>
                            </td>
                            <td>
                                <input placeholder="Must be 4-8 characters long" type="password" name="pass" id="pass" onkeypress="validationn(this)" onfocusout="validationn(this)" value="">
                                
                            </td>
                        </tr>
                        <tr><td></td><td>Leave empty if you don't want to change password</td></tr>
                        <tr>
                            <td>
                                <label>Date of birth:</label>
                            </td>
                            <td>
                                <input type="date" name="date" id="date" onkeypress="validationn(this)" onfocusout="validationn(this)" value="<?php echo $user[5]; ?>">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Email:</label>
                            </td>
                            <td>
                                <input type="email" name="email" id="email" onkeypress="validationn(this)" onfocusout="validationn(this)" value="<?php echo $user[4]; ?>">
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