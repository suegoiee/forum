// bargain 買賣股票損益公式 和 estimate 市占率預估公式
class calFee extends judgeValue {
    constructor(numberAll, msgAll, moneyAll) {
        super(numberAll, msgAll);
        this.moneyAll = moneyAll;
        this.addTd = this.addTd.bind(this);
        this.del = this.del.bind(this);
        this.clearValue = this.clearValue.bind(this);
        this.clearHTMLAll = this.clearHTMLAll.bind(this);
    }
    // bargain 買賣股票損益公式
    feeCal() {
        document.getElementById('calMoney').onclick = () => {
            if (super.valueCheck() == true) {

                if (moneyAll.length != 0) {
                    this.del(moneyAll, 0);
                }
                let reg = /(?=(\B\d{3})+$)/g;

                let feeA = parseFloat(numberAll[0].value) * parseFloat(numberAll[1].value) * 0.001425 * (parseFloat(numberAll[2].value) / 10);
                let feeB = parseFloat(numberAll[0].value) * parseFloat(numberAll[1].value) + feeA;
                let feeC = parseFloat(numberAll[0].value) * parseFloat(numberAll[1].value) * 0.003;
                let feeD = parseFloat(numberAll[0].value) * parseFloat(numberAll[1].value) - feeA - feeC;
                this.addTd('tr', 'trr', 'trr', '', moneyAll);
                this.addTd('th', 'thh', 'thh', '買進時，券商手續費', moneyAll);
                this.addTd('td', 'tdd', 'tdd', feeA.toFixed(0) + "元", moneyAll);
                this.addTd('tr', 'trr', 'trr', '', moneyAll);
                this.addTd('th', 'thh', 'thh', '買進這檔股票，您需要準備', moneyAll);
                this.addTd('td', 'tdd', 'tdd', feeB.toFixed(0).replace(reg, ",") + "元", moneyAll);
                this.addTd('tr', 'trr', 'trr', '', moneyAll);
                this.addTd('th', 'thh', 'thh', '賣出時，需要券商手續費', moneyAll);
                this.addTd('td', 'tdd', 'tdd', feeA.toFixed(0) + "元", moneyAll);
                this.addTd('tr', 'trr', 'trr', '', moneyAll);
                this.addTd('th', 'thh', 'thh', '賣出時，需要證交稅', moneyAll);
                this.addTd('td', 'tdd', 'tdd', feeC.toFixed(0) + "元", moneyAll);
                this.addTd('tr', 'trr', 'trr', '', moneyAll);
                this.addTd('th', 'thh', 'thh', '賣出這檔股票，您共可拿回', moneyAll);
                this.addTd('td', 'tdd', 'tdd', feeD.toFixed(0).replace(reg, ",") + "元", moneyAll);
            }
        }
    }
    // estimate 市占率預估公式
    estCal() {
        document.getElementById('calEst').onclick = () => {
            if (super.valueCheck() == true) {
                if (moneyAll.length != 0) {
                    this.del(moneyAll, 0);
                }
                let reg = /(?=(\B\d{3})+$)/g;

                let feeA = parseFloat(numberAll[1].value) * Math.pow((1 + parseFloat(numberAll[2].value) / 100), 5) * (parseFloat(numberAll[3].value) / 100);
                let feeB = Math.pow(feeA / parseFloat(numberAll[0].value), 1 / 5) - 1;
                let feeC = parseFloat(numberAll[1].value) * Math.pow((1 + parseFloat(numberAll[2].value) / 100), 10) * (parseFloat(numberAll[4].value) / 100);
                let feeD = Math.pow(feeC / feeA, 1 / 5) - 1;
                let feeE = Math.pow(feeC / parseFloat(numberAll[0].value), 1 / 10) - 1;
                let feeBB = feeB * 100;
                let feeDD = feeD * 100;
                let feeEE = feeE * 100;

                this.addTd('tr', 'trr', 'trr', '', moneyAll);
                this.addTd('th', 'thh', 'thh', '公司5年後營收＝', moneyAll);
                this.addTd('td', 'tdd', 'tdd', feeA.toFixed(0).replace(reg, ",") + "億元", moneyAll);
                this.addTd('tr', 'trr', 'trr', '', moneyAll);
                this.addTd('th', 'thh', 'thh', '第一階段成長率：\ 未來5年營收年複合成長率＝', moneyAll);
                this.addTd('td', 'tdd', 'tdd', feeBB.toFixed(2) + "％", moneyAll);
                this.addTd('tr', 'trr', 'trr', '', moneyAll);
                this.addTd('th', 'thh', 'thh', '公司10年後營收＝', moneyAll);
                this.addTd('td', 'tdd', 'tdd', feeC.toFixed(0).replace(reg, ",") + "億元", moneyAll);
                this.addTd('tr', 'trr', 'trr', '', moneyAll);
                this.addTd('th', 'thh', 'thh', '第二階段成長率：\ 第6~10年的年複合成長率＝', moneyAll);
                this.addTd('td', 'tdd', 'tdd', feeDD.toFixed(2) + "％", moneyAll);
                this.addTd('tr', 'trr', 'trr', '', moneyAll);
                this.addTd('th', 'thh', 'thh', '整體評估:未來10年的年複合成長率＝', moneyAll);
                this.addTd('td', 'tdd', 'tdd', feeEE.toFixed(2) + "％", moneyAll);
            }
        }
    }
    // 清除
    clearAll() {
        document.getElementById('clear').onclick = () => {
            this.clearValue(numberAll);
            this.clearHTMLAll(msgAll);
            this.clearHTMLAll(moneyAll);

            this.del(moneyAll, 0);
        }
    }
}

