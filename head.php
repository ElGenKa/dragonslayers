<head>
	
	<title>Dragonslayers</title>
	<meta charset="UTF-8">
	<?PHP $rnd = rand(0,30000); ?>
	<link rel=stylesheet href="css/css.css?ver=<?PHP echo $rnd; ?>">

	<link rel="stylesheet" type="text/css" href="css/component.css?ver=<?PHP echo $rnd; ?>" />
	
	<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
	<script language='JavaScript'>
		function animnumber(numend, idobj){
			currentNumber = $(idobj).text();
			$({numberValue: currentNumber}).animate({numberValue: numend}, {
				duration: 2500,
				easing: 'linear',
				step: function() { 
					$(idobj).text(Math.ceil(this.numberValue)); 
				}
			});
			setTimeout( function (idobj,numend){ $(idobj).text(Math.ceil(numend));  }, 3300 );
		}
		var selid = 0;
		//var seldragon = 0;
		var dragon1 = -1;
		var dragon2 = -1;
		var dragon3 = -1;
		function selectdragons(sel){
			selid = sel;
			$("#mydragons").css("left","calc(50% - 400px)");
		}
		
		function selectdragon(seldragon,imgsrc,dragonname){
			//dragon_pic_
			//dragon_name_
			if(seldragon != dragon1 && seldragon != dragon2 && seldragon != dragon3){			
				if (selid == 0) {
					dragon1 = seldragon;
					$("#hdragon1").attr('value',seldragon);
				}
				if (selid == 1) {
					dragon2 = seldragon;
					$("#hdragon2").attr('value',seldragon);
				}
				if (selid == 2) {
					dragon3 = seldragon;
					$("#hdragon3").attr('value',seldragon);
				}
				$("#dragon_pic_"+selid).attr('src',imgsrc);
				$("#dragon_name_"+selid).html(dragonname);
			}
			$("#mydragons").css("left","-8000");
			
		}
	</script>
	
	
	
</head>