@title('股票買進檢查表' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
    <form>
        <fieldset>
            <h3>股票買進檢查表</h3>
            <h5>(請勾選每一個題目)</h5>
            <br />
            <ol style="line-height: 20px;">
                <li>是否了解公司產品用途，且市佔率在該產業前3名? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getA" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getA" value="0">否
                </li>
                <br />
                <li>公司生產的產品或勞務，是否讓你覺得在未來10年不會被淘汰? &nbsp;
                    <input type="radio" class="radioAll" name="getB" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getB" value="0">否
                </li>
                <br />
                <li>你是否認同公司的產品與勞務，對經濟民生有正面貢獻? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getC" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getC" value="0">否
                </li>
                <br />
                <li>公司產品是否具有獨佔、寡占或產業龍頭的特性? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getD" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getD" value="0">否
                </li>
                <br />
                <li>公司ROE過去3年平均是否高於12%? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getE" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getE" value="0">否
                </li>
                <br />
                <li>公司實質負債比是否小於15%? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getF" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getF" value="0">否
                </li>
                <br />
                <li>公司的速動比率是否少於1? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getG" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getG" value="0">否
                </li>
                <br />
                <li>公司過去3年平均毛利率是否高於15%? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getH" value="1">是 &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getH" value="0">否
                </li>
                <br />
                <li>公司過去3年平均營收成長率是否高於5%? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getI" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getI" value="0">否
                </li>
                <br />
                <li>公司目前本益比是否低於12倍? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getJ" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getJ" value="0">否
                </li>
                <br />
                <li>動態股價本益比（PEG）是否小於1? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getK" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getK" value="0">否
                </li>
                <br />
                <li>公司過去3年股息殖利率是否高於5%? &nbsp;&nbsp;
                    <input type="radio" class="radioAll" name="getL" value="1">是 &nbsp;
                    <input type="radio" class="radioAll" name="getL" value="0">否
                </li>
                <br />
            </ol>
            <p style="margin-left: 40%;">
                <button type="button" id="checkAll">檢查</button>
                <button type="button" id="clear">重新填選</button>
            </p>
            <table id="result">
                <label class="resultAll"></label>
                <p></p>
            </table>
        </fieldset>
    </form>
</div>
    <script type="text/javascript">
        let radAll = document.querySelectorAll('.radioAll');
        let res = document.querySelector('.resultAll');
        let resAll = document.getElementById('result');

        window.onload=function () {
        let valueAll = new checkRad(radAll, res, resAll);
        valueAll.cheChecked();
        valueAll.clearAll();
        }
    </script>
@endsection