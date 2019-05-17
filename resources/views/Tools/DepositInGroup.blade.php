@title('揪團買股' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
	<form class="col-sm-12" style="display: block;" id="form">
		<fieldset>
			<h3>揪團買股</h3>
			<h5>(請填入姓名、金額、股票代號、買進和賣出金額)</h5>
			<p id="question">
			</p>
			<p>
				<button type="button" class="btn" id="add">新增揪團名單</button>
			</p>
			<p>	
				<label class="too">
					揪團買進哪一支股票
				</label>
				<input type="text" class="inputText" name="price" min="0" maxlength="10"/>
				<h6 id="msgA"></h6>  
			</p>
			<p>
				<label class="too">
					請輸入：買進成本價<br/>(扣除所有費用後)
				</label>
				<input type="text" class="inputText" name="price" min="0" maxlength="10" placeholder="元"/>
				<h6 id="msgA"></h6>   
			</p>
			<p>
				<label class="too">
					請輸入：賣出總金額<br/>(扣除所有費用後)
				</label>
				<input type="text" class="inputText" name="price" min="0" maxlength="10" placeholder="元"/>
				<h6 id="msgA"></h6>   
			</p>
			
			<div style="text-align: center; margin-bottom: 15px;">
				<button type="button" class="cancel" id="clear">清除</button>
				<button type="button" class="btn" id="calAll">計算</button>
			</div>
		</fieldset>
	</form>
	<form id="formStyle" style="display:none; float:right; width: 50%; margin-bottom: 1%;">
        <fieldset>
			<label style="margin: 30px 30px 0;">每個人的股份</label>
            <table id="stockAll" class="table">
            </table>
			<label style="margin: 30px 30px 0;">每個人的獲利</label>
			<table id="getAll" class="table">			
			</table>
			<label style="margin: 30px 30px 0;">每個人可得到</label>
			<table id="getMoney" class="table">		
			</table>
        </fieldset>
    </form>
</div>
	<script type="text/javascript">
		let questionAll = document.getElementById("question");
		let nameAll = document.getElementsByName("name");
		let moneyAll = document.getElementsByName('money');
		let numberAll = document.getElementsByName('price');
		let msgAll = document.getElementsByTagName('h6');
		let msgB = document.getElementsByTagName('h4');
		let inputTdA = document.getElementById("stockAll");
		let inputTdB = document.getElementById("getAll");
		let inputTdC = document.getElementById("getMoney");
		let form = document.getElementById("formStyle");	

        window.onload=function () {
			let valueAll = new togeStock(numberAll,msgAll,msgB,questionAll,nameAll,moneyAll,inputTdA,inputTdB,inputTdC,form);
			valueAll.addInput();
			valueAll.calStock();
			valueAll.clearEvery();
		}
	</script>
@endsection