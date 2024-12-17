<?php

// 檢查使用者是否已登入
include("check_session.php");

// 建立資料庫連線
include("sql_connect.php");
$conn = new mysqli($servername, $username, $password, $dbname);

// 初始化變數
$pid = '';
$name = '';
$birthday = '';
$township = '';
$village = '';
$Neighborhood = '';
$address = '';
$tel = '';
$bankcode = '';
$bankaccount = '';
$gift_money = '';
$Payment_method = '';



// 搜尋符合條件的資料
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pid = $_POST["pid"];
    $stmt = $conn->prepare("SELECT * FROM request_money WHERE pid = ?");
    $stmt->bind_param("s", $pid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        // 取得第一筆資料
        $row = $result->fetch_assoc();

        // 取得欄位值
        $name = $row['name'];
        $birthday = $row['birthday'];
        $township = $row['township'];
        $village = $row['village'];
        $Neighborhood = $row['Neighborhood'];
        $address = $row['address'];
        $tel = $row['tel'];
        $bankcode = $row['bankcode'];
        $bankaccount = $row['bankaccount'];
        $gift_money = $row['gift_money'];
        $Payment_method = $row['Payment_method'];
    }
}

// 當使用者按下「存檔」按鈕時
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $township = $_POST['township'];
    $village = $_POST['village'];
    $Neighborhood = $_POST['Neighborhood'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $bankcode = $_POST['bankcode'];
    $bankaccount = $_POST['bankaccount'];
    $gift_money = $_POST['gift_money'];
    $Payment_method = $_POST['Payment_method'];


    $stmt = $conn->prepare("UPDATE request_money SET name = ?, birthday = ?, township = ?, village = ?, Neighborhood = ?, address = ?, tel = ?, bankcode = ?, bankaccount = ?, gift_money = ? , Payment_method = ? WHERE pid = ?");
    $stmt->bind_param("ssssssssssss", $name, $birthday, $township, $village, $Neighborhood, $address, $tel, $bankcode, $bankaccount, $gift_money, $Payment_method, $pid);
	
	//$stmt->bind_param("ssssssssss", $name, $birthday, $township, $village, $Neighborhood, $address, $tel, $bankcode, $bankaccount, $pid);
    
	
	
	
	$stmt->execute();
	
	
	echo '<header style="text-align-last: center;">
			<a href="index.php">
			<img class="mb-4" src="img/logo.png" alt="" style="max-width: 500px;width: 100%;" >   <!--LOGO-->
			</a>
		</header>';




    
	echo '<div style="border-top: 6px dashed #575757;height: 1px;overflow: hidden;padding-bottom: 50px;"></div>'; //分隔線
    echo '<div class="col-md-12" style="background: #ace5ff; padding: 50px;margin-top: 0;">'; //方框背景
    echo "更新完畢";
	echo "<a href=index.php>回首頁</a> | <a href=request_editor_v2.php>更新下一筆</a>";
	exit();
}

// 關閉資料庫連線
$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
    <title>搜尋與更新資料</title>
	
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="../assets/js/color-modes.js"></script>


<style>
body {
    background: -webkit-linear-gradient(-180deg, rgb(203, 232, 255), rgb(227, 243, 255));
    background: linear-gradient(-180deg, rgb(203, 232, 255), rgb(227, 243, 255));
}
p {
    font-size: 25px;
}
label {
    font-size: 25px;
}


.hidden-div {
        display: none;
    }

</style>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.1/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
 




<div class="col-lg-8 mx-auto p-4 py-md-5"><!--整體寬度-->


<header style="text-align-last: center;"><!--置中-->
<a href="index.php">
     <img class="mb-4" src="img/logo.png" alt="" style="max-width: 500px;width: 100%;" >   <!--LOGO-->
</a>
</header>


<div style="border-top: 6px dashed #575757;height: 1px;overflow: hidden;padding-bottom: 50px;"></div> <!--分隔線-->


<div class="col-md-12" style="background: #ace5ff; padding: 50px;margin-top: 0;"><!--方框背景-->

    <h1 style="font-weight: bold;font-size: 36px;">搜尋與更新資料</h1>

    <form method="POST">
        <label>身分證：</label>
        <input type="text" name="pid" value="<?php echo $pid; ?>">
        <input type="submit" name="search" value="搜尋">
    </form>

    <hr>



    <form method="POST">
        <label>身分證：</label>
        <input type="text" name="pid" value="<?php echo $pid; ?>" readonly><br>
        <label>姓名：</label>
        <input type="text" name="name" value="<?php echo $name; ?>"><br>
        <label>出生日期：</label>
        <input type="text" name="birthday" value="<?php echo $birthday; ?>"><br>
        <label>鄉鎮：</label>
        <input type="text" name="township" value="<?php echo $township; ?>"><br>
        <label>村里：</label>
        <input type="text" name="village" value="<?php echo $village; ?>"><br>
        <label>鄰：</label>
        <input type="text" name="Neighborhood" value="<?php echo $Neighborhood; ?>"><br>
        <label>地址：</label>
        <input type="text" name="address" value="<?php echo $address; ?>"><br>
        <label>電話：</label>
        <input type="text" name="tel" value="<?php echo $tel; ?>"><br>
        <label>銀行代號：</label>
        <input type="text" name="bankcode" value="<?php echo $bankcode; ?>"><br>
        <label>匯款帳號：</label>
        <input type="text" name="bankaccount" value="<?php echo $bankaccount; ?>"><br>
        <label class="hidden-div">禮金：</label>
        <input type="text" name="gift_money" value="<?php echo $gift_money; ?>" class="hidden-div"><br>

        <label for="Payment_method" >領取方式</label>
                <select id="option2" name="Payment_method">
                        <option value="p01" <?php if($Payment_method=='p01'){echo "selected";} ?>>領取現金</option>
                        <option value="p02" <?php if($Payment_method=='p02'){echo "selected";} ?>>銀行匯款</option>
                </select><br>

        <input type="submit" name="save" value="存檔">
    </form>
</body>
</html>
