<?php

    session_start();
    require("databaseConn.php");

    if(isset($_POST['submitBtn'])) {
        //Getting all input fields value to variables
        $allChecked = true;
        $username = $_POST['username'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $email = $_POST['email'];
        $rules = $_POST['rules'];


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

        //Checking if name contains not aplhanumeric characters and underscores
        if(!preg_match('/[a-zA-Z0-9_]/' ,$username)) {
            $allChecked = false;
            $_SESSION['nameError'] = "Name can contain only alphanumeric characters";
        }

        //Checking if name is at least 1 character long
        if(strlen($username) < 1) {
            $allChecked = false;
            $_SESSION['nameError'] = "Name have to be at least 1 character long";
        }

        //Checking if name have more than 20 characters
        if(strlen($username) > 20) {
            $allChecked = false;
            $_SESSION['nameError'] = "Name cannot have more than 20 characters";
        }

        //Validating email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $allChecked = false;
            $_SESSION['emailError'] = "Please type correct email";
        }

        

        //Checking if rules checkbox is checked
        if(empty($rules)) {
            $allChecked = false;
            $_SESSION['rulesError'] = "You must accept regulations";
        }

        //Checking if email exists
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        $emailExists = $result->fetch();
        if($emailExists) {
            $allChecked = false;
            $_SESSION['emailError'] = "Email is already taken";
        }

        //Checking if name exists
        $sql = "SELECT * FROM users WHERE user_name = '$username'";
        $result = $conn->query($sql);
        $nameExists = $result->fetch();
        if($nameExists) {
            $allChecked = false;
            $_SESSION['nameError'] = "Name is already taken";
        }

        if(empty($username) || empty($email) || empty($password1) || empty($password2)) {
            $allChecked = false;
        }

        //Checking if $allChecked is true
        if($allChecked) {
            //Hashing password
            $passwordH = password_hash($password1, PASSWORD_DEFAULT);
            //Executing sql query
            $sql = "INSERT INTO `users`(`id`, `user_name`,`profileImage`, `pass`, `email`, `friends`) VALUES (null, '$username','pictures/Y81jXSls6Ub9Y5MSlOVU.png', '$passwordH', '$email', 0)";
            $result = $conn->query($sql);
            //Checking if user is added
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
    <meta charset="UTF-8">
    <title>Connect - registration page</title>
</head>
<body>

    <div class="registerWrapper">
        <form class="registerForm" method="post">
            <div>
                <label for="username">Name</label>
                <input type="text" name="username" placeholder="Name"/><br/>
            </div>
            <?php
                //Displaying name error
                if(isset($_SESSION['nameError'])) {
                    echo "<div class='error'>".$_SESSION['nameError']."</div>";
                    unset($_SESSION['nameError']);
                }
                
        
            ?>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Email"><br/>
            </div>
            <?php
                //Displaying email error
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
                //Displaying password error
                if(isset($_SESSION['passError'])) {
                    echo "<div class='error'>".$_SESSION['passError']."</div>";
                    unset($_SESSION['passError']);
                }
                
            ?>
            <div>
                <label for="password2">Confirm password</label>
                <input type="password" name="password2" placeholder="Confirm password"/><br/>
            </div>
            <div class="rules">
                <label for="rules"><a href="rules.html" id="rulesLink">Rules</a></label>
                <input type="checkbox" name="rules"><br/>
            </div>
            <?php
                //Displaying rules error
                if(isset($_SESSION['rulesError'])) {
                    echo "<div class='error'>".$_SESSION['rulesError']."</div>";
                    unset($_SESSION['rulesError']);
                }
            ?>
            <input type="submit" name="submitBtn" value="Register" id="registerBtn" />
        </form>
        <a href="index.php" id="link">Back to login</a>
    </div>

</body>

</html>