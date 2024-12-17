<?php

////2023年重陽禮金計算基準
//(一)65~84歲(民國47年10月23日~27年10月24日) ➝六百元
//(二)85~89歲(民國27年10月23日~22年10月24日) ➝三千元
//(三)90~99歲(民國22年10月23日~13年1月1日) ➝五千元

////換算成生日格式如下
//(一)65~84歲(民國0271024-0471023) ➝六百元
//(二)85~89歲(民國0221024-0271023) ➝三千元
//(三)90~99歲(民國0130101-0221023) ➝五千元




// 更新 request_money 表格中的 gift_money 值
$update_sql = "UPDATE request_money rm
               INNER JOIN ca c ON rm.pid = c.pid
               SET rm.gift_money = CASE
                 WHEN c.birthday BETWEEN '0271024' AND '0471023' THEN 600
                 WHEN c.birthday BETWEEN '0221024' AND '0271023' THEN 3000
                 WHEN c.birthday BETWEEN '0130101' AND '0221023' THEN 5000
                 ELSE 0
               END
               WHERE rm.result_compare = 'Y'";

$result = mysqli_query($conn, $update_sql);

if ($result) {
    echo "rm金額計算更新成功！";
} else {
    echo "rm金額計算更新失敗：" . mysqli_error($conn);
}


// 更新ca 表格中的 other_notes 值，作為未申請，要給公所造冊發現金的依據
$ca_update_sql = "UPDATE ca
               SET ca.other_notes = CASE
                 WHEN ca.birthday BETWEEN '0271024' AND '0471023' THEN 600
                 WHEN ca.birthday BETWEEN '0221024' AND '0271023' THEN 3000
                 WHEN ca.birthday BETWEEN '0130101' AND '0221023' THEN 5000
                 ELSE 0
               END
               WHERE ca.other_notes = ''";

$ca_result = mysqli_query($conn, $ca_update_sql);

if ($ca_result) {
    echo "ca金額計算更新成功！";
} else {
    echo "ca金額計算更新失敗：" . mysqli_error($conn);
}




?>

