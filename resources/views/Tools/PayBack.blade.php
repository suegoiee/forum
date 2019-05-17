@title('本息平均攤還(每月定額攤還)' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
    <form class="col-sm-12" style="display: block;" id="form">
        <fieldset>
            <h3>本息平均攤還(每月定額攤還)</h3>
            <h5>(請填入貸款金額、貸款年數、年利率)</h5>
            <p>
                <label class="too">
                    貸款金額
                </label>
                <input type="text" class="inputText" name="per" min="0" maxlength="10" placeholder="元"/>
                <h6 id="msgA"></h6>
            </p>
            <p>
                <label class="too">
                    貸款年數
                </label>
                <input type="text" class="inputText" name="per" min="0" maxlength="10" placeholder="年"/>
                <h6 id="msgA"></h6>
            </p>
            <p>
                <label class="too">
                    年利率
                </label>
                <input type="text" class="inputText" name="per" min="0" maxlength="10" placeholder="％"/>
                <h6 id="msgA"></h6>
            </p>
            <div style="text-align: center; margin-bottom: 15px;">
                <button type="button" class="cancel" id="clear">清除</button>
                <button type="button" class="btn" id="calAll">計算</button>
            </div>
            <p>
                <table id="calMonA" class="table">
                </table>
            </p>
        </fieldset>
    </form>
    <form id="formStyle" style="display:none; float:right; width: 50%; margin-bottom: 1%;">
        <fieldset>
            <table id="calMonB" class="table">
            </table>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
        let numberAll = document.getElementsByName('per');
        let msgAll = document.getElementsByTagName('h6');
        let resAll = document.getElementById("calMonA");
        let ress = document.getElementById("calMonB");
        let form = document.getElementById("formStyle");

        window.onload=function () {
            let valueAll = new calBuffett(numberAll, msgAll, resAll, ress, form);
            valueAll.calReturn();
            valueAll.clearEle();
        }
    </script>
@endsection