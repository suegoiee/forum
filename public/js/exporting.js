/*
 Highcharts JS v7.0.3 (2019-02-06)
 Exporting module

 (c) 2010-2019 Torstein Honsi

 License: www.highcharts.com/license
*/
(function (h) { "object" === typeof module && module.exports ? (h["default"] = h, module.exports = h) : "function" === typeof define && define.amd ? define(function () { return h }) : h("undefined" !== typeof Highcharts ? Highcharts : void 0) })(function (h) {
    var D = function () { return { initUpdate: function (f) { f.navigation || (f.navigation = { updates: [], update: function (f, p) { this.updates.forEach(function (q) { q.update.call(q.context, f, p) }) } }) }, addUpdate: function (f, h) { h.navigation || this.initUpdate(h); h.navigation.updates.push({ update: f, context: h }) } } }();
    (function (f, h) {
        var p = f.defaultOptions, q = f.doc, B = f.Chart, r = f.addEvent, D = f.removeEvent, E = f.fireEvent, w = f.createElement, F = f.discardElement, y = f.css, n = f.merge, u = f.pick, G = f.objectEach, z = f.extend, K = f.isTouchDevice, A = f.win, I = A.navigator.userAgent, H = f.SVGRenderer, J = f.Renderer.prototype.symbols, L = /Edge\/|Trident\/|MSIE /.test(I), M = /firefox/i.test(I); z(p.lang, {
            printChart: "列印圖表", downloadPNG: "下載PNG圖檔", downloadJPEG: "下載JPEG圖檔", downloadPDF: "下載PDF文檔", downloadSVG: "下載SVG圖像",
            contextButtonTitle: "Chart context menu"
        }); p.navigation || (p.navigation = {}); n(!0, p.navigation, { buttonOptions: { theme: {}, symbolSize: 14, symbolX: 12.5, symbolY: 10.5, align: "right", buttonSpacing: 3, height: 22, verticalAlign: "top", width: 24 } }); n(!0, p.navigation, {
            menuStyle: { border: "1px solid #545454", background: "#ffffff", padding: "5px 0" }, menuItemStyle: { padding: "0.3em 1em", color: "#393939", background: "none", fontSize: K ? "14.5px" : "12px", transition: "background 250ms, color 250ms" }, menuItemHoverStyle: {
                background: "#ffffff",
                color: "#ffa500"
            }, buttonOptions: { symbolFill: "#545454", symbolStroke: "#545454", symbolStrokeWidth: 3, theme: { padding: 5 } }
        }); p.exporting = {
            type: "image/png", url: "https://export.highcharts.com/", printMaxWidth: 780, scale: 2, buttons: { contextButton: { className: "highcharts-contextbutton", menuClassName: "highcharts-contextmenu", symbol: "menu", titleKey: "contextButtonTitle", menuItems: "printChart separator downloadPNG downloadJPEG downloadPDF downloadSVG".split(" ") } }, menuItemDefinitions: {
                printChart: {
                    textKey: "printChart",
                    onclick: function () { this.print() }
                }, separator: { separator: !0 }, downloadPNG: { textKey: "downloadPNG", onclick: function () { this.exportChart() } }, downloadJPEG: { textKey: "downloadJPEG", onclick: function () { this.exportChart({ type: "image/jpeg" }) } }, downloadPDF: { textKey: "downloadPDF", onclick: function () { this.exportChart({ type: "application/pdf" }) } }, downloadSVG: { textKey: "downloadSVG", onclick: function () { this.exportChart({ type: "image/svg+xml" }) } }
            }
        }; f.post = function (b, a, d) {
            var c = w("form", n({ method: "post", action: b, enctype: "multipart/form-data" },
                d), { display: "none" }, q.body); G(a, function (a, b) { w("input", { type: "hidden", name: b, value: a }, null, c) }); c.submit(); F(c)
        }; z(B.prototype, {
            sanitizeSVG: function (b, a) {
                if (a && a.exporting && a.exporting.allowHTML) { var d = b.match(/<\/svg>(.*?$)/); d && d[1] && (d = '\x3cforeignObject x\x3d"0" y\x3d"0" width\x3d"' + a.chart.width + '" height\x3d"' + a.chart.height + '"\x3e\x3cbody xmlns\x3d"http://www.w3.org/1999/xhtml"\x3e' + d[1] + "\x3c/body\x3e\x3c/foreignObject\x3e", b = b.replace("\x3c/svg\x3e", d + "\x3c/svg\x3e")) } b = b.replace(/zIndex="[^"]+"/g,
                    "").replace(/symbolName="[^"]+"/g, "").replace(/jQuery[0-9]+="[^"]+"/g, "").replace(/url\(("|&quot;)(\S+)("|&quot;)\)/g, "url($2)").replace(/url\([^#]+#/g, "url(#").replace(/<svg /, '\x3csvg xmlns:xlink\x3d"http://www.w3.org/1999/xlink" ').replace(/ (|NS[0-9]+\:)href=/g, " xlink:href\x3d").replace(/\n/, " ").replace(/<\/svg>.*?$/, "\x3c/svg\x3e").replace(/(fill|stroke)="rgba\(([ 0-9]+,[ 0-9]+,[ 0-9]+),([ 0-9\.]+)\)"/g, '$1\x3d"rgb($2)" $1-opacity\x3d"$3"').replace(/&nbsp;/g, "\u00a0").replace(/&shy;/g, "\u00ad");
                this.ieSanitizeSVG && (b = this.ieSanitizeSVG(b)); return b
            }, getChartHTML: function () { this.styledMode && this.inlineStyles(); return this.container.innerHTML }, getSVG: function (b) {
                var a, d, c, v, m, k = n(this.options, b); d = w("div", null, { position: "absolute", top: "-9999em", width: this.chartWidth + "px", height: this.chartHeight + "px" }, q.body); c = this.renderTo.style.width; m = this.renderTo.style.height; c = k.exporting.sourceWidth || k.chart.width || /px$/.test(c) && parseInt(c, 10) || (k.isGantt ? 800 : 600); m = k.exporting.sourceHeight || k.chart.height ||
                    /px$/.test(m) && parseInt(m, 10) || 400; z(k.chart, { animation: !1, renderTo: d, forExport: !0, renderer: "SVGRenderer", width: c, height: m }); k.exporting.enabled = !1; delete k.data; k.series = []; this.series.forEach(function (a) { v = n(a.userOptions, { animation: !1, enableMouseTracking: !1, showCheckbox: !1, visible: a.visible }); v.isInternal || k.series.push(v) }); this.axes.forEach(function (a) { a.userOptions.internalKey || (a.userOptions.internalKey = f.uniqueKey()) }); a = new f.Chart(k, this.callback); b && ["xAxis", "yAxis", "series"].forEach(function (c) {
                        var d =
                            {}; b[c] && (d[c] = b[c], a.update(d))
                    }); this.axes.forEach(function (b) { var c = f.find(a.axes, function (a) { return a.options.internalKey === b.userOptions.internalKey }), d = b.getExtremes(), e = d.userMin, d = d.userMax; c && (void 0 !== e && e !== c.min || void 0 !== d && d !== c.max) && c.setExtremes(e, d, !0, !1) }); c = a.getChartHTML(); E(this, "getSVG", { chartCopy: a }); c = this.sanitizeSVG(c, k); k = null; a.destroy(); F(d); return c
            }, getSVGForExport: function (b, a) {
                var d = this.options.exporting; return this.getSVG(n({ chart: { borderRadius: 0 } }, d.chartOptions,
                    a, { exporting: { sourceWidth: b && b.sourceWidth || d.sourceWidth, sourceHeight: b && b.sourceHeight || d.sourceHeight } }))
            }, getFilename: function () { var b = this.userOptions.title && this.userOptions.title.text, a = this.options.exporting.filename; if (a) return a; "string" === typeof b && (a = b.toLowerCase().replace(/<\/?[^>]+(>|$)/g, "").replace(/[\s_]+/g, "-").replace(/[^a-z0-9\-]/g, "").replace(/^[\-]+/g, "").replace(/[\-]+/g, "-").substr(0, 24).replace(/[\-]+$/g, "")); if (!a || 5 > a.length) a = "chart"; return a }, exportChart: function (b, a) {
                a =
                    this.getSVGForExport(b, a); b = n(this.options.exporting, b); f.post(b.url, { filename: b.filename || this.getFilename(), type: b.type, width: b.width || 0, scale: b.scale, svg: a }, b.formAttributes)
            }, print: function () {
                function b(b) { (a.fixedDiv ? [a.fixedDiv, a.scrollingContainer] : [a.container]).forEach(function (a) { b.appendChild(a) }) } var a = this, d = [], c = q.body, f = c.childNodes, m = a.options.exporting.printMaxWidth, k, e; if (!a.isPrinting) {
                    a.isPrinting = !0; a.pointer.reset(null, 0); E(a, "beforePrint"); if (e = m && a.chartWidth > m) k = [a.options.chart.width,
                    void 0, !1], a.setSize(m, void 0, !1); f.forEach(function (a, b) { 1 === a.nodeType && (d[b] = a.style.display, a.style.display = "none") }); b(c); setTimeout(function () { A.focus(); A.print(); setTimeout(function () { b(a.renderTo); f.forEach(function (a, b) { 1 === a.nodeType && (a.style.display = d[b]) }); a.isPrinting = !1; e && a.setSize.apply(a, k); E(a, "afterPrint") }, 1E3) }, 1)
                }
            }, contextMenu: function (b, a, d, c, v, m, k) {
                var e = this, x = e.options.navigation, l = e.chartWidth, t = e.chartHeight, h = "cache-" + b, g = e[h], C = Math.max(v, m), n; g || (e.exportContextMenu =
                    e[h] = g = w("div", { className: b }, { width: '25%', position: "absolute", zIndex: 1E3, padding: C + "px", pointerEvents: "auto" }, e.fixedDiv || e.container), n = w("div", { className: "highcharts-menu" }, null, g), e.styledMode || y(n, z({ MozBoxShadow: "3px 3px 10px #888", WebkitBoxShadow: "3px 3px 10px #888", boxShadow: "3px 3px 10px #888" }, x.menuStyle)), g.hideMenu = function () { y(g, { display: "none" }); k && k.setState(0); e.openMenu = !1; f.clearTimeout(g.hideTimer) }, e.exportEvents.push(r(g, "mouseleave", function () { g.hideTimer = setTimeout(g.hideMenu, 500) }), r(g,
                        "mouseenter", function () { f.clearTimeout(g.hideTimer) }), r(q, "mouseup", function (a) { e.pointer.inClass(a.target, b) || g.hideMenu() }), r(g, "click", function () { e.openMenu && g.hideMenu() })), a.forEach(function (a) {
                            "string" === typeof a && (a = e.options.exporting.menuItemDefinitions[a]); if (f.isObject(a, !0)) {
                                var b; a.separator ? b = w("hr", null, null, n) : (b = w("div", { className: "highcharts-menu-item", onclick: function (b) { b && b.stopPropagation(); g.hideMenu(); a.onclick && a.onclick.apply(e, arguments) }, innerHTML: a.text || e.options.lang[a.textKey] },
                                    null, n), e.styledMode || (b.onmouseover = function () { y(this, x.menuItemHoverStyle) }, b.onmouseout = function () { y(this, x.menuItemStyle) }, y(b, z({ cursor: "pointer" }, x.menuItemStyle)))); e.exportDivElements.push(b)
                            }
                        }), e.exportDivElements.push(n, g), e.exportMenuWidth = g.offsetWidth, e.exportMenuHeight = g.offsetHeight); a = { display: "block" }; d + e.exportMenuWidth > l ? a.right = l - d - v - C + "px" : a.left = d - C + "px"; c + m + e.exportMenuHeight > t && "top" !== k.alignOptions.verticalAlign ? a.bottom = t - c - C + "px" : a.top = c + m - C + "px"; y(g, a); e.openMenu = !0
            },
            addButton: function (b) {
                var a = this, d = a.renderer, c = n(a.options.navigation.buttonOptions, b), f = c.onclick, m = c.menuItems, k, e, h = c.symbolSize || 12; a.btnCount || (a.btnCount = 0); a.exportDivElements || (a.exportDivElements = [], a.exportSVGElements = []); if (!1 !== c.enabled) {
                    var l = c.theme, t = l.states, q = t && t.hover, t = t && t.select, g; a.styledMode || (l.fill = u(l.fill, "#ffffff"), l.stroke = u(l.stroke, "none")); delete l.states; f ? g = function (b) { b && b.stopPropagation(); f.call(a, b) } : m && (g = function (b) {
                        b && b.stopPropagation(); a.contextMenu(e.menuClassName,
                            m, e.translateX, e.translateY, e.width, e.height, e); e.setState(2)
                    }); c.text && c.symbol ? l.paddingLeft = u(l.paddingLeft, 25) : c.text || z(l, { width: c.width, height: c.height, padding: 0 }); a.styledMode || (l["stroke-linecap"] = "round", l.fill = u(l.fill, "#ffffff"), l.stroke = u(l.stroke, "none")); e = d.button(c.text, 0, 0, g, l, q, t).addClass(b.className).attr({ title: u(a.options.lang[c._titleKey || c.titleKey], "") }); e.menuClassName = b.menuClassName || "highcharts-menu-" + a.btnCount++; c.symbol && (k = d.symbol(c.symbol, c.symbolX - h / 2, c.symbolY -
                        h / 2, h, h, { width: h, height: h }).addClass("highcharts-button-symbol").attr({ zIndex: 1 }).add(e), a.styledMode || k.attr({ stroke: c.symbolStroke, fill: c.symbolFill, "stroke-width": c.symbolStrokeWidth || 1 })); e.add(a.exportingGroup).align(z(c, { width: e.width, x: u(c.x, a.buttonOffset) }), !0, "spacingBox"); a.buttonOffset += (e.width + c.buttonSpacing) * ("right" === c.align ? -1 : 1); a.exportSVGElements.push(e, k)
                }
            }, destroyExport: function (b) {
                var a = b ? b.target : this; b = a.exportSVGElements; var d = a.exportDivElements, c = a.exportEvents, h; b &&
                    (b.forEach(function (b, c) { b && (b.onclick = b.ontouchstart = null, h = "cache-" + b.menuClassName, a[h] && delete a[h], a.exportSVGElements[c] = b.destroy()) }), b.length = 0); a.exportingGroup && (a.exportingGroup.destroy(), delete a.exportingGroup); d && (d.forEach(function (b, c) { f.clearTimeout(b.hideTimer); D(b, "mouseleave"); a.exportDivElements[c] = b.onmouseout = b.onmouseover = b.ontouchstart = b.onclick = null; F(b) }), d.length = 0); c && (c.forEach(function (a) { a() }), c.length = 0)
            }
        }); H.prototype.inlineToAttributes = "fill stroke strokeLinecap strokeLinejoin strokeWidth textAnchor x y".split(" ");
        H.prototype.inlineBlacklist = [/-/, /^(clipPath|cssText|d|height|width)$/, /^font$/, /[lL]ogical(Width|Height)$/, /perspective/, /TapHighlightColor/, /^transition/, /^length$/]; H.prototype.unstyledElements = ["clipPath", "defs", "desc"]; B.prototype.inlineStyles = function () {
            function b(a) { return a.replace(/([A-Z])/g, function (a, b) { return "-" + b.toLowerCase() }) } function a(d) {
                function m(a, g) {
                    p = v = !1; if (h) { for (r = h.length; r-- && !v;)v = h[r].test(g); p = !v } "transform" === g && "none" === a && (p = !0); for (r = f.length; r-- && !p;)p = f[r].test(g) ||
                        "function" === typeof a; p || q[g] === a && "svg" !== d.nodeName || e[d.nodeName][g] === a || (-1 !== c.indexOf(g) ? d.setAttribute(b(g), a) : u += b(g) + ":" + a + ";")
                } var g, q, u = "", t, p, v, r; if (1 === d.nodeType && -1 === k.indexOf(d.nodeName)) {
                    g = A.getComputedStyle(d, null); q = "svg" === d.nodeName ? {} : A.getComputedStyle(d.parentNode, null); e[d.nodeName] || (x = l.getElementsByTagName("svg")[0], t = l.createElementNS(d.namespaceURI, d.nodeName), x.appendChild(t), e[d.nodeName] = n(A.getComputedStyle(t, null)), "text" === d.nodeName && delete e.text.fill, x.removeChild(t));
                    if (M || L) for (var w in g) m(g[w], w); else G(g, m); u && (g = d.getAttribute("style"), d.setAttribute("style", (g ? g + ";" : "") + u)); "svg" === d.nodeName && d.setAttribute("stroke-width", "1px"); "text" !== d.nodeName && [].forEach.call(d.children || d.childNodes, a)
                }
            } var d = this.renderer, c = d.inlineToAttributes, f = d.inlineBlacklist, h = d.inlineWhitelist, k = d.unstyledElements, e = {}, x, l, d = q.createElement("iframe"); y(d, { width: "1px", height: "1px", visibility: "hidden" }); q.body.appendChild(d); l = d.contentWindow.document; l.open(); l.write('\x3csvg xmlns\x3d"http://www.w3.org/2000/svg"\x3e\x3c/svg\x3e');
            l.close(); a(this.container.querySelector("svg")); x.parentNode.removeChild(x)
        }; J.menu = function (b, a, d, c) { return ["M", b, a + 2.5, "L", b + d, a + 2.5, "M", b, a + c / 2 + .5, "L", b + d, a + c / 2 + .5, "M", b, a + c - 1.5, "L", b + d, a + c - 1.5] }; J.menuball = function (b, a, d, c) { b = []; c = c / 3 - 2; return b = b.concat(this.circle(d - c, a, c, c), this.circle(d - c, a + c + 4, c, c), this.circle(d - c, a + 2 * (c + 4), c, c)) }; B.prototype.renderExporting = function () {
            var b = this, a = b.options.exporting, d = a.buttons, c = b.isDirtyExporting || !b.exportSVGElements; b.buttonOffset = 0; b.isDirtyExporting &&
                b.destroyExport(); c && !1 !== a.enabled && (b.exportEvents = [], b.exportingGroup = b.exportingGroup || b.renderer.g("exporting-group").attr({ zIndex: 3 }).add(), G(d, function (a) { b.addButton(a) }), b.isDirtyExporting = !1); r(b, "destroy", b.destroyExport)
        }; r(B, "init", function () { var b = this; b.exporting = { update: function (a, d) { b.isDirtyExporting = !0; n(!0, b.options.exporting, a); u(d, !0) && b.redraw() } }; h.addUpdate(function (a, d) { b.isDirtyExporting = !0; n(!0, b.options.navigation, a); u(d, !0) && b.redraw() }, b) }); B.prototype.callbacks.push(function (b) {
            b.renderExporting();
            r(b, "redraw", b.renderExporting)
        })
    })(h, D)
});
//# sourceMappingURL=exporting.js.map