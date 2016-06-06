<?php include ('includes/functions.php'); ?>
   
    <?php session_start(); 
 include ('includes/db_config.php');
$mgs="";
    if(isset($_GET['numSub'])) {
          date_default_timezone_set('Europe/Sarajevo');
        $kod = str_replace(",","&comma;", htmlentities($_GET['ccode']));
        $broj = str_replace(",","&comma;", htmlentities($_GET['phone'])); 
var_dump($broj);
        $sql = "UPDATE users SET phone=".mysqli_real_escape_string($connection,$broj)." WHERE username='".mysqli_real_escape_string($connection,$_SESSION["loggedUser"])."'";


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
            <script>
                function validiraj() {

                    var strCode = document.getElementById('code').value;
                    var strPhone = document.getElementById('phone').value;
                    if (strCode.length > 0 && strPhone.length > 0) {
                        var xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function () {
                            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                                var obj = JSON.parse(xmlhttp.responseText);

                                if (strCode.length != 2) document.getElementById("porukica").innerHTML = "Neispravan format koda. Ispravan format je: XX";
                                else {
                                    if (strCode.toUpperCase() == obj[0]["alpha2Code"] && strPhone.length > 5) {
                                        var duzinaapibroja = obj[0]["callingCodes"].toString().length;
                                        var strBroj = "";
                                        if ((duzinaapibroja == 1 && obj[0]["callingCodes"].toString() == strPhone[1]) ||
                                            (duzinaapibroja == 2 && obj[0]["callingCodes"].toString() == strPhone[1] + strPhone[2]) ||
                                            (duzinaapibroja == 3 && obj[0]["callingCodes"].toString() == strPhone[1] + strPhone[2] + strPhone[3])) {
                                            document.getElementById("porukica").innerHTML = "OK";
                                        } else document.getElementById("porukica").innerHTML = "NOT OK";
                                    } else document.getElementById("porukica").innerHTML = "NOT OK";
                                }
                                //document.getElementById("porukica").innerHTML = obj[0]["callingCodes"];
                            }
                        }
                        xmlhttp.open("GET", "https://restcountries.eu/rest/v1/alpha?codes=" + strCode, true);
                        xmlhttp.send();
                    }
                }

                function validateNumber() {
                    return document.getElementById("porukica").innerHTML == "OK";
                }
            </script>
            <meta charset="utf-8">
        </head>

        <body>



            <?php include 'includes/navbar.php'; ?>

                <div id="posts">

                    <div class="post">
                        <div class="antiLR">
                            <form action="unosBroja.php" method="get" onsubmit="return validateNumber()">
                                <table>
                                    <tr>
                                        <td>Country Code:</td>
                                        <td>Phone Number</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" id="code" name="ccode" placeholder="XX" onkeyup="validiraj()">
                                        </td>
                                        <td>
                                            <input type="text" name="phone" id="phone" placeholder="+387 61 555 879" onkeyup="validiraj()">
                                        </td>
                                        <td>
                                            <input class="contentsubmit" type="submit" value="Add" name="numSub">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" id="porukica"></td>
                                    </tr>
                                </table>

                                <label>
                                    <?php echo $mgs; ?>
                                </label>
                            </form>
                        </div>
                    </div>
                    <br>




                </div>



        </body>

        </html>