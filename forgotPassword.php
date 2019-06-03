<?php

    session_start();
    require("databaseConn.php");

?>
<html>

    <head>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="wrapper">
            <form method="post">
                <input type="email" placeholder="Type here your email" name="email"><br/><br/>
                <input type="submit" name="submitBtn" value="Send" id="forgotPassBtn">
                <?php
                    if(isset($_SESSION['emailSended'])) {
                        echo "<div>".$_SESSION['emailSended']."</div>";
                        unset($_SESSION['emailSended']);
                    }
                ?>
            </form>
        </div>
    </body>

</html>

<?php
    //Not working
    if(isset($_POST['submitBtn'])) {
        $email = $_POST['email'];
        $sql = "SELECT * FROM users WHERE email LIKE 'kamil.wan05@gmail.com'";
        $sql2 = "SELECT pass FROM users";
        $emailResult = $conn->query($sql);
        $passResult = $conn->query($sql2);
        $pass = $passResult->fetch();
        $emailChecked = $emailResult->fetch();
        if($emailChecked && $pass) {
            $message = "Your password is: ".$pass['pass'];
            mail($emailChecked, 'Forgot password', $message);
            $_SESSION['emailSended'] = "We have sended email to adress: ".$emailChecked;
        } else {
            echo "Error";
        }
    }

?>