@title('定期股價值計算' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style=" margin-top: 30px;">
    <form class="col-sm-12" id="form">
        <fieldset>
            <h3>定期股價值計算</h3>
            <p>
                <label class="resultAll">
                    請輸入過去n年的現金股息
                </label>
            </p>
            <p id="question">
            </p> 
            <p>
                <button type="button" id="add" class="btn">新增一年的現金股息</button>
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
                <input type="text" class="inputText" name="per" min="0" maxlength="10" placeholder="％"/>
                <h6 id="msgA"></h6>
            </p>
            <p>
                <label class="too">
                    合理價
                </label>
                <input type="text" class="inputText" name="per" min="0" maxlength="10" placeholder="％"/>
                <h6 id="msgA"></h6>
            </p>
            <p>
                <label class="too">
                    昂貴價
                </label>
                <input type="text" class="inputText" name="per" min="0" maxlength="10" placeholder="％"/>
                <h6 id="msgA"></h6>
            </p>
            <div style="text-align: center; margin-bottom: 15px;">
                <button type="button" class="cancel" id="clear">清除</button>
                <button type="button" class="btn" id="calAll">計算</button>
            </div>
            <table id="calMon" class="table">
            </table>
            
        </fieldset>

    </form>
</div>
    <script type="text/javascript">
    let numberAll = document.getElementsByName('per');
    let msgAll = document.getElementsByTagName('h6');
    let msgB = document.getElementsByTagName("h4");
    let questionAll = document.getElementById("question");
    let moneyAll = document.getElementsByName('mom');
    let inputTd = document.getElementById("calMon");

    window.onload=function () {
    let valueAll = new npvCal(numberAll, msgAll, msgB, questionAll, moneyAll, inputTd);
    valueAll.addInput();
    valueAll.calDoposit();
    valueAll.clearEve();
    }
    </script>
@endsection