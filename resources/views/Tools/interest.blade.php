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
                <h6 id="msgA"></h6>
            </p>
            <p>
                <label>
                    投資年報酬率
                </label>
                <input type="text" class="inputText" min="0" name="number" maxlength="10" placeholder="％"/>
                <h6 id="msgA"></h6>
            </p>
            <p>
                <label>
                    投資年數
                </label>
                <input type="text" class="inputText" min="0" name="number" maxlength="10" placeholder="年"/>
                <h6 id="msgA"></h6>
            </p>
            <div style="text-align: center; margin-bottom: 15px;">
                <button type="button" class="cancel" id="clear">清除</button>
                <button type="button" class="btn" id="calInst">計算</button>
            </div>
            <p>
                <table id="calMon" class="table">
                </table>
            </p>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
        let numberAll = document.getElementsByName('number');
        let msgAll = document.getElementsByTagName('h6');
        let resAll = document.getElementById('calMon');

        window.onload=function () {
            let valueAll = new calReRate(numberAll, msgAll, resAll);
            valueAll.instCal();
            valueAll.clearAll();
        }
    </script>
@endsection