// buffett 巴菲特預估股價公式 和 secondDCF 兩階段 現金流折現模型
class calBuffett extends judgeValue {
    constructor(numberAll, msgAll, resAll, ress, form) {
        super(numberAll, msgAll);
        this.resAll = resAll;
        this.ress = ress;
        this.addTd = this.addTd.bind(this);
        this.del = this.del.bind(this);
        this.clearValue = this.clearValue.bind(this);
        this.clearHTMLAll = this.clearHTMLAll.bind(this);
        this.clearVal = this.clearVal.bind(this);
        this.form = form;
    }
    // buffett 巴菲特預估股價
    bufCal() {
        document.getElementById('check').onclick = () => {
            if (super.valueCheck() == true) {

                if (ress.length != 0) {
                    this.del(resAll, 0);
                    this.del(ress, 0);
                }

                this.addTd("th", "yearA", "yearA", "年份", resAll);
                this.addTd("th", "momA", "momA", "每股淨值(元)", resAll);
                this.addTd("th", "roeA", "roeA", "ROE％", resAll);
                this.addTd("th", "epsA", "epsA", "EPS", resAll);
                this.addTd("th", "liA", "liA", "股息", resAll);
                this.addTd("th", "stoA", "stoA", "預測股價", resAll);

                let valA = parseFloat(numberAll[0].value);
                let valB = parseFloat(numberAll[1].value);
                let valC = parseFloat(numberAll[2].value);
                let valD = parseFloat(numberAll[3].value);
                let valE = parseFloat(numberAll[4].value);
                let valArr = Array();
                let cal = 0;

                for (let i = 0; i < 11; i++) {
                    let calA = valB * (valC / 100);
                    let calB = calA * (valD / 100);

                    this.addTd("tr", "resA", "resA", "", resAll);
                    this.addTd("td", "yearB", "yearB", i, resAll);
                    this.addTd("td", "momB", "momB", valB.toFixed(2), resAll);
                    this.addTd("td", "roeB", "roeB", valC + "％", resAll);
                    this.addTd("td", "epsB", "epsB", calA.toFixed(1), resAll);
                    this.addTd("td", "liB", "liB", calB.toFixed(1), resAll);
                    this.addTd("td", "stoB", "stoB", valA.toFixed(2), resAll);

                    valB = valB + calA - calB;
                    valArr.push(valA);
                    valA = valB * valE;
                    cal += calB;
                }
                let result = (Math.pow(((parseFloat(valArr[10]) + cal) / parseFloat(valArr[0])), 1 / 10) - 1) * 100;
                this.addTd("th", "resla", "resla", "以目前價格買進，並長期持有，<br/> 您大約可獲得多少的報酬率(包含股息收益)：", ress);
                this.addTd("tr", "resB", "resB", "", ress);
                this.addTd("th", "resVa", "resVa", result.toFixed(2) + "％", ress);
            }
        }
    }
    // secondDCF 兩階段 現金流折現模型
    depoCal() {
        document.getElementById('check').onclick = () => {
            if (super.valueCheck() == true) {

                if (ress.length != 0) {
                    this.del(resAll, 0);
                    this.del(ress, 0);
                }

                document.getElementById('form').style.cssFloat = "left";
                document.getElementById('form').style.width = "50%";
                form.style.display = "block";
                this.addTd("th", "yearA", "year", "未來十年", resAll);
                this.addTd("th", "momA", "mom", "自由現金流", resAll);
                this.addTd("th", "roeA", "roe", "成長率％", resAll);
                this.addTd("th", "epsA", "eps", "折算現值", resAll);

                let valA = parseFloat(numberAll[0].value);
                let valB = parseFloat(numberAll[1].value) / 100;
                let valC = parseFloat(numberAll[2].value) / 100;
                let valD = parseFloat(numberAll[3].value) / 100;
                let valE = parseFloat(numberAll[4].value) / 100;
                let valF = parseFloat(numberAll[5].value);
                let valG = parseFloat(numberAll[6].value);
                let cal = 0;

                for (let i = 0; i < 5; i++) {
                    let ii = i + 1;
                    let calA = valA * valB + valA;
                    valA = calA;
                    let calB = valA / Math.pow((1 + valD), ii);

                    this.addTd("tr", "res", "res", "", resAll);
                    this.addTd("td", "yearB", "yearB", ii, resAll);
                    this.addTd("td", "momB", "momB", calA.toFixed(0), resAll);
                    this.addTd("td", "roeB", "roeB", valB * 100 + "％", resAll);
                    this.addTd("td", "epsB", "epsB", calB.toFixed(0), resAll);

                    cal += calB;
                }
                for (let i = 5; i < 10; i++) {
                    let ii = i + 1;
                    let calC = valA * valC + valA;
                    valA = calC;
                    let calD = valA / Math.pow((1 + valD), ii);

                    this.addTd("tr", "res", "res", "", resAll);
                    this.addTd("td", "yearB", "yearB", ii, resAll);
                    this.addTd("td", "momB", "momB", calC.toFixed(0), resAll);
                    this.addTd("td", "roeB", "roeB", valC * 100 + "％", resAll);
                    this.addTd("td", "epsB", "epsB", calD.toFixed(0), resAll);

                    cal += calD;
                }
                let calE = valA * valE + valA;
                let calF = (calE / (valD - valE)) / Math.pow((1 + valD), 10);
                let calG = cal + calF;
                let calH = (calG - valG) / valF;

                this.addTd("th", "valAA", "valAA", "第十年的自由現金流", ress);
                this.addTd("td", "valA", "valA", calE.toFixed(0) + "元", ress);
                this.addTd("tr", "resB", "resB", "", ress);

                this.addTd("th", "valBB", "valBB", "未來10年的自由現金流累計現值", ress);
                this.addTd("td", "valB", "valB", cal.toFixed(0) + "元", ress);
                this.addTd("tr", "resB", "resB", "", ress);

                this.addTd("th", "valCC", "valCC", "終值", ress);
                this.addTd("td", "valC", "valC", calF.toFixed(0) + "元", ress);
                this.addTd("tr", "resB", "resB", "", ress);

                this.addTd("th", "valDD", "valDD", "股票價值", ress);
                this.addTd("td", "valD", "valD", calG.toFixed(0) + "元", ress);
                this.addTd("tr", "resB", "resB", "", ress);

                this.addTd("th", "valEE", "valEE", "在外流通股數", ress);
                this.addTd("td", "valE", "valE", valF.toFixed(0) + "股", ress);
                this.addTd("tr", "resB", "resB", "", ress);

                this.addTd("th", "valFF", "valFF", "每股價值", ress);
                this.addTd("td", "valFF", "valFF", calH.toFixed(0) + "元", ress);
            }
        }
    }
    // 清除
    clearEle() {
        document.getElementById('clear').onclick = () => {
            this.clearValue(numberAll);
            this.clearHTMLAll(msgAll);
            this.del(resAll, 0);
            this.del(ress, 0);
            document.getElementById('form').style.width = "100%";
            document.getElementById('form').style.cssFloat = "none";
            form.style.display = "none";
        }
    }
}

