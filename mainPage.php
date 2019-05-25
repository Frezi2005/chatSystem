<?php
    session_start();
    /*if($_SESSION['loggedIn'] == false) {
        header("Location: index.php");
        unset($_SESSION['loggedIn']);
    }*/
?>

<html>

<head>
    <link href="mainPageStyle.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>

<body>
    
    <div class="channelContainer">
        <form method="GET">
            <input type="search" name="searchQuery" placeholder="Search user" class="searchInput"/>
            <input type="submit" class="searchBtn" value="Search"/>
        </form>
    </div>
    <div class="messages"></div>
</body>

</html>
<?php

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
