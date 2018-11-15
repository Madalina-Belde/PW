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


$db = new MyDB();

$filterreq = false;
$showrestable = false;

session_start();


if(isset($_POST['user']) && isset($_POST['pass']))
{
    $myusername = $_POST['user'];
    $mypassword = $_POST['pass'];

    $myusername = stripslashes($myusername);
    $mypassword = stripslashes ($mypassword);

    $result = $db->query("SELECT * FROM users WHERE username='$myusername' AND password='$mypassword'");

    $showrestable = true;
	
	$usern = $myusername;
	
}
    
else if(isset($_POST['filter']))
    {
		$usern = $_SESSION['username'];
	
        $filterstring = $_POST['filter'];
        $filterstring = stripslashes ($filterstring);

        $filterreq = true;

        $result = $db->query("SELECT * FROM users WHERE username LIKE '%$filterstring%' AND access='0'");
    }
    else if(isset($_SESSION['username']))
    {
        $usern = $_SESSION['username'];

         $result = $db->query("SELECT * FROM users WHERE username='$usern'");

         $showrestable = true;
    }
else
{
    if(isset($_SESSION['username']))
    {
        $usern = $_SESSION['username'];
    }
    else
    {
        $usern = "";
    }

    $showrestable = true;

   
        $result = $db->query("SELECT * FROM users WHERE access='1'");
}

if(isset($_POST['cars']) && isset($_POST['arrival']) && isset($_POST['departure'])) 
{
    $reservuser = $_SESSION['username'];
    $reservroom = $_POST['cars'];
    $reservardate = $_POST['arrival'];
    $reservdepdate = $_POST['departure'];
    $resulttemp = $db->exec("INSERT INTO reservation VALUES('$reservuser', '$reservroom', '$reservardate', '$reservdepdate')");

    echo "Room has been reserved ";

    header('Location: login.php');
             
}

$array = $result->fetchArray(SQLITE3_ASSOC);


if($showrestable == true)

{


 if(($array) && ($usern != "admin"))
             {

                 $resultres = $db->query("SELECT * FROM reservation WHERE user='$usern'");
        ?>
<table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr class="info">
                    <th align="center" class="normalContactTextTitle">Room</th>
                    <th align="center" class="normalContactTextTitle">Arrival date</th>
                    <th align="center" class="normalContactTextTitle">Departure date</th>
                    <th align="center" class="normalContactTextTitle">Delete</th>
                </tr>
            </thead>
            <tbody>

<?php
            while($res = $resultres->fetchArray(SQLITE3_ASSOC))
            {
                ?>
                   <tr>   
                    <td class="normalContactText">
                        <?php
                        echo $res['room'] ;            
                        ?>
                    </td>
                    <td>
                         <?php
                        echo $res['fromdate'] ;            
                        ?>
                    </td>
                    <td>
                         <?php
                        echo $res['todate'] ;            
                        ?>
                    </td>
                     <td>
                       <form action="delete.php" method="POST">
                            <input type="hidden" name="room" value=<?php echo $res['room'] ?> />
                            <input type="hidden" name="from" value=<?php echo $res['fromdate'] ?> />
                            <input type="hidden" name="to" value=<?php echo $res['todate'] ?> />
                            <input type="submit" class="btn btn-info btn-lg" value="delete entry"/>
                        </form> 
                    </td>
                </tr> 

                <?php
            }
            ?>
            </tbody>
            </table>
            <?php
             }
}


