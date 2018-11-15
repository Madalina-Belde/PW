<html>
<head>
</head>

<body>
<form action="registerok.php" onsubmit="return passworCheck()" method="POST">
        <p>Username</p><input type ="text" name="user"/>
        <p>password</p><input type="password" name="pass" id="pass1"/>
        <p>Re-enter password</p><input type="password"  id="pass2"/>
        <br />
        <input type="submit" value="login"/>
</form>

<br></br>
<br></br>


<form action="logintest.php" method="POST">
        <input type="submit" value="Back"/>
</form>

<script>
    function passworCheck() {
        var pass1 = document.getElementById("pass1").value;
        var pass2 = document.getElementById("pass2").value;
        var returnval = true;
        if (pass1 != pass2) {
            //alert("Passwords Do not match");
            document.getElementById("pass1").style.borderColor = "#E34234";
            document.getElementById("pass2").style.borderColor = "#E34234";
            returnval = false;
        }

        return returnval;
    }
</script>

</body>

</html>