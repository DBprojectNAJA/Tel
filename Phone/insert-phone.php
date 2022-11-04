<?php include "../connect.php" 

?>
<html>
    <head>
    <mega charset="utf-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
                font-family: 'Prompt';
            }
        h1{
            text-align: center;
            font-weight: bold;
            font-size: 72px;
        }

        .add{display: block;
            margin-bottom: 50px;
            justify-content: center;
            background-color:white;
            margin: 15vh 20% 20vh 20%;
            padding: 5%;
            border-radius: 10px;
            /* text-align: center; */
        }
        body {
                margin: 0px auto 0px auto;
                background-color: #7FB5FF;
            }
        .main{
            margin: 130px 370px 193.8px;
            position: static;
            left: 0;
            right: 0;
        }
    </style>
    </head>
    <body>

    <?php include "../nav/nav_login.php" ?>
    <?php include "../nav/nav.php" ?>
    <h1> เพิ่มเครื่องเข้าระบบ </h1>
    <div class="main">
        <div class="add">
        <form action="insert-phone-to-database.php?cus_name=<?=$_GET['cus_name'] ?>" method="post">
            tel_model: <input type="text" name="tel_model"><br>
            color: <input type="text" name="color"><br>
            <input type="submit" value="add">
    </div>        
        </form>
    </div>      
</body>
</html>        