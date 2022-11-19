<?php include "../connect/connect.php" ?>
<html>
    <head>
    <mega charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../css/insert-phone.css">
    </head>
    <body>

    <?php include "../nav/nav_login.php" ?>
    <?php include "../nav/nav.php" ?>
    <h1> เพิ่มเครื่องเข้าระบบ </h1>
    <div class="main">
        <div>
        <form action="insert-phone-to-database.php?cus_name=<?=$_GET['cus_name'] ?>" method="post">
            tel_model: <input type="text" name="tel_model"><br>
            color: <input type="text" name="color"><br>
            <input type="submit" value="add">
    </div>        
        </form>
    </div>      
</body>
</html>        