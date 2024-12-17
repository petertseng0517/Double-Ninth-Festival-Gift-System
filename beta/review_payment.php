<?php
// 建立資料庫連線
$conn = mysqli_connect("localhost", "your_name", "your_passwd", "respect_elderly");

// 搜尋 request_money 表格中符合條件的資料
$sql = "SELECT * FROM request_money WHERE result_compare=? AND num_log NOT IN (SELECT num_log FROM review_payment)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $result_compare);
$result_compare = 'Y';
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// 當使用者按下「送出」按鈕時
if (isset($_POST['submit'])) {
    // 將被勾選的資料寫入 review_payment 表格中
    for ($i = 0; $i < count($_POST['num_log']); $i++) {
        $pid = $_POST['pid'][$i];
        $num_log = $_POST['num_log'][$i];
        $reviewdate = date("Y-m-d");

        $sql = "INSERT INTO review_payment (pid, num_log, reviewdate) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $pid, $num_log, $reviewdate);
        mysqli_stmt_execute($stmt);
    }

    // 重新導向到同一個頁面
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// 顯示表單
echo "<h2>待審核請款清單</h2><p><hr>";
echo "<form method='POST'>";
echo "<table>";
echo "<tr><th>勾選</th><th>身分證</th><th>姓名</th><th>請款金額</th><th>領取方式</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    // 顯示每一筆結果
    echo "<tr>";
    echo "<td><input type='checkbox' name='num_log[]' value='".$row['num_log']."'></td>";
    echo "<td>".$row['pid']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['gift_money']."</td>";
    echo "<td>".$row['Payment_method']."</td>";
    echo "<input type='hidden' name='pid[]' value='".$row['pid']."'>";
    echo "</tr>";
}
echo "</table>";
echo "<input type='submit' name='submit' value='送出'>";
echo "</form>";

// 關閉資料庫連線
mysqli_close($conn);


?>
