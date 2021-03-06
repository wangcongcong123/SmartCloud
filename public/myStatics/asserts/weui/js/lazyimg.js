"use strict";
var _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (t) {
    return typeof t
} : function (t) {
    return t && "function" == typeof Symbol && t.constructor === Symbol ? "symbol" : typeof t
};
!function (t) {
    "function" == typeof define && "object" === _typeof(define.amd) && define.amd ? define(t) : "undefined" != typeof module && module.exports ? module.exports = t() : window.LazyloadImg = t()
}(function () {
    function t(t) {
        var e = this;
        this.el = "[data-src]", this.top = 0, this.right = 0, this.bottom = 0, this.left = 0, this.before = function () {
        }, this.load = function (t) {
        }, this.error = function (t) {
        }, this.qriginal = !1, this.monitorEvent = ["DOMContentLoaded", "load", "click", "touchstart", "touchend", "haschange", "online", "pageshow", "popstate", "resize", "storage", "mousewheel", "scroll"];
        for (var n in t)this[n] = t[n];
        this.init = function () {
            e.createStyle(), e.src = function () {
                return /\[data-([a-z]+)\]$/.exec(e.el)[1] || "src"
            }(), e.start()
        }, this.createStyle = function () {
            var t = document.getElementById("LazyloadImg-style");
            return t ? !1 : (t = document.createElement("style"), t.id = "LazyloadImg-style", t.type = "text/css", t.innerHTML = "                .LazyloadImg-qriginal {                    -webkit-transition: none!important;                    -moz-transition: none!important;                    -o-transition: none!important;                    transition: none!important;                    background-size: cover!important;                    background-position: center center!important;                    background-repeat: no-repeat!important;                }            ", void document.querySelector("head").appendChild(t))
        }, this.start = function () {
            for (var t = e.monitorEvent, n = 0; n < t.length; n++)window.addEventListener(t[n], e.eachDOM, !1);
            e.eachDOM()
        }, this.eachDOM = function () {
            for (var t = document.querySelectorAll(e.el), n = [], o = 0; o < t.length; o++)e.testMeet(t[o]) === !0 && n.push(t[o]);
            for (var r = 0; r < n.length; r++)e.loadImg(n[r])
        }, this.testMeet = function (t) {
            var n = t.getBoundingClientRect(), o = t.offsetWidth, r = t.offsetHeight, i = window.innerWidth, a = window.innerHeight, s = !(n.right - e.left <= 0 && n.left + o - e.left <= 0 || n.left + e.right >= i && n.right + e.right >= o + i), c = !(n.bottom - e.top <= 0 && n.top + r - e.top <= 0 || n.top + e.bottom >= a && n.bottom + e.bottom >= r + a);
            return !(0 == t.width || 0 == t.height || !s || !c)
        }, this.loadImg = function (t) {
            var n = t.dataset[e.src], o = new Image;
            o.src = n, e.before.call(e, t), o.addEventListener("load", function () {
                return e.qriginal ? (t.src = e.getTransparent(t.src, t.width, t.height), t.className += " LazyloadImg-qriginal", t.style.backgroundImage = "url(" + o.src + ")") : t.src = o.src, delete t.dataset[e.src], e.load.call(e, t)
            }, !1), o.addEventListener("error", function () {
                return e.error.call(e, t)
            }, !1)
        }, this.getTransparent = function () {
            var t = document.createElement("canvas");
            t.getContext("2d").globalAlpha = 0;
            var e = {};
            return function (n, o, r) {
                if (e[n])return e[n];
                t.width = o, t.height = r;
                var i = t.toDataURL("image/png");
                return e[n] = i, i
            }
        }(), this.end = function () {
            for (var t = e.monitorEvent, n = 0; n < t.length; n++)window.removeEventListener(t[n], e.eachDOM, !1)
        }, this.init()
    }

    return t
});
