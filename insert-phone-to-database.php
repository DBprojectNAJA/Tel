<?php include "connect.php" ?>
<?php
$stmt = $pdo->prepare("INSERT INTO telephone VALUES ( ?, ?)");
$stmt->bindParam(1,$_POST["tel_model"]);
$stmt->bindParam(2,$_POST["color"]);
$stmt->execute();
?>