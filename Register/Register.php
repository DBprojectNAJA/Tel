<?php include "../connect.php";
$name = $_GET['name'];
$str = str_replace("%", " ", $name);
?>
<?php

?>
<html>

<head>
<?php include "../nav/nav.php" ?>
</head>

<body>
    <div>
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