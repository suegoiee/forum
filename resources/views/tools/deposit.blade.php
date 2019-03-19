<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <title>定存股價值試算表</title>
    <link rel="stylesheet" type="text/css" href="css/styleAll.css">
    <script src="js/errorode.js"></script>
    <script src="js/npv.js"></script>
</head>

<body>
    <form style="width: 30%;">
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
                <input type="button" id="add" value="新增一年的現金股息" />
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
                <h4></h4>
            </p>
            <p>
                <label class="too">
                    合理價
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>%</span>
                <h4></h4>
            </p>
            <p>
                <label class="too">
                    昂貴價
                </label>
                <input type="text" name="per" min="0" maxlength="10" />
                <span>%</span>
                <h4></h4>
            </p>
            <p>
                <input type="button" class="cal" id="calAll" value="計算" />
                <button type="button" id="clear">清除</button>
            </p>
            <table>
                <tbody id="calMon">                 
                </tbody>
            </table>
            
        </fieldset>

    </form>
    <script type="text/javascript">
    let questionAll = document.getElementById("question");
    let moneyAll = document.getElementsByName('mom');
    let numberAll = document.getElementsByName('per');
    let msgAll = document.getElementsByTagName('h4');
    let inputTd = document.getElementById("calMon");

    let valueAll = new npvCal(numberAll, msgAll, questionAll, moneyAll, inputTd);
    valueAll.addInput();
    valueAll.calDoposit();
    valueAll.clearEve();
    </script>
</body>

</html>