// Compound 年複合成長率計算公式 和 retire 退休規畫評估 和 interest 複利計算公式 和 money 除權息參考價計算公式
class calReRate extends judgeValue {
    constructor(numberAll, msgAll, resAll) {
        super(numberAll, msgAll);
        this.resAll = resAll;
        this.clearValue = this.clearValue.bind(this);
        this.clearHTMLAll = this.clearHTMLAll.bind(this);
        this.clearVal = this.clearVal.bind(this);
    }
    // Compound 年複合成長率計算公式 和 retire 退休規畫評估
    rateCal() {
        document.getElementById('check').onclick = () => {
            if (super.valueCheck() == true) {
                let rate_1 = (parseFloat(numberAll[2].value) / parseFloat(numberAll[1].value));
                let rate_2 = 1 / parseFloat(numberAll[0].value);
                let rateRe = (Math.pow(rate_1, rate_2) - 1) * 100;
                resAll.value = rateRe.toFixed(1) + "%";
            }
        }
    }
    // interest 複利計算公式
    instCal() {
        document.getElementById('calInst').onclick = () => {
            if (super.valueCheck() == true) {
                let reg = /(?=(\B\d{3})+$)/g;
                let rateA = 1 + parseFloat(numberAll[1].value) / 100;
                let rateB = Math.pow(rateA, parseFloat(numberAll[2].value));
                let rateRe = parseFloat(numberAll[0].value) * rateB;
                resAll.value = rateRe.toFixed(0).replace(reg, ",") + "元";
            }
        }
    }
    // money 除權息參考價計算公式
    priceCal() {
        document.getElementById('calPri').onclick = () => {
            if (super.valueCheck() == true) {
                let re = (parseFloat(numberAll[0].value) - parseFloat(numberAll[1].value)) / (1 + parseFloat(numberAll[2].value) / 10);
                resAll.value = re.toFixed(2) + "元";
            }
        }
    }
    // lowestRetire 最低退休金公式
    lowCal() {
        document.getElementById('calPri').onclick = () => {
            if (super.valueCheck() == true) {

                let reg = /(?=(\B\d{3})+$)/g;
                let valA = parseFloat(numberAll[0].value);
                let valB = parseFloat(numberAll[1].value) / 100;
                let valC = parseFloat(numberAll[2].value) / 100;
                let valD = parseFloat(numberAll[3].value);
                let valE = parseFloat(numberAll[4].value);

                let rate = (valC - valB) / (1 + valB);
                let nper = valE - valD;
                let pmt = -valA * Math.pow((1 + valB), 0.5);
                let val = 1 + valB;
                let pv = pmt * ((1 - 1 / (Math.pow((1 + rate), nper))) / rate);
                let result = pv / val;
                if (result < 0) {
                    result = result * -1;
                }

                resAll.value = result.toFixed(0).replace(reg, ",") + "元";
            }
        }
    }

