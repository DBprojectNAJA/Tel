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
   
    ชื่อ  
    <select name="cus_prefix">
        <option>นาย</option>
        <option>นาง</option>
        <option>นางสาว</option>
        
    </select>
       <input type="text" name="cus_name"><br>
    
    
    
    เบอร์ลูกค้า * <br>  <input type="number" name="cus_tel" required><br>
    
   
        <input type="submit" name="send" value="send">
    </form>
    </div>
</body>
</html>