<html>
    <body>
<?php

session_start();
unset($_SESSION['username']);

header('Location: logintest.php');

?>


</body>
</html>