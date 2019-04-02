@title('退休規劃評估' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
	<form style="width:50%;">
		<fieldset>
			<h3>退休規劃評估</h3>
			<h5>(請填入年份、現金、資產)</h5>
			<p>
				<label>
					預估幾年後退休
				</label>
				<input type="text" name="number" min="1" maxlength="10"/> 
				<span>年</span> 
				<h4 id="msgA"></h4>
			</p>
			<p>	
				<label>
					擁有多少可投資的現金
				</label>
				<input type="text" name="number" min="0" maxlength="10"/>
				<span>元</span> 
				<h4 id="msgA"></h4> 
			</p>
			<p>
				<label>
					需要多少資產才能安穩退休
				</label>
				<input type="text" name="number" min="0" maxlength="10" /> 
				<span>元</span>  
				<h4 id="msgA"></h4>
			</p>
			
			<p>
				<button type="button" class="cal" id="check">評估</button>
				<button type="button" id="clear">清除</button>
			</p>
			<p class="resultAll">
				你的投資工具必須每年能帶來
				<input type="text" min="0" class="rate" id="result"></input>
				<span class="word">報酬率</span>
			</p>
				
					
		</fieldset>
	</form>
</div>
	<script type="text/javascript">
		let numberAll = document.getElementsByName('number');
		let msgAll = document.getElementsByTagName('h4');
		let resAll = document.getElementById('result');

        window.onload=function () {
			let valueAll = new calReRate(numberAll,msgAll,resAll);
			valueAll.rateCal();
			valueAll.clearAll();
		}
	</script>
@endsection