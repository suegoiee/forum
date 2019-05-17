@title('資本預算之NPV(淨現值)' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
    <form class="col-sm-12" style="display: block;" id="form">
        <fieldset>
            <h3>資本預算之NPV(淨現值)</h3>
            <h5>(請填入年利率、各年現金流狀況)</h5>
            <p>
                <label class="too">
                    年利率(資金成本)
                </label>
                <input type="text" class="inputText" name="per" min="0" maxlength="10" placeholder="％"/>
                <h6 id="msgA"></h6>
            </p>
            <p id="question">
            </p>  	
            <div style="text-align: center;">
                <button type="button" id="add" class="btn">新增一年的現金流狀況</button>
                <input type="hidden" id="countA" name="countA" value="1">
            </div>
            <p></p>
            <div style="text-align: center; margin-bottom: 15px;">
                <button type="button" class="cancel" id="clear">清除</button>
                <button type="button" class="btn" id="calAll" >計算</button>
            </div>
        </fieldset>
    </form>
    <form id="formStyle" style="display:none; float:right; width: 50%; margin-bottom: 1%;">
        <fieldset>
            <table id="npvv" class="table">
            </table>
            <table id="npv" class="table">
            </table>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
        let questionAll = document.getElementById("question");
        let moneyAll = document.getElementsByName('mom');
        let numberAll = document.getElementsByName('per');
        let msgAll = document.getElementsByTagName('h6');
        let msgB = document.getElementsByTagName('h4');
        let inputTd = document.getElementById("npvv");
        let npv = document.getElementById('npv');
        let form = document.getElementById("formStyle");

        window.onload=function () {
            let valueAll = new npvCal(numberAll, msgAll, msgB ,questionAll, moneyAll, inputTd, npv, form);
            valueAll.addInput();
            valueAll.calStock();
            valueAll.clearEvery();
        }
    </script>
@endsection