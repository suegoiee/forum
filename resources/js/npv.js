// npv計算公式 和 deposit計算公式
class npvCal extends judgeValue {
    constructor(numberAll, msgAll, msgB, questionAll, moneyAll, inputTd, npv, form) {
        super(numberAll, msgAll);
        this.msgB = Array();
        this.questionAll = Array();
        this.moneyAll = Array();
        this.nameAll = Array();
        this.inputTd = inputTd;
        this.npv = npv;
        this.yearNPV = 1;
        this.checkValue = this.checkValue.bind(this);
        this.addTd = this.addTd.bind(this);
        this.del = this.del.bind(this);
        this.clearValue = this.clearValue.bind(this);
        this.clearVal = this.clearVal.bind(this);
        this.clearHTMLAll = this.clearHTMLAll.bind(this);
        this.form = form;
    }

    // 增加input
    addInput() {
        document.getElementById('add').onclick = () => {

            this.addTd("label", "nvpC", "nvpC", "第" + this.yearNPV + "年", questionAll);
            this.addTd("input", "mom", "mom", "", questionAll);
            this.addTd("h4", "msgB", "msgB", "", questionAll);
            this.addTd("p", "pp", "pp", "", questionAll);
            this.yearNPV++;

            this.checkValue(moneyAll, msgB);
        }
    }

    // npv計算公式
    calStock() {
        document.getElementById('calAll').onclick = () => {
            if (super.valueCheck() == true) {
                this.clearHTMLAll(msgAll);
                this.clearHTMLAll(msgB);

                if (npv.value != "") {
                    this.del(inputTd, 1);
                    this.del(npv, 0);
                }

                document.getElementById('form').style.cssFloat = "left";
                document.getElementById('form').style.width = "48%";
                form.style.display = "block";
                this.addTd("th", "year", "year", "年分", inputTd);
                this.addTd("th", "fac", "fac", "現值因子", inputTd);
                this.addTd("th", "momm", "momm", "每年現金流折算成現值", inputTd);
                this.addTd("th", "cal", "cal", "每年累計現值", inputTd);


                let valA = parseFloat(moneyAll[0].value);
                let valB = valA / valA * 100;
                let valC = valA * valB / 100;
                let valcC;
                valC < 0 ? valcC = -valC : valcC = valC;

                this.addTd("tr", "resA", "resA", "", inputTd);
                this.addTd("td", "yearA", "yearA", "第1年", inputTd);
                this.addTd("td", "facA", "facA", valB + "%", inputTd);
                this.addTd("td", "momA", "momA", valcC, inputTd);
                this.addTd("td", "calA", "calA", valC, inputTd);

                let y = 100;
                for (let i = 1; i < moneyAll.length; i++) {
                    let x = [];
                    x[i] = y / (parseFloat(numberAll[0].value) / 100 + 1);
                    let m = [];
                    m[i] = parseFloat(moneyAll[i].value) * x[i] / 100;
                    let z = [];
                    z[i] = valC + m[i];
                    let ii = i + 1;

                    this.addTd("tr", "resB", "resB", "", inputTd);
                    this.addTd("td", "yearB", "yearB", "第" + ii + "年", inputTd);
                    this.addTd("td", "facB", "facB", x[i].toFixed(0) + "%", inputTd);
                    this.addTd("td", "momB", "momB", m[i].toFixed(0), inputTd);
                    this.addTd("td", "calB", "calB", z[i].toFixed(0), inputTd);

                    y = x[i];
                    valC = z[i];
                };

                this.addTd("th", "valFF", "valFF", "淨現值(npv)", npv);
                this.addTd("td", "valFF", "valFF", valC.toFixed(0), npv);
                if (valC > 0) {
                    this.addTd("td", "rec", "rec", "該專案值得投資", npv);
                } else {
                    this.addTd("td", "recc", "recc", "該專案不值得投資，應該將這筆資金投入在其他地方。", npv);
                }
            }
        }
    }
    // npv清空
    clearEvery() {
        document.getElementById('clear').onclick = () => {

            this.clearVal(numberAll[0]);
            this.clearHTMLAll(msgAll);
            this.clearHTMLAll(msgB);

            // 刪除新增的子節點
            this.del(questionAll, 1);
            this.del(inputTd, 1);
            this.del(npv, 0);

            this.yearNPV = 1;
            document.getElementById('form').style.width = "100%";
            document.getElementById('form').style.cssFloat = "none";
            form.style.display = "none";
        }
    }

    // deposit計算公式
    calDoposit() {
        document.getElementById('calAll').onclick = () => {
            if (super.valueCheck() == true) {
                this.clearHTMLAll(msgAll);
                this.clearHTMLAll(msgB);

                if (inputTd.childNodes != null) {
                    this.del(inputTd, 1);
                }

                let add = 0;
                for (let i = 0; i < moneyAll.length; i++) {
                    add += parseFloat(moneyAll[i].value);
                }
                let ave = add / moneyAll.length;

                let valA = ave / (parseFloat(numberAll[0].value) / 100);
                let valB = ave / (parseFloat(numberAll[1].value) / 100);
                let valC = ave / (parseFloat(numberAll[2].value) / 100);

                this.addTd('th', 'cheap', 'cheap', '便宜價', inputTd);
                this.addTd('td', 'valueA', 'valueA', valA.toFixed(2) + '元', inputTd);
                this.addTd('tr', 'trA', 'trA', '', inputTd);
                this.addTd('th', 'res', 'res', '合理價', inputTd);
                this.addTd('td', 'valueB', 'valueB', valB.toFixed(2) + '元', inputTd);
                this.addTd('tr', 'trB', 'trB', '', inputTd);
                this.addTd('th', 'exp', 'exp', '昂貴價', inputTd);
                this.addTd('td', 'valueC', 'valueC', valC.toFixed(2) + '元', inputTd);
            }
        }
    }
    // deposit清空
    clearEve() {
        document.getElementById('clear').onclick = () => {

            this.clearValue(numberAll);
            this.clearHTMLAll(msgAll);
            this.clearHTMLAll(msgB);
            // 刪除新增的子節點
            this.del(questionAll, 1);
            this.del(inputTd, 1);

            this.yearNPV = 1;
        }
    }
}
