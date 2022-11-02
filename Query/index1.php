<?php include "../connect.php"?>
<html>
    <head><meta charset="utf-8"></head>
    <body style="padding:10px; line-height: 30px;">
        <?php
            $stmt = $pdo->prepare("
                SELECT branch.branch_id,COUNT(customer.cus_name) as total_cus
                FROM customer
                INNER JOIN telephone
                ON customer.cus_name = telephone.cus_name
                INNER JOIN request
                ON telephone.tel_id = request.tel_id
                INNER JOIN employee
                ON request.request_caretaker = employee.employee_id
                INNER JOIN branch
                ON employee.branch_id = branch.branch_id
                WHERE branch.branch_id = 'b004'
                GROUP BY customer.cus_name;
            ");
            $stmt2 = $pdo->prepare('    
                SELECT customer.cus_name
                FROM customer
                INNER JOIN telephone
                ON customer.cus_name = telephone.cus_name
                INNER JOIN request
                ON telephone.tel_id = request.tel_id
                INNER JOIN employee
                ON request.request_caretaker = employee.employee_id
                INNER JOIN branch
                ON employee.branch_id = branch.branch_id
                WHERE branch.branch_id = "b004"
                GROUP BY customer.cus_name;'
            );
           
            $stmt->execute();
            $stmt2->execute();
            $row = $stmt->fetch();
        ?>
            รหัสสาขา: <?=$row["branch_id"]?><br>
            จำนวนลูกค้า: <?=$row["total_cus"]?><br>
        <hr>
        <?php while($row = $stmt2->fetch()){ ?>
            ชื่อลูกค้า: <?=$row["cus_name"]?><br>
        <hr>
        <?php } ?>
    </body>
</html>