if($array)
{

    if(isset($_POST['user']))
    {
        $_SESSION['username'] = $myusername;
    }
    

    if(($array['access'] == "1") || ($filterreq == true))
    {
        if($filterreq == false)
        {
            $result = $db->query("SELECT * FROM users WHERE access='0'");
        }
        else
        {
            $result = $db->query("SELECT * FROM users WHERE username LIKE '%$filterstring%' AND access='0'");
        }

        ?>
         <form action="login.php" method="POST">
            <input type="text" name="filter" /> <input type="submit" class="btn btn-info btn-lg" value="filter"/>
         </form> 

         <table class="table table-bordered table-hover table-responsive">
            <thead>
                <tr class="info">
                    <th align="center" class="normalContactTextTitle">Username</th>
                    <th align="center" class="normalContactTextTitle">Delete</th>
                </tr>
            </thead>
            <tbody>

    <?php
        while ($simpleusers = $result->fetchArray(SQLITE3_ASSOC)) 
        {
            ?>

          
                <tr>   
                    <td class="normalContactText">
                        <?php
                        echo $simpleusers['username'] . '<br />';            
                    
                        ?>
                    </td>
                    <td>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="username" value=<?php echo $simpleusers['username'] ?> />
                            <input type="submit" class="btn btn-info btn-lg" value="delete user"/>
                        </form> 
                    </td>
                </tr>
            <?php


        }
        ?>

        
            </tbody>
        </table>
<?php

    }
    else
    {
       ?>
       <form action="login.php" method="POST">
       <?php

            if(isset($_POST['arrival']))
            {

                ?>
                <p>Arrival : </p> <input type="date" value="<?php echo $_POST['arrival']; ?>" name="arrival"/> 
                <?php
            }
            else
            {
                ?>
                <p>Arrival : </p> <input type="date" value="date" name="arrival"/> 
                <?php
            }
       ?>

        
        <br></br>
        <?php

            if(isset($_POST['departure']))
            {
                ?>
                <p>Departure : </p> <input type="date" value="<?php echo $_POST['departure']; ?>" name="departure"/> 
                <?php
            }
            else
            {
                ?>
                <p>Departure : </p> <input type="date" value="date" name="departure"/> 
                <?php
            }
            ?>
        <br></br>

        <input type="submit" value="Search">
                        </form>

       <?php

        if(isset($_POST['arrival']) && (isset($_POST['departure'])))
        {
			if(($_POST['arrival'] != "") && ($_POST['departure'] != ""))
			{
		
?>

            <form action="login.php" method="POST">

                <input type="hidden" value="<?php echo $_POST['arrival']; ?>" name="arrival"/> 
                <input type="hidden" value="<?php echo $_POST['departure']; ?>" name="departure"/> 
        <br></br>
        <?php



            $result = $db->query("SELECT * FROM reservation");
            $array = $result->fetchArray(SQLITE3_ASSOC);
            if($array)
            {

                                $selardateoriginal = $_POST['arrival'];
                                $seldepdateoriginal = $_POST['departure'];
                                $selardate = explode("-", $_POST['arrival']);
                                $seldepdate = explode("-", $_POST['departure']);

                                $selaryear = $selardate[0];
                                $selarmonth = $selardate[1];
                                $selarday = $selardate[2];

                                $seldepyear = $seldepdate[0];
                                $seldepmonth = $seldepdate[1];
                                $seldepday = $seldepdate[2];

                                

                                if($seldepyear < $selaryear)
                                {
                                    echo "Departure date is smaller than arrival date !";
                                    echo "<br></br>";
                                     
                                }
                                else if($seldepmonth < $selarmonth)
                                {
                                    echo "Departure date is smaller than arrival date !";
                                    echo "<br></br>";
                                }
                                else if($seldepday <= $selarday)
                                {
                                    echo "Departure date is smaller than arrival date !";
                                    echo "<br></br>";
                                }
                                else
                                {


                ?>
                    <select name="cars"> 
                            <?php

                                $result = $db->query("SELECT * FROM rooms");
                                while($room = $result->fetchArray(SQLITE3_ASSOC))
                                {
                                    $crtroom =  $room['name'];
                                        $roomfree = true;
                                        $result1 = $db->query("SELECT * FROM reservation WHERE room='$crtroom'");
                                        while($reserv = $result1->fetchArray(SQLITE3_ASSOC))
                                        {
                                            
                                            $crtardateoriginal = $reserv['fromdate'];
                                            $crtdepdateoriginal = $reserv['todate'];

                                            $crtardate = explode("-", $reserv['fromdate']);
                                            $crtdepdate = explode("-", $reserv['todate']);
                                            
                                            $crtaryear = $crtardate[0];
                                            $crtarmonth = $crtardate[1];
                                            $crtarday = $crtardate[2];

                                            $crtdepyear = $crtdepdate[0];
                                            $crtdepmonth = $crtdepdate[1];
                                            $crtdepday = $crtdepdate[2];


                                            echo "selardateoriginal : ".$selardateoriginal;

                                            if($selardateoriginal > $crtdepdateoriginal)
                                            {
                                                continue;
                                            }
                                            else if ($selardateoriginal == $crtdepdateoriginal)
                                            {
                                                $roomfree = false;
                                                break;
                                            }
                                            else
                                            {
                                                if($selardateoriginal >= $crtardateoriginal)
                                                {
                                                    $roomfree = false;
                                                    break;
                                                }
                                                else
                                                {
                                                    if($seldepdateoriginal < $crtardateoriginal)
                                                    {
                                                        continue;
                                                    }
                                                    else
                                                    {
                                                        $roomfree = false;
                                                        break;
                                                    }

                                                }

                                            }
                                            

                                        }

                                        if($roomfree == true)
                                        {

                            ?>
                                <option value="<?php echo $room['name']; ?>"><?php echo $room['name']; ?></option> 
                            <?php
                                        }
                                }
                            ?>
                        </select> 
                        <br></br>
                        
                        <?php
                                }
            }
            else
            {

                  $selardate = explode("-", $_POST['arrival']);
                                $seldepdate = explode("-", $_POST['departure']);

                                $selaryear = $selardate[0];
                                $selarmonth = $selardate[1];
                                $selarday = $selardate[2];

                                $seldepyear = $seldepdate[0];
                                $seldepmonth = $seldepdate[1];
                                $seldepday = $seldepdate[2];

                                

                                if($seldepyear < $selaryear)
                                {
                                    echo "Departure date is smaller than arrival date !";
                                    echo "<br></br>";
                                     
                                }
                                else if($seldepmonth < $selarmonth)
                                {
                                    echo "Departure date is smaller than arrival date !";
                                    echo "<br></br>";
                                }
                                else if($seldepday <= $selarday)
                                {
                                    echo "Departure date is smaller than arrival date !";
                                    echo "<br></br>";
                                }
                                else
                                {
                ?>
                        <select name="cars">
                            <?php
                                $result = $db->query("SELECT * FROM rooms");
                                while($room = $result->fetchArray(SQLITE3_ASSOC))
                                {
                            ?>
                                <option value="<?php echo $room['name']; ?>"><?php echo $room['name']; ?></option>
                            <?php
                                }

                            ?>
                        </select>
                        <br></br>
                        
                <?php
                                }
            }

?>

<input type="submit" value="Rezerv">
                        </form>
<?php
			}
        }
        ?>
        
        <?php

    }
    ?>
 <form action="logout.php" method="POST">
            <input type="submit" value="Logout">
        </form>

    <?php

}
else
{
	if(isset($_POST['user']) && isset($_POST['pass']))
	{
        echo "Nothing introduced! Login not ok \r\n";
		
		?>
		<br></br>
<form action="logintest.php" method="POST">
        <input type="submit" value="Back"/>
</form>
		<?php
	}
	else
	{
	
	}
}

?>

</body>
</html>