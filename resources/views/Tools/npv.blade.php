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
                <input type="text" name="per" min="0" maxlength="10" />
                <span>%</span>
                <h4 id="msgA"></h4>
            </p>
            <p id="question" style="text-align: left;">
            </p>  	
            <p>
                <button type="button" id="add">新增一年的現金流狀況</button>
                <input type="hidden" id="countA" name="countA" value="1">
            </p>
            <p>
                <button type="button" class="cal" id="calAll" >計算</button>
                <button type="button" id="clear">清除</button>
            </p>
        </fieldset>
    </form>
    <form id="formStyle" style="display:none; float:right; width: 50%; margin-bottom: 1%;">
        <fieldset>
            <table>
                <tbody id="calMon">                 
                </tbody>
            </table>
            <p class="resultAll" id="npvv">
                淨現值(npv):
                <input type="text" id="npv" class="rate" name="npv" disabled>
            </p>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
        let questionAll = document.getElementById("question");
        let moneyAll = document.getElementsByName('mom');
        let numberAll = document.getElementsByName('per');
        let msgAll = document.getElementsByTagName('h4');
        let inputTd = document.getElementById("calMon");
        let npv = document.getElementById('npv');
        let npvv = document.getElementById('npvv');
        let form = document.getElementById("formStyle");

        window.onload=function () {
            let valueAll = new npvCal(numberAll, msgAll, questionAll, moneyAll, inputTd, npv, npvv, form);
            valueAll.addInput();
            valueAll.calStock();
            valueAll.clearEvery();
        }
    </script>
@endsection