<?php

// 取得使用者輸入的帳號和密碼
$username = $_POST['username'];
$password = $_POST['password'];

// 從資料庫中取得使用者的資訊，包括加密後的密碼
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// 使用相同的加密演算法加密使用者在登入表單中輸入的密碼
$hashed_password = hash('sha256', $password);

// 將加密後的輸入密碼與資料庫中存儲的加密後的密碼進行比對
if ($hashed_password === $user['password']) {
    // 密碼正確，允許使用者登入
} else {
    // 密碼錯誤，顯示錯誤訊息
}


>
