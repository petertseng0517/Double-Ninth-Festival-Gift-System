<?php
// test edit ca
// 建立MySQL資料庫連線
$servername = "localhost";
$username = "your_name";
$password = "your_passwd";
$dbname = "respect_elderly";

$conn = new mysqli($servername, $username, $password, $dbname);

// 檢查連線是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 從資料庫中讀取表格資料
$sql = "SELECT * FROM ca";
$result = $conn->query($sql);

// 顯示表格資料於網頁表單中
echo "<h2>民政處資料編輯</h2>";
echo "<form method='post'>";
echo "<table>";

while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td><input type='checkbox' name='check[]' value='" . $row['pid'] . "'></td>";
    echo "<td><input type='text' name='pid' value='" . $row['pid'] . "'></td>";
    echo "<td><input type='text' name='ca_name' value='" . $row['ca_name'] . "'></td>";
    echo "<td><input type='text' name='birth_year' value='" . $row['birth_year'] . "'></td>";
    echo "<td><input type='text' name='birth_month' value='" . $row['birth_month'] . "'></td>";
    echo "<td><input type='text' name='birth_day' value='" . $row['birth_day'] . "'></td>";
    echo "<td><input type='text' name='county' value='" . $row['county'] . "'></td>";
    echo "<td><input type='text' name='township' value='" . $row['township'] . "'></td>";
    echo "<td><input type='text' name='village' value='" . $row['village'] . "'></td>";
    echo "<td><input type='text' name='address' value='" . $row['address'] . "'></td>";
    echo "<td><input type='text' name='other_notes' value='" . $row['other_notes'] . "'></td>";
    echo "</tr>";
}

echo "</table>";
echo "<input type='submit' value='Save'>";
echo "</form>";

// 如果使用者按下儲存按鈕，更新資料庫中的表格資料
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['check'])) {
        $check = $_POST['check'];

        foreach($check as $pid) {
           $field1 = $_POST['pid'];
           $field2 = $_POST['ca_name'];
           $field3 = $_POST['birth_year'];
           $field4 = $_POST['birth_month'];
           $field5 = $_POST['birth_day'];
           $field6 = $_POST['county'];
           $field7 = $_POST['township'];
           $field8 = $_POST['village'];
           $field9 = $_POST['address'];
           $field10 = $_POST['other_notes'];
       
       	   $sql = "UPDATE ca SET pid='$field1', ca_name='$field2', birth_year='$field3', birth_month='$field4', birth_day='$field5', county='$field6', township='$field7', village='$field8', address='$field9', other_notes='$field10'";

          if ($conn->query($sql) === TRUE) {
             echo "Data updated successfully";
              } else {
        echo "Error updating data: " . $conn->error;
    }
}

// 關閉資料庫連線
$conn->close();

?>

