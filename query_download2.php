<?php
//這裡會把通過複審的清單顯示。


// 檢查使用者是否已登入，以及操作權限
include("check_session.php");
if($usergroup < 3){
	echo $_SESSION['username'] ."你沒有執行權限！";
	echo "<a href=index.php>回首頁</a>";
	exit();
	} 


// 連線資料庫
include("sql_connect.php");
$conn = mysqli_connect($servername, $username, $password, $dbname);

// 檢查連線
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// 搜尋資料庫表格
$sql = "SELECT * FROM request_money WHERE num_log IN (SELECT num_log FROM review_payment)";
$result = mysqli_query($conn, $sql);



// 建立 CSV 資料
$csv = "bankcode,bankaccount,pid\n";
while ($row = mysqli_fetch_assoc($result)) {
  $csv .= $row["bankcode"] . "," . $row["bankaccount"] . "," . $row["pid"] . "\n";
}

// 顯示資料
echo "<h3>複審通過資訊</h3>";

if (mysqli_num_rows($result) > 0) {
  // 顯示資料表格
  echo "<table border=1>";
  echo "<tr><th>收受行代號</th><th>收受者帳號</th><th>收受者統編</th><th>金額</th></tr>";
  mysqli_data_seek($result, 0); // 將指針歸零
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row["bankcode"] . "</td><td>" . $row["bankaccount"] . "</td><td>" . $row["pid"] . "</td><td>" . $row["gift_money"] . "</td></tr>";
	//echo "<tr><td>" . $row["pid"] . "</td><td>" . $row["num_log"] . "</td><td>" . $row["gift_money"] . "</td></tr>";
  }
  echo "</table>";



  // 提供CSV下載按鈕
  $filename = "data.csv"; // 設定檔案名稱
  echo "<form action='download.php' method='post'>";
  echo "<input type='hidden' name='table_name' value='request_money'>";
  echo "<input type='submit' name='download' value='Download csv'>";
  echo "</form>";

  // 下載CSV檔案
  if (isset($_POST['download'])) {
    header("Content-type: text/csv");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Expires: 0");
    echo $csv;
    exit;
  }
} else {
  echo "No matching records found";
}

mysqli_close($conn);
?>

