<?php

    session_start();

?>

<html>

    <head>
        <link href="style.css" type="text/css" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
    <body>
        
    </body>

</html>


<?php

    require("databaseConn.php");

    $userId = $_SESSION['user_id'];
    $sql = "DELETE FROM `users` WHERE `users`.`id` = $userId ";
    $sqlToDeleteMessages = "DELETE FROM `messages` WHERE `messages`.`receiver_user_id` = $userId";
    $result = $conn->query($sql);
    $conn->query($sqlToDeleteMessages);
    if($result) {
        echo "Your account has been deleted<br/>";
        echo "<a href='registerPage.php' id='link'>Create new account</a>";
        $_SESSION['loggedIn'] = false;
    }

?>