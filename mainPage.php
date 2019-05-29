<?php
    session_start();
    if($_SESSION['loggedIn'] == false) {
        header("Location: index.php");
        unset($_SESSION['loggedIn']);
    }
?>

<html>

<head>
    <link href="mainPageStyle.css" type="text/css" rel="stylesheet">
    <script src="scripts.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
    
    <div class="channelContainer">
        <form method="GET">
            <input type="search" name="searchQuery" placeholder="Search user" class="searchInput"/>
            <input type="submit" class="searchBtn" value="Search"/>
        </form>

        <div class="newMessage">
            <i class="far fa-envelope letter"></i>
        </div>
    </div>
    <div class="messages">

        <div class="popupWindow">
            <form class="newMessageForm" method="post">
                <input type="text" placeholder="Receiver name or id" name="receiverName">
                <textarea name="messageText"></textarea>
                <input type="submit" value="Send">
            </form>
        </div>

    </div>
</body>

</html>
<?php

    echo $_SESSION['user_name'];

    $result = $_GET['searchQuery'];
    $sql = "SELECT * FROM users WHERE user_name LIKE '%$result%' OR user_surname LIKE '%$result%'";
    $result = $conn->query($sql);
    $row_count = $result->rowCount();
    echo "Test";
    if($row_count > 0){
        while($row = $result->fetch()) {
            echo $row['user_name'];
            echo $row['user_surname'];
            echo $row['id'];
        }
    } else {
        echo "No results found";
    }
    
    

?>
