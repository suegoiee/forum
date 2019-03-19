<!DOCTYPE html>
<html lang="zh-Hant-TW">
<head>
	<meta charset="UTF-8">
	<title>年複合成長率</title>
	<link rel="stylesheet" type="text/css" href="css/styleAll.css">
	<script src="js/errorode.js"></script>
	<script src="js/cal.js"></script>
	
</head>
<body>
	<form>
		<fieldset>
			<h3>年複合成長率計算機</h3>
			<h5>(請填入年份、期初數值、期未數值)</h5>
			<p>
				<label>
					計算幾年的年複合成長率(CAGR)
				</label>
				<input type="text" name="number" min="1" maxlength="10" /> 
				<span>年</span> 
				<h4></h4>
			</p>
			<p>	
				<label>
					期初數值
				</label>
				<input type="text" name="number" min="0" maxlength="10" />
				<h4></h4>  
			</p>
			<p>
				<label>
					期未數值
				</label>
				<input type="text" name="number" min="0" maxlength="10" />
				<h4></h4> 
			</p>
			
			<p>
				<button type="button" class="cal" id="check">計算</button>
				<button type="button" id="clear">清除</button>
			</p>
			<p class="resultAll">	
				年複合成長率
				<input type="text" class="rate" id="result"></input>
			</p>
		</fieldset>
	</form>

	<script type="text/javascript">
		let numberAll = document.getElementsByName('number');
		let msgAll = document.getElementsByTagName('h4');
		let resAll = document.getElementById('result');
		
		let valueAll = new calReRate(numberAll,msgAll,resAll);
		valueAll.rateCal();
		valueAll.clearAll();
	</script>
	

</body>
</html>