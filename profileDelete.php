<html>

    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        
    </body>

</html>


<?php

    require("databaseConn.php");

    $sql = "SELECT * FROM users WHERE user_name LIKE 'test' AND pass LIKE 'test'";
    $result = $conn->query($sql);
    if($result) {
        echo "Your account is deleted<br/>";
        echo "<a href='registerPage.php' id='link'>Create new account</a>";
    }

?>