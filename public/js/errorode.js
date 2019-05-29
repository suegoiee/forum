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
        // 判斷輸入值
        this.checkValue = (vall, msg) => {
            for (var i = 0; i < vall.length; i++) {
                if (isNaN(vall[i].value)) {
                    msg[i].innerHTML = "只能輸入純數字";
                    vall[i].focus();
                    return false;
                } else if (vall[i].value == "") {
                    msg[i].innerHTML = "不可空白";
                    vall[i].focus();
                    return false;
                } else if (vall[i].value == 0) {
                    msg[i].innerHTML = "不可為零";
                    vall[i].focus();
                    return false;
                } else {
                    msg[i].innerHTML = "";
                }
            }
            return true;
        }
    }

    valueCheck() {
        if (this.checkValue(numberAll, msgAll) == true) {
            return true;
        }
    }
}