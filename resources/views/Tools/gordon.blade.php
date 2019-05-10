@title('高登模型' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
    <form class="col-sm-12" style="display: block;" id="form">
        <fieldset>
            <h3>高登模型</h3>
            <h5 style="line-height: 20px;">
                <li>適用於長期成長率穩定的公司，越穩定則評估越精準。</li>
                <li>假設公司把該配息的都配出來。</li>
            </h5>
            <h5>(請填入近一期盈餘、股息配發率、年報酬率、公司長期成長率)</h5>
            <p>
                <label>
                    近一期每股盈餘(EPS)
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>元</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    近一期股息配發率
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>％</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    你希望這支股票最少要能提供<br/>多少年報酬才會想投資：
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>％</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    公司長期成長率：
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>％</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <button type="button" class="cal" id="check">計算</button>
                <button type="button" id="clear">清除</button>
            </p>
            <p class="resultAll">
                最近一期股息：
                <input type="text" id="resultA" class="rate" name="resultA" disabled>
            </p>
            <p class="resultAll">
                高登模型所運算出來的股票價值：
                <input type="text" id="resultB" class="rate" name="resultB" disabled>
            </p>
        </fieldset>
    </form>
    <form id="formStyle" style="display:none; float:right; width: 50%; margin-bottom: 1%;">
        <fieldset>
            <table id="tableRes">
            </table>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
    let numberAll = document.getElementsByName('value');
    let msgAll = document.getElementsByTagName('h4');
    let resA = document.getElementById('resultA');
    let resB = document.getElementById('resultB');
    let resC = document.getElementById('tableRes');
    let form = document.getElementById("formStyle");

    window.onload=function () {
        let valueAll = new calGordon(numberAll, msgAll, resA, resB, resC,form);
        valueAll.gorCal();
        valueAll.clearEle();
    }
    </script>
@endsection