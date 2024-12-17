<?php
// 建立資料庫連線
$conn = mysqli_connect("localhost", "your_name", "your_passwd", "respect_elderly");

// 搜尋 request_money 表格中符合條件的資料
$sql = "SELECT * FROM request_money WHERE result_compare='Y'";
$result = mysqli_query($conn, $sql);

// 當使用者按下「更新」按鈕時
if (isset($_POST['submit'])) {
    // 更新每一筆資料
    for ($i = 0; $i < count($_POST['pid']); $i++) {
        $id = $_POST['pid'][$i];
        $name = $_POST['name'][$i];
        $gift_money = $_POST['gift_money'][$i];
        $reviewdate = date("Y-m-d");

        $sql = "UPDATE request_money SET name='$name', gift_money='$gift_money', reviewdate='$reviewdate' WHERE pid='$id'";
        mysqli_query($conn, $sql);
    }

    // 重新導向到同一個頁面
    
    echo "更新成功";
    echo "<a href='batch_review_payment.php'>back and edit</a>";
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// 顯示表單
echo "批次更新複審資料";
echo "<form method='POST'>";
while ($row = mysqli_fetch_assoc($result)) {
    // 顯示每一筆結果
    echo "<label>姓名：</label><input type='text' name='name[]' value='".(isset($_POST['name'][$i]) ? $_POST['name'][$i] : $row['name'])."'>";
    echo "<label>金額：</label><input type='text' name='gift_money[]' value='".(isset($_POST['gift_money'][$i]) ? $_POST['gift_money'][$i] : $row['gift_money'])."'>";
    echo "<input type='hidden' name='pid[]' value='".$row['pid']."'>";
    echo "<br>";
}
echo "<input type='submit' name='submit' value='更新'>";
echo "</form>";

// 關閉資料庫連線
mysqli_close($conn);

?>

