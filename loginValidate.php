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
        $sql = "SELECT * FROM users WHERE user_name LIKE 'test' AND pass LIKE 'test'";
        $result = $conn->query($sql);
        $user = $result->fetch();
        //Checking is there is no error with login
        if ($user) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['user_name'] = $user['user_name'];
            header("Location: mainPage.php");
        } else {
            $_SESSION['loggedIn'] = false;
            $_SESSION['errorMsg'] = "Wrong login or password<br />";
            header("Location: index.php");
            exit();
        }
    }


    exit();



        // if($result) {
        //     $row_count = $result->rowCount();
        //     if($row_count>0) {
        //         var_dump($result);
        //         exit();
        //         $row = $result->fetch_assoc();    
        //         $_SESSION['loggedIn'] = true;
        //         $_SESSION['user_name'] = $row['user_name'];
        //         header("Location: mainPage.php");
        //     } else {
        //         $_SESSION['loggedIn'] = false;
        //         $_SESSION['errorMsg'] = "Wrong login or password<br />";
        //         header("Location: index.php");
        //         exit();
        //     }
                
        // }
            
?>