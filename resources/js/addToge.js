// 買股公式
class togeStock extends judgeValue {
    constructor(numberAll, msgAll, msgB, question, nameAll, moneyAll, inputTdA, inputTdB, inputTdC, form) {
        super(numberAll, msgAll);
        this.msgB = Array();
        this.question = question;
        this.nameAll = Array();
        this.moneyAll = Array();
        this.inputTdA = inputTdA;
        this.inputTdB = inputTdB;
        this.inputTdC = inputTdC;
        this.checkValue = this.checkValue.bind(this);
        this.addTd = this.addTd.bind(this);
        this.del = this.del.bind(this);
        this.form = form;
    }

    // 增加input
    addInput() {
        document.getElementById('add').onclick = () => {

            this.addTd("label", "toge", "toge", "請輸入姓名及金額", question);
            this.addTd("input", "name", "name", "", question);
            this.addTd("input", "money", "money", "", question);
            this.addTd("h4", "msgB", "msgB", "", question);
            this.addTd("p", "pp", "pp", "", question);

            this.checkValue(moneyAll, msgB);
        }
    }

    calStock() {
        document.getElementById('calAll').onclick = () => {

            if (super.valueCheck() == true) {
                this.clearHTMLAll(msgAll);
                this.clearHTMLAll(msgB);

                if (inputTdA.length != 0) {
                    this.del(inputTdA, 0);
                    this.del(inputTdB, 0);
                    this.del(inputTdC, 0);
                }

                let sumAll = 0;
                for (var i = 0; i < moneyAll.length; i++) {
                    let valueAll = parseFloat(moneyAll[i].value);
                    sumAll += valueAll;
                }

                document.getElementById('form').style.cssFloat = "left";
                document.getElementById('form').style.width = "48%";
                form.style.display = "block";

                moneyAll.forEach((item, i) => {

                    let reg = /(?=(\B\d{3})+$)/g;

                    let averAll = parseFloat(item.value) / sumAll * 100;
                    let averGet = (parseFloat(numberAll[2].value) - parseFloat(numberAll[1].value)) * (averAll / 100);
                    let moneyGet = (averAll / 100) * parseFloat(numberAll[2].value);

                    this.addTd("tr", "trr", "trr", "", inputTdA);
                    this.addTd("td", "naa", "naa", nameAll[i].value, inputTdA);
                    this.addTd("td", "aver", "aver", averAll.toFixed(2) + "%", inputTdA);
                    this.addTd("tr", "trr", "trr", "", inputTdB);
                    this.addTd("td", "naa", "naa", nameAll[i].value, inputTdB);
                    this.addTd("td", "get", "get", ' ＄ ' + averGet.toFixed(0).replace(reg, ",") + "元", inputTdB);
                    this.addTd("tr", "trr", "trr", "", inputTdC);
                    this.addTd("td", "naa", "naa", nameAll[i].value, inputTdC);
                    this.addTd("td", "Mon", "Mon", ' ＄ ' + moneyGet.toFixed(0).replace(reg, ",") + "元", inputTdC);

                });
            }
        }
    }


    // 清空
    clearEvery() {
        document.getElementById('clear').onclick = () => {
            for (var i = 0; i < numberAll.length; i++) {
                numberAll[i].value = "";
                msgAll[i].innerHTML = "";
            }

            // 刪除新增的子節點
            this.del(question, 1);
            this.del(inputTdA, 0);
            this.del(inputTdB, 0);
            this.del(inputTdC, 0);
            document.getElementById('form').style.width = "100%";
            document.getElementById('form').style.cssFloat = "none";
            form.style.display = "none";
        }
    }
}
