// 買股公式
class togeStock extends judgeValue {
    constructor(numberAll, msgAll, question, nameAll, moneyAll, inputTdA, inputTdB, inputTdC, printAll) {
        super(numberAll, msgAll);
        this.question = question;
        this.nameAll = Array();
        this.moneyAll = Array();
        this.inputTdA = inputTdA;
        this.inputTdB = inputTdB;
        this.inputTdC = inputTdC;
        this.printAll = printAll;
        this.addTd = this.addTd.bind(this);
        this.del = this.del.bind(this);
    }


    // 增加input
    addInput() {
        document.getElementById('add').onclick = () => {

            this.addTd("label", "toge", "toge", "請輸入姓名及金額", question);
            this.addTd("input", "name", "name", "", question);
            this.addTd("input", "money", "money", "", question);
            this.addTd("span", "dol", "dol", "元", question);

            for (var i = 0; i < moneyAll.length; i++) {
                if (moneyAll[i].value == "") {
                    moneyAll[i].value = "不可空白";
                    moneyAll[i].focus();
                } else if (moneyAll[i].value == 0) {
                    moneyAll[i].value = "不可為0";
                    moneyAll[i].focus();
                } else if (isNaN(moneyAll[i].value)) {
                    moneyAll[i].value = "請輸入純數字";
                    moneyAll[i].focus();
                } 
            }
        }
    }

    calStock() {
        document.getElementById('calAll').onclick = () => {

            if (super.valueCheck() == true) {

                let sumAll = 0;
                for (var i = 0; i < moneyAll.length; i++) {
                    let valueAll = parseFloat(moneyAll[i].value);
                    sumAll += valueAll;
                }

                moneyAll.forEach((item, i) => {

                    let reg = /(?=(\B\d{3})+$)/g;

                    let averAll = parseFloat(item.value) / sumAll * 100;
                    let averGet = (parseFloat(numberAll[2].value) - parseFloat(numberAll[1].value)) * (averAll / 100);
                    let moneyGet = (averAll / 100) * parseFloat(numberAll[2].value);

                    this.addTd("tr", "aver", "aver", nameAll[i].value + "  :  " + averAll.toFixed(2) + "%", inputTdA);
                    this.addTd("tr", "get", "get", nameAll[i].value + "  :  " + "$" + averGet.toFixed(0).replace(reg, ",") + "元", inputTdB);
                    this.addTd("tr", "Mon", "Mon", nameAll[i].value + "  :  " + "$" + moneyGet.toFixed(0).replace(reg, ",") + "元", inputTdC);

                });

                this.addTd("button", "doc", "doc", "列印", printAll);
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
            this.del(question,1);
            this.del(inputTdA,1);
            this.del(inputTdB,1);
            this.del(inputTdC,1);
        }
    }
}