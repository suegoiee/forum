@title('股票買進檢查表' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container" style="margin-bottom: 2%; margin-top: 30px;">
    <form class="col-sm-12" style="display: block;" id="form">
        <fieldset>
            <h3>股票買進檢查表</h3>
            <h5>(請勾選每一個題目)</h5>
            <br />
            <ol style="line-height: 20px;">
                <li>是否了解公司產品用途，且市佔率在該產業前3名?<br/>
                    <input type="radio" class="radioAll" id="a" name="getA" value="1">
                    <label class="boxStyle" for="a">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="b" name="getA" value="0">
                    <label class="boxStyle" for="b">否 </label>
                </li>
                <br />
                <li>公司生產的產品或勞務，是否讓你覺得在未來10年不會被淘汰?<br/>
                    <input type="radio" class="radioAll" id="c" name="getB" value="1">
                    <label class="boxStyle" for="c">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="d" name="getB" value="0">
                    <label class="boxStyle" for="d">否 </label>
                </li>
                <br />
                <li>你是否認同公司的產品與勞務，對經濟民生有正面貢獻?<br/>
                    <input type="radio" class="radioAll" id="e" name="getC" value="1">
                    <label class="boxStyle" for="e">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="f" name="getC" value="0">
                    <label class="boxStyle" for="f">否 </label>
                </li>
                <br />
                <li>公司產品是否具有獨佔、寡占或產業龍頭的特性? <br/>
                    <input type="radio" class="radioAll" id="g" name="getD" value="1">
                    <label class="boxStyle" for="g">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="h" name="getD" value="0">
                    <label class="boxStyle" for="h">否 </label>
                </li>
                <br />
                <li>公司ROE過去3年平均是否高於12%?<br/>
                    <input type="radio" class="radioAll" id="i" name="getE" value="1">
                    <label class="boxStyle" for="i">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="j" name="getE" value="0">
                    <label class="boxStyle" for="j">否 </label>
                </li>
                <br />
                <li>公司實質負債比是否小於15%? <br/>
                    <input type="radio" class="radioAll" id="k" name="getF" value="1">
                    <label class="boxStyle" for="k">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="l" name="getF" value="0">
                    <label class="boxStyle" for="l">否 </label>
                </li>
                <br />
                <li>公司的速動比率是否少於1? <br/>
                    <input type="radio" class="radioAll" id="m" name="getG" value="1">
                    <label class="boxStyle" for="m">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="n" name="getG" value="0">
                    <label class="boxStyle" for="n">否 </label>
                </li>
                <br />
                <li>公司過去3年平均毛利率是否高於15%? <br/>
                    <input type="radio" class="radioAll" id="o" name="getH" value="1">
                    <label class="boxStyle" for="o">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="p" name="getH" value="0">
                    <label class="boxStyle" for="p">否 </label>
                </li>
                <br />
                <li>公司過去3年平均營收成長率是否高於5%? <br/>
                    <input type="radio" class="radioAll" id="q" name="getI" value="1">
                    <label class="boxStyle" for="q">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="r" name="getI" value="0">
                    <label class="boxStyle" for="r">否 </label>
                </li>
                <br />
                <li>公司目前本益比是否低於12倍?<br/>
                    <input type="radio" class="radioAll" id="s" name="getJ" value="1">
                    <label class="boxStyle" for="s">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="t" name="getJ" value="0">
                    <label class="boxStyle" for="t">否 </label>
                </li>
                <br />
                <li>動態股價本益比（PEG）是否小於1?<br/>
                    <input type="radio" class="radioAll" id="u" name="getK" value="1">
                    <label class="boxStyle" for="u">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="v" name="getK" value="0">
                    <label class="boxStyle" for="v">否 </label>
                </li>
                <br />
                <li>公司過去3年股息殖利率是否高於5%? <br/>
                    <input type="radio" class="radioAll" id="w" name="getL" value="1">
                    <label class="boxStyle" for="w">是 </label>&nbsp;
                    <input type="radio" class="radioAll" id="y" name="getL" value="0">
                    <label class="boxStyle" for="y">否 </label>
                </li>
                <br />
            </ol>
            <div style="text-align: center;">
                <button type="button" class="cancel" id="clear">重新填選</button>
                <button type="button" class="btn" id="checkAll">檢查</button>
            </div>
            <p>
                <table id="calMon" class="table">
                </table>
            </p>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
        let radAll = document.querySelectorAll('.radioAll');
        let resAll = document.getElementById('calMon');

        window.onload=function () {
        let valueAll = new checkRad(radAll, resAll);
        valueAll.cheChecked();
        valueAll.clearAll();
        }
    </script>
@endsection