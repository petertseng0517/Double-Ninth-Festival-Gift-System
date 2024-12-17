<?php
//先整併遷入遷出檔的結果到ca標準表格中。
include("access_MoveRecord.php");

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


// 更新request_money表中，有相同身分證字號的紀錄的result_compare欄位為"Y"
$sql_update = "UPDATE request_money rm
               JOIN ca c ON c.pid = rm.pid
               SET rm.result_compare = 'Y'";

$conn->query($sql_update);



// 更新request_money表中，若申請案在標準檔ca找不到符合身分證字號，將result_compare欄位為"N"
$sql_update_Null = "UPDATE request_money
					SET result_compare = 'N'
					WHERE pid not IN (SELECT pid FROM ca)";
               
$conn->query($sql_update_Null);


// 更新request_money表中，百年人瑞個案的result_compare欄位為"O"
$sql_update_Oldman = "UPDATE request_money AS rm SET rm.result_compare = 'O' WHERE rm.pid IN (SELECT ca.pid FROM ca WHERE ca.birthday < '0111231');";
               
$conn->query($sql_update_Oldman);




// 更新request_money表中，死亡個案的result_compare欄位為"D"
$sql_update_death = "UPDATE request_money rm
					SET result_compare = 'D'
					WHERE pid IN (SELECT pid FROM ca_die)";
               
$conn->query($sql_update_death);






//計算領取金額，寫入欄位
include ("calculate_money.php");

// 符和資格的個案：取得requect表中，顯示比對符合已被標註Y的紀錄
			   
$sql_select = "SELECT rm.*
               FROM request_money rm
               WHERE rm.result_compare = 'Y'";
$result = $conn->query($sql_select);
$amount_ListGift =mysqli_num_rows($result) ; //符合人數統計


// 不符資格的個案：取得requect表中，顯示比對不符合已被標註N的紀錄
$sql_select_null = "SELECT rm.*
               FROM request_money rm
               WHERE rm.result_compare = 'N'";
$result_no = $conn->query($sql_select_null); 
$amount_NoListGift =mysqli_num_rows($result_no) ; //不符合人數統計


// 將符合條件的紀錄顯示於網頁上
echo '<div class="col-lg-8 mx-auto p-4 py-md-5">';
echo '<header style="text-align-last: center;">';
echo '<a href="index.php">
     <img class="mb-4" src="img/logo.png" alt="" style="max-width: 500px;width: 100%;" >
</a></header>';

echo '<div style="border-top: 6px dashed #575757;height: 1px;overflow: hidden;padding-bottom: 50px;"></div>';

echo '<div class="col-md-12" style="background: #ace5ff; padding: 50px;margin-top: 0;">';




echo '<h1 style="font-weight: bold;font-size: 36px;">初審比對結果</h1><p><hr>';
echo "<h3>提出申請且符合資格者名單</h3><p>";

echo "可領取共有" .$amount_ListGift ."人";

//以下是可領取人員的資料，先隱藏不顯示。
/* if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>身分證字號</th><th>姓名</th><th>出生日期</th><th>領款方式</th><th>金額</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["pid"] . "</td><td>" . $row["name"] . "</td><td>" . $row["birthday"] . "</td><td>" . $row["Payment_method"] . "</td><td>" . $row["gift_money"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "沒有符合條件的紀錄";
} */

echo "<hr>";
echo "<h3>提出申請但不符合資格者名單</h3><p>";
echo "不符合資格：" .$amount_NoListGift ."人，<a href='search_result.php'>未通過初審清單</a>";


//以下是不能領取人員的資料，先隱藏不顯示。
/* if ($result_no->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>身分證字號</th><th>姓名</th><th>出生日期</th><th>領款方式</th><th>金額</th></tr>";
    while($row = $result_no->fetch_assoc()) {
        echo "<tr><td>" . $row["pid"] . "</td><td>" . $row["name"] . "</td><td>" . $row["birthday"] . "</td><td>" . $row["Payment_method"] . "</td><td>" . $row["gift_money"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "沒有符合條件的紀錄";
} */

$conn->close();
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8mb4_unicode_ci">
    <title>初審比對結果</title>
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
 








</body>
</html>