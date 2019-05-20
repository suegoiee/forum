@title('市占率預估' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
	<form class="col-sm-12" id="form">
		<fieldset>
			<h3>市占率預估</h3>
			<h5>(請填入年營收、產值、年成長率、5年和10年預估值)</h5>
			<p>
				<label>
					目前公司年營收＝
				</label>
				<input type="text" class="inputText" name="value" min="1" maxlength="10" placeholder="億元"/>
				<h6 id="msgA"></h6> 
			</p>
			<p>	
				<label>
					公司所處的產業整體產值＝
				</label>
				<input type="text" class="inputText" name="value" min="1" maxlength="10" placeholder="億元"/>
				<h6 id="msgA"></h6>  
			</p>
			<p>
				<label>
					該產業的年成長率
				</label>
				<input type="text" class="inputText" name="value" min="1" maxlength="10" placeholder="％"/>
				<h6 id="msgA"></h6>   
			</p>
			<p>
				<label>
					請預估：<br/>5年後公司市佔率會是多少
				</label>
				<input type="text" class="inputText" name="value" min="1" maxlength="10" placeholder="％"/>
				<h6 id="msgA"></h6>   
			</p>
			<p>
				<label>
					請預估：<br/>10年後公司市佔率會是多少
				</label>
				<input type="text" class="inputText" name="value" min="1" maxlength="10" placeholder="％"/>
				<h6 id="msgA"></h6>   
			</p>
			
			<div style="text-align: center; margin-bottom: 15px;">
				<button type="button" class="cancel" id="clear">清除</button>
				<button type="button" class="btn" id="calEst">計算</button>
			</div>
			
			<p>
				<table id="calMon" class="table">
				</table>
			</p>
				
		</fieldset>
	</form>
</div>

	<script type="text/javascript">
		let numberAll = document.getElementsByName('value');
		let msgAll = document.getElementsByTagName('h6');
		let resAll = document.getElementById('calMon');
		
		window.onload = function () {
			let valueAll = new calReRate(numberAll, msgAll, resAll);
			valueAll.estCal();
			valueAll.clearAll();
    	}
	</script>
@endsection