    // 清除
    clearAll() {
        document.getElementById('clear').onclick = () => {
            this.clearValue(numberAll);
            this.clearHTMLAll(msgAll);
            this.clearVal(resAll);
        }
    }
}

// gordon 高登模型公式
class calGordon extends judgeValue {
    constructor(numberAll, msgAll, resA, resB, resC, form) {
        super(numberAll, msgAll);
        this.resA = resA;
        this.resB = resB;
        this.resC = resC;
        this.addTd = this.addTd.bind(this);
        this.del = this.del.bind(this);
        this.clearValue = this.clearValue.bind(this);
        this.clearHTMLAll = this.clearHTMLAll.bind(this);
        this.clearVal = this.clearVal.bind(this);
        this.form = form;
    }

    gorCal() {
        document.getElementById('check').onclick = () => {
            if (super.valueCheck() == true) {

                if (resA.value != "") {
                    this.del(resC, 0);
                    resA.value = "";
                    resB.value = "";
                }


                let eleA = parseFloat(numberAll[2].value);
                let eleB = parseFloat(numberAll[3].value);
                if (eleA <= eleB) {
                    msgAll[2].innerHTML = "年報酬率不得小於等於成長率!";
                    return false;
                } else {
                    let calA = parseFloat(numberAll[0].value) * (parseFloat(numberAll[1].value) / 100);
                    let calB = calA * (1 + eleB / 100) / ((eleA - eleB) / 100);

                    resA.value = calA.toFixed(2) + "元";
                    resB.value = calB.toFixed(2) + "元";

                    this.addTd("th", "per", "per", "成長率假設", resC);
                    this.addTd("th", "sto", "sto", "股票價值", resC);

                    document.getElementById('form').style.cssFloat = "left";
                    document.getElementById('form').style.width = "50%";
                    form.style.display = "block";
                    if (numberAll[2].value > 40) {
                        form.style.height = "750px";
                        form.style.overflowY = "scroll";
                    }
                    for (let x = eleA - 1; - 1 < x; x--) {
                        let resD = calA * (1 + x / 100) / ((eleA - x) / 100);
                        this.addTd("tr", "res", "res", "", resC);
                        this.addTd("td", "perA", "perA", x, resC);
                        this.addTd("td", "mom", "mom", "$" + resD.toFixed(2), resC);
                    }
                }
            }
        }
    }

