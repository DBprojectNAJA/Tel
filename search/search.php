<?php
include "../connect.php";
session_start();
?>
<html>

<head>
    <mega charset="utf-8">
        <link href="https://fonts.googleapis.com/css2?family=Mali&family=Prompt:wght@200&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <style>
            * {
                font-family: 'Prompt';
            }

            body {
                margin: 0px auto 0px auto;
                background-color: #06283D;
            }

            nav {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
            }

            ul {
                list-style-type: none;
                margin: 0px;
                padding: 0px;
                overflow: hidden;
                background-color: #47B5FF;
            }

            li {
                float: left;
            }

            li a {
                /* display: flex; */
                display: inline-flex;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            li a:hover {}

            #logo {
                width: 30px;
            }

            .head-search {
                margin: 20% 20% 10% 20%;
                padding: 5%;
                background-color: white;
            }

            table {
                border-collapse: collapse;
                width: 98%;
            }

            td {
                padding-top: 5px;
                padding-bottom: 5px;
            }

            th,
            td {
                padding-left: 15px;
                text-align: left;
            }

            .tel-table tr {
                border-bottom: 1px solid #ddd;
            }

            .tel-table tr:hover {
                background-color: whitesmoke;
            }

            .content {
                margin: 0px 20px 50px 20px;
                padding: 20px;
                background-color: white;
            }

            .h {
                font-size: 25px;
            }

            hr.style1 {
                border-top: 1px solid #8c8b8b;
                border-bottom: 1px solid #fff;
            }

            img {
                width: 2%;
                display: block;
                margin-left: auto;
                margin-right: auto;
            }

            button {
                margin-top: 10px;
                display: block;
                margin-left: auto;
                margin-right: 1%;
            }

            footer {
                height: 10%;
                background: #47B5FF;
                color: #06283D;
                margin: 0px;
                font-size: 20px;
                text-align: center;
            }
        </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="../../Tel/"><img src="../img/logo.png" id="logo"> Technic telephone</a></li>
            <li style="float:right; background-color:black;"><a href=""><?php echo $_SESSION["emp_name"]; ?></a></li>
            <li style="float:right">
                <?php
                if ($_SESSION['is_repairman']) {
                ?>
                    <a href='../RepairPanel/repairPanel.php'>อัพเดทสถานะการซ่อม</a><br>

                <?php
                }
                ?>
            </li>
            <li style="float:right"><a href="../Query/index1.php">ลูกค้า</a></li>
            <li style="float:right"><a href="../Query/index4.php">ซ่อมสำเร็จ</a></li>
            <li style="float:right"><a href="../Query/index3.php">ใบแจ้งหนี้ทั้งหมด</a></li>
        </ul>
    </nav>
    <div class="head-search" align="center">
    <div class="search">
        <form>
            <label>กรอกชื่อ-สกุล/รหัสโทรศัพท์</label><br>
            <input type="text" name="search-by-name-or-telid" style="text-align:center"
            value='<?php 
            $value=(
            isset($_GET["search-by-name-or-telid"])) ? 
            $_GET["search-by-name-or-telid"] : "";
             echo $value;
            ?>'>
            <input type="submit" value="ค้นหา" class="submit-button">
        </form>
    </div>
    <div style="font-size: 14px;">
    <?php
    if (isset($_GET["search-by-name-or-telid"])){
        $cus_name=$_GET["search-by-name-or-telid"];
        ?>
        <a href='../Phone/insert-phone.php?cus_name=<?=$cus_name ?>'>เพิ่มเครื่อง</a>
        <a href='../Request/request_form.php?cus_name=<?=$cus_name ?>'>เพิ่มคำร้อง</a>
        <a href=''>ชำระเงิน</a>
    <?php } ?>
    </div>
    </div>
    <div class="content">
        <?php
        if (empty($_GET)) {
        } else {
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
            $stmt->bindParam(1, $_GET["search-by-name-or-telid"]);
            $stmt->execute();

            $stmt2 = $pdo->prepare("SELECT telephone.tel_id,telephone.tel_model,telephone.color,
            customer.cus_tel FROM telephone JOIN customer
            where customer.cus_name = telephone.cus_name
            AND telephone.cus_name like ?");
            $check = 0;
            $nameforsearch = str_replace(" ", "%", $_GET["search-by-name-or-telid"]);
            $stmt4 = $pdo->prepare("SELECT customer.cus_name,telephone.tel_model,
            request.request_date,repair_detail.repair_status,
            telephone.tel_id,invoice.cost,repair_detail.finish_date,
            repair_detail.finish_date,repair_detail.finish_date,
            request.request_status,request.request_id 
            FROM invoice INNER JOIN Repair_detail JOIN Request JOIN Telephone JOIN Customer
            WHERE invoice.repair_id = Repair_detail.repair_id 
            AND Repair_detail.request_id = Request.request_id 
            AND Request.tel_id = Telephone.tel_id 
            AND Telephone.cus_name = Customer.cus_name
            AND customer.cus_name LIKE ?
            ORDER BY Request.request_id DESC;
            ");
            $stmt4->bindParam(1, $nameforsearch);
            $stmt4->execute();
        ?>

            <?php while($row4 = $stmt4->fetch()){
            if($check==0){ ?>
                <div class="h">ประวัติคำร้อง 'คุณ<?=$_GET["search-by-name-or-telid"]?>'</div>
                <hr class="style1">
            <?php } 
            $check=1;
            $row4["request_date"]=date('d/m/Y', strtotime($row4["request_date"]));
            if(!$row4["finish_date"]){
                $warranty_date='';
                $pick_up_before_date='';
            }else{
                $row4["finish_date"]=date('d/m/Y', strtotime($row4["finish_date"]));
                $warranty_date=date('d/m/Y', strtotime('+3 months',strtotime($row4["finish_date"])));
                $pick_up_before_date=date('d/m/Y', strtotime('+1 years',strtotime($row4["finish_date"])));
            }
            switch($row4["repair_status"]){
                case 'repaired' : $row4["repair_status"] = 'ซ่อมสำเร็จ';
                            break;
                case 'require spare part' : $row4["repair_status"] = 'กำลังจัดหาอะไหล่';
                            break;
                case 'repaired in progress' : $row4["repair_status"] = 'อยู่ระหว่างการซ่อม';
                            break;
            }
            switch($row4["request_status"]){
                case 'awaiting' : $row4["request_status"] = 'อยู่ระหว่างการซ่อม';
                            break;
                case 'pending' : $row4["request_status"] = 'รอชําระเงิน';
                            break;
                case 'fulfill' : $row4["request_status"] = 'สําเร็จ';
                            break;
                case 'canceled' : $row4["request_status"] = 'ยกเลิกคําร้อง';
                            break;
            }
            ?>
            <table class="tel-table" align="center">
            <tr>
                <th>รหัสคำร้อง</th>
                <td><?=$row4["request_id"]?></td>
            </tr>
            <tr>
                <th>รหัสโทรศัพท์</th>
                <td><a href="Search.php?search-by-name-or-telid=<?=$row4["tel_id"]?>"><?=$row4["tel_id"]?></a></td>
            </tr>
            <tr>
                <th>ชื่อ</th>
                <td><?=$row4["cus_name"]?></td>
            </tr>
            <tr>
                <th>รุ่น</th>
                <td><?=$row4["tel_model"]?></td>
            </tr>
            <tr>
                <th>วันที่นำมาซ่อม</th>
                <td><?=$row4["request_date"]?></td>
            </tr>
            <tr>
                <th>สถานะของโทรศัพท์</th>
                <td><?=$row4["repair_status"]?></td>
            </tr>
            <?php if($row4["finish_date"]){ ?>
                <tr>
                <th>ราคา</th>
                <td><?=$row4["cost"]?></td>
            </tr>
            <tr>
                <th>วันที่ซ่อมเสร็จ</th>
                <td><?=$row4["finish_date"]?></td>
            </tr>
            <tr>
                <th>วันที่หมดประกัน</th>
                <td><?=$warranty_date?></td>
            </tr>
            <tr>
                <th>ควรมารับก่อน</th>
                <td><?=$pick_up_before_date?></td>
            </tr>
            <?php } ?>
            <tr>
                <th>สถานะการจ่ายเงิน</th>
                <td><?=$row4["request_status"]?></td>
            </tr>
            </table>
            <?php if($row4["request_status"]=='รอชําระเงิน'){?>
                <button onclick="location.href=' '" >ชำระเงิน</button>
            <?php } ?>
            <br><img src="../img/screwdriver.png"><img src="../img/screwdriver.png"><img src="../img/screwdriver.png"><br>
            <?php }
            $check == 0; ?>
            <?php while ($row = $stmt->fetch()) {
                if ($check == 0) { ?>
                    <div class="h">ประวัติการซ่อม '<?= $_GET["search-by-name-or-telid"] ?>'</div>
                    <hr class="style1">
                <?php }
                $check = 1;
                $nameforsearch = str_replace(" ", "%", $row["cus_name"]);
                $row["request_date"] = date('d/m/Y', strtotime($row["request_date"]));
                if (!$row["finish_date"]) {
                    $warranty_date = '';
                    $pick_up_before_date = '';
                } else {
                    $row["finish_date"] = date('d/m/Y', strtotime($row["finish_date"]));
                    $warranty_date = date('d/m/Y', strtotime('+3 months', strtotime($row["finish_date"])));
                    $pick_up_before_date = date('d/m/Y', strtotime('+1 years', strtotime($row["finish_date"])));
                }
                switch ($row["repair_status"]) {
                    case 'repaired':
                        $row["repair_status"] = 'ซ่อมสำเร็จ';
                        break;
                    case 'require spare part':
                        $row["repair_status"] = 'กำลังจัดหาอะไหล่';
                        break;
                    case 'repaired in progress':
                        $row["repair_status"] = 'อยู่ระหว่างการซ่อม';
                        break;
                }
                switch ($row["request_status"]) {
                    case 'awaiting':
                        $row["request_status"] = 'อยู่ระหว่างการซ่อม';
                        break;
                    case 'pending':
                        $row["request_status"] = 'รอชําระเงิน';
                        break;
                    case 'fulfill':
                        $row["request_status"] = 'สําเร็จ';
                        break;
                    case 'canceled':
                        $row["request_status"] = 'ยกเลิกคําร้อง';
                        break;
                }
                ?>
                <table class="tel-table" align="center">
                    <tr>
                        <th>ชื่อ</th>
                        <td><?= $row["cus_name"] ?></td>
                    </tr>
                    <tr>
                        <th>รุ่น</th>
                        <td><?= $row["tel_model"] ?></td>
                    </tr>
                    <tr>
                        <th>วันที่นำมาซ่อม</th>
                        <td><?= $row["request_date"] ?></td>
                    </tr>
                    <tr>
                        <th>สถานะของโทรศัพท์</th>
                        <td><?= $row["repair_status"] ?></td>
                    </tr>
                    <tr>
                        <th>รหัสโทรศัพท์</th>
                        <td><?= $row["tel_id"] ?></td>
                    </tr>
                    <?php if ($row["finish_date"]) { ?>
                        <tr>
                            <th>ราคา</th>
                            <td><?= $row["cost"] ?></td>
                        </tr>
                        <tr>
                            <th>วันที่ซ่อมเสร็จ</th>
                            <td><?= $row["finish_date"] ?></td>
                        </tr>
                        <tr>
                            <th>วันที่หมดประกัน</th>
                            <td><?= $warranty_date ?></td>
                        </tr>
                        <tr>
                            <th>ควรมารับก่อน</th>
                            <td><?= $pick_up_before_date ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th>สถานะการจ่ายเงิน</th>
                        <td><?= $row["request_status"] ?></td>
                    </tr>
                </table>
                <br><img src="../img/screwdriver.png"><img src="../img/screwdriver.png"><img src="../img/screwdriver.png"><br>
            <?php } ?>
            <?php
            if ($check == 0) {
                $nameforsearch = str_replace(" ", "%", $_GET["search-by-name-or-telid"]);
            }
            $stmt2->bindParam(1, $nameforsearch);
            $stmt2->execute();
            $nameforsearch = str_replace("%", " ", $nameforsearch);
            ?>
    </div>
    <div class="content">
        <?php while ($row2 = $stmt2->fetch()) {
                if ($check == 0 || $check == 1) { ?>
                <div class="h">ข้อมูลลูกค้า</div>
                <hr class="style1">
                คุณ<?= $nameforsearch ?> | โทร <?= $row2["cus_tel"] ?><br><br>
                <?php $nameforsearch = str_replace(" ", "%", $nameforsearch);
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
                    $stmt3->bindParam(1, $nameforsearch);
                    $stmt3->execute();
                    $total = 0;
                    $reciept = 0;
                    while ($row3 = $stmt3->fetch()) {
                        if ($reciept == 0) { ?>
                        <b>โทรศัพท์ที่ค้างชำระ</b><br>
                        <table border="1" class="inv-table" align="center">
                            <tr>
                                <th>รหัสโทรศัพท์</th>
                                <th>รุ่นโทรศัพท์</th>
                                <th>สี</th>
                                <th>อาการผิดปกติ</th>
                                <th>ราคา</th>
                            </tr>
                        <?php }
                        $reciept = 1; ?>
                        <tr>
                            <td><?= $row3["tel_id"] ?></td>
                            <td><?= $row3["tel_model"] ?></td>
                            <td><?= $row3["color"] ?></td>
                            <td><?= $row3["abnormality"] ?></td>
                            <td align="right"><?= $row3["cost"] ?>.00</td>
                        </tr>
                    <?php $total += $row3["cost"];
                    }
                    if ($reciept == 1) { ?>
                        <tr>
                            <td align="center" colspan="4">รวม</td>
                            <td align="right"><?= $total ?>.00</td>
                        </tr>
                    <?php } ?>
                        </table><br>
                        <?php /*if ($reciept == 1) { */?>
                            <!-- <button onclick="location.href='../reciept/reciept.php';">พิมพ์ใบเสร็จรับเงิน</button><br> -->
                            <?php /* $_SESSION["cus_reciept"] = $nameforsearch; */?>
                        <?php /* } */?>
                        <b>โทรศัพท์ที่เคยลงทะเบียนกับทางร้าน</b><br>
                        <table border="1" class="tel-reg-table" align="center">
                            <tr>
                                <th>รหัสโทรศัพท์</th>
                                <th>รุ่นโทรศัพท์</th>
                                <th>สี</th>
                            </tr>
                        <?php }
                    $check = 2; ?>
                        <tr>
                            <td><a href="Search.php?search-by-name-or-telid=<?= $row2["tel_id"] ?>"><?= $row2["tel_id"] ?></a></td>
                            <td><?= $row2["tel_model"] ?></td>
                            <td><?= $row2["color"] ?></td>
                        </tr>
                    <?php } ?>
                        </table>
                    <?php if ($check == 0) {
                        $str = str_replace(" ", "%", $nameforsearch);
                        echo "<meta http-equiv=refresh content=0;URL=../Register/Register.php?name=" . $str . ">";
                    }
                } ?>
    </div>
    <footer>
        <p><b>Technic telephone since 1987</b></p>
    </footer>
</body>

</html>