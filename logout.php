<?php


session_start();
// 清除session中的登入狀態
session_unset();
session_destroy();
// 轉向登入頁面
header("location: login.php");
exit;


?>
