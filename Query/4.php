<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body style="padding:10px; line-height: 30px;">
        <?php
            $stmt=$pdo->prepare("
                select telephone.tel_id,telephone.tel_model,employee.emp_name,repair_detail.finish_date,repair_detail.repair_status
                from telephone
                inner join request
                on telephone.tel_id =request.tel_id
                inner join repair_detail
                on request.request_id=repair_detail.request_id
                inner join repairman
                on repair_detail.repairman_id=repair_detail.repairman_id
                inner join employee
                on repairman.employee_id=employee.employee_id
                where repair_status='repaired';
            ");
            $stmt->execute();?>
            <?php while($row=$stmt->fetch()){ ?>
                ID ของโทรศัพท์ : <?=$row["tel_id"]?><br>
                รุ่นโทรศัพท์ : <?=$row["tel_model"]?>
                <?=$row["emp_name"]?>
                <?=$row["finish_date"]?>
                <?=$row["repair_status"]?>
            <hr>
            <?php
            } ?>
    </body>
</html>