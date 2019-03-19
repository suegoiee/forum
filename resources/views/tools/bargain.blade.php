@title('Stocksummary' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
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
				<h4></h4> 
			</p>
			<p>	
				<label>
					成交股數 
					<font class="small">(註: 1張=1,000股)</font>
				</label>
				<input type="text" min="0" maxlength="10"/>
				<span>%</span>
				<h4></h4>  
			</p>
			<p>
				<label>
					電子下單券商手續費打幾折
				</label>
				<input type="text" min="0" maxlength="10"/> 
				<span>折</span>
				<h4></h4>   
			</p>
			
			<p>
				<button type="button" class="cal" id="calMoney">計算</button>
				<button type="button" id="clear">清除</button>
			</p>
			<p>
				<div class="resultAll">買進：</div>
				<table>					 
					<tr>
						<td>買進時，券商手續費</td>
						<td class="feeAll inpor"></td>
					</tr>
					<tr>
						<td>買進這檔股票，您需要準備</td>
						<td class="feeAll inpor"></td>
					</tr>
				</table>

			</p>
			<p>
				<div class="resultAll">賣出：</div>
				<table>
					<tr>
						<td>賣出時，需要券商手續費</td>
						<td class="feeAll inpor"></td>
					</tr>
					<tr>
						<td>賣出時，需要證交稅</td>
						<td class="feeAll inpor"></td>
					</tr>
					<tr>
						<td>賣出這檔股票，您共可拿回</td>
						<td class="feeAll inpor"></td>
					</tr>
				</table>
			</p>
				
		</fieldset>
	</form>

	<script type="text/javascript">
		let numberAll = document.getElementsByTagName('input');
		let msgAll = document.getElementsByTagName('h4');
		let moneyAll = document.getElementsByClassName('feeAll');
		let valueAll = new calFee(numberAll,msgAll,moneyAll);
		valueAll.feeCal();
		valueAll.clearAll();
	</script>

@endsection