/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

module.exports = function (e) {
    function t(o) {
        if (n[o]) return n[o].exports;
        var i = n[o] = {exports: {}, id: o, loaded: !1};
        return e[o].call(i.exports, i, i.exports, t), i.loaded = !0, i.exports
    }

    var n = {};
    return t.m = e, t.c = n, t.p = "", t(0)
}([function (e, t, n) {
    "use strict";

    function o(e) {
        return e && e.__esModule ? e : {default: e}
    }

    function i(e) {
        var t = m.getDataByKey("novi-plugin-google-map");
        return e.ui.editor[0].title = t.editor.mapSettingsTitle, e.ui.editor[0].tooltip = t.editor.mapSettingsTooltip, e.ui.editor[0].header[1] = p.createElement("span", null, t.editor.mapSettingsHeader), e.ui.editor[1].title = t.editor.markerSettingsTitle, e.ui.editor[1].tooltip = t.editor.markerSettingsTooltip, e.ui.editor[1].header[1] = p.createElement("span", null, t.editor.markerSettingsHeader), e
    }

    var l = n(1), a = o(l), r = n(4), s = o(r), u = n(6), c = o(u), p = novi.react.React, m = novi.language, g = {
        name: "novi-plugin-google-map",
        title: "Novi Google Map",
        description: "Novi Google Map description",
        version: "1.0.2",
        dependencies: {novi: "0.8.6"},
        defaults: {querySelector: ".google-map-container"},
        ui: {editor: [a.default, s.default], settings: p.createElement(c.default, null)},
        onLanguageChange: i
    };
    novi.plugins.register(g)
}, function (e, t, n) {
    "use strict";

    function o(e, t) {
        var n = t[0], o = {
            zoom: n.zoom,
            center: n.center,
            style: n.style,
            customStyle: n.customStyle,
            icon: n.icon,
            activeIcon: n.activeIcon,
            key: n.key
        }, i = !1;
        if (!novi.utils.lodash.isEqual(o, n.initData)) {
            novi.element.setAttribute(n.element, "data-zoom", n.zoom), n.element.setAttribute("data-zoom", n.zoom), novi.element.setAttribute(n.element, "data-center", n.center), n.element.setAttribute("data-center", n.center);
            switch (n.style.value) {
                case"custom":
                    novi.element.setAttribute(n.element, "data-styles", n.customStyle), n.element.setAttribute("data-styles", n.customStyle), n.customStyle;
                    break;
                case"default":
                    novi.element.removeAttribute(n.element, "data-styles"), n.element.removeAttribute("data-styleszoom"), "[]";
                    break;
                default:
                    novi.element.setAttribute(n.element, "data-styles", n.style.value), n.element.setAttribute("data-styles", n.style.value), n.style.value
            }
            if (n.key !== n.initData.key && (i = !0, n.key.length > 0 ? novi.element.setAttribute(n.element, "data-key", n.key) : novi.element.removeAttribute(n.element, "data-key")), n.icon !== n.initData.icon) {
                novi.element.setAttribute(n.element, "data-icon", n.icon), n.element.setAttribute("data-icon", n.icon);
                for (var l = n.element.querySelectorAll(".google-map-markers li"), a = 0; a < l.length; a++) novi.element.hasStaticReference(l[a]) && (novi.element.removeAttribute(l[a], "data-icon"), l[a].removeAttribute("data-icon"))
            }
            if (n.activeIcon !== n.initData.activeIcon) {
                novi.element.setAttribute(n.element, "data-icon-active", n.activeIcon), n.element.setAttribute("data-icon-active", n.activeIcon);
                for (var s = n.element.querySelectorAll(".google-map-markers li"), u = 0; u < s.length; u++) novi.element.hasStaticReference(s[u]) && (novi.element.removeAttribute(s[u], "data-icon-active"), s[u].removeAttribute("data-icon-active"))
            }
            if (n.element.map && n.element.geocoder && n.element.google && !i) {
                var c = n.element.map;
                if (n.zoom !== n.initData.zoom && c.setZoom(parseInt(n.zoom)), n.center !== n.initData.center && r.getLatLngObject(n.center, n.element.geocoder, n.element.google, function (e) {
                    c.setCenter(e)
                }), n.icon !== n.initData.icon) for (var p = n.element.querySelectorAll(".google-map-markers li"), m = 0; m < p.length; m++) novi.element.hasStaticReference(p[m]) && p[m].gmarker.setIcon(n.icon)
            } else novi.page.forceUpdate()
        }
    }

    Object.defineProperty(t, "__esModule", {value: !0});
    var i = n(2), l = function (e) {
        return e && e.__esModule ? e : {default: e}
    }(i), a = n(3), r = function (e) {
        if (e && e.__esModule) return e;
        var t = {};
        if (null != e) for (var n in e) Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
        return t.default = e, t
    }(a), s = novi.react.React, u = novi.ui.icon, c = novi.language, p = c.getDataByKey("novi-plugin-google-map"), m = {
        trigger: s.createElement(u, null, s.createElement("svg", {viewBox: "0 0 20 20"}, s.createElement("path", {d: "M17.071 2.929c-1.889-1.889-4.4-2.929-7.071-2.929s-5.182 1.040-7.071 2.929c-1.889 1.889-2.929 4.4-2.929 7.071s1.040 5.182 2.929 7.071c1.889 1.889 4.4 2.929 7.071 2.929s5.182-1.040 7.071-2.929c1.889-1.889 2.929-4.4 2.929-7.071s-1.040-5.182-2.929-7.071zM18.397 6.761c-0.195-0.351-0.685-0.518-1.325-0.736-0.687-0.234-0.93-0.94-1.211-1.758-0.244-0.71-0.496-1.443-1.095-1.899 1.639 1.027 2.924 2.567 3.631 4.393zM15.591 10.191c0.076 0.677 0.154 1.378-0.687 2.322-0.227 0.255-0.36 0.61-0.501 0.986-0.326 0.871-0.634 1.694-1.946 1.706-0.037-0.044-0.141-0.21-0.234-0.733-0.085-0.482-0.134-1.106-0.187-1.765-0.080-1.012-0.171-2.16-0.421-3.112-0.32-1.217-0.857-1.936-1.641-2.198-0.342-0.114-0.692-0.17-1.068-0.17-0.278 0-0.53 0.030-0.752 0.056-0.173 0.020-0.337 0.040-0.475 0.040 0 0-0 0-0 0-0.234 0-0.499 0-0.826-0.748-0.469-1.075-0.123-2.798 1.254-3.707 0.755-0.498 1.276-0.711 1.742-0.711 0.372 0 0.773 0.129 1.342 0.433 0.672 0.358 1.199 0.404 1.583 0.404 0.152 0 0.29-0.008 0.423-0.016 0.112-0.007 0.217-0.013 0.315-0.013 0.22 0 0.398 0.029 0.607 0.171 0.385 0.263 0.585 0.844 0.796 1.458 0.32 0.932 0.683 1.988 1.835 2.38 0.155 0.053 0.421 0.143 0.61 0.222-0.163 0.168-0.435 0.411-0.702 0.649-0.172 0.154-0.367 0.328-0.583 0.525-0.624 0.569-0.55 1.235-0.484 1.822zM1.001 9.923c0.108 0.019 0.224 0.042 0.344 0.067 0.562 0.12 0.825 0.228 0.94 0.289-0.053 0.103-0.16 0.255-0.231 0.355-0.247 0.351-0.555 0.788-0.438 1.269 0.079 0.325 0.012 0.723-0.103 1.091-0.332-0.938-0.513-1.946-0.513-2.996 0-0.026 0.001-0.051 0.001-0.077zM10 19c-3.425 0-6.41-1.924-7.93-4.747 0.262-0.499 0.748-1.603 0.521-2.569 0.016-0.097 0.181-0.331 0.28-0.472 0.271-0.385 0.608-0.863 0.358-1.37-0.175-0.356-0.644-0.596-1.566-0.804-0.214-0.048-0.422-0.087-0.599-0.118 0.536-4.455 4.338-7.919 8.935-7.919 1.578 0 3.062 0.409 4.352 1.125-0.319-0.139-0.608-0.161-0.84-0.161-0.127 0-0.253 0.007-0.375 0.015-0.119 0.007-0.242 0.014-0.364 0.014-0.284 0-0.638-0.034-1.112-0.287-0.724-0.385-1.266-0.55-1.812-0.55-0.676 0-1.362 0.262-2.293 0.876-0.805 0.531-1.411 1.343-1.707 2.288-0.289 0.921-0.258 1.864 0.087 2.654 0.407 0.932 0.944 1.348 1.742 1.348 0 0 0 0 0 0 0.197 0 0.389-0.023 0.592-0.047 0.205-0.024 0.416-0.049 0.635-0.049 0.271 0 0.51 0.038 0.751 0.118 0.439 0.147 0.763 0.639 0.991 1.504s0.314 1.966 0.391 2.936c0.064 0.81 0.124 1.574 0.257 2.151 0.081 0.35 0.185 0.616 0.32 0.813 0.201 0.294 0.489 0.456 0.811 0.456 0.884 0 1.59-0.285 2.099-0.847 0.423-0.467 0.639-1.044 0.813-1.508 0.102-0.273 0.208-0.556 0.311-0.672 1.137-1.277 1.020-2.329 0.934-3.098-0.063-0.564-0.064-0.764 0.164-0.972 0.212-0.193 0.405-0.366 0.575-0.518 0.363-0.324 0.625-0.558 0.809-0.758 0.126-0.138 0.422-0.461 0.34-0.865-0.001-0.004-0.002-0.007-0.002-0.011 0.343 0.951 0.53 1.976 0.53 3.044 0 4.963-4.037 9-9 9z"}))),
        tooltip: p.editor.mapSettingsTooltip,
        header: [s.createElement(u, null, s.createElement("svg", {viewBox: "0 0 20 20"}, s.createElement("path", {d: "M17.071 2.929c-1.889-1.889-4.4-2.929-7.071-2.929s-5.182 1.040-7.071 2.929c-1.889 1.889-2.929 4.4-2.929 7.071s1.040 5.182 2.929 7.071c1.889 1.889 4.4 2.929 7.071 2.929s5.182-1.040 7.071-2.929c1.889-1.889 2.929-4.4 2.929-7.071s-1.040-5.182-2.929-7.071zM18.397 6.761c-0.195-0.351-0.685-0.518-1.325-0.736-0.687-0.234-0.93-0.94-1.211-1.758-0.244-0.71-0.496-1.443-1.095-1.899 1.639 1.027 2.924 2.567 3.631 4.393zM15.591 10.191c0.076 0.677 0.154 1.378-0.687 2.322-0.227 0.255-0.36 0.61-0.501 0.986-0.326 0.871-0.634 1.694-1.946 1.706-0.037-0.044-0.141-0.21-0.234-0.733-0.085-0.482-0.134-1.106-0.187-1.765-0.080-1.012-0.171-2.16-0.421-3.112-0.32-1.217-0.857-1.936-1.641-2.198-0.342-0.114-0.692-0.17-1.068-0.17-0.278 0-0.53 0.030-0.752 0.056-0.173 0.020-0.337 0.040-0.475 0.040 0 0-0 0-0 0-0.234 0-0.499 0-0.826-0.748-0.469-1.075-0.123-2.798 1.254-3.707 0.755-0.498 1.276-0.711 1.742-0.711 0.372 0 0.773 0.129 1.342 0.433 0.672 0.358 1.199 0.404 1.583 0.404 0.152 0 0.29-0.008 0.423-0.016 0.112-0.007 0.217-0.013 0.315-0.013 0.22 0 0.398 0.029 0.607 0.171 0.385 0.263 0.585 0.844 0.796 1.458 0.32 0.932 0.683 1.988 1.835 2.38 0.155 0.053 0.421 0.143 0.61 0.222-0.163 0.168-0.435 0.411-0.702 0.649-0.172 0.154-0.367 0.328-0.583 0.525-0.624 0.569-0.55 1.235-0.484 1.822zM1.001 9.923c0.108 0.019 0.224 0.042 0.344 0.067 0.562 0.12 0.825 0.228 0.94 0.289-0.053 0.103-0.16 0.255-0.231 0.355-0.247 0.351-0.555 0.788-0.438 1.269 0.079 0.325 0.012 0.723-0.103 1.091-0.332-0.938-0.513-1.946-0.513-2.996 0-0.026 0.001-0.051 0.001-0.077zM10 19c-3.425 0-6.41-1.924-7.93-4.747 0.262-0.499 0.748-1.603 0.521-2.569 0.016-0.097 0.181-0.331 0.28-0.472 0.271-0.385 0.608-0.863 0.358-1.37-0.175-0.356-0.644-0.596-1.566-0.804-0.214-0.048-0.422-0.087-0.599-0.118 0.536-4.455 4.338-7.919 8.935-7.919 1.578 0 3.062 0.409 4.352 1.125-0.319-0.139-0.608-0.161-0.84-0.161-0.127 0-0.253 0.007-0.375 0.015-0.119 0.007-0.242 0.014-0.364 0.014-0.284 0-0.638-0.034-1.112-0.287-0.724-0.385-1.266-0.55-1.812-0.55-0.676 0-1.362 0.262-2.293 0.876-0.805 0.531-1.411 1.343-1.707 2.288-0.289 0.921-0.258 1.864 0.087 2.654 0.407 0.932 0.944 1.348 1.742 1.348 0 0 0 0 0 0 0.197 0 0.389-0.023 0.592-0.047 0.205-0.024 0.416-0.049 0.635-0.049 0.271 0 0.51 0.038 0.751 0.118 0.439 0.147 0.763 0.639 0.991 1.504s0.314 1.966 0.391 2.936c0.064 0.81 0.124 1.574 0.257 2.151 0.081 0.35 0.185 0.616 0.32 0.813 0.201 0.294 0.489 0.456 0.811 0.456 0.884 0 1.59-0.285 2.099-0.847 0.423-0.467 0.639-1.044 0.813-1.508 0.102-0.273 0.208-0.556 0.311-0.672 1.137-1.277 1.020-2.329 0.934-3.098-0.063-0.564-0.064-0.764 0.164-0.972 0.212-0.193 0.405-0.366 0.575-0.518 0.363-0.324 0.625-0.558 0.809-0.758 0.126-0.138 0.422-0.461 0.34-0.865-0.001-0.004-0.002-0.007-0.002-0.011 0.343 0.951 0.53 1.976 0.53 3.044 0 4.963-4.037 9-9 9z"}))), s.createElement("span", null, p.editor.mapSettingsHeader)],
        body: [s.createElement(l.default, null)],
        closeIcon: "submit",
        title: p.editor.mapSettingsTitle,
        onSubmit: o,
        width: 340,
        height: 340
    };
    t.default = m
}, function (e, t) {
    "use strict";

    function n(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }

    function o(e, t) {
        if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !t || "object" != typeof t && "function" != typeof t ? e : t
    }

    function i(e, t) {
        if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
        e.prototype = Object.create(t && t.prototype, {
            constructor: {
                value: e,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
    }

    Object.defineProperty(t, "__esModule", {value: !0});
    var l = function () {
            function e(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var o = t[n];
                    o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
                }
            }

            return function (t, n, o) {
                return n && e(t.prototype, n), o && e(t, o), t
            }
        }(), a = novi.ui.input, r = novi.ui.select, s = novi.react.Component, u = novi.react.React, c = novi.types,
        p = novi.ui.inputNumber, m = novi.language, g = novi.ui.icon, d = novi.ui.icons, y = function (e) {
            function t(e) {
                n(this, t);
                var i = o(this, (t.__proto__ || Object.getPrototypeOf(t)).call(this, e)),
                    l = novi.element.getAttribute(e.element, "data-zoom") || 11,
                    a = novi.element.getAttribute(e.element, "data-center") || "New York",
                    r = novi.element.getAttribute(e.element, "data-styles"),
                    s = novi.element.getAttribute(e.element, "data-icon"),
                    u = novi.element.getAttribute(e.element, "data-key"),
                    c = novi.element.getAttribute(e.element, "data-icon-active");
                i.iconKey = (new Date).getTime(), i.activeIconKey = i.iconKey + 1;
                var p = void 0, g = "";
                if (i._renderCustomStyleField = i._renderCustomStyleField.bind(i), i._handleStyleChange = i._handleStyleChange.bind(i), i.addAutoCompleteToInput = i.addAutoCompleteToInput.bind(i), i._showAutoComplete = i._showAutoComplete.bind(i), i._renderAutocompleteList = i._renderAutocompleteList.bind(i), i._handleZoomChange = i._handleZoomChange.bind(i), i.hideAutoCompleteBox = i.hideAutoCompleteBox.bind(i), i.onAutocompleteListItem = i.onAutocompleteListItem.bind(i), i._renderInfoIcon = i._renderInfoIcon.bind(i), i.messages = m.getDataByKey("novi-plugin-google-map"), i.styles = [{
                    label: i.messages.editor.mapSettingsBody.defaultStyle,
                    value: "default"
                }, {
                    label: "Ultra Light with Labels by hawasan",
                    value: '[{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]'
                }, {
                    label: "Subtle Grayscale by Paulo Avila",
                    value: '[{"featureType":"administrative","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"administrative.province","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"all","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","elementType":"all","stylers":[{"saturation":-100},{"lightness":"50"},{"visibility":"simplified"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":"-100"}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"lightness":"30"}]},{"featureType":"road.local","elementType":"all","stylers":[{"lightness":"40"}]},{"featureType":"transit","elementType":"all","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]},{"featureType":"water","elementType":"labels","stylers":[{"lightness":-25},{"saturation":-100}]}]'
                }, {
                    label: "Shades of Grey by Adam Krogh",
                    value: '[{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#000000"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]'
                }, {
                    label: "Blue water by Xavier",
                    value: '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#46bcec"},{"visibility":"on"}]}]'
                }, {
                    label: "Light dream by Roberta",
                    value: '[{"featureType":"landscape","stylers":[{"hue":"#FFBB00"},{"saturation":43.400000000000006},{"lightness":37.599999999999994},{"gamma":1}]},{"featureType":"road.highway","stylers":[{"hue":"#FFC200"},{"saturation":-61.8},{"lightness":45.599999999999994},{"gamma":1}]},{"featureType":"road.arterial","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":51.19999999999999},{"gamma":1}]},{"featureType":"road.local","stylers":[{"hue":"#FF0300"},{"saturation":-100},{"lightness":52},{"gamma":1}]},{"featureType":"water","stylers":[{"hue":"#0078FF"},{"saturation":-13.200000000000003},{"lightness":2.4000000000000057},{"gamma":1}]},{"featureType":"poi","stylers":[{"hue":"#00FF6A"},{"saturation":-1.0989010989011234},{"lightness":11.200000000000017},{"gamma":1}]}]'
                }, {
                    label: "Blue Essence by Famous Labs",
                    value: '[{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}]'
                }, {
                    label: "Pale Dawn by Adam Krogh",
                    value: '[{"featureType":"administrative","elementType":"all","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2e5d4"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{"featureType":"road","elementType":"all","stylers":[{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]}]'
                }, {
                    label: i.messages.editor.mapSettingsBody.customStyle,
                    value: "custom"
                }], i.projectDir = e.element.ownerDocument.head.querySelector("base").getAttribute("href"), r) {
                    for (var d = 0; d < i.styles.length; d++) if (i.styles[d].value === r) {
                        p = i.styles[d];
                        break
                    }
                } else p = i.styles[0];
                return p ? novi.editor.setBodyHeight(284) : (p = i.styles[i.styles.length - 1], g = r), i.commonIconStyles = {
                    width: 30,
                    height: 30,
                    display: "inline-block",
                    marginLeft: 10,
                    cursor: "pointer"
                }, i.componentStyle = "\n            .google-map-plugin-autocomplete-list{\n                list-style-type: none;\n                margin: 0;\n                padding: 0;\n                position: absolute;\n                top: 100%;\n                left: 0;\n                right: 0;\n                background: #181D27;\n                color: #fff;\n                z-index: 10;\n                padding: 4px 0;\n            }\n            \n            .google-map-plugin-autocomplete-list-item{\n                padding: 8px 10px;\n                white-space: nowrap;\n                box-sizing:border-box;\n                display: flex;\n                cursor: pointer;\n            }\n            \n                .google-map-plugin-autocomplete-list-item + .google-map-plugin-autocomplete-list-item{\n                border-top: 1px solid #000; \n            }\n            \n            .google-map-plugin-autocomplete-list-item:hover{\n                background: #109DF7;\n            }\n            \n            .google-map-plugin-icon{\n                display: inline-block;\n                width: 16px;\n                height: 16px;\n                fill: #fff;\n                margin-right: 5px;\n                flex-shrink: 0;\n            }\n            \n            .google-map-plugin-autocomplete-description{\n                display: inline-block;\n                max-width: 100%;\n                overflow: hidden;\n                text-overflow: ellipsis;\n            }\n            \n            .novi-plugin-google-map-warning{\n                \n            }\n            \n            .novi-plugin-google-map-warning-icon{\n                position: absolute;\n                right: 0;\n                top: 0;\n                width: 20px;\n                height: 20px;\n                cursor: pointer;\n            }\n            \n            .novi-plugin-google-map-warning-icon .novi-icon{\n                width: 16px;\n                height: 16px;\n            }\n            \n            \n            .novi-plugin-google-map-warning-message{\n                width: 100%;\n                position: absolute;\n                background: #1C222E;\n                z-index: 100;\n                left: 0;\n                color: #fff;\n                padding: 15px 10px;\n                box-sizing: border-box;\n                border: 1px solid #000;\n                border-radius: 3px;\n                opacity: 0;\n                pointer-events:none;\n                transition: .3s all ease;\n            }\n            \n            .novi-plugin-google-map-warning-message.active{\n                opacity: 1;\n                pointer-events:auto;\n            }\n            \n            .novi-plugin-google-map-warning-message-link{\n                color: #fff;\n            }\n            \n            .novi-plugin-google-map-warning-message-link:hover{\n                color: #109DF7;\n            }\n        ", i.autoCompleteService = new e.element.google.maps.places.AutocompleteService, i.state = {
                    zoom: l,
                    center: a,
                    customStyle: g,
                    style: p,
                    icon: s,
                    activeIcon: c,
                    key: u,
                    element: e.element,
                    initData: {zoom: l, center: a, customStyle: g, style: p, icon: s, activeIcon: c, key: u}
                }, i
            }

            return i(t, e), l(t, [{
                key: "render", value: function () {
                    return u.createElement("div", {
                        className: "google-map-plugin",
                        style: {
                            padding: "15px 12px",
                            display: "flex",
                            flexDirection: "column",
                            height: "100%",
                            color: "#6E778A",
                            boxSizing: "border-box",
                            position: "relative"
                        }
                    }, u.createElement("style", null, this.componentStyle), this._renderMapSettings())
                }
            }, {
                key: "_renderMapSettings", value: function () {
                    var e = this.state.icon ? novi.utils.isRelativeURL(this.state.icon) ? this.projectDir + this.state.icon : this.state.icon : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAoCAYAAAD6xArmAAAACXBIWXMAAA7DAAAOwwHHb6hkAAAEIElEQVR4nK2WUWgcVRSGj81FRx1kHqZ2hKksOkIoA2ZhA1vI4gYEs4KgSKhgfAiIT/VJfOpDCUWkfdHHUixIQVDykAehWTWyKwlmoQsVXDWUQUYywlRHuJVLmZq7jedMdkN2587uJO0PszPce+53z5xz7pllu7u7oFJ7ftbioXhLgnwFJJRxSO9NCWDQYsC+MSz9y9JyI1StZ8MDnfn5p4LQ/whAvmsahmYaJli6BkzTknkZx0Yo4rmIR3NRyD+uV6Y/s63COXd5+d9McKs263DBVxDouoXCPmxgga6DTZdl0iZax/PPBoFXFbXZN8qrDS8F3nitYgsuGgXbtp2CrQxPahPceMqdBM8PXD8IGsg4PfP1erAP9mq1J2IhVgq2ZTu2he8rc4H7ojVSSjuMwhVkveSsrt5NwL6I3tM0veTY+TxVaRLfEsNYIpYD8Cnz3qkZuNuFUs7XH6US5qXZ2bqAzM+Z74evGzpmA+MlDxmClJBBLGIyRJ2xDCPT9t6OhOu/3oLWH9vQvX8fXjhuwpsvngJTf1JpjxUFWP9nGBU/1WlWwr797RZcx6uv9vaf8OixR2BxekppbyPLQyYlTweWOieJOuFf8KO/nRr/5fbfyZxrPZ1etMfS6VdN7WkHX39YUjGWxjOIMQzpI0bqduFxNLkD9waGH5uYSOaU4aMxZJK3Hp591zL0lI174jjcFndhubMF3QPNqvjMiWROJWTRzaOINEUsXJBpMKl68iT8t9OFH3pVcQqr4tXnn0PPlOYgBDU/aOJx174IOT/rmKbScOIYQM15NrmG3jnDYw7EZDPfbbbqlWI74Lxkj6jnPAoiTtu1iZlUhMbYh34UNagdjimSEZLg8yhhQZ9Sbdxootd1L+Jzjnk0r70oIm/rLyNrH5x4Ddr7geA/FzBAqgY/0tc4hkCImBj9sX1wdX3TW6tMX+xwfn7KUicySz9hCPBAXCRGCkwq6OYlj4dv4+7OXrzHC21BxNJzDOvSwfEBMHX+oDK96HPesBimIaOH9EVtFm0lWi7S2kwwqbp+Y2OtUry8hbXtjkkk2tDtMq0ZnlO6pOvaUsTjBY6feiMjkREmDC+OBkuqeSW4vLoZYSKXPCE+mWJqsM/x6DK2RLa5wSRM5BVM5AcijrF3D5rxWIKQMsCEXclanwmmZPiV4tUgFucn2WCsw5i8havDCcsFJuFJuYZxPEffmIPjUSylrmnXRq0dCZ5pbP5eP11sI7xs9pJI3gI1Gpw7MjgxYOyrSCJY7plSfGls7LpxBvhvY43TR0Hb678cDwXmcu2BwTPrNzsYjgCrwCY0XgGNPTC4Z9SMpFzoP+dck8vqe/R4QfaeHxoY/31sJHFGGRqk+sKRweXGTQ/jzPvPDw3cs2zltj0UWEIuTw8NRsN/DgP+H7N336XO9W88AAAAAElFTkSuQmCC",
                        t = this.state.activeIcon ? novi.utils.isRelativeURL(this.state.activeIcon) ? this.projectDir + this.state.activeIcon : this.state.activeIcon : "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABYAAAAoCAYAAAD6xArmAAAACXBIWXMAAA7DAAAOwwHHb6hkAAAEIElEQVR4nK2WUWgcVRSGj81FRx1kHqZ2hKksOkIoA2ZhA1vI4gYEs4KgSKhgfAiIT/VJfOpDCUWkfdHHUixIQVDykAehWTWyKwlmoQsVXDWUQUYywlRHuJVLmZq7jedMdkN2587uJO0PszPce+53z5xz7pllu7u7oFJ7ftbioXhLgnwFJJRxSO9NCWDQYsC+MSz9y9JyI1StZ8MDnfn5p4LQ/whAvmsahmYaJli6BkzTknkZx0Yo4rmIR3NRyD+uV6Y/s63COXd5+d9McKs263DBVxDouoXCPmxgga6DTZdl0iZax/PPBoFXFbXZN8qrDS8F3nitYgsuGgXbtp2CrQxPahPceMqdBM8PXD8IGsg4PfP1erAP9mq1J2IhVgq2ZTu2he8rc4H7ojVSSjuMwhVkveSsrt5NwL6I3tM0veTY+TxVaRLfEsNYIpYD8Cnz3qkZuNuFUs7XH6US5qXZ2bqAzM+Z74evGzpmA+MlDxmClJBBLGIyRJ2xDCPT9t6OhOu/3oLWH9vQvX8fXjhuwpsvngJTf1JpjxUFWP9nGBU/1WlWwr797RZcx6uv9vaf8OixR2BxekppbyPLQyYlTweWOieJOuFf8KO/nRr/5fbfyZxrPZ1etMfS6VdN7WkHX39YUjGWxjOIMQzpI0bqduFxNLkD9waGH5uYSOaU4aMxZJK3Hp591zL0lI174jjcFndhubMF3QPNqvjMiWROJWTRzaOINEUsXJBpMKl68iT8t9OFH3pVcQqr4tXnn0PPlOYgBDU/aOJx174IOT/rmKbScOIYQM15NrmG3jnDYw7EZDPfbbbqlWI74Lxkj6jnPAoiTtu1iZlUhMbYh34UNagdjimSEZLg8yhhQZ9Sbdxootd1L+Jzjnk0r70oIm/rLyNrH5x4Ddr7geA/FzBAqgY/0tc4hkCImBj9sX1wdX3TW6tMX+xwfn7KUicySz9hCPBAXCRGCkwq6OYlj4dv4+7OXrzHC21BxNJzDOvSwfEBMHX+oDK96HPesBimIaOH9EVtFm0lWi7S2kwwqbp+Y2OtUry8hbXtjkkk2tDtMq0ZnlO6pOvaUsTjBY6feiMjkREmDC+OBkuqeSW4vLoZYSKXPCE+mWJqsM/x6DK2RLa5wSRM5BVM5AcijrF3D5rxWIKQMsCEXclanwmmZPiV4tUgFucn2WCsw5i8havDCcsFJuFJuYZxPEffmIPjUSylrmnXRq0dCZ5pbP5eP11sI7xs9pJI3gI1Gpw7MjgxYOyrSCJY7plSfGls7LpxBvhvY43TR0Hb678cDwXmcu2BwTPrNzsYjgCrwCY0XgGNPTC4Z9SMpFzoP+dck8vqe/R4QfaeHxoY/31sJHFGGRqk+sKRweXGTQ/jzPvPDw3cs2zltj0UWEIuTw8NRsN/DgP+H7N336XO9W88AAAAAElFTkSuQmCC",
                        n = Object.assign({}, this.commonIconStyles);
                    n.background = "url(" + e + ") center no-repeat / contain";
                    var o = Object.assign({}, this.commonIconStyles);
                    return o.background = "url(" + t + ") center no-repeat / contain", u.createElement("div", null, this._renderAPIInput(), u.createElement("div", {
                        className: "google-map-plugin-group",
                        style: {display: "flex", marginTop: 15}
                    }, u.createElement("div", {
                        className: "google-map-plugin-group-left",
                        style: {width: "75%", position: "relative"}
                    }, u.createElement("p", {
                        className: "novi-label",
                        style: {marginTop: "0"}
                    }, this.messages.editor.mapSettingsBody.mapCenter), u.createElement(a, {
                        key: "center",
                        id: "novi-plugin-google-map-center-input",
                        type: "text",
                        onChange: this._handleInputChange.bind(this, "center"),
                        onFocus: this.addAutoCompleteToInput,
                        value: this.state.center,
                        onBlur: this.hideAutoCompleteBox
                    }), this._renderAutocompleteList()), u.createElement("div", {
                        className: "google-map-plugin-group-right",
                        style: {width: "25%", marginLeft: "15px"}
                    }, u.createElement("p", {
                        className: "novi-label",
                        style: {marginTop: "0"}
                    }, this.messages.editor.mapSettingsBody.zoom), u.createElement(p, {
                        min: 0,
                        max: 18,
                        onlyInteger: !0,
                        onChange: this._handleZoomChange,
                        value: this.state.zoom
                    }))), u.createElement("p", {
                        className: "novi-label",
                        style: {marginTop: 15}
                    }, this.messages.editor.mapSettingsBody.style), u.createElement(r, {
                        searchable: !1,
                        clearable: !1,
                        options: this.styles,
                        onChange: this._handleStyleChange,
                        value: this.state.style
                    }), this._renderCustomStyleField(), u.createElement("div", {
                        className: "google-map-plugin-group",
                        style: {marginTop: 15, display: "flex", justifyContent: "space-between"}
                    }, u.createElement("div", {
                        className: "google-map-plugin-group-left",
                        style: {display: "flex", alignItems: "center", width: "50%"}
                    }, u.createElement("p", {
                        className: "novi-label",
                        style: {margin: "0", maxWidth: "70%"}
                    }, this.messages.editor.mapSettingsBody.markerIcon), u.createElement("span", {
                        key: this.iconKey,
                        style: n,
                        onClick: this.changeIcon.bind(this, "icon")
                    })), u.createElement("div", {
                        className: "google-map-plugin-group-right",
                        style: {display: "flex", alignItems: "center", width: "50%"}
                    }, u.createElement("p", {
                        className: "novi-label",
                        style: {margin: "0", maxWidth: "70%"}
                    }, this.messages.editor.mapSettingsBody.activeMarkerIcon), u.createElement("span", {
                        key: this.activeIconKey,
                        style: o,
                        onClick: this.changeIcon.bind(this, "activeIcon")
                    }))))
                }
            }, {
                key: "_renderAPIInput", value: function () {
                    var e = void 0 !== this.state.element.keySupported;
                    return u.createElement("div", {style: {position: "relative"}}, u.createElement("p", {
                        className: "novi-label",
                        style: {marginTop: 0}
                    }, this.messages.editor.mapSettingsBody.apiKey), !e && this._renderInfoIcon(), u.createElement(a, {
                        key: "center",
                        id: "novi-plugin-google-map-api-key-input",
                        type: "text",
                        disabled: !e,
                        title: "",
                        onChange: this._handleInputChange.bind(this, "key"),
                        value: this.state.key
                    }))
                }
            }, {
                key: "_renderInfoIcon", value: function () {
                    var e = this;
                    return u.createElement("div", {className: "novi-plugin-google-map-warning"}, u.createElement("div", {
                        className: "novi-plugin-google-map-warning-icon",
                        onClick: this.onInfoClick.bind(this)
                    }, u.createElement(g, null, d.ICON_QUESTION_CIRCLE)), u.createElement("div", {
                        ref: function (t) {
                            return e.infoMessage = t
                        }, className: "novi-plugin-google-map-warning-message"
                    }, "You need  update your Google Map initialization for use new feature. You can find it on", u.createElement("a", {
                        className: "novi-plugin-google-map-warning-message-link",
                        href: "https://github.com/NoviBuilder/novi-plugin-google-map",
                        target: "_blank"
                    }, " github")))
                }
            }, {
                key: "onInfoClick", value: function (e) {
                    this.infoMessage.classList.toggle("active")
                }
            }, {
                key: "_renderAutocompleteList", value: function () {
                    return this.state.autocomplete && this.state.autocomplete.results ? u.createElement("ul", {className: "google-map-plugin-autocomplete-list"}, this._renderAutocompleteListItem()) : null
                }
            }, {
                key: "_renderAutocompleteListItem", value: function () {
                    var e = this;
                    return this.state.autocomplete.results.map(function (t) {
                        return u.createElement("li", {
                            className: "google-map-plugin-autocomplete-list-item",
                            onMouseDown: e.onAutocompleteListItem
                        }, u.createElement("div", {className: "google-map-plugin-icon"}, u.createElement("svg", {viewBox: "0 0 20 20"}, u.createElement("path", {d: "M10 20c-0.153 0-0.298-0.070-0.393-0.191-0.057-0.073-1.418-1.814-2.797-4.385-0.812-1.513-1.46-2.999-1.925-4.416-0.587-1.787-0.884-3.472-0.884-5.008 0-3.308 2.692-6 6-6s6 2.692 6 6c0 1.536-0.298 3.22-0.884 5.008-0.465 1.417-1.113 2.903-1.925 4.416-1.38 2.571-2.74 4.312-2.797 4.385-0.095 0.121-0.24 0.191-0.393 0.191zM10 1c-2.757 0-5 2.243-5 5 0 3.254 1.463 6.664 2.691 8.951 0.902 1.681 1.809 3.014 2.309 3.71 0.502-0.699 1.415-2.040 2.318-3.726 1.223-2.283 2.682-5.687 2.682-8.935 0-2.757-2.243-5-5-5z"}), u.createElement("path", {d: "M10 9c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zM10 4c-1.103 0-2 0.897-2 2s0.897 2 2 2c1.103 0 2-0.897 2-2s-0.897-2-2-2z"}))), u.createElement("span", {className: "google-map-plugin-autocomplete-description"}, t.description))
                    })
                }
            }, {
                key: "onAutocompleteListItem", value: function (e) {
                    var t = e.target;
                    if ("LI" !== e.target.tagName) for (; "LI" !== t.tagName;) t = t.parentElement;
                    this.setState({center: t.querySelector(".google-map-plugin-autocomplete-description").innerHTML})
                }
            }, {
                key: "_showAutoComplete", value: function (e) {
                    if (!e) return null;
                    var t = e.value;
                    t.length > 2 && this.autoCompleteService.getQueryPredictions({input: t}, this._handleAutoCompleteData.bind(this, e))
                }
            }, {
                key: "_handleAutoCompleteData", value: function (e, t) {
                    this.setState({autocomplete: {input: e, results: t}})
                }
            }, {
                key: "addAutoCompleteToInput", value: function (e) {
                    this._showAutoComplete(e.target)
                }
            }, {
                key: "hideAutoCompleteBox", value: function () {
                    this.setState({autocomplete: null})
                }
            }, {
                key: "setBodyHeight", value: function (e) {
                    e ? novi.editor.setBodyHeight(340) : novi.editor.setBodyHeight(284)
                }
            }, {
                key: "_handleInputChange", value: function (e, t) {
                    var n = {};
                    if (n[e] = t.target.value, "customStyle" === e) {
                        var o = void 0;
                        try {
                            o = JSON.parse(t.target.value)
                        } catch (t) {
                            o = []
                        }
                        this.state.element.map && this.state.element.map.setOptions({styles: o})
                    }
                    this.setState(n), "center" === e && this._showAutoComplete(t.target)
                }
            }, {
                key: "_handleStyleChange", value: function (e) {
                    "custom" === e.value ? novi.editor.setBodyHeight(340) : "custom" === this.state.style.value && novi.editor.setBodyHeight(284);
                    var t = void 0;
                    switch (e.value) {
                        case"custom":
                            try {
                                t = JSON.parse(this.state.customStyle)
                            } catch (e) {
                                t = []
                            }
                            break;
                        case"default":
                            t = [];
                            break;
                        default:
                            t = JSON.parse(e.value)
                    }
                    this.state.element.map && this.state.element.map.setOptions({styles: t}), this.setState({style: e})
                }
            }, {
                key: "_handleZoomChange", value: function (e) {
                    this.state.element.map && this.state.element.map.setZoom(e), this.setState({zoom: e})
                }
            }, {
                key: "_renderCustomStyleField", value: function () {
                    return "custom" !== this.state.style.value ? null : u.createElement("div", {
                        className: "google-map-plugin-group",
                        style: {marginTop: 15}
                    }, u.createElement("p", {
                        className: "novi-label",
                        style: {marginTop: "0"}
                    }, "Custom Style:"), u.createElement(a, {
                        onChange: this._handleInputChange.bind(this, "customStyle"),
                        value: this.state.customStyle
                    }))
                }
            }, {
                key: "changeIcon", value: function (e) {
                    var t = this, n = void 0, o = void 0;
                    n = this.state[e], n ? (o = novi.utils.isRelativeURL(n) ? this.projectDir + n : n, this._loadImage(o).then(function (n) {
                        novi.media.choose({onSubmit: t.onSubmit.bind(t, e), ratio: n, type: c.mediaImage})
                    })) : novi.media.choose({onSubmit: this.onSubmit.bind(this, e), ratio: 1, type: c.mediaImage})
                }
            }, {
                key: "onSubmit", value: function (e, t) {
                    var n = {};
                    n[e] = t, this[e + "Key"] = (new Date).getTime(), this.setState(n)
                }
            }, {
                key: "_loadImage", value: function (e) {
                    return new Promise(function (t, n) {
                        var o = new Image;
                        o.src = e, o.onload = function (e) {
                            var n = e.target, o = n.naturalWidth, i = n.naturalHeight;
                            t(o / i)
                        }
                    })
                }
            }]), t
        }(s);
    t.default = y
}, function (e, t) {
    "use strict";

    function n(e, t, n, o, i) {
        var l = {};
        try {
            l = JSON.parse(e), o({lat: l.lat, lng: l.lng}, i)
        } catch (l) {
            t.geocode({address: e}, function (e, t) {
                if (t === n.maps.GeocoderStatus.OK) {
                    var l = e[0].geometry.location.lat(), a = e[0].geometry.location.lng();
                    o({lat: l, lng: a}, i)
                }
            })
        }
    }

    function o(e) {
        for (var t = e; !novi.utils.dom.hasNonEmptyTextNodes(t);) for (var n = 0; n < t.childNodes.length; n++) if (novi.utils.dom.hasNonEmptyTextNodes(t.childNodes[n])) {
            t = t.childNodes[n];
            break
        }
        for (var o = 0; o < t.childNodes.length; o++) if (novi.utils.dom.isNonEmptyTextNode(t.childNodes[o])) return t.childNodes[o];
        return null
    }

    Object.defineProperty(t, "__esModule", {value: !0}), t.getLatLngObject = n, t.getMarkerDescriptionNode = o
}, function (e, t, n) {
    "use strict";

    function o(e, t) {
        var n = t[0], o = n.markers.filter(function (e) {
            return e.location.length > 0
        });
        if (!novi.utils.lodash.isEqual(o, n.initMarkers)) {
            var i = !1, a = n.element.querySelectorAll(".google-map-markers li"), r = void 0, s = [];
            for (r = 0; r < a.length; r++) o[r] && o[r].location ? (novi.element.setAttribute(a[r], "data-location", o[r].location), a[r].setAttribute("data-location", o[r].location), o[r].description.length ? (novi.element.setAttribute(a[r], "data-description", o[r].description), a[r].setAttribute("data-description", o[r].description)) : (novi.element.removeAttribute(a[r], "data-description"), a[r].removeAttribute("data-description"))) : (s.push(a[r]), i = !0);
            for (r = 0; r < s.length; r++) novi.element.remove(s[r]);
            if (o.length > a.length) {
                i = !0;
                var u = novi.element.getStaticReference(n.element.querySelector(".google-map-markers")), c = void 0;
                for (r = a.length; r < o.length; r++) c = u.ownerDocument.createElement("li"), c.setAttribute("data-location", o[r].location), o[r].description.length && c.setAttribute("data-description", o[r].description), novi.element.appendStatic(c, u)
            }
            if (!i && n.element.map && n.element.geocoder && n.element.google) {
                if (o.length === n.initMarkers.length) for (var p = n.element.querySelectorAll(".google-map-markers li"), m = 0; m < p.length; m++) p[m].infoWindow.setContent(o[m].description), l.getLatLngObject(o[m].location, n.element.geocoder, n.element.google, function (e, t) {
                    t.gmarker.setPosition(e)
                }, p[m])
            } else novi.page.forceUpdate()
        }
    }

    Object.defineProperty(t, "__esModule", {value: !0});
    var i = n(3), l = function (e) {
        if (e && e.__esModule) return e;
        var t = {};
        if (null != e) for (var n in e) Object.prototype.hasOwnProperty.call(e, n) && (t[n] = e[n]);
        return t.default = e, t
    }(i), a = n(5), r = function (e) {
        return e && e.__esModule ? e : {default: e}
    }(a), s = novi.react.React, u = novi.ui.icon, c = novi.language, p = c.getDataByKey("novi-plugin-google-map"), m = {
        trigger: s.createElement(u, null, s.createElement("svg", {viewBox: "0 0 20 20"}, s.createElement("path", {d: "M10 20c-0.153 0-0.298-0.070-0.393-0.191-0.057-0.073-1.418-1.814-2.797-4.385-0.812-1.513-1.46-2.999-1.925-4.416-0.587-1.787-0.884-3.472-0.884-5.008 0-3.308 2.692-6 6-6s6 2.692 6 6c0 1.536-0.298 3.22-0.884 5.008-0.465 1.417-1.113 2.903-1.925 4.416-1.38 2.571-2.74 4.312-2.797 4.385-0.095 0.121-0.24 0.191-0.393 0.191zM10 1c-2.757 0-5 2.243-5 5 0 3.254 1.463 6.664 2.691 8.951 0.902 1.681 1.809 3.014 2.309 3.71 0.502-0.699 1.415-2.040 2.318-3.726 1.223-2.283 2.682-5.687 2.682-8.935 0-2.757-2.243-5-5-5z"}), s.createElement("path", {d: "M10 9c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zM10 4c-1.103 0-2 0.897-2 2s0.897 2 2 2c1.103 0 2-0.897 2-2s-0.897-2-2-2z"}))),
        tooltip: p.editor.markerSettingsTooltip,
        header: [s.createElement(u, null, s.createElement("svg", {viewBox: "0 0 20 20"}, s.createElement("path", {d: "M10 20c-0.153 0-0.298-0.070-0.393-0.191-0.057-0.073-1.418-1.814-2.797-4.385-0.812-1.513-1.46-2.999-1.925-4.416-0.587-1.787-0.884-3.472-0.884-5.008 0-3.308 2.692-6 6-6s6 2.692 6 6c0 1.536-0.298 3.22-0.884 5.008-0.465 1.417-1.113 2.903-1.925 4.416-1.38 2.571-2.74 4.312-2.797 4.385-0.095 0.121-0.24 0.191-0.393 0.191zM10 1c-2.757 0-5 2.243-5 5 0 3.254 1.463 6.664 2.691 8.951 0.902 1.681 1.809 3.014 2.309 3.71 0.502-0.699 1.415-2.040 2.318-3.726 1.223-2.283 2.682-5.687 2.682-8.935 0-2.757-2.243-5-5-5z"}), s.createElement("path", {d: "M10 9c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zM10 4c-1.103 0-2 0.897-2 2s0.897 2 2 2c1.103 0 2-0.897 2-2s-0.897-2-2-2z"}))), s.createElement("span", null, p.editor.markerSettingsHeader)],
        body: [s.createElement(r.default, null)],
        closeIcon: "submit",
        title: p.editor.markerSettingsTitle,
        onSubmit: o,
        width: 540,
        height: 230
    };
    t.default = m
}, function (e, t) {
    "use strict";

    function n(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }

    function o(e, t) {
        if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !t || "object" != typeof t && "function" != typeof t ? e : t
    }

    function i(e, t) {
        if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
        e.prototype = Object.create(t && t.prototype, {
            constructor: {
                value: e,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
    }

    Object.defineProperty(t, "__esModule", {value: !0});
    var l = function () {
            function e(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var o = t[n];
                    o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
                }
            }

            return function (t, n, o) {
                return n && e(t.prototype, n), o && e(t, o), t
            }
        }(), a = novi.ui.input, r = novi.react.Component, s = novi.react.React, u = novi.ui.button, c = novi.language,
        p = function (e) {
            function t(e) {
                n(this, t);
                var i = o(this, (t.__proto__ || Object.getPrototypeOf(t)).call(this, e));
                i._renderMarkerSettings = i._renderMarkerSettings.bind(i), i._renderMarkers = i._renderMarkers.bind(i), i.addMarker = i.addMarker.bind(i), i.removeMarker = i.removeMarker.bind(i), i.addAutoCompleteToInput = i.addAutoCompleteToInput.bind(i), i._showAutoComplete = i._showAutoComplete.bind(i), i._renderAutocompleteList = i._renderAutocompleteList.bind(i), i.hideAutoCompleteBox = i.hideAutoCompleteBox.bind(i), i.onAutocompleteListItem = i.onAutocompleteListItem.bind(i), i.projectDir = e.element.ownerDocument.head.querySelector("base").getAttribute("href");
                var l = e.element.querySelectorAll(".google-map-markers li"), a = [];
                if (l.length) for (var r = 0; r < l.length; r++) l[r].getAttribute("data-location").length && a.push({
                    location: l[r].getAttribute("data-location"),
                    description: l[r].getAttribute("data-description") || ""
                });
                0 === a.length && a.push({
                    location: "",
                    description: ""
                }), i.componentStyle = "\n            .google-map-plugin-markers{\n                max-height: 153px;\n                overflow-y: scroll;\n                background: #181D27;\n                padding: 10px 5px 10px 13px;\n                box-sizing: border-box;\n            }\n\n            .google-map-plugin-markers::-webkit-scrollbar {\n              width: 8px;\n              height: 8px;\n              background: #181D27; }\n\n            .google-map-plugin-markers::-webkit-scrollbar-thumb {\n              height: 6px;\n              width: 6px;\n              border: 2px solid transparent;\n              background-clip: padding-box;\n              -webkit-border-radius: 4px;\n              background-color: #109DF7; \n            }\n            \n            .google-map-plugin-marker {\n                position: relative;\n            }\n            \n            .google-map-plugin-marker + .google-map-plugin-marker{\n                padding-top: 10px;\n                margin-top: 10px;\n                border-top: 1px solid #111419;\n            }\n            \n            .google-map-plugin-markers .novi-input input{\n                background: #111419; \n            }\n            .google-map-plugin-markers .novi-input + .novi-input{\n                margin-left: 15px;\n            }\n            \n            .google-map-plugin-marker-remove{\n                width: 40px;\n                text-align: center;\n                cursor: pointer;\n                flex-shrink: 0;\n                z-index: 1;\n                margin-top: 22px;\n            }\n            \n            .google-map-plugin-autocomplete-list{\n                list-style-type: none;\n                margin: 0;\n                padding: 0;\n                position: absolute;\n                top: 100%;\n                left: 0;\n                right: 0;\n                background: #181D27;\n                color: #fff;\n                z-index: 10;\n                padding: 4px 0;\n            }\n            \n            .google-map-plugin-autocomplete-list-item{\n                padding: 8px 10px;\n                white-space: nowrap;\n                box-sizing:border-box;\n                display: flex;\n                cursor: pointer;\n            }\n            \n            .google-map-plugin-autocomplete-list-item + .google-map-plugin-autocomplete-list-item{\n                border-top: 1px solid #000; \n            }\n            \n            .google-map-plugin-autocomplete-list-item:hover{\n                background: #109DF7;\n            }\n            \n            .google-map-plugin-icon{\n                display: inline-block;\n                width: 16px;\n                height: 16px;\n                fill: #fff;\n                margin-right: 5px;\n                flex-shrink: 0;\n            }\n            \n            .google-map-plugin-autocomplete-description{\n                display: inline-block;\n                max-width: 100%;\n                overflow: hidden;\n                text-overflow: ellipsis;\n            }\n            \n            .google-map-plugin-marker-address, .google-map-plugin-marker-description{\n                width: 50%;\n            }\n            \n            .google-map-plugin-marker-description{\n                margin-left: 15px;\n            }\n        ", i.autoCompleteService = new e.element.google.maps.places.AutocompleteService, i.setBodyHeightByMarkerLength(a), i.interval = null, i.markerKey = (new Date).getTime();
                var s = [];
                for (var u in a) {
                    var p = Object.assign({}, a[u]);
                    s.push(p)
                }
                return i.state = {
                    element: e.element,
                    markers: a,
                    initMarkers: s
                }, i.messages = c.getDataByKey("novi-plugin-google-map"), i
            }

            return i(t, e), l(t, [{
                key: "render", value: function () {
                    return s.createElement("div", {
                        className: "google-map-plugin",
                        style: {
                            padding: "15px 12px",
                            display: "flex",
                            flexDirection: "column",
                            height: "100%",
                            color: "#6E778A",
                            boxSizing: "border-box",
                            position: "relative"
                        }
                    }, s.createElement("style", null, this.componentStyle), this._renderMarkerSettings(), this._renderAutocompleteList())
                }
            }, {
                key: "_renderAutocompleteList", value: function () {
                    if (!this.state.autocomplete || !this.state.autocomplete.results) return null;
                    var e = this.getPositionByInput(this.state.autocomplete.input);
                    return s.createElement("ul", {
                        style: e,
                        className: "google-map-plugin-autocomplete-list"
                    }, this._renderAutocompleteListItem())
                }
            }, {
                key: "_renderAutocompleteListItem", value: function () {
                    var e = this;
                    return this.state.autocomplete.results.map(function (t) {
                        return s.createElement("li", {
                            className: "google-map-plugin-autocomplete-list-item",
                            onMouseDown: e.onAutocompleteListItem
                        }, s.createElement("div", {className: "google-map-plugin-icon"}, s.createElement("svg", {viewBox: "0 0 20 20"}, s.createElement("path", {d: "M10 20c-0.153 0-0.298-0.070-0.393-0.191-0.057-0.073-1.418-1.814-2.797-4.385-0.812-1.513-1.46-2.999-1.925-4.416-0.587-1.787-0.884-3.472-0.884-5.008 0-3.308 2.692-6 6-6s6 2.692 6 6c0 1.536-0.298 3.22-0.884 5.008-0.465 1.417-1.113 2.903-1.925 4.416-1.38 2.571-2.74 4.312-2.797 4.385-0.095 0.121-0.24 0.191-0.393 0.191zM10 1c-2.757 0-5 2.243-5 5 0 3.254 1.463 6.664 2.691 8.951 0.902 1.681 1.809 3.014 2.309 3.71 0.502-0.699 1.415-2.040 2.318-3.726 1.223-2.283 2.682-5.687 2.682-8.935 0-2.757-2.243-5-5-5z"}), s.createElement("path", {d: "M10 9c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zM10 4c-1.103 0-2 0.897-2 2s0.897 2 2 2c1.103 0 2-0.897 2-2s-0.897-2-2-2z"}))), s.createElement("span", {className: "google-map-plugin-autocomplete-description"}, t.description))
                    })
                }
            }, {
                key: "onAutocompleteListItem", value: function (e) {
                    var t = e.target;
                    if ("LI" !== e.target.tagName) for (; "LI" !== t.tagName;) t = t.parentElement;
                    var n = this.state.markers.slice(0);
                    n[this.state.autocomplete.index].location = t.querySelector(".google-map-plugin-autocomplete-description").innerHTML, this.setState({markers: n})
                }
            }, {
                key: "_showAutoComplete", value: function (e, t) {
                    if (!e) return null;
                    var n = e.value;
                    n.length > 2 && this.autoCompleteService.getQueryPredictions({input: n}, this._handleAutoCompleteData.bind(this, e, t))
                }
            }, {
                key: "hideAutoCompleteBox", value: function () {
                    this.state.autocomplete && this.setState({autocomplete: null})
                }
            }, {
                key: "getPositionByInput", value: function (e) {
                    for (var t = e; !t.classList.contains("google-map-plugin");) t = t.parentElement;
                    var n = t.getBoundingClientRect(), o = e.getBoundingClientRect();
                    return {top: o.top - n.top + 28, left: o.left - n.left, width: o.width}
                }
            }, {
                key: "_renderMarkerSettings", value: function () {
                    return this.state.mapSettings ? null : s.createElement("div", null, s.createElement("p", {
                        className: "novi-label",
                        style: {marginTop: "0"}
                    }, this.messages.editor.markerSettingsBody.markers), s.createElement("div", {
                        className: "google-map-plugin-markers",
                        onScroll: this.hideAutoCompleteBox
                    }, this._renderMarkers()), s.createElement("div", {style: {textAlign: "right"}}, s.createElement(u, {
                        onClick: this.addMarker,
                        messages: {textContent: this.messages.editor.markerSettingsBody.addMarkerText},
                        style: {marginRight: -10}
                    })))
                }
            }, {
                key: "_renderMarkers", value: function () {
                    var e = this;
                    return this.state.markers.map(function (t, n) {
                        return s.createElement("div", {
                            key: e.markerKey + "-" + n,
                            style: {display: "flex", alignItems: "center", justifyContent: "space-between"},
                            className: "google-map-plugin-marker"
                        }, s.createElement("div", {className: "google-map-plugin-marker-address"}, s.createElement("p", {
                            className: "novi-label",
                            style: {marginTop: "0"}
                        }, e.messages.editor.markerSettingsBody.markerLocation), s.createElement(a, {
                            type: "text",
                            onChange: e._handleMarkerChange.bind(e, "location", n),
                            value: t.location,
                            onFocus: e.addAutoCompleteToInput.bind(e, n),
                            onBlur: e.hideAutoCompleteBox,
                            placeholder: "Type location..."
                        })), s.createElement("div", {className: "google-map-plugin-marker-description"}, s.createElement("p", {
                            className: "novi-label",
                            style: {marginTop: "0"}
                        }, e.messages.editor.markerSettingsBody.markerDescription), s.createElement(a, {
                            type: "text",
                            onChange: e._handleMarkerChange.bind(e, "description", n),
                            value: t.description,
                            placeholder: "Type description..."
                        })), s.createElement("div", {
                            className: "google-map-plugin-marker-remove",
                            onClick: e.removeMarker.bind(e, n)
                        }, s.createElement("svg", {
                            viewBox: "0 0 20 20",
                            style: {width: 10, height: 10, display: "inline-block", fill: "#fff"}
                        }, s.createElement("path", {d: "M10.707 10.5l8.646-8.646c0.195-0.195 0.195-0.512 0-0.707s-0.512-0.195-0.707 0l-8.646 8.646-8.646-8.646c-0.195-0.195-0.512-0.195-0.707 0s-0.195 0.512 0 0.707l8.646 8.646-8.646 8.646c-0.195 0.195-0.195 0.512 0 0.707 0.098 0.098 0.226 0.146 0.354 0.146s0.256-0.049 0.354-0.146l8.646-8.646 8.646 8.646c0.098 0.098 0.226 0.146 0.354 0.146s0.256-0.049 0.354-0.146c0.195-0.195 0.195-0.512 0-0.707l-8.646-8.646z"}))))
                    })
                }
            }, {
                key: "_handleAutoCompleteData", value: function (e, t, n) {
                    this.setState({autocomplete: {input: e, results: n, index: t}})
                }
            }, {
                key: "addAutoCompleteToInput", value: function (e, t) {
                    this._showAutoComplete(t.target, e)
                }
            }, {
                key: "setBodyHeightByMarkerLength", value: function (e) {
                    switch (e.length) {
                        case 1:
                            novi.editor.setBodyHeight(153);
                            break;
                        default:
                            novi.editor.setBodyHeight(228)
                    }
                }
            }, {
                key: "_handleMarkerChange", value: function (e, t, n) {
                    var o = this.state.markers.slice(0);
                    o[t][e] = n.target.value, this.setState({markers: o}), "location" === e && this._showAutoComplete(n.target, t)
                }
            }, {
                key: "addMarker", value: function () {
                    var e = this.state.markers.slice(0);
                    e.push({
                        location: "",
                        description: ""
                    }), this.markerKey = (new Date).getTime(), this.setState({markers: e}), this.setBodyHeightByMarkerLength(e)
                }
            }, {
                key: "removeMarker", value: function (e) {
                    var t = this.state.markers.slice(0);
                    if (1 === t.length) {
                        if (!t[0].location.length && !t[0].description.length) return;
                        return t[0].location = "", t[0].description = "", this.setState({markers: t})
                    }
                    this.markerKey = (new Date).getTime(), t.splice(e, 1), this.setState({markers: t}), this.setBodyHeightByMarkerLength(t)
                }
            }]), t
        }(r);
    t.default = p
}, function (e, t) {
    "use strict";

    function n(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }

    function o(e, t) {
        if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !t || "object" != typeof t && "function" != typeof t ? e : t
    }

    function i(e, t) {
        if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function, not " + typeof t);
        e.prototype = Object.create(t && t.prototype, {
            constructor: {
                value: e,
                enumerable: !1,
                writable: !0,
                configurable: !0
            }
        }), t && (Object.setPrototypeOf ? Object.setPrototypeOf(e, t) : e.__proto__ = t)
    }

    Object.defineProperty(t, "__esModule", {value: !0});
    var l = function () {
            function e(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var o = t[n];
                    o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
                }
            }

            return function (t, n, o) {
                return n && e(t.prototype, n), o && e(t, o), t
            }
        }(), a = novi.react.React, r = novi.react.Component, s = novi.ui.input, u = novi.ui.button, c = novi.language,
        p = function (e) {
            function t(e) {
                n(this, t);
                var i = o(this, (t.__proto__ || Object.getPrototypeOf(t)).call(this));
                return i.state = {settings: e.settings}, i.saveSettings = i.saveSettings.bind(i), i.onChange = i.onChange.bind(i), i.messages = c.getDataByKey("novi-plugin-google-map"), i
            }

            return i(t, e), l(t, [{
                key: "componentWillReceiveProps", value: function (e) {
                    this.setState({settings: e.settings})
                }
            }, {
                key: "render", value: function () {
                    return a.createElement("div", null, a.createElement("span", {style: {letterSpacing: "0,0462em"}}, "Google Map Plugin"), a.createElement("div", {
                        style: {
                            fontSize: 13,
                            color: "#6E778A",
                            marginTop: 21
                        }
                    }, this.messages.settings.inputPlaceholder), a.createElement(s, {
                        style: {marginTop: 10, width: 340},
                        value: this.state.settings.querySelector,
                        onChange: this.onChange
                    }), a.createElement("div", {style: {marginTop: 30}}, a.createElement(u, {
                        type: "primary",
                        messages: {textContent: this.messages.settings.submitButton},
                        onClick: this.saveSettings
                    })))
                }
            }, {
                key: "onChange", value: function (e) {
                    var t = e.target.value;
                    this.setState({settings: {querySelector: t}})
                }
            }, {
                key: "saveSettings", value: function () {
                    novi.plugins.settings.update("novi-plugin-google-map", this.state.settings)
                }
            }]), t
        }(r);
    t.default = p
}]);
