<?php include ('includes/functions.php'); ?>
   <?php session_start(); 
 include ('includes/db_config.php');
if(!isset($_SESSION["loggedUser"])) header('Location: login.php');
$query ="SELECT * FROM users WHERE username = '".$_SESSION["loggedUser"]."' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_row($result);
          
            if($user[6]!=1) header('Location: index.php');
        }
        


if(isset($_POST["Delete"]))
{
  
    $userid=$_GET["userid"];
    obrisiUsera($userid);
    
}
    $users=getUsers();

?>
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
                        <th >Option</th>
                        
                    </tr>


 <?php foreach($users as $user) {
                    echo '<tr>
                        <td>'.$user[2].'</td>
                        <td>'.$user[1].'</td>
                        <td><form method="post"  action="users.php?userid='.$user[0].'"> <input type="submit" name="Delete" value="Delete"></form> 
                        <form method="post"  action="edituser.php?userid='.$user[0].'"> <input type="submit" value="Edit"></form> </td>
                     </tr>';}
?>
                   
                </table>
            </div>


    </body>

    </html>