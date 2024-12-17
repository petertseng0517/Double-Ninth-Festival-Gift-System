<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>初審結果不符原因查詢</title>
	
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
    <?php
	
	// 檢查使用者是否已登入
include("check_session.php");

// 建立資料庫連線
include("sql_connect.php");
$conn = new mysqli($servername, $username, $password, $dbname);
	
    

    // 檢查連接是否成功
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 搜尋 request_money 表格中 result_compare 不等於 Y 的資料
    $sql = "SELECT pid, name, birthday, township, result_compare FROM request_money WHERE result_compare != 'Y'";
    $result = mysqli_query($conn, $sql);

    // 如果有符合條件的資料，則顯示表格
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr style='font-size: 20px;'><th>身分證</th><th>姓名</th><th>出生日期</th><th>鄉鎮</th><th>初審結果不符原因</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr style='font-size: 20px;'>";
            echo "<td>" . $row['pid'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['birthday'] . "</td>";
            echo "<td>" . $row['township'] . "</td>";
            echo "<td>";
            // 根據 result_compare 的值來顯示不符原因
            if ($row['result_compare'] == 'D') {
                echo "死亡";
            } elseif ($row['result_compare'] == 'N') {
                echo "不符合領取禮金資格";
            } elseif ($row['result_compare'] == 'O') {
                echo "<font color=red>百歲人瑞，到宅發放</font>";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "沒有符合條件的資料。";
    }

    // 關閉資料庫連線
    mysqli_close($conn);
    ?>
	
	</div>


	
</div>
</body>
</html>
