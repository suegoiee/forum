@title('本益成長比計算機' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
    <form class="col-sm-12">
        <fieldset>
            <h3>本益成長比計算機</h3>
            <h5>(請填入股價、每股盈餘、預估未來淨利年成長率)</h5>
            <p>
                <label>
                    股價
                </label>
                <input type="text" name="number" min="1" maxlength="10" />
                <span>元</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label>
                    每股盈餘
                </label>
                <input type="text" name="number" min="0" maxlength="10" />
                <span>元/股</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label>
                    預估未來淨利年成長率
                </label>
                <input type="text" name="number" min="0" maxlength="10" />
                <span>%</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <button type="button" class="cal" id="calPropor">計算</button>
                <button type="button" id="clear">清除</button>
            </p>
            <p class="resultAll">
                本益比 <br />
                <input type="text" min="0" class="rate" id="proportion" disabled></input>
            </p>
            <p class="resultAll">
                本益成長比 <br />
                <input type="text" min="0" class="rate" id="growproportion" disabled></input>
            </p>
            <p>
                <table id="tableRes">
                </table>
            </p>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
        let numberAll = document.getElementsByName('number');
        let msgAll = document.getElementsByTagName('h4');
        let judgeAll = document.getElementById('tableRes');
        let pro = document.getElementById('proportion');
        let growPro = document.getElementById('growproportion');

        window.onload=function () {
            let valueAll = new calProportion(numberAll, msgAll, judgeAll, pro, growPro);
            valueAll.proporCal();
            valueAll.clearAll();
        }
    </script>
@endsection