    clearEle() {
        document.getElementById('clear').onclick = () => {
            this.clearValue(numberAll);
            this.clearHTMLAll(msgAll);
            this.clearVal(resA);
            this.clearVal(resB);
            this.del(resC, 0);
            document.getElementById('form').style.width = "100%";
            document.getElementById('form').style.cssFloat = "none";
            form.style.display = "none";
        }
    }
}


// proportion 本益成長比計算公式
class calProportion extends judgeValue {
    constructor(numberAll, msgAll, judgeAll, pro, growPro) {
        super(numberAll, msgAll);
        this.judgeAll = judgeAll;
        this.pro = pro;
        this.growPro = growPro;
        this.addTd = this.addTd.bind(this);
        this.del = this.del.bind(this);
        this.clearValue = this.clearValue.bind(this);
        this.clearHTMLAll = this.clearHTMLAll.bind(this);
        this.clearVal = this.clearVal.bind(this);
    }
    proporCal() {
        document.getElementById('calPropor').onclick = () => {
            if (super.valueCheck() == true) {

                if (judgeAll.length != 0) {
                    this.del(judgeAll, 0);
                }
                let propor = parseFloat(numberAll[0].value) / parseFloat(numberAll[1].value);
                pro.value = propor.toFixed(2);
                let growpropor = parseFloat(propor) / parseFloat(numberAll[2].value);
                growPro.value = growpropor.toFixed(2);

                // 判斷

                if (growpropor < 0.75) {
                    this.addTd("th", "valEE", "valEE", "本益成長比", judgeAll);
                    this.addTd("td", "valE", "valE", "低於0.75倍(0.66倍更佳)", judgeAll);
                    this.addTd("tr", "resB", "resB", "", judgeAll);
                    this.addTd("th", "valEE", "valEE", "股價合理程度", judgeAll);
                    this.addTd("td", "valE", "valE", "股價被低估", judgeAll);
                    this.addTd("tr", "resB", "resB", "", judgeAll);
                    this.addTd("th", "valEE", "valEE", "採取動作", judgeAll);
                    this.addTd("td", "valE", "valE", "買進", judgeAll);
                    this.addTd("tr", "resB", "resB", "", judgeAll);
                } else if (growpropor > 1.2) {
                    this.addTd("th", "valEE", "valEE", "本益成長比", judgeAll);
                    this.addTd("td", "valE", "valE", "高於1.2倍", judgeAll);
                    this.addTd("tr", "resB", "resB", "", judgeAll);
                    this.addTd("th", "valEE", "valEE", "股價合理程度", judgeAll);
                    this.addTd("td", "valE", "valE", "股價被高估", judgeAll);
                    this.addTd("tr", "resB", "resB", "", judgeAll);
                    this.addTd("th", "valEE", "valEE", "採取動作", judgeAll);
                    this.addTd("td", "valE", "valE", "賣出", judgeAll);
                    this.addTd("tr", "resB", "resB", "", judgeAll);
                } else {
                    this.addTd("th", "valEE", "valEE", "本益成長比", judgeAll);
                    this.addTd("td", "valE", "valE", "等於1倍", judgeAll);
                    this.addTd("tr", "resB", "resB", "", judgeAll);
                    this.addTd("th", "valEE", "valEE", "股價合理程度", judgeAll);
                    this.addTd("td", "valE", "valE", "股價合理", judgeAll);
                    this.addTd("tr", "resB", "resB", "", judgeAll);
                    this.addTd("th", "valEE", "valEE", "採取動作", judgeAll);
                    this.addTd("td", "valE", "valE", "空手者不買，持有者不賣", judgeAll);
                    this.addTd("tr", "resB", "resB", "", judgeAll);
                }
            }
        }
    }

