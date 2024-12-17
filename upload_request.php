<?php
// upload CSV file and import to MySQL

/* 程式碼將CSV檔案中的多條記錄合併為一個SQL插入語句，使用批量插入的方式。
它將CSV檔案中的每一行資料轉換為一個插入值的字串，並將這些插入值組成一個SQL插入語句的一部分。
最後，使用單個SQL插入語句將所有記錄批量插入到MySQL資料庫中。這樣可以減少與資料庫的通信次數，從而提高效率。同時，修正了在匯入結果顯示中的錯誤。 */


// Just for 公所受理申請資料匯入

// 檢查使用者是否已登入，以及操作權限
include("check_session.php");
if($usergroup < 3){
	echo $_SESSION['username'] ."你沒有執行權限！";
	echo "<a href=index.php>回首頁</a>";
	exit();
	} 

// 設定資料庫連接資訊
include("sql_connect.php");

// 建立資料庫連接
$conn = mysqli_connect($servername, $username, $password, $dbname);

// 檢查連接是否成功
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// 檢查是否有檔案上傳
if (isset($_FILES["file"])) {
    $file = $_FILES["file"]["name"];

    // 設定上傳路徑
    $target_dir = "BK/request/";
    $file_extension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . "ca_" . date("YmdHis") . "." . $file_extension;

    // 檢查檔案類型，只接受 CSV 檔案
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType != "csv") {
        echo "只接受 CSV 檔案。";
        exit;
    }

    // 將檔案移到上傳目錄下
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    // 讀取 CSV 檔案內容
    $success_insert = 0;
    $error_insert = 0;
    $insert_values = array(); // 用於儲存插入值的陣列

    if (($handle = fopen($target_file, "r")) !== FALSE) {
        // 先讀取一次資料，跳過CSV檔案的第一行
        fgetcsv($handle, 1000, ",");
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // 檢查 pid 是否已存在
			$existing_pid_query = "SELECT COUNT(*) FROM request_money WHERE pid = '" . $data[0] . "'";
			$existing_pid_result = mysqli_query($conn, $existing_pid_query);
			$existing_pid_row = mysqli_fetch_array($existing_pid_result);
			$existing_pid_count = $existing_pid_row[0];

		// 如果 pid 已存在，跳過該筆紀錄
			if ($existing_pid_count > 0) {
				$error_insert++;
				continue;
				}

			
			//案件編號
            $date = date('Ymd'); // 取得當天日期，格式為YYYYMMDD
            $random_num = rand(01, 99);
            $last_five_chars = substr($data[0], -5);
            $num_log = $date . $random_num . $last_five_chars; // 將當天日期身分證後5碼結合

            // 將 CSV 檔案中的資料插入 MySQL 資料庫
            $insert_values[] = "('" . $data[0] . "', '" . $data[1] . "', '" . $data[2] . "', '" . $data[3] . "', '" . $data[4] . "', '" . $data[5] . "', '" . $data[6] . "', '" . $data[7] . "', '" . $data[8] . "', '" . $data[9] . "', '0', 'p02', '', '$num_log', '')";

            $success_insert++;
        }
        fclose($handle);

        if (!empty($insert_values)) {
            $insert_query = "INSERT INTO request_money (pid, name, birthday, township, village, Neighborhood, address, tel, bankcode, bankaccount, gift_money, Payment_method, result_compare, num_log, reviewdate) VALUES " . implode(',', $insert_values);

            if (mysqli_query($conn, $insert_query)) {
                echo "<p>匯入結果:";
                echo "<p>匯入成功筆數: " . $success_insert;
                echo "<p>匯入失敗筆數: " . $error_insert;
                echo "<p><a href=index.php>回首頁</a>";
            } else {
                echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
            }
        }
    }
}

// 關閉資料庫連接
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8mb4_unicode_ci">
    <title>CSV 檔案匯入 MySQL 資料庫</title>
	
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

<h1 style="font-weight: bold;font-size: 36px;">公所受理申請資料匯入上傳</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        <label for="file">選擇 CSV 檔案:</label>
        <input type="file" name="file" id="file" style="font-size: 25px;"><br><br>
        <input type="submit" value="匯入" style="font-size: 25px;">
    </form>
</body>
</html>
