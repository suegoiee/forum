<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <title>兩階段 現金流折現模型 DCF</title>
    <link rel="stylesheet" type="text/css" href="css/styleAll.css">
    <script src="js/errorode.js"></script>
    <script src="js/cal.js"></script>
</head>

<body>
    <form style="width: 29%;">
        <fieldset>
            <h3>兩階段 現金流折現模型 DCF</h3>
            <h5>(企業價值=股東能從企業拿回多少現金流量的現值總和)</h5>
            <h5>(請填入以下所有的輸入框)</h5>
            <p>
                <label>
                    自由現金流量<br />
                    <span class="small">(可採用前一年數值或是長期平均數值)</span>
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    未來10年(2個成長階段)<br />預估成長率％
                </label>
                <p>
                    <label>1～5年</label>
                    <input type="text" min="0" name="value" maxlength="10" />
                    <span>％</span>
                    <h4 id="bigW"></h4>
                </p>
                <p>
                    <label>6～10年</label>
                    <input type="text" min="0" name="value" maxlength="10" />
                    <span>％</span>
                    <h4 id="bigW"></h4>
                </p>
            </p>
            <p>
                <label>
                    折現率％<br />
                    <span class="small">(建議折現率設定超過10%以上)</span>
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>％</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    永續成長率％<br />
                    <span class="small">(不能超過市場GDP水準)</span>
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <span>％</span>
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    在外流通股數
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <h4 id="bigW"></h4>
            </p>
            <p>
                <label>
                    淨負債
                </label>
                <input type="text" min="0" name="value" maxlength="10" />
                <h4 id="bigW"></h4>
            </p>
            <p>
                <button type="button" class="cal" id="check">計算</button>
                <button type="button" id="clear">清除</button>
            </p>
            <p>
                <table id="tableResA">
                </table>
            </p>
            <p>
                <table id="tableResB"></table>
            </p>
        </fieldset>
    </form>
    <script type="text/javascript">
    let numberAll = document.getElementsByName('value');
    let msgAll = document.getElementsByTagName('h4');
    let resAll = document.getElementById('tableResA');
    let ress = document.getElementById('tableResB');

    let valueAll = new calBuffett(numberAll, msgAll, resAll, ress);
    valueAll.depoCal();
    valueAll.clearEle();
    </script>
</body>

</html>