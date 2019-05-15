@title('買賣股票損益計算機' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
	<form class="col-sm-12" id="form">
		<fieldset>
			<h3>買賣股票損益計算機</h3>
			<h5>(請填入成交價、成交股數、手續費折扣)</h5>
			<p>
				<label>
					買進/賣出成交價
				</label>
				<input type="text" class="inputText" name="value" min="1" maxlength="10"  placeholder="元"/>
				<h4 id="msgA"></h4> 
			</p>
			<p>	
				<label>
					成交股數 
					<span class="small">(註: 1張=1,000股)</span>
				</label>
				<input type="text" class="inputText" name="value" min="1" maxlength="10" placeholder="％"/>
				<h4 id="msgA"></h4>  
			</p>
			<p>
				<label>
					電子下單券商手續費打幾折
				</label>
				<input type="text" class="inputText" name="value" min="1" maxlength="10" placeholder="折"/>
				<h4 id="msgA"></h4>   
			</p>
			
			<div style="text-align: center;">
				<button type="button" class="cancel" id="clear">清除</button>
				<button type="button" class="btn" id="calMoney">計算</button>
			</div>
			<p>
				<table id="tableRes" class="table">
				</table>
			</p>			
		</fieldset>
	</form>
</div>
	<script>
		let numberAll = document.getElementsByName('value');
		let msgAll = document.getElementsByTagName('h4');
		let resAll = document.getElementById('tableRes');
        window.onload=function () {
			let valueAll = new calReRate(numberAll, msgAll, resAll);
			valueAll.feeCal();
			valueAll.clearAll();
	  	};
	</script>

@endsection