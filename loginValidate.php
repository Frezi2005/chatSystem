<?php
    session_start();

    require("databaseConn.php");
    if(isset($_POST['submitBtn'])) {
        $login = $_POST['loginField'];
        $password = $_POST['passwordField'];
        $sql = "SELECT * FROM users WHERE user_name LIKE '$login' AND pass LIKE '$password'";
        $result = $conn->query($sql);
        if($result) {
            echo $login.$password;
            $row_count = $result->num_rows;
            if($row_count>0) {
                $row = $result->fetch_assoc();    
                $_SESSION['loggedIn'] = true;
                $_SESSION['user_name'] = $row['user_name'];
                header("Location: mainPage.php");
                $conn->free_result();
            } else {
                $_SESSION['loggedIn'] = false;
                $_SESSION['errorMsg'] = "Wrong login or password<br />";
                header("Location: index.php");
                exit();
            }
                
        }
    }
            
?>