/* 
	
The MIT License (MIT)

Copyright (c) 2014 etienne-martin
Contributions by Miro Hudak <mhudak@dev.enscope.com>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

*/

!function (t, i, o, s) {
    function e(i, o) {
        var e = this;
        this.element = i,
            this.options = o,
            this.isPopOverEnabled = 0 != this.options.popOver,
            this.isCustomPopOver = 0 != this.options.popOver.customPopOver && this.options.popOver.customPopOver != s,
            this._initImageMap(),
            this._initPopOver(),
            this._bindEvents(),
            this._remapZones(),
            t(this.element).bind("load.mapify", function () {
            e._remapZones()
        })
    }

    var r = {hoverClass: !1, popOver: !1},
        a = {hoverClass: !1, popOver: {
            content: function (t, i) {
                return ""
            },
            customPopOver: {
                selector: !1,
                contentSelector: ".mapify-popOver-content",
                visibleClass: "mapify-visible",
                alwaysVisible: !1
            },
            delay: .8,
            margin: "10px",
            width: !1,
            height: !1
        }, onAreaHighlight: !1, onMapClear: !1, instantClickOnMobile: !1},
        n = /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
        e.prototype._initPopOver = function () {
        var i = t(this.element);
        this.options.popOver.margin = parseInt(this.options.popOver.margin), this._timer = null, this._popOverTransition = "", this._popOverArrowTransition = "", this._popOverTimeout = null, isNaN(this.options.popOver.delay) || (this._popOverTransition = "all " + this.options.popOver.delay + "s", this._popOverArrowTransition = "margin " + this.options.popOver.delay + "s"), this.popOver = !1, this.popOverArrow = !1, this.isPopOverEnabled && (this.isCustomPopOver ? ("string" == typeof this.options.popOver.customPopOver && (this.options.popOver.customPopOver.selector = this.options.popOver.customPopOver), this.options.popOver.customPopOver = t.extend(!0, {}, a.popOver.customPopOver, this.options.popOver.customPopOver), this.popOver = t(this.options.popOver.customPopOver.selector), this.popOver.css({transition: this._popOverTransition})) : (i.after('<div class="mapify-popOver" style="transition:' + this._popOverTransition + '; "><div class="mapify-popOver-content"></div><div class="mapify-popOver-arrow" style="transition:' + this._popOverArrowTransition + '; "></div></div>'), this.popOver = i.next(".mapify-popOver"), this.popOverArrow = this.popOver.find(".mapify-popOver-arrow"), this.popOver.css({
            width: this.options.popOver.width,
            height: this.options.popOver.height
        })))
    },
        e.prototype._initImageMap = function () {
            var o = this, s = t(this.element);
            if (this.map = s.attr("usemap"),
                this.zones = t(this.map).find("area"),
                !s.hasClass("mapify")) {
                if (s.addClass("mapify"),
                    this._mapWidth = parseInt(s.attr("width")),
                    this._mapHeight = parseInt(s.attr("height")),
                !this._mapWidth || !this._mapHeight) return i.alert("ERROR: The width and height attributes must be specified on your image."), !1;
                s.wrap(function () {
                    return '<div class="mapify-holder"></div>'
                }),
                    this._mapHolder = s.parent(),
                    t(this.map).appendTo(this._mapHolder),
                    s.before('<img class="mapify-img" src="' + s.attr("src") + '" />'),
                    s.before('<svg class="mapify-svg" width="' + this._mapWidth + '" height="' + this._mapHeight + '"></svg>'),
                    this.svgMap = s.prev(".mapify-svg"),
                    this.zones.each(function () {
                    o._initSingleZone(this);
                    o._drawHighlight(this);
                }),
                    o._clearMap(),
                    s.wrap(function () {
                    return '<div class="mapify-imgHolder"></div>'
                }).css("opacity", 0)
            }
        },
        e.prototype._initSingleZone = function (AreaElement) {
            switch (t(AreaElement).attr("shape")) {
                case"rect":
                    var s = t(AreaElement).attr("coords").split(","), e = [];
                    t.each([0, 1, 0, 3, 2, 3, 2, 1], function (t, AreaElement) {
                        e.push(s[AreaElement])
                    }), t(AreaElement).attr("coords", e.join(",")), t(AreaElement).attr("shape", "poly");
                    break;
                case"poly":
                    break;
                default:
                    return console.log('ERROR: Area shape type "' + t(AreaElement).attr("shape") + '" is not supported.'), !1
            }
                t(AreaElement).attr("data-coords-default", t(AreaElement).attr("coords")),
                this.isPopOverEnabled && t(AreaElement).removeAttr("alt").attr("data-title",
                t(AreaElement).attr("title")).removeAttr("title");
            var r = t(AreaElement).attr("coords").split(",");
            for (var a in r) r[a] = a % 2 == 0 ? 100 * r[a] / this._mapWidth : 100 * r[a] / this._mapHeight;
            t(AreaElement).attr("data-coords", r.toString());
            var n = o.createElementNS("http://www.w3.org/2000/svg", "polygon");
            n.className = "mapify-polygon",
                n.setAttribute("fill", "none");
            if (t(AreaElement).attr('status')){
                n.setAttribute("status", "notempty");
            }
                this.svgMap.append(n);


        },
        e.prototype._bindEvents = function () {
            var i = this, s = t(this.element);
            this._hasScrolled = !1,
                t(o).bind("touchend.mapify", function () {
                i._hasScrolled || i._clearMap(), i._hasScrolled = !1
            }).bind("touchmove.mapify", function () {
                i._hasScrolled = !0
            }),
                s.bind("touchmove.mapify",
                function (t) {
            }),
                this._bindZoneEvents(),
                this._bindWindowEvents(), this._bindScrollParentEvents()
        },
        e.prototype._bindZoneEvents = function () {
            var i = this;
            this.zones.css({outline: "none"}), this.zones.bind("touchend.mapify", function (o) {
                t(this).hasClass("mapify-clickable") && (t(this).trigger("click"), i.zones.removeClass("mapify-clickable")), i.hasScrolled = !1, o.stopPropagation()
            }).bind("click.mapify", function (t) {
                if (t.originalEvent !== s && n) return !1
            }).bind("touchstart.mapify", function () {
                i.zones.removeClass("mapify-clickable"), i.svgMap.find("polygon:eq(" + t(this).index() + ")")[0].classList.contains("mapify-hover") ? t(this).addClass("mapify-clickable") : n && i.options.instantClickOnMobile ? (console.log("Triggering instantClickOnMobile after touchstart"), t(this).addClass("mapify-clickable")) : t(this).addClass("mapify-hilightable")
            }).bind("touchmove.mapify", function () {
                i.zones.removeClass("mapify-clickable mapify-hilightable")
            }).bind("mouseenter.mapify focus.mapify touchend.mapify", function (o) {
                var s = this;
                if (!t(this).hasClass("mapify-hilightable") && n) return !1;
                i._clearMap(), i.isPopOverEnabled && i._renderPopOver(s), i._drawHighlight(s), o.preventDefault()
            }).bind("mouseout.mapify", function () {
                i._clearMap()
            }), n || this.zones.bind("blur.mapify", function () {
                i._clearMap()
            })
        },
        e.prototype._bindWindowEvents = function () {
            var o = this;
            t(i).bind("resize.mapify", function () {
                o._timer && clearTimeout(o._timer), o._timer = setTimeout(function () {
                    o.isPopOverEnabled && (o.popOver.hasClass("mapify-visible") || o.isCustomPopOver || o.popOver.css({
                        left: 0,
                        top: 0
                    })),
                        o.svgMap.find("polygon").attr("points", ""),
                        o._remapZones();
                    var t = o.zones[o.svgMap.find("polygon.mapify-hover").index()];
                    t && (o.isPopOverEnabled && o._renderPopOver(t), o._drawHighlight(t))
                }, 100)
            })
        },
        e.prototype._bindScrollParentEvents = function () {
            var s = this;
            this.scrollParent = t(this.element).mapify_scrollParent(), this.scrollParent.is(o) && (this.scrollParent = t(i)), this.scrollParent.addClass("mapify-GPU").bind("scroll.mapify", function () {
                n && s.zones.removeClass("mapify-clickable mapify-hilightable"), s.isPopOverEnabled && (!s.isCustomPopOver && n && (s.popOver.css({
                    top: s.popOver.css("top"),
                    left: s.popOver.css("left"),
                    transition: "none"
                }), s.popOverArrow.css({
                    marginLeft: s.popOverArrow.css("margin-left"),
                    transition: "none"
                })), clearTimeout(t.data(this, "scrollTimer")), t.data(this, "scrollTimer", setTimeout(function () {
                    var t = s.zones[s.svgMap.find("polygon.mapify-hover").index()];
                    if (t) {
                        s._renderPopOver(t);
                        var i = s._computePopOverCompensation(t), o = i[1], e = i[2];
                        !s.isCustomPopOver && n && (s.popOver.css({
                            top: e[1],
                            left: e[0],
                            transition: s._popOverTransition
                        }), s.popOverArrow.css({marginLeft: o, transition: s._popOverArrowTransition}))
                    }
                }, 100)))
            })
        },
        e.prototype._drawHighlight = function (i) {
            var o = this, s = t(i).attr("data-group-id"), e = t(i).attr("data-hover-class");
            e = e ? this.options.hoverClass + " " + e : this.options.hoverClass, s ? t(i).siblings("area[data-group-id=" + s + "]").addBack().each(function () {
                o._highlightSingleArea(this, e)
            }) : this._highlightSingleArea(i, e), this.options.onAreaHighlight && this.options.onAreaHighlight(this, i)
        },
        e.prototype._highlightSingleArea = function (i, o) {
            var s = t(i).attr("data-coords").split(","), e = "";
            for (var r in s) e += r % 2 == 0 ? t(this.element).width() * (s[r] / 100) : "," + t(this.element).height() * (s[r] / 100) + " ";
            var a = this.svgMap.find("polygon:eq(" + t(i).index() + ")")[0];
            t(a).attr("points", e).attr("class", function (i, s) {
                var e = s;
                return t(a).hasClass("mapify-hover") || (e += " mapify-hover", o && (e += " " + o)), e
            })
        },
        e.prototype._remapZones = function () {
            var i = this;
            this.zones.each(function () {
                var o = t(this).attr("data-coords").split(",");
                for (var s in o) o[s] = s % 2 == 0 ? t(i.element).width() * (o[s] / 100) : t(i.element).height() * (o[s] / 100);
                t(this).attr("coords", o.toString())
            })
        },
        e.prototype._renderPopOver = function (t) {
            this.isCustomPopOver ? this._renderCustomPopOver(t) : this._renderDefaultPopOver(t)
        },
        e.prototype._renderCustomPopOver = function (i) {
            var o = this, s = this.options.popOver.customPopOver, e = this.popOver;
            clearTimeout(this._popOverTimeout), this._popOverTimeout = setTimeout(function () {
                var r = o.options.popOver.content(t(i), o.element);
                e.find(s.contentSelector).html(r), setTimeout(function () {
                    e.css({transition: o._popOverTransition}).addClass(s.visibleClass)
                }, 10)
            }, 100)
        },
        e.prototype._renderDefaultPopOver = function (i) {
            var o = this, s = this.popOver.outerWidth(), e = this.options.popOver.margin, r = this.popOver,
                a = this.popOverArrow, n = r.attr("data-popOver-class");
            "" != n && (r.removeClass(n), r.attr("data-popOver-class", "")), this.scrollParent.width() - 2 * e <= s ? (s = this.scrollParent.width() - 2 * e, r.css({maxWidth: s})) : this._mapHolder.width() - 2 * e <= s ? (s = this._mapHolder.width() - 2 * e, r.css({maxWidth: s})) : r.css({maxWidth: ""}), r.css({marginLeft: -s / 2});
            var p = this._computePopOverCompensation(i), h = p[0], l = p[1], v = p[2];
            r.hasClass("mapify-visible") || (r.css({top: v[1], left: v[0], transition: "none"}), a.css({
                marginLeft: l,
                transition: "none"
            })), clearTimeout(this._popOverTimeout), this._popOverTimeout = setTimeout(function () {
                var s = o.options.popOver.content(t(i), o.element), e = t(i).attr("data-pop-over-class");
                "" != e && (r.addClass(e), r.attr("data-popOver-class", e)), r.find(".mapify-popOver-content").html(s), r.hasClass("mapify-to-bottom") ? (r.css({marginTop: ""}), r.hasClass("mapify-bottom") || a.css({
                    marginLeft: h,
                    transition: "none"
                }), r.addClass("mapify-bottom"), r.removeClass("mapify-to-bottom")) : (r.hasClass("mapify-bottom") && a.css({
                    marginLeft: h,
                    transition: "none"
                }), r.removeClass("mapify-bottom"), r.css({marginTop: -r.outerHeight()})), setTimeout(function () {
                    r.css({
                        top: v[1],
                        left: v[0],
                        transition: o._popOverTransition
                    }).addClass("mapify-visible"), a.css({marginLeft: l, transition: o._popOverArrowTransition})
                }, 10)
            }, 100)
        },
        e.prototype._computePopOverCompensation = function (t) {
            var i = 0, o = 0, s = this.popOver, e = this._getAreaCorners(t), r = e["center top"], a = s.outerWidth(),
                n = this.options.popOver.margin;
            this._mapHolder.width() < this.scrollParent.width() ? (o = r[0] - a / 2 - this.scrollParent.scrollLeft()) + a > this._mapHolder.width() - n ? i = o + a - this._mapHolder.width() + n : o < n && (i = o - n) : (o = r[0] - a / 2 - this.scrollParent.scrollLeft()) + a > this.scrollParent.outerWidth() - n ? i = o + a - this.scrollParent.outerWidth() + n : o < n && (i = o - n), r[1] - s.outerHeight() - n < 0 ? (r = e["center bottom"], s.addClass("mapify-to-bottom")) : s.hasClass("mapify-to-bottom") && s.removeClass("mapify-to-bottom"), r[0] -= i;
            var p = i;
            return i > a / 2 - 2 * n ? p = a / 2 - 2 * n : i < -(a / 2 - 2 * n) && (p = -a / 2 + 2 * n), [i, p, r]
        },
        e.prototype._getAreaCorners = function (t) {
            for (var i, o = t.getAttribute("coords").split(","), s = parseInt(o[0], 10), e = s, r = parseInt(o[1], 10), a = r, n = 0, p = o.length; n < p; n++) i = parseInt(o[n], 10), n % 2 == 0 ? i < s ? s = i : i > e && (e = i) : i < r ? r = i : i > a && (a = i);
            var h = parseInt((s + e) / 2, 10);
            parseInt((r + a) / 2, 10);
            return {"center top": {0: h, 1: r}, "center bottom": {0: h, 1: a}}
        },
        e.prototype._clearMap = function () {
            var t = this;
            if (this.isPopOverEnabled) {
                var i = !0, o = "mapify-visible";
                if (this.isCustomPopOver) {
                    var s = this.options.popOver.customPopOver;
                    o = s.visibleClass, i = !s.alwaysVisible
                }
                clearTimeout(this._popOverTimeout), i && (this._popOverTimeout = setTimeout(function () {
                    t.popOver.removeClass(o)
                }, 300))
            }
            this.svgMap.find("polygon").attr("class", "mapify-polygon"),
            this.options.onMapClear && this.options.onMapClear(this)
        },
        t.fn.mapify = function (i) {
            return this.each(function () {
                t.data(this, "plugin_mapify") || t.data(this, "plugin_mapify", new e(this, t.extend(!0, {}, r, i)))
            })
        },
        t.fn.mapify_scrollParent = function () {
            var i = this.css("position"), s = "absolute" === i, e = this.parents().filter(function () {
                var i = t(this);
                return (!s || "static" !== i.css("position")) && /(auto|scroll)/.test(i.css("overflow") + i.css("overflow-y") + i.css("overflow-x"))
            }).eq(0);
            return "fixed" !== i && e.length ? e : t(this[0].ownerDocument || o)
        }
}(jQuery, window, document);
