@title('我適合存股嗎～存股性向測驗' . (isset($subTitle) ? ' > ' . $subTitle : ''))

@extends('layouts.default')

@section('content')
<div class="container">
    <form class="col-sm-12">
        <fieldset>
            <h3>我適合存股嗎～存股性向測驗</h3>
            <h5>(出自:智富Smart)</h5>
            <h5>(請勾選每一個題目)</h5>
            <br />
            <ol style="line-height: 20px;">
                <li>您希望投資股票的報酬率能有多少?<br />
                    <input type="radio" class="radioAll" name="getA" value="1">A&nbsp;&nbsp;一個月賺20％<br />
                    <input type="radio" class="radioAll" name="getA" value="2">B&nbsp;&nbsp;一年賺20％<br />
                    <input type="radio" class="radioAll" name="getA" value="3">C&nbsp;&nbsp;一年賺6％～10％
                </li>
                <br />
                <li>您希望花在操作的時間有多少?<br />
                    <input type="radio" class="radioAll" name="getB" value="1">A&nbsp;&nbsp;希望每天都有買賣機會<br />
                    <input type="radio" class="radioAll" name="getB" value="2">B&nbsp;&nbsp;一個月至少進出2～3次<br />
                    <input type="radio" class="radioAll" name="getB" value="3">C&nbsp;&nbsp;不急，出現好時機再操作就好
                </li>
                <br />
                <li>對您而言，買進股票之後，最希望看到哪種狀況出現?<br />
                    <input type="radio" class="radioAll" name="getC" value="3">A&nbsp;&nbsp;股票不一定要漲很多，最好每年都能穩定配現金利息給我<br />
                    <input type="radio" class="radioAll" name="getC" value="2">B&nbsp;&nbsp;股票穩定上漲，每年都有現金配息更好<br />
                    <input type="radio" class="radioAll" name="getC" value="1">C&nbsp;&nbsp;股票迅速上漲，現金配息少一點也沒關係
                </li>
                <br />
                <li>突然發生股災，您的第一個反應是甚麼?<br />
                    <input type="radio" class="radioAll" name="getD" value="1">A&nbsp;&nbsp;立刻認賠賣出，找其他投資機會<br />
                    <input type="radio" class="radioAll" name="getD" value="3">B&nbsp;&nbsp;如果持股基本面(公司的營運與財務狀況)沒有變差，準備進場加碼撿便宜<br />
                    <input type="radio" class="radioAll" name="getD" value="2">C&nbsp;&nbsp;達到停損點(自己設定能接受的虧損幅度)後再賣出，等股市開始上漲再買回來
                </li>
                <br />
                <li>少則5年，多則10年，才可能感受到報酬翻倍的成果，您的心情如何?<br />
                    <input type="radio" class="radioAll" name="getE" value="3">A&nbsp;&nbsp;樂觀其成，逐步累積獲利更踏實<br />
                    <input type="radio" class="radioAll" name="getE" value="1">B&nbsp;&nbsp;難以忍受，時間太長了<br />
                    <input type="radio" class="radioAll" name="getE" value="2">C&nbsp;&nbsp;尚可接受，如果時間能更短就好
                </li>
                <br />
                <li>您認為哪種股市分析方法最重要?<br />
                    <input type="radio" class="radioAll" name="getF" value="1">A&nbsp;&nbsp;技術分析<br />
                    <input type="radio" class="radioAll" name="getF" value="3">B&nbsp;&nbsp;基本分析<br />
                    <input type="radio" class="radioAll" name="getF" value="2">C&nbsp;&nbsp;兩者皆是
                </li>
                <br />
                <li>如果您剛領到一筆獎金，想用來買股票，會如何分配獎金?<br />
                    <input type="radio" class="radioAll" name="getG" value="1">A&nbsp;&nbsp;在最短的時間內，全都壓在最有可能上漲的股票<br />
                    <input type="radio" class="radioAll" name="getG" value="3">B&nbsp;&nbsp;將資金分成幾份，慢慢找適當的時機，陸續布局幾檔穩定配息的股票<br />
                    <input type="radio" class="radioAll" name="getG" value="2">C&nbsp;&nbsp;先買一兩檔有潛力上漲的股票，並保留部分資金，等著買其他股票
                </li>
                <br />
                <li>如果股票持續上漲，你會融資(貸款買股票)來擴大戰果嗎?<br />
                    <input type="radio" class="radioAll" name="getH" value="2">A&nbsp;&nbsp;可考慮少資融資<br />
                    <input type="radio" class="radioAll" name="getH" value="1">B&nbsp;&nbsp;高風險才有高獲利，何樂不為<br />
                    <input type="radio" class="radioAll" name="getH" value="3">C&nbsp;風險太高，絕對不會
                </li>
                <br />
                <li>您認為以下哪種狀況，是進場的好時機?<br />
                    <input type="radio" class="radioAll" name="getI" value="3">A&nbsp;&nbsp;公司獲利正常，但全球發生股災<br />
                    <input type="radio" class="radioAll" name="getI" value="1">B&nbsp;&nbsp;公司獲利暴增，但股價已先強勁上漲<br />
                    <input type="radio" class="radioAll" name="getI" value="2">C&nbsp;&nbsp;公司獲利衰退，但股價也跟著大跌
                </li>
                <br />
                <li>買股票賺大錢，「運氣」重要嗎?<br />
                    <input type="radio" class="radioAll" name="getJ" value="1">A&nbsp;&nbsp;非常重要<br />
                    <input type="radio" class="radioAll" name="getJ" value="2">B&nbsp;&nbsp;普通<br />
                    <input type="radio" class="radioAll" name="getJ" value="3">C&nbsp;&nbsp;不太重要 
                </li>
                <br />
            </ol>
            <p>
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
            valueAll.cheText();
            valueAll.clearAll();
        }
    </script>
@endsection