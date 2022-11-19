<html>
<?php
include "../connect/connectMysqli.php";
session_start();
if (!isset($_SESSION['employee_id'])) {
    echo "กรุณาเข้าสู่ระบบ";
    header("refresh:2;url=../Login/Login-form.php");
}
$is_telId = false;
$name = $_GET['cus_name'];
$realName = $_GET['cus_name'];
if ($name[0] == 't') {
    $is_telId = true;
}
if ($is_telId) {
    $sql = "SELECT cus_name FROM telephone WHERE tel_id = '$name'";
    $result = $conn->query($sql);
    $realName = mysqli_fetch_array($result)['cus_name'];
}
?>

<head>
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <?php include "../nav/nav.php" ?>
    <style>
        body {
            background:#06283D;
            text-align: center;
        }
        .r1 {
            text-align: left;
            position: relative;
            margin: 0px 200px 0px 200px;
            padding: 1% 0% 0% 30%;
            background-color: #DFF6FF;
            line-height: 40px;
        }
        h1 {
            padding-top: 10px;
            margin: 0px 200px 0px 200px;
            background-color: #DFF6FF;
        }
        #submit {
            background-color: #1363DF; 
            border: outset;
            color: white;
            margin-top: 5px;
            padding: 2px 5px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            font-size: 12px;
            font-weight: bold;
        }
        #submit:hover {
            background-color: #47B5FF; 
            border: outset;
            color: black;
            margin-top: 5px;
            padding: 2px 5px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            font-size: 12px;
            font-weight: bold;
        }
        #bottonB {
            background-color: #1363DF; 
            border: none;
            color: white;
            margin: 10px 20px 10px 20px;
            padding: 10px 22px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            font-size: 13px;
            font-weight: bold;
        }
        #bottonB:hover {
            background-color: #47B5FF; 
            border: none;
            color: black;
            margin: 10px 20px 10px 20px;
            padding: 10px 22px;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            font-size: 13px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php
    if (isset($_SESSION['employee_id'])) {
        $employee_id = $_SESSION['employee_id'];
    ?>
    <h1>แจ้งคำร้อง</h1>
        <div class="r1">
            <section style="min-height: 65vh;">
                <label>
                    เจ้าของคำร้อง
                </label>
                <?php
                $name = $_GET['cus_name'];
                if (isset($name)) { ?>
                    <input type="text" id="name" value="<?php echo $realName ?>" readonly disabled />
                <?php
                }
                ?>
                <div>
                    <label>
                        เครื่องที่จะซ่อม
                    </label>

                    <select name="tel_id" id="tel_id">
                        <option value="" <?php if (!$is_telId) echo "selected" ?> disabled hidden>เลือกเครื่องที่จะซ่อม</option>
                        <?php
                        $str = str_replace(" ", "%", $realName);
                        $sql = "SELECT * FROM telephone WHERE cus_name LIKE '{$str}'";
                        $result = $conn->query($sql);
                        while ($row = mysqli_fetch_array($result)) {
                        ?>
                            <option <?php if ($is_telId && $row['tel_id'] == $name) echo "selected" ?> value="<?php echo $row['tel_id'] ?>">
                                <?php echo $row['tel_id'] ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label>
                        อาการผิดปกติ
                    </label>
                    <br />
                    <textarea id="abnormality" name="abnormality" rows="5"></textarea>
                </div>
                <input type="button" value="ส่งคำร้อง" id="submit" />
            </section>
        </div>
        <a href="../search/search.php?search-by-name-or-telid=<?= $name ?>"><input type="button" value="Back" id="bottonB" /></a>
    <?php
    }
    ?>


</body>
<script>
    $(document).ready(function() {
        $('#submit').click(function() {
            var tel_id = document.getElementById('tel_id').value
            var abnormality = document.getElementById('abnormality').value
            var emp_id = "<?php echo $employee_id ?>"
            if (tel_id == "") {
                alert("กรุณาเลือกเครื่องที่ต้องการซ่อม")
                return
            }
            $.ajax({
                url: "make_request.php", //ส่งไปที่ไหน
                method: "POST",
                data: {
                    tel_id,
                    abnormality,
                    emp_id
                },
                success: function(data) {
                    if (data) {
                        alert("เพิ่มคำร้องสำเร็จ")
                    }
                    console.log(data);
                }

            })


        })
    })
</script>
<footer>
    <?php include "../footer/footer2.php" ?>
</footer>
</html>