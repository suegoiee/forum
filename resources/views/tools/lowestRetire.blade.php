<!DOCTYPE html>
<html lang="zh-Hant-TW">

<head>
    <meta charset="UTF-8">
    <title>最低退休金</title>
    <link rel="stylesheet" type="text/css" href="css/styleAll.css">
    <script src="js/errorode.js"></script>
    <script src="js/cal.js"></script>
</head>

<body>
    <form>
        <fieldset>
            <h3>最低退休金</h3>
            <h5>(請填入除權除息前股價、現金股利、股票股利)</h5>
            <p>
                <label>
                    每年生活費
                </label>
                <input type="text" name="number" min="1" maxlength="10" />
                <span>元</span>
                <h4></h4>
            </p>
            <p>
                <label>
                    通貨膨脹率
                </label>
                <input type="text" name="number" min="0" maxlength="10" />
                <span>％</span>
                <h4></h4>
            </p>
            <p>
                <label>
                    投資報酬率
                </label>
                <input type="text" name="number" min="0" maxlength="10" />
                <span>％</span>
                <h4></h4>
            </p>
            <p>
                <label>
                    退休年齡
                </label>
                <input type="text" name="number" min="0" maxlength="10" />
                <span>歲</span>
                <h4></h4>
            </p>
            <p>
                <label>
                    預期壽命
                </label>
                <input type="text" name="number" min="0" maxlength="10" />
                <span>歲</span>
                <h4></h4>
            </p>
            <p>
                <button type="button" class="cal" id="calPri">計算</button>
                <button type="button" id="clear">清除</button>
            </p>
            <p class="resultAll">
                參考價試算結果
                <input type="text" style="margin-left: 12%;" min="0" class="rate" id="result"></input>
            </p>
        </fieldset>
    </form>
    <script type="text/javascript">
    let numberAll = document.getElementsByName('number');
    let msgAll = document.getElementsByTagName('h4');
    let resAll = document.getElementById('result');

    let valueAll = new calReRate(numberAll, msgAll, resAll);
    valueAll.lowCal();
    valueAll.clearAll();
    </script>
</body>

</html>