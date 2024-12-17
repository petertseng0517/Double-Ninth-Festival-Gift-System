<?php

// 檢查使用者是否已登入
include("check_session.php");

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
               //SET rm.result_compare = 'Y', rm.review = 'N'";

$conn->query($sql_update);

// 取得兩個表中有相同身分證字號的紀錄
$sql_select = "SELECT c.*, rm.*
               FROM ca c
               JOIN request_money rm ON c.pid = rm.pid
               WHERE rm.result_compare = 'Y'";
$result = $conn->query($sql_select);

// 將符合條件的紀錄顯示於網頁上
echo "<h2>符合資格者名單</h2><p><hr>";

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>身分證字號</th><th>姓名</th><th>出生日期</th><th>領款方式</th><th>金額</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["pid"] . "</td><td>" . $row["name"] . "</td><td>" . $row["birthday"] . "</td><td>" . $row["Payment_method"] . "</td><td>" . $row["gift_money"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "沒有符合條件的紀錄";
}

$conn->close();
?>

