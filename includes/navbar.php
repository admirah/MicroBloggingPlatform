
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
                            <li>
                                <a href="users.php"> Users</a>
                            </li>

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