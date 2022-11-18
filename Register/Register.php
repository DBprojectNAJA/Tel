<?php include "../connect/connect.php";
    $name = $_GET['name'];
    $str = str_replace("%", " ", $name);
?>

<html>

<head>
<?php include "../nav/nav.php" ?>
<mega charset="utf-8">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
                font-family: 'Prompt';
            }
        .register{display: block;
            margin-bottom: 50px;
            justify-content: center;
            background-color:white;
            margin: 130px 500px 193.8px;
            padding: 5%;
            border-radius: 10px;
        }
        body {
                margin: 0px auto 0px auto;
                background-color: #7FB5FF;
            }
        h1{ 
            text-align: center;
            font-size: 72px;
        }
    </style>    
</head>

<body>
    <h1>ลงทะเบียน</h1>
    <div class="register">
        <h2> Register </h2>
        <form action="insert-new-customer.php" method="post">

            ชื่อ
            <select name="cus_prefix">
                <option>นาย</option>
                <option>นาง</option>
                <option>นางสาว</option>

            </select>
            <input type="text" name="cus_name" value="<?php echo $str ?>" readonly><br>



            เบอร์ลูกค้า * <br> <input type="tel" name="cus_tel" required><br>


            <input type="submit" name="send" value="send">
        </form>
    </div>
</body>

</html>