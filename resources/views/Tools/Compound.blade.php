@title('年複合成長率計算機' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
	<form class="col-sm-12" id="form">
		<fieldset>
			<h3>年複合成長率計算機</h3>
			<h5>(請填入年份、期初數值、期未數值)</h5>
			<p>
				<label>
					計算幾年的年複合成長率(CAGR)
				</label>
				<input type="text" class="inputText" name="number" min="1" maxlength="10" placeholder="年"/>
				<h4 id="msgA"></h4>
			</p>
			<p>	
				<label>
					期初數值
				</label>
				<input type="text" class="inputText" name="number" min="0" maxlength="10"/>
				<h4 id="msgA"></h4>  
			</p>
			<p>
				<label>
					期未數值
				</label>
				<input type="text" class="inputText" name="number" min="0" maxlength="10" />
				<h4 id="msgA"></h4> 
			</p>
			
			<div style="text-align: center;">
				<button type="button" class="cancel" id="clear">清除</button>
				<button type="button" class="btn" id="check">計算</button>
			</div>
			<p>	
				<table id="result" class="table">
                </table>
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
		valueAll.comCal();
		valueAll.clearAll();
		}
	</script>
@endsection