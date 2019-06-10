<?php

    session_start();
    require("databaseConn.php");
    if(isset($_POST['submitBtn'])) {
        $fileName = $_FILES['image']['name'];
        $userName = $_SESSION['user_name'];
        $uploaddir = 'pictures/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);

        $allowedExt =  array('jpeg','png' ,'jpg', 'webp', 'jp2');
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        if(in_array($ext,$allowedExt) ) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                echo "File is valid, and was successfully uploaded.\n";
                $sql = "UPDATE users SET profileImage = '$fileName' WHERE user_name = '$userName'";
                $conn->query($sql);
            }
        } else {
            echo 'Allowed file extensions are: .png, .jpg, .jpeg, .jp2';
        }
        
    }
   

?>

<html>
<head>
    <meta charset="utf-8">
    <link href="style.css" rel="stylesheet" type="text/css">
    <title>Connect - avatar change</title>
</head>
<body>
    <div class="wrapper">
        <form action="#" enctype="multipart/form-data" method="post">
            <input type="file" name="image" class="imageInput"><br/>
            <input type="submit" name="submitBtn" value="Upload" class="fileUploadBtn"><br/><br/>
            <a href="mainPage.php" name="backBtn" class='backBtn'>Back</a>
        </form>
    </div>
</body>
</html>


