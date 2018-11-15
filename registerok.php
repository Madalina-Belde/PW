<html>
      <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="customstyle.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

    <body>
<?php

class MyDB extends SQLite3
{
    function __construct()
    {
        $this->open('testdb.db');
    }
}

    $myusername = $_POST['user'];
    $mypassword = $_POST['pass'];

    $myusername = stripslashes($myusername);
    $mypassword = stripslashes ($mypassword);

    $userexists = false;

$db = new MyDB();

if($myusername == "admin")
{
     echo "User ".$myusername." already exists. Please choose another one !";
    $userexists = true;
}
else if ($myusername == "")
{
	echo "Username field is empty. Please choose another one !";
    $userexists = true;
}
else
{
	/* check if user exists */
	$result = $db->query("SELECT * FROM users WHERE username='$myusername'");

	$array = $result->fetchArray(SQLITE3_ASSOC);

	if($array)
	{
		echo "User ".$myusername." already exists. Please choose another one !";
		$userexists = true;
	}
	else
	{

		$result = $db->exec("INSERT INTO users VALUES('$myusername', '$mypassword', '0')");

		echo "User added !";

		header('Location: logintest.php');

	}
}


if($userexists == true)
{
?>

<br></br>
<form action="register.php" method="POST">
        <input type="submit" value="Back"/>
</form>
<?php
}
?>
</body>
</html>