<?php
	// 檢查使用者是否已登入，以及操作權限
include("check_session.php");
if($usergroup < 3){
	echo $_SESSION['username'] ."你沒有執行權限！";
	echo "<a href=index.php>回首頁</a>";
	exit();
	} 
?>

<!DOCTYPE html>
<html>
<head>
    <title>勘誤匯款被剔退資料</title>
	
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

<h1 style="font-weight: bold;font-size: 36px;">勘誤匯款被剔退資料</h1>

    
	


    
    <!-- 上传CSV文件表单 -->
	<h3>步驟一、逐一更正長者匯款資料</h3>
	<a href="request_editor_v2.php" target=_blank> >>>匯款資料更新</a>
	<hr>
	<h3>步驟二、上傳需重新匯款人的ID清單</h3>
	
	
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="csvFile">选择CSV文件：</label>
        <input type="file" name="csvFile" id="csvFile" accept=".csv">
        <input type="submit" name="uploadBtn" value="上传">
    </form>

    <?php
    // 建立数据库连接
	
	
    include "sql_connect.php";
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // 检查连接是否成功
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['uploadBtn'])) {
        // 处理上传的CSV文件
        if (isset($_FILES['csvFile'])) {
            $file = $_FILES['csvFile'];

            // 检查上传文件是否成功
            if ($file['error'] === UPLOAD_ERR_OK) {
                $csvFilePath = "BK/debugList/" . date("Y-m-d_H-i-s") . ".csv";

                // 将上传的CSV文件移动到指定路径
                move_uploaded_file($file['tmp_name'], $csvFilePath);

                echo "<p>勘誤需重新下載清冊已標記成功</p>";

                // 读取CSV文件内容
                $csvFile = fopen($csvFilePath, 'r');
                while (($data = fgetcsv($csvFile)) !== false) {
                    $pid = trim($data[0]);

                    // 查询数据库表中与CSV文件中的pid匹配的记录
                    $sql = "UPDATE review_payment SET dw = 'y' WHERE pid = '$pid'";
                    $result = mysqli_query($conn, $sql);

                    if ($result) {
                        //echo "<p>PID: $pid 更新成功</p>";
                    } else {
                        //echo "<p>PID: $pid 更新失败</p>";
                    }
                }
                fclose($csvFile);
            } else {
                echo "<p>上传文件失败</p>";
            }
        }
    }

    // 关闭数据库连接
    mysqli_close($conn);
	
	
    ?>
	<hr>
	<h3>步驟三、下載匯款清單</h3>
	<a href="download_DebugList.php">下載已勘誤的匯款清單</a>


</div>


	
</div>

</body>
</html>
 