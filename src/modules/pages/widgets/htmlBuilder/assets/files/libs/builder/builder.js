/*
 * Copyright (c) 2022.
 * Created by YiiMan.
 * Programmer: gholamreza beheshtian
 * Mobile:+989353466620 | +17272282283
 * Site:https://yiiman.ir
 */

var styleHelpers = '';//used on toggleStyleHelpers function
var allScripts = '';//used on toggleJavaScript function
// Simple JavaScript Templating
// John Resig - https://johnresig.com/ - MIT Licensed
(function () {
    var cache = {};

    this.tippy = function (t) {
        "use strict";
        t = t && t.hasOwnProperty("default") ? t.default : t;

        function e() {
            return (e = Object.assign || function (t) {
                for (var e = 1; e < arguments.length; e++) {
                    var n = arguments[e];
                    for (var r in n) Object.prototype.hasOwnProperty.call(n, r) && (t[r] = n[r])
                }
                return t
            }).apply(this, arguments)
        }

        var n = {passive: !0}, r = "tippy-iOS", i = "tippy-popper", o = "tippy-tooltip", a = "tippy-content",
            p = "tippy-backdrop", u = "tippy-arrow", s = "tippy-svg-arrow", c = "." + i, l = "." + o, f = "." + a,
            d = "." + u, v = "." + s;

        function m(t, e) {
            t.innerHTML = e
        }

        function h(t) {
            return !(!t || !t._tippy || t._tippy.reference !== t)
        }

        function g(t, e) {
            return {}.hasOwnProperty.call(t, e)
        }

        function b(t) {
            return A(t) ? [t] : function (t) {
                return E(t, "NodeList")
            }(t) ? k(t) : Array.isArray(t) ? t : k(document.querySelectorAll(t))
        }

        function y(t, e, n) {
            if (Array.isArray(t)) {
                var r = t[e];
                return null == r ? Array.isArray(n) ? n[e] : n : r
            }
            return t
        }

        function w(t, e) {
            return t && t.modifiers && t.modifiers[e]
        }

        function E(t, e) {
            var n = {}.toString.call(t);
            return 0 === n.indexOf("[object") && n.indexOf(e + "]") > -1
        }

        function A(t) {
            return E(t, "Element")
        }

        function T(t) {
            return E(t, "MouseEvent")
        }

        function x(t, e) {
            return "function" == typeof t ? t.apply(void 0, e) : t
        }

        function C(t, e, n, r) {
            t.filter(function (t) {
                return t.name === e
            })[0][n] = r
        }

        function I() {
            return document.createElement("div")
        }

        function O(t, e) {
            t.forEach(function (t) {
                t && (t.style.transitionDuration = e + "ms")
            })
        }

        function D(t, e) {
            t.forEach(function (t) {
                t && t.setAttribute("data-state", e)
            })
        }

        function L(t, e) {
            return 0 === e ? t : function (r) {
                clearTimeout(n), n = setTimeout(function () {
                    t(r)
                }, e)
            };
            var n
        }

        function M(t, e, n) {
            t && t !== e && t.apply(void 0, n)
        }

        function k(t) {
            return [].slice.call(t)
        }

        function S(t, e) {
            for (; t;) {
                if (e(t)) return t;
                t = t.parentElement
            }
            return null
        }

        function P(t, e) {
            return t.indexOf(e) > -1
        }

        function V(t) {
            return t.split(/\s+/).filter(Boolean)
        }

        function B(t, e) {
            return void 0 !== t ? t : e
        }

        function U(t) {
            return [].concat(t)
        }

        function H(t) {
            var e = U(t)[0];
            return e && e.ownerDocument || document
        }

        function N(t, e) {
            -1 === t.indexOf(e) && t.push(e)
        }

        function z(t) {
            return "number" == typeof t ? t : parseFloat(t)
        }

        function R(t, e, n) {
            void 0 === e && (e = 5);
            var r = {top: 0, right: 0, bottom: 0, left: 0};
            return Object.keys(r).reduce(function (r, i) {
                return r[i] = "number" == typeof e ? e : e[i], t === i && (r[i] = "number" == typeof e ? e + n : e[t] + n), r
            }, r)
        }

        var q = {isTouch: !1}, F = 0;

        function j() {
            q.isTouch || (q.isTouch = !0, window.performance && document.addEventListener("mousemove", _))
        }

        function _() {
            var t = performance.now();
            t - F < 20 && (q.isTouch = !1, document.removeEventListener("mousemove", _)), F = t
        }

        function W() {
            var t = document.activeElement;
            if (h(t)) {
                var e = t._tippy;
                t.blur && !e.state.isVisible && t.blur()
            }
        }

        var X = "undefined" != typeof window && "undefined" != typeof document, Y = X ? navigator.userAgent : "",
            J = /MSIE |Trident\//.test(Y), G = /UCBrowser\//.test(Y),
            K = X && /iPhone|iPad|iPod/.test(navigator.platform);

        function Q(t) {
            var e = t && K && q.isTouch;
            document.body.classList[e ? "add" : "remove"](r)
        }

        var Z = e({
                allowHTML: !0,
                animation: "fade",
                appendTo: function () {
                    return document.body
                },
                aria: "describedby",
                arrow: !0,
                boundary: "scrollParent",
                content: "",
                delay: 0,
                distance: 10,
                duration: [300, 250],
                flip: !0,
                flipBehavior: "flip",
                flipOnUpdate: !1,
                hideOnClick: !0,
                ignoreAttributes: !1,
                inertia: !1,
                interactive: !1,
                interactiveBorder: 2,
                interactiveDebounce: 0,
                lazy: !0,
                maxWidth: 350,
                multiple: !1,
                offset: 0,
                onAfterUpdate: function () {
                },
                onBeforeUpdate: function () {
                },
                onCreate: function () {
                },
                onDestroy: function () {
                },
                onHidden: function () {
                },
                onHide: function () {
                },
                onMount: function () {
                },
                onShow: function () {
                },
                onShown: function () {
                },
                onTrigger: function () {
                },
                onUntrigger: function () {
                },
                placement: "top",
                plugins: [],
                popperOptions: {},
                role: "tooltip",
                showOnCreate: !1,
                theme: "",
                touch: !0,
                trigger: "mouseenter focus",
                triggerTarget: null,
                updateDuration: 0,
                zIndex: 9999
            }, {animateFill: !1, followCursor: !1, inlinePositioning: !1, sticky: !1}), $ = Object.keys(Z),
            tt = ["arrow", "boundary", "distance", "flip", "flipBehavior", "flipOnUpdate", "offset", "placement", "popperOptions"];

        function et(t) {
            var n = (t.plugins || []).reduce(function (e, n) {
                var r = n.name, i = n.defaultValue;
                return r && (e[r] = void 0 !== t[r] ? t[r] : i), e
            }, {});
            return e({}, t, {}, n)
        }

        function nt(t, n) {
            var r = e({}, n, {content: x(n.content, [t])}, n.ignoreAttributes ? {} : function (t, n) {
                return (n ? Object.keys(et(e({}, Z, {plugins: n}))) : $).reduce(function (e, n) {
                    var r = (t.getAttribute("data-tippy-" + n) || "").trim();
                    if (!r) return e;
                    if ("content" === n) e[n] = r; else try {
                        e[n] = JSON.parse(r)
                    } catch (t) {
                        e[n] = r
                    }
                    return e
                }, {})
            }(t, n.plugins));
            return r.interactive && (r.aria = null), r
        }

        function rt(t) {
            return t.split("-")[0]
        }

        function it(t) {
            t.setAttribute("data-inertia", "")
        }

        function ot(t) {
            t.setAttribute("data-interactive", "")
        }

        function at(t, e) {
            if (A(e.content)) m(t, ""), t.appendChild(e.content); else if ("function" != typeof e.content) {
                t[e.allowHTML ? "innerHTML" : "textContent"] = e.content
            }
        }

        function pt(t) {
            return {
                tooltip: t.querySelector(l),
                content: t.querySelector(f),
                arrow: t.querySelector(d) || t.querySelector(v)
            }
        }

        function ut(t) {
            var e = I();
            return !0 === t ? e.className = u : (e.className = s, A(t) ? e.appendChild(t) : m(e, t)), e
        }

        function st(t, e) {
            var n = I();
            n.className = i, n.style.position = "absolute", n.style.top = "0", n.style.left = "0";
            var r = I();
            r.className = o, r.id = "tippy-" + t, r.setAttribute("data-state", "hidden"), r.setAttribute("tabindex", "-1"), ft(r, "add", e.theme);
            var p = I();
            return p.className = a, p.setAttribute("data-state", "hidden"), e.interactive && ot(r), e.arrow && (r.setAttribute("data-arrow", ""), r.appendChild(ut(e.arrow))), e.inertia && it(r), at(p, e), r.appendChild(p), n.appendChild(r), ct(n, e, e), n
        }

        function ct(t, e, n) {
            var r, i = pt(t), o = i.tooltip, a = i.content, p = i.arrow;
            t.style.zIndex = "" + n.zIndex, o.setAttribute("data-animation", n.animation), o.style.maxWidth = "number" == typeof (r = n.maxWidth) ? r + "px" : r, n.role ? o.setAttribute("role", n.role) : o.removeAttribute("role"), e.content !== n.content && at(a, n), !e.arrow && n.arrow ? (o.appendChild(ut(n.arrow)), o.setAttribute("data-arrow", "")) : e.arrow && !n.arrow ? (o.removeChild(p), o.removeAttribute("data-arrow")) : e.arrow !== n.arrow && (o.removeChild(p), o.appendChild(ut(n.arrow))), !e.interactive && n.interactive ? ot(o) : e.interactive && !n.interactive && function (t) {
                t.removeAttribute("data-interactive")
            }(o), !e.inertia && n.inertia ? it(o) : e.inertia && !n.inertia && function (t) {
                t.removeAttribute("data-inertia")
            }(o), e.theme !== n.theme && (ft(o, "remove", e.theme), ft(o, "add", n.theme))
        }

        function lt(t, e, n) {
            var r = G && void 0 !== document.body.style.webkitTransition ? "webkitTransitionEnd" : "transitionend";
            t[e + "EventListener"](r, n)
        }

        function ft(t, e, n) {
            V(n).forEach(function (n) {
                t.classList[e](n + "-theme")
            })
        }

        var dt = 1, vt = [], mt = [];

        function ht(r, i) {
            var o, a, p, u = nt(r, e({}, Z, {}, et(i)));
            if (!u.multiple && r._tippy) return null;
            var s, l, f, d, v, m = !1, h = !1, b = !1, E = 0, A = [], I = L(Dt, u.interactiveDebounce),
                F = H(u.triggerTarget || r), j = dt++, _ = st(j, u), W = pt(_),
                X = (v = u.plugins).filter(function (t, e) {
                    return v.indexOf(t) === e
                }), Y = W.tooltip, G = W.content, K = [Y, G], $ = {
                    id: j,
                    reference: r,
                    popper: _,
                    popperChildren: W,
                    popperInstance: null,
                    props: u,
                    state: {
                        currentPlacement: null,
                        isEnabled: !0,
                        isVisible: !1,
                        isDestroyed: !1,
                        isMounted: !1,
                        isShown: !1
                    },
                    plugins: X,
                    clearDelayTimeouts: function () {
                        clearTimeout(o), clearTimeout(a), cancelAnimationFrame(p)
                    },
                    setProps: function (t) {
                        if ($.state.isDestroyed) return;
                        ht("onBeforeUpdate", [$, t]), It();
                        var n = $.props, i = nt(r, e({}, $.props, {}, t, {ignoreAttributes: !0}));
                        i.ignoreAttributes = B(t.ignoreAttributes, n.ignoreAttributes), $.props = i, Ct(), n.interactiveDebounce !== i.interactiveDebounce && (yt(), I = L(Dt, i.interactiveDebounce));
                        ct(_, n, i), $.popperChildren = pt(_), n.triggerTarget && !i.triggerTarget ? U(n.triggerTarget).forEach(function (t) {
                            t.removeAttribute("aria-expanded")
                        }) : i.triggerTarget && r.removeAttribute("aria-expanded");
                        if (bt(), $.popperInstance) if (tt.some(function (e) {
                            return g(t, e) && t[e] !== n[e]
                        })) {
                            var o = $.popperInstance.reference;
                            $.popperInstance.destroy(), St(), $.popperInstance.reference = o, $.state.isVisible && $.popperInstance.enableEventListeners()
                        } else $.popperInstance.update();
                        ht("onAfterUpdate", [$, t])
                    },
                    setContent: function (t) {
                        $.setProps({content: t})
                    },
                    show: function (t) {
                        void 0 === t && (t = y($.props.duration, 0, Z.duration));
                        var e = $.state.isVisible, n = $.state.isDestroyed, r = !$.state.isEnabled,
                            i = q.isTouch && !$.props.touch;
                        if (e || n || r || i) return;
                        if (ut().hasAttribute("disabled")) return;
                        $.popperInstance || St();
                        if (ht("onShow", [$], !1), !1 === $.props.onShow($)) return;
                        Et(), _.style.visibility = "visible", $.state.isVisible = !0, $.state.isMounted || O(K.concat(_), 0);
                        l = function () {
                            $.state.isVisible && (O([_], $.props.updateDuration), O(K, t), D(K, "visible"), gt(), bt(), N(mt, $), Q(!0), $.state.isMounted = !0, ht("onMount", [$]), function (t, e) {
                                Tt(t, e)
                            }(t, function () {
                                $.state.isShown = !0, ht("onShown", [$])
                            }))
                        }, function () {
                            E = 0;
                            var t, e = $.props.appendTo, n = ut();
                            t = $.props.interactive && e === Z.appendTo || "parent" === e ? n.parentNode : x(e, [n]);
                            t.contains(_) || t.appendChild(_);
                            C($.popperInstance.modifiers, "flip", "enabled", $.props.flip), $.popperInstance.enableEventListeners(), $.popperInstance.update()
                        }()
                    },
                    hide: function (t) {
                        void 0 === t && (t = y($.props.duration, 1, Z.duration));
                        var e = !$.state.isVisible && !m, n = $.state.isDestroyed, r = !$.state.isEnabled && !m;
                        if (e || n || r) return;
                        if (ht("onHide", [$], !1), !1 === $.props.onHide($) && !m) return;
                        At(), _.style.visibility = "hidden", $.state.isVisible = !1, $.state.isShown = !1, O(K, t), D(K, "hidden"), gt(), bt(), function (t, e) {
                            Tt(t, function () {
                                !$.state.isVisible && _.parentNode && _.parentNode.contains(_) && e()
                            })
                        }(t, function () {
                            $.popperInstance.disableEventListeners(), $.popperInstance.options.placement = $.props.placement, _.parentNode.removeChild(_), 0 === (mt = mt.filter(function (t) {
                                return t !== $
                            })).length && Q(!1), $.state.isMounted = !1, ht("onHidden", [$])
                        })
                    },
                    enable: function () {
                        $.state.isEnabled = !0
                    },
                    disable: function () {
                        $.hide(), $.state.isEnabled = !1
                    },
                    destroy: function () {
                        if ($.state.isDestroyed) return;
                        m = !0, $.clearDelayTimeouts(), $.hide(0), It(), delete r._tippy, $.popperInstance && $.popperInstance.destroy();
                        m = !1, $.state.isDestroyed = !0, ht("onDestroy", [$])
                    }
                };
            r._tippy = $, _._tippy = $;
            var it = X.map(function (t) {
                return t.fn($)
            });
            return Ct(), bt(), u.lazy || St(), ht("onCreate", [$]), u.showOnCreate && Vt(), _.addEventListener("mouseenter", function () {
                $.props.interactive && $.state.isVisible && $.clearDelayTimeouts()
            }), _.addEventListener("mouseleave", function () {
                $.props.interactive && P($.props.trigger, "mouseenter") && F.addEventListener("mousemove", I)
            }), $;

            function ot() {
                var t = $.props.touch;
                return Array.isArray(t) ? t : [t, 0]
            }

            function at() {
                return "hold" === ot()[0]
            }

            function ut() {
                return d || r
            }

            function ft(t) {
                return $.state.isMounted && !$.state.isVisible || q.isTouch || s && "focus" === s.type ? 0 : y($.props.delay, t ? 0 : 1, Z.delay)
            }

            function ht(t, e, n) {
                var r;
                (void 0 === n && (n = !0), it.forEach(function (n) {
                    g(n, t) && n[t].apply(n, e)
                }), n) && (r = $.props)[t].apply(r, e)
            }

            function gt() {
                var t = $.props.aria;
                if (t) {
                    var e = "aria-" + t, n = Y.id;
                    U($.props.triggerTarget || r).forEach(function (t) {
                        var r = t.getAttribute(e);
                        if ($.state.isVisible) t.setAttribute(e, r ? r + " " + n : n); else {
                            var i = r && r.replace(n, "").trim();
                            i ? t.setAttribute(e, i) : t.removeAttribute(e)
                        }
                    })
                }
            }

            function bt() {
                U($.props.triggerTarget || r).forEach(function (t) {
                    $.props.interactive ? t.setAttribute("aria-expanded", $.state.isVisible && t === ut() ? "true" : "false") : t.removeAttribute("aria-expanded")
                })
            }

            function yt() {
                F.body.removeEventListener("mouseleave", Bt), F.removeEventListener("mousemove", I), vt = vt.filter(function (t) {
                    return t !== I
                })
            }

            function wt(t) {
                if (!$.props.interactive || !_.contains(t.target)) {
                    if (ut().contains(t.target)) {
                        if (q.isTouch) return;
                        if ($.state.isVisible && P($.props.trigger, "click")) return
                    }
                    !0 === $.props.hideOnClick && (h = !1, $.clearDelayTimeouts(), $.hide(), b = !0, setTimeout(function () {
                        b = !1
                    }), $.state.isMounted || At())
                }
            }

            function Et() {
                F.addEventListener("mousedown", wt, !0)
            }

            function At() {
                F.removeEventListener("mousedown", wt, !0)
            }

            function Tt(t, e) {
                function n(t) {
                    t.target === Y && "visibility" === t.propertyName && (lt(Y, "remove", n), e())
                }

                if (0 === t) return e();
                lt(Y, "remove", f), lt(Y, "add", n), f = n
            }

            function xt(t, e, n) {
                void 0 === n && (n = !1), U($.props.triggerTarget || r).forEach(function (r) {
                    r.addEventListener(t, e, n), A.push({node: r, eventType: t, handler: e, options: n})
                })
            }

            function Ct() {
                at() && (xt("touchstart", Ot, n), xt("touchend", Lt, n)), V($.props.trigger).forEach(function (t) {
                    if ("manual" !== t) switch (xt(t, Ot), t) {
                        case"mouseenter":
                            xt("mouseleave", Lt);
                            break;
                        case"focus":
                            xt(J ? "focusout" : "blur", Mt)
                    }
                })
            }

            function It() {
                A.forEach(function (t) {
                    var e = t.node, n = t.eventType, r = t.handler, i = t.options;
                    e.removeEventListener(n, r, i)
                }), A = []
            }

            function Ot(t) {
                var e = !1;
                if ($.state.isEnabled && !kt(t) && !b) {
                    if (s = t, d = t.currentTarget, bt(), !$.state.isVisible && T(t) && vt.forEach(function (e) {
                        return e(t)
                    }), "click" !== t.type || P($.props.trigger, "mouseenter") && !h || !1 === $.props.hideOnClick || !$.state.isVisible) {
                        var n = ot(), r = n[0], i = n[1];
                        q.isTouch && "hold" === r && i ? o = setTimeout(function () {
                            Vt(t)
                        }, i) : Vt(t)
                    } else e = !0;
                    "click" === t.type && (h = !e), e && Bt(t)
                }
            }

            function Dt(t) {
                S(t.target, function (t) {
                    return t === r || t === _
                }) || function (t, e) {
                    var n = e.clientX, r = e.clientY;
                    return t.every(function (t) {
                        var e = t.popperRect, i = t.tooltipRect, o = t.interactiveBorder, a = Math.min(e.top, i.top),
                            p = Math.max(e.right, i.right), u = Math.max(e.bottom, i.bottom),
                            s = Math.min(e.left, i.left);
                        return a - r > o || r - u > o || s - n > o || n - p > o
                    })
                }(k(_.querySelectorAll(c)).concat(_).map(function (t) {
                    var e = t._tippy, n = e.popperChildren.tooltip, r = e.props.interactiveBorder;
                    return {
                        popperRect: t.getBoundingClientRect(),
                        tooltipRect: n.getBoundingClientRect(),
                        interactiveBorder: r
                    }
                }), t) && (yt(), Bt(t))
            }

            function Lt(t) {
                if (!kt(t)) return $.props.interactive ? (F.body.addEventListener("mouseleave", Bt), F.addEventListener("mousemove", I), void N(vt, I)) : void (P($.props.trigger, "click") && h || Bt(t))
            }

            function Mt(t) {
                t.target === ut() && ($.props.interactive && t.relatedTarget && _.contains(t.relatedTarget) || Bt(t))
            }

            function kt(t) {
                var e = "ontouchstart" in window, n = P(t.type, "touch"), r = at();
                return e && q.isTouch && r && !n || q.isTouch && !r && n
            }

            function St() {
                var n, i = $.props.popperOptions, o = $.popperChildren.arrow, a = w(i, "flip"),
                    p = w(i, "preventOverflow");

                function u(t) {
                    var e = $.state.currentPlacement;
                    $.state.currentPlacement = t.placement, $.props.flip && !$.props.flipOnUpdate && (t.flipped && ($.popperInstance.options.placement = t.placement), C($.popperInstance.modifiers, "flip", "enabled", !1)), Y.setAttribute("data-placement", t.placement), !1 !== t.attributes["x-out-of-boundaries"] ? Y.setAttribute("data-out-of-boundaries", "") : Y.removeAttribute("data-out-of-boundaries");
                    var r = rt(t.placement), i = P(["top", "bottom"], r), o = P(["bottom", "right"], r);
                    Y.style.top = "0", Y.style.left = "0", Y.style[i ? "top" : "left"] = (o ? 1 : -1) * n + "px", e && e !== t.placement && $.popperInstance.update()
                }

                var s = e({
                    eventsEnabled: !1,
                    placement: $.props.placement
                }, i, {
                    modifiers: e({}, i && i.modifiers, {
                        tippyDistance: {
                            enabled: !0, order: 0, fn: function (t) {
                                n = function (t, e) {
                                    var n = "string" == typeof e && P(e, "rem"), r = t.documentElement;
                                    return r && n ? parseFloat(getComputedStyle(r).fontSize || String(16)) * z(e) : z(e)
                                }(F, $.props.distance);
                                var e = rt(t.placement), r = R(e, p && p.padding, n), i = R(e, a && a.padding, n),
                                    o = $.popperInstance.modifiers;
                                return C(o, "preventOverflow", "padding", r), C(o, "flip", "padding", i), t
                            }
                        },
                        preventOverflow: e({boundariesElement: $.props.boundary}, p),
                        flip: e({enabled: $.props.flip, behavior: $.props.flipBehavior}, a),
                        arrow: e({element: o, enabled: !!o}, w(i, "arrow")),
                        offset: e({offset: $.props.offset}, w(i, "offset"))
                    }), onCreate: function (t) {
                        u(t), M(i && i.onCreate, s.onCreate, [t]), Pt()
                    }, onUpdate: function (t) {
                        u(t), M(i && i.onUpdate, s.onUpdate, [t]), Pt()
                    }
                });
                $.popperInstance = new t(r, _, s)
            }

            function Pt() {
                0 === E ? (E++, $.popperInstance.update()) : l && 1 === E && (E++, _.offsetHeight, l())
            }

            function Vt(t) {
                $.clearDelayTimeouts(), $.popperInstance || St(), t && ht("onTrigger", [$, t]), Et();
                var e = ft(!0);
                e ? o = setTimeout(function () {
                    $.show()
                }, e) : $.show()
            }

            function Bt(t) {
                if ($.clearDelayTimeouts(), ht("onUntrigger", [$, t]), $.state.isVisible) {
                    var e = ft(!1);
                    e ? a = setTimeout(function () {
                        $.state.isVisible && $.hide()
                    }, e) : p = requestAnimationFrame(function () {
                        $.hide()
                    })
                } else At()
            }
        }

        function gt(t, r, i) {
            void 0 === r && (r = {}), void 0 === i && (i = []), i = Z.plugins.concat(r.plugins || i), document.addEventListener("touchstart", j, e({}, n, {capture: !0})), window.addEventListener("blur", W);
            var o = e({}, r, {plugins: i}), a = b(t).reduce(function (t, e) {
                var n = e && ht(e, o);
                return n && t.push(n), t
            }, []);
            return A(t) ? a[0] : a
        }

        gt.version = "5.1.3", gt.defaultProps = Z, gt.setDefaultProps = function (t) {
            Object.keys(t).forEach(function (e) {
                Z[e] = t[e]
            })
        }, gt.currentInput = q;
        var bt = {mouseover: "mouseenter", focusin: "focus", click: "click"};
        var yt = {
            name: "animateFill", defaultValue: !1, fn: function (t) {
                var e = t.popperChildren, n = e.tooltip, r = e.content, i = t.props.animateFill && !G ? function () {
                    var t = I();
                    return t.className = p, D([t], "hidden"), t
                }() : null;

                function o() {
                    t.popperChildren.backdrop = i
                }

                return {
                    onCreate: function () {
                        i && (o(), n.insertBefore(i, n.firstElementChild), n.setAttribute("data-animatefill", ""), n.style.overflow = "hidden", t.setProps({
                            animation: "shift-away",
                            arrow: !1
                        }))
                    }, onMount: function () {
                        if (i) {
                            var t = n.style.transitionDuration, e = Number(t.replace("ms", ""));
                            r.style.transitionDelay = Math.round(e / 10) + "ms", i.style.transitionDuration = t, D([i], "visible")
                        }
                    }, onShow: function () {
                        i && (i.style.transitionDuration = "0ms")
                    }, onHide: function () {
                        i && D([i], "hidden")
                    }, onAfterUpdate: function () {
                        o()
                    }
                }
            }
        };
        var wt = {
            name: "followCursor", defaultValue: !1, fn: function (t) {
                var e, n = t.reference, r = t.popper, i = null, o = H(t.props.triggerTarget || n), a = null, p = !1,
                    u = t.props;

                function s() {
                    return "manual" === t.props.trigger.trim()
                }

                function c() {
                    var e = !!s() || null !== a && !(0 === a.clientX && 0 === a.clientY);
                    return t.props.followCursor && e
                }

                function l() {
                    return q.isTouch || "initial" === t.props.followCursor && t.state.isVisible
                }

                function f() {
                    t.popperInstance && i && (t.popperInstance.reference = i)
                }

                function d() {
                    if (c() || t.props.placement !== u.placement) {
                        var e = u.placement, n = e.split("-")[1];
                        p = !0, t.setProps({placement: c() && n ? e.replace(n, "start" === n ? "end" : "start") : e}), p = !1
                    }
                }

                function v() {
                    t.popperInstance && c() && (l() || !0 !== t.props.followCursor) && t.popperInstance.disableEventListeners()
                }

                function m() {
                    c() ? o.addEventListener("mousemove", b) : f()
                }

                function h() {
                    c() && b(e)
                }

                function g() {
                    o.removeEventListener("mousemove", b)
                }

                function b(o) {
                    var a = e = o, p = a.clientX, u = a.clientY;
                    if (t.popperInstance && t.state.currentPlacement) {
                        var s = S(o.target, function (t) {
                                return t === n
                            }), c = n.getBoundingClientRect(), f = t.props.followCursor, d = "horizontal" === f,
                            v = "vertical" === f, m = P(["top", "bottom"], rt(t.state.currentPlacement)),
                            h = function (t, e) {
                                var n = e ? t.offsetWidth : t.offsetHeight;
                                return {size: n, x: e ? n : 0, y: e ? 0 : n}
                            }(r, m), b = h.size, y = h.x, w = h.y;
                        !s && t.props.interactive || (null === i && (i = t.popperInstance.reference), t.popperInstance.reference = {
                            referenceNode: n,
                            clientWidth: 0,
                            clientHeight: 0,
                            getBoundingClientRect: function () {
                                return {
                                    width: m ? b : 0,
                                    height: m ? 0 : b,
                                    top: (d ? c.top : u) - w,
                                    bottom: (d ? c.bottom : u) + w,
                                    left: (v ? c.left : p) - y,
                                    right: (v ? c.right : p) + y
                                }
                            }
                        }, t.popperInstance.update()), l() && g()
                    }
                }

                return {
                    onAfterUpdate: function (t, e) {
                        var n;
                        p || (n = e, Object.keys(n).forEach(function (t) {
                            u[t] = B(n[t], u[t])
                        }), e.placement && d()), e.placement && v(), requestAnimationFrame(h)
                    }, onMount: function () {
                        h(), v()
                    }, onShow: function () {
                        s() && (e = a = {clientX: 0, clientY: 0}, d(), m())
                    }, onTrigger: function (t, n) {
                        a || (T(n) && (a = {clientX: n.clientX, clientY: n.clientY}, e = n), d(), m())
                    }, onUntrigger: function () {
                        t.state.isVisible || (g(), a = null)
                    }, onHidden: function () {
                        g(), f(), a = null
                    }
                }
            }
        };
        var Et = {
            name: "inlinePositioning", defaultValue: !1, fn: function (t) {
                var e = t.reference;

                function n() {
                    return !!t.props.inlinePositioning
                }

                return {
                    onHidden: function () {
                        n() && (t.popperInstance.reference = e)
                    }, onShow: function () {
                        n() && (t.popperInstance.reference = {
                            referenceNode: e,
                            clientWidth: 0,
                            clientHeight: 0,
                            getBoundingClientRect: function () {
                                return function (t, e, n) {
                                    if (n.length < 2 || null === t) return e;
                                    switch (t) {
                                        case"top":
                                        case"bottom":
                                            var r = n[0], i = n[n.length - 1], o = "top" === t, a = r.top, p = i.bottom,
                                                u = o ? r.left : i.left, s = o ? r.right : i.right;
                                            return {top: a, bottom: p, left: u, right: s, width: s - u, height: p - a};
                                        case"left":
                                        case"right":
                                            var c = Math.min.apply(Math, n.map(function (t) {
                                                return t.left
                                            })), l = Math.max.apply(Math, n.map(function (t) {
                                                return t.right
                                            })), f = n.filter(function (e) {
                                                return "left" === t ? e.left === c : e.right === l
                                            }), d = f[0].top, v = f[f.length - 1].bottom;
                                            return {top: d, bottom: v, left: c, right: l, width: l - c, height: v - d};
                                        default:
                                            return e
                                    }
                                }(t.state.currentPlacement && rt(t.state.currentPlacement), e.getBoundingClientRect(), k(e.getClientRects()))
                            }
                        })
                    }
                }
            }
        };
        var At = {
            name: "sticky", defaultValue: !1, fn: function (t) {
                var e = t.reference, n = t.popper;

                function r(e) {
                    return !0 === t.props.sticky || t.props.sticky === e
                }

                var i = null, o = null;

                function a() {
                    var p = r("reference") ? (t.popperInstance ? t.popperInstance.reference : e).getBoundingClientRect() : null,
                        u = r("popper") ? n.getBoundingClientRect() : null;
                    (p && Tt(i, p) || u && Tt(o, u)) && t.popperInstance.update(), i = p, o = u, t.state.isMounted && requestAnimationFrame(a)
                }

                return {
                    onMount: function () {
                        t.props.sticky && a()
                    }
                }
            }
        };

        function Tt(t, e) {
            return !t || !e || (t.top !== e.top || t.right !== e.right || t.bottom !== e.bottom || t.left !== e.left)
        }

        return X && function (t) {
            var e = document.createElement("style");
            e.textContent = t, e.setAttribute("data-tippy-stylesheet", "");
            var n = document.head, r = document.querySelector("head>style,head>link");
            r ? n.insertBefore(e, r) : n.appendChild(e)
        }(".tippy-tooltip[data-animation=fade][data-state=hidden]{opacity:0}.tippy-iOS{cursor:pointer!important;-webkit-tap-highlight-color:transparent}.tippy-popper{pointer-events:none;max-width:calc(100vw - 10px);transition-timing-function:cubic-bezier(.165,.84,.44,1);transition-property:transform}.tippy-tooltip{position:relative;color:#fff;border-radius:4px;font-size:14px;line-height:1.4;background-color:#333;transition-property:visibility,opacity,transform;outline:0}.tippy-tooltip[data-placement^=top]>.tippy-arrow{border-width:8px 8px 0;border-top-color:#333;margin:0 3px;transform-origin:50% 0;bottom:-7px}.tippy-tooltip[data-placement^=bottom]>.tippy-arrow{border-width:0 8px 8px;border-bottom-color:#333;margin:0 3px;transform-origin:50% 7px;top:-7px}.tippy-tooltip[data-placement^=left]>.tippy-arrow{border-width:8px 0 8px 8px;border-left-color:#333;margin:3px 0;transform-origin:0 50%;right:-7px}.tippy-tooltip[data-placement^=right]>.tippy-arrow{border-width:8px 8px 8px 0;border-right-color:#333;margin:3px 0;transform-origin:7px 50%;left:-7px}.tippy-tooltip[data-interactive][data-state=visible]{pointer-events:auto}.tippy-tooltip[data-inertia][data-state=visible]{transition-timing-function:cubic-bezier(.54,1.5,.38,1.11)}.tippy-arrow{position:absolute;border-color:transparent;border-style:solid}.tippy-content{padding:5px 9px}"), gt.setDefaultProps({plugins: [yt, wt, Et, At]}), gt.createSingleton = function (t, n, r) {
            void 0 === n && (n = {}), void 0 === r && (r = []), r = n.plugins || r, t.forEach(function (t) {
                t.disable()
            });
            var i, o, a = e({}, Z, {}, n).aria, p = !1, u = t.map(function (t) {
                return t.reference
            }), s = {
                fn: function (e) {
                    function n(t) {
                        if (i) {
                            var n = "aria-" + i;
                            t && !e.props.interactive ? o.setAttribute(n, e.popperChildren.tooltip.id) : o.removeAttribute(n)
                        }
                    }

                    return {
                        onAfterUpdate: function (t, n) {
                            var r = n.aria;
                            void 0 !== r && r !== a && (p ? (p = !0, e.setProps({aria: null}), p = !1) : a = r)
                        }, onDestroy: function () {
                            t.forEach(function (t) {
                                t.enable()
                            })
                        }, onMount: function () {
                            n(!0)
                        }, onUntrigger: function () {
                            n(!1)
                        }, onTrigger: function (r, p) {
                            var s = p.currentTarget, c = u.indexOf(s);
                            s !== o && (o = s, i = a, e.state.isVisible && n(!0), e.popperInstance.reference = s, e.setContent(t[c].props.content))
                        }
                    }
                }
            };
            return gt(I(), e({}, n, {plugins: [s].concat(r), aria: null, triggerTarget: u}))
        }, gt.delegate = function (t, n, r) {
            void 0 === r && (r = []), r = n.plugins || r;
            var i, o, a = [], p = [], u = n.target, s = (i = ["target"], o = e({}, n), i.forEach(function (t) {
                    delete o[t]
                }), o), c = e({}, s, {plugins: r, trigger: "manual"}), l = e({}, s, {plugins: r, showOnCreate: !0}),
                f = gt(t, c);

            function d(t) {
                if (t.target) {
                    var e = t.target.closest(u);
                    if (e) if (P(e.getAttribute("data-tippy-trigger") || n.trigger || Z.trigger, bt[t.type])) {
                        var r = gt(e, l);
                        r && (p = p.concat(r))
                    }
                }
            }

            function v(t, e, n, r) {
                void 0 === r && (r = !1), t.addEventListener(e, n, r), a.push({
                    node: t,
                    eventType: e,
                    handler: n,
                    options: r
                })
            }

            return U(f).forEach(function (t) {
                var e = t.destroy;
                t.destroy = function (t) {
                    void 0 === t && (t = !0), t && p.forEach(function (t) {
                        t.destroy()
                    }), p = [], a.forEach(function (t) {
                        var e = t.node, n = t.eventType, r = t.handler, i = t.options;
                        e.removeEventListener(n, r, i)
                    }), a = [], e()
                }, function (t) {
                    var e = t.reference;
                    v(e, "mouseover", d), v(e, "focusin", d), v(e, "click", d)
                }(t)
            }), f
        }, gt.hideAll = function (t) {
            var e = void 0 === t ? {} : t, n = e.exclude, r = e.duration;
            mt.forEach(function (t) {
                var e = !1;
                n && (e = h(n) ? t.reference === n : t.popper === n.popper), e || t.hide(r)
            })
        }, gt.roundArrow = '<svg viewBox="0 0 18 7" xmlns="http://www.w3.org/2000/svg"><path d="M0 7s2.021-.015 5.253-4.218C6.584 1.051 7.797.007 9 0c1.203-.007 2.416 1.035 3.761 2.782C16.012 7.005 18 7 18 7H0z"/></svg>', gt
    }(Popper);


    this.tmpl = function tmpl(str, data) {
        // Figure out if we're getting a template, or if we need to
        // load the template - and be sure to cache the result.


        var fn = /^[-a-zA-Z0-9]+$/.test(str) ?
            cache[str] = cache[str] ||
                tmpl(document.getElementById(str).innerHTML) :

            // Generate a reusable function that will serve as a template
            // generator (and which will be cached).
            new Function("obj",
                "var p=[],print=function(){p.push.apply(p,arguments);};" +

                // Introduce the data as local variables using with(){}
                "with(obj){p.push('" +

                // Convert the template into pure JavaScript
                str
                    .replace(/[\r\t\n]/g, " ")
                    .split("{%").join("\t")
                    .replace(/((^|%})[^\t]*)'/g, "$1\r")
                    .replace(/\t=(.*?)%}/g, "',$1,'")
                    .split("\t").join("');")
                    .split("%}").join("p.push('")
                    .split("\r").join("\\'")
                + "');}return p.join('');");

        // Provide some basic currying to the user
        return data ? fn(data) : fn;
    };
})();

