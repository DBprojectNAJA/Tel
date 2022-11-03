<?php include "../connect.php"?>
<html>
    <head>
        <?php include "../nav/nav_login.php" ?>
    </head>
    <body>
        <center>
            <form action="login-check.php" method="post">
            Username: <input type="text" name="employee_id"><br>
            Password: <input type="password" name="emp_tel"><br>
            <input type="submit" value="Login">
            </form>
        </center>
    </body>
</html>