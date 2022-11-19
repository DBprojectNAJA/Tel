<?php include "../connect/connect.php" ?>
<html>
<head><meta charset="UTF-8"></head>
<body>
<?php
$stmt = $pdo->prepare("SELECT * FROM telephone WHERE telephone.tel_id = ?");
$stmt->bindParam(1,$_GET["tel_id"]); 
$stmt->execute();
$row = $stmt->fetch();?>

<form action="update-phone.php" method="get">
    tel_id : <input type="text" name="tel_id" value="<?=$row["tel_id"]?>" readonly style="background-color:#ddd"><br>
    name : <input type="text" name="name" value="<?=$row["cus_name"]?>" readonly style="background-color:#ddd"><br>
    tel_model : <input type="text" name="tel_model" value="<?=$row["tel_model"]?>"><br>
    color : <input type="text" name="color" value="<?=$row["color"]?>"><br>
    <input type="submit" value="แก้ไขข้อมูล">
    
</form>
</body>
</html>
