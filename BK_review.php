<?php
// just backup for compare_review.先備份 

// 設定 MySQL 連線資訊
include("sql_connect.php");

// 建立 MySQL 連線
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查 MySQL 連線是否成功
if ($conn->connect_error) {
  die("MySQL 連線失敗：" . $conn->connect_error);
}

// 查詢 request_money 資料表中的符合條件的紀錄
//$sql = "SELECT * FROM request_money WHERE result_compare = 'Y' AND review ='' ";
$sql = "SELECT * FROM request_money WHERE result_compare = 'Y' AND (review IS NULL OR review = '')";



$result = $conn->query($sql);

// 檢查查詢結果是否為空
if ($result->num_rows > 0) {
  // 顯示查詢結果的表單
  echo "<form method='post' action=''>";
  echo "<table>";
  echo "<tr><th>身分證</th><th>姓名</th><th>金額</th><th>勾選</th></tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["pid"] . "</td>";
    echo "<td>" . $row["name"] . "</td>";
    echo "<td>" . $row["gift_money"] . "</td>";
    //echo "<td>" . $row["date"] . "</td>";
    echo "<td><input type='checkbox' name='review[]' value='" . $row["pid"] . "'></td>";
    echo "</tr>";
  }
  echo "</table>";
  echo "<input type='submit' name='submit' value='送出'>";
  echo "</form>";

  // 檢查是否有表單提交
  if(isset($_POST['submit'])) {
    // 更新符合條件的紀錄的 review 欄位
    $reviews = $_POST['review'];
    foreach ($reviews as $review) {
      $sql = "UPDATE request_money SET review = CURDATE() WHERE pid = " . $review;
      $conn->query($sql);
    }
    // 重新導向到原頁面
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
  }
} else {
  // 查詢結果為空，顯示訊息
  echo "查無符合條件的紀錄。";
}

// 關閉 MySQL 連線
$conn->close();
?>

