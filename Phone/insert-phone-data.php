<?php include "../connect/connect.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<?php
    $stmt = $pdo->prepare("SELECT telephone.tel_id,telephone.tel_model,telephone.color,telephone.cus_name
    FROM telephone WHERE telephone.tel_id like ?
    ");
    $stmt->bindParam(1,$_GET["tel_id"]);
    $stmt->execute();
    $row = $stmt->fetch();
?>

    <h1>รายละเอียดโทรศัพท์</h1>
    tel_id : <?=$row["tel_id"]?><br>
    name : <?=$row["cus_name"]?><br>
    tel_model : <?=$row["tel_model"]?><br>
    color : <?=$row["color"]?><br>
    <a href="edit-phone.php?tel_id=<?=$row["tel_id"]?>">แก้ไข</a> |
    <a href="delect-phone.php?tel_id=<?=$row["tel_id"]?>">ลบ</a>
</body>
</html>