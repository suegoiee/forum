function convertById(id) {
    html2canvas(document.querySelector("#" + id), {
        canvas: document.querySelector("#myCanvas"),
        scale: 2,
    }).then(canvas => {
    });
}
function convert() {
    html2canvas(document.querySelector("#CanvasBaseMap"), {
        canvas: document.querySelector("#myCanvas"),
        scale: 2,
    }).then(canvas => {
    });
}
function convertInfo() {
    html2canvas(document.querySelector("#CompanyInfocontainer"), {
        canvas: document.querySelector("#myCanvas")
    }).then(canvas => {
    });
}
function convertNews() {
    html2canvas(document.querySelector("#Newscontainer"), {
        canvas: document.querySelector("#myCanvas")
    }).then(canvas => {
    });
}
function convertPrice() {
    html2canvas(document.querySelector("#buttonPrice"), {
        canvas: document.querySelector("#myCanvas")
    }).then(canvas => {
    });
}
function convertStock() {
    html2canvas(document.querySelector("#buttonStock"), {
        canvas: document.querySelector("#myCanvas")
    }).then(canvas => {
    });
}
var canvas = document.getElementById("myCanvas");

download_img = function (el) {
    var image = canvas.toDataURL("image/jpg");
    el.href = image;
}
function onInfoClick() {
    window.location.hash = "#CompanyInfocontainer";
}
function onNewsClick() {
    window.location.hash = "#Newscontainer";
}
function onPriceClick() {
    window.location.hash = "#buttonPrice";
}
function onStockClick() {
    window.location.hash = "#buttonStock";
}

$(document).on("click", ".downloadSummary", function () {
    var clickedId = $(this).next().attr("id");
    convertById(clickedId);
});