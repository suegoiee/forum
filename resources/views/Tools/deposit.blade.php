@title('定期股價值計算' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
    <form class="col-sm-12" id="form">
        <fieldset>
            <h3>定期股價值計算</h3>
            <p>
                <label class="resultAll">
                    請輸入過去n年的現金股息
                </label>
            </p>
            <p id="question" style="text-align: left;">
            </p> 
            <p>
                <button type="button" id="add">新增一年的現金股息</button>
                <input type="hidden" id="countA" name="countA" value="1">
            </p>
            <p>
                <label class="resultAll">
                  請輸入你想要的股息殖利率 
                </label>
            </p>
            <p>
                <label class="too">
                    便宜價 
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>%</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label class="too">
                    合理價
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>%</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <label class="too">
                    昂貴價
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>%</span>
                <h4 id="msgA"></h4>
            </p>
            <p>
                <button type="button" class="cal" id="calAll">計算</button>
                <button type="button" id="clear">清除</button>
            </p>
            <table>
                <tbody id="calMon">                 
                </tbody>
            </table>
            
        </fieldset>

    </form>
</div>
    <script type="text/javascript">
    let questionAll = document.getElementById("question");
    let moneyAll = document.getElementsByName('mom');
    let numberAll = document.getElementsByName('per');
    let msgAll = document.getElementsByTagName('h4');
    let inputTd = document.getElementById("calMon");

    window.onload=function () {
    let valueAll = new npvCal(numberAll, msgAll, questionAll, moneyAll, inputTd);
    valueAll.addInput();
    valueAll.calDoposit();
    valueAll.clearEve();
    }
    </script>
@endsection