    clearAll() {
        document.getElementById('clear').onclick = () => {
            this.clearValue(numberAll);
            this.clearHTMLAll(msgAll);
            this.clearVal(pro);
            this.clearVal(growPro);
            this.del(judgeAll, 0);
        }
    }

}

// return 貸款試算：本息平均攤還(每月定額攤還) 
class reCal extends judgeValue {
    constructor(numberAll, msgAll, inputTdA, inputTdB, form) {
        super(numberAll, msgAll);
        this.inputTdA = inputTdA;
        this.inputTdB = inputTdB;
        this.addTd = this.addTd.bind(this);
        this.del = this.del.bind(this);
        this.form = form;
    }

    calReturn() {
        document.getElementById('calAll').onclick = () => {
            if (super.valueCheck() == true) {

                if (inputTdA.length != 0) {
                    this.del(inputTdA, 1);
                    this.del(inputTdB, 1);
                }

                let reg = /(?=(\B\d{3})+$)/g;
                let valA = parseFloat(numberAll[0].value);
                let valB = parseFloat(numberAll[1].value);
                let valC = parseFloat(numberAll[2].value) / 100;

                let resA = valC / 12;
                let resB = valB * 12;
                let resC = (Math.pow((1 + resA), resB) * resA) / (Math.pow((1 + resA), resB) - 1);
                let resD = valA * resC;
                let resAA = resA * 100;
                let resCC = resC * 100;

                document.getElementById('form').style.cssFloat = "left";
                document.getElementById('form').style.width = "50%";
                form.style.display = "block";
                if (resB > 30) {
                    form.style.height = "750px";
                    form.style.overflowY = "scroll";
                }
                this.addTd("th", "MM", "MM", "月利率", inputTdA);
                this.addTd("td", "MV", "MV", resAA.toFixed(1) + "％", inputTdA);
                this.addTd("tr", "ee", "ee", "", inputTdA);
                this.addTd("th", "dd", "dd", "貸款期數", inputTdA);
                this.addTd("td", "dA", "dA", resB + "月", inputTdA);
                this.addTd("tr", "ee", "ee", "", inputTdA);
                this.addTd("th", "aa", "aa", "平均攤還率", inputTdA);
                this.addTd("td", "aA", "aA", resCC.toFixed(2) + "％", inputTdA);
                this.addTd("tr", "ee", "ee", "", inputTdA);
                this.addTd("th", "MA", "MA", "平均每月應還本息金額", inputTdA);
                this.addTd("td", "Vm", "Vm", resD.toFixed(0).replace(reg, ",") + "元", inputTdA);

                this.addTd("th", "mom", "mom", "第n期", inputTdB);
                this.addTd("th", "mon", "mon", "本金", inputTdB);
                this.addTd("th", "int", "int", "利息", inputTdB);
                this.addTd("th", "ree", "ree", "已還款本金累計", inputTdB);

                let int = valA * resA;
                let all = 0;
                for (let i = 0; i < resB; i++) {
                    let mon = resD - int;
                    let ii = i + 1;
                    all += mon;

                    this.addTd("tr", "ee", "ee", "", inputTdB);
                    this.addTd("td", "vA", "vA", ii, inputTdB);
                    this.addTd("td", "vB", "vB", "＄" + mon.toFixed(0).replace(reg, ","), inputTdB);
                    this.addTd("td", "vC", "vC", "＄" + int.toFixed(0).replace(reg, ","), inputTdB);
                    this.addTd("td", "vD", "vD", "＄" + all.toFixed(0).replace(reg, ","), inputTdB);

                    int = (valA - all) * resA;
                }
            }
        }
    }

    clearEvery() {
        document.getElementById('clear').onclick = () => {
            this.clearValue(numberAll);
            this.clearHTMLAll(msgAll);
            this.del(inputTdA, 0);
            this.del(inputTdB, 0);
            document.getElementById('form').style.width = "100%";
            document.getElementById('form').style.cssFloat = "none";
            form.style.display = "none";
        }
    }
}