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
            unset($_POST['receiverName']);
            unset($senderId);
            unset($_POST['messageText']);
        }

    }


    //Setting profile image
    $sqlToGetProfileImage = "SELECT * FROM users WHERE id = '$userId'";
    $result = $conn->query($sqlToGetProfileImage);
    $image = $result->fetch();
    $image = $image['profileImage'];
    $_SESSION['image'] = $image;
?>

<html>

<head>
    <link href="./css/mainPageStyle.css" type="text/css" rel="stylesheet">
    <script src="scripts.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <title>Connect - main page</title>
</head>

<body>
    <div id="blur">
        <div class="container" style="width: 100%;">
            <?php require("elements/leftMenu.php"); ?>
            <div class="messages">
                <?php

                    $image = $_SESSION['image'];
                    //if ($messages['sender_user_id'] == )
                    foreach($messages as $message) {
                        echo "<div class='message'>";
                        echo "<img src='$image' alt='Avatar' id='avatar-s' />";
                        echo $message['text']."</div><br/>";
                    }

                ?>
            </div>
        </div> 
        <?php require("elements/rightMenu.php"); ?>
    </div>
    <div class="popupWindow hidden">
        <form action="#" class="newMessageForm" method="post">
            <input id="receiverName" type="text" placeholder="Receiver name or id" name="receiverName">
            <textarea name="messageText"></textarea><br/>
            <input class="sendBtn" type="submit" name="submitBtn" value="Send">
        </form>
    </div>

    <?php
        $sqlToCheckMessage = "SELECT * FROM `messages` WHERE receiver_user_id = '$userId'";
        $result2 = $conn->query($sqlToCheckMessage);
        $result2 = $result2->fetch();

        if ($result2['Unread'] == 0) {

            echo " 
            <audio controls class='hidden' autoplay>
                <source src='sounds/alert.mp3' type='audio/mpeg'>
                Your browser does not support the audio element.
            </audio> ";
            $sqlToUpdateMessages = "UPDATE `messages` SET `Unread`= 1 WHERE receiver_user_id = '$userId'";
            $conn->query($sqlToUpdateMessages);

        }

       
    ?>
</body>

</html>


