<?php
    session_start();
?>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Mali&family=Prompt:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale = 1.0 , maximum-scale = 1.0">
    <style>
        * {
            font-family: 'Prompt';
            margin: 0;
            padding: 0;
        }

        .navContainer {
            padding-bottom: 10vh;
            
        }

        .navContainer nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: #47B5FF;
        }

        .navContainer ul {
            list-style-type: none;
            margin: 0px;
            padding: 0px;
            overflow: visible;
            
        }

        .navContainer li {
            float: left;
        }

        .navContainer li a {
            /* display: flex; */
            display: inline-flex;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navContainer #logo {
            width: 30px;
        }

        #i1:hover {
            background-color: #1363DF;
        }
        #Textlogo:hover {
            color: #06283D;
        }

       @media (max-width:480px) {
        .navContainer li a {
            
            display: inline-block;
            width: auto;
            
        }
       
        
       }
 

    </style>
</head>
<div class="navContainer">
    <nav>
    
        <ul>
            <li><a href="../search/search.php"><img src="../img/logo.png" id="logo"><b style="margin-left: 10px;" id="TextLogo"> Technic telephone</b></a></li>
            <li style="float:right; background-color:black;"><a href=""><?php echo $_SESSION["emp_name"]; ?></a><a href="../index.php">LOG OUT</li>
            <li style="float:right">
                <?php
                if ($_COOKIE['is_repairman']==1) {
                ?>
                    <a href='../RepairPanel/repairPanel.php' id="i1">อัพเดทสถานะการซ่อม</a><br>

                <?php
                }
                ?>
            </li>
            
            <li style="float:right" id="i1"><a href="../Query/index1.php">ลูกค้า</a></li>
            <li style="float:right" id="i1"><a href="../Query/index4.php">ซ่อมสำเร็จ</a></li>
            <li style="float:right" id="i1"><a href="../Query/index3.php">ใบแจ้งหนี้ทั้งหมด</a></li>
        </ul>
        
    </nav>
</div>