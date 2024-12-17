<?php
// upload CSV file and import to MySQL
// Just for 民政處資格檔案
//使用LOAD DATA INFILE語句，

//我目前懶得改~~
//但目前有錯誤訊息表示MySQL伺服器正在使用--secure-file-priv選項運行，因此無法執行LOAD DATA INFILE語句。 
/* 這是因為--secure-file-priv選項限制了MySQL伺服器可以讀取和寫入的檔案路徑。為了解決這個問題，你可以遵循以下步驟：
確認MySQL伺服器的--secure-file-priv選項指定的路徑。你可以執行以下SQL查詢來檢查：

sql:
SHOW VARIABLES LIKE 'secure_file_priv';

再將CSV檔案移動到--secure-file-priv指定的路徑下。
假設--secure-file-priv的值是/var/lib/mysql-files/，你應該將CSV檔案移動到該路徑下，並修改程式碼中的目標檔案路徑為相應的路徑。
$target_file = "/var/lib/mysql-files/ca_" . date("YmdHis") . "." . $file_extension;

修改LOAD DATA INFILE語句，將目標檔案路徑更改為絕對路徑。
$sql = "LOAD DATA INFILE '/var/lib/mysql-files/ca_" . date("YmdHis") . "." . $file_extension . "'
        INTO TABLE ca
        FIELDS TERMINATED BY ','
        ENCLOSED BY '\"'
        LINES TERMINATED BY '\r\n'
        IGNORE 1 LINES";


 */

set_time_limit(300); // 設定執行時間限制為300秒（5分鐘）

// 檢查使用者是否已登入，以及操作權限
include("check_session.php");
if ($usergroup < 3) {
    echo $_SESSION['username'] . "你沒有執行權限！";
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

mysqli_options($conn, MYSQLI_OPT_CONNECT_TIMEOUT, 300); // 設定連接超時時間為300秒（5分鐘）

// 檢查是否有檔案上傳
if (isset($_FILES["file"])) {
    $file = $_FILES["file"]["name"];

    // 設定上傳路徑
    //$target_dir = "/var/www/html/hualien/sa/BK/ca/";
    $target_dir = "BK/ca/";
    $file_extension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . "ca_" . date("YmdHis") . "." . $file_extension;

    // 檢查檔案類型，只接受 CSV 檔案
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType != "csv") {
        echo "只接受 CSV 檔案。";
        exit;
    }

    // 先將ca資料表清空
    /* $sql_table_clear = "TRUNCATE TABLE ca";
    if ($conn->query($sql_table_clear)=== TRUE){
        echo "table ca old data truncated successfully";
    }else{
        echo "error truncating" . $conn-error;
    } */

    // 將檔案移到上傳目錄下
    move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);

    // 使用LOAD DATA INFILE語句將CSV檔案內容直接載入資料庫
    $sql = "LOAD DATA INFILE '" . addslashes($target_file) . "'
            INTO TABLE ca
            FIELDS TERMINATED BY ','
            ENCLOSED BY '\"'
            LINES TERMINATED BY '\r\n'
            IGNORE 1 LINES";
    
    if (mysqli_query($conn, $sql)) {
        $success_insert = mysqli_affected_rows($conn);
        echo "新紀錄插入中<br>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        $error_insert = 1;
    }

    echo "<p>匯入結果:";
    echo "<p>匯入成功筆數: " . $success_insert;
    echo "<p>匯入失敗筆數: " . $error_insert;
    echo "<p><a href=index.php>回首頁</a>";
}

// 關閉資料庫連接
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf8mb4_unicode_ci">
    <title>CSV 檔案匯入 MySQL 資料庫</title>
</head>
<body>
<h1>標準資格檔案上傳</h1>
    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
        <label for="file">選擇 CSV 檔案:</label>
        <input type="file" name="file" id="file"><br><br>
        <input type="submit" value="匯入">
    </form>
</body>
</html>
