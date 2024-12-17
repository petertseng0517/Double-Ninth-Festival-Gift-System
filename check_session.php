<?php

//說明：以下取得兩個變數值，使用者中文名稱(uid)與群組(usergroup)，用來判斷使用權限。


session_start();

// 檢查使用者是否已登入
if (!isset($_SESSION['username'])) {
    // 若使用者未登入，導向到登入頁面
    header("Location: login.php");
    exit;
}

// 取得使用者帳號
$username_sys = $_SESSION['username'];


//取得使用者資訊

// 建立MySQL連線
include("sql_connect.php");
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 預備語句
$stmt = $conn->prepare("SELECT uid, usergroup FROM users WHERE username = ?");
$stmt->bind_param("s", $username_sys);

// 執行預備語句
$stmt->execute();

// 獲取結果
$result = $stmt->get_result();

// 檢查是否有結果
if ($result->num_rows > 0) {
    // 迭代每一行結果
    while ($row = $result->fetch_assoc()) {
        $uid = $row["uid"];
        $usergroup = $row["usergroup"];
        // 在這裡進行需要的操作
    }
} else {
    // 沒有找到匹配的結果
}

// 關閉預備語句和資料庫連接
$stmt->close();
$conn->close();


?>

