<?php
//下載需重新匯款的清單review_payment.dw=y，下載後清空該欄位


  
  // 連線資料庫
  include("sql_connect.php");
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  
  // 檢查連線
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  
  
  
  // 搜尋資料庫表格
  $sql = "select * FROM request_money rm INNER JOIN review_payment rp on rm.pid=rp.pid where rp.dw='y'";
  $result = mysqli_query($conn, $sql);
  

  
  // 產生CSV檔案
  $csv = "收受行代號,收受者帳號,收受者統編,金額,用戶號碼,公司股市代號,發動者專用區,查詢專用區,存摺摘要,收付款結果\n";
  while ($row = mysqli_fetch_assoc($result)) {
    $csv .= $row['bankcode'] . "," . $row['bankaccount'] . "," . $row['pid'] . "," . $row['gift_money']. "," . "," . "," . "," . "," . "," . "\n";
	//$csv .= $row['pid'] . "," . $row['num_log'] . "," . $row['reviewdate'] . "\n";
  }
  
  
 
 
  //下載後，清除dw欄位內的值
  $sql_clear="UPDATE review_payment SET dw = NULL";
  $result_clear = mysqli_query($conn, $sql_clear);
  
  
  mysqli_close($conn);
  
  // 設定檔案名稱
  $filename = "Debug_ResendList.csv";
  
  // 下載CSV檔案
  header("Content-type: text/csv");
  header("Content-Disposition: attachment; filename=$filename");
  header("Pragma: no-cache");
  header("Expires: 0");
  echo $csv;
  exit;

?>

