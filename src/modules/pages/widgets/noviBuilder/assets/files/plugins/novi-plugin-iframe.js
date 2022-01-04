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
        var r = n[o] = {exports: {}, id: o, loaded: !1};
        return e[o].call(r.exports, r, r.exports, t), r.loaded = !0, r.exports
    }

    var n = {};
    return t.m = e, t.c = n, t.p = "", t(0)
}([function (e, t, n) {
    "use strict";

    function o(e) {
        return e && e.__esModule ? e : {default: e}
    }

    function r(e) {
        var t = s.getDataByKey("novi-plugin-iframe");
        return e.ui.editor[0].title = t.editor.title, e.ui.editor[0].tooltip = t.editor.tooltip, e
    }

    var i = n(1), a = o(i), u = n(4), l = o(u), c = novi.react.React, s = novi.language, f = {
        name: "novi-plugin-iframe",
        title: "Novi Iframe",
        description: "Novi Iframe description",
        version: "1.0.3",
        dependencies: {novi: "0.8.6"},
        defaults: {querySelector: "iframe[src]"},
        ui: {editor: [a.default], settings: c.createElement(l.default, null)},
        onLanguageChange: r
    };
    novi.plugins.register(f)
}, function (e, t, n) {
    "use strict";

    function o(e) {
        return e && e.__esModule ? e : {default: e}
    }

    function r(e, t) {
        e[0].src !== e[0].oldSrc && novi.element.setAttribute(e[0].element, "src", e[0].src)
    }

    Object.defineProperty(t, "__esModule", {value: !0});
    var i = n(2), a = o(i), u = n(3), l = o(u), c = novi.react.React,
        s = novi.language.getDataByKey("novi-plugin-iframe"), f = {
            trigger: c.createElement(a.default, null),
            tooltip: s.editor.tooltip,
            header: [c.createElement(l.default, null)],
            closeIcon: "submit",
            width: 300,
            onSubmit: r,
            title: s.editor.title
        };
    t.default = f
}, function (e, t) {
    "use strict";

    function n(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }

    function o(e, t) {
        if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !t || "object" != typeof t && "function" != typeof t ? e : t
    }

    function r(e, t) {
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
    var i = function () {
        function e(e, t) {
            for (var n = 0; n < t.length; n++) {
                var o = t[n];
                o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
            }
        }

        return function (t, n, o) {
            return n && e(t.prototype, n), o && e(t, o), t
        }
    }(), a = novi.ui.icon, u = novi.ui.icons, l = novi.react.React, c = novi.react.Component, s = function (e) {
        function t() {
            return n(this, t), o(this, (t.__proto__ || Object.getPrototypeOf(t)).call(this))
        }

        return r(t, e), i(t, [{
            key: "render", value: function () {
                return l.createElement(a, null, u.ICON_IFRAME)
            }
        }]), t
    }(c);
    t.default = s
}, function (e, t) {
    "use strict";

    function n(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }

    function o(e, t) {
        if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !t || "object" != typeof t && "function" != typeof t ? e : t
    }

    function r(e, t) {
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
    var i = function () {
            function e(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var o = t[n];
                    o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
                }
            }

            return function (t, n, o) {
                return n && e(t.prototype, n), o && e(t, o), t
            }
        }(), a = novi.ui.icon, u = novi.ui.input, l = novi.ui.icons, c = novi.react.React, s = novi.react.Component,
        f = function (e) {
            function t(e) {
                n(this, t);
                var r = o(this, (t.__proto__ || Object.getPrototypeOf(t)).call(this)),
                    i = novi.element.getAttribute(e.element, "src");
                return r.state = {
                    src: i,
                    oldSrc: i,
                    element: e.element
                }, r._handleLinkChange = r._handleLinkChange.bind(r), r
            }

            return r(t, e), i(t, [{
                key: "render", value: function () {
                    return c.createElement("div", {
                        className: "novi-iframe-tool",
                        style: {display: "flex"}
                    }, c.createElement(a, null, l.ICON_IFRAME), c.createElement("div", {
                        className: "link-tool-input-warp",
                        style: {width: 210}
                    }, c.createElement(u, {onChange: this._handleLinkChange, value: this.state.src})))
                }
            }, {
                key: "_handleLinkChange", value: function (e) {
                    var t = void 0, n = void 0, o = void 0, r = void 0;
                    t = e.target.value, r = e.target.value, n = t.indexOf("youtube"), n && (o = t.split("?v=")[1]) && o.length && (r = "http://www.youtube.com/embed/" + o), this.setState({src: r})
                }
            }]), t
        }(s);
    t.default = f
}, function (e, t) {
    "use strict";

    function n(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }

    function o(e, t) {
        if (!e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
        return !t || "object" != typeof t && "function" != typeof t ? e : t
    }

    function r(e, t) {
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
    var i = function () {
            function e(e, t) {
                for (var n = 0; n < t.length; n++) {
                    var o = t[n];
                    o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
                }
            }

            return function (t, n, o) {
                return n && e(t.prototype, n), o && e(t, o), t
            }
        }(), a = novi.react.React, u = novi.react.Component, l = novi.ui.input, c = novi.ui.button, s = novi.language,
        f = function (e) {
            function t(e) {
                n(this, t);
                var r = o(this, (t.__proto__ || Object.getPrototypeOf(t)).call(this));
                return r.state = {settings: e.settings}, r.saveSettings = r.saveSettings.bind(r), r.onChange = r.onChange.bind(r), r.messages = s.getDataByKey("novi-plugin-iframe"), r
            }

            return r(t, e), i(t, [{
                key: "componentWillReceiveProps", value: function (e) {
                    this.setState({settings: e.settings})
                }
            }, {
                key: "render", value: function () {
                    return a.createElement("div", null, a.createElement("span", {style: {letterSpacing: "0,0462em"}}, "Iframe Plugin"), a.createElement("div", {
                        style: {
                            fontSize: 13,
                            color: "#6E778A",
                            marginTop: 21
                        }
                    }, this.messages.settings.inputPlaceholder), a.createElement(l, {
                        style: {marginTop: 10, width: 340},
                        value: this.state.settings.querySelector,
                        onChange: this.onChange
                    }), a.createElement("div", {style: {marginTop: 30}}, a.createElement(c, {
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
                    novi.plugins.settings.update("novi-plugin-iframe", this.state.settings)
                }
            }]), t
        }(u);
    t.default = f
}]);
