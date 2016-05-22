<?php include ('includes/functions.php'); ?>
<?php session_start(); 

$filename = 'images/users/'.$_SESSION['loggedUser'].'.PNG';
if (file_exists($filename)) {
    $postoji = 1;
} else {
        $postoji = 0;
}
?>

    <?php
$mgs ="";
if(isset($_POST["submitUpload"])) {
    $target_dir = 'images/users/';
    $target_file = $target_dir . $_SESSION['loggedUser'].".jpg";
    $uploadOk = 1;
    $imageFileType = pathinfo($target_dir . $_FILES["fileToUpload"]["name"],PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $mgs .= "File is an image - " . $check["mime"] . ". ";
            $uploadOk = 1;
        } else {
            $mgs .= "File is not an image. ";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
if (file_exists($target_file)) {
    $mgs .= "Sorry, file already exists. ";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    $mgs .= "Sorry, your file is too large. ";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "png" ) {
    $mgs .= "Sorry, only jpg/JPG/png/PNG files are allowed. ";
    $uploadOk = 0;
}
    if ($uploadOk == 0) {
    $mgs .= "Sorry, your file was not uploaded. ";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $test = getimagesize($target_file);
        $width = $test[0];
        $height = $test[1];
        if ($width-$height<5 && $width-$height>-5) {
            $mgs .= "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded. ";
        }
        else {
            $mgs .= "The image needs to be square format!";
            unlink($target_file);
        }
        
    } else {
        $mgs .= "Sorry, there was an error uploading your file.";
    }
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
                            <form action="uploadPhoto.php" method="post" enctype="multipart/form-data">
                                Select image to upload:
                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <input type="submit" value="Upload Image" name="submitUpload">
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