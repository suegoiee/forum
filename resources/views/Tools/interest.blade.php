@title('複利計算機' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
    <form class="col-sm-12" id="form">
        <fieldset>
            <h3>複利計算機</h3>
            <h5>(請填入本金、年報酬率、年數)</h5>
            <p>
                <label>
                    本金
                </label>
                <input type="text" class="inputText" min="1" name="number" maxlength="10" placeholder="元"/>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label>
                    投資年報酬率
                </label>
                <input type="text" class="inputText" min="0" name="number" maxlength="10" placeholder="％"/>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label>
                    投資年數
                </label>
                <input type="text" class="inputText" min="0" name="number" maxlength="10" placeholder="年"/>
                <h4 id="msgA"></h4>
            </p>
            <div style="text-align: center;">
                <button type="button" class="cancel" id="clear">清除</button>
                <button type="button" class="btn" id="calInst">計算</button>
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
            valueAll.instCal();
            valueAll.clearAll();
        }
    </script>
@endsection