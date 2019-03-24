class judgeValue {
    constructor(numberAll, msgAll) {
        this.numberAll = Array();
        this.msgAll = Array();
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
        // 清除value HTML
        this.clearValue = (x) => {
            for (let i = 0; i < x.length; i++) {
                x[i].value = "";
            }
        }
        this.clearHTMLAll = (y) => {
            for (let i = 0; i < y.length; i++) {
                y[i].innerHTML = "";
            }
        }
        this.clearVal = (z) => {
            z.value = "";
        }
    }

    // 判斷輸入值
    valueCheck() {
        for (var i = 0; i < numberAll.length; i++) {
            if (isNaN(numberAll[i].value)) {
                msgAll[i].innerHTML = "只能輸入純數字";
                numberAll[i].focus();
                return false;
            } else if (numberAll[i].value == "") {
                msgAll[i].innerHTML = "不可空白";
                numberAll[i].focus();
                return false;
            } else if (numberAll[i].value == 0) {
                msgAll[i].innerHTML = "不可為零";
                numberAll[i].focus();
                return false;
            } else {
                msgAll[i].innerHTML = "";
            }
        }
        return true;
    }
}