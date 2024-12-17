<?php
//單純用來比較兩個CSV檔案


// 取得目前日期
$date = date('Y-m-d');


// 設定要比對的兩個 CSV 檔案路徑
$file1 = 'csv/ca.csv'; //民政處主檔
$file2 = 'csv/sa01.csv'; //花蓮市公所申請列表

// 讀取檔案 1 的內容
$data1 = array_map('str_getcsv', file($file1));
$header1 = array_shift($data1);

// 讀取檔案 2 的內容
$data2 = array_map('str_getcsv', file($file2));
$header2 = array_shift($data2);

// 取得欄位 A 的索引值
$index1 = array_search('A', $header1);
$index2 = array_search('A', $header2);

// 比對兩個檔案的欄位 A
$result = array();
foreach ($data1 as $row1) {
    foreach ($data2 as $row2) {
        if ($row1[$index1] == $row2[$index2]) {
            $result[] = array_merge($row1, $row2);
        }
    }
}

// 將比對結果寫入新的 CSV 檔案
$output_file = $date . '_result.csv';
$fp = fopen($output_file, 'w');
fputcsv($fp, array_merge($header1, $header2));
foreach ($result as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

echo '比對完成，結果已寫入 ' . $output_file . "<br>Congraduation!";

