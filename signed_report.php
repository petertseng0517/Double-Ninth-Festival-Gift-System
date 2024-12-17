<?php


// 檢查使用者是否已登入，以及操作權限
include("check_session.php");
if($usergroup < 3){
	echo $_SESSION['username'] ."你沒有執行權限！";
	echo "<a href=index.php>回首頁</a>";
	exit();
	} 



// 建立MySQL連線
include("sql_connect.php");

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8mb4_unicode_ci">
    <title>複審清冊查詢</title>
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

table {
            border-collapse: collapse;
        }
        
        th, td {
            border: 1px solid #575757; /* 設定框線顏色 */
            padding: 8px;
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

<h1 style="font-weight: bold;font-size: 36px;">複審清冊查詢</h1>

    
	



<?php
// 當使用者按下「查詢」按鈕時
if (isset($_POST['submit'])) {
    // 取得使用者輸入的查詢條件
    $query = $_POST['query'];

    // 將查詢條件加上萬用字元 %，以便進行模糊查詢
    //$query = mysqli_real_escape_string($conn, $query);
    //$query = $query . "%";

    // 執行查詢
	$input_date = $_POST['input_date'];
	
	$input_payment_method = $_POST['payment_method'];
	
	$sql = "SELECT rm.pid, rm.name, rm.bankcode, rm.bankaccount, rm.gift_money, rm.Payment_method FROM review_payment as rp INNER JOIN request_money as rm on rm.pid=rp.pid WHERE rp.reviewdate like '{$input_date}%' and rm.Payment_method like '{$input_payment_method}'";
	$result = mysqli_query($conn, $sql);
	
}
	else {
    // 若使用者未按下「查詢」按鈕，則顯示全部資料
    $sql = "SELECT rm.pid, rm.name, rm.bankcode, rm.bankaccount, rm.gift_money, rm.Payment_method FROM review_payment as rp INNER JOIN request_money as rm on rm.pid=rp.pid ";
    $result = mysqli_query($conn, $sql);
}

// 顯示查詢表單
echo "<form method='POST'>";
echo "<label>請輸入複審日期（格式為 yyyy-mm）：</label>";
echo "<input type='text' name='input_date'>";
echo "<label>方式：</label>";
echo '<select id="option" name="payment_method">';
    echo "<option value='%'>不限</option>";
    echo "<option value='p01'>領取現金</option>";
    echo "<option value='p02'>銀行匯款</option>";
    echo "</select>";
echo "<input type='submit' name='submit' value='查詢'>";
echo "</form>";

// 顯示預設全部查詢結果
echo "<h3>通過複審清冊</h3>";
//echo "你輸入查詢的日期是：" .$input_date;
echo "你輸入查詢的日期是：<font color=red>" .$input_date ."</font>";
echo "<table border='1'>";
echo "<tr><th>身分證字號</th><th>姓名</th><th>銀行代碼</th><th>銀行帳號</th><th>發放金額</th><th>發放方式</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
	
	//發放方式呈現轉換成中文
	if ($row['Payment_method']=="p01") {
	$pm="現金發放";
	}else {
	$pm="銀行匯款";
	}
	
    echo "<tr>";
    echo "<td>".$row['pid']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['bankcode']."</td>";
    echo "<td>".$row['bankaccount']."</td>";
	echo "<td>".$row['gift_money']."</td>";
	//echo "<td>".$row['Payment_method']."</td>";
	echo "<td>".$pm ."</td>";
    echo "</tr>";
}
echo "</table>";

// 關閉資料庫連線
mysqli_close($conn);
?>

</div>


	
</div>



</body>