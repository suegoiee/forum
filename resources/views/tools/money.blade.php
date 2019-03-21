@title('除權息參考價計算機' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
    <form>
        <fieldset>
            <h3>除權息參考價計算機</h3>
            <h5>(請填入除權除息前股價、現金股利、股票股利)</h5>
            <p>
                <label>
                    除權除息前股價
                    <font class="red">(必填)</font>
                </label>
                <input type="text" name="number" min="1" maxlength="10" />
                <span>元</span>
                <h4></h4>
            </p>
            <p>
                <label>
                    現金股利(選填)
                </label>
                <input type="text" name="number" min="0" maxlength="10" />
                <span>元/股</span>
                <h4></h4>
            </p>
            <p>
                <label>
                    股票股利(選填)
                </label>
                <input type="text" name="number" min="0" maxlength="10" />
                <span>元/股</span>
                <h4></h4>
            </p>
            <p>
                <button type="button" class="cal" id="calPri">計算</button>
                <button type="button" id="clear">清除</button>
            </p>
            <p class="resultAll">
                參考價試算結果
                <input type="text" style="margin-left: 12%;" min="0" class="rate" id="result"></input>
            </p>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
    let numberAll = document.getElementsByName('number');
    let msgAll = document.getElementsByTagName('h4');
    let resAll = document.getElementById('result');

    window.onload=function () {
        let valueAll = new calReRate(numberAll, msgAll, resAll);
        valueAll.priceCal();
        valueAll.clearAll();
    }
    </script>
@endsection