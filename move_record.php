<?php
///功能：整併遷入遷出檔所有紀錄至move_record表中

//確定有登入系統
//session_start();

// 檢查使用者是否已登入，以及操作權限
include("check_session.php");
if($usergroup < 3){
	echo $_SESSION['username'] ."你沒有執行權限！";
	echo "<a href=index.php>回首頁</a>";
	exit();
	} 



// 資料庫連線

include("sql_connect.php");
$conn = mysqli_connect($servername, $username, $password, $dbname);


// 檢查連接是否成功
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




// 读取表格 move_in
$sql_move_in = "SELECT * FROM move_in";
$result_move_in = mysqli_query($conn, $sql_move_in);

// 检查并处理 move_in 表中的数据
while ($row_move_in = mysqli_fetch_assoc($result_move_in)) {	
    if (is_NULL($row_move_in['access'])) {
		// 将数据存入 move_record 表
        $insertMoveIn_sql = "INSERT INTO move_record (mr_pid, ca_name, birthday, accessDate, F_county, F_township, F_village, F_Neighborhood, F_address, T_county, T_township, T_village, T_Neighborhood, T_address, From_IO) 
                       VALUES ('".$row_move_in['pid']."', '".$row_move_in['in_name']."', '".$row_move_in['birthday']."', '".$row_move_in['accessDate']."', '".$row_move_in['F_county']."', '".$row_move_in['F_township']."', '".$row_move_in['F_village']."', '".$row_move_in['F_Neighborhood']."', '".$row_move_in['F_address']."', '".$row_move_in['T_county']."', '".$row_move_in['T_township']."', '".$row_move_in['T_village']."', '".$row_move_in['T_Neighborhood']."', '".$row_move_in['T_address']."', 'Fin')";
        mysqli_query($conn, $insertMoveIn_sql);
        $sum_in= $sum_in + 1;
        // 更新 move_in 表的 access 字段
        $updateMoveIn_sql = "UPDATE move_in SET access = 'I' WHERE pid = '".$row_move_in['pid']."'";
        mysqli_query($conn, $updateMoveIn_sql);
		//echo "save move_in data </p>";
		
    }
	
}


// 读取表格 move_out
$sql_move_out = "SELECT * FROM move_out";
$result_move_out = mysqli_query($conn, $sql_move_out);

// 检查并处理 move_out 表中的数据
while ($row_move_out = mysqli_fetch_assoc($result_move_out)) {	
    if (is_NULL($row_move_out['access'])) {		
        // 将数据存入 move_record 表
        $insertMoveOut_sql = "INSERT INTO move_record (mr_pid, ca_name, birthday, accessDate, F_county, F_township, F_village, F_Neighborhood, F_address, T_county, T_township, T_village, T_Neighborhood, T_address, From_IO) 
                       VALUES ('".$row_move_out['pid']."', '".$row_move_out['out_name']."', '".$row_move_out['birthday']."', '".$row_move_out['accessDate']."', '".$row_move_out['F_county']."', '".$row_move_out['F_township']."', '".$row_move_out['F_village']."', '".$row_move_out['F_Neighborhood']."', '".$row_move_out['F_address']."', '".$row_move_out['T_county']."', '".$row_move_out['T_township']."', '".$row_move_out['T_village']."', '".$row_move_out['T_Neighborhood']."', '".$row_move_out['T_address']."', 'Fout')";
        mysqli_query($conn, $insertMoveOut_sql);
        $sum_out= $sum_out + 1;
        // 更新 move_out 表的 access 字段
        $updateMoveOut_sql = "UPDATE move_out SET access = 'O' WHERE pid = '".$row_move_out['pid']."'";
        mysqli_query($conn, $updateMoveOut_sql);
		//echo "save move_out data </p>";
    }
	
}


// 關閉資料庫連接
mysqli_close($conn);


?>
