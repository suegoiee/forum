class checkRad {
    constructor(radAll, resAll) {
        this.radAll = Array();
        this.resAll = resAll;
        // 創制新的物件
        this.addTd = (cla, idd, namm, word, par) => {
            let tdd = document.createElement(cla);
            tdd.id = idd;
            tdd.name = namm;
            tdd.type = "text";
            tdd.innerHTML = word;
            par.appendChild(tdd);
        };
        // 刪除物件
        this.del = (par, inn) => {
            let child = par.childNodes;
            for (let i = child.length - 1; i >= inn; i--) {
                par.removeChild(child.item(i));
            }
        };
    }
    // 股票買進檢查表
    cheChecked() {
        document.getElementById('checkAll').onclick = () => {

            let selArr = Array();
            let obj = Array();
            let selEle, selName;
            let cal = 0;

            if (resAll.childNodes != null) {
                this.del(resAll, 1);
            }

            // 取得個別name的名稱
            for (let i = 0; i < radAll.length; i++) {
                if (selEle != radAll[i].name) {
                    selArr.push(radAll[i].name);
                    selEle = radAll[i].name;
                }
            }
            // 對應name的類別來判斷
            for (let i = 0; i < selArr.length; i++) {
                let selName = document.getElementsByName(selArr[i]);
                if (selName[0].checked || selName[1].checked) {
                    if (selName[0].checked) {
                        cal += parseInt(selName[0].value);
                    }
                } else {
                    let ii = i + 1;
                    alert('請回答第 ' + ii + ' 題的問題');
                    return false;
                }
            }

            this.addTd("th", "ress", "ress", "合計：" + cal, resAll);
            this.addTd("tr", "nn", "nn", "", resAll);
            if (cal < 10) {
                this.addTd("td", "non", "non", "需要再等等", resAll);
            } else {
                this.addTd("td", "che", "che", "值得投資", resAll);
            }
        }
    }
    // 存股性向測驗
    cheText() {
        document.getElementById('checkAll').onclick = () => {

            let selArr = Array();
            let obj = Array();
            let selEle, selName;
            let cal = 0;

            if (resAll.childNodes != null) {
                this.del(resAll, 1);
            }

            // 取得個別name的名稱
            for (let i = 0; i < radAll.length; i++) {
                if (selEle != radAll[i].name) {
                    selArr.push(radAll[i].name);
                    selEle = radAll[i].name;
                }
            }
            // 對應name的類別來判斷
            for (let i = 0; i < selArr.length; i++) {
                let selName = document.getElementsByName(selArr[i]);
                if (selName[0].checked || selName[1].checked || selName[2].checked) {
                    selName.forEach((item, i) => {
                        if (selName[i].checked) {
                            cal += parseInt(item.value);
                        }
                    })
                } else {
                    let ii = i + 1;
                    alert('請回答第 ' + ii + ' 題的問題');
                    return false;
                }
            }
            this.addTd("th", "ress", "ress", "合計：" + cal, resAll);
            this.addTd("tr", "nn", "nn", "", resAll);
            if (cal < 14) {
                this.addTd("th", "non", "non", "容易半途而廢", resAll);
                document.getElementById('non').style.color = "#ef5350";
                this.addTd("tr", "nn", "nn", "", resAll);
                this.addTd("td", "nnnn", "nnnn", "您的投資個性傾向積極，希望一進場就能賺到好幾支漲停板，也有承受高度風險的準備，短線進出才能滿足您追求股價飆升的快感；目前存股對您而言，賺錢速度太慢，很容易半途放棄；建議可調整投資心態後再來考慮存股。", resAll);
            } else if (cal > 26) {
                this.addTd("th", "che", "che", "適合長期存股", resAll);
                document.getElementById('che').style.color = "#4abf70";
                this.addTd("tr", "nn", "nn", "", resAll);
                this.addTd("td", "nnnn", "nnnn", "您的投資個性介於保守與積極之間，不願意承擔過高的風險，一年賺10％～20％是您最希望得到的報酬率，採取波段操作較能滿足您的個性；若要採用長期存股策略，您需要增加更多耐心，降低預期年報酬率，拉長期望獲利的時間。", resAll);
            } else {
                this.addTd("th", "nnn", "nnn", "需要更多耐心", resAll);
                this.addTd("tr", "nn", "nn", "", resAll);
                this.addTd("td", "nnnn", "nnnn", "您的投資個性偏向保守，卻又不甘於只賺銀行定存利率，願意用時間換取穩定的報酬，存股絕對是最適合您的投資策略；先花時間做功課，找到值得長期投資的股票，並定期檢視績效，假以時日將能享受到甜美戰果。", resAll);
            }
        }
    }

    clearAll() {
        document.getElementById('clear').onclick = () => {
            for (var i = 0; i < radAll.length; i++) {
                radAll[i].checked = false;
            }
            this.del(resAll, 1);
        }
    }
}