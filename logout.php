<?php

    session_start();

    //Checking if session loggedIn is true and then heading user to login page
    if($_SESSION['loggedIn'] == true) {
        header("Location: index.php");
    }

    session_unset();

?>