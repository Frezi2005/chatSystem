<?php

    session_start();
    require("databaseConn.php");

    if(isset($_POST['submitBtn'])) {
        $allChecked = true;
        $username = $_POST['username'];
        $usersurname = $_POST['usersurname'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $email = $_POST['email'];

        if(strlen($password1)<8||strlen($password1)>20) {
            $allChecked = false;
            $_SESSION['passError'] = "Password length must be beetwen 8 and 20 characters";
        }

        if(!preg_match('/[a-zA-Z0-9_]/' ,$password1)) {
            $allChecked = false;
            $_SESSION['passError'] = "Password can contain only alphanumeric<br/> characters and underscores";
        }

        if($password2 != $password1) {
            $allChecked = false;
            $_SESSION['passError'] = "Password must be the same";
        }

        if(!preg_match('/[a-zA-Z0-9_]/' ,$username)) {
            $allChecked = false;
            $_SESSION['nameError'] = "Name can contain only alphanumeric characters";
        }

        if(!preg_match('/[a-zA-Z0-9_]/' ,$usersurname)) {
            $allChecked = false;
            $_SESSION['surnameError'] = "Surname can contain only alphanumeric characters";
        }

        if(strlen($username) < 1) {
            $allChecked = false;
            $_SESSION['nameError'] = "Name have to be at least 1 character long";
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $allChecked = false;
            $_SESSION['emailError'] = "Please type correct email";
        }

        $sql = "SELECT * FROM users WHERE email LIKE '.$email.'";
        $result = $conn->query($sql);
        $emailExists = $result->fetch();
        if($emailExists) {
            $allChecked = false;
            $_SESSION['emailError'] = "Email is already taken";
        }

        if(strlen($usersurname) < 1) {
            $allChecked = false;
            $_SESSION['surnameError'] = "Surname have to be at least 1 character long";
        }

        if($allChecked) {
            $passwordH = password_hash($password1, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users`(`id`, `user_name`, `user_surname`, `pass`, `email`, `friends`) VALUES (null, '.$username.', '.$usersurname.', $passwordH, $email, 0";
            $result = $conn->query($sql);
            if ($result) {
                header("Location: index.php");
            } else {
                echo "Database error";
            }
            
        }
        
    }  

?>


<html>

<head>
    <link href="style.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>

    <div class="registerWrapper">
        <form class="registerForm" method="post">
            <div>
                <label for="username">Name</label>
                <input type="text" name="username" placeholder="Name"/><br/>
            </div>
            <?php
                if(isset($_SESSION['nameError'])) {
                    echo "<div class='error'>".$_SESSION['nameError']."</div>";
                    unset($_SESSION['nameError']);
                }
            ?>
            <div>
                <label for="usersurname">Surname</label>
                <input type="text" name="usersurname" placeholder="Surname"/><br/>
            </div>
            <?php
                if(isset($_SESSION['surnameError'])) {
                    echo "<div class='error'>".$_SESSION['surnameError']."</div>";
                    unset($_SESSION['surnameError']);
                }
            ?>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email"><br/>
            </div>
            <?php
                if(isset($_SESSION['emailError'])) {
                    echo "<div class='error'>".$_SESSION['emailError']."</div>";
                    unset($_SESSION['emailError']);
                }
            ?>
            <div>
                <label for="password1">Password</label>
                <input type="password" name="password1" placeholder="Password"/><br/>
            </div>
            <?php
                if(isset($_SESSION['passError'])) {
                    echo "<div class='error'>".$_SESSION['passError']."</div>";
                    unset($_SESSION['passError']);
                }
            ?>
            <div>
                <label for="password2">Confirm password</label>
                <input type="password" name="password2" placeholder="Confirm password"/><br/>
            </div>
            <input type="submit" name="submitBtn" value="Register" id="registerBtn" />
        </form>
        <a href="index.php" id="link">Back to login</a>
    </div>

</body>

</html>