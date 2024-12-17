<!-- 銀行、農漁會、信用合作社、郵局選單 -->

	
		<label for="bank_group">金融機構類別：</label>
		<select id="bank_group" name="bank_group" style="font-size: 25px;">
			<option value="">--Select--</option>
			<option value="郵局">郵局</option>
			<option value="本國銀行">本國銀行</option>
			<option value="農會">農會</option>
			<option value="漁會">漁會</option>
			<option value="信用合作社">信用合作社</option>
			<option value="外商銀行">外商銀行</option>
		</select>

		<label for="menu_bankcode">，請選擇機構代碼</label>
		<select id="menu_bankcode" name="menu_bankcode" style="font-size: 25px;">
			<option value="">--Select--</option>
		</select>
	

	<script>
		// 監聽第一個下拉式選單的選擇事件
		$('#bank_group').change(function() {
			var bank_group_val = $(this).val(); // 取得第一個下拉式選單所選擇的值
			// 根據第一個下拉式選單所選擇的值，設定第二個下拉式選單的選項
			if (bank_group_val == '本國銀行') {
				$('#menu_bankcode').html('<option value="">--Select--</option><?php include("01bank_code.php"); ?>');
			} else if (bank_group_val == '農會') {
				$('#menu_bankcode').html('<option value="">--Select--</option><?php include("02bank_code.php"); ?>');
			} else if (bank_group_val == '漁會') {
				$('#menu_bankcode').html('<option value="">--Select--</option><?php include("03bank_code.php"); ?>');
			} else if (bank_group_val == '信用合作社') {
				$('#menu_bankcode').html('<option value="">--Select--</option><?php include("04bank_code.php"); ?>');
			} else if (bank_group_val == '外商銀行') {
				$('#menu_bankcode').html('<option value="">--Select--</option><?php include("05bank_code.php"); ?>');
			} else if (bank_group_val == '郵局') {
				$('#menu_bankcode').html('<option value="">--Select--</option><?php include("06bank_code.php"); ?>');
			}else {
				$('#menu_bankcode').html('<option value="">--Select--</option>');
			}
		});
	</script>

