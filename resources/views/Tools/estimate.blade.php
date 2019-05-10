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
				<input type="text" name="value" min="1" maxlength="10" /> 
				<span>億元</span>
				<h4 id="msgA"></h4> 
			</p>
			<p>	
				<label>
					公司所處的產業整體產值＝
				</label>
				<input type="text" name="value" min="1" maxlength="10"/>
				<span>億元</span>
				<h4 id="msgA"></h4>  
			</p>
			<p>
				<label>
					該產業的年成長率
				</label>
				<input type="text" name="value" min="1" maxlength="10"/> 
				<span>％</span>
				<h4 id="msgA"></h4>   
			</p>
			<p>
				<label>
					請預估：<br/>5年後公司市佔率會是多少
				</label>
				<input type="text" name="value" min="1" maxlength="10"/> 
				<span>％</span>
				<h4 id="msgA"></h4>   
			</p>
			<p>
				<label>
					請預估：<br/>10年後公司市佔率會是多少
				</label>
				<input type="text" name="value" min="1" maxlength="10"/> 
				<span>％</span>
				<h4></h4>   
			</p>
			
			<p>
				<button type="button" class="cal" id="calEst">計算</button>
				<button type="button" id="clear">清除</button>
			</p>
			
			<p>
				<table id="tableRes">
				</table>
			</p>
				
		</fieldset>
	</form>
</div>

	<script type="text/javascript">
		let numberAll = document.getElementsByName('value');
		let msgAll = document.getElementsByTagName('h4');
		let moneyAll = document.getElementById('tableRes');
		
		window.onload=function () {
			let valueAll = new calFee(numberAll,msgAll,moneyAll);
			valueAll.estCal();
			valueAll.clearAll();
    	}
	</script>
@endsection