@title('巴菲特預估股價' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
    <form class="col-sm-12" id="form">
        <fieldset>
            <h3>巴菲特預估股價</h3>
            <h5>(請填入目前股價、最新每股淨值、ROE、股息配發率、股價淨值比)</h5>
            <p>
                <label>
                    目前股價：
                </label>
                <input type="text" class="inputText" min="0" name="value" maxlength="10" placeholder="元"/>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    最新每股淨值：
                </label>
                <input type="text" class="inputText" min="0" name="value" maxlength="10" placeholder="元"/>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    前一年度ROE：
                </label>
                <input type="text" class="inputText" min="0" name="value" maxlength="10" placeholder="％"/>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    股息配發率：
                </label>
                <input type="text" class="inputText" min="0" name="value" maxlength="10" placeholder="％"/>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    股價淨值比(10年平均)：
                </label>
                <input type="text" class="inputText" min="0" name="value" maxlength="10" placeholder="倍"/>
                <h4 id="bigW"></h4>
            </p>
            <div style="text-align: center;">
                <button type="button" class="cancel" id="clear">清除</button>
                <button type="button" class="btn" id="check">計算</button>
            </div>
        </fieldset>
    </form>
    <form id="formStyle" style="display:none; float:right; width: 50%; margin-bottom: 1%;">
        <fieldset>
            <table id="tableResA" class="table"></table>
            <table id="tableResB" class="table"></table>
        </fieldset>
    </form>
</div>

    <script type="text/javascript">
        let numberAll = document.getElementsByName('value');
        let msgAll = document.getElementsByTagName('h4');
        let resAll = document.getElementById('tableResA');
        let ress = document.getElementById('tableResB');
        let form = document.getElementById("formStyle");

        window.onload=function () {
            let valueAll = new calBuffett(numberAll, msgAll, resAll, ress, form);
            valueAll.bufCal();
            valueAll.clearEle();
        }
    </script>

@endsection