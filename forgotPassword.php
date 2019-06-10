<?php

    session_start();
    require("databaseConn.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    // Load Composer's autoloader
    require 'vendor/autoload.php';

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

?>
<html>

    <head>
        <link href="style.css" type="text/css" rel="stylesheet">
        <meta charset="UTF-8">
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
        $sql2 = "SELECT pass FROM users WHERE email = 'kamil.wan05@gmail.com'";
        $emailResult = $conn->query($sql);
        $passResult = $conn->query($sql2);
        $pass = $passResult->fetch();
        $emailChecked = $emailResult->fetch();
        if ($emailChecked && $pass) {
            $mail->setFrom('kamil.wan05@gmail.com', 'Connect');
            $mail->addAddress('kamil.wan05@gmail.com');
            $mail->Subject = 'Connect password recovery';
            $mail->Body = "Here is your account password: ".$pass['pass'];
            if (!$mail->Send()) {
                echo 'Message was not sent.';
                echo 'Mailer error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent to: '.$emailChecked['email'];
            }
        } else {
            echo "Error";
        }
    }

?>