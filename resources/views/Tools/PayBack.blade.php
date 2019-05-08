@title('本息平均攤還(每月定額攤還)' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
    <form class="col-sm-12" style="display: block;" id="form">
        <fieldset>
            <h3>本息平均攤還(每月定額攤還)</h3>
            <h5>(請填入貸款金額、貸款年數、年利率)</h5>
            <p>
                <label class="too">
                    貸款金額
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>元</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label class="too">
                    貸款年數
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>年</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label class="too">
                    年利率
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>%</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <button type="button" class="cal" id="calAll">計算</button>
                <button type="button" id="clear">清除</button>
            </p>
            <p>
                <table>
                    <tbody id="calMonA">
                    </tbody>
                </table>
            </p>
        </fieldset>
    </form>
    <form id="formStyle" style="display:none; float:right; width: 50%; margin-bottom: 1%;">
        <fieldset>
            <table id="calMonB">
            </table>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
        let numberAll = document.getElementsByName('per');
        let msgAll = document.getElementsByTagName('h4');
        let inputTdA = document.getElementById("calMonA");
        let inputTdB = document.getElementById("calMonB");
        let form = document.getElementById("formStyle");

        window.onload=function () {
            let valueAll = new reCal(numberAll, msgAll, inputTdA, inputTdB, form);
            valueAll.calReturn();
            valueAll.clearEvery();
        }
    </script>
@endsection