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

session_start();

$db = new MyDB();


    if(isset($_POST['username']))
    {
        $myusername = $_POST['username'];

        $myusername = stripslashes($myusername);

        $result = $db->exec("DELETE FROM users WHERE username='$myusername'");

        $result = $db->exec("DELETE FROM reservation WHERE user='$myusername'");

    }
    if(isset($_POST['room']) && (isset($_POST['from'])) && (isset($_POST['to'])))
    {

        $crtuser = $_SESSION['username'];
        $crtroom = $_POST['room'];
        $crtfrom = $_POST['from'];
        $crtto = $_POST['to'];

        $result = $db->exec("DELETE FROM reservation WHERE user='$crtuser' AND room='$crtroom' AND fromdate='$crtfrom' AND todate='$crtto'");
    }

header('Location: login.php');

$result = $db->query("SELECT * FROM users WHERE access='0'");




        ?>
 <!--        <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr class="info">
                    <th align="center" class="normalContactTextTitle">Username</th>
                    <th align="center" class="normalContactTextTitle">Delete</th>
                </tr>
            </thead>
            <tbody> -->

    <?php
  //      while ($simpleusers = $result->fetchArray(SQLITE3_ASSOC)) 
   //     {
            ?>

          
    <!--            <tr>   
                    <td class="normalContactText">
                        <?php
                      //  echo $simpleusers['username'] . '<br />';            
                    
                        ?>
                    </td>
                    <td>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="username" value=<?php echo $simpleusers['username'] ?> />
                            <input type="submit" class="btn btn-info btn-lg" value="delete user"/>
                        </form> 
                    </td>
                </tr> -->
            <?php


      //  }
        ?>

        
    <!--        </tbody>
        </table> -->


</body>
</html>