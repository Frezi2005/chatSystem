<?php

    session_start();
    require("databaseConn.php");
    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;


    // // Load Composer's autoloader
    // require 'vendor/autoload.php';

    // // Instantiation and passing `true` enables exceptions
    // $mail = new PHPMailer(true);


    if (isset($_POST['submitBtn'])) {
        //Assign all needed variables\
        $allChecked = true;
        $question = $_POST['question'];
        $questionAnswer = $_POST['questionAnswer'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        //Checking password length
        if(strlen($password1)<8||strlen($password1)>20) {
            $allChecked = false;
            $_SESSION['passError'] = "Password length must be beetwen 8 and 20 characters";
        }

        //Checking if password contains not aplhanumeric characters and underscores
        if(!preg_match('/[a-zA-Z0-9_]/' ,$password1)) {
            $allChecked = false;
            $_SESSION['passError'] = "Password can contain only alphanumeric<br/> characters and underscores";
        }

        //Checking if password1 matches password2
        if($password2 != $password1) {
            $allChecked = false;
            $_SESSION['passError'] = "Passwords must be the same";
        }


        if ($allChecked) {
            $passwordH = password_hash($password1, PASSWORD_DEFAULT);
            //Setup sql query
            $sql = "UPDATE `users` SET `pass` = '$passwordH' WHERE question = '$question' AND questionAnswer = '$questionAnswer'";
            $result = $conn->query($sql);
            $password = $result->fetch();
        }
        
    }

?>
<html>

    <head>
        <link href="./css/style.css" type="text/css" rel="stylesheet">
        <meta charset="UTF-8">
    </head>
    <body>
        <div class="wrapper">
            <form method="post" action="#">
                <select name="question">
                    <option value="friend">Best friend name</option>
                    <option value="food">Favourite food</option>
                    <option value="pet">Your pet name</option>
                    <option value="car">Car model</option>
                </select> 
                <input type="text" name="questionAnswer" placeholder="Auxiliary question"/><br/>
                <input type="password" name="password1" placeholder="Type here new password"/><br/>
                <?php

                    //Displaying password error
                    if(isset($_SESSION['passError'])) {
                        echo "<div class='error'>".$_SESSION['passError']."</div>";
                        unset($_SESSION['passError']);
                    }

                ?>
                <input type="password" name="password2" placeholder="Confirm password"/>
                <input type="submit" value="Change password" name="submitBtn"/>
                <a href="index.php" id="link">Go back to login</a>
            </form>
        </div>
    </body>

</html>

