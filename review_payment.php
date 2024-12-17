<?php
// 說明：勾選送出後，就完成複審工作。但是這版本有增加全選的功能(這是版本1，最新版本)

// 檢查使用者是否已登入，以及操作權限
include("check_session.php");
if ($usergroup < 3) {
    echo $_SESSION['username'] . "你沒有執行權限！";
    echo "<a href=index.php>回首頁</a>";
    exit();
}

// 建立資料庫連線
$conn = mysqli_connect("localhost", "your_name", "your_passwd", "respect_elderly");

// 設定每頁顯示的紀錄數量
$records_per_page = 20;

// 取得總筆數
$sql = "SELECT COUNT(*) AS total_records FROM request_money WHERE result_compare=? AND num_log NOT IN (SELECT num_log FROM review_payment)";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $result_compare);
$result_compare = 'Y';
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$total_records = $row['total_records'];

// 計算總頁數
$total_pages = ceil($total_records / $records_per_page);

// 取得當前頁數
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// 計算查詢的起始索引值
$start_index = ($current_page - 1) * $records_per_page;

// 搜尋 request_money 表格中符合條件的資料，並限制每頁顯示的紀錄數量
if (isset($_POST['query'])) {
    $query_pid = $_POST['pid'];
    $sql = "SELECT * FROM request_money WHERE result_compare=? AND num_log NOT IN (SELECT num_log FROM review_payment) AND pid=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $result_compare, $query_pid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
	#以下註解的原因，是因為第一頁跨鄉鎮頁面，不需要批次複審，採輸入id逐一複審即可
    /* $sql = "SELECT * FROM request_money WHERE result_compare=? AND num_log NOT IN (SELECT num_log FROM review_payment) ORDER BY township, village LIMIT ?, ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sii", $result_compare, $start_index, $records_per_page);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt); */
}

// 當使用者按下「送出」按鈕時
if (isset($_POST['submit'])) {
    // 將被勾選的資料寫入 review_payment 表格中
    if (isset($_POST['check_all']) && $_POST['check_all'] == '1') {
        // 全部勾選
        while ($row = mysqli_fetch_assoc($result)) {
            $pid = $row['pid'];
            $num_log = $row['num_log'];
            $reviewdate = date("Y-m-d");

            $sql = "INSERT INTO review_payment (pid, num_log, reviewdate, uid) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $pid, $num_log, $reviewdate, $_SESSION['username']);
            mysqli_stmt_execute($stmt);
        }
    } else {
        // 部分勾選
        for ($i = 0; $i < count($_POST['num_log']); $i++) {
            $pid = $_POST['pid'][$i];
            $num_log = $_POST['num_log'][$i];
            $reviewdate = date("Y-m-d");

            $sql = "INSERT INTO review_payment (pid, num_log, reviewdate, uid) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssss", $pid, $num_log, $reviewdate, $_SESSION['username']);
            mysqli_stmt_execute($stmt);
        }
    }

    // 重新載入
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8mb4_unicode_ci">
    <title>等待複審清冊</title>
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

    <div class="col-lg-8 mx-auto p-4 py-md-5">
        <header style="text-align-last: center;">
            <a href="index.php">
                <img class="mb-4" src="img/logo.png" alt="" style="max-width: 500px;width: 100%;">
            </a>
            <form method="POST">
                <label for="pid">輸入身分證字號：</label>
                <input type="text" id="pid" name="pid" placeholder="請輸入身分證字號">
                <input type="submit" name="query" value="查詢">
            </form>
        </header>

        <div style="border-top: 6px dashed #575757;height: 1px;overflow: hidden;padding-bottom: 50px;"></div>

        <div class="col-md-12" style="background: #ace5ff; padding: 50px;margin-top: 0;">
            <h1 style="font-weight: bold;font-size: 36px;">等待複審清冊</h1>

            

            <?php
            // 顯示表單
            echo "<form method='POST'>";
            echo "<table>";
            echo "<tr style='font-size: 20px;'><th>勾選</th><th>身分證</th><th>姓名</th><th>鄉鎮</th><th>村里</th><th>匯款金額</th><th>銀行代號</th><th>帳號</th></tr>";
            echo "<tr>";
            echo "<td><input type='checkbox' id='check_all' name='check_all' value='1'></td>";
            echo "<td colspan='7' style='font-size: 22px;' >全選 (勾選此項：批次複審本頁全部項目)</td>";
            echo "</tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                // 顯示每一筆結果
                echo "<tr  style='font-size: 20px;'>";
                echo "<td><input type='checkbox' name='num_log[]' value='" . $row['num_log'] . "' ></td>";
                echo "<td>" . $row['pid'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['township'] . "</td>";
                echo "<td>" . $row['village'] . "</td>";
                echo "<td>" . $row['gift_money'] . "</td>";
                echo "<td>" . $row['bankcode'] . "</td>";
                echo "<td>" . $row['bankaccount'] . "</td>";
                echo "<input type='hidden' name='pid[]' value='" . $row['pid'] . "'>";
                echo "</tr>";
            }
            echo "</table>";
            echo "<input type='submit' name='submit' value='送出'  style='font-size: 22px;'>";
            echo "</form>";

            // 顯示分頁連結
            
			#因為不需要批次複審，所以分頁顯示的功能也註解掉。(批次複審功能在p46)
			#原來各鄉鎮的分頁，也先拿掉，因為也不需要(那些連結的php檔案都在review_ByTownship目錄下)
			/* echo "<div>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=" . $i . "'>" . $i . "</a> ";
            }
            echo "</div>"; */

            // 關閉資料庫連線
            mysqli_close($conn);
            ?>

        </div>
    </div>
</body>
</html>
