<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>本縣符合禮金領取資格且尚未申請匯款者</title>
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


table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #575757;
            padding: 8px;
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

<h1 style="font-weight: bold;font-size: 36px;">本縣符合禮金領取資格且尚未申請匯款者</h1>


    <form method="post" action="">
        <label for="township">鄉鎮：</label>
        <select name="township" id="township">
            <option value="">請選擇</option>
			<option value="花蓮市">花蓮市</option>
			<option value="新城鄉">新城鄉</option>
			<option value="秀林鄉">秀林鄉</option>
			<option value="吉安鄉">吉安鄉</option>
			<option value="壽豐鄉">壽豐鄉</option>
			<option value="鳳林鎮">鳳林鎮</option>
			<option value="萬榮鄉">萬榮鄉</option>
			<option value="光復鄉">光復鄉</option>
			<option value="瑞穗鄉">瑞穗鄉</option>
			<option value="玉里鎮">玉里鎮</option>
			<option value="卓溪鄉">卓溪鄉</option>
			<option value="豐濱鄉">豐濱鄉</option>
			<option value="富里鄉">富里鄉</option>
        </select>
        <br><br>
        <input type="submit" name="submit" value="送出">
    </form>

<?php
// 下載未申請銀行匯款但符合領取禮金的名單。
// 檢查使用者是否已登入，以及操作權限
	include("check_session.php");
	if($usergroup < 3){
		echo $_SESSION['username'] ."你沒有執行權限！";
		echo "<a href=index.php>回首頁</a>";
		exit();
		} 


    // 設定資料庫連接資訊
	include("sql_connect.php");
	$conn = mysqli_connect($servername, $username, $password, $dbname); // 建立資料庫連接
	
	// 檢查連接是否成功
	if (!$conn) {
			die("Connection failed: " . mysqli_connect_error()); 
		}
	
    if (isset($_POST['submit'])) {
        // 取得選擇的鄉鎮
        $selectedTownship = $_POST['township'];

        // 設定 SQL 查詢語句
        $sql_NonRequest = "SELECT ca.pid, ca.ca_name, ca.birthday, ca.county, ca.township, ca.village, ca.Neighborhood, ca.address, ca.other_notes
                FROM ca
                LEFT JOIN request_money rm ON ca.pid = rm.pid
                WHERE rm.pid IS NULL AND ca.township = '$selectedTownship'
                ORDER BY ca.township ASC";

        // 執行 SQL 查詢
        $result_NonRequest = mysqli_query($conn, $sql_NonRequest);
         
		echo mysqli_num_rows($result_NonRequest) ; //搜尋結果筆數
		 
		 
        // 檢查查詢結果是否有資料
        if (mysqli_num_rows($result_NonRequest) > 0) {
            echo "<h2>查詢結果：</h2>";

            // 顯示查詢結果
			 
            echo "<table>";
            echo "<tr><th>PID</th><th>姓名</th><th>生日</th><th>縣市</th><th>鄉鎮</th><th>村里</th><th>鄰</th><th>地址</th><th>金額</th></tr>";

            while ($row = mysqli_fetch_assoc($result_NonRequest)) {
                echo "<tr>";
                echo "<td>" . $row['pid'] . "</td>";
                echo "<td>" . $row['ca_name'] . "</td>";
                echo "<td>" . $row['birthday'] . "</td>";
                echo "<td>" . $row['county'] . "</td>";
                echo "<td>" . $row['township'] . "</td>";
                echo "<td>" . $row['village'] . "</td>";
                echo "<td>" . $row['Neighborhood'] . "</td>";
                echo "<td>" . $row['address'] . "</td>";
				echo "<td>" . $row['other_notes'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";

             // 產生 CSV 檔案	
			$filename = date('Ymd') . $selectedTownship . ".csv";
			$fp = fopen("BK/NonRequest/" . $filename, "w");

            // 寫入 CSV 檔案的表頭
            $headers = array("PID", "姓名", "生日", "縣市", "鄉鎮", "村里", "鄰近", "地址","金額");
            fputcsv($fp, $headers);

            // 寫入 CSV 檔案的內容
            mysqli_data_seek($result_NonRequest, 0); // 將結果指標歸零
            while ($row = mysqli_fetch_assoc($result_NonRequest)) {
                fputcsv($fp, $row);
            }

            fclose($fp);

            // 提供下載連結
            echo "<br>";
            echo "<a href='BK/NonRequest/$filename'>下載結果</a>";
        } else {
            echo "<p>查無符合條件的資料。</p>";
        } 

        // 關閉資料庫連線
        mysqli_close($conn);
    }
    ?>
	
	</div>	
</div>

</body>
</html>
