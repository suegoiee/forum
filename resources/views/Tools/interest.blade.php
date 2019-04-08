@title('複利計算機' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
    <form class="col-sm-12">
        <fieldset>
            <h3>複利計算機</h3>
            <h5>(請填入本金、年報酬率、年數)</h5>
            <p>
                <label>
                    本金
                </label>
                <input type="text" min="1" name="number" maxlength="10" />
                <span>元</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label>
                    投資年報酬率
                </label>
                <input type="text" min="0" name="number" maxlength="10" />
                <span>%</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label>
                    投資年數
                </label>
                <input type="text" min="0" name="number" maxlength="10" />
                <span>年</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <button type="button" class="cal" id="calInst">計算</button>
                <button type="button" id="clear">清除</button>
            </p>
            <p class="resultAll">
                每年複利之後本金將變成＝
                <input type="text" min="0" class="rate" id="result" disabled/>
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
            valueAll.instCal();
            valueAll.clearAll();
        }
    </script>
@endsection