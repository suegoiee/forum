@title('揪團買股' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
	<form style="width: 33%;">
		<fieldset>
			<h3>揪團買股</h3>
			<h5>(請填入姓名、金額、股票代號、買進和賣出金額)</h5>
			<p id="question">
			</p>
			<p>
				<input type="button" id="add" value="新增揪團名單" />
			</p>
			<p>	
				<label class="too">
					揪團買進哪一支股票
				</label>
				<input type="text" name="price" min="0" maxlength="10"/>
				<h4></h4>  
			</p>
			<p>
				<label class="too">
					請輸入：買進成本價(扣除所有費用後)
				</label>
				<input type="text" name="price" min="0" maxlength="10"/> 
				<span>元</span>
				<h4></h4>   
			</p>
			<p>
				<label class="too">
					請輸入：賣出總金額(扣除所有費用後)
				</label>
				<input type="text" name="price" min="0" maxlength="10"/> 
				<span>元</span>
				<h4></h4>   
			</p>
			
			<p>
				<input type="button" class="cal" id="calAll" value="計算" />
				<button type="button" id="clear">清除</button>
			</p>

			<p>
				<table id="stockAll">
					<label class="resultAll">每個人的股份：</label> 
				</table>
			</p>
			
			<p>
				<table id="getAll">	
					<label class="resultAll">每個人的獲利：</label> 		
				</table>
			</p>
			
			<p>
				<table id="getMoney">	
					<label class="resultAll">每個人可得到：</label> 	
				</table>
			</p>

			<p id="print"></p>
		</fieldset>
	</form>
</div>
	<script type="text/javascript">
		let questionAll = document.getElementById("question");
		let nameAll = document.getElementsByName("name");
		let moneyAll = document.getElementsByName('money');
		let numberAll = document.getElementsByName('price');
		let msgAll = document.getElementsByTagName('h4');
		let inputTdA = document.getElementById("stockAll");
		let inputTdB = document.getElementById("getAll");
		let inputTdC = document.getElementById("getMoney");
		let printAll = document.getElementById('print');	

        window.onload=function () {
			let valueAll = new togeStock(numberAll,msgAll,questionAll,nameAll,moneyAll,inputTdA,inputTdB,inputTdC,printAll);
			valueAll.addInput();
			valueAll.calStock();
			valueAll.clearEvery();
		}
	</script>
@endsection