<?php
// 建立資料庫連線
$conn = mysqli_connect("localhost", "your_name", "your_passwd", "respect_elderly");

// 搜尋 request_money 表格中符合條件的資料
//$sql = "SELECT * FROM request_money WHERE result_compare=? AND reviewdate IS NULL";
$sql = "SELECT * FROM request_money WHERE result_compare=?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $result_compare);
$result_compare = 'Y';
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// 當使用者按下「更新」按鈕時
if (isset($_POST['submit'])) {
    // 更新每一筆資料
    for ($i = 0; $i < count($_POST['pid']); $i++) {
        $id = $_POST['pid'][$i];
        $name = $_POST['name'][$i];
        $gift_money = $_POST['gift_money'][$i];
        $reviewdate = date("Y-m-d");
        $Payment_method = $_POST['Payment_method'][$i];
        $bankcode = $_POST['bankcode'][$i];
        $bankaccount = $_POST['bankaccount'][$i];



        $sql = "UPDATE request_money SET name=?, gift_money=?, reviewdate=? , Payment_method=?, bankcode=?, bankaccount=? WHERE pid=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $name, $gift_money, $reviewdate, $Payment_method, $bankcode,$bankaccount ,$id);
        mysqli_stmt_execute($stmt);
    }   

    // 重新導向到同一個頁面
    //
    echo "更新成功";
    echo "<a href='batch_review_payment2.php'>back and edit</a>";
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// 顯示表單
echo "<h2>批次更新複審資料</h2><hr>";
echo "<form method='POST'>";
while ($row = mysqli_fetch_assoc($result)) {
    // 顯示每一筆結果
    echo "<label>姓名：</label><input type='text' name='name[]' value='".(isset($_POST['name'][$i]) ? $_POST['name'][$i] : $row['name'])."'>";
    echo "<label>金額：</label><input type='text' name='gift_money[]' value='".(isset($_POST['gift_money'][$i]) ? $_POST['gift_money'][$i] : $row['gift_money'])."'>";
    echo "<label>方式：</label><input type='text' name='Payment_method[]' value='".(isset($_POST['Payment_method'][$i]) ? $_POST['Payment_method'][$i] : $row['Payment_method'])."'>";
    echo "<label>銀行碼：</label><input type='text' name='bankcode[]' value='".(isset($_POST['bankcode'][$i]) ? $_POST['bankcode'][$i] : $row['bankcode'])."'>";
    echo "<label>帳戶：</label><input type='text' name='bankaccount[]' value='".(isset($_POST['bankaccount'][$i]) ? $_POST['bankaccount'][$i] : $row['bankaccount'])."'>";
    echo "<input type='hidden' name='pid[]' value='".$row['pid']."'>";
    echo "<br>";
}
echo "<input type='submit' name='submit' value='更新'>";
echo "</form>";

// 關閉資料庫連線
mysqli_close($conn);

?>

