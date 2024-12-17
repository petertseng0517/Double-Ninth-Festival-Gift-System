<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>統計資料</title>
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
    <p><font color="red">即時統計結果會依查詢日期有所變動</font> 
	<?php 
	$currentDate = date('Y-m-d'); 
	echo '今天日期是：' . $currentDate; ?></p>
	<p>名冊下載：<a href="qry_listcash.php">全部領現名冊</a>、<a href="qry_all_transfer.php">全部匯款名冊</a>、<a href="qry_no_paper_transfer.php">無紙本審核轉入匯款名冊</a>、<a href="qry_wait_review.php">待複審名單</a></p>
	<hr>
	<h2>各鄉鎮申請案件數與結果</h2>
    <?php
    // 連線資料庫
    $servername = "localhost";
    $username = "your_name";
    $password = "your_passwd";
    $dbname = "respect_elderly";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // 檢查連線是否成功
    if ($conn->connect_error) {
        die("連線失敗: " . $conn->connect_error);
    }

    // 各鄉鎮申請案件數與結果 SQL 查詢
    $sql = "
    SELECT 
        a.township,
        (SELECT COUNT(*) FROM request_money rm WHERE rm.township = a.township) AS 申請案件數,
        b.通過案件數,
        b.總金額
    FROM
        (SELECT DISTINCT township FROM request_money) a
    LEFT JOIN
        (
        SELECT 
            township, 
            count(*) AS 通過案件數, 
            SUM(gift_money) AS 總金額
        FROM 
            request_money rm
        INNER JOIN 
            review_payment rp ON rm.pid = rp.pid
        WHERE 
            Payment_method = 'p02'
            AND `result_compare` = 'Y'
        GROUP BY 
            township
        ) b ON a.township = b.township;
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 輸出數據表格
        echo "<table border='1'>";
        echo "<tr><th>鄉鎮</th><th>申請案件數</th><th>通過案件數</th><th>總金額</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["township"] . "</td>";
            echo "<td>" . $row["申請案件數"] . "</td>";
            echo "<td>" . $row["通過案件數"] . "</td>";
            echo "<td>" . $row["總金額"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "沒有結果";
    }

    // 關閉資料庫連線
    $conn->close();
    ?>
<hr>
    <h2>查詢複審人員審查案件數</h2>
    <?php
    // 再次連線到資料庫
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("連線失敗: " . $conn->connect_error);
    }

    // 查詢複審人員審查案件數 SQL 查詢
    $sql = "
    SELECT rp.uid, count(*) as 審查案件數
    FROM review_payment rp
    GROUP by rp.uid;
    ";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 輸出數據表格
        echo "<table border='1'>";
        echo "<tr><th>複審人員 UID</th><th>審查案件數</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["uid"] . "</td>";
            echo "<td>" . $row["審查案件數"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "沒有結果";
    }

    // 關閉資料庫連線
    $conn->close();
    ?>
	
	<hr>
	<h2>匯款個案的年齡分布</h2>
	 <?php
    // 再次連線到資料庫
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("連線失敗: " . $conn->connect_error);
   
    }

    // 执行 SQL 查询
    $sql = "SELECT
                CASE
                    WHEN YEAR(CURRENT_DATE) - (1911 + LEFT(ca.birthday, 3)) BETWEEN 65 AND 84 THEN '65歲至84歲'
                    WHEN YEAR(CURRENT_DATE) - (1911 + LEFT(ca.birthday, 3)) BETWEEN 85 AND 89 THEN '85歲至89歲'
                    WHEN YEAR(CURRENT_DATE) - (1911 + LEFT(ca.birthday, 3)) BETWEEN 90 AND 99 THEN '90歲至99歲'
                    WHEN YEAR(CURRENT_DATE) - (1911 + LEFT(ca.birthday, 3)) >= 100 THEN '100歲以上'
                    ELSE '其他'
                END AS 年齡範圍,
                COUNT(*) AS 人數
            FROM
                review_payment rp
            LEFT JOIN ca ON ca.pid=rp.pid
            GROUP BY
                年齡範圍
            ORDER BY
                年齡範圍";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 输出数据表格
        echo "<table border='1'>";
        echo "<tr><th>年龄范围</th><th>人数</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["年齡範圍"] . "</td><td>" . $row["人數"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "未找到数据";
    }

    // 关闭数据库连接
    $conn->close();
    ?>
	
	
	<hr>
	<h2>領現金個案的年齡分布</h2>
	<?php
    // 再次連線到資料庫
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("連線失敗: " . $conn->connect_error);
   
    }

    // 执行 SQL 查询
    $sql = "SELECT
                CASE
                    WHEN YEAR(CURRENT_DATE) - (1911 + LEFT(ca.birthday, 3)) BETWEEN 65 AND 84 THEN '65歲至84歲'
                    WHEN YEAR(CURRENT_DATE) - (1911 + LEFT(ca.birthday, 3)) BETWEEN 85 AND 89 THEN '85歲至89歲'
                    WHEN YEAR(CURRENT_DATE) - (1911 + LEFT(ca.birthday, 3)) BETWEEN 90 AND 99 THEN '90歲至99歲'
                    WHEN YEAR(CURRENT_DATE) - (1911 + LEFT(ca.birthday, 3)) >= 100 THEN '100歲以上'
                    ELSE '其他'
                END AS 年齡範圍,
                COUNT(*) AS 人數
            FROM
                review_payment rp
            RIGHT JOIN ca ON ca.pid=rp.pid
            WHERE
                rp.pid IS NULL
            GROUP BY
                年齡範圍
            ORDER BY
                年齡範圍";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 输出数据表格
        echo "<table border='1'>";
        echo "<tr><th>年龄范围</th><th>人数</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["年齡範圍"] . "</td><td>" . $row["人數"] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "未找到数据";
    }

    // 关闭数据库连接
    $conn->close();
    ?>
	
	
	
	</div>
	</div>
</body>
</html>
