@title('本益成長比計算機' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
    <form class="col-sm-12" id="form">
        <fieldset>
            <h3>本益成長比計算機</h3>
            <h5>(請填入股價、每股盈餘、預估未來淨利年成長率)</h5>
            <p>
                <label>
                    股價
                </label>
                <input type="text" class="inputText" name="number" min="1" maxlength="10" placeholder="元" />
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label>
                    每股盈餘
                </label>
                <input type="text" class="inputText" name="number" min="0" maxlength="10" placeholder="元/股" />
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label>
                    預估未來淨利年成長率
                </label>
                <input type="text" class="inputText" name="number" min="0" maxlength="10" placeholder="％" />
                <h4 id="msgA"></h4>
            </p>
            <div style="text-align: center;">
                <button type="button" class="cancel" id="clear">清除</button>
                <button type="button" class="btn" id="calPropor">計算</button>
            </div>
            <p>
                <table id="tableRes" class="table">
                </table>
            </p>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
        let numberAll = document.getElementsByName('number');
        let msgAll = document.getElementsByTagName('h4');
        let resAll = document.getElementById('tableRes');

        window.onload=function () {
            let valueAll = new calReRate(numberAll, msgAll, resAll);
            valueAll.proporCal();
            valueAll.clearAll();
        }
    </script>
@endsection