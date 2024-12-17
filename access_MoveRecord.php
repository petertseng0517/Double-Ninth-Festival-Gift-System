<?php

// 功能：依條件來處理表格move_record的遷入遷出檔資料。


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


//用left join處理表move_record和ca，並將結果排序
//之前有處理過的紀錄，在FromIO欄位的值，最後面會有D，這種就不要
$sql_access_MoveRecord = "SELECT ca.pid, mr.mr_pid, mr.ca_name, mr.birthday, mr.accessDate, mr.T_county, mr.T_township, mr.T_village, mr.T_Neighborhood, mr.T_address, mr.From_IO FROM move_record mr LEFT JOIN ca ON mr.mr_pid = ca.pid WHERE mr.From_IO NOT like '%D' ORDER by mr.accessDate ASC";

$result_access_MoveRecord = mysqli_query($conn, $sql_access_MoveRecord);

echo "</p>遷入遷出檔merge至ca數量：" .mysqli_num_rows($result_access_MoveRecord); //統計筆數-debug用


//檢視內容-debug用
/* while ($row = mysqli_fetch_assoc($result_access_MoveRecord)) {
    echo "PID: " . $row['pid'] . "<br>";
    echo "PID: " . $row['mr_pid'] . "<br>";
	echo "CA Name: " . $row['ca_name'] . "<br>";
    echo "Birthday: " . $row['birthday'] . "<br>";
    // 其他欄位...
    echo "<hr>"; // 分隔線
} */


//條件判斷
/* 1.來源屬於遷入檔，且ca表中有此紀錄，則更新ca表中，此紀錄的內容。
2.來源屬於遷入檔，且ca表中無此紀錄，則插入至ca表
3.來源屬於遷出檔，且遷去的地點非花蓮縣，則在ca表中，直接刪除紀錄。 */

  if (mysqli_num_rows($result_access_MoveRecord) > 0) {
    while ($row_AM = mysqli_fetch_assoc($result_access_MoveRecord)) {
        if ($row_AM['From_IO'] == 'Fin' && $row_AM['pid'] != NULL) {
			// 條件一：若move_record表中有pid值，則更新表 ca 的相同pid的紀錄
            
			$update_sql = "UPDATE ca SET township = '{$row_AM['mr.township']}', village = '{$row_AM['mr.village']}', Neighborhood = '{$row_AM['mr.Neighborhood']}', address = '{$row_AM['mr.address']}' WHERE ca.pid = '{$row_AM['mr_pid']}'";
            mysqli_query($conn, $update_sql);
			
        } elseif ($row_AM['From_IO'] == 'Fin' && $row_AM['pid'] == NULL) {
            // 條件二：若move_record表沒有pid值，則插入紀錄至表 ca
            $insert_sql = "INSERT INTO ca (pid, ca_name, birthday, county, township, village, Neighborhood, address, other_notes) VALUES ('{$row_AM['mr_pid']}', '{$row_AM['ca_name']}','{$row_AM['birthday']}', '{$row_AM['T_county']}', '{$row_AM['T_township']}', '{$row_AM['T_village']}', '{$row_AM['T_Neighborhood']}', '{$row_AM['T_address']}', '')";
            mysqli_query($conn, $insert_sql);
        } elseif ($row_AM['From_IO'] == 'Fout' && $row_AM['T_county'] != '花蓮縣' && $row_AM['pid'] != NULL) {
            // 條件三：若遷出花蓮，刪除表 ca 的此筆紀錄
            
			$delete_sql = "DELETE FROM ca WHERE pid = '{$row_AM['mr_pid']}'";
            mysqli_query($conn, $delete_sql);
        } else {
			//echo "<p>sorry!";
    }
	
	
	
}

} 


//將處理過的movecord紀錄，在From_IO欄位的值，最後面更新加個D，作為有沒有處理過的判斷。
	 $update_MoveRecordsql = "UPDATE move_record SET From_IO = CONCAT(From_IO, 'D') WHERE From_IO NOT like '%D'";
	mysqli_query($conn, $update_MoveRecordsql); 
//echo "update move_record already";

// 關閉資料庫連線
mysqli_close($conn);

?>


