<?php
include "../connect.php";
session_start();
?>
<html>

<head>
    <mega charset="utf-8">
</head>

<body>
    <?php
        if ($_SESSION['is_repairman']){
            ?>
        <a href='../RepairPanel/repairPanel.php'>อัพเดทสถานะการซ่อม</a>
        
            <?php 
        }
    ?>
    <?php
    if (isset($_GET["search-by-name-or-telid"])){
        
        $cus_name=$_GET["search-by-name-or-telid"];
        ?>
        <a href='../Phone/insert-phone.php?cus_name=<?=$cus_name ?>'>เพิ่มเครื่อง</a>
        <a href='../Request/request_form.php?cus_name=<?=$cus_name ?>'>เพิ่มคำร้อง</a>
    <?php
}
?>

    <div class="search">
        <form>
            <label>กรอกชื่อ-สกุล/รหัสโทรศัพท์</label><br>
            <input type="text" name="search-by-name-or-telid" 
            value='<?php 
            $value=(
            isset($_GET["search-by-name-or-telid"])) ? 
            $_GET["search-by-name-or-telid"] : "";
             echo $value;
            ?>'><br>
            <input type="submit" value="ค้นหา" class="submit-button">
        </form>
    </div>

    <?php
        if(empty($_GET)){
        }
        else{
            $stmt = $pdo->prepare("SELECT customer.cus_name,telephone.tel_model,
            request.request_date,repair_detail.repair_status,
            telephone.tel_id,invoice.cost,repair_detail.finish_date,
            repair_detail.finish_date,repair_detail.finish_date,
            request.request_status 
            FROM invoice INNER JOIN Repair_detail JOIN Request JOIN Telephone JOIN Customer
            WHERE invoice.repair_id = Repair_detail.repair_id 
            AND Repair_detail.request_id = Request.request_id 
            AND Request.tel_id = Telephone.tel_id 
            AND Telephone.cus_name = Customer.cus_name
            AND Request.tel_id LIKE ?
            ORDER BY Request.request_id DESC;
            ");
            $stmt->bindParam(1,$_GET["search-by-name-or-telid"]);
            $stmt->execute();

            $stmt2 = $pdo->prepare("SELECT telephone.tel_id,telephone.tel_model,telephone.color
            FROM telephone where cus_name like ?"); 
            $check=0;

            ?>
            <?php while($row = $stmt->fetch()){
            if($check==0){ ?>
                รายละเอียดการซ่อมของโทรศัพท์ <?=$_GET["search-by-name-or-telid"]?><br><br>
            <?php } 
            $check=1;
            $nameforsearch = str_replace(" ","%",$row["cus_name"]);
            if(!$row["finish_date"]){
                $warranty_date='';
                $pick_up_before_date='';
            }else{
                $warranty_date=date('Y-m-d', strtotime('+3 months',strtotime($row["finish_date"])));
                $pick_up_before_date=date('Y-m-d', strtotime('+1 years',strtotime($row["finish_date"])));
            }
            ?>
            <table border="1" class="search-table">
            <tr>
                <th>ชื่อ</th>
                <td><?=$row["cus_name"]?></td>
            </tr>
            <tr>
                <th>รุ่น</th>
                <td><?=$row["tel_model"]?></td>
            </tr>
            <tr>
                <th>วันที่นำมาซ่อม</th>
                <td><?=$row["request_date"]?></td>
            </tr>
            <tr>
                <th>สถานะของโทรศัพท์</th>
                <td><?=$row["repair_status"]?></td>
            </tr>
            <tr>
                <th>รหัสโทรศัพท์</th>
                <td><?=$row["tel_id"]?></td>
            </tr>
            <tr>
                <th>ราคา</th>
                <td><?=$row["cost"]?></td>
            </tr>
            <tr>
                <th>วันที่ซ่อมเสร็จ</th>
                <td><?=$row["finish_date"]?></td>
            </tr>
            <tr>
                <th>วันที่หมดประกัน</th>
                <td><?=$warranty_date?></td>
            </tr>
            <tr>
                <th>ควรมารับก่อน</th>
                <td><?=$pick_up_before_date?></td>
            </tr>
            <tr>
                <th>สถานะการจ่ายเงิน</th>
                <td><?=$row["request_status"]?></td>
            </tr>
            </table>
            <br>
            <?php } ?>
            <?php
            if($check==0){
                $nameforsearch = str_replace(" ","%",$_GET["search-by-name-or-telid"]);
            }
            $stmt2->bindParam(1, $nameforsearch);
            $stmt2->execute();
            $nameforsearch = str_replace("%"," ",$nameforsearch);
            ?>
            <?php while($row2 = $stmt2->fetch()){
            if($check==0||$check==1){ ?>
                คุณ<?=$nameforsearch?><br><br>
            <?php $nameforsearch = str_replace(" ","%",$nameforsearch);
                $stmt3 = $pdo->prepare("SELECT telephone.tel_id,telephone.tel_model,telephone.color,
                invoice.payment_status,request.abnormality,invoice.cost
                FROM invoice INNER JOIN Repair_detail JOIN Request JOIN Telephone JOIN Customer
                WHERE invoice.repair_id = Repair_detail.repair_id 
                AND Repair_detail.request_id = Request.request_id 
                AND Request.tel_id = Telephone.tel_id 
                AND Telephone.cus_name = Customer.cus_name
                AND invoice.payment_status = 'pending'
                AND Customer.cus_name LIKE ?
                ");
                $stmt3->bindParam(1,$nameforsearch);
                $stmt3->execute();
                $total=0;
                $reciept=0;
                while($row3 = $stmt3->fetch()){
                if($reciept==0){ ?>
                    โทรศัพท์ที่ค้างชำระ<br>
                    <table border="1" class="search-table">
                    <tr>
                        <th>รหัสโทรศัพท์</th>
                        <th>รุ่นโทรศัพท์</th>
                        <th>สี</th>
                        <th>อาการผิดปกติ</th>
                        <th>ราคา</th>
                    </tr>
                <?php }
                $reciept=1;?>
                    <tr>
                        <td><?=$row3["tel_id"]?></td>
                        <td><?=$row3["tel_model"]?></td>
                        <td><?=$row3["color"]?></td>
                        <td><?=$row3["abnormality"]?></td>
                        <td align="right"><?=$row3["cost"]?>.00</td>
                    </tr>
                    <?php $total+=$row3["cost"]; }
                    if($reciept==1){ ?>
                    <tr>
                        <td align="center" colspan="4">รวม</td>
                        <td align="right"><?=$total?>.00</td>
                    </tr>
                    <?php }?>
                </table>
                <?php if($reciept==1){ ?>
                <a href="../reciept/reciept.php" target="_bank">พิมพ์ใบเสร็จรับเงิน</a><br>
                <?php session_regenerate_id();
                $_SESSION["cus_reciept"]=$nameforsearch; ?>
                <?php } ?>
                โทรศัพท์ที่เคยลงทะเบียนกับทางร้าน<br>
                <table border="1" class="search-table">
                    <tr>
                        <th>รหัสโทรศัพท์</th>
                        <th>รุ่นโทรศัพท์</th>
                        <th>สี</th>
                    </tr>
            <?php }  
            $check=2; ?>
            <tr>
                <td><?=$row2["tel_id"]?></td>
                <td><?=$row2["tel_model"]?></td>
                <td><?=$row2["color"]?></td>
            </tr>
            <?php } ?>
            </table>  
            <?php if($check==0){
                header("location:../Register/Register.php?name=$nameforsearch");
                echo '<meta http-equiv=refresh content=0;URL=Register.php>';
            }
        } ?> 
</body>

</html>