<?php


function checkId($id) {
        // 去空白&轉大寫
        $id = strtoupper(trim($id));

        // 英文字母與數值對照表
        $alphabetTable = [
            'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16,
            'H' => 17, 'I' => 34, 'J' => 18, 'K' => 19, 'L' => 20, 'M' => 21, 'N' => 22,
            'O' => 35, 'P' => 23, 'Q' => 24, 'R' => 25, 'S' => 26, 'T' => 27, 'U' => 28,
            'V' => 29, 'X' => 30, 'Y' => 31, 'Z' => 33
        ];

        // 檢查身份證字號格式
        // ps. 第二碼的例外條件ABCD，在這裡未實作，僅提供需要的人參考，實作方式是A對應10，只取個位數0去加權即可
        // 臺灣地區無戶籍國民、大陸地區人民、港澳居民：
        // 男性使用A、女性使用B
        // 外國人：
        // 男性使用C、女性使用D
        if (!preg_match("/^[A-Z]{1}[12ABCD]{1}[0-9]{8}$/", $id)){
            // ^ 是開始符號
            // $ 是結束符號
            // [] 中括號內是正則條件
            // {} 是要重複執行幾次
            throw new Exception('格式、長度錯誤'); 
        }

        // 切開字串
        $idArray = str_split($id);

        // 英文字母加權數值
        $alphabet = $alphabetTable[$idArray[0]];
        $point = substr($alphabet, 0, 1) * 1 + substr($alphabet, 1, 1) * 9;

        // 數字部分加權數值
        for ($i = 1; $i <= 8; $i++) {
            $point += $idArray[$i] * (9 - $i);
        }
        $point = $point + $idArray[9];

        return $point % 10 == 0 ? true : false;
    }




?>