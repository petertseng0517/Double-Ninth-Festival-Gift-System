<?php
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
    $stmt = $conn->prepare("UPDATE request_money SET name = ?, gift_money = ?, Payment_method = ? WHERE pid = ?");
    $stmt->bind_param("ssss", $name, $gift_money, $Payment_method, $pid);
    $name = $_POST['name'];
    $gift_money = $_POST['gift_money'];
    $Payment_method = $_POST['Payment_method'];
    $pid = $_POST['pid'];
    $stmt->execute();

    // 重新導向到同一個頁面
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// 顯示表單
echo "搜尋身分證";
echo "<form method='POST'>";
echo "<label>身分證：</label><input type='text' name='pid'>";
echo "<input type='submit' name='search' value='搜尋'>";
echo "</form>";

if ($result && mysqli_num_rows($result) > 0) {
    // 顯示每一筆結果
    $row = mysqli_fetch_assoc($result);
    echo "<form method='POST'>";
    echo "<label>身分證：</label><input type='text' name='pid' value='".$row['pid']."' readonly>";
    echo "<label>姓名：</label><input type='text' name='name' value='".$row['name']."'>";
    echo "<label>金額：</label><input type='text' name='gift_money' value='".$row['gift_money']."'>";
    echo "<label>領取方式：</label><input type='text' name='Payment_method' value='".$row['Payment_method']."'>";
    echo "<input type='submit' name='submit' value='更新'>";
    echo "</form>";
}

// 關閉資料庫連線
$conn->close();


?>
