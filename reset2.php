<?php
//功能：新的年度開始前，將資料庫現有資料清空。


// 檢查使用者是否已登入，以及操作權限
include("check_session.php");

/*if($usergroup < 4){
	echo $_SESSION['username'] ."你沒有執行權限！";
	echo "<a href=index.php>回首頁</a>";
	exit();
	} */



// 檢查使用者是否為peter
 if($_SESSION['username']!='peter'){
	echo $_SESSION['username'] ."你沒有執行權限！";
	echo "<a href=index.php>回首頁</a>";
	exit();
	} 
	


// 建立資料庫連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線是否成功
if ($conn->connect_error) {
    die("資料庫連線失敗: " . $conn->connect_error);
}
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8mb4_unicode_ci">
    <title>新年度系統重制</title>
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

<h1 style="font-weight: bold;font-size: 36px;">新年度系統重制</h1>

<?php
	
	// 清空表格 ca
	$sql_ca = "TRUNCATE TABLE ca";
	if ($conn->query($sql_ca) === TRUE) {
		echo "表格-領取禮金資格清冊(ca)清空成功<br>";
		} else {
		echo "發生錯誤: " . $conn->error . "<br>";
		}



	// 清空表格 review_payment
	$sql = "TRUNCATE TABLE review_payment";
	if ($conn->query($sql) === TRUE) {
		echo "表格-複審清冊(review_payment)清空成功<br>";
	} else {
		echo "發生錯誤: " . $conn->error . "<br>";
	}


	// 清空表格 move_in
	$sql = "TRUNCATE TABLE move_in";
	if ($conn->query($sql) === TRUE) {
		echo "表格-遷入檔清冊(move_in)清空成功<br>";
	} else {
		echo "發生錯誤: " . $conn->error . "<br>";
	}

	// 清空表格 move_out
	$sql = "TRUNCATE TABLE move_out";
	if ($conn->query($sql) === TRUE) {
		echo "表格-遷出檔清冊(move_out)清空成功<br>";
	} else {
		echo "發生錯誤: " . $conn->error . "<br>";
	}

// 清空表格 move_record
	$sql = "TRUNCATE TABLE move_record";
	if ($conn->query($sql) === TRUE) {
		echo "表格-遷入遷出整併檔(move_record)清空成功<br>";
	} else {
		echo "發生錯誤: " . $conn->error . "<br>";
	}



// 清空表格 request_money 的 result_compare 欄位
$sql = "UPDATE request_money SET result_compare = ''";
if ($conn->query($sql) === TRUE) {
    echo "表格-申請匯款清冊(request_money)的比對結果欄位(result_compare)清空成功<br>";
	echo "表格-申請匯款清冊(request_money)保留";
} else {
    echo "發生錯誤: " . $conn->error . "<br>";
}



// 將表格 request_money 的 gift_money 欄位設為0
$sql = "UPDATE request_money SET gift_money = '0'";
if ($conn->query($sql) === TRUE) {
    echo "表格 request_money 的 gift_money 欄位設為 0成功<br>";
} else {
    echo "發生錯誤: " . $conn->error . "<br>";
}

// 清空表格 request_money的reviewdate 欄位
$sql = "UPDATE request_money SET reviewdate = ''";
if ($conn->query($sql) === TRUE) {
    echo "表格 request_money 的 reviewdate 欄位設為 NULL 成功<br>";
	
} else {
    echo "發生錯誤: " . $conn->error . "<br>";
}



// 清空表格 request_money
	$sql = "TRUNCATE TABLE request_money";
	if ($conn->query($sql) === TRUE) {
		echo "表格-匯款申請檔(request_money)清空成功<br>";
	} else {
		echo "發生錯誤: " . $conn->error . "<br>";
	}
	
// 清空表格 ca_die
	$sql = "TRUNCATE TABLE ca_die";
	if ($conn->query($sql) === TRUE) {
		echo "表格-死亡檔(ca_die)清空成功<br>";
	} else {
		echo "發生錯誤: " . $conn->error . "<br>";
	}



// 關閉資料庫連線
$conn->close();
?>
	
</div>


	
</div>



</body>
</html>
