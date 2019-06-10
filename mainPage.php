<?php
    session_start();
    if($_SESSION['loggedIn'] == false) {
        header("Location: index.php");
        unset($_SESSION['loggedIn']);
    }

    require("databaseConn.php");

    $userId = $_SESSION['user_id'];
    $sql = "SELECT `messages`.`text` FROM `messages` WHERE receiver_user_id = '$userId' OR sender_user_id = '$userId'";
    $sqlToGetName = "SELECT `users`.`user_name` FROM `users` WHERE id = '$userId'";
    $name = $conn->query($sqlToGetName);
    $name = $name->fetch();
    $_SESSION['name'] = $name['user_name'];
    $result = $conn->query($sql);
    $messages = $result->fetchAll();



    //Sending new message
    if (isset($_POST['submitBtn'])) {
        $messageText = $_POST['messageText'];
        $receiverName = $_POST['receiverName'];

        if (!empty($messageText)) {
            $sql = "SELECT `id` FROM `users` WHERE user_name = '$receiverName'";
            $result = $conn->query($sql);
            $user = $result->fetch();
            $userId = $user['id'];
            $senderId = $_SESSION['user_id'];
            $sqlToInsertMessage = "INSERT INTO `messages`(`id`, `text`, `receiver_user_id`, `sender_user_id`) VALUES (null, '$messageText', '$userId', '$senderId')";
            $messageInstertingResult = $conn->query($sqlToInsertMessage);
        }

    }

    //Setting profile image
    $sqlToGetProfileImage = "SELECT * FROM users WHERE id = '$userId'";
    $result = $conn->query($sqlToGetProfileImage);
    $image = $result->fetch();
    $image = $image['profileImage'];
    if($image == "pictures/Y81jXSls6Ub9Y5MSlOVU.png") {
        $_SESSION['image'] = $image;
    } else {
        $_SESSION['image'] = "pictures/".$image;
    }

?>

<html>

<head>
    <link href="mainPageStyle.css" type="text/css" rel="stylesheet">
    <script src="scripts.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <title>Connect - main page</title>
</head>

<body>
    <div class="container" style="width: 100%;">
        <div class="channelContainer">
            <form method="GET" action="#" class="searchForm">
                <input type="search" name="searchQuery" placeholder="Search user" class="searchInput"/>
                <input type="submit" class="searchBtn" value="Search"/>
            </form>
            <?php

               //Searching user
                $query = $_GET['searchQuery'];
                if(!empty($query)) {
                    $sql = "SELECT * FROM `users` WHERE `users`.`user_name` LIKE '%$query%'";
                    $result = $conn->query($sql);
                    $count = $result->rowCount();
                    if(!$result->rowCount() == 0){
                        echo "<div class='resultsNumber'>Number of results: $count </div><br/>";
                        echo "<br/>";
                        while ($row = $result->fetch()) {
                            echo "<div class='user'>" . $row['user_name'] . "<a href='addFriend.php' target='_blank'><i class='fas fa-user-plus'></i></a></div><br/>";
                        }
                    } else {
                        echo "No results found";
                    }
                }

            ?>

            <div class="newMessage">
                <i class="far fa-envelope letter"></i>
            </div>
        </div>
        <div class="messages">
            <?php

                $image = $_SESSION['image'];
                foreach($messages as $message) {
                    echo "<div class='message'>";
                    echo "<img src='$image' alt='Avatar' id='avatar-s' />";
                    echo $message['text']."</div>";
                }

            ?>
            <div class="popupWindow hidden">
                <form action="#" class="newMessageForm" method="post">
                    <input id="receiverName" type="text" placeholder="Receiver name or id" name="receiverName">
                    <textarea name="messageText"></textarea><br/>
                    <input class="sendBtn" type="submit" name="submitBtn" value="Send">
                </form>
            </div>

        </div>
    </div> 
    <div class="profile">
        <div class="content">
            <a id="link" href="avatarChange.php"><img src="<?php echo $_SESSION['image'] ?>" alt="Avatar" id="avatar" /></a>
            <p><?php echo $_SESSION['name']  ?></p>
            <a href="logout.php" id="link">Logout</a>
            <a href="profileDelete.php" id="link">Delete account</a>
        </div>     
    </div>
</body>

</html>

<?php


$conn->close();

?>

