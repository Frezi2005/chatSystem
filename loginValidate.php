<?php
    session_start();

    require("databaseConn.php");
    if(isset($_POST['submitBtn'])) {
        $login = $_POST['loginField'];
        $password = $_POST['passwordField'];
        $sql = "SELECT * FROM users WHERE user_name LIKE 'test' AND pass LIKE 'test'";
        $result = $conn->query($sql);
        $user = $result->fetch();
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



        if($result) {
            $row_count = $result->rowCount();
            if($row_count>0) {
                var_dump($result);
                exit();
                $row = $result->fetch_assoc();    
                $_SESSION['loggedIn'] = true;
                $_SESSION['user_name'] = $row['user_name'];
                header("Location: mainPage.php");
            } else {
                $_SESSION['loggedIn'] = false;
                $_SESSION['errorMsg'] = "Wrong login or password<br />";
                header("Location: index.php");
                exit();
            }
                
        }
            
?>