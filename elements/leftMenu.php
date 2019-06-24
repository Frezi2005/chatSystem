<?php
    session_start();
?>

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
                    echo "<div class='user'>" . $row['user_name'] . "</div><br/>";
                }
            } else {
                echo "No results found";
            }
        }
        $userId = $_SESSION['user_id'];
        $sqlToGetFriends = "SELECT * FROM `users` WHERE id = '$userId'";
        $result2 = $conn->query($sqlToGetFriends);
        $result2 = $result2->fetch();
        $friends = $result2['friends'];
        $friendsArray = explode(", ", $friends);
        foreach($friendsArray as $friend) {
            $sqlTogetFriendName = "SELECT user_name FROM `users` WHERE id='$friend'";
            $name = $conn->query($sqlTogetFriendName);
            $name = $name->fetch();
            echo $name['user_name']."<br /><br />";
        }
    ?>

    <div class="newMessage">
        <i class="far fa-envelope letter"></i>
    </div>
    <div class="addFriend">
        <a href="addFriend.php" target="_blank" id="link"><i class="fas fa-plus plus"></i></a>
    </div>
</div>