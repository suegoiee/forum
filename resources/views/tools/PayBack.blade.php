@title('本息平均攤還(每月定額攤還)' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
    <form style="width: 30%; display: block;  float: left; margin-left: 22%;">
        <fieldset>
            <h3>本息平均攤還(每月定額攤還)</h3>
            <h5>(請填入貸款金額、貸款年數、年利率)</h5>
            <p>
                <label class="too">
                    貸款金額
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>元</span>
                <h4></h4>
            </p>
            <p>
                <label class="too">
                    貸款年數
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>年</span>
                <h4></h4>
            </p>
            <p>
                <label class="too">
                    年利率
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>%</span>
                <h4></h4>
            </p>
            <p>
                <input type="button" class="cal" id="calAll" value="計算" />
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
    <form style="display: block; float: left;">
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

        window.onload=function () {
            let valueAll = new reCal(numberAll, msgAll, inputTdA, inputTdB);
            valueAll.calReturn();
            valueAll.clearEvery();
        }
    </script>
@endsection