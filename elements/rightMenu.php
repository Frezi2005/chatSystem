<div class="profile">
    <div class="content">
        <a id="link" href="avatarChange.php"><img src="<?php echo $_SESSION['image'] ?>" alt="Avatar" id="avatar" /></a>
        <p><?php echo $_SESSION['name']  ?></p>
        <a href="logout.php" id="link">Logout</a>
        <a href="profileDelete.php" id="link">Delete account</a>
    </div>     
</div>