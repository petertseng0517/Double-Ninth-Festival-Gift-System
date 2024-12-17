<?php
// 系統使用者帳號提交

//群組編號：4->系統管理者
//群組編號：3->縣府承辦
//群組編號：2->鄉鎮公所
//群組編號：1->里辦公室

// 檢查使用者是否已登入，以及操作權限
include("check_session.php");
if($usergroup!=4){
	//先把佈景主題顯示出來
	
	echo '<div class="col-lg-8 mx-auto p-4 py-md-5">'; //整體寬度
	echo '<header style="text-align-last: center;">
			<a href="index.php"><img class="mb-4" src="img/logo.png" alt="" style="max-width: 500px;width: 100%;" ></a>
			</header>';


	echo '<div style="border-top: 6px dashed #575757;height: 1px;overflow: hidden;padding-bottom: 50px;"></div>' ; //分隔線
	echo '<div class="col-md-12" style="background: #ace5ff; padding: 50px;margin-top: 0;">'; //方框背景
	
	echo $_SESSION['username'] ."你沒有執行權限！";
	echo "<a href=index.php>請回首頁</a>";
	exit();
	} 
	


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 檢查表單是否完整填寫
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $uid = $_POST["uid"];
		$usergroup = $_POST["usergroup"];
        
        // 將密碼用SHA-256加密處理
       // $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $hashed_password = base64_encode(hash("sha256", $password, true));

	
	// 將使用者帳號和密碼儲存到MySQL的user表中
	
        $servername = "localhost";
        $db_username = "your_name";
        $db_password = "your_passwd";
        $dbname = "respect_elderly";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO users (uid, username, password, usergroup) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $uid, $username, $hashed_password, $usergroup);

        if ($stmt->execute() === TRUE) {
		echo "註冊成功";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "請填寫完整註冊表單";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>系統使用者帳號註冊頁面</title>
	
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
    <h2 style="font-weight: bold;font-size: 36px;">註冊新帳號</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        帳號: <input type="text" name="username" style="font-size: 25px;"><br>
        密碼: <input type="password" name="password" style="font-size: 25px;"><br>
        姓名: <input type="text" name="uid" style="font-size: 25px;"><br>
		<label for="usergroup">請選擇群組：</label>
		<select name="usergroup" id="usergroup" style="font-size: 25px;">
			<option value="">--Select--</option>
			<option value="4">系統管理者</option>
			<option value="3">縣府承辦</option>
			<option value="2">鄉鎮公所</option>
			<option value="1">里辦公室</option>
		</select>	
		
        <input type="submit" value="註冊" style="font-size: 25px;">
    </form>
</body>
</html>

