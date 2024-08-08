$(document).ready(function(){
	var dw = $(document).width();
	var bocw = $(".bochonki_items_block ul").width();
	var bocitw = $(".bochonki_items_block ul li").width();
	var blockw = $(".bochonki_items_block").width();
	var bocl=0;
	var boch_index = 0;
	var x = document.getElementById("audio0");

	function playAudio() {
	  x.play();
	}

	function pauseAudio() {
	  x.pause();
	}

	$(".playMusic").click(function(){
		playAudio();
	})

	$(".playMusic").trigger('click');

	$("input").keyup(function() { $(this).css("background","#f3f2f2"); });
	if(dw>=1280){
		$(".top_menu a").eq(0).mouseover(function(){
			$(".top_menu_strelka").animate({"left":"84px"},300);
		});	
		$(".top_menu a").eq(1).mouseover(function(){
			$(".top_menu_strelka").animate({"left":"335px"},300);
		});
		$(".top_menu a").eq(2).mouseover(function(){
			$(".top_menu_strelka").animate({"left":"570px"},300);
		});	
		$(".top_menu a").eq(3).mouseover(function(){
			$(".top_menu_strelka").animate({"left":"747px"},300);
		});	
		$(".top_menu a").eq(4).mouseover(function(){
			$(".top_menu_strelka").animate({"left":"912px"},300);
		});			
		$(".top_menu").mouseleave(function(){
			$(".top_menu_strelka").animate({"left":"84px"},300);
		});		
	};
	$('a[href^="#"]').click(function () { 
	     elementClick = $(this).attr("href");
	     destination = $(elementClick).offset().top;
	       $('html,body').animate( { scrollTop: destination }, 1100 );
	     return false;
   });
	$(".bochonki_right").click(function(){
		if(blockw-bocl<bocw-bocitw){
			bocl=bocl-bocitw-4;
			$(".bochonki_items_block ul").animate({"margin-left":bocl},300);			
		}
		else if(blockw-bocl<bocw){
			bocl=blockw-bocw;
			$(".bochonki_items_block ul").animate({"margin-left":bocl},300);			
		};		
	});
	$(".bochonki_left").click(function(){
		if(bocl<0-bocitw){
			bocl=bocl+bocitw+4;
			$(".bochonki_items_block ul").animate({"margin-left":bocl},300);
		}
		else if(bocl<0){
			bocl=0;
			$(".bochonki_items_block ul").animate({"margin-left":bocl},300);			
		}
	});
	$(".bochonki_items_block ul li").mouseover(function(e){
		$(this).children(".mini_boch_bg1").stop().fadeIn(300);
	});
	$(".bochonki_items_block ul li").mouseleave(function(){
		$(this).children(".mini_boch_bg1").stop().fadeOut(300);
	});	
	$(".bochenki_popup_href").click(function(){
		$("#modal #form1").css("display","none");
		$("#modal #form2").css("display","block");
		$(".modal_thanks").css("display","none");
		$("#modal").fadeIn(300);		
	});
	$(".bochonki_items_block ul li").click(function(){
		var boch_index = $( ".bochonki_items_block ul li" ).index( this );
		$(".popimg").fadeOut(300);
		$(".bochonki_items_popup").fadeIn(300);
		$("#boch_popup").fadeIn(300);
		$(".hidden_input").val(boch_art[boch_index]);
		if(boch_img[boch_index]!=undefined&&boch_img[boch_index]!=''){$(".bochonki_ramka").html('<img src='+boch_img[boch_index]+'>');}
			else{$(".bochonki_ramka").html('<img src=images/bochonki_popup_img.jpg>');}
		$(".bochonki_table").html(boch_table[boch_index]);
		$(".bochonki_art span").html(boch_art[boch_index]);
	});
	$(".sorta2 ul li").mouseover(function(){
		$(this).children(".vid").stop().fadeOut(300);
		$(this).children(".hidden").stop().fadeIn(300);
		$(this).rotate({animateTo:3});
	});
	$(".sorta2 ul li").mouseleave(function(){
		$(this).children(".vid").stop().fadeIn(300);
		$(this).children(".hidden").stop().fadeOut(300);
		$(this).rotate({animateTo:0});
	});	
	$(".sorta2 ul li").click(function(){
		var img_index = $( ".sorta2 ul li" ).index( this );
		$(".popimg").fadeOut(300);
		$(".popimg").eq(img_index).fadeIn(300);
		$(this).children(".vid").stop().fadeIn(300);
		$(this).children(".hidden").stop().fadeOut(300);
		$(this).rotate({animateTo:0});
		$("#boch_popup").fadeIn(300);		
	});
	$(".boch_zakr").click(function(){
		$(".bochonki_items_popup").fadeOut(300);
		$("#boch_popup").fadeOut(300);
	});
	$("#boch_popup").click(function(){
		$(".bochonki_items_popup").fadeOut(300);
		$("#boch_popup").fadeOut(300);
	});	
	$("#form1-1").submit(function() { //Change
		//window.location = 'http://am-present.ru/PRAJS_Podarki_Amhani_01_12_2016.xls';
		location.replace('http://am-present.ru/PRAJS_Podarki_Amhani_01_12_2016.xls');
		if(document.getElementById("name1").value==""){ $("#name1").css("background","yellow"); return false;}
		else if(document.getElementById("phone1").value==""){ $("#phone1").css("background","yellow"); return false;}
		else if(document.getElementById("mail1").value==""){ $("#mail1").css("background","yellow"); return false;}
		else{
			var th = $(this);
			$.ajax({
				type: "POST",
				url: "send.php", //Change
				data: th.serialize()
			}).done(function() {
				$("#modal .form").css("display","none");
				$(".modal_thanks").css("display","block");
				$("#modal").fadeIn(300);		
				setTimeout(function() {
					$("#modal").fadeOut();
					th.trigger("reset");
				}, 5000);
			});
			return false;
		}
	});	
	$("#form2-1").submit(function() { //Change
		//window.location = 'http://am-present.ru/price-list.xlsm';
		location.replace('http://am-present.ru/PRAJS_Podarki_Amhani_01_12_2016.xls');
		if(document.getElementById("name2").value==""){ $("#name2").css("background","yellow"); return false;}
		else if(document.getElementById("phone2").value==""){ $("#phone2").css("background","yellow"); return false;}
		else if(document.getElementById("mail2").value==""){ $("#mail2").css("background","yellow"); return false;}
		else{
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "send.php", //Change
			data: th.serialize()
		}).done(function() {
			$("#modal .form").css("display","none");
			$(".modal_thanks").css("display","block");
			$("#modal").fadeIn(300);		
			setTimeout(function() {
				$("#modal").fadeOut();
				th.trigger("reset");
			}, 5000);
		});
		return false;
	}
	});	
	$("#form3").submit(function() { //Change
		//window.location = 'http://am-present.ru/price-list.xlsm';
		location.replace('http://am-present.ru/PRAJS_Podarki_Amhani_01_12_2016.xls');
		if(document.getElementById("name3").value==""){ $("#name3").css("background","yellow"); return false;}
		else if(document.getElementById("phone3").value==""){ $("#phone3").css("background","yellow"); return false;}
		else if(document.getElementById("mail3").value==""){ $("#mail3").css("background","yellow"); return false;}
		else{
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "send.php", //Change
			data: th.serialize()
		}).done(function() {
			$("#modal .form").css("display","none");
			$(".modal_thanks").css("display","block");
			$("#modal").fadeIn(300);		
			setTimeout(function() {
				$("#modal").fadeOut();
				th.trigger("reset");
			}, 5000);
		});
		return false;
		};
	});	
	$("#form4").submit(function() { //Change
		location.replace('http://am-present.ru/PRAJS_Podarki_Amhani_01_12_2016.xls');
		//window.location = 'http://am-present.ru/price-list.xlsm';
		if(document.getElementById("name4").value==""){ $("#name4").css("background","yellow"); return false;}
		else if(document.getElementById("phone4").value==""){ $("#phone4").css("background","yellow"); return false;}
		else if(document.getElementById("mail4").value==""){ $("#mail4").css("background","yellow"); return false;}
		else{
		var th = $(this);
		$.ajax({
			type: "POST",
			url: "send.php", //Change
			data: th.serialize()
		}).done(function() {
			$("#modal .form").css("display","none");
			$(".modal_thanks").css("display","block");
			$("#modal").fadeIn(300);		
			setTimeout(function() {
				$("#modal").fadeOut();
				th.trigger("reset");
			}, 5000);
		});
		return false;
	}
	});	
	$("#c_a").click(function(){
		$("#modal #form1").css("display","block");
		$("#modal #form2").css("display","none");
		$(".modal_thanks").css("display","none");
		$("#modal").fadeIn(300);
	});
	$("#price_poluch").click(function(){
		$("#modal #form1").css("display","block");
		$("#modal #form2").css("display","none");
		$(".modal_thanks").css("display","none");
		$("#modal").fadeIn(300);
	});	
	$(".zakr").click(function(){
		$("#modal").fadeOut(300);
	});
})