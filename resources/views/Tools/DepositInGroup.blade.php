@title('揪團買股' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
	<form class="col-sm-12" style="display: block;" id="form">
		<fieldset>
			<h3 style="margin-top: 0;">揪團買股</h3>
			<h5>(請填入姓名、金額、股票代號、買進和賣出金額)</h5>
			<p id="question">
			</p>
			<p>
				<button type="button" id="add">新增揪團名單</button>
			</p>
			<p>	
				<label class="too">
					揪團買進哪一支股票
				</label>
				<input type="text" name="price" min="0" maxlength="10"/>
				<h4 id="msgA"></h4>  
			</p>
			<p>
				<label class="too">
					請輸入：買進成本價<br/>(扣除所有費用後)
				</label>
				<input type="text" name="price" min="0" maxlength="10"/> 
				<span>元</span>
				<h4 id="msgA"></h4>   
			</p>
			<p>
				<label class="too">
					請輸入：賣出總金額<br/>(扣除所有費用後)
				</label>
				<input type="text" name="price" min="0" maxlength="10"/> 
				<span>元</span>
				<h4 id="msgA"></h4>   
			</p>
			
			<p>
				<button type="button" class="cal" id="calAll">計算</button>
				<button type="button" id="clear">清除</button>
			</p>
		</fieldset>
	</form>
	<form id="formStyle" style="display:none; float:right; width: 50%; margin-bottom: 1%;">
        <fieldset>
            <table id="stockAll">
            </table>
			<table id="getAll">			
			</table>
			<table id="getMoney">		
			</table>
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
		let form = document.getElementById("formStyle");	

        window.onload=function () {
			let valueAll = new togeStock(numberAll,msgAll,questionAll,nameAll,moneyAll,inputTdA,inputTdB,inputTdC,printAll,form);
			valueAll.addInput();
			valueAll.calStock();
			valueAll.clearEvery();
		}
	</script>
@endsection