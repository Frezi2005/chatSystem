<html>
    <link href="./css/mainPageStyle.css" type="text/css" rel="stylesheet">
    <script src="scripts.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <meta http-equiv="content-type" content="text/html" charset="utf-8">
    <title>Connect - add friend</title>
</html>

<?php

    session_start();
    require("databaseConn.php");

    require("elements/leftMenu.php");
?>
<div class="container friendsContainer" style="width: 100%;">
    <div class="messages">
        <?php

            $image = $_SESSION['image'];
            $sql = "SELECT * FROM `users`";
            $result = $conn->query($sql);
            $count = $result->rowCount();
            if(!$result->rowCount() == 0){
                while ($friend = $result->fetch()) {
                    $friendImage = $friend['profileImage'];
                    if ($friend['id'] != $_SESSION['user_id']) {
                        echo "<div class='newFriend'>" . $friend['user_name'] . "<a id='link' href='#' ><i class='fas fa-plus add'></i><img src='$friendImage' alt='Avatar' id='avatarFriend' /><a/></div><br/>";  
                    } 
                }
            } else {
                echo "No results found";
            }

        ?>
    </div>
</div> 
<?php
    require("elements/rightMenu.php");

    $userId = $_SESSION['user_id'];
    $friendName = "Pawel";
    $sqlToGetFriendId = "SELECT * FROM `users` WHERE user_name = '$friendName'";
    $sqlTOGetFriendsColumn = "SELECT * FROM `users` WHERE id = '$userId'";
    $friends = $conn->query($sqlTOGetFriendsColumn);
    $friends = $friends->fetch();
    $friends = $friends['friends'];
    $result1 = $conn->query($sqlToGetFriendId);
    $result1 = $result1->fetch();   
    $friendId = $result1['id'];
    $sql = "UPDATE `users` SET `friends`='$friends $friendId, ' WHERE id = $userId";
    $result2 = $conn->query($sql);

?>