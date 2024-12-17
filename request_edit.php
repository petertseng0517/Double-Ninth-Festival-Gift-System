<?php

// 檢查使用者是否已登入
include("check_session.php");

// 建立資料庫連線
include("sql_connect.php");
$conn = new mysqli($servername, $username, $password, $dbname);


// 搜尋符合條件的資料
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $conn->prepare("SELECT * FROM request_money WHERE pid = ?");
    $stmt->bind_param("s", $pid);
    $pid = $_POST["pid"];
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = null;
}

// 當使用者按下「送出」按鈕時
if (isset($_POST['submit'])) {
    $stmt = $conn->prepare("UPDATE request_money SET name = ?, gift_money = ?, Payment_method = ?, birthday =?, township = ?, address = ?, tel = ?, bankcode = ?, bankaccount = ? WHERE pid = ?");
    $stmt->bind_param("sissssssss", $name, $gift_money, $Payment_method, $birthday, $township, $address, $tel, $bankcode, $bankaccount, $pid);
    $name = $_POST['name'];
    $gift_money = $_POST['gift_money'];
    $Payment_method = $_POST['Payment_method'];
    $pid = $_POST['pid'];
    $birthday = $_POST['birthday'];
    $township = $_POST['township'];
    $address = $_POST['address'];
    $tel = $_POST['tel'];
    $bankcode = $_POST['bankcode'];
    $bankaccount = $_POST['bankaccount'];
      
    $stmt->execute();

// 重新導向到同一個頁面
    header('Location: '.$_SERVER['PHP_SELF']);
	echo '<meta http-equiv="refresh" content="0">';
	exit();
    
}

// 顯示表單
echo "搜尋身分證";
echo "<form method='POST'>";
echo "<label>身分證：</label><input type='text' name='pid'>";
echo "<input type='submit' name='search' value='搜尋'>";
echo "</form>";
echo "<hr>";


if ($result && mysqli_num_rows($result) > 0) {
    // 顯示每一筆結果
    $row = mysqli_fetch_assoc($result);
    echo "<form method='POST'>";
    echo "<label>身分證：</label><input type='text' name='pid' value='".$row['pid']."' readonly><p>";
    echo "<label>姓名：</label><input type='text' name='name' value='".$row['name']."'><p>";
    echo "<label>出生日期：</label><input type='text' name='birthday' value='".$row['birthday']."'><p>";
    echo "<label>鄉鎮</label><input type='text' name='township' value='".$row['township']."'><p>";
    echo "<label>地址</label><input type='text' name='address' value='".$row['address']."'><p>";
    echo "<label>電話</label><input type='text' name='tel' value='".$row['tel']."'><p>";
    echo "<label>銀行代號</label><input type='text' name='bankcode' value='".$row['bankcode']."'><p>";
    echo "<label>匯款帳號</label><input type='text' name='bankaccount' value='".$row['bankaccount']."'><p>";
    //echo "<label>gift_money</label><input type='text' name='gift_money' value='".$row['gift_money']."'><p>";
    //echo "<label>Payment_method</label><input type='text' name='Payment_method' value='".$row['Payment_method']."'><p>";
    echo "<input type='submit' name='submit' value='更新'>";
    echo "</form>";
}

// 關閉資料庫連線
$conn->close();


?>
