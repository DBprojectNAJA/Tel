<?php include "connect.php" ?>
<?php 

?>
<html>
<head>

</head>
<body>
    <div style="">
    <h2> Register </h2>
    <form action="insert-new-customer.php" method="post">
    ชื่อ  <br>  <input type="text" name="cus_name"><br>
    พนักงานที่รับผิดชอบ  <br>  <input type="text" name="employee_id"><br>
    เบอร์ลูกค้า * <br>  <input type="number" name="cus_tel" required><br>
    รุ่นโทรศัพท์บ้าน  <br>  <input type="text" name="tel_model"><br>
    วันที่รับเครื่องมา  <br>  <input type="date" name="tel_model"><br>
    สถานะการซ่อม<br>  <select name="repair_status">
            <option value='choose'> ---choose---</option>
            <option value='repaired'>repaired</option>
            <option value='in progress'>in progress</option>
            <option value='require spare part'>require spare part</option>
            <option value='cancelled'> cancelled </option>
            <option value='awaiting'> awaiting </option> 
            
        </select><br>
        <input type="button" name="send" value="send">
    </form>
    </div>
</body>
</html>