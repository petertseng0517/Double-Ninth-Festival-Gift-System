<?php

// 檢查使用者是否已登入
include("check_session.php");

// 建立 MySQL 連線
include("sql_connect.php");
$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線是否成功
if ($conn->connect_error) {
  die("連線失敗: " . $conn->connect_error);
}

// 如果使用者按下送出按鈕
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // 從表單中取得使用者輸入的資料
  
// 驗證身分證格式正確否
include ("validatePid.php");
if (checkId($_POST['pid'])) {
  // 身分證字號格式正確
  $pid = $_POST["pid"];
} else {
  // 身分證字號格式錯誤，跳出提醒視窗，再重新載入
  echo '<script>alert("wrong pid");</script>';
  header('Location: '.$_SERVER['PHP_SELF']);
  echo '<meta http-equiv="refresh" content="0">';
  exit();
}
        
  $name = $_POST["name"];
  $birthday = $_POST["birthday"];
  $township = $_POST["township"];
  $village = $_POST["village"];
  $Neighborhood = $_POST["Neighborhood"];
  $address = $_POST["address"];
  $tel = $_POST["tel"];
  //$bankcode = $_POST["bankcode"];
  $bankcode = $_POST["menu_bankcode"]; //使用者選出來的
  $bankaccount = $_POST["bankaccount"];
  $gift_money = $_POST["gift_money"];
  $Payment_method = $_POST["Payment_method"];
  $result_compare = $_POST["result_compare"];


//案件編號
$date = date('Ymd'); // 取得當天日期，格式為YYYYMMDD
$random_num = rand(01,99);
$last_five_chars = substr($pid, -5);
$num_log = $date .$random_num . $last_five_chars; // 將當天日期身分證後5碼結合




  // 檢查該身分證字號是否已存在於資料庫中
  $sql_check = "SELECT * FROM request_money WHERE pid='$pid'";
  $result = $conn->query($sql_check);
  if ($result->num_rows > 0) {
    echo "已有該申請案";
  } else {
    // 將使用者輸入的資料存儲到 MySQL 資料庫中
    $sql = "INSERT INTO request_money (pid, name, birthday, township, village, Neighborhood, address, tel, bankcode, bankaccount, gift_money, Payment_method, result_compare, num_log) VALUES ('$pid', '$name', '$birthday', '$township', '$village', '$Neighborhood','$address', '$tel', '$bankcode', '$bankaccount', '0', '$Payment_method', '', '$num_log')";
    if ($conn->query($sql) === TRUE) {
      echo "資料已成功儲存";
    } else {
      echo "發生錯誤: " . $conn->error;
    }
  }
}

// 關閉 MySQL 連線
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>重陽禮金匯款申請</title>
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


<script>
      function validateForm() {
        // 取得表單中 input 欄位的值
        var name = document.forms["myForm"]["name"].value;
        var pid = document.forms["myForm"]["pid"].value;

        // 如果 name 或 pid 欄位為空，則顯示錯誤訊息並阻止表單送出
        if (name == "" || pid == "") {
          alert("請填寫姓名和身分證字號");
          return false;
        }
      }
    </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

	<h1 style="font-weight: bold;font-size: 36px;">重陽禮金匯款申請</h1>
	<form name="myForm" method="post" onsubmit="return validateForm()" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<label for="pid">身分證字號:</label>
		<input type="text" name="pid" required style="font-size: 25px;"><br><br>
		<label for="name">姓名:</label>
		<input type="text" name="name" required style="font-size: 25px;"><br><br>
		<label for="birthday">出生日期</label>
		<input type="text" name="birthday" required style="font-size: 25px;"><br><br>
		<?php include ("village_menu.php");  //載入村里  ?>
		<?php include ("Neighborhood_menu.php");  //載入鄰 ?>
        <p></p>
		 <label for="address">完整住址:</label>
                <input type="text" name="address" required style="font-size: 25px;"><br><br>

		 <label for="tel">住家電話:</label>
                <input type="text" name="tel" required style="font-size: 25px;"><br><br>
         
		 
		 <?php  include("bank_code.php"); ?>
				
		 <label for="bankaccount">帳號:</label>
		<input type="text" name="bankaccount" required style="font-size: 25px;"><br><br>

		 

               <label for="Payment_method">領取方式</label>
                <select id="option2" name="Payment_method">
                        <option value="p01">領取現金</option>
                        <option value="p02" selected>銀行匯款</option>
                </select><br>

		<input type="submit" value="送出" style="font-size: 25px;">
	</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>

