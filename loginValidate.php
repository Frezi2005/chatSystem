<?php
    //Starting session
    session_start();

    //Connecting to database
    require("databaseConn.php");
    //Checking if submit button is pressed
    if(isset($_POST['submitBtn'])) {
        //Getting all input fields value to variables
        $login = $_POST['loginField'];
        $password = $_POST['passwordField'];
        //Login user
        $sql = "SELECT * FROM users WHERE user_name = '$login'";
        $result = $conn->query($sql);
        $user = $result->fetch();
        //Checking is there is no error with login
        if ($result && password_verify($password, $user['pass'])) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_id'] = $user['id'];
            header("Location: mainPage.php");
        } else {
            $_SESSION['loggedIn'] = false;
            $_SESSION['errorMsg'] = "Wrong login or password<br />";
            header("Location: index.php");
            exit();
        }
    }


            
?>