var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
        clearTimeout(timer);
        timer = setTimeout(callback, ms);
    };
})();

function isElement(obj) {
    return (typeof obj === "object") &&
        (obj.nodeType === 1) && (typeof obj.style === "object") &&
        (typeof obj.ownerDocument === "object")/* && obj.tagName != "BODY"*/;
}


var isIE11 = !!window.MSInputMethodContext && !!document.documentMode;

if (Vvveb === undefined) var Vvveb = {};

Vvveb.defaultComponent = "_base";
Vvveb.preservePropertySections = true;
Vvveb.dragIcon = 'icon';//icon = use component icon when dragging | html = use component html to create draggable element

Vvveb.baseUrl = document.currentScript ? document.currentScript.src.replace(/[^\/]*?\.js$/, '') : '';

Vvveb.ComponentsGroup = {};

Vvveb.BlocksGroup = {};

Vvveb.Components = {

    _components: {},

    _nodesLookup: {},

    _attributesLookup: {},

    _classesLookup: {},

    _classesRegexLookup: {},

    componentPropertiesElement: "#right-panel .component-properties",

    componentPropertiesDefaultSection: "content",

    get: function (type) {
        return this._components[type];
    },

    add: function (type, data) {
        data.type = type;

        this._components[type] = data;

        if (data.nodes) {
            for (var i in data.nodes) {
                this._nodesLookup[data.nodes[i]] = data;
            }
        }

        if (data.attributes) {
            if (data.attributes.constructor === Array) {
                for (var i in data.attributes) {
                    this._attributesLookup[data.attributes[i]] = data;
                }
            } else {
                for (var i in data.attributes) {
                    if (typeof this._attributesLookup[i] === 'undefined') {
                        this._attributesLookup[i] = {};
                    }

                    if (typeof this._attributesLookup[i][data.attributes[i]] === 'undefined') {
                        this._attributesLookup[i][data.attributes[i]] = {};
                    }

                    this._attributesLookup[i][data.attributes[i]] = data;
                }
            }
        }

        if (data.classes) {
            for (var i in data.classes) {
                this._classesLookup[data.classes[i]] = data;
            }
        }

        if (data.classesRegex) {
            for (var i in data.classesRegex) {
                this._classesRegexLookup[data.classesRegex[i]] = data;
            }
        }
    },

    extend: function (inheritType, type, data) {

        var newData = data;

        if (inheritData = this._components[inheritType]) {
            newData = $.extend(true, {}, inheritData, data);
            newData.properties = $.merge($.merge([], inheritData.properties ? inheritData.properties : []), data.properties ? data.properties : []);
        }

        //sort by order
        newData.properties.sort(function (a, b) {
            if (typeof a.sort === "undefined") a.sort = 0;
            if (typeof b.sort === "undefined") b.sort = 0;

            if (a.sort < b.sort)
                return -1;
            if (a.sort > b.sort)
                return 1;
            return 0;
        });
        /*
		var output = array.reduce(function(o, cur) {

		  // Get the index of the key-value pair.
		  var occurs = o.reduce(function(n, item, i) {
			return (item.key === cur.key) ? i : n;
		  }, -1);

		  // If the name is found,
		  if (occurs >= 0) {

			// append the current value to its list of values.
			o[occurs].value = o[occurs].value.concat(cur.value);

		  // Otherwise,
		  } else {

			// add the current item to o (but make sure the value is an array).
			var obj = {name: cur.key, value: [cur.value]};
			o = o.concat([obj]);
		  }

		  return o;
		}, newData.properties);
*/

        this.add(type, newData);
    },


    matchNode: function (node) {
        var component = {};

        if (!node || !node.tagName) return false;

        if (node.attributes && node.attributes.length) {
            //search for attributes
            for (var i in node.attributes) {
                if (node.attributes[i]) {
                    attr = node.attributes[i].name;
                    value = node.attributes[i].value;

                    if (attr in this._attributesLookup) {
                        component = this._attributesLookup[attr];

                        //currently we check that is not a component by looking at name attribute
                        //if we have a collection of objects it means that attribute value must be checked
                        if (typeof component["name"] === "undefined") {
                            if (value in component) {
                                return component[value];
                            }
                        } else
                            return component;
                    }
                }
            }

            for (var i in node.attributes) {
                attr = node.attributes[i].name;
                value = node.attributes[i].value;

                //check for node classes
                if (attr == "class") {
                    classes = value.split(" ");

                    for (j in classes) {
                        if (classes[j] in this._classesLookup)
                            return this._classesLookup[classes[j]];
                    }

                    for (regex in this._classesRegexLookup) {
                        regexObj = new RegExp(regex);
                        if (regexObj.exec(value)) {
                            return this._classesRegexLookup[regex];
                        }
                    }
                }
            }
        }

        tagName = node.tagName.toLowerCase();
        if (tagName in this._nodesLookup) return this._nodesLookup[tagName];

        return false;
        //return false;
    },

    render: function (type) {

        var component = this._components[type];

        var componentsPanel = jQuery(this.componentPropertiesElement);
        var defaultSection = this.componentPropertiesDefaultSection;
        var componentsPanelSections = {};

        jQuery(this.componentPropertiesElement + " .tab-pane").each(function () {
            var sectionName = this.dataset.section;
            componentsPanelSections[sectionName] = $(this);

        });

        var section = componentsPanelSections[defaultSection].find('.section[data-section="default"]');

        if (!(Vvveb.preservePropertySections && section.length)) {
            let data =
                {
                    key: "default",
                    header: component.name,
                };
            if ((typeof component.description !== 'undefined' && component.description != false)) {
                data.description = component.description;
            }

            componentsPanelSections[defaultSection].html('').append(tmpl("vvveb-input-sectioninput", data));
            section = componentsPanelSections[defaultSection].find(".section");
        }

        componentsPanelSections[defaultSection].find('[data-header="default"] span').html(component.name);
        section.html("")

        if (component.beforeInit) component.beforeInit(Vvveb.Builder.selectedEl.get(0));

        var element;

        var fn = function (component, property) {
            return property.input.on('propertyChange', function (event, value, input) {

                var element = Vvveb.Builder.selectedEl;

                if (property.parent) element = element.parent(property.parent);
                if (property.child) element = element.find(property.child);

                if (property.onChange) {
                    element = property.onChange(element, value, input, component);
                }/* else */
                if (property.htmlAttr) {
                    oldValue = element.attr(property.htmlAttr);

                    if (property.htmlAttr == "class" && property.validValues) {
                        element.removeClass(property.validValues.join(" "));
                        element = element.addClass(value);
                    } else if (property.htmlAttr == "style") {
                        element = Vvveb.StyleManager.setStyle(element, property.key, value);
                    } else if (property.htmlAttr == "innerHTML") {
                        element = Vvveb.ContentManager.setHtml(element, value);
                    } else {
                        element = element.attr(property.htmlAttr, value);
                    }

                    Vvveb.Undo.addMutation({
                        type: 'attributes',
                        target: element.get(0),
                        attributeName: property.htmlAttr,
                        oldValue: oldValue,
                        newValue: element.attr(property.htmlAttr)
                    });
                }

                if (component.onChange) {
                    element = component.onChange(element, property, value, input);
                }

                if (!property.child && !property.parent) Vvveb.Builder.selectNode(element);

                return element;
            });
        };

        var nodeElement = Vvveb.Builder.selectedEl;

        for (var i in component.properties) {

            var property = component.properties[i];
            var element = nodeElement;

            if (property.beforeInit) property.beforeInit(element.get(0))

            if (property.parent) element = element.parent(property.parent);
            if (property.child) element = element.find(property.child);

            if (property.data) {
                property.data["key"] = property.key;
            } else {
                property.data = {"key": property.key};
            }

            if (typeof property.group === 'undefined') property.group = null;

            property.input = property.inputtype.init(property.data);

            if (property.init) {
                property.inputtype.setValue(property.init(element.get(0)));
            } else if (property.htmlAttr) {
                if (property.htmlAttr == "style") {
                    //value = element.css(property.key);//jquery css returns computed style
                    var value = Vvveb.StyleManager.getStyle(element, property.key);//getStyle returns declared style
                } else if (property.htmlAttr == "innerHTML") {
                    var value = Vvveb.ContentManager.getHtml(element);
                } else {
                    var value = element.attr(property.htmlAttr);
                }

                //if attribute is class check if one of valid values is included as class to set the select
                if (value && property.htmlAttr == "class" && property.validValues) {
                    value = value.split(" ").filter(function (el) {
                        return property.validValues.indexOf(el) != -1
                    });
                }

                property.inputtype.setValue(value);
            }

            fn(component, property);

            var propertySection = defaultSection;
            if (property.section) {
                propertySection = property.section;
            }


            if (property.inputtype == SectionInput) {
                section = componentsPanelSections[propertySection].find('.section[data-section="' + property.key + '"]');

                if (Vvveb.preservePropertySections && section.length) {
                    section.html("");
                } else {
                    componentsPanelSections[propertySection].append(property.input);
                    section = componentsPanelSections[propertySection].find('.section[data-section="' + property.key + '"]');
                }
            } else {
                var row = $(tmpl('vvveb-property', property));
                row.find('.input').append(property.input);
                section.append(row);
            }

            if (property.inputtype.afterInit) {
                property.inputtype.afterInit(property.input);
            }

        }

        if (component.init) component.init(Vvveb.Builder.selectedEl.get(0));
    }
};


