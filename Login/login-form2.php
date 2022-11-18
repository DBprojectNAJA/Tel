<?php include "../connect/connect.php"?>
<html>
    <head>
        <?php include "../nav/nav_login.php" ?>
		<link rel="stylesheet" type="text/css" href="../css/login.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <script>

        </script>
    </head>
    <body>
		<div class="center">
		<div class="bg">
            <form>
				<b>LOG IN</b><br>
				<i class="fa-solid fa-user"></i>
            <input type="text" name="employee_id" placeholder="Username" class="input"><br>
			<i class="fa-solid fa-lock"></i>
            <input type="password" name="emp_tel" placeholder="Password" class="input"><br>
            <div class =
            <input type="submit" value="Login" class="button" align="center" onclick=check()>
            </form>
		</div>
</div>
    </body>
    <?php include "../footer/footer.php"?>
</html>