<?php include "config.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Бочонки Amhani</title>
	<link rel="stylesheet" href="style.css" />
	<link rel="stylesheet" href="media.css" />
	<script src="jquery-3.1.0.min.js"></script>
	<script src="jQueryRotateCompressed.2.2.js"></script>
	<META name="keywords" content="Бочонки с мёдом, Корпоративные подарки">
	<script>
		var boch_img = [];
		var boch_name = [];
		var boch_descr = [];
		var boch_table = [];
		var boch_art = [];
		var boch_kol = '<?php echo $boch_kol; ?>';
		var i=0;
		<?php for ($i=0;$i<$boch_kol;$i++): ?>
			boch_img[i]='<?php echo $boch_img[$i];?>';
			boch_name[i]='<?php echo $boch_name[$i];?>';
			boch_descr[i]='<?php echo $boch_descr[$i];?>';
			boch_table[i]='<?php echo $boch_table[$i];?>';
			boch_art[i]='<?php echo $boch_art[$i];?>';
			i++;
		<?php endfor; ?>
	</script>	
	<script src="my.js"></script>

		<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
	    (function (d, w, c) {
	        (w[c] = w[c] || []).push(function() {
	            try {
	                w.yaCounter39690430 = new Ya.Metrika({
	                    id:39690430,
	                    clickmap:true,
	                    trackLinks:true,
	                    accurateTrackBounce:true,
	                    webvisor:true
	                });
	            } catch(e) { }
	        });

	        var n = d.getElementsByTagName("script")[0],
	            s = d.createElement("script"),
	            f = function () { n.parentNode.insertBefore(s, n); };
	        s.type = "text/javascript";
	        s.async = true;
	        s.src = "https://mc.yandex.ru/metrika/watch.js";

	        if (w.opera == "[object Opera]") {
	            d.addEventListener("DOMContentLoaded", f, false);
	        } else { f(); }
	    })(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/39690430" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->

</head>
<body>
	<div id="boch_popup">
		<div class="popimg"><img src="images/banochki/1.jpg"></div>
		<div class="popimg"><img src="images/banochki/2.jpg"></div>
		<div class="popimg"><img src="images/banochki/3.jpg"></div>
		<div class="popimg"><img src="images/banochki/4.jpg"></div>
		<div class="popimg"><img src="images/banochki/5.jpg"></div>
		<div class="popimg"><img src="images/banochki/6.jpg"></div>
		<div class="popimg"><img src="images/banochki/7.jpg"></div>
		<div class="popimg"><img src="images/banochki/8.jpg"></div>
		<div class="popimg"><img src="images/banochki/9.jpg"></div>
		<div class="popimg"><img src="images/banochki/10.jpg"></div>
		<div class="popimg"><img src="images/banochki/11.jpg"></div>
		<div class="popimg"><img src="images/banochki/12.jpg"></div>
		<div class="popimg"><img src="images/banochki/13.jpg"></div>
		<div class="popimg"><img src="images/banochki/14.jpg"></div>
		<div class="popimg"><img src="images/banochki/15.jpg"></div>
		<div class="popimg"><img src="images/banochki/16.jpg"></div>
		<div class="popimg"><img src="images/banochki/17.jpg"></div>
		<div class="popimg"><img src="images/banochki/18.jpg"></div>
		<div class="popimg"><img src="images/banochki/19.jpg"></div>
		<div class="popimg"><img src="images/banochki/20.jpg"></div>
		<div class="popimg"><img src="images/banochki/21.jpg"></div>
		<div class="popimg"><img src="images/banochki/22.jpg"></div>
		<div class="popimg"><img src="images/banochki/23.jpg"></div>
		<div class="popimg"><img src="images/banochki/24.jpg"></div>
		<div class="popimg"><img src="images/banochki/25.jpg"></div>
		<div class="popimg"><img src="images/banochki/26.jpg"></div>
		<div class="popimg"><img src="images/banochki/27.jpg"></div>
		<div class="popimg"><img src="images/banochki/28.jpg"></div>
		<div class="popimg"><img src="images/banochki/29.jpg"></div>
	</div>
	<div id="modal">
		<div class="modal_thanks"><p class="p_thanks">Откройте пожалуйста письмо на Вашей почте</p></div>
		<div class="form" id="form1">
			<h2>Введите Ваши данные</h2>
				<h3>и получите прайс лист</h3>
				<form action="#" id="form1-1" method="post">
					<input name="name" id="name1" class="inp_name" placeholder="Имя *">
					<input name="phone" id="phone1" class="inp_name" placeholder="Телефон *">
					<input name="mail" id="mail1" class="inp_name" placeholder="Почта *">
					<input type="checkbox" checked name="soglas" class="soglas"><p class="soglas_p">Я согласен получать информацию о наших акциях и новинках</p>
					<input type="submit" onclick="yaCounter39690430.reachGoal('send'); return true;" class="form_submit" value="Скачать прайс">
				</form>
			<div class="zakr"></div>
		</div>
		<div class="form" id="form2">
			<h2>Введите Ваши данные</h2>
				<h3>и получите прайс лист</h3>
				<form action="#" id="form2-1" method="post">
					<input name="name" id="name2" class="inp_name" placeholder="Имя *">
					<input name="phone" id="phone2" class="inp_name" placeholder="Телефон *">
					<input name="mail" id="mail2" class="inp_name" placeholder="Почта *">
					<textarea name="vopros" placeholder="Ваши вопросы и пожелания"></textarea>		
					<input type="checkbox" checked="" name="soglas" class="soglas"><p class="soglas_p">Я согласен получать информацию о наших акциях и новинках</p>			
					<input type="submit" onclick="yaCounter39690430.reachGoal('send'); return true;" class="form_submit" value="Скачать прайс">
				</form>
			<div class="zakr"></div>
		</div>	
			
	</div>
	<div class="header">
		<div class=top_menu>
			<a href="#bochonki">Бочонки</a>
			<a href="#craft_paket">Корпоративные подарки</a>
			<a href="#banochki">Баночки</a>
			<a href="#sorta">Сорта мёда</a>
			<a href="#onas" class="onas">О нас</a>
			<div class="top_menu_strelka"></div>
		</div>
		<div class="header_bg">
			<div class="logo"></div>
		</div>
		<div class="head_left">
			<h1>Подарочные наборы</h1>
			<p>с мёдом оптом</p>
			<h1>60 видов<br>бочонков</h1>
			<p>с 35 сортами мёда на выбор<br> с Вашейсимволикой <br> оптом от 30.000 рублей</p>
			<h1>Фасуем</h1>
			<p>под заказ наш мёд в стекло банки<br>от 30 до 1000гр.</p>
			<h1>Сроки<br>изготовления</h1>
			<p>от 3-х дней, доставляем по всей России.</p>
			<div class="pchela"></div>
		</div>
		<div class="head_right">
			<p>E-MAIL: Amhani@yandex.ru<br><br>+7 (499) 372-05-11<br>8 (800) 100-07-38</p>
			<div class="form">
			<h2>Введите контакты для связи</h2>
				<h3>и скачайте прайс лист</h3>
				<form action="#" id="form3" method="post">
					<input name="name" id="name3" class="inp_name" placeholder="Имя *">
					<input name="phone" id="phone3" class="inp_name" placeholder="Телефон *">
					<input name="mail" id="mail3" class="inp_name" placeholder="Почта *">
					<textarea name="vopros" placeholder="Ваши вопросы и пожелания"></textarea>
					<input type="checkbox" checked name="soglas" class="soglas"><p class="soglas_p">Я согласен получать информацию о наших акциях и новинках</p>
					<input type="submit" onclick="yaCounter39690430.reachGoal('send'); return true;" class="form_submit" value="Скачать прайс">
				</form>
			</div>
		</div>
	</div>
	<div id="bochonki" class="bochonki">
		<div class="bochonki_top_line"></div>
		<div class="bochonki_top">
			<h1>Бочонки</h1>
			<p>Медведи, самовары, туеса, челяки, ульи,<br>поставцы, кадочки, пеньки, кадушки с мёдом.</p>
		</div>
		<div class=bochonki_items>
			<div class="bochonki_items_popup">
				<div class="boch_zakr"></div>
				<div class="bochonki_popup_left">
					<div class="bochonki_ramka">
						<img src="images/bochonki_popup_img.jpg">
					</div>
					<div class="bochonki_art">
						<p>Артикул <span> 0</span></p>
					</div>
				</div>
				<div class="bochonki_popup_center">
					<div class="bochonki_table">
																
					</div>
				</div>
				<div class="bochonki_popup_right">
					<div class="form">
					<h2>Заполните поля</h2>
						<h3>и скачайте прайс лист</h3>
						<form action="#" id="form4" method="post">
							<input name="name" id="name4" class="inp_name" placeholder="Имя *">
							<input name="phone" id="phone4" class="inp_name" placeholder="Телефон *">
							<input name="mail" id="mail4" class="inp_name" placeholder="Почта *">
							<textarea placeholder="Ваши вопросы и пожелания"></textarea>
							<input type="checkbox" checked name="soglas" class="soglas"><p class="soglas_p">Я согласен получать информацию о наших акциях и новинках</p>
							<input name="art" class="hidden_input">
							<input type="submit" onclick="yaCounter39690430.reachGoal('send'); return true;" class="form_submit" value="Скачать прайс">
						</form>
					</div>					
				</div>
				<div class="clear"></div>
			</div>
			<div class="bochonki_left"></div>
			<div class="bochonki_items_block">
				<ul>
					<li><img src="images/bochonki/101_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p></p></div></div></li>
					<li><img src="images/bochonki/102_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p>Светлый с обручами</p></div></div></li>
					<li><img src="images/bochonki/103_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p>цвета дуб с обручами</p></div></div></li>
					<li><img src="images/bochonki/204_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок темный</h3><p> с обручами с лаковым покрытием</p></div></div></li>
					<li><img src="images/bochonki/205_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p> темный с обручами</p></div></div></li>
					<li><img src="images/bochonki/206_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p>темный с текстурой</p></div></div></li>
					<li><img src="images/bochonki/207_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p>темный с текстурой</p></div></div></li>
					<li><img src="images/bochonki/208_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p>темный с проточками</p></div></div></li>
					<li><img src="images/bochonki/209_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок темный</h3><p>с проточками с лаковым покрытием</p></div></div></li>
					<li><img src="images/bochonki/210_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p> светлый с проточками</p></div></div></li>
					<li><img src="images/bochonki/211_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p>Светлый</p></div></div></li>
					<li><img src="images/bochonki/212_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок темный</h3><p>с лаковым покрытием</p></div></div></li>
					<li><img src="images/bochonki/213_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок-рой</h3><p>желтый</p></div></div></li>
					<li><img src="images/bochonki/214_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок-рой</h3><p>Светлый</p></div></div></li>
					<li><img src="images/bochonki/215_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок-рой</h3><p>белый</p></div></div></li>
					<li><img src="images/bochonki/216_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p>темный</p></div></div></li>
					<li><img src="images/bochonki/302_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Ведерко</h3><p> со светлой полосой</p></div></div></li>
					<li><img src="images/bochonki/303_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Ведерко</h3><p> с темной полосой</p></div></div></li>
					<li><img src="images/bochonki/304_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Батман светлый</h3><p> для меда</p></div></div></li>

					<li><img src="images/bochonki/1000_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок с </h3><p>медведем (керамика)</p></div></div></li>
					<li><img src="images/bochonki/1001_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок с </h3><p>медведем (керамика)</p></div></div></li>
					<li><img src="images/bochonki/1002_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Улей</h3><p>(керамика)</p></div></div></li>
					<li><img src="images/bochonki/1003_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Крынка "Дед"</h3><p>(керамика)</p></div></div></li>
					<li><img src="images/bochonki/1004_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Крынка </h3><p>"Самовар" (керамика)</p></div></div></li>
					<li><img src="images/bochonki/1005_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Крынка </h3><p>"Дом" (керамика)</p></div></div></li>

					<li><img src="images/bochonki/401_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадочка</h3><p>темная</p></div></div></li>
					<li><img src="images/bochonki/402_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадочка</h3><p>темная</p></div></div></li>
					<li><img src="images/bochonki/403_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадочка</h3><p>темная</p></div></div></li>
					<li><img src="images/bochonki/404_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадочка</h3><p>светлая</p></div></div></li>
					<li><img src="images/bochonki/405_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадочка расписная</h3><p>для меда</p></div></div></li>
					<li><img src="images/bochonki/406_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадочка расписная</h3><p>для меда</p></div></div></li>
					<li><img src="images/bochonki/501_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадушка</h3><p> светлая с обручами</p></div></div></li>
					<li><img src="images/bochonki/502_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадушка светлая</h3><p> с линиями с обручами</p></div></div></li>
					<li><img src="images/bochonki/503_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадушка темная</h3><p>с обручами, покрытая лаком</p></div></div></li>
					<li><img src="images/bochonki/504_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадушка</h3><p> темная с обручами</p></div></div></li>
					<li><img src="images/bochonki/506_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадушка темная</h3><p> с обручами с текстурой</p></div></div></li>
					<li><img src="images/bochonki/507_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадушка</h3><p> темная с обручами</p></div></div></li>
					<li><img src="images/bochonki/508_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадушка</h3><p> светлая с полосами</p></div></div></li>
					<li><img src="images/bochonki/510_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Кадушка</h3><p> темная с полосами</p></div></div></li>
					<li><img src="images/bochonki/701_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Туес темный с обручами</h3><p>покрытый лаком</p></div></div></li>
					<li><img src="images/bochonki/702_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Туес темный</h3><p> с обручами</p></div></div></li>
					<li><img src="images/bochonki/704_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Туес расписной</h3><p> с обручами</p></div></div></li>
					<li><img src="images/bochonki/707_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Туес светлый</h3><p> с обручами</p></div></div></li>
					<li><img src="images/bochonki/801_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Чиляк</h3><p>темный с обручами</p></div></div></li>
					<li><img src="images/bochonki/803_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Чиляк темный </h3><p> с обручами цвета дуб</p></div></div></li>
					<li><img src="images/bochonki/806_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Чиляк </h3><p>расписной</p></div></div></li>
					<li><img src="images/bochonki/601_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Самовар</h3><p>расписной</p></div></div></li>
					<li><img src="images/bochonki/602_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Самовар</h3><p>темный</p></div></div></li>
					<li><img src="images/bochonki/901_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Поставец</h3><p> расписной светлый</p></div></div></li>	
					<li><img src="images/bochonki/902_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Поставец</h3><p>расписной белый</p></div></div></li>	
					<li><img src="images/bochonki/903_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Поставец</h3><p>темный</p></div></div></li>	
					<li><img src="images/bochonki/914_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Улей</h3><p>резной</p></div></div></li>	
					<li><img src="images/bochonki/915_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Улей</h3><p>резной</p></div></div></li>	
					<li><img src="images/bochonki/916_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Пенек </h3><p>темный резной</p></div></div></li>	
					<li><img src="images/bochonki/104_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок с вырезанным</h3><p> вручную медведем на крышке</p></div></div></li>	
					<li><img src="images/bochonki/105_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок с вырезанным</h3><p>вручную медведем на подставке</p></div></div></li>	
					<li><img src="images/bochonki/106_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок с обручами</h3><p>с медведем на крышке</p></div></div></li>	
					<li><img src="images/bochonki/107_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p> с медведем на крышке</p></div></div></li>	
					<li><img src="images/bochonki/108_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок</h3><p>с медведем на подставке</p></div></div></li>	
					<li><img src="images/bochonki/109_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Бочонок с обручами</h3><p> с медведем на крышке</p></div></div></li>	
					<li><img src="images/bochonki/110_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Ложка</h3><p>деревянная</p></div></div></li>	
					<li><img src="images/bochonki/111_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Ложка деревянная</h3><p>с логотипом</p></div></div></li>	
					<li><img src="images/bochonki/112_small.jpg"><div class="mini_boch_bg1"><div class="mini_boch_kr"></div><div class="mini_boch_bg2"><h3>Ложка</h3><p>деревянная</p></div></div></li>											
				</ul>
			</div>
			<div class="bochonki_right"></div>
			<div class="clear"></div>
			<a class="bochenki_popup_href">Подберем вам Бочонок и сорт мёда под Ваш бюджет</a>
		</div>
	</div>
	<div class="banochki">
		<div id="craft_paket"  class="bochonki_top_line"></div>
		<h1 class="craft_zag">Корпоративные подарки</h1>
		<p class="podzag">Собери подарок: бочонок на выбор с мёдом на выбор + чай на выбор + ложка, оформленный в прозрачную упаковку</p>
		<div class="images">
			<ul>
				<li><img src="images/nabor/267_small.jpg"><p>От 267 руб.</p></li>
				<li><img src="images/nabor/327_small.jpg"><p>От 327 руб.</p></li>
				<li><img src="images/nabor/373_small.jpg"><p>От 373 руб.</p></li>
				<li><img src="images/nabor/417_small.jpg"><p>От 417 руб.</p></li>
				<li><img src="images/nabor/485_small.jpg"><p>От 485 руб.</p></li>
				<li><img src="images/nabor/513_small.jpg"><p>От 513 руб.</p></li>
				<li><img src="images/nabor/544_small.jpg"><p>От 544 руб.</p></li>
				<li><img src="images/nabor/685_small.jpg"><p>От 685 руб.</p></li>
				<li><img src="images/nabor/785_small.jpg"><p>От 785 руб.</p></li>
				<div class="clear"></div>
			</ul>
		</div>
<!--	<div class="kraft_top">
			<div class="kraft_top_left">
				<p>Фасуем в крафт пакеты чай на Ваш выбор<br>Возможно нанесение Вашего логотипа</p>
			</div>
			<div class="kraft_top_right"><p>Фасуем в тубусы с Вашей символикой<br>Баночки с мёдом «шайба»<br>130гр. и 250гр. от 2 до 4 штук.</p></div>
			<div class="clear"></div>	
		</div>
		<div class="kraft_ramki">
			<div class="ramka_left">
				<img src="images/kraft_left_img.jpg">
			</div>
			<div class="ramka_right">
				<img src="images/kraft_right_img2.jpg">
			</div>
			<div class="clear"></div>
		</div>	-->
		<a style="margin-bottom:70px" id="price_poluch">Получить прайс лист на чай и тубусы</a>	
		<div id="banochki"  class="bochonki_top_line"></div>
		<div class="banochki_top">
			<div class="banochki_top_left">
				<h1>Баночки</h1>
				<p>Фасуем наш мёд под заказ в стекло таре от 30мл до 1кг<br>в бумажном крафт оформлении с биркой<br>под вашим/нашим логотипом  от суммы заказа 30.000 рублей</p>
			</div>
			<div class="banochki_top_right"></div>
			<div class="clear"></div>	
		</div>
		<div class="ramki">
			<div class="ramka_left">
				<img src="images/ramka_left_img.jpg">
			</div>
			<div class="ramka_right">
				<img src="images/ramka_right_img.jpg">
			</div>
			<div class="clear"></div>
		</div>
		<a id="price_poluch">Получить прайс лист на стекло банки с мёдом</a>
	</div>
	<div id="sorta" class="sorta">
		<div class="bochonki_top_line"></div>
		<div class="sorta_container">
			<div class="sorta_left">
				<h1>Сорта мёда</h1>
				<p>Мёд с пасек Бащкирии, Алтая,<br>Юга России, Казахстана,<br>Дальнего Востока,<br>гор Киргизии и других регионов.</p>
				<div class="pchela3"></div>
			</div>
			<div class="sorta_right">
				<div class="map"></div>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="sorta2">
		<div class="bochonki_top_line"></div>
		<ul>
			<li><img class="vid" src="images/banochki/1.png"><div class="hidden"><img src="images/banochki/1_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/2.png"><div class="hidden"><img src="images/banochki/2_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/3.png"><div class="hidden"><img src="images/banochki/3_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/4.png"><div class="hidden"><img src="images/banochki/4_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/5.png"><div class="hidden"><img src="images/banochki/5_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/6.png"><div class="hidden"><img src="images/banochki/6_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/7.png"><div class="hidden"><img src="images/banochki/7_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/8.png"><div class="hidden"><img src="images/banochki/8_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/9.png"><div class="hidden"><img src="images/banochki/9_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/10.png"><div class="hidden"><img src="images/banochki/10_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/11.png"><div class="hidden"><img src="images/banochki/11_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/12.png"><div class="hidden"><img src="images/banochki/12_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/13.png"><div class="hidden"><img src="images/banochki/13_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/14.png"><div class="hidden"><img src="images/banochki/14_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/15.png"><div class="hidden"><img src="images/banochki/15_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/16.png"><div class="hidden"><img src="images/banochki/16_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/17.png"><div class="hidden"><img src="images/banochki/17_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/18.png"><div class="hidden"><img src="images/banochki/18_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/19.png"><div class="hidden"><img src="images/banochki/19_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/20.png"><div class="hidden"><img src="images/banochki/20_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/21.png"><div class="hidden"><img src="images/banochki/21_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/22.png"><div class="hidden"><img src="images/banochki/22_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/23.png"><div class="hidden"><img src="images/banochki/23_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/24.png"><div class="hidden"><img src="images/banochki/24_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/25.png"><div class="hidden"><img src="images/banochki/25_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/26.png"><div class="hidden"><img src="images/banochki/26_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/27.png"><div class="hidden"><img src="images/banochki/27_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/28.png"><div class="hidden"><img src="images/banochki/28_hover.png"></div></li>
			<li><img class="vid" src="images/banochki/29.png"><div class="hidden"><img src="images/banochki/29_hover.png"></div></li>
			<div class="clear"></div>
		</ul>
		<div class="clear"></div>
		<div id="onas" class="onas">
			<div class="bochonki_top_line"></div>
			<div class="pchela4"></div>
			<h1>О нас</h1>
			<h2>Наше производство</h2>
			<div class="onas_uzor"></div>
			<div class="onas_left">
				<img src="images/onas_left.jpg">
			</div>
			<div class="onas_right">
				<img src="images/onas_right.jpg">
			</div>
			<div class="clear"></div>
		</div>
		<div class="chto">
			<h2>Что формирует качество нашего мёда</h2>
			<div class="onas_uzor"></div>
			<div class="chto_images">
				<div class="chto_image">
					<img src="images/chto1.jpg">
					<p>Отбор мёда производится<br>пчеловодом в третьем поколении,<br>традиции качества с 1943г</p>
				</div>
				<div class="chto_image chto_image2">
					<img src="images/chto2.jpg">
					<p>200 пчелдоводов - поставщиков<br>мёда со всей России и Зарубежья</p>
				</div>
				<div class="chto_image chto_image2">
					<img src="images/chto3.jpg">
					<p>Качество мёда выше ГОСТа:<br>влажность мёда до 18,5%</p>
				</div>
				<div class="chto_image chto_image2">
					<img src="images/chto4.jpg">
					<p>Весь мёд проходит исследования<br>в аккредитованной лаборатории</p>
				</div>		
				<div class="clear"></div>										
			</div>
		</div>
		<div class="clear"></div>
		<div class="postavshiki">
			<h2>Наши поставщики</h2>
			<div class="onas_uzor"></div>
			<div class="postavshiki1">
				<div class="post1">
					<img src="images/post1.jpg">
					<p><strong>Александр и Николай Смирновы</strong><br>Стаж пчеловодства - 32 года.<br><br>Смоленская область</p>
				</div>
				<div class="post2">
					<img src="images/post2.jpg">
					<p><strong>Владимир Малахов</strong><br>Стаж пчеловодства - 20 лет.<br><br>Ростовская область</p>
				</div>
				<div class="post3">
					<img src="images/post3.jpg">
					<p><strong>Александр Пивунов</strong><br>Стаж пчеловодства - 26 лет.<br><br>Белгородская область</p>
				</div>
				<div class="clear"></div>
			</div>
			<div class="postavshiki2">
				<div class="post4">
					<img src="images/post4.jpg">
					<p><strong>Пётр Мареев</strong>, на пасеке с 7ми лет<br>Стаж пчеловодства 54 года.<br><strong>Андрей Мареев,</strong> стаж 26 лет.<br><br>Саратовская область,<br>Хоперский заповедник</p>
				</div>
				<div class="post5">
					<img src="images/post5.jpg">
					<p><strong>Лев Поляков</strong><br>Стаж пчеловодства - 21 год.<br><br>Воронежская область</p>
				</div>
				<div class="clear"></div>
			</div>
		</div>
		<div class="tradicii">
			<h2>Традиции качества с 1943 г.</h2>
			<div class="onas_uzor"></div>
			<div class="trad_left">
				<img src="images/trad_img.jpg">
			</div>
			<div class="trad_right">
				<p>В 1943 году мой дед Иван получил серьезное осколочное ранение в ногу и лёгкое и был демобилизован. Вернувшись на родину, он стал работать в лесхозе пасечником. Дед так увлекся пчеловодством, что увеличил количество ульев в лесхозе с 15 до 180 за пару лет и управлялся с ними в течение 35 лет самостоятельно, с единственным помощником. Мед с пасеки направляли на фронт и в госпитали.</p><br>
				<p>После ухода деда на пенсию на лесхозной пасеке буквально за пару лет из-за прикорма пчел сахаром новым пасечником пчелы начали болеть, пасека развалилась.</p><br>
				<p>Я, как и мой отец Петр, свое детство провел на пасеке и впоследствии перенял дело своего деда, никогда не кормил пчел сахаром.</p><br>
				<p>Сейчас на нашей семейной пасеке 100 пчелосемей, которые дают около 5 тонн меда в сезон.</p><br>
				<p>Традиции качества нашего меда берут свое начало в далеком военном 1943 году, когда мой дед по воле судьбы стал пасечником.</p><br><br>
				<p class="right">С заботой о вас,</p> <p class="right_big">Андрей <strong>Мареев</strong></p>
			</div>
			<div class="clear"></div>
			<div class="blago">
				<h2>Благотворительность</h2>
				<div class="onas_uzor"></div>
				<div class="cert1"></div>
				<div class="cert2"></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<div class="contacts">
		<div class="bochonki_top_line"></div>
		<div class="map2"><script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=Mw_yC07GURsBmaCEtGO25mg9QvwK_KlV&amp;width=100%&amp;height=100%&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true"></script></div>
		<div class="cont_right">
			<h2>Контакты</h2>
			<div class="onas_uzor"></div>
			<h1>"Amhani"</h1>
			<p>Понедельник - пятница<br><br><br><strong>С 9.00 до 18.00</strong></p><br>
			<p>141014 г. Мытищи, ул. Веры<br>Волошиной д.19/16, офис 202</p><br><br>
			<p>E-MAIL:<br><strong>Amhani@yandex.ru</strong></p><br><br>
			<p>+7 (499) 372-05-11</p>
			<p>8 (800) 100-07-38</p><br><br>
			<a id="c_a">Скачать прайс</a>
		</div>
		<div class="clear"></div>
	</div>
	<div class="footer">
		<a href="politica.php">Политика конфиденциальности</a>
		<p>ООО "А-качество"</p>
	</div>
	<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = '1oJWxmNDqG';var d=document;var w=window;function l(){
var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true; s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();</script>
<!-- {/literal} END JIVOSITE CODE -->
</body>
</html>