Vvveb.Blocks = {

    _blocks: {},

    get: function (type) {
        return this._blocks[type];
    },

    add: function (type, data) {
        data.type = type;
        this._blocks[type] = data;
    },
};


Vvveb.WysiwygEditor = {

    isActive: false,
    oldValue: '',
    doc: false,

    init: function (doc) {
        this.doc = doc;


        $("#bold-btn").on("click", function (e) {
            e.preventDefault();
            doc.execCommand('bold', false, null);
            return false;
        });

        $("right-btn").on("click", function (e) {
            e.preventDefault();
            doc.execCommand('justifyRight', false, null);
            return false;
        });

        $("center-btn").on("click", function (e) {
            e.preventDefault();
            doc.execCommand('justifyCenter', false, null);
            return false;
        });

        $("left-btn").on("click", function (e) {
            e.preventDefault();
            doc.execCommand('justifyLeft', false, null);
            return false;
        });


        $("#italic-btn").on("click", function (e) {
            doc.execCommand('italic', false, null);
            e.preventDefault();
            return false;
        });

        $("#underline-btn").on("click", function (e) {
            doc.execCommand('underline', false, null);
            e.preventDefault();
            return false;
        });

        $("#strike-btn").on("click", function (e) {
            doc.execCommand('strikeThrough', false, null);
            e.preventDefault();
            return false;
        });

        $("#link-btn").on("click", function (e) {
            doc.execCommand('createLink', false, "#");
            e.preventDefault();
            return false;
        });


    },

    undo: function (element) {
        this.doc.execCommand('undo', false, null);
    },

    redo: function (element) {
        this.doc.execCommand('redo', false, null);
    },

    edit: function (element) {

        this.underEdit = true;
        this.underEditNode = element[0];


        element.attr({'contenteditable': true, 'spellcheckker': false});

        this.isActive = true;
        this.oldValue = element.html();
        this.element = element;


        $("#wysiwyg-editor").show('slow');


    },

    destroy: function (element) {
        element.removeAttr('contenteditable spellcheckker');
        $("#wysiwyg-editor").hide();
        this.isActive = false;


        node = this.element.get(0);
        Vvveb.Undo.addMutation({
            type: 'characterData',
            target: node,
            oldValue: this.oldValue,
            newValue: node.innerHTML
        });
    }
}

