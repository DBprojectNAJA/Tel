<?php
include "../connect.php";
?>
<html>
    <head>
        <style>
            .tel-checkbox{
                margin-left: 1%;
            }
        </style>
    </head>
    <body>
<?php
$stmt4 = $pdo->prepare("SELECT customer.cus_name,telephone.tel_model,
            request.request_date,repair_detail.repair_status,
            telephone.tel_id,invoice.cost,repair_detail.finish_date,
            repair_detail.finish_date,repair_detail.finish_date,
            request.request_status,request.request_id,invoice.pay_date
            FROM invoice INNER JOIN Repair_detail JOIN Request JOIN Telephone JOIN Customer
            WHERE invoice.repair_id = Repair_detail.repair_id 
            AND Repair_detail.request_id = Request.request_id 
            AND Request.tel_id = Telephone.tel_id 
            AND Telephone.cus_name = Customer.cus_name
            AND customer.cus_name LIKE ?
            AND invoice.payment_status = 'pending'
            ORDER BY Request.request_id DESC;
            ");
$stmt4->bindParam(1,$_GET["name"]);
$stmt4->execute();?>

<h1>ชำระเงิน</h1>
เลือกโทรศัพท์ที่ต้องการชำระเงิน<br>
<div class="tel-checkbox">
<?php while($row4=$stmt4->fetch()){ 
    if($row4["pay_date"]){
        $row4["pay_date"] = date('d-m-Y', strtotime($row4["pay_date"]));
    }
    ?>
    <input type="checkbox" id="print" name="print" value="<?=$row4["request_id"]?>">
    คำร้อง <?=$row4["request_id"]?> รหัสโทรศัพท์ <?=$row4["tel_id"]?> ราคา <?=$row4["cost"]?> บาท
    <br>
<?php } ?>
</div>
<button onclick="location.href='./recieptprint.php'">ชำระเงิน</button><br>
</body>
</html>