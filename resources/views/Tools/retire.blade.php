@title('退休規劃評估' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
	<form class="col-sm-12" id="form">
		<fieldset>
			<h3>退休規劃評估</h3>
			<h5>(請填入年份、現金、資產)</h5>
			<p>
				<label>
					預估幾年後退休
				</label>
				<input type="text" class="inputText" name="number" min="1" maxlength="10"　placeholder="年"/>
				<h6 id="msgA"></h6>
			</p>
			<p>	
				<label>
					擁有多少可投資的現金
				</label>
				<input type="text" class="inputText" name="number" min="0" maxlength="10"　placeholder="元"/>
				<h6 id="msgA"></h6> 
			</p>
			<p>
				<label>
					需要多少資產才能安穩退休
				</label>
				<input type="text" class="inputText" name="number" min="0" maxlength="10" placeholder="元"/>
				<h6 id="msgA"></h6>
			</p>
			
			<div style="text-align: center; margin-bottom: 15px;">
				<button type="button" class="cancel" id="clear">清除</button>
				<button type="button" class="btn" id="check">評估</button>
			</div>
			<p>
				<table id="calMon" class="table"></table>
			</p>
						
		</fieldset>
	</form>
</div>
	<script type="text/javascript">
		let numberAll = document.getElementsByName('number');
		let msgAll = document.getElementsByTagName('h4');
		let resAll = document.getElementById('calMon');

        window.onload=function () {
			let valueAll = new calReRate(numberAll,msgAll,resAll);
			valueAll.rateCal();
			valueAll.clearAll();
		}
	</script>
@endsection