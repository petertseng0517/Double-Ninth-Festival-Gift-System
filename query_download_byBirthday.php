<?php
//使用者輸入出生日期區間來篩選出要匯款的清單。
//這裡不會顯示通過複審的清單，只顯示通過的筆數

// 檢查使用者是否已登入，以及操作權限
include("check_session.php");
if ($usergroup < 3) {
  echo $_SESSION['username'] . "你沒有執行權限！";
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


?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8mb4_unicode_ci">
    <title>下載轉帳清冊</title>
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
 




<div class="col-lg-8 mx-auto p-4 py-md-5"><!--整體寬度-->


<header style="text-align-last: center;"><!--置中-->
<a href="index.php">
     <img class="mb-4" src="img/logo.png" alt="" style="max-width: 500px;width: 100%;" >   <!--LOGO-->
</a>
</header>


<div style="border-top: 6px dashed #575757;height: 1px;overflow: hidden;padding-bottom: 50px;"></div> <!--分隔線-->


<div class="col-md-12" style="background: #ace5ff; padding: 50px;margin-top: 0;"><!--方框背景-->

<h1 style="font-weight: bold;font-size: 36px;">下載轉帳清冊</h1>

    
	<?php
	
	


if (mysqli_num_rows($result) > 0) {
  
// 提供CSV下載按鈕
  
  echo "<form action='download_byBirthday.php' method='post'>";
  echo "說明：請輸入個案的出生日期區間。<font color='blue'>日期格式為民國年月日(7位數)</font>：0200517</p>";
  echo "<label for='birthday'>出生日期區間</label> <br>起：<input type='text' name='birthday_start'>，迄：</label> <input type='text' name='birthday_end'>";

  echo "<input type='hidden' name='table_name' value='request_money'>";
  echo "<input type='submit' name='download' value='下載匯款報表'>";
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
</div>


	
</div>



</body>