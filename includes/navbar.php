
<?php
   include ('db_config.php');
if(isset($_SESSION["loggedUser"])){
$query ="SELECT role FROM users WHERE username = '".mysqli_real_escape_string($connection,$_SESSION["loggedUser"])."' LIMIT 1";
    $result = mysqli_query($connection, $query);
    if(mysqli_num_rows($result) != 0) {
        $user = mysqli_fetch_row($result);
          
           $_SESSION["id"]=$user[0];
        }
}
?>
    <div id="navbar">
        <div class="nav">
            <table class="logotabela">
                <tr>
                    <td class="klasanijeinline">
                        <div class="body">
                            <div class="logoframe">

                                <div class="oko">
                                    <div class="okoleft"></div>

                                    <div class="okoright"></div>
                                </div>
                            </div>

                        </div>
                    </td>
                    <td>
                        <ul class="ulleft">
                            <li><a href="index.php">Home</a></li>
                            <?php if(isset($_SESSION["id"]) && $_SESSION["id"]==1) {echo' <li>
                                <a href="users.php"> Users</a>
                            </li>';}?>
                         <?php if(isset($_SESSION["loggedUser"])) {echo  '<li>
                                <a id="notif" href="#">+ ';
                         if(isset($_SESSION["notif"]) ) echo  $_SESSION["notif"];
                            else echo "0";
                      echo   '</a> </li>';}?>

                        </ul>
                    </td>
                    <td>
                        <ul class="ulright">

                            </li>
                            <?php if(!empty($_SESSION["loggedUser"])) {?>
                                <li> <a href="profile.php">Profile</a></li>
                                <li> <a href="logout.php">Logout</a></li>
                                <?php } else {?>

                                    <li> <a href="login.php">Login</a>
                                    </li>
                                    <li> <a href="register.php">Register</a>
                                    </li>
                                    <?php } ?>
                        </ul>
                    </td>
                </tr>
            </table>




        </div>
    </div>