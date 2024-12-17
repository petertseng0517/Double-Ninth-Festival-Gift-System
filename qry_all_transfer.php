<?php
// 檢查使用者是否已登入，以及操作權限
include("check_session.php");
if($usergroup < 4){
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



// 执行 SQL 查询
$sql = "
    SELECT rm.pid, rm.name, rm.township, rm.village, rm.Neighborhood, rm.address, rm.gift_money, rm.bankcode, rm.bankaccount
    FROM review_payment rp
    INNER JOIN request_money rm ON rp.pid = rm.pid
    WHERE rm.result_compare = 'y'
    ORDER BY rm.township, rm.village;
";

$result = $conn->query($sql);

if (!$result) {
    die("查询数据库失败: " . $conn->error);
}

// 创建 CSV 文件
$filename = "payment_records.csv";
$fp = fopen('php://temp', 'w');

// 添加标题行
$header = array("PID", "姓名", "鄉鎮", "村里", "居住区", "地址", "匯款金額", "银行代码", "银行帐号");
fputcsv($fp, $header);

// 将查询结果写入 CSV 文件
while ($row = $result->fetch_assoc()) {
    fputcsv($fp, $row);
}

// 将文件指针移到文件的开头
rewind($fp);

// 设置 HTTP 响应头以提供下载
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// 输出 CSV 文件内容
fpassthru($fp);

// 关闭连接和文件资源
fclose($fp);
$conn->close();
?>
