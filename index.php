<?php

session_start();

?>

<html>
    <head>
        <link href="style.css" type="text/css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    </head>
    <body>
        <div class="wrapper">
            <form class="loginForm" action="loginValidate.php" method="POST">
                <div>                  
                    <label for="loginField">Name</label>
                    <input type="text" name="loginField" placeholder="Login" id="login"/><br />
                    <i class="fas fa-user user-icon"></i>
                </div>
                <div>
                    <label for="passwordField">Password</label>
                    <input type="password" name="passwordField" placeholder="Password" id="password"/><br />
                    <i class="fas fa-key key-icon"></i>
                </div>
                <?php 
                if(isset($_SESSION['errorMsg'])) {
                    echo "<div class='error'>".$_SESSION['errorMsg']."</div>";
                    session_unset();
                }
                ?>
                <input type="submit" name="submitBtn" value="Login" id="loginBtn"/>
            </form>
            <a href="forgotPassword.php" id="link">Forgot password</a><br/><br/>
            <a href="registerPage.php" id="link">You don't have account? Register now!</a>
        </div>
    </body>
</html>

