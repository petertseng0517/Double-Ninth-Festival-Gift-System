<!-- 花蓮縣各鄉鎮之村里選單 -->

	
		<label for="menu1">請選擇鄉鎮：</label>
		<select id="menu1" name="township" style="font-size: 25px;">
			<option value="">--Select--</option>
			<option value="花蓮市">花蓮市</option>
			<option value="新城鄉">新城鄉</option>
			<option value="秀林鄉">秀林鄉</option>
			<option value="吉安鄉">吉安鄉</option>
			<option value="壽豐鄉">壽豐鄉</option>
			<option value="鳳林鎮">鳳林鎮</option>
			<option value="萬榮鄉">萬榮鄉</option>
			<option value="光復鄉">光復鄉</option>
			<option value="瑞穗鄉">瑞穗鄉</option>
			<option value="玉里鎮">玉里鎮</option>
			<option value="卓溪鄉">卓溪鄉</option>
			<option value="豐濱鄉">豐濱鄉</option>
			<option value="富里鄉">富里鄉</option>
		</select>

		<label for="menu2">，請選擇村里</label>
		<select id="menu2" name="village" style="font-size: 25px;">
			<option value="">--Select--</option>
		</select>
	

	<script>
		// 監聽第一個下拉式選單的選擇事件
		$('#menu1').change(function() {
			var menu1_val = $(this).val(); // 取得第一個下拉式選單所選擇的值
			// 根據第一個下拉式選單所選擇的值，設定第二個下拉式選單的選項
			if (menu1_val == '花蓮市') {
				$('#menu2').html('<option value="">--Select--</option><option value="民立里">民立里</option><option value="民運里">民運里</option><option value="民族里">民族里</option><option value="主信里">主信里</option><option value="主睦里">主睦里</option><option value="主和里">主和里</option><option value="國威里">國威里</option><option value="國風里">國風里</option><option value="民德里">民德里</option><option value="民意里">民意里</option><option value="主義里">主義里</option><option value="主工里">主工里</option><option value="主農里">主農里</option><option value="國治里">國治里</option><option value="國富里">國富里</option><option value="民政里">民政里</option><option value="民勤里">民勤里</option><option value="民生里">民生里</option><option value="主商里">主商里</option><option value="主學里">主學里</option><option value="國光里">國光里</option><option value="國聯里">國聯里</option><option value="國強里">國強里</option><option value="民心里">民心里</option><option value="民樂里">民樂里</option><option value="民主里">民主里</option><option value="主勤里">主勤里</option><option value="主力里">主力里</option><option value="國安里">國安里</option><option value="國魂里">國魂里</option><option value="國慶里">國慶里</option><option value="民享里">民享里</option><option value="民有里">民有里</option><option value="民權里">民權里</option><option value="主計里">主計里</option><option value="主權里">主權里</option><option value="國華里">國華里</option><option value="國防里">國防里</option><option value="國福里">國福里</option><option value="國裕里">國裕里</option><option value="主安里">主安里</option><option value="國盛里">國盛里</option><option value="國興里">國興里</option><option value="民孝里">民孝里</option>');
			} else if (menu1_val == '新城鄉') {
				$('#menu2').html('<option value="">--Select--</option><option value="新城村">新城村</option><option value="順安村">順安村</option><option value="康樂村">康樂村</option><option value="北埔村">北埔村</option><option value="佳林村">佳林村</option><option value="嘉里村">嘉里村</option><option value="嘉新村">嘉新村</option><option value="大漢村">大漢村</option><option value="新秀村">新秀村</option>');
			} else if (menu1_val == '秀林鄉') {
				$('#menu2').html('<option value="">--Select--</option><option value="崇德村">崇德村</option><option value="富世村">富世村</option><option value="秀林村">秀林村</option><option value="水源村">水源村</option><option value="銅門村">銅門村</option><option value="文蘭村">文蘭村</option><option value="景美村">景美村</option><option value="佳民村">佳民村</option><option value="和平村">和平村</option>');
			} else if (menu1_val == '吉安鄉') {
				$('#menu2').html('<option value="">--Select--</option><option value="北昌村">北昌村</option><option value="勝安村">勝安村</option><option value="太昌村">太昌村</option><option value="永安村">永安村</option><option value="慶豐村">慶豐村</option><option value="吉安村">吉安村</option><option value="福興村">福興村</option><option value="南華村">南華村</option><option value="干城村">干城村</option><option value="永興村">永興村</option><option value="稻香村">稻香村</option><option value="南昌村">南昌村</option><option value="宜昌村">宜昌村</option><option value="仁里村">仁里村</option><option value="東昌村">東昌村</option><option value="仁安村">仁安村</option><option value="仁和村">仁和村</option><option value="光華村">光華村</option>');
			}else if (menu1_val == '壽豐鄉') {
				$('#menu2').html('<option value="">--Select--</option><option value="樹湖村">樹湖村</option><option value="溪口村">溪口村</option><option value="豐山村">豐山村</option><option value="豐裡村">豐裡村</option><option value="豐坪村">豐坪村</option><option value="共和村">共和村</option><option value="壽豐村">壽豐村</option><option value="光榮村">光榮村</option><option value="池南村">池南村</option><option value="平和村">平和村</option><option value="志學村">志學村</option><option value="米棧村">米棧村</option><option value="月眉村">月眉村</option><option value="水璉村">水璉村</option><option value="鹽寮村">鹽寮村</option>');
			}else if (menu1_val == '鳳林鎮') {
				$('#menu2').html('<option value="">--Select--</option><option value="鳳仁里">鳳仁里</option><option value="鳳義里">鳳義里</option><option value="鳳禮里">鳳禮里</option><option value="鳳智里">鳳智里</option><option value="鳳信里">鳳信里</option><option value="山興里">山興里</option><option value="大榮里">大榮里</option><option value="北林里">北林里</option><option value="南平里">南平里</option><option value="林榮里">林榮里</option><option value="長橋里">長橋里</option><option value="森榮里">森榮里</option>');
			}else if (menu1_val == '萬榮鄉') {
				$('#menu2').html('<option value="">--Select--</option><option value="西林村">西林村</option><option value="見晴村">見晴村</option><option value="萬榮村">萬榮村</option><option value="明利村">明利村</option><option value="馬遠村">馬遠村</option><option value="紅葉村">紅葉村</option>');
			}else if (menu1_val == '光復鄉') {
				$('#menu2').html('<option value="">--Select--</option><option value="大安村">大安村</option><option value="大華村">大華村</option><option value="大平村">大平村</option><option value="大馬村">大馬村</option><option value="大同村">大同村</option><option value="大進村">大進村</option><option value="大全村">大全村</option><option value="大興村">大興村</option><option value="大富村">大富村</option><option value="大豐村">大豐村</option><option value="東富村">東富村</option><option value="西富村">西富村</option><option value="南富村">南富村</option><option value="北富村">北富村</option>');
			}else if (menu1_val == '瑞穗鄉') {
				$('#menu2').html('<option value="">--Select--</option><option value="瑞穗村">瑞穗村</option><option value="瑞美村">瑞美村</option><option value="瑞良村">瑞良村</option><option value="瑞祥村">瑞祥村</option><option value="瑞北村">瑞北村</option><option value="舞鶴村">舞鶴村</option><option value="鶴岡村">鶴岡村</option><option value="奇美村">奇美村</option><option value="富源村">富源村</option><option value="富民村">富民村</option><option value="富興村">富興村</option>');
			}else if (menu1_val == '玉里鎮') {
				$('#menu2').html('<option value="">--Select--</option><option value="中城里">中城里</option><option value="啟模里">啟模里</option><option value="永昌里">永昌里</option><option value="泰昌里">泰昌里</option><option value="國武里">國武里</option><option value="源城里">源城里</option><option value="長良里">長良里</option><option value="樂合里">樂合里</option><option value="東豐里">東豐里</option><option value="觀音里">觀音里</option><option value="松浦里">松浦里</option><option value="春日里">春日里</option><option value="德武里">德武里</option><option value="三民里">三民里</option><option value="大禹里">大禹里</option>');
			}else if (menu1_val == '卓溪鄉') {
				$('#menu2').html('<option value="">--Select--</option><option value="崙山村">崙山村</option><option value="立山村">立山村</option><option value="太平村">太平村</option><option value="卓溪村">卓溪村</option><option value="卓清村">卓清村</option><option value="古風村">古風村</option>');
			}else if (menu1_val == '豐濱鄉') {
				$('#menu2').html('<option value="">--Select--</option><option value="豐濱村">豐濱村</option><option value="新社村">新社村</option><option value="磯崎村">磯崎村</option><option value="港口村">港口村</option><option value="靜浦村">靜浦村</option>');
			}else if (menu1_val == '富里鄉') {
				$('#menu2').html('<option value="">--Select--</option><option value="吳江村">吳江村</option><option value="東里村">東里村</option><option value="萬寧村">萬寧村</option><option value="新興村">新興村</option><option value="竹田村">竹田村</option><option value="羅山村">羅山村</option><option value="石牌村">石牌村</option><option value="明里村">明里村</option><option value="富里村">富里村</option><option value="永豐村">永豐村</option><option value="豐南村">豐南村</option><option value="富南村">富南村</option><option value="學田村">學田村</option>');
			}else {
				$('#menu2').html('<option value="">--Select--</option>');
			}
		});
	</script>

