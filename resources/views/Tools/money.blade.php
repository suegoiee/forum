@title('除權息參考價計算機' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
    <form class="col-sm-12" id="form">
        <fieldset>
            <h3>除權息參考價計算機</h3>
            <h5>(請填入除權除息前股價、現金股利、股票股利)</h5>
            <p>
                <label>
                    除權除息前股價
                    <span class="red">(必填)</span>
                </label>
                <input type="text" class="inputText" name="number" min="1" maxlength="10" placeholder="元"/>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label>
                    現金股利(選填)
                </label>
                <input type="text" class="inputText" name="number" min="0" maxlength="10" placeholder="元/股"/>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label>
                    股票股利(選填)
                </label>
                <input type="text" class="inputText" name="number" min="0" maxlength="10" placeholder="元/股"/>
                <h4 id="msgA"></h4>
            </p>
            <div style="text-align: center;">
                <button type="button" class="cancel" id="clear">清除</button>
                <button type="button" class="btn" id="calPri">計算</button>
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
        let valueAll = new calReRate(numberAll, msgAll, resAll);
        valueAll.priceCal();
        valueAll.clearAll();
    }
    </script>
@endsection