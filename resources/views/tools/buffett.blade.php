@title('巴菲特預估股價' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
    <form>
        <fieldset>
            <h3>巴菲特預估股價</h3>
            <h5>(請填入目前股價、最新每股淨值、ROE、股息配發率、股價淨值比)</h5>
            <p>
                <label>
                    目前股價：
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>元</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    最新每股淨值：
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>元</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    前一年度ROE：
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>％</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    股息配發率：
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>％</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    股價淨值比(10年平均)：
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>倍</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <button type="button" class="cal" id="check">計算</button>
                <button type="button" id="clear">清除</button>
            </p>
            <p>
                <table id="tableResA">
                    <p></p>
                </table>
            </p>
            <p>
                <table id="tableResB"></table>
            </p>
        </fieldset>
    </form>
</div>

    <script type="text/javascript">
        let numberAll = document.getElementsByName('value');
        let msgAll = document.getElementsByTagName('h4');
        let resAll = document.getElementById('tableResA');
        let ress = document.getElementById('tableResB');

        window.onload=function () {
            let valueAll = new calBuffett(numberAll, msgAll, resAll, ress);
            valueAll.bufCal();
            valueAll.clearEle();
        }
    </script>

@endsection