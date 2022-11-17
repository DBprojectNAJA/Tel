<?php include "../connect.php"?>
<html>
    <head>
        <?php include "../nav/nav_login.php" ?>
		<link rel="stylesheet" type="text/css" href="login.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
		<script>
			function check() {
				
			}
		</script>
    </head>
    <body>
		<div class="center">
		<div class="bg">
            <form>
				<b>LOG IN</b><br>
				<i class="fa-solid fa-user"></i>
            <input type="text" name="employee_id" placeholder="Username" class="input"><br>
			<i class="fa-solid fa-lock"></i>
            <input type="password" name="emp_tel" placeholder="Password" class="input"><br>
			<?php
			$check=0;
			session_start();
			$stmt = $pdo->prepare("SELECT * FROM employee WHERE employee_id = ? AND emp_tel = ?");
			$stmt->bindParam(1,$_POST["employee_id"]);
			$stmt->bindParam(2,$_POST["emp_tel"]);
			$stmt->execute();
			$row = $stmt->fetch();
				if(!empty($row)){
					session_regenerate_id();
					$_SESSION["employee_id"]=$row["employee_id"];
					$_SESSION["emp_name"]=$row["emp_name"];
					$_SESSION["is_repairman"]=false;
					// $_SESSION["username"]=$row["emp_tel"];
				
					echo "เข้าสู่ระบบสำเร็จ<br>";
					$value=$_POST["employee_id"];
					$check="select repairman_id from repairman where employee_id = '$value'";
					$stmt2 = $pdo->prepare($check);
					$stmt2->execute();
					$row2 = $stmt2->fetch();
					//$_SESSION["username"]=$row["emp_tel"];
					
					//$result=mysql_query($check) or die(mysql_error());
					//$num=mysql_num_rows($result);
					if(empty($row2)){
				
						echo "<a href='../search/search.php'>ไปยังหน้าหลัก</a><br>";
					}
					else{
						$_SESSION["is_repairman"]=true;
						$_SESSION["repairman"]=$row2['repairman_id'];
						echo "<a href='../search/search.php'>ไปยังหน้าหลัก</a><br>";
					}
				}
				else{
					echo "ไม่สำเร็จ ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง";
					echo "<a href='login-form.php'> เข้าสู่ระบบอีกครั้ง</a>";
				}
			?>
	<br>
            <input type="submit" value="Login" class="button" align="center" onclick=check()>
            </form>
		</div>
</div>
    </body>
</html>