Vvveb.Builder = {

    component: {},
    dragMoveMutation: false,
    isPreview: false,
    runJsOnSetHtml: false,
    designerMode: false,
    underEdit: false,
    underEditNode: null,
    init: function (url, callback) {

        var self = this;

        self.loadControlGroups();
        self.loadBlockGroups();

        self.selectedEl = null;
        self.highlightEl = null;
        self.initCallback = callback;

        self.documentFrame = $("#iframe-wrapper > iframe");
        self.canvas = $("#canvas");

        self._loadIframe(url);


        self._initDragdrop();

        self._initBox();

        self.init_modal();

        self.dragElement = null;


    },

    /* controls */
    loadControlGroups: function () {

        var componentsList = $(".components-list");
        componentsList.empty();
        var item = {}, component = {};
        var count = 0;

        componentsList.each(function () {
            var list = $(this);
            var type = this.dataset.type;
            count++;

            for (group in Vvveb.ComponentsGroup) {
                list.append('<li class="header clearfix" data-section="' + group + '"  data-search=""><label class="header" for="' + type + '_comphead_' + group + count + '">' + group + '  <div class="header-arrow"></div>\
									   </label><input class="header_check" type="checkbox" checked="true" id="' + type + '_comphead_' + group + count + '">  <ol></ol></li>');

                var componentsSubList = list.find('li[data-section="' + group + '"]  ol');

                components = Vvveb.ComponentsGroup[group];

                for (i in components) {
                    componentType = components[i];
                    component = Vvveb.Components.get(componentType);

                    if (component) {
                        item = $('<li data-section="' + group + '" data-drag-type=component data-type="' + componentType + '" data-search="' + component.name.toLowerCase() + '"><a href="#">' + component.name + "</a></li>");

                        if (component.image) {

                            item.css({
                                backgroundImage: "url(" + component.image + ")",
                                backgroundRepeat: "no-repeat"
                            })
                        }

                        componentsSubList.append(item)
                    }
                }
            }
        });
    },

    loadBlockGroups: function () {

        var blocksList = $(".blocks-list");
        blocksList.empty();
        var item = {};

        blocksList.each(function () {

            var list = $(this);
            var type = this.dataset.type;

            for (group in Vvveb.BlocksGroup) {
                list.append('<li class="header" data-section="' + group + '"  data-search=""><label class="header" for="' + type + '_blockhead_' + group + '">' + group + '  <div class="header-arrow"></div>\
									   </label><input class="header_check" type="checkbox" checked="true" id="' + type + '_blockhead_' + group + '">  <ol></ol></li>');

                var blocksSubList = list.find('li[data-section="' + group + '"]  ol');
                blocks = Vvveb.BlocksGroup[group];

                for (i in blocks) {
                    blockType = blocks[i];
                    block = Vvveb.Blocks.get(blockType);

                    if (block) {
                        var tipp = '';
                        var description = '';
                        if ("description" in block) {

                            tipp = 'data-tippy-content="' + block.description + '" data-toggle="tooltip"';
                            description = block.description;
                        }

                        item = $('<li   data-section="' + group + '"  data-drag-type=block data-type="' + blockType + '" data-search="' + block.name.toLowerCase() + '"><a href="#">' + block.name + "</a><p>" + description + "</p></li>");

                        if (block.image) {

                            item.css({
                                backgroundImage: "url(" + ((block.image.indexOf('//') == -1) ? '' : '') + block.image + ")",
                                backgroundRepeat: "no-repeat"
                            })
                        }

                        blocksSubList.append(item);


                        tippy('[data-toggle="tooltip"]');
                    }
                }
            }
        });
    },

    loadUrl: function (url, callback) {
        var self = this;
        jQuery("#select-box").hide();

        self.initCallback = callback;
        if (Vvveb.Builder.iframe.src != url) Vvveb.Builder.iframe.src = url;
    },

    /* iframe */
    _loadIframe: function (url) {

        var self = this;
        self.iframe = this.documentFrame.get(0);
        self.iframe.src = url;

        return this.documentFrame.on("load", function () {
            window.FrameWindow = self.iframe.contentWindow;
            window.FrameDocument = self.iframe.contentWindow.document;
            var addSectionBox = jQuery("#add-section-box");
            var highlightBox = jQuery("#highlight-box").hide();


            $(window.FrameWindow).on("beforeunload", function (event) {
                if (Vvveb.Undo.undoIndex <= 0) {
                    var dialogText = "شما تغییراتی دارید که ذخیره نشده است";
                    event.returnValue = dialogText;
                    return dialogText;
                }
            });

            jQuery(window.FrameWindow).on("scroll resize", function (event) {

                if (self.selectedEl) {
                    var offset = self.selectedEl.offset();

                    jQuery("#select-box").css(
                        {
                            "top": offset.top - self.frameDoc.scrollTop(),
                            "left": offset.left - self.frameDoc.scrollLeft(),
                            "width": self.selectedEl.outerWidth(),
                            "height": self.selectedEl.outerHeight(),
                            //"display": "block"
                        });

                }

                if (self.highlightEl) {
                    var offset = self.highlightEl.offset();

                    highlightBox.css(
                        {
                            "top": offset.top - self.frameDoc.scrollTop(),
                            "left": offset.left - self.frameDoc.scrollLeft(),
                            "width": self.highlightEl.outerWidth(),
                            "height": self.highlightEl.outerHeight(),
                            //"display": "block"
                        });


                    addSectionBox.hide();
                }

            });

            Vvveb.WysiwygEditor.init(window.FrameDocument);
            if (self.initCallback) self.initCallback();

            var out = self._frameLoaded();

            Vvveb.Sections.loadSections();
            Vvveb.Sections.init();

            return out;
        });

    },

    _frameLoaded: function () {

        var self = Vvveb.Builder;

        self.frameDoc = $(window.FrameDocument);
        self.frameHtml = $(window.FrameDocument).find("html");
        self.frameBody = $(window.FrameDocument).find("begincontent");
        self.frameHead = $(window.FrameDocument).find("head");

        //insert editor helpers like non editable areas
        self.frameHead.append('<link data-vvveb-helpers href="' + assetUrl + '/css/vvvebjs-editor-helpers.css" rel="stylesheet">');

        self._initHighlight();

        $(window).triggerHandler("vvveb.iframe.loaded", self.frameDoc);
    },

    _getElementType: function (el) {

        //search for component attribute
        componentName = '';

        if (el.attributes)
            for (var j = 0; j < el.attributes.length; j++) {

                if (el.attributes[j].nodeName.indexOf('data-component') > -1) {
                    componentName = el.attributes[j].nodeName.replace('data-component-', '');
                }
            }

        if (componentName != '') return componentName;
        let out = el.tagName;
        if (el.className.length > 0) {
            out += ' | ';
            out += '<b style="color: yellow">' + el.className + '</b>';
        }
        return out;
    },

    loadNodeComponent: function (node) {
        data = Vvveb.Components.matchNode(node);
        var component;

        if (data)
            component = data.type;
        else
            component = Vvveb.defaultComponent;

        Vvveb.Components.render(component);

    },

    selectNode: function (node) {
        var self = this;

        if (!node) {
            jQuery("#select-box").hide();
            return;
        }

        if (self.texteditEl && self.selectedEl.get(0) != node) {
            Vvveb.WysiwygEditor.destroy(self.texteditEl);
            jQuery("#select-box").removeClass("text-edit").find("#select-actions").show('slow');
            self.texteditEl = null;
        }

        var target = jQuery(node);

        if (target) {
            self.selectedEl = target;

            try {
                var withinElement = $(target || window),
                    isWindow = $.isWindow(withinElement[0]),
                    isDocument = !!withinElement[0] && withinElement[0].nodeType === 9;
                isDocument = !!withinElement[0] && withinElement[0].nodeType === 9,
                    hasOffset = !isWindow && !isDocument;
                var offset = hasOffset ? $(target).offset() : {left: 0, top: 0};

                jQuery("#select-box").css(
                    {
                        "top": offset.top - self.frameDoc.scrollTop(),
                        "left": offset.left - self.frameDoc.scrollLeft(),
                        "width": target.outerWidth(),
                        "height": target.outerHeight(),
                        "display": "block",
                    });
            } catch (err) {
                try {
                    jQuery("#select-box").css(
                        {
                            "top": 0 - self.frameDoc.scrollTop(),
                            "left": 0 - self.frameDoc.scrollLeft(),
                            "width": target.outerWidth(),
                            "height": target.outerHeight(),
                            "display": "block",
                        });
                } catch (error) {
                    console.log(target);
                    jQuery("#select-box").css(
                        {
                            "top": 0 - self.frameDoc.scrollTop(),
                            "left": 0 - self.frameDoc.scrollLeft(),
                            "width": target[0].nextElementSibling.width,
                            "height": target[0].nextElementSibling.height,
                            "display": "block",
                        });
                }

            }
        }

        jQuery("#highlight-name").html(this._getElementType(node));

    },

    SelectText: function (element) {
        var doc = document,
            text = element.get(0),
            range,
            selection;
        if (doc.body.createTextRange) {
            range = document.body.createTextRange();
            range.moveToElementText(text);
            range.select();
        } else if (window.getSelection) {
            selection = window.getSelection();
            range = document.createRange();
            range.selectNodeContents(text);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    },

    /* iframe highlight */
    _initHighlight: function () {

        var self = Vvveb.Builder;


        self.frameBody.on("mousemove touchmove", function (event) {
            if (self.underEdit) {
                return;
            }
            if (event.target && isElement(event.target) && event.originalEvent) {
                self.highlightEl = target = jQuery(event.target);

                // if (!self.isDragging && target[0].tagName === 'BEGINCONTENT') {
                //     return;
                // }
                var offset = target.offset();
                var height = target.outerHeight();
                var halfHeight = Math.max(height / 2, 50);
                var width = target.outerWidth();
                var halfWidth = Math.max(width / 2, 50);

                var x = (event.clientX || event.originalEvent.clientX);
                var y = (event.clientY || event.originalEvent.clientY);

                if (self.isDragging) {
                    var parent = self.highlightEl;

                    try {
                        if (event.originalEvent) {
                            if ((offset.top < (y - halfHeight)) || (offset.left < (x - halfWidth))) {
                                if (isIE11)
                                    self.highlightEl.append(self.dragElement);
                                else
                                    self.dragElement.appendTo(parent);
                            } else {
                                if (isIE11)
                                    self.highlightEl.prepend(self.dragElement);
                                else
                                    self.dragElement.prependTo(parent);
                            }
                            ;

                            if (self.designerMode) {
                                var parentOffset = self.dragElement.offsetParent().offset();

                                self.dragElement.css({
                                    "position": "absolute",
                                    'left': x - (parentOffset.left - self.frameDoc.scrollLeft()),
                                    'top': y - (parentOffset.top - self.frameDoc.scrollTop()),
                                });
                            }
                        }

                    } catch (err) {
                        console.log(err);
                        return false;
                    }

                    if (!self.designerMode && self.iconDrag) self.iconDrag.css({
                        'left': x + 275/*left panel width*/,
                        'top': y - 30
                    });
                }// else //uncomment else to disable parent highlighting when dragging
                {

                    jQuery("#highlight-box").css(
                        {
                            "top": offset.top - self.frameDoc.scrollTop(),
                            "left": offset.left - self.frameDoc.scrollLeft(),
                            "width": width,
                            "height": height,
                            "display": event.target.hasAttribute('contenteditable') ? "none" : "block",
                            "border": self.isDragging ? "1px dashed aqua" : "",//when dragging highlight parent with green
                        });

                    if (height < 50) {
                        jQuery("#section-actions").addClass("outside");
                    } else {
                        jQuery("#section-actions").removeClass("outside");
                    }
                    jQuery("#highlight-name").html(self._getElementType(event.target));
                    if (self.isDragging) jQuery("#highlight-name").hide(); else jQuery("#highlight-name").show('slow');//hide tag name when dragging
                }
            }

        });

        self.frameBody.on("mouseup touchend", function (event) {
            self.underEdit = false;
            // debugger;
            if (self.isDragging) {
                self.isDragging = false;
                if (self.iconDrag) self.iconDrag.remove();
                $("#component-clone").remove();

                if (self.dragMoveMutation === false) {
                    if (self.component.dragHtml) //if dragHtml is set for dragging then set real component html
                    {
                        newElement = $(self.component.html);
                        self.dragElement.replaceWith(newElement);
                        self.dragElement = newElement;
                        if (self.component.script.length > 0) {
                            $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('body').after(`<script>` + self.component.script + `</script>`);
                        }
                        console.log('type:', typeof self.component.afterDrop);
                        if (typeof self.component.afterDrop === 'function') {

                            self.component.afterDrop();
                        }
                    }
                    if (self.component.afterDrop) self.dragElement = self.component.afterDrop(self.dragElement);
                }

                self.dragElement.css("border", "");

                node = self.dragElement.get(0);
                self.selectNode(node);
                self.loadNodeComponent(node);

                if (self.dragMoveMutation === false) {

                    Vvveb.Undo.addMutation({
                            type: 'childList',
                            target: node.parentNode,
                            addedNodes: [node],
                            nextSibling: node.nextSibling
                        }
                    );


                    Vvveb.Sections.loadSections();
                    Vvveb.Sections.init();
                } else {
                    self.dragMoveMutation.newParent = node.parentNode;
                    self.dragMoveMutation.newNextSibling = node.nextSibling;

                    Vvveb.Undo.addMutation(self.dragMoveMutation);
                    self.dragMoveMutation = false;

                }

            }
        });

        self.frameBody.on("dblclick", function (event) {

            if (Vvveb.Builder.isPreview == false) {
                self.texteditEl = target = jQuery(event.target);

                Vvveb.WysiwygEditor.edit(self.texteditEl);

                self.SelectText(self.texteditEl);

                self.texteditEl.attr({'contenteditable': true, 'spellcheckker': false});

                self.texteditEl.on("blur keyup paste input", function (event) {

                    let height = $(event.target).outerHeight();

                    if (height < 34) {
                        height = 34;
                    }
                    jQuery("#select-box").css({
                        "width": $(event.target).outerWidth(),
                        "height": height
                    });
                });

                jQuery("#select-box").addClass("text-edit").find("#select-actions").hide('slow');
                jQuery("#highlight-box").hide('slow');
                self.underEdit = true;
                self.underEditNode = event.target;

            }
        });

        self.frameBody.on("click", function (event) {

            if (Vvveb.Builder.isPreview == false) {
                var target = event.target;

                if (target) {

                    //if component properties is loaded in left panel tab instead of right panel show tab
                    if ($(".component-properties-tab").is(":visible"))//if properites tab is enabled/visible
                        $('.component-properties-tab a').show('slow').tab('show');
                    let tag = jQuery(event.target).prop("tagName");

                    if (tag.length > 0 && tag !== 'BEGINCONTENT') {
                        self.selectNode(target);
                        self.loadNodeComponent(target);
                    }

                }
                if (target === self.underEditNode) {
                    self.underEdit = true;
                } else {
                    self.underEdit = false;
                }
                event.preventDefault();
                return false;
            }

        });

        self.frameBody.find('a').click(function (e) {
            e.preventDefault();
        })
    },

    _initBox: function () {
        var self = this;

        $("#drag-btn").on("mousedown", function (event) {
            jQuery("#select-box").hide('slow');
            if (self.selectedEl[0].tagName === 'BEGINCONTENT') {
                return;
            }
            self.dragElement = self.selectedEl.css("position", "");
            self.isDragging = true;

            node = self.dragElement.get(0);

            self.dragMoveMutation = {
                type: 'move',
                target: node,
                oldParent: node.parentNode,
                oldNextSibling: node.nextSibling
            };

            //self.selectNode(false);
            event.preventDefault();
            return false;
        });

        $("#down-btn").on("click", function (event) {
            jQuery("#select-box").hide('slow');
            if (self.selectedEl[0].tagName === 'BEGINCONTENT') {
                return;
            }
            node = self.selectedEl.get(0);
            oldParent = node.parentNode;
            oldNextSibling = node.nextSibling;

            next = self.selectedEl.next();

            if (next.length > 0) {
                next.after(self.selectedEl);
            } else {
                self.selectedEl.parent().after(self.selectedEl);
            }

            Vvveb.Sections.loadSections();
            Vvveb.Sections.init();

            newParent = node.parentNode;
            newNextSibling = node.nextSibling;

            Vvveb.Undo.addMutation({
                type: 'move',
                target: node,
                oldParent: oldParent,
                newParent: newParent,
                oldNextSibling: oldNextSibling,
                newNextSibling: newNextSibling
            });

            event.preventDefault();

            return false;
        });

        $("#up-btn").on("click", function (event) {

            jQuery("#select-box").hide('slow');
            if (self.selectedEl[0].tagName === 'BEGINCONTENT') {
                return;
            }
            node = self.selectedEl.get(0);
            oldParent = node.parentNode;
            oldNextSibling = node.nextSibling;

            next = self.selectedEl.prev();

            if (next.length > 0) {
                next.before(self.selectedEl);
            } else {
                self.selectedEl.parent().before(self.selectedEl);
            }

            Vvveb.Sections.loadSections();
            Vvveb.Sections.init();

            newParent = node.parentNode;
            newNextSibling = node.nextSibling;

            Vvveb.Undo.addMutation({
                type: 'move',
                target: node,
                oldParent: oldParent,
                newParent: newParent,
                oldNextSibling: oldNextSibling,
                newNextSibling: newNextSibling
            });

            event.preventDefault();

            return false;
        });

        $("#clone-btn").on("click", function (event) {

            if (self.selectedEl[0].tagName === 'BEGINCONTENT') {
                return;
            }

            clone = self.selectedEl.clone();

            self.selectedEl.after(clone);

            self.selectedEl = clone.click();

            node = clone.get(0);
            Vvveb.Undo.addMutation({
                type: 'childList',
                target: node.parentNode,
                addedNodes: [node],
                nextSibling: node.nextSibling
            });

            event.preventDefault();

            Vvveb.Sections.loadSections();
            Vvveb.Sections.init();

            return false;
        });

        $("#parent-btn").on("click", function (event) {
            if (self.selectedEl[0].tagName === 'BEGINCONTENT') {
                return;
            }
            node = self.selectedEl.parent().get(0);

            self.selectNode(node);
            self.loadNodeComponent(node);

            event.preventDefault();

            Vvveb.Sections.loadSections();
            Vvveb.Sections.init();

            return false;
        });

        $("#delete-btn").on("click", function (event) {

            jQuery("#select-box").hide('slow');
            if (self.selectedEl[0].tagName === 'BEGINCONTENT') {
                return;
            }
            node = self.selectedEl.get(0);

            Vvveb.Undo.addMutation({
                type: 'childList',
                target: node.parentNode,
                removedNodes: [node],
                nextSibling: node.nextSibling
            });

            self.selectedEl.remove();

            event.preventDefault();

            Vvveb.Sections.loadSections();
            Vvveb.Sections.init();

            return false;
        });

        var addSectionBox = jQuery("#add-section-box");
        var addSectionElement = {};

        $("#add-section-btn").on("click", function (event) {

            var org = self.highlightEl;
            if (self.highlightEl.prop('tagName') === 'BEGINCONTENT') {

                self.highlightEl = self.highlightEl.children(':last-child');
                if (self.highlightEl.length === 0) {
                    $('#add-section-insert-mode-inside').prop("checked", true);
                    $('#add-section-insert-mode-after').prop("disabled", true);
                    $('#add-section-insert-mode-before').prop("disabled", true);
                } else {
                    $('#add-section-insert-mode-after').prop("checked", true);
                }
            }
            addSectionElement = self.highlightEl;

            var offset = jQuery(addSectionElement).offset();

            if (typeof offset === "undefined") {
                offset = jQuery(addSectionElement).parent().offset();
                if (typeof offset === "undefined") {
                    addSectionElement = org;
                    offset = jQuery(org).parent().offset();
                }
            } else {
                $('#add-section-insert-mode-after').prop("disabled", false);
                $('#add-section-insert-mode-before').prop("disabled", false);
            }
            var top = (offset.top - self.frameDoc.scrollTop()) + addSectionElement.outerHeight();
            var left = (offset.left - self.frameDoc.scrollLeft()) + (addSectionElement.outerWidth() / 2) - (addSectionBox.outerWidth() / 2);
            var outerHeight = $(window.FrameWindow).height() + self.frameDoc.scrollTop();

            //check if box is out of viewport and move inside
            if (left < 0) left = 0;
            if (top < 0) top = 0;
            if ((left + addSectionBox.outerWidth()) > self.frameDoc.outerWidth()) left = self.frameDoc.outerWidth() - addSectionBox.outerWidth();
            if (((top + addSectionBox.outerHeight()) + self.frameDoc.scrollTop()) > outerHeight) top = top - addSectionBox.outerHeight();


            addSectionBox.css(
                {
                    "top": top,
                    "left": left,
                    "display": "block",
                });
            addSectionBox.draggable();
            event.preventDefault();
            return false;
        });

        $(document).keydown(function (e) {
            // console.log(e);
            if (e.ctrlKey) {
                switch (e.key) {
                    case "n":
                        console.log('new element');
                        $("#add-section-btn").trigger('click');
                        break;
                }
            }
            if (e.key === "Escape") {
                console.log('exit');
                $("#close-section-btn").trigger('click');
            }
        })

        $("#add-section-float-btn").on("click", function (event) {

            var org = self.highlightEl;
            if (self.highlightEl.prop('tagName') === 'BEGINCONTENT') {

                self.highlightEl = self.highlightEl.children(':last-child');
                if (self.highlightEl.length === 0) {
                    $('#add-section-insert-mode-inside').prop("checked", true);
                    $('#add-section-insert-mode-after').prop("disabled", true);
                    $('#add-section-insert-mode-before').prop("disabled", true);
                } else {
                    $('#add-section-insert-mode-after').prop("checked", true);
                }
            }
            addSectionElement = self.highlightEl;

            var offset = jQuery(addSectionElement).offset();

            if (typeof offset === "undefined") {
                offset = jQuery(addSectionElement).parent().offset();
                if (typeof offset === "undefined") {
                    addSectionElement = org;
                    offset = jQuery(org).parent().offset();
                }
            } else {
                $('#add-section-insert-mode-after').prop("disabled", false);
                $('#add-section-insert-mode-before').prop("disabled", false);
            }
            var top = (offset.top - self.frameDoc.scrollTop()) + addSectionElement.outerHeight();
            var left = (offset.left - self.frameDoc.scrollLeft()) + (addSectionElement.outerWidth() / 2) - (addSectionBox.outerWidth() / 2);
            var outerHeight = $(window.FrameWindow).height() + self.frameDoc.scrollTop();

            //check if box is out of viewport and move inside
            if (left < 0) left = 0;
            if (top < 0) top = 0;
            if ((left + addSectionBox.outerWidth()) > self.frameDoc.outerWidth()) left = self.frameDoc.outerWidth() - addSectionBox.outerWidth();
            if (((top + addSectionBox.outerHeight()) + self.frameDoc.scrollTop()) > outerHeight) top = top - addSectionBox.outerHeight();


            addSectionBox.css(
                {
                    "top": top,
                    "left": left,
                    "display": "block",
                });

            addSectionBox.draggable();
            event.preventDefault();
            return false;
        });


        $("#close-section-btn").on("click", function (event) {
            addSectionBox.hide('slow');
        });

        function addSectionComponent(html, after) {
            var node = $(html);
            switch (after) {
                case 'after':
                    addSectionElement.after(node);
                    break;
                case 'before':
                    addSectionElement.before(node);
                    break;
                case 'inside':
                    addSectionElement.append(node);
                    break;
            }


            node = node.get(0);

            Vvveb.Undo.addMutation({
                type: 'childList',
                target: node.parentNode,
                addedNodes: [node],
                nextSibling: node.nextSibling
            });

            Vvveb.Sections.loadSections();
            Vvveb.Sections.init();

        }

        $(".components-list li ol li", addSectionBox).on("click", function (event) {

            var component = Vvveb.Components.get(this.dataset.type);
            var html = component.html;
            let ifameBody = $($("#iframe-wrapper > iframe").get(0).contentWindow.document);
            if (component.enginCode) {
                let enginScriptElement = ifameBody.find("script#script_" + component.id);
                if (enginScriptElement.length === 0) {
                    ifameBody.find('body').append('<script id="#script_' + component.id + '">' + component.enginCode + ";;" + component.activeCode + '</script>');
                } else {
                    ifameBody.find("script#script_" + component.id).append(component.activeCode);
                }
            }


            addSectionComponent(html, (jQuery("[name='add-section-insert-mode']:checked").val()));

            if (component.script && component.script.length > 0) {
                $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('body').after(`<script>` + component.script + `</script>`);
            }


            addSectionBox.hide('slow');
        });

        $(".blocks-list li ol li", addSectionBox).on("click", function (event) {
            var html = Vvveb.Blocks.get(this.dataset.type).html;
            let loc = 'inside';

            addSectionComponent(html, (jQuery("[name='add-section-insert-mode']:checked").val()));
            if (Vvveb.Blocks.get(this.dataset.type).script && Vvveb.Blocks.get(this.dataset.type).script.length > 0) {
                $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('body').after(`<script>` + Vvveb.Blocks.get(this.dataset.type).script + `</script>`);
            }
            addSectionBox.hide('slow');

            Vvveb.Sections.loadSections();
            Vvveb.Sections.init();

        });

        $('[href="#sections-list"]').click(function () {
            Vvveb.Sections.loadSections();
            Vvveb.Sections.init();
        });
    },

    /* drag and drop */
    _initDragdrop: function () {

        var self = this;
        self.isDragging = false;

        $('.drag-elements-sidepane ul > li > ol > li').on("mousedown touchstart", function (event) {

            $this = jQuery(this);

            $("#component-clone").remove();

            if ($this.data("drag-type") == "component")
                self.component = Vvveb.Components.get($this.data("type"));
            else
                self.component = Vvveb.Blocks.get($this.data("type"));

            if (self.component.dragHtml) {
                html = self.component.dragHtml;
            } else {
                html = self.component.html;
            }

            self.dragElement = $(html);
            self.dragElement.css("border", "1px dashed #4285f4");
            self.dragElement.css("transition", "0.2s ease");
            self.dragElement.css("scale", "0.5");

            if (self.component.dragStart) self.dragElement = self.component.dragStart(self.dragElement);

            self.isDragging = true;
            if (Vvveb.dragIcon == 'html') {
                self.iconDrag = $(html).attr("id", "dragElement-clone").css('position', 'absolute');
            } else if (self.designerMode == false) {
                self.iconDrag = $('<img src=""/>').attr({
                    "id": "dragElement-clone",
                    'src': $this.css("background-image").replace(/^url\(['"](.+)['"]\)/, '$1')
                }).css({
                    'z-index': 100,
                    'position': 'absolute',
                    'width': '64px',
                    'height': '64px',
                    'top': event.originalEvent.y,
                    'left': event.originalEvent.x
                });
            }

            $('body').append(self.iconDrag);

            event.preventDefault();
            return false;
        });

        $('body').on('mouseup touchend', function (event) {

            if (self.iconDrag && self.isDragging == true) {

                self.isDragging = false;
                $("#component-clone").remove();
                self.iconDrag.remove();
                if (self.dragElement) {
                    self.dragElement.remove();
                }
            }
        });

        $('body').on('mousemove touchmove', function (event) {
            if (self.iconDrag && self.isDragging == true) {

                var x = (event.clientX || event.originalEvent.clientX);
                var y = (event.clientY || event.originalEvent.clientY);

                self.iconDrag.css({'left': x - 60, 'top': y - 30});

                elementMouseIsOver = document.elementFromPoint(x - 60, y - 40);

                //if drag elements hovers over iframe switch to iframe mouseover handler
                if (elementMouseIsOver && elementMouseIsOver.tagName == 'IFRAME') {

                    self.frameBody.trigger("mousemove", event);
                    event.stopPropagation();
                    self.selectNode(false);
                }
            }
        });

        $('.drag-elements-sidepane ul > ol > li > li').on("mouseup touchend", function (event) {

            self.isDragging = false;
            $("#component-clone").remove();
        });

    },

    removeHelpers: function (html, keepHelperAttributes = false) {
        //tags like stylesheets or scripts
        html = html.replace(/<.*?data-vvveb-helpers.*?>/gi, "");
        //attributes
        if (!keepHelperAttributes) {
            html = html.replace(/\s*data-vvveb-\w+(=["'].*?["'])?\s*/gi, "");
        }

        return html;
    },

    getHtml: function (keepHelperAttributes = true) {

        var doc = window.FrameDocument;
        var hasDoctpe = (doc.doctype !== null);
        var html = "";

        $(window).triggerHandler("vvveb.getHtml.before", doc);

        if (hasDoctpe) html =
            "<!DOCTYPE "
            + doc.doctype.name
            + (doc.doctype.publicId ? ' PUBLIC "' + doc.doctype.publicId + '"' : '')
            + (!doc.doctype.publicId && doc.doctype.systemId ? ' SYSTEM' : '')
            + (doc.doctype.systemId ? ' "' + doc.doctype.systemId + '"' : '')
            + ">\n";

        html += "<html>\n" + doc.documentElement.innerHTML + "\n</html>";

        return $(html).find('begincontent').html();
        //
        // html = this.removeHelpers(html, keepHelperAttributes);
        //
        // var filter = $(window).triggerHandler("vvveb.getHtml.after", html);
        // if (filter) return filter;
        //
        // return html;
    },

    setHtml: function (html) {
        //update only body to avoid breaking iframe css/js relative paths
        // start = html.indexOf("<body");
        // end = html.indexOf("</body");
        // if (start >= 0 && end >= 0) {
        //     body = html.slice(html.indexOf(">", start) + 1, end);
        // } else {
        //     body = html
        // }

        if (this.runJsOnSetHtml)
            self.frameBody.html(html);

        window.FrameDocument.getElementsByTagName("BEGINCONTENT")[0].innerHTML = html;


        //below methods brake document relative css and js paths
        //return self.iframe.outerHTML = html;
        //return self.documentFrame.html(html);
        //return self.documentFrame.attr("srcdoc", html);
    },

    getUrlParameter: function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    },


    init_modal: function () {

        $('body').prepend(tmpl("vvveb-page-details", {}));
        $('#openModal').click(function (e) {
            $('#detailModal').modal('show');
        });
    },

    exit: function () {
        var app = this;
        swal("آیا تغییرات را قبل از خروج ذخیره میکنید؟", {
            dangerMode: true,
            buttons: {
                canc:
                    "انصراف",
                save:
                    {
                        text: "ذخیره خروج",
                        value: "save",
                        icon: "success",
                    },
                exit:
                    {
                        text: "فقط خروج",
                        value: "nsave",
                        icon: "success",
                    },

            },
        })
            .then((value) => {
                switch (value) {

                    case "canc":

                        break;

                    case "save":
                        var url = Vvveb.FileManager.getCurrentUrl();

                        Vvveb.Builder.saveAjax(url, null, function (data) {
                            $('#message-modal').modal().find(".modal-body").html("برگه ذخیره شد: " + data);
                            window.location = exitUrl;
                        });

                        break;

                    case 'nsave':
                        window.location = exitUrl;
                }
            });
    },

    saveAjax: function (fileName, startTemplateUrl, callback) {
        var data = {};
        data["fileName"] = (fileName && fileName != "") ? fileName : Vvveb.FileManager.getCurrentUrl();
        data["startTemplateUrl"] = startTemplateUrl;
        data["title"] = $('#page-title-input').val();
        data["seo"] = $('#seodesc').val();
        data["template"] = $('#pageType option:selected').val();
        data["status"] = $('#status option:selected').val();
        data["slug"] = $('#slug').val();


        // < background file >
        {
            var fileInput = $('#fileBack');
            data["back"] = fileInput.val();
        }
        // </ background file >


        data["default"] = $('#defaultPage:checked').val();

        data["id"] = Vvveb.Builder.getUrlParameter('id');

        /**
         * Unicode to ASCII (encode data to Base64)
         * @param {string} data
         * @return {string}
         */
        function utoa(data) {
            return btoa(unescape(encodeURIComponent(data)));
        }

        if (!startTemplateUrl || startTemplateUrl == null) {
            data["html"] = this.getHtml();
        }
        data['html'] = data['html'].replace(/[\u00A0-\u9999<>\&]/g, function (i) {
            return '&#' + i.charCodeAt(0) + ';';
        });
        $.ajax({
            type: "POST",
            url: saveUrl,//set your server side save script url
            data: data,
            cache: false,
            success: function (res) {

                if (callback) callback(res);

            },
            error: function (res) {
                alert(res.responseText);
            }
        });
    },

    setDesignerMode: function (designerMode = false) {
        this.designerMode = designerMode;
    },


    moveNodeUp: function (node) {
        if (!node) {
            node = Vvveb.Builder.selectedEl.get(0);
        }

        oldParent = node.parentNode;
        oldNextSibling = node.nextSibling;

        next = $(node).prev();

        if (next.length > 0) {
            next.before(node);
        } else {
            $(node).parent().before(node);
        }

        newParent = node.parentNode;
        newNextSibling = node.nextSibling;

        Vvveb.Undo.addMutation({
            type: 'move',
            target: node,
            oldParent: oldParent,
            newParent: newParent,
            oldNextSibling: oldNextSibling,
            newNextSibling: newNextSibling
        });

    },

    moveNodeDown: function (node) {
        if (!node) {
            node = Vvveb.Builder.selectedEl.get(0);
        }

        oldParent = node.parentNode;
        oldNextSibling = node.nextSibling;

        next = $(node).next();

        if (next.length > 0) {
            next.after(node);
        } else {
            $(node).parent().after(node);
        }

        newParent = node.parentNode;
        newNextSibling = node.nextSibling;

        Vvveb.Undo.addMutation({
            type: 'move',
            target: node,
            oldParent: oldParent,
            newParent: newParent,
            oldNextSibling: oldNextSibling,
            newNextSibling: newNextSibling
        });
    },

};

Vvveb.CodeEditor = {

    isActive: false,
    oldValue: '',
    doc: false,

    init: function (doc = null) {

        let html = Vvveb.Builder.getHtml();
        $("#vvveb-code-editor textarea").val(html);

        $("#vvveb-code-editor textarea").keyup(function () {
            delay(Vvveb.Builder.setHtml(this.value), 1000);
        });

        //load code on document changes
        Vvveb.Builder.frameBody.on("vvveb.undo.add vvveb.undo.restore", function (e) {
            Vvveb.CodeEditor.setValue();
        });
        //load code when a new url is loaded
        Vvveb.Builder.documentFrame.on("load", function (e) {
            Vvveb.CodeEditor.setValue();
        });

        this.isActive = true;
    },

    setValue: function (value) {
        if (this.isActive) {
            $("#vvveb-code-editor textarea").val(Vvveb.Builder.getHtml());
        }
    },

    destroy: function (element) {
        //this.isActive = false;
    },

    toggle: function () {

        if (this.isActive != true) {
            this.isActive = true;
            return this.init();
        }
        this.isActive = false;
        this.destroy();
    }
}

Vvveb.Gui = {

    init: function () {
        $("[data-vvveb-action]").each(function () {
            on = "click";
            if (this.dataset.vvvebOn) on = this.dataset.vvvebOn;

            $(this).on(on, Vvveb.Gui[this.dataset.vvvebAction]);
            if (this.dataset.vvvebShortcut) {
                $(document).bind('keydown', this.dataset.vvvebShortcut, Vvveb.Gui[this.dataset.vvvebAction]);
                $(window.FrameDocument, window.FrameWindow).bind('keydown', this.dataset.vvvebShortcut, Vvveb.Gui[this.dataset.vvvebAction]);
            }
        });
    },

    undo: function () {
        if (Vvveb.WysiwygEditor.isActive) {
            Vvveb.WysiwygEditor.undo();
        } else {
            Vvveb.Undo.undo();
        }
        Vvveb.Builder.selectNode();
    },

    redo: function () {
        if (Vvveb.WysiwygEditor.isActive) {
            Vvveb.WysiwygEditor.redo();
        } else {
            Vvveb.Undo.redo();
        }
        Vvveb.Builder.selectNode();
    },

    //show modal with html content
    save: function () {
        $('#textarea-modal textarea').val(Vvveb.Builder.getHtml());
        $('#textarea-modal').modal();
    },

    exit: function () {
        return Vvveb.Builder.exit();
    },

    //post html content through ajax to save to filesystem/db
    saveAjax: function () {

        var url = Vvveb.FileManager.getCurrentUrl();

        return Vvveb.Builder.saveAjax(url, null, function (data) {
            $('#message-modal').modal().find(".modal-body").html("File saved at: " + data);
        });
    },

    download: function () {
        filename = /[^\/]+$/.exec(Vvveb.Builder.iframe.src)[0];
        uriContent = "data:application/octet-stream," + encodeURIComponent(Vvveb.Builder.getHtml());

        var link = document.createElement('a');
        if ('download' in link) {
            link.dataset.download = filename;
            link.href = uriContent;
            link.target = "_blank";

            document.body.appendChild(link);
            result = link.click();
            document.body.removeChild(link);
            link.remove();

        } else {
            location.href = uriContent;
        }
    },

    viewport: function () {
        $("#canvas").attr("class", this.dataset.view);
    },

    toggleEditor: function () {

        $("#vvveb-builder").toggleClass("bottom-panel-expand");
        $("#toggleEditorJsExecute").toggle('slow');
        Vvveb.CodeEditor.toggle('slow');
    },

    toggleEditorJsExecute: function () {
        Vvveb.Builder.runJsOnSetHtml = this.checked;
    },

    preview: function () {
        (Vvveb.Builder.isPreview == true) ? Vvveb.Builder.isPreview = false : Vvveb.Builder.isPreview = true;
        $("#iframe-layer").toggle('slow');
        $("#vvveb-builder").toggleClass("preview");
    },

    fullscreen: function () {
        launchFullScreen(document); // the whole page
    },

    componentSearch: function () {
        searchText = this.value;

        $("#left-panel .components-list li ol li").each(function () {
            $this = $(this);

            $this.hide('slow');
            if ($this.data("search").indexOf(searchText) > -1) $this.show('slow');
        });
    },

    clearComponentSearch: function () {
        $(".component-search").val("").keyup();
    },

    blockSearch: function () {
        searchText = this.value;

        $("#left-panel .blocks-list li ol li").each(function () {
            $this = $(this);

            $this.hide('slow');
            if ($this.data("search").indexOf(searchText) > -1) $this.show('slow');
        });
    },

    clearBlockSearch: function () {
        $(".block-search").val("").keyup();
    },

    addBoxComponentSearch: function () {
        searchText = this.value;

        $("#add-section-box .components-list li ol li").each(function () {
            $this = $(this);

            $this.hide('slow');
            if ($this.data("search").indexOf(searchText) > -1) $this.show('slow');
        });
    },


    addBoxBlockSearch: function () {
        searchText = this.value;

        $("#add-section-box .blocks-list li ol li").each(function () {
            $this = $(this);

            $this.hide('slow');
            if ($this.data("search").indexOf(searchText) > -1) $this.show('slow');
        });
    },

//Pages, file/components tree
    newPage: function () {

        var newPageModal = $('#new-page-modal');

        newPageModal.modal("show").find("form").off("submit").submit(function (event) {

            var title = $("input[name=title]", newPageModal).val();
            var startTemplateUrl = $("select[name=startTemplateUrl]", newPageModal).val();
            var fileName = $("input[name=fileName]", newPageModal).val();

            //replace nonalphanumeric with dashes and lowercase for name
            var name = title.replace(/\W+/g, '-').toLowerCase();
            //allow only alphanumeric, dot char for extension (eg .html) and / to allow typing full path including folders
            fileName = fileName.replace(/[^A-Za-z0-9\.\/]+/g, '-').toLowerCase();

            //add your server url/prefix/path if needed
            var url = "" + fileName;


            Vvveb.FileManager.addPage(name, title, url);
            event.preventDefault();

            return Vvveb.Builder.saveAjax(url, startTemplateUrl, function (data) {
                Vvveb.FileManager.loadPage(name);
                Vvveb.FileManager.scrollBottom();
                newPageModal.modal("hide");
            });
        });

    },

    deletePage: function () {

    },

    setDesignerMode: function () {
        //aria-pressed attribute is updated after action is called and we check for false instead of true
        var designerMode = this.attributes["aria-pressed"].value != "true";
        Vvveb.Builder.setDesignerMode(designerMode);
    },
//layout
    togglePanel: function (panel, cssVar) {
        var panel = $(panel);
        var body = $("body");
        var prevValue = body.css(cssVar);
        if (prevValue !== "0px") {
            panel.data("layout-toggle", prevValue);
            body.css(cssVar, "0px");
            panel.hide('slow');
        } else {
            prevValue = panel.data("layout-toggle");
            body.css(cssVar, '');
            panel.show('slow');

        }
    },

    toggleFileManager: function () {
        Vvveb.Gui.togglePanel("#filemanager", "--builder-filemanager-height");
    },

    toggleLeftColumn: function () {
        Vvveb.Gui.togglePanel("#left-panel", "--builder-left-panel-width");
    },

    toggleRightColumn: function () {
        Vvveb.Gui.togglePanel("#right-panel", "--builder-right-panel-width");
        var rightColumnEnabled = this.attributes["aria-pressed"].value == "true";

        $("#vvveb-builder").toggleClass("no-right-panel");
        $(".component-properties-tab").toggle('slow');

        Vvveb.Components.componentPropertiesElement = (rightColumnEnabled ? "#right-panel" : "#left-panel") + " .component-properties";
        if ($("#properties").is(":visible")) $('.component-tab a').show('slow').tab('show');

    },
    toggleStyleHelpers: function () {
        if (styleHelpers.length > 0) {
            let styleTag = '<style id="styleHelpers">' + styleHelpers + '</style>';
            $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('body').append(styleTag);
            styleHelpers = '';
            $('#toggle-style-helpers-btn').css('background', '#d4eec3');
        } else {
            styleHelpers = $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('#styleHelpers').text();
            $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('#styleHelpers').remove();
            $('#toggle-style-helpers-btn').css('background', '#eec3c5');

        }


    },
    toggleJavaScript: function () {
        if (allScripts.length === 0) {
            let scripts = $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('script');
            $.each(scripts, function (index, node) {

                var id = $(node).attr('id');
                var code = node.innerText;
                var src = $(node).attr('src');
                allScripts += '<script ' + (id ? 'id="' + id + '"' : '') + (src ? 'src="' + src + '"' : '') + ' >' + (code.length > 0 ? code : '') + "</script>\n\n";
                $(node).remove();
                $('#toggle-js-script-btn').css('background', '#eec3c5');
                Vvveb.Gui.turnOff($(document.getElementsByTagName('iframe')[0].contentDocument.body.getElementsByTagName('div')));
                Vvveb.Gui.turnOff($(document.getElementsByTagName('iframe')[0].contentDocument.body.getElementsByTagName('a')));

            });

        } else {
            $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('body').append(allScripts);
            allScripts='';
            $('#toggle-js-script-btn').css('background', '#d4eec3');
        }
    },
    turnOff:function(nodes){
        $.each(nodes,function(index,node){
            var new_element = node.cloneNode(true);
            node.parentNode.replaceChild(new_element, node);

        })
    }
}

Vvveb.StyleManager = {
    setStyle: function (element, styleProp, value) {
        return element.css(styleProp, value);
    },


    _getCssStyle: function (element, styleProp) {
        var value = "";
        var el = element.get(0);

        if (el.style && el.style.length > 0 && el.style[styleProp])//check inline
            var value = el.style[styleProp];
        else if (el.currentStyle)	//check defined css
            var value = el.currentStyle[styleProp];
        else if (window.getComputedStyle) {
            var value = document.defaultView.getDefaultComputedStyle ?
                document.defaultView.getDefaultComputedStyle(el, null).getPropertyValue(styleProp) :
                window.getComputedStyle(el, null).getPropertyValue(styleProp);
        }

        return value;
    },

    getStyle: function (element, styleProp) {
        return this._getCssStyle(element, styleProp);
    }
}

Vvveb.ContentManager = {
    getAttr: function (element, attrName) {
        return element.attr(attrName);
    },

    setAttr: function (element, attrName, value) {
        return element.attr(attrName, value);
    },

    setHtml: function (element, html) {
        return element.html(html);
    },

    getHtml: function (element) {
        return element.html();
    },
}


Vvveb.FileManager = {
    tree: false,
    pages: {},
    currentPage: false,

    init: function () {
        this.tree = $("#filemanager .tree > ol").html("");

        $(this.tree).on("click", "a", function (e) {
            e.preventDefault();
            return false;
        });

        $(this.tree).on("click", "li[data-page] label", function (e) {
            var page = $(this.parentNode).data("page");

            if (page) Vvveb.FileManager.loadPage(page);
            return false;
        })

        $(this.tree).on("click", "li[data-component] label ", function (e) {
            node = $(e.currentTarget.parentNode).data("node");

            Vvveb.Builder.frameHtml.animate({
                scrollTop: $(node).offset().top
            }, 1000);

            Vvveb.Builder.selectNode(node);
            Vvveb.Builder.loadNodeComponent(node);

            //e.preventDefault();
            //return false;
        }).on("mouseenter", "li[data-component] label", function (e) {

            node = $(e.currentTarget).data("node");
            $(node).trigger("mousemove");

        });
    },

    addPage: function (name, data) {

        this.pages[name] = data;
        data['name'] = name;

        var folder = this.tree;
        if (data.folder) {
            if (!(folder = this.tree.find('li[data-folder="' + data.folder + '"]')).length) {
                data.folderTitle = data.folder[0].toUpperCase() + data.folder.slice(1);
                folder = $(tmpl("vvveb-filemanager-folder", data));
                this.tree.append(folder);
            }

            folder = folder.find("> ol");
        }

        folder.append(
            tmpl("vvveb-filemanager-page", data));
    },

    addPages: function (pages) {
        for (page in pages) {
            this.addPage(pages[page]['name'], pages[page]);
        }
    },

    addComponent: function (name, url, title, page) {
        $("[data-page='" + page + "'] > ol", this.tree).append(
            tmpl("vvveb-filemanager-component", {name: name, url: url, title: title}));
    },

    getComponents: function (allowedComponents = {}) {

        var tree = [];

        function getNodeTree(node, parent) {
            if (node.hasChildNodes()) {
                for (var j = 0; j < node.childNodes.length; j++) {
                    child = node.childNodes[j];

                    if (child && child["attributes"] != undefined &&
                        (matchChild = Vvveb.Components.matchNode(child))) {
                        if (Array.isArray(allowedComponents)
                            && allowedComponents.indexOf(matchChild.type) == -1)
                            continue;

                        element = {
                            name: matchChild.name,
                            image: matchChild.image,
                            type: matchChild.type,
                            node: child,
                            children: []
                        };
                        element.children = [];
                        parent.push(element);
                        element = getNodeTree(child, element.children);
                    } else {
                        element = getNodeTree(child, parent);
                    }
                }
            }

            return false;
        }

        getNodeTree(window.FrameDocument.body, tree);

        return tree;
    },

    loadComponents: function (allowedComponents = {}) {

        var tree = this.getComponents(allowedComponents);
        var html = drawComponentsTree(tree);
        var j = 0;

        function drawComponentsTree(tree) {
            var html = $("<ol></ol>");
            j++;
            for (i in tree) {
                var node = tree[i];

                if (tree[i].children.length > 0) {
                    var li = $('<li data-component="' + node.name + '">\
					<label for="id' + j + '" style="background-image:url(libs/builder/' + node.image + ')"><span>' + node.name + '</span></label>\
					<input type="checkbox" id="id' + j + '">\
					</li>');
                    li.data("node", node.node);
                    li.append(drawComponentsTree(node.children));
                    html.append(li);
                } else {
                    var li = $('<li data-component="' + node.name + '" class="file">\
							<label for="id' + j + '" style="background-image:url(libs/builder/' + node.image + ')"><span>' + node.name + '</span></label>\
							<input type="checkbox" id="id' + j + '"></li>');
                    li.data("node", node.node);
                    html.append(li);
                }
            }

            return html;
        }

        $("[data-page='" + this.currentPage + "'] > ol", this.tree).replaceWith(html);
    },

    getCurrentUrl: function () {
        if (this.currentPage)
            return this.pages[this.currentPage]['url'];
    },

    reloadCurrentPage: function () {
        if (this.currentPage)
            return this.loadPage(this.currentPage);
    },

    loadPage: function (name, allowedComponents = false, disableCache = true) {
        $("[data-page]", this.tree).removeClass("active");
        $("[data-page='" + name + "']", this.tree).addClass("active");

        this.currentPage = name;
        var url = this.pages[name]['url'];

        Vvveb.Builder.loadUrl(url + (disableCache ? (url.indexOf('?') > -1 ? '&' : '?') + Math.random() : ''),
            function () {

                Vvveb.FileManager.loadComponents(allowedComponents);


            });
    },

    scrollBottom: function () {
        var scroll = this.tree.parent();
        scroll.scrollTop(scroll.prop("scrollHeight"));
    },
}


Vvveb.Sections = {

    selector: '.sections',
    sections: [],
    html: '',
    nodesIdial: [],
    treeSelected: function (id) {
        var node = this.nodesIdial['#' + id];

        // Vvveb.Builder.frameHtml.animate({
        //     scrollTop: $(node).offset().top
        // }, 500);

        //node.click();
        Vvveb.Builder.selectNode(node);
        Vvveb.Builder.loadNodeComponent(node);

    },

    treeDelete: function (id, event) {
        let idd = id.replace('fb_', '');

        $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('begincontent').find('#' + idd).remove();
        $('#' + id).empty();
        $('#' + id).remove();
        event.stopPropagation();
    },

    treeUp: function (id, event) {
        let idd = id.replace('fb_', '');

        let node = $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('begincontent').find('#' + idd)[0];
        Vvveb.Builder.moveNodeUp(node);
        // Vvveb.Builder.moveNodeUp(section.get(0));


        var e = $("#" + id);
        // move up list tree item:
        e.prev().insertAfter(e);

        event.stopPropagation();
    },

    treeDown: function (id, event) {
        let idd = id.replace('fb_', '');

        let node = $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('begincontent').find('#' + idd)[0];
        Vvveb.Builder.moveNodeDown(node);
        // Vvveb.Builder.moveNodeUp(section.get(0));

        var e = $("#" + id);

        // move down list tree item:
        e.next().insertBefore(e);


        event.stopPropagation();
    },

    treeClone: function (id, event) {


        let idd = id.replace('fb_', '');
        let uniq = this.uniqid();

        let node = $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('begincontent').find('#' + idd);
        let cloned = node.clone(true, true);
        cloned.attr('id', uniq);

        cloned.insertAfter(node);
        // Vvveb.Builder.moveNodeUp(section.get(0));

        var e = $("#" + id);

        // move down list tree item:
        let cloned2 = e.clone(true, true);
        cloned2.attr('id', 'fb_' + uniq)
            .find('.fancytree-title')
            .attr('onClick', "Vvveb.Sections.treeSelected('" + uniq + "')")
            .attr('onmouseover', "Vvveb.Sections.treeSelected('" + uniq + "')")
            .find('.buttons')
            .html("" +
                "            <span onClick=\"Vvveb.Sections.treeDelete('" + uniq + "',event)\" class=\"delete-btn\" title=\"حذف این المان\"><i class=\"la la-trash text-danger\"></i></span>\n" +
                "            <span onClick=\"Vvveb.Sections.treeUp('" + uniq + "',event)\" class=\"up-btn\" title=\"انتقال المنت به بالا\"><i class=\"la la-arrow-up\"></i></span>\n" +
                "            <span onClick=\"Vvveb.Sections.treeDown('" + uniq + "',event)\" class=\"down-btn\" title=\"انتقال المنت به پایین\"><i class=\"la la-arrow-down\"></i></span>\n" +
                "            <span onClick=\"Vvveb.Sections.treeClone('" + uniq + "',event)\" class=\"properties-btn\" title=\"ایجاد کپی از این المان\"><i class=\"la la-copy\"></i></span>\n"
            );
        cloned2.insertAfter(e);


        event.stopPropagation();
    },


    contextmenu: function (id, event) {
        console.log('delete', id);
        var self = this;


        event.stopPropagation();
    },


    getSections: function () {

        var self = this;

        var sectionList =
            $($("#iframe-wrapper > iframe").get(0).contentWindow.document).find('begincontent').children();

        sectionList.each(function (i, node) {
            let items = [];
            if ($(node).children().length > 0) {
                $.each($(node).children(), function (i, child) {
                    items[i] = self.sectionNode(child);
                })
            }


            var id = null;
            var idd = self.uniqid();
            if ($(node).attr('id') === undefined) {
                $(node).attr('id', idd);
                id = idd;
            } else {
                id = $(node).attr('id');
            }
            if ($(node).attr('class')) {
                var name = node.tagName + '.' + $(node).attr('class') ;
            } else {
                var name = node.tagName;
            }
            var section = {
                name: name,
                id: id,
                type: node.tagName.toLowerCase(),
                node: node,
                items: items
            };
            eval("self.nodesIdial['#fb_'+'" + id + "']=section.node;");
            self.sections.push(section);

        });

    },

    sectionNode: function (node) {

        var self = this;
        var id = null;
        var idd = self.uniqid();
        if ($(node).attr('id') === undefined) {
            $(node).attr('id', idd);
            id = idd;
        } else {
            id = $(node).attr('id');
        }

        let items = [];
        if ($(node).children().length > 0) {

            $.each($(node).children(), function (i, child) {
                items[i] = self.sectionNode(child, true);
            });

        }

        if ($(node).attr('class')) {
            var name = node.tagName + '.' + $(node).attr('class');
        } else {
            var name = node.tagName;
        }

        var section = {
            name: name,
            id: id,
            type: node.tagName.toLowerCase(),
            node: node,
            items: items
        };
        self.nodesIdial['#fb_' + id] = node;
        return section;
    },


    uniqid: function (a = "", b = true) {
        // debugger;
        const c = Date.now() / 1000;
        let d = c.toString(16).split(".").join("");
        while (d.length < 14) d += "0";
        let e = "";
        if (b) {
            e = "_";
            e += Math.round(Math.random() * 100000000);
        }
        return a + d + e;
    },

    addSection: function (data, ischild = false) {
        var self = this;

        self.html += '<li id="' + data.id + '">';

        var section = $(tmpl("vvveb-section", data));
        section.data("node", data.node);


        self.html += data.name;


        if (data.items.length > 0) {
            self.html += '<ul>';
            $.each(data.items, function (i, child) {
                self.addSection(child, true);
            });
            self.html += '</ul>';
        }


        self.html += '</li>';


    },

    setNodes: function (data) {
        var self = this;
        if (data.items.length > 0) {

            $.each(data.items, function (i, node) {

                var section = $('#fb_' + node.id);

                section.data("node", data.node);


                self.setNodes(node);
            })

        }
    },


    loadSections: function () {

        $('.sections').empty();
        this.sections = [];
        this.html = '';
        this.getSections();

        $(this.selector).html("");
        this.html += '<div id="section-elements"><ul >';
        for (i in this.sections) {
            this.addSection(this.sections[i]);
        }

        this.html += '</ul></div>';
        $(this.selector).append(this.html);


        $('#section-elements').fancytree(
            {
                generateIds: true,
                idPrefix: "fb_",
                quicksearch: true,
                extensions: ["filter"],
                quicksearch: true,
                icon: true,
                minExpandLevel: 3,
                autoCollapse: false,
                filter: {
                    autoApply: true,   // Re-apply last filter if lazy data is loaded
                    autoExpand: true, // Expand all branches that contain matches while filtered
                    counter: true,     // Show a badge with number of matching child nodes near parent icons
                    fuzzy: false,      // Match single characters in order, e.g. 'fb' will match 'FooBar'
                    hideExpandedCounter: true,  // Hide counter badge if parent is expanded
                    hideExpanders: false,       // Hide expanders if all child nodes are hidden by filter
                    highlight: true,   // Highlight matches by wrapping inside <mark> tags
                    leavesOnly: false, // Match end nodes only
                    nodata: true,      // Display a 'no data' status node if result is empty
                    mode: "dimm"       // Grayout unmatched nodes (pass "hide" to remove unmatched node instead)
                },
            }
        );

        // $.ui.fancytree.getTree().expandAll();
        $("#fancysearch").on("keyup", function (e) {
            var n,
                tree = $.ui.fancytree.getTree(),
                args = "autoApply autoExpand fuzzy hideExpanders highlight leavesOnly nodata".split(" "),
                opts = {},
                filterFunc = $("#branchMode").is(":checked") ? tree.filterBranches : tree.filterNodes,
                match = $(this).val();

            $.each(args, function (i, o) {
                opts[o] = $("#" + o).is(":checked");
            });
            opts.mode = $("#hideMode").is(":checked") ? "hide" : "dimm";

            if (e && e.which === $.ui.keyCode.ESCAPE || $.trim(match) === "") {
                $("button#btnResetSearch").click();
                return;
            }
            if ($("#regex").is(":checked")) {
                // Pass function to perform match
                n = filterFunc.call(tree, function (node) {
                    return new RegExp(match, "i").test(node.title);
                }, opts);
            } else {
                // Pass a string to perform case insensitive matching
                n = filterFunc.call(tree, match, opts);
            }
            $("button#btnResetSearch").attr("disabled", false);
            $("span#matches").text("(" + n + " matches)");
        }).focus();


        for (i in this.sections) {
            this.setNodes(this.sections[i]);
        }

    },

    init: function () {
        var self = this;
        $(this.selector).off();
        $(this.selector)
            //     .on("click", ".fancytree-lastsib[role=\"treeitem\"]", function (e) {
            //     var id = $(this).attr('id');
            //     var node = self.nodesIdial['#' + id];
            //     console.log($(this));
            //     console.log(id);
            //
            //     Vvveb.Builder.frameHtml.animate({
            //         scrollTop: $(node).offset().top
            //     }, 500);
            //
            //     //node.click();
            //     Vvveb.Builder.selectNode(node);
            //     Vvveb.Builder.loadNodeComponent(node);
            //     e.stopPropagation();
            // })
            .on("dblclick", ".fancytree-lastsib[role=\"treeitem\"]", function (e) {
                var id = $(this).attr('id');
                var node = self.nodesIdial['#' + id];
                node.click();
            });


        $(this.selector).on("click", ".delete-btn", function (e) {

            var section = $(e.currentTarget).parents(".section-item");
            var node = section.data("node");
            node.remove();
            section.remove();

            e.preventDefault();
        });


    }
}


// Toggle fullscreen
function launchFullScreen(document) {
    if (document.documentElement.requestFullScreen) {

        if (document.FullScreenElement)
            document.exitFullScreen();
        else
            document.documentElement.requestFullScreen();
//mozilla
    } else if (document.documentElement.mozRequestFullScreen) {

        if (document.mozFullScreenElement)
            document.mozCancelFullScreen();
        else
            document.documentElement.mozRequestFullScreen();
//webkit
    } else if (document.documentElement.webkitRequestFullScreen) {

        if (document.webkitFullscreenElement)
            document.webkitExitFullscreen();
        else
            document.documentElement.webkitRequestFullScreen();
//ie
    } else if (document.documentElement.msRequestFullscreen) {

        if (document.msFullScreenElement)
            document.msExitFullscreen();
        else
            document.documentElement.msRequestFullscreen();
    }
}
