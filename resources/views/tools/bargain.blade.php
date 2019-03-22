@title('買賣股票損益計算機' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
	<form>
		<fieldset>
			<h3>買賣股票損益計算機</h3>
			<h5>(請填入成交價、成交股數、手續費折扣)</h5>
			<p>
				<label>
					買進/賣出成交價
				</label>
				<input type="text" min="1" maxlength="10" /> 
				<span>元</span>
				<h4 id="msgA"></h4> 
			</p>
			<p>	
				<label>
					成交股數 
					<font class="small">(註: 1張=1,000股)</font>
				</label>
				<input type="text" min="0" maxlength="10"/>
				<span>%</span>
				<h4 id="msgA"></h4>  
			</p>
			<p>
				<label>
					電子下單券商手續費打幾折
				</label>
				<input type="text" min="0" maxlength="10"/> 
				<span>折</span>
				<h4 id="msgA"></h4>   
			</p>
			
			<p>
				<button type="button" class="cal" id="calMoney">計算</button>
				<button type="button" id="clear">清除</button>
			</p>
			<p>
				<table id="tableRes">
				</table>
			</p>
				
		</fieldset>
	</form>
</div>
	<script>
		let numberAll = document.getElementsByTagName('input');
		let msgAll = document.getElementsByTagName('h4');
		let moneyAll = document.getElementById('tableRes');
        window.onload=function () {
			let valueAll = new calFee(numberAll,msgAll,moneyAll);
			valueAll.feeCal();
			valueAll.clearAll();
	  	};
	</script>

@endsection