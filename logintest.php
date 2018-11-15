<html>
<head>
</head>

<body>

        <?php
        session_start();
        if(isset($_SESSION['username']))
        {
                header('Location: login.php');
        }
        else
        {

        
        ?>
<form action="login.php" method="POST">
        <p>Username</p><input type ="text" name="user"/>
        <p>Password</p><input type="password" name="pass"/>
        <br />
        <input type="submit" value="login"/>
</form>

<form action="register.php" method="POST">
        <input type="submit" value="register"/>
</form>


<?php
        }
?>
</body>

</html>