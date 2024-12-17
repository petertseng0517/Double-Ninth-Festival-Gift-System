<?php
if (isset($_POST['download'])) {
  // 取得要下載的資料表名稱
  $table_name = $_POST['table_name'];

  // 連線資料庫
  include("sql_connect.php");
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // 檢查連線
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // 搜尋資料庫表格
  $sql = "SELECT * FROM $table_name WHERE num_log IN (SELECT num_log FROM review_payment)";
  $result = mysqli_query($conn, $sql);

  // 建立Excel物件
  require 'vendor/autoload.php';
  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  $spreadsheet = new Spreadsheet();
  $sheet = $spreadsheet->getActiveSheet();
  $sheet->setCellValue('A1', 'bankcode');
  $sheet->setCellValue('B1', 'bankaccount');
  $sheet->setCellValue('C1', 'PID');
  $sheet->setCellValue('D1', 'money');

  $rowNumber = 2;
  while ($row = mysqli_fetch_assoc($result)) {
    $sheet->setCellValue('A' . $rowNumber, $row['bankcode']);
    $sheet->setCellValue('B' . $rowNumber, $row['bankaccount']);
    $sheet->setCellValue('C' . $rowNumber, $row['pid']);
    $sheet->setCellValue('D' . $rowNumber, $row['gift_money']);
    $rowNumber++;
  }

  mysqli_close($conn);

  // 設定檔案名稱
  $filename = "data.xlsx";

  // 儲存Excel檔案
  $writer = new Xlsx($spreadsheet);
  ob_end_clean(); // 清除緩衝區
  header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
  header("Content-Disposition: attachment; filename=\"$filename\"");
  header('Cache-Control: max-age=0');
  $writer->save('php://output');
  exit;
}
?>
