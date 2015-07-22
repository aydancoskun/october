//>>built
require({
    cache: {
        "velocity/velocity": function() {
            (function(r) {
                function s(a) {
                    var m = a.length,
                        c = n.type(a);
                    return "function" === c || n.isWindow(a) ? !1 : 1 === a.nodeType && m ? !0 : "array" === c || 0 === m || "number" === typeof m && 0 < m && m - 1 in a
                }
                if (!r.jQuery) {
                    var n = function(a, c) {
                        return new n.fn.init(a, c)
                    };
                    n.isWindow = function(a) {
                        return null != a && a == a.window
                    };
                    n.type = function(a) {
                        return null == a ? a + "" : "object" === typeof a || "function" === typeof a ? k[g.call(a)] || "object" : typeof a
                    };
                    n.isArray = Array.isArray || function(a) {
                        return "array" === n.type(a)
                    };
                    n.isPlainObject = function(a) {
                        var c;
                        if (!a || "object" !== n.type(a) || a.nodeType || n.isWindow(a)) return !1;
                        try {
                            if (a.constructor && !b.call(a, "constructor") && !b.call(a.constructor.prototype, "isPrototypeOf")) return !1
                        } catch (e) {
                            return !1
                        }
                        for (c in a);
                        return void 0 === c || b.call(a, c)
                    };
                    n.each = function(a, c, e) {
                        var v, b = 0,
                            g = a.length;
                        v = s(a);
                        if (e)
                            if (v)
                                for (; b < g && !(v = c.apply(a[b], e), !1 === v); b++);
                            else
                                for (b in a) {
                                    if (v = c.apply(a[b], e), !1 === v) break
                                } else if (v)
                                    for (; b < g && !(v = c.call(a[b], b, a[b]), !1 === v); b++);
                                else
                                    for (b in a)
                                        if (v = c.call(a[b],
                                                b, a[b]), !1 === v) break;
                        return a
                    };
                    n.data = function(a, c, e) {
                        if (void 0 === e) {
                            e = (a = a[n.expando]) && l[a];
                            if (void 0 === c) return e;
                            if (e && c in e) return e[c]
                        } else if (void 0 !== c) return a = a[n.expando] || (a[n.expando] = ++n.uuid), l[a] = l[a] || {}, l[a][c] = e
                    };
                    n.removeData = function(a, c) {
                        var e = a[n.expando],
                            b = e && l[e];
                        b && n.each(c, function(a, c) {
                            delete b[c]
                        })
                    };
                    n.extend = function() {
                        var a, c, e, b, g, d = arguments[0] || {},
                            l = 1,
                            k = arguments.length,
                            s = !1;
                        "boolean" === typeof d && (s = d, d = arguments[l] || {}, l++);
                        "object" !== typeof d && "function" !== n.type(d) &&
                            (d = {});
                        l === k && (d = this, l--);
                        for (; l < k; l++)
                            if (null != (g = arguments[l]))
                                for (b in g) a = d[b], e = g[b], d !== e && (s && e && (n.isPlainObject(e) || (c = n.isArray(e))) ? (c ? (c = !1, a = a && n.isArray(a) ? a : []) : a = a && n.isPlainObject(a) ? a : {}, d[b] = n.extend(s, a, e)) : void 0 !== e && (d[b] = e));
                        return d
                    };
                    n.queue = function(a, c, b) {
                        function d(a, c) {
                            var m = c || [];
                            if (null != a)
                                if (s(Object(a))) {
                                    for (var b = "string" === typeof a ? [a] : a, e = +b.length, p = 0, g = m.length; p < e;) m[g++] = b[p++];
                                    if (e !== e)
                                        for (; void 0 !== b[p];) m[g++] = b[p++];
                                    m.length = g
                                } else [].push.call(m, a);
                            return m
                        }
                        if (a) {
                            c = (c || "fx") + "queue";
                            var g = n.data(a, c);
                            if (!b) return g || [];
                            !g || n.isArray(b) ? g = n.data(a, c, d(b)) : g.push(b);
                            return g
                        }
                    };
                    n.dequeue = function(a, c) {
                        n.each(a.nodeType ? [a] : a, function(a, b) {
                            c = c || "fx";
                            var g = n.queue(b, c),
                                d = g.shift();
                            "inprogress" === d && (d = g.shift());
                            d && ("fx" === c && g.unshift("inprogress"), d.call(b, function() {
                                n.dequeue(b, c)
                            }))
                        })
                    };
                    n.fn = n.prototype = {
                        init: function(a) {
                            if (a.nodeType) return this[0] = a, this;
                            throw Error("Not a DOM node.");
                        },
                        offset: function() {
                            var a = this[0].getBoundingClientRect ? this[0].getBoundingClientRect() : {
                                top: 0,
                                left: 0
                            };
                            return {
                                top: a.top + (r.pageYOffset || document.scrollTop || 0) - (document.clientTop || 0),
                                left: a.left + (r.pageXOffset || document.scrollLeft || 0) - (document.clientLeft || 0)
                            }
                        },
                        position: function() {
                            function a() {
                                for (var a = this.offsetParent || document; a && "html" === !a.nodeType.toLowerCase && "static" === a.style.position;) a = a.offsetParent;
                                return a || document
                            }
                            var c = this[0],
                                a = a.apply(c),
                                b = this.offset(),
                                g = /^(?:body|html)$/i.test(a.nodeName) ? {
                                    top: 0,
                                    left: 0
                                } : n(a).offset();
                            b.top -= parseFloat(c.style.marginTop) || 0;
                            b.left -=
                                parseFloat(c.style.marginLeft) || 0;
                            a.style && (g.top += parseFloat(a.style.borderTopWidth) || 0, g.left += parseFloat(a.style.borderLeftWidth) || 0);
                            return {
                                top: b.top - g.top,
                                left: b.left - g.left
                            }
                        }
                    };
                    var l = {};
                    n.expando = "velocity" + (new Date).getTime();
                    n.uuid = 0;
                    for (var k = {}, b = k.hasOwnProperty, g = k.toString, d = "Boolean Number String Function Array Date RegExp Object Error".split(" "), c = 0; c < d.length; c++) k["[object " + d[c] + "]"] = d[c].toLowerCase();
                    n.fn.init.prototype = n.fn;
                    r.Velocity = {
                        Utilities: n
                    }
                }
            })(window);
            (function(r) {
                "object" ===
                typeof module && "object" === typeof module.exports ? module.exports = r() : "function" === typeof define && define.amd ? define(r) : r()
            })(function() {
                return function(r, s, n, l) {
                    function k(a) {
                        for (var f = -1, h = a ? a.length : 0, c = []; ++f < h;) {
                            var b = a[f];
                            b && c.push(b)
                        }
                        return c
                    }

                    function b(a) {
                        w.isWrapped(a) ? a = [].slice.call(a) : w.isNode(a) && (a = [a]);
                        return a
                    }

                    function g(a) {
                        a = u.data(a, "velocity");
                        return null === a ? l : a
                    }

                    function d(a) {
                        return function(f) {
                            return Math.round(f * a) * (1 / a)
                        }
                    }

                    function c(a, f, h, c) {
                        function b(a, h, f) {
                            return (((1 - 3 * f + 3 * h) *
                                a + (3 * f - 6 * h)) * a + 3 * h) * a
                        }
                        var m = "Float32Array" in s;
                        if (4 !== arguments.length) return !1;
                        for (var e = 0; 4 > e; ++e)
                            if ("number" !== typeof arguments[e] || isNaN(arguments[e]) || !isFinite(arguments[e])) return !1;
                        a = Math.min(a, 1);
                        h = Math.min(h, 1);
                        a = Math.max(a, 0);
                        h = Math.max(h, 0);
                        var g = m ? new Float32Array(11) : Array(11),
                            p = !1,
                            m = function(m) {
                                if (!p && (p = !0, a != f || h != c))
                                    for (var e = 0; 11 > e; ++e) g[e] = b(0.1 * e, a, h);
                                if (a === f && h === c) return m;
                                if (0 === m) return 0;
                                if (1 === m) return 1;
                                for (var d = 0, e = 1; 10 != e && g[e] <= m; ++e) d += 0.1;
                                --e;
                                var e = d + 0.1 * ((m - g[e]) /
                                        (g[e + 1] - g[e])),
                                    l = 3 * (1 - 3 * h + 3 * a) * e * e + 2 * (3 * h - 6 * a) * e + 3 * a;
                                if (0.001 <= l) {
                                    for (d = 0; 4 > d; ++d) {
                                        l = 3 * (1 - 3 * h + 3 * a) * e * e + 2 * (3 * h - 6 * a) * e + 3 * a;
                                        if (0 === l) break;
                                        var v = b(e, a, h) - m,
                                            e = e - v / l
                                    }
                                    m = e
                                } else if (0 == l) m = e;
                                else {
                                    var e = d,
                                        d = d + 0.1,
                                        k = 0;
                                    do v = e + (d - e) / 2, l = b(v, a, h) - m, 0 < l ? d = v : e = v; while (1E-7 < Math.abs(l) && 10 > ++k);
                                    m = v
                                }
                                return b(m, f, c)
                            };
                        m.getControlPoints = function() {
                            return [{
                                x: a,
                                y: f
                            }, {
                                x: h,
                                y: c
                            }]
                        };
                        var d = "generateBezier(" + [a, f, h, c] + ")";
                        m.toString = function() {
                            return d
                        };
                        return m
                    }

                    function a(a, f) {
                        var h = a;
                        w.isString(a) ? p.Easings[a] || (h = !1) : h = w.isArray(a) &&
                            1 === a.length ? d.apply(null, a) : w.isArray(a) && 2 === a.length ? t.apply(null, a.concat([f])) : w.isArray(a) && 4 === a.length ? c.apply(null, a) : !1;
                        !1 === h && (h = p.Easings[p.defaults.easing] ? p.defaults.easing : x);
                        return h
                    }

                    function m(a) {
                        if (a) {
                            a = (new Date).getTime();
                            for (var f = 0, h = p.State.calls.length; f < h; f++)
                                if (p.State.calls[f]) {
                                    var c = p.State.calls[f],
                                        b = c[0],
                                        d = c[2],
                                        v = c[3],
                                        k = !!v;
                                    v || (v = p.State.calls[f][3] = a - 16);
                                    for (var n = Math.min((a - v) / d.duration, 1), C = 0, s = b.length; C < s; C++) {
                                        var E = b[C],
                                            t = E.element;
                                        if (g(t)) {
                                            var r = !1;
                                            d.display !==
                                                l && (null !== d.display && "none" !== d.display) && ("flex" === d.display && u.each(["-webkit-box", "-moz-box", "-ms-flexbox", "-webkit-flex"], function(a, h) {
                                                    q.setPropertyValue(t, "display", h)
                                                }), q.setPropertyValue(t, "display", d.display));
                                            d.visibility !== l && "hidden" !== d.visibility && q.setPropertyValue(t, "visibility", d.visibility);
                                            for (var A in E)
                                                if ("element" !== A) {
                                                    var D = E[A],
                                                        F;
                                                    F = w.isString(D.easing) ? p.Easings[D.easing] : D.easing;
                                                    if (1 === n) F = D.endValue;
                                                    else if (F = D.startValue + (D.endValue - D.startValue) * F(n), !k && F === D.currentValue) continue;
                                                    D.currentValue = F;
                                                    if (q.Hooks.registered[A]) {
                                                        var z = q.Hooks.getRoot(A),
                                                            x = g(t).rootPropertyValueCache[z];
                                                        x && (D.rootPropertyValue = x)
                                                    }
                                                    D = q.setPropertyValue(t, A, D.currentValue + (0 === parseFloat(F) ? "" : D.unitType), D.rootPropertyValue, D.scrollData);
                                                    q.Hooks.registered[A] && (q.Normalizations.registered[z] ? g(t).rootPropertyValueCache[z] = q.Normalizations.registered[z]("extract", null, D[1]) : g(t).rootPropertyValueCache[z] = D[1]);
                                                    "transform" === D[0] && (r = !0)
                                                }
                                            d.mobileHA && g(t).transformCache.translate3d === l && (g(t).transformCache.translate3d =
                                                "(0px, 0px, 0px)", r = !0);
                                            r && q.flushTransformCache(t)
                                        }
                                    }
                                    d.display !== l && "none" !== d.display && (p.State.calls[f][2].display = !1);
                                    d.visibility !== l && "hidden" !== d.visibility && (p.State.calls[f][2].visibility = !1);
                                    d.progress && d.progress.call(c[1], c[1], n, Math.max(0, v + d.duration - a), v);
                                    1 === n && e(f)
                                }
                        }
                        p.State.isTicking && H(m)
                    }

                    function e(a, f) {
                        if (!p.State.calls[a]) return !1;
                        for (var h = p.State.calls[a][0], c = p.State.calls[a][1], b = p.State.calls[a][2], e = p.State.calls[a][4], m = !1, d = 0, v = h.length; d < v; d++) {
                            var k = h[d].element;
                            !f &&
                                !b.loop && ("none" === b.display && q.setPropertyValue(k, "display", b.display), "hidden" === b.visibility && q.setPropertyValue(k, "visibility", b.visibility));
                            if (!0 !== b.loop && (u.queue(k)[1] === l || !/\.velocityQueueEntryFlag/i.test(u.queue(k)[1])) && g(k)) {
                                g(k).isAnimating = !1;
                                g(k).rootPropertyValueCache = {};
                                var n = !1;
                                u.each(q.Lists.transforms3D, function(a, h) {
                                    var f = /^scale/.test(h) ? 1 : 0,
                                        c = g(k).transformCache[h];
                                    g(k).transformCache[h] !== l && RegExp("^\\(" + f + "[^.]").test(c) && (n = !0, delete g(k).transformCache[h])
                                });
                                b.mobileHA &&
                                    (n = !0, delete g(k).transformCache.translate3d);
                                n && q.flushTransformCache(k);
                                q.Values.removeClass(k, "velocity-animating")
                            }
                            if (!f && b.complete && !b.loop && d === v - 1) try {
                                b.complete.call(c, c)
                            } catch (C) {
                                setTimeout(function() {
                                    throw C;
                                }, 1)
                            }
                            e && !0 !== b.loop && e(c);
                            !0 === b.loop && !f && (u.each(g(k).tweensContainer, function(a, h) {
                                /^rotate/.test(a) && 360 === parseFloat(h.endValue) && (h.endValue = 0, h.startValue = 360)
                            }), p(k, "reverse", {
                                loop: !0,
                                delay: b.delay
                            }));
                            !1 !== b.queue && u.dequeue(k, b.queue)
                        }
                        p.State.calls[a] = !1;
                        h = 0;
                        for (c = p.State.calls.length; h <
                            c; h++)
                            if (!1 !== p.State.calls[h]) {
                                m = !0;
                                break
                            }!1 === m && (p.State.isTicking = !1, delete p.State.calls, p.State.calls = [])
                    }
                    var v = function() {
                            if (n.documentMode) return n.documentMode;
                            for (var a = 7; 4 < a; a--) {
                                var f = n.createElement("div");
                                f.innerHTML = "\x3c!--[if IE " + a + "]\x3e\x3cspan\x3e\x3c/span\x3e\x3c![endif]--\x3e";
                                if (f.getElementsByTagName("span").length) return a
                            }
                            return l
                        }(),
                        E = function() {
                            var a = 0;
                            return s.webkitRequestAnimationFrame || s.mozRequestAnimationFrame || function(f) {
                                var h = (new Date).getTime(),
                                    c;
                                c = Math.max(0,
                                    16 - (h - a));
                                a = h + c;
                                return setTimeout(function() {
                                    f(h + c)
                                }, c)
                            }
                        }(),
                        w = {
                            isString: function(a) {
                                return "string" === typeof a
                            },
                            isArray: Array.isArray || function(a) {
                                return "[object Array]" === Object.prototype.toString.call(a)
                            },
                            isFunction: function(a) {
                                return "[object Function]" === Object.prototype.toString.call(a)
                            },
                            isNode: function(a) {
                                return a && a.nodeType
                            },
                            isNodeList: function(a) {
                                return "object" === typeof a && /^\[object (HTMLCollection|NodeList|Object)\]$/.test(Object.prototype.toString.call(a)) && a.length !== l && (0 === a.length ||
                                    "object" === typeof a[0] && 0 < a[0].nodeType)
                            },
                            isWrapped: function(a) {
                                return a && (a.jquery || s.Zepto && s.Zepto.zepto.isZ(a))
                            },
                            isSVG: function(a) {
                                return s.SVGElement && a instanceof s.SVGElement
                            },
                            isEmptyObject: function(a) {
                                for (var f in a) return !1;
                                return !0
                            }
                        },
                        u, F = !1;
                    r.fn && r.fn.jquery ? (u = r, F = !0) : u = s.Velocity.Utilities;
                    if (8 >= v && !F) throw Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");
                    if (7 >= v) jQuery.fn.velocity = jQuery.fn.animate;
                    else {
                        var z = 400,
                            x = "swing",
                            p = {
                                State: {
                                    isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent),
                                    isAndroid: /Android/i.test(navigator.userAgent),
                                    isGingerbread: /Android 2\.3\.[3-7]/i.test(navigator.userAgent),
                                    isChrome: s.chrome,
                                    isFirefox: /Firefox/i.test(navigator.userAgent),
                                    prefixElement: n.createElement("div"),
                                    prefixMatches: {},
                                    scrollAnchor: null,
                                    scrollPropertyLeft: null,
                                    scrollPropertyTop: null,
                                    isTicking: !1,
                                    calls: []
                                },
                                CSS: {},
                                Utilities: u,
                                Redirects: {},
                                Easings: {},
                                Promise: s.Promise,
                                defaults: {
                                    queue: "",
                                    duration: z,
                                    easing: x,
                                    begin: l,
                                    complete: l,
                                    progress: l,
                                    display: l,
                                    visibility: l,
                                    loop: !1,
                                    delay: !1,
                                    mobileHA: !0,
                                    _cacheValues: !0
                                },
                                init: function(a) {
                                    u.data(a, "velocity", {
                                        isSVG: w.isSVG(a),
                                        isAnimating: !1,
                                        computedStyle: null,
                                        tweensContainer: null,
                                        rootPropertyValueCache: {},
                                        transformCache: {}
                                    })
                                },
                                hook: null,
                                mock: !1,
                                version: {
                                    major: 1,
                                    minor: 1,
                                    patch: 0
                                },
                                debug: !1
                            };
                        s.pageYOffset !== l ? (p.State.scrollAnchor = s, p.State.scrollPropertyLeft = "pageXOffset", p.State.scrollPropertyTop = "pageYOffset") : (p.State.scrollAnchor = n.documentElement || n.body.parentNode || n.body, p.State.scrollPropertyLeft = "scrollLeft", p.State.scrollPropertyTop = "scrollTop");
                        var t = function() {
                            function a(h,
                                f, c) {
                                var b = h.v + c.dv * f;
                                return {
                                    dx: b,
                                    dv: -h.tension * (h.x + c.dx * f) - h.friction * b
                                }
                            }

                            function f(h, f) {
                                var c = {
                                        dx: h.v,
                                        dv: -h.tension * h.x - h.friction * h.v
                                    },
                                    b = a(h, 0.5 * f, c),
                                    e = a(h, 0.5 * f, b),
                                    m = a(h, f, e),
                                    d = 1 / 6 * (c.dv + 2 * (b.dv + e.dv) + m.dv);
                                h.x += 1 / 6 * (c.dx + 2 * (b.dx + e.dx) + m.dx) * f;
                                h.v += d * f;
                                return h
                            }
                            return function I(a, c, b) {
                                var e = {
                                        x: -1,
                                        v: 0,
                                        tension: null,
                                        friction: null
                                    },
                                    m = [0],
                                    d = 0,
                                    B, g;
                                a = parseFloat(a) || 500;
                                c = parseFloat(c) || 20;
                                b = b || null;
                                e.tension = a;
                                e.friction = c;
                                (B = null !== b) ? (d = I(a, c), a = 0.016 * (d / b)) : a = 0.016;
                                for (; !(g = f(g || e, a), m.push(1 + g.x),
                                        d += 16, !(1E-4 < Math.abs(g.x) && 1E-4 < Math.abs(g.v))););
                                return !B ? d : function(a) {
                                    return m[a * (m.length - 1) | 0]
                                }
                            }
                        }();
                        p.Easings = {
                            linear: function(a) {
                                return a
                            },
                            swing: function(a) {
                                return 0.5 - Math.cos(a * Math.PI) / 2
                            },
                            spring: function(a) {
                                return 1 - Math.cos(4.5 * a * Math.PI) * Math.exp(6 * -a)
                            }
                        };
                        u.each([
                            ["ease", [0.25, 0.1, 0.25, 1]],
                            ["ease-in", [0.42, 0, 1, 1]],
                            ["ease-out", [0, 0, 0.58, 1]],
                            ["ease-in-out", [0.42, 0, 0.58, 1]],
                            ["easeInSine", [0.47, 0, 0.745, 0.715]],
                            ["easeOutSine", [0.39, 0.575, 0.565, 1]],
                            ["easeInOutSine", [0.445, 0.05, 0.55, 0.95]],
                            ["easeInQuad", [0.55, 0.085, 0.68, 0.53]],
                            ["easeOutQuad", [0.25, 0.46, 0.45, 0.94]],
                            ["easeInOutQuad", [0.455, 0.03, 0.515, 0.955]],
                            ["easeInCubic", [0.55, 0.055, 0.675, 0.19]],
                            ["easeOutCubic", [0.215, 0.61, 0.355, 1]],
                            ["easeInOutCubic", [0.645, 0.045, 0.355, 1]],
                            ["easeInQuart", [0.895, 0.03, 0.685, 0.22]],
                            ["easeOutQuart", [0.165, 0.84, 0.44, 1]],
                            ["easeInOutQuart", [0.77, 0, 0.175, 1]],
                            ["easeInQuint", [0.755, 0.05, 0.855, 0.06]],
                            ["easeOutQuint", [0.23, 1, 0.32, 1]],
                            ["easeInOutQuint", [0.86, 0, 0.07, 1]],
                            ["easeInExpo", [0.95, 0.05, 0.795, 0.035]],
                            ["easeOutExpo", [0.19,
                                1, 0.22, 1
                            ]],
                            ["easeInOutExpo", [1, 0, 0, 1]],
                            ["easeInCirc", [0.6, 0.04, 0.98, 0.335]],
                            ["easeOutCirc", [0.075, 0.82, 0.165, 1]],
                            ["easeInOutCirc", [0.785, 0.135, 0.15, 0.86]]
                        ], function(a, f) {
                            p.Easings[f[0]] = c.apply(null, f[1])
                        });
                        var q = p.CSS = {
                            RegEx: {
                                isHex: /^#([A-f\d]{3}){1,2}$/i,
                                valueUnwrap: /^[A-z]+\((.*)\)$/i,
                                wrappedValueAlreadyExtracted: /[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,
                                valueSplit: /([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/ig
                            },
                            Lists: {
                                colors: "fill stroke stopColor color backgroundColor borderColor borderTopColor borderRightColor borderBottomColor borderLeftColor outlineColor".split(" "),
                                transformsBase: "translateX translateY scale scaleX scaleY skewX skewY rotateZ".split(" "),
                                transforms3D: ["transformPerspective", "translateZ", "scaleZ", "rotateX", "rotateY"]
                            },
                            Hooks: {
                                templates: {
                                    textShadow: ["Color X Y Blur", "black 0px 0px 0px"],
                                    boxShadow: ["Color X Y Blur Spread", "black 0px 0px 0px 0px"],
                                    clip: ["Top Right Bottom Left", "0px 0px 0px 0px"],
                                    backgroundPosition: ["X Y", "0% 0%"],
                                    transformOrigin: ["X Y Z", "50% 50% 0px"],
                                    perspectiveOrigin: ["X Y", "50% 50%"]
                                },
                                registered: {},
                                register: function() {
                                    for (var a =
                                            0; a < q.Lists.colors.length; a++) q.Hooks.templates[q.Lists.colors[a]] = ["Red Green Blue Alpha", "color" === q.Lists.colors[a] ? "0 0 0 1" : "255 255 255 1"];
                                    var f, h, c;
                                    if (v)
                                        for (f in q.Hooks.templates) h = q.Hooks.templates[f], c = h[0].split(" "), h = h[1].match(q.RegEx.valueSplit), "Color" === c[0] && (c.push(c.shift()), h.push(h.shift()), q.Hooks.templates[f] = [c.join(" "), h.join(" ")]);
                                    for (f in q.Hooks.templates)
                                        for (a in h = q.Hooks.templates[f], c = h[0].split(" "), c) q.Hooks.registered[f + c[a]] = [f, a]
                                },
                                getRoot: function(a) {
                                    var f =
                                        q.Hooks.registered[a];
                                    return f ? f[0] : a
                                },
                                cleanRootPropertyValue: function(a, f) {
                                    q.RegEx.valueUnwrap.test(f) && (f = f.match(q.RegEx.valueUnwrap)[1]);
                                    q.Values.isCSSNullValue(f) && (f = q.Hooks.templates[a][1]);
                                    return f
                                },
                                extractValue: function(a, f) {
                                    var h = q.Hooks.registered[a];
                                    if (h) {
                                        var c = h[1];
                                        f = q.Hooks.cleanRootPropertyValue(h[0], f);
                                        return f.toString().match(q.RegEx.valueSplit)[c]
                                    }
                                    return f
                                },
                                injectValue: function(a, f, h) {
                                    var c = q.Hooks.registered[a];
                                    return c ? (a = c[1], h = q.Hooks.cleanRootPropertyValue(c[0], h), h = h.toString().match(q.RegEx.valueSplit),
                                        h[a] = f, h.join(" ")) : h
                                }
                            },
                            Normalizations: {
                                registered: {
                                    clip: function(a, f, h) {
                                        switch (a) {
                                            case "name":
                                                return "clip";
                                            case "extract":
                                                return a = q.RegEx.wrappedValueAlreadyExtracted.test(h) ? h : (a = h.toString().match(q.RegEx.valueUnwrap)) ? a[1].replace(/,(\s+)?/g, " ") : h, a;
                                            case "inject":
                                                return "rect(" + h + ")"
                                        }
                                    },
                                    blur: function(a, f, h) {
                                        switch (a) {
                                            case "name":
                                                return "-webkit-filter";
                                            case "extract":
                                                return a = parseFloat(h), a || 0 === a || (a = (h = h.toString().match(/blur\(([0-9]+[A-z]+)\)/i)) ? h[1] : 0), a;
                                            case "inject":
                                                return parseFloat(h) ?
                                                    "blur(" + h + ")" : "none"
                                        }
                                    },
                                    opacity: function(a, f, h) {
                                        if (8 >= v) switch (a) {
                                            case "name":
                                                return "filter";
                                            case "extract":
                                                return h = (a = h.toString().match(/alpha\(opacity=(.*)\)/i)) ? a[1] / 100 : 1;
                                            case "inject":
                                                return f.style.zoom = 1, 1 <= parseFloat(h) ? "" : "alpha(opacity\x3d" + parseInt(100 * parseFloat(h), 10) + ")"
                                        } else switch (a) {
                                            case "name":
                                                return "opacity";
                                            case "extract":
                                                return h;
                                            case "inject":
                                                return h
                                        }
                                    }
                                },
                                register: function() {
                                    !(9 >= v) && !p.State.isGingerbread && (q.Lists.transformsBase = q.Lists.transformsBase.concat(q.Lists.transforms3D));
                                    for (var a = 0; a < q.Lists.transformsBase.length; a++)(function() {
                                        var f = q.Lists.transformsBase[a];
                                        q.Normalizations.registered[f] = function(a, c, b) {
                                            switch (a) {
                                                case "name":
                                                    return "transform";
                                                case "extract":
                                                    return g(c) === l || g(c).transformCache[f] === l ? /^scale/i.test(f) ? 1 : 0 : g(c).transformCache[f].replace(/[()]/g, "");
                                                case "inject":
                                                    a = !1;
                                                    switch (f.substr(0, f.length - 1)) {
                                                        case "translate":
                                                            a = !/(%|px|em|rem|vw|vh|\d)$/i.test(b);
                                                            break;
                                                        case "scal":
                                                        case "scale":
                                                            p.State.isAndroid && (g(c).transformCache[f] === l && 1 > b) && (b = 1);
                                                            a = !/(\d)$/i.test(b);
                                                            break;
                                                        case "skew":
                                                            a = !/(deg|\d)$/i.test(b);
                                                            break;
                                                        case "rotate":
                                                            a = !/(deg|\d)$/i.test(b)
                                                    }
                                                    a || (g(c).transformCache[f] = "(" + b + ")");
                                                    return g(c).transformCache[f]
                                            }
                                        }
                                    })();
                                    for (a = 0; a < q.Lists.colors.length; a++)(function() {
                                        var f = q.Lists.colors[a];
                                        q.Normalizations.registered[f] = function(a, c, b) {
                                            switch (a) {
                                                case "name":
                                                    return f;
                                                case "extract":
                                                    if (!q.RegEx.wrappedValueAlreadyExtracted.test(b)) {
                                                        var e;
                                                        a = {
                                                            black: "rgb(0, 0, 0)",
                                                            blue: "rgb(0, 0, 255)",
                                                            gray: "rgb(128, 128, 128)",
                                                            green: "rgb(0, 128, 0)",
                                                            red: "rgb(255, 0, 0)",
                                                            white: "rgb(255, 255, 255)"
                                                        };
                                                        /^[A-z]+$/i.test(b) ? e = a[b] !== l ? a[b] : a.black : q.RegEx.isHex.test(b) ? e = "rgb(" + q.Values.hexToRgb(b).join(" ") + ")" : /^rgba?\(/i.test(b) || (e = a.black);
                                                        b = (e || b).toString().match(q.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g, " ")
                                                    }!(8 >= v) && 3 === b.split(" ").length && (b += " 1");
                                                    return b;
                                                case "inject":
                                                    return 8 >= v ? 4 === b.split(" ").length && (b = b.split(/\s+/).slice(0, 3).join(" ")) : 3 === b.split(" ").length && (b += " 1"), (8 >= v ? "rgb" : "rgba") + "(" + b.replace(/\s+/g, ",").replace(/\.(\d)+(?=,)/g, "") + ")"
                                            }
                                        }
                                    })()
                                }
                            },
                            Names: {
                                camelCase: function(a) {
                                    return a.replace(/-(\w)/g, function(a, h) {
                                        return h.toUpperCase()
                                    })
                                },
                                SVGAttribute: function(a) {
                                    var f = "width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";
                                    if (v || p.State.isAndroid && !p.State.isChrome) f += "|transform";
                                    return RegExp("^(" + f + ")$", "i").test(a)
                                },
                                prefixCheck: function(a) {
                                    if (p.State.prefixMatches[a]) return [p.State.prefixMatches[a], !0];
                                    for (var f = ["", "Webkit", "Moz", "ms", "O"], h = 0, c = f.length; h < c; h++) {
                                        var b;
                                        b = 0 === h ? a : f[h] + a.replace(/^\w/, function(a) {
                                            return a.toUpperCase()
                                        });
                                        if (w.isString(p.State.prefixElement.style[b])) return p.State.prefixMatches[a] =
                                            b, [b, !0]
                                    }
                                    return [a, !1]
                                }
                            },
                            Values: {
                                hexToRgb: function(a) {
                                    a = a.replace(/^#?([a-f\d])([a-f\d])([a-f\d])$/i, function(a, h, c, b) {
                                        return h + h + c + c + b + b
                                    });
                                    return (a = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(a)) ? [parseInt(a[1], 16), parseInt(a[2], 16), parseInt(a[3], 16)] : [0, 0, 0]
                                },
                                isCSSNullValue: function(a) {
                                    return 0 == a || /^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(a)
                                },
                                getUnitType: function(a) {
                                    return /^(rotate|skew)/i.test(a) ? "deg" : /(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(a) ?
                                        "" : "px"
                                },
                                getDisplayType: function(a) {
                                    a = a && a.tagName.toString().toLowerCase();
                                    return /^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(a) ? "inline" : /^(li)$/i.test(a) ? "list-item" : /^(tr)$/i.test(a) ? "table-row" : "block"
                                },
                                addClass: function(a, f) {
                                    a.classList ? a.classList.add(f) : a.className += (a.className.length ? " " : "") + f
                                },
                                removeClass: function(a, f) {
                                    a.classList ? a.classList.remove(f) : a.className = a.className.toString().replace(RegExp("(^|\\s)" +
                                        f.split(" ").join("|") + "(\\s|$)", "gi"), " ")
                                }
                            },
                            getPropertyValue: function(a, f, h, c) {
                                function b(a, f) {
                                    var h = 0;
                                    if (8 >= v) h = u.css(a, f);
                                    else {
                                        var e = !1;
                                        /^(width|height)$/.test(f) && 0 === q.getPropertyValue(a, "display") && (e = !0, q.setPropertyValue(a, "display", q.Values.getDisplayType(a)));
                                        var m = function() {
                                            e && q.setPropertyValue(a, "display", "none")
                                        };
                                        if (!c) {
                                            if ("height" === f && "border-box" !== q.getPropertyValue(a, "boxSizing").toString().toLowerCase()) return h = a.offsetHeight - (parseFloat(q.getPropertyValue(a, "borderTopWidth")) ||
                                                0) - (parseFloat(q.getPropertyValue(a, "borderBottomWidth")) || 0) - (parseFloat(q.getPropertyValue(a, "paddingTop")) || 0) - (parseFloat(q.getPropertyValue(a, "paddingBottom")) || 0), m(), h;
                                            if ("width" === f && "border-box" !== q.getPropertyValue(a, "boxSizing").toString().toLowerCase()) return h = a.offsetWidth - (parseFloat(q.getPropertyValue(a, "borderLeftWidth")) || 0) - (parseFloat(q.getPropertyValue(a, "borderRightWidth")) || 0) - (parseFloat(q.getPropertyValue(a, "paddingLeft")) || 0) - (parseFloat(q.getPropertyValue(a, "paddingRight")) ||
                                                0), m(), h
                                        }
                                        h = g(a) === l ? s.getComputedStyle(a, null) : g(a).computedStyle ? g(a).computedStyle : g(a).computedStyle = s.getComputedStyle(a, null);
                                        if ((v || p.State.isFirefox) && "borderColor" === f) f = "borderTopColor";
                                        h = 9 === v && "filter" === f ? h.getPropertyValue(f) : h[f];
                                        if ("" === h || null === h) h = a.style[f];
                                        m()
                                    }
                                    if ("auto" === h && /^(top|right|bottom|left)$/i.test(f) && (m = b(a, "position"), "fixed" === m || "absolute" === m && /top|left/i.test(f))) h = u(a).position()[f] + "px";
                                    return h
                                }
                                var e;
                                if (q.Hooks.registered[f]) {
                                    var m = q.Hooks.getRoot(f);
                                    h === l &&
                                        (h = q.getPropertyValue(a, q.Names.prefixCheck(m)[0]));
                                    q.Normalizations.registered[m] && (h = q.Normalizations.registered[m]("extract", a, h));
                                    e = q.Hooks.extractValue(f, h)
                                } else q.Normalizations.registered[f] && (h = q.Normalizations.registered[f]("name", a), "transform" !== h && (m = b(a, q.Names.prefixCheck(h)[0]), q.Values.isCSSNullValue(m) && q.Hooks.templates[f] && (m = q.Hooks.templates[f][1])), e = q.Normalizations.registered[f]("extract", a, m));
                                /^[\d-]/.test(e) || (e = g(a) && g(a).isSVG && q.Names.SVGAttribute(f) ? /^(height|width)$/i.test(f) ?
                                    a.getBBox()[f] : a.getAttribute(f) : b(a, q.Names.prefixCheck(f)[0]));
                                q.Values.isCSSNullValue(e) && (e = 0);
                                2 <= p.debug && console.log("Get " + f + ": " + e);
                                return e
                            },
                            setPropertyValue: function(a, f, h, c, b) {
                                var e = f;
                                if ("scroll" === f) b.container ? b.container["scroll" + b.direction] = h : "Left" === b.direction ? s.scrollTo(h, b.alternateValue) : s.scrollTo(b.alternateValue, h);
                                else if (q.Normalizations.registered[f] && "transform" === q.Normalizations.registered[f]("name", a)) q.Normalizations.registered[f]("inject", a, h), e = "transform", h = g(a).transformCache[f];
                                else {
                                    q.Hooks.registered[f] && (b = f, f = q.Hooks.getRoot(f), c = c || q.getPropertyValue(a, f), h = q.Hooks.injectValue(b, h, c));
                                    q.Normalizations.registered[f] && (h = q.Normalizations.registered[f]("inject", a, h), f = q.Normalizations.registered[f]("name", a));
                                    e = q.Names.prefixCheck(f)[0];
                                    if (8 >= v) try {
                                        a.style[e] = h
                                    } catch (m) {
                                        p.debug && console.log("Browser does not support [" + h + "] for [" + e + "]")
                                    } else g(a) && g(a).isSVG && q.Names.SVGAttribute(f) ? a.setAttribute(f, h) : a.style[e] = h;
                                    2 <= p.debug && console.log("Set " + f + " (" + e + "): " + h)
                                }
                                return [e,
                                    h
                                ]
                            },
                            flushTransformCache: function(a) {
                                var f = "";
                                if ((v || p.State.isAndroid && !p.State.isChrome) && g(a).isSVG) {
                                    var h = function(h) {
                                            return parseFloat(q.getPropertyValue(a, h))
                                        },
                                        c = {
                                            translate: [h("translateX"), h("translateY")],
                                            skewX: [h("skewX")],
                                            skewY: [h("skewY")],
                                            scale: 1 !== h("scale") ? [h("scale"), h("scale")] : [h("scaleX"), h("scaleY")],
                                            rotate: [h("rotateZ"), 0, 0]
                                        };
                                    u.each(g(a).transformCache, function(a) {
                                        /^translate/i.test(a) ? a = "translate" : /^scale/i.test(a) ? a = "scale" : /^rotate/i.test(a) && (a = "rotate");
                                        c[a] && (f += a + "(" + c[a].join(" ") +
                                            ") ", delete c[a])
                                    })
                                } else {
                                    var b, e;
                                    u.each(g(a).transformCache, function(h) {
                                        b = g(a).transformCache[h];
                                        if ("transformPerspective" === h) return e = b, !0;
                                        9 === v && "rotateZ" === h && (h = "rotate");
                                        f += h + b + " "
                                    });
                                    e && (f = "perspective" + e + " " + f)
                                }
                                q.setPropertyValue(a, "transform", f)
                            }
                        };
                        q.Hooks.register();
                        q.Normalizations.register();
                        p.hook = function(a, f, h) {
                            var c = l;
                            a = b(a);
                            u.each(a, function(a, b) {
                                g(b) === l && p.init(b);
                                if (h === l) c === l && (c = p.CSS.getPropertyValue(b, f));
                                else {
                                    var e = p.CSS.setPropertyValue(b, f, h);
                                    "transform" === e[0] && p.CSS.flushTransformCache(b);
                                    c = e
                                }
                            });
                            return c
                        };
                        var C = function() {
                                function c() {
                                    function h(c) {
                                        if (b.begin && 0 === F) try {
                                            b.begin.call(t, t)
                                        } catch (v) {
                                            setTimeout(function() {
                                                throw v;
                                            }, 1)
                                        }
                                        if ("scroll" === G) {
                                            var I = /^x$/i.test(b.axis) ? "Left" : "Top",
                                                A = parseFloat(b.offset) || 0,
                                                C, P, B;
                                            b.container ? w.isWrapped(b.container) || w.isNode(b.container) ? (b.container = b.container[0] || b.container, C = b.container["scroll" + I], B = C + u(f).position()[I.toLowerCase()] + A) : b.container = null : (C = p.State.scrollAnchor[p.State["scrollProperty" + I]], P = p.State.scrollAnchor[p.State["scrollProperty" +
                                                ("Left" === I ? "Top" : "Left")]], B = u(f).offset()[I.toLowerCase()] + A);
                                            e = {
                                                scroll: {
                                                    rootPropertyValue: !1,
                                                    startValue: C,
                                                    currentValue: C,
                                                    endValue: B,
                                                    unitType: "",
                                                    easing: b.easing,
                                                    scrollData: {
                                                        container: b.container,
                                                        direction: I,
                                                        alternateValue: P
                                                    }
                                                },
                                                element: f
                                            };
                                            p.debug && console.log("tweensContainer (scroll): ", e.scroll, f)
                                        } else if ("reverse" === G)
                                            if (g(f).tweensContainer) {
                                                "none" === g(f).opts.display && (g(f).opts.display = "auto");
                                                "hidden" === g(f).opts.visibility && (g(f).opts.visibility = "visible");
                                                g(f).opts.loop = !1;
                                                g(f).opts.begin =
                                                    null;
                                                g(f).opts.complete = null;
                                                E.easing || delete b.easing;
                                                E.duration || delete b.duration;
                                                b = u.extend({}, g(f).opts, b);
                                                var I = u.extend(!0, {}, g(f).tweensContainer),
                                                    D;
                                                for (D in I) "element" !== D && (A = I[D].startValue, I[D].startValue = I[D].currentValue = I[D].endValue, I[D].endValue = A, w.isEmptyObject(E) || (I[D].easing = b.easing), p.debug && console.log("reverse tweensContainer (" + D + "): " + JSON.stringify(I[D]), f));
                                                e = I
                                            } else {
                                                u.dequeue(f, b.queue);
                                                return
                                            } else if ("start" === G) {
                                            g(f).tweensContainer && !0 === g(f).isAnimating && (I = g(f).tweensContainer);
                                            var z = function(h, c) {
                                                var e = l,
                                                    m = l,
                                                    d = l;
                                                if (w.isArray(h))
                                                    if (e = h[0], !w.isArray(h[1]) && /^[\d-]/.test(h[1]) || w.isFunction(h[1]) || q.RegEx.isHex.test(h[1])) d = h[1];
                                                    else {
                                                        if (w.isString(h[1]) && !q.RegEx.isHex.test(h[1]) || w.isArray(h[1])) m = c ? h[1] : a(h[1], b.duration), h[2] !== l && (d = h[2])
                                                    } else e = h;
                                                c || (m = m || b.easing);
                                                w.isFunction(e) && (e = e.call(f, F, r));
                                                w.isFunction(d) && (d = d.call(f, F, r));
                                                return [e || 0, m, d]
                                            };
                                            u.each(H, function(a, f) {
                                                if (RegExp("^" + q.Lists.colors.join("$|^") + "$").test(a)) {
                                                    var b = z(f, !0),
                                                        h = b[0],
                                                        c = b[1],
                                                        e = b[2];
                                                    if (q.RegEx.isHex.test(h)) {
                                                        for (var b = ["Red", "Green", "Blue"], h = q.Values.hexToRgb(h), e = e ? q.Values.hexToRgb(e) : l, m = 0; m < b.length; m++) {
                                                            var d = [h[m]];
                                                            c && d.push(c);
                                                            e !== l && d.push(e[m]);
                                                            H[a + b[m]] = d
                                                        }
                                                        delete H[a]
                                                    }
                                                }
                                            });
                                            for (A in H)
                                                if (B = z(H[A]), C = B[0], P = B[1], B = B[2], A = q.Names.camelCase(A), c = q.Hooks.getRoot(A), D = !1, !g(f).isSVG && !1 === q.Names.prefixCheck(c)[1] && q.Normalizations.registered[c] === l) p.debug && console.log("Skipping [" + c + "] due to a lack of browser support.");
                                                else {
                                                    if ((b.display !== l && null !== b.display && "none" !== b.display || b.visibility !== l && "hidden" !==
                                                            b.visibility) && /opacity|filter/.test(A) && !B && 0 !== C) B = 0;
                                                    b._cacheValues && I && I[A] ? (B === l && (B = I[A].endValue + I[A].unitType), D = g(f).rootPropertyValueCache[c]) : q.Hooks.registered[A] ? B === l ? (D = q.getPropertyValue(f, c), B = q.getPropertyValue(f, A, D)) : D = q.Hooks.templates[c][1] : B === l && (B = q.getPropertyValue(f, A));
                                                    var y, O = !1,
                                                        N = function(a, f) {
                                                            var b, h;
                                                            h = (f || "0").toString().toLowerCase().replace(/[%A-z]+$/, function(a) {
                                                                b = a;
                                                                return ""
                                                            });
                                                            b || (b = q.Values.getUnitType(a));
                                                            return [h, b]
                                                        };
                                                    y = N(A, B);
                                                    B = y[0];
                                                    c = y[1];
                                                    y = N(A, C);
                                                    C = y[0].replace(/^([+-\/*])=/,
                                                        function(a, f) {
                                                            O = f;
                                                            return ""
                                                        });
                                                    y = y[1];
                                                    B = parseFloat(B) || 0;
                                                    C = parseFloat(C) || 0;
                                                    "%" === y && (/^(fontSize|lineHeight)$/.test(A) ? (C /= 100, y = "em") : /^scale/.test(A) ? (C /= 100, y = "") : /(Red|Green|Blue)$/i.test(A) && (C = 255 * (C / 100), y = ""));
                                                    N = function() {
                                                        var a = f.parentNode || n.body,
                                                            b = q.getPropertyValue(f, "position"),
                                                            h = q.getPropertyValue(f, "fontSize"),
                                                            c = b === K.lastPosition && a === K.lastParent,
                                                            e = h === K.lastFontSize;
                                                        K.lastParent = a;
                                                        K.lastPosition = b;
                                                        K.lastFontSize = h;
                                                        var m = {};
                                                        if (!e || !c) {
                                                            var d = g(f).isSVG ? n.createElementNS("http://www.w3.org/2000/svg",
                                                                "rect") : n.createElement("div");
                                                            p.init(d);
                                                            a.appendChild(d);
                                                            u.each(["overflow", "overflowX", "overflowY"], function(a, f) {
                                                                p.CSS.setPropertyValue(d, f, "hidden")
                                                            });
                                                            p.CSS.setPropertyValue(d, "position", b);
                                                            p.CSS.setPropertyValue(d, "fontSize", h);
                                                            p.CSS.setPropertyValue(d, "boxSizing", "content-box");
                                                            u.each("minWidth maxWidth width minHeight maxHeight height".split(" "), function(a, f) {
                                                                p.CSS.setPropertyValue(d, f, "100%")
                                                            });
                                                            p.CSS.setPropertyValue(d, "paddingLeft", "100em");
                                                            m.percentToPxWidth = K.lastPercentToPxWidth = (parseFloat(q.getPropertyValue(d,
                                                                "width", null, !0)) || 1) / 100;
                                                            m.percentToPxHeight = K.lastPercentToPxHeight = (parseFloat(q.getPropertyValue(d, "height", null, !0)) || 1) / 100;
                                                            m.emToPx = K.lastEmToPx = (parseFloat(q.getPropertyValue(d, "paddingLeft")) || 1) / 100;
                                                            a.removeChild(d)
                                                        } else m.emToPx = K.lastEmToPx, m.percentToPxWidth = K.lastPercentToPxWidth, m.percentToPxHeight = K.lastPercentToPxHeight;
                                                        null === K.remToPx && (K.remToPx = parseFloat(q.getPropertyValue(n.body, "fontSize")) || 16);
                                                        null === K.vwToPx && (K.vwToPx = parseFloat(s.innerWidth) / 100, K.vhToPx = parseFloat(s.innerHeight) /
                                                            100);
                                                        m.remToPx = K.remToPx;
                                                        m.vwToPx = K.vwToPx;
                                                        m.vhToPx = K.vhToPx;
                                                        1 <= p.debug && console.log("Unit ratios: " + JSON.stringify(m), f);
                                                        return m
                                                    };
                                                    if (/[\/*]/.test(O)) y = c;
                                                    else if (c !== y && 0 !== B)
                                                        if (0 === C) y = c;
                                                        else {
                                                            d = d || N();
                                                            N = /margin|padding|left|right|width|text|word|letter/i.test(A) || /X$/.test(A) || "x" === A ? "x" : "y";
                                                            switch (c) {
                                                                case "%":
                                                                    B *= "x" === N ? d.percentToPxWidth : d.percentToPxHeight;
                                                                    break;
                                                                case "px":
                                                                    break;
                                                                default:
                                                                    B *= d[c + "ToPx"]
                                                            }
                                                            switch (y) {
                                                                case "%":
                                                                    B *= 1 / ("x" === N ? d.percentToPxWidth : d.percentToPxHeight);
                                                                    break;
                                                                case "px":
                                                                    break;
                                                                default:
                                                                    B *= 1 / d[y + "ToPx"]
                                                            }
                                                        }
                                                    switch (O) {
                                                        case "+":
                                                            C = B + C;
                                                            break;
                                                        case "-":
                                                            C = B - C;
                                                            break;
                                                        case "*":
                                                            C *= B;
                                                            break;
                                                        case "/":
                                                            C = B / C
                                                    }
                                                    e[A] = {
                                                        rootPropertyValue: D,
                                                        startValue: B,
                                                        currentValue: B,
                                                        endValue: C,
                                                        unitType: y,
                                                        easing: P
                                                    };
                                                    p.debug && console.log("tweensContainer (" + A + "): " + JSON.stringify(e[A]), f)
                                                }
                                            e.element = f
                                        }
                                        e.element && (q.Values.addClass(f, "velocity-animating"), L.push(e), "" === b.queue && (g(f).tweensContainer = e, g(f).opts = b), g(f).isAnimating = !0, F === r - 1 ? (1E4 < p.State.calls.length && (p.State.calls = k(p.State.calls)), p.State.calls.push([L,
                                            t, b, null, x.resolver
                                        ]), !1 === p.State.isTicking && (p.State.isTicking = !0, m())) : F++)
                                    }
                                    var f = this,
                                        b = u.extend({}, p.defaults, E),
                                        e = {},
                                        d;
                                    g(f) === l && p.init(f);
                                    parseFloat(b.delay) && !1 !== b.queue && u.queue(f, b.queue, function(a) {
                                        p.velocityQueueEntryFlag = !0;
                                        g(f).delayTimer = {
                                            setTimeout: setTimeout(a, parseFloat(b.delay)),
                                            next: a
                                        }
                                    });
                                    switch (b.duration.toString().toLowerCase()) {
                                        case "fast":
                                            b.duration = 200;
                                            break;
                                        case "normal":
                                            b.duration = z;
                                            break;
                                        case "slow":
                                            b.duration = 600;
                                            break;
                                        default:
                                            b.duration = parseFloat(b.duration) || 1
                                    }!1 !==
                                        p.mock && (!0 === p.mock ? b.duration = b.delay = 1 : (b.duration *= parseFloat(p.mock) || 1, b.delay *= parseFloat(p.mock) || 1));
                                    b.easing = a(b.easing, b.duration);
                                    b.begin && !w.isFunction(b.begin) && (b.begin = null);
                                    b.progress && !w.isFunction(b.progress) && (b.progress = null);
                                    b.complete && !w.isFunction(b.complete) && (b.complete = null);
                                    b.display !== l && null !== b.display && (b.display = b.display.toString().toLowerCase(), "auto" === b.display && (b.display = p.CSS.Values.getDisplayType(f)));
                                    b.visibility !== l && null !== b.visibility && (b.visibility = b.visibility.toString().toLowerCase());
                                    b.mobileHA = b.mobileHA && p.State.isMobile && !p.State.isGingerbread;
                                    !1 === b.queue ? b.delay ? setTimeout(h, b.delay) : h() : u.queue(f, b.queue, function(a, f) {
                                        if (!0 === f) return x.promise && x.resolver(t), !0;
                                        p.velocityQueueEntryFlag = !0;
                                        h(a)
                                    });
                                    ("" === b.queue || "fx" === b.queue) && "inprogress" !== u.queue(f)[0] && u.dequeue(f)
                                }
                                var f = arguments[0] && (u.isPlainObject(arguments[0].properties) && !arguments[0].properties.names || w.isString(arguments[0].properties)),
                                    h, d, v, t, H, E;
                                w.isWrapped(this) ? (h = !1, v = 0, t = this, d = this) : (h = !0, v = 1, t = f ? arguments[0].elements :
                                    arguments[0]);
                                if (t = b(t)) {
                                    f ? (H = arguments[0].properties, E = arguments[0].options) : (H = arguments[v], E = arguments[v + 1]);
                                    var r = t.length,
                                        F = 0;
                                    if ("stop" !== H && !u.isPlainObject(E)) {
                                        E = {};
                                        for (f = v + 1; f < arguments.length; f++) !w.isArray(arguments[f]) && (/^(fast|normal|slow)$/i.test(arguments[f]) || /^\d/.test(arguments[f])) ? E.duration = arguments[f] : w.isString(arguments[f]) || w.isArray(arguments[f]) ? E.easing = arguments[f] : w.isFunction(arguments[f]) && (E.complete = arguments[f])
                                    }
                                    var x = {
                                        promise: null,
                                        resolver: null,
                                        rejecter: null
                                    };
                                    h && p.Promise && (x.promise = new p.Promise(function(a, f) {
                                        x.resolver = a;
                                        x.rejecter = f
                                    }));
                                    var G;
                                    switch (H) {
                                        case "scroll":
                                            G = "scroll";
                                            break;
                                        case "reverse":
                                            G = "reverse";
                                            break;
                                        case "stop":
                                            u.each(t, function(a, f) {
                                                g(f) && g(f).delayTimer && (clearTimeout(g(f).delayTimer.setTimeout), g(f).delayTimer.next && g(f).delayTimer.next(), delete g(f).delayTimer)
                                            });
                                            var Q = [];
                                            u.each(p.State.calls, function(a, f) {
                                                f && u.each(f[1], function(b, h) {
                                                    var c = w.isString(E) ? E : "";
                                                    if (E !== l && f[2].queue !== c) return !0;
                                                    u.each(t, function(f, b) {
                                                        b === h && (E !== l &&
                                                            (u.each(u.queue(b, c), function(a, f) {
                                                                w.isFunction(f) && f(null, !0)
                                                            }), u.queue(b, c, [])), g(b) && "" === c && u.each(g(b).tweensContainer, function(a, f) {
                                                                f.endValue = f.currentValue
                                                            }), Q.push(a))
                                                    })
                                                })
                                            });
                                            u.each(Q, function(a, f) {
                                                e(f, !0)
                                            });
                                            x.promise && x.resolver(t);
                                            return h ? x.promise || null : d;
                                        default:
                                            if (u.isPlainObject(H) && !w.isEmptyObject(H)) G = "start";
                                            else {
                                                if (w.isString(H) && p.Redirects[H]) {
                                                    var y = u.extend({}, E),
                                                        A = y.duration,
                                                        D = y.delay || 0;
                                                    !0 === y.backwards && (t = u.extend(!0, [], t).reverse());
                                                    u.each(t, function(a, f) {
                                                        parseFloat(y.stagger) ?
                                                            y.delay = D + parseFloat(y.stagger) * a : w.isFunction(y.stagger) && (y.delay = D + y.stagger.call(f, a, r));
                                                        y.drag && (y.duration = parseFloat(A) || (/^(callout|transition)/.test(H) ? 1E3 : z), y.duration = Math.max(y.duration * (y.backwards ? 1 - a / r : (a + 1) / r), 0.75 * y.duration, 200));
                                                        p.Redirects[H].call(f, f, y || {}, a, r, t, x.promise ? x : l)
                                                    })
                                                } else f = "Velocity: First argument (" + H + ") was not a property map, a known action, or a registered redirect. Aborting.", x.promise ? x.rejecter(Error(f)) : console.log(f);
                                                return h ? x.promise || null : d
                                            }
                                    }
                                    var K = {
                                            lastParent: null,
                                            lastPosition: null,
                                            lastFontSize: null,
                                            lastPercentToPxWidth: null,
                                            lastPercentToPxHeight: null,
                                            lastEmToPx: null,
                                            remToPx: null,
                                            vwToPx: null,
                                            vhToPx: null
                                        },
                                        L = [];
                                    u.each(t, function(a, f) {
                                        w.isNode(f) && c.call(f)
                                    });
                                    y = u.extend({}, p.defaults, E);
                                    y.loop = parseInt(y.loop);
                                    f = 2 * y.loop - 1;
                                    if (y.loop)
                                        for (v = 0; v < f; v++) {
                                            var O = {
                                                delay: y.delay,
                                                progress: y.progress
                                            };
                                            v === f - 1 && (O.display = y.display, O.visibility = y.visibility, O.complete = y.complete);
                                            C(t, "reverse", O)
                                        }
                                    return h ? x.promise || null : d
                                }
                            },
                            p = u.extend(C, p);
                        p.animate = C;
                        var H = s.requestAnimationFrame ||
                            E;
                        !p.State.isMobile && n.hidden !== l && n.addEventListener("visibilitychange", function() {
                            n.hidden ? (H = function(a) {
                                return setTimeout(function() {
                                    a(!0)
                                }, 16)
                            }, m()) : H = s.requestAnimationFrame || E
                        });
                        r.Velocity = p;
                        r !== s && (r.fn.velocity = C, r.fn.velocity.defaults = p.defaults);
                        u.each(["Down", "Up"], function(a, f) {
                            p.Redirects["slide" + f] = function(a, b, c, e, m, d) {
                                b = u.extend({}, b);
                                var g = b.begin,
                                    v = b.complete,
                                    k = {
                                        height: "",
                                        marginTop: "",
                                        marginBottom: "",
                                        paddingTop: "",
                                        paddingBottom: ""
                                    },
                                    q = {};
                                b.display === l && (b.display = "Down" === f ? "inline" ===
                                    p.CSS.Values.getDisplayType(a) ? "inline-block" : "block" : "none");
                                b.begin = function() {
                                    g && g.call(m, m);
                                    for (var b in k) {
                                        q[b] = a.style[b];
                                        var c = p.CSS.getPropertyValue(a, b);
                                        k[b] = "Down" === f ? [c, 0] : [0, c]
                                    }
                                    q.overflow = a.style.overflow;
                                    a.style.overflow = "hidden"
                                };
                                b.complete = function() {
                                    for (var f in q) a.style[f] = q[f];
                                    v && v.call(m, m);
                                    d && d.resolver(m)
                                };
                                p(a, k, b)
                            }
                        });
                        u.each(["In", "Out"], function(a, f) {
                            p.Redirects["fade" + f] = function(a, b, c, e, m, d) {
                                a = u.extend({}, b);
                                b = {
                                    opacity: "In" === f ? 1 : 0
                                };
                                var g = a.complete;
                                a.complete = c !== e - 1 ? a.begin =
                                    null : function() {
                                        g && g.call(m, m);
                                        d && d.resolver(m)
                                    };
                                a.display === l && (a.display = "In" === f ? "auto" : "none");
                                p(this, b, a)
                            }
                        });
                        return p
                    }
                }(window.jQuery || window.Zepto || window, window, document)
            })
        },
        "dijit/_base/manager": function() {
            define(["dojo/_base/array", "dojo/_base/config", "dojo/_base/lang", "../registry", "../main"], function(r, s, n, l, k) {
                var b = {};
                r.forEach("byId getUniqueId findWidgets _destroyAll byNode getEnclosingWidget".split(" "), function(g) {
                    b[g] = l[g]
                });
                n.mixin(b, {
                    defaultDuration: s.defaultDuration || 200
                });
                n.mixin(k,
                    b);
                return k
            })
        },
        "dijit/registry": function() {
            define(["dojo/_base/array", "dojo/sniff", "dojo/_base/window", "./main"], function(r, s, n, l) {
                var k = {},
                    b = {},
                    g = {
                        length: 0,
                        add: function(d) {
                            if (b[d.id]) throw Error("Tried to register widget with id\x3d\x3d" + d.id + " but that id is already registered");
                            b[d.id] = d;
                            this.length++
                        },
                        remove: function(d) {
                            b[d] && (delete b[d], this.length--)
                        },
                        byId: function(d) {
                            return "string" == typeof d ? b[d] : d
                        },
                        byNode: function(d) {
                            return b[d.getAttribute("widgetId")]
                        },
                        toArray: function() {
                            var d = [],
                                c;
                            for (c in b) d.push(b[c]);
                            return d
                        },
                        getUniqueId: function(d) {
                            var c;
                            do c = d + "_" + (d in k ? ++k[d] : k[d] = 0); while (b[c]);
                            return "dijit" == l._scopeName ? c : l._scopeName + "_" + c
                        },
                        findWidgets: function(d, c) {
                            function a(e) {
                                for (e = e.firstChild; e; e = e.nextSibling)
                                    if (1 == e.nodeType) {
                                        var d = e.getAttribute("widgetId");
                                        d ? (d = b[d]) && m.push(d) : e !== c && a(e)
                                    }
                            }
                            var m = [];
                            a(d);
                            return m
                        },
                        _destroyAll: function() {
                            l._curFocus = null;
                            l._prevFocus = null;
                            l._activeStack = [];
                            r.forEach(g.findWidgets(n.body()), function(b) {
                                b._destroyed || (b.destroyRecursive ? b.destroyRecursive() : b.destroy &&
                                    b.destroy())
                            })
                        },
                        getEnclosingWidget: function(d) {
                            for (; d;) {
                                var c = 1 == d.nodeType && d.getAttribute("widgetId");
                                if (c) return b[c];
                                d = d.parentNode
                            }
                            return null
                        },
                        _hash: b
                    };
                return l.registry = g
            })
        },
        "dijit/main": function() {
            define(["dojo/_base/kernel"], function(r) {
                return r.dijit
            })
        },
        "mojo/signup-forms/PopupSignupForm": function() {
            define("dojo/_base/declare dijit/_WidgetBase dijit/_TemplatedMixin dojo/text!./templates/modal.html ./SignupFormFrame dojo/query dojo/_base/lang dojo/on dojo/dom-construct dojo/dom-style dojo/sniff dojo/keys dojo/Deferred dojo/NodeList-manipulate".split(" "),
                function(r, s, n, l, k, b, g, d, c, a, m, e, v) {
                    return r("PopupSignupForm", [s, n], {
                        templateString: l,
                        popupDelay: 1E3,
                        popupOpacity: 0.1,
                        origOverflowValue: null,
                        version: "1.0",
                        config: {},
                        subscribeUrl: "#",
                        postMixInProperties: function() {
                            this.config.popupOpacity && (this.popupOpacity = this.config.popupOpacity / 100);
                            this.config.popupDelay && (this.popupDelay = 1E3 * this.config.popupDelay)
                        },
                        postCreate: function() {
                            this.inherited(arguments)
                        },
                        startup: function() {
                            this.inherited(arguments);
                            a.set(this.modalOverlay, "display", "none");
                            a.set(this.modalContainer,
                                "display", "none");
                            this.frame = new k({
                                iframe: this.iframeContainer,
                                config: this.config,
                                subscribeUrl: this.subscribeUrl
                            });
                            this.frame.startup();
                            this._setupModal();
                            this.loadModalCss().then(g.hitch(this, "openModal"))
                        },
                        openModal: function() {
                            this._hasCookie() || setTimeout(g.hitch(this, "_openModal"), this.popupDelay)
                        },
                        closeModal: function() {
                            this._closeModal()
                        },
                        _openModal: function() {
                            a.set(this.modalOverlay, "display", "block");
                            a.set(this.modalContainer, "display", "block");
                            this.frame.updateDocHeight();
                            var b = this;
                            9 > m("ie") ?
                                (a.set(this.modalOverlay, "opacity", this.popupOpacity), a.set(this.modalContainer, "opacity", 1)) : require(["velocity/velocity"], function(a) {
                                    a(b.modalOverlay, {
                                        opacity: b.popupOpacity
                                    }, {
                                        duration: 200,
                                        complete: function() {
                                            a(b.modalContainer, {
                                                opacity: 1
                                            }, 200)
                                        }
                                    })
                                })
                        },
                        _closeModal: function() {
                            -1 === window.location.href.indexOf("mailchimp.com") && this._setCookie();
                            var b = this;
                            9 > m("ie") ? (a.set(this.modalContainer, "display", "none"), a.set(this.modalContainer, "opacity", 0), b._hideOverlay()) : require(["velocity/velocity"], function(c) {
                                c(b.modalContainer, {
                                    opacity: 0
                                }, {
                                    duration: 350,
                                    complete: function() {
                                        a.set(b.modalContainer, "display", "none");
                                        b._hideOverlay()
                                    }
                                })
                            })
                        },
                        _hideOverlay: function() {
                            var b = this;
                            9 > m("ie") ? (a.set(this.modalOverlay, "opacity", 0), a.set(this.modalOverlay, "display", "none"), this._cleanup()) : require(["velocity/velocity"], function(c) {
                                c(b.modalOverlay, {
                                    opacity: 0
                                }, {
                                    duration: 200,
                                    complete: function() {
                                        a.set(b.modalOverlay, "display", "none");
                                        b._cleanup()
                                    }
                                })
                            })
                        },
                        _cleanup: function() {
                            c.destroy(this.domNode);
                            a.set(document.body, "overflow", this.origOverflowValue)
                        },
                        _setupModal: function() {
                            this.origOverflowValue = dojo.getComputedStyle(document.body).overflow;
                            a.set(document.body, "overflow", "auto");
                            d(b("[data-action\x3d'close-mc-modal']")[0], "click", g.hitch(this, "closeModal"));
                            d(window.document, "keyup", g.hitch(this, function(a) {
                                a.keyCode == e.ESCAPE && this.closeModal()
                            }));
                            d(this.frame.frameDoc, "keyup", g.hitch(this, function(a) {
                                a.keyCode == e.ESCAPE && this.closeModal()
                            }))
                        },
                        loadModalCss: function() {
                            var a = new v,
                                b = document.createElement("link");
                            b.rel = "stylesheet";
                            b.type = "text/css";
                            b.href = "//s3.amazonaws.com/downloads.mailchimp.com/css/signup-forms/popup/" + this.version + "/modal.css";
                            b.media = "all";
                            d(b, "load", function() {
                                a.resolve()
                            });
                            document.getElementsByTagName("head")[0].appendChild(b);
                            return a.promise
                        },
                        _setCookie: function() {
                            var a = new Date((new Date).getTime() + 31536E6);
                            document.cookie = "oktick_popup_seen\x3dyes;expires\x3d" + a.toGMTString() + ";path\x3d/"
                        },
                        _hasCookie: function() {
                            var a = document.cookie.split(";");
                            for (i = 0; i < a.length; i++)
                                if (parts = a[i].split("\x3d"), -1 != parts[0].indexOf("oktick_popup_seen")) return !0;
                            return !1
                        }
                    })
                })
        },
        "dijit/_WidgetBase": function() {
            define("require dojo/_base/array dojo/aspect dojo/_base/config dojo/_base/connect dojo/_base/declare dojo/dom dojo/dom-attr dojo/dom-class dojo/dom-construct dojo/dom-geometry dojo/dom-style dojo/has dojo/_base/kernel dojo/_base/lang dojo/on dojo/ready dojo/Stateful dojo/topic dojo/_base/window ./Destroyable dojo/has!dojo-bidi?./_BidiMixin ./registry".split(" "), function(r, s, n, l, k, b, g, d, c, a, m, e, v, E, w, u, F, z, x, p, t, q, C) {
                function H(a) {
                    return function(b) {
                        d[b ?
                            "set" : "remove"](this.domNode, a, b);
                        this._set(a, b)
                    }
                }
                v.add("dijit-legacy-requires", !E.isAsync);
                v.add("dojo-bidi", !1);
                v("dijit-legacy-requires") && F(0, function() {
                    r(["dijit/_base/manager"])
                });
                var B = {};
                l = b("dijit._WidgetBase", [z, t], {
                    id: "",
                    _setIdAttr: "domNode",
                    lang: "",
                    _setLangAttr: H("lang"),
                    dir: "",
                    _setDirAttr: H("dir"),
                    "class": "",
                    _setClassAttr: {
                        node: "domNode",
                        type: "class"
                    },
                    style: "",
                    title: "",
                    tooltip: "",
                    baseClass: "",
                    srcNodeRef: null,
                    domNode: null,
                    containerNode: null,
                    ownerDocument: null,
                    _setOwnerDocumentAttr: function(a) {
                        this._set("ownerDocument",
                            a)
                    },
                    attributeMap: {},
                    _blankGif: l.blankGif || r.toUrl("dojo/resources/blank.gif"),
                    _introspect: function() {
                        var a = this.constructor;
                        if (!a._setterAttrs) {
                            var b = a.prototype,
                                c = a._setterAttrs = [],
                                a = a._onMap = {},
                                e;
                            for (e in b.attributeMap) c.push(e);
                            for (e in b) /^on/.test(e) && (a[e.substring(2).toLowerCase()] = e), /^_set[A-Z](.*)Attr$/.test(e) && (e = e.charAt(4).toLowerCase() + e.substr(5, e.length - 9), (!b.attributeMap || !(e in b.attributeMap)) && c.push(e))
                        }
                    },
                    postscript: function(a, b) {
                        this.create(a, b)
                    },
                    create: function(a, b) {
                        this._introspect();
                        this.srcNodeRef = g.byId(b);
                        this._connects = [];
                        this._supportingWidgets = [];
                        this.srcNodeRef && "string" == typeof this.srcNodeRef.id && (this.id = this.srcNodeRef.id);
                        a && (this.params = a, w.mixin(this, a));
                        this.postMixInProperties();
                        this.id || (this.id = C.getUniqueId(this.declaredClass.replace(/\./g, "_")), this.params && delete this.params.id);
                        this.ownerDocument = this.ownerDocument || (this.srcNodeRef ? this.srcNodeRef.ownerDocument : document);
                        this.ownerDocumentBody = p.body(this.ownerDocument);
                        C.add(this);
                        this.buildRendering();
                        var c;
                        if (this.domNode) {
                            this._applyAttributes();
                            var e = this.srcNodeRef;
                            e && (e.parentNode && this.domNode !== e) && (e.parentNode.replaceChild(this.domNode, e), c = !0);
                            this.domNode.setAttribute("widgetId", this.id)
                        }
                        this.postCreate();
                        c && delete this.srcNodeRef;
                        this._created = !0
                    },
                    _applyAttributes: function() {
                        var a = {},
                            b;
                        for (b in this.params || {}) a[b] = this._get(b);
                        s.forEach(this.constructor._setterAttrs, function(b) {
                            if (!(b in a)) {
                                var c = this._get(b);
                                c && this.set(b, c)
                            }
                        }, this);
                        for (b in a) this.set(b, a[b])
                    },
                    postMixInProperties: function() {},
                    buildRendering: function() {
                        this.domNode || (this.domNode = this.srcNodeRef || this.ownerDocument.createElement("div"));
                        if (this.baseClass) {
                            var a = this.baseClass.split(" ");
                            this.isLeftToRight() || (a = a.concat(s.map(a, function(a) {
                                return a + "Rtl"
                            })));
                            c.add(this.domNode, a)
                        }
                    },
                    postCreate: function() {},
                    startup: function() {
                        this._started || (this._started = !0, s.forEach(this.getChildren(), function(a) {
                            !a._started && (!a._destroyed && w.isFunction(a.startup)) && (a.startup(), a._started = !0)
                        }))
                    },
                    destroyRecursive: function(a) {
                        this._beingDestroyed = !0;
                        this.destroyDescendants(a);
                        this.destroy(a)
                    },
                    destroy: function(a) {
                        function b(c) {
                            c.destroyRecursive ? c.destroyRecursive(a) : c.destroy && c.destroy(a)
                        }
                        this._beingDestroyed = !0;
                        this.uninitialize();
                        s.forEach(this._connects, w.hitch(this, "disconnect"));
                        s.forEach(this._supportingWidgets, b);
                        this.domNode && s.forEach(C.findWidgets(this.domNode, this.containerNode), b);
                        this.destroyRendering(a);
                        C.remove(this.id);
                        this._destroyed = !0
                    },
                    destroyRendering: function(b) {
                        this.bgIframe && (this.bgIframe.destroy(b), delete this.bgIframe);
                        this.domNode && (b ? d.remove(this.domNode, "widgetId") : a.destroy(this.domNode), delete this.domNode);
                        this.srcNodeRef && (b || a.destroy(this.srcNodeRef), delete this.srcNodeRef)
                    },
                    destroyDescendants: function(a) {
                        s.forEach(this.getChildren(), function(b) {
                            b.destroyRecursive && b.destroyRecursive(a)
                        })
                    },
                    uninitialize: function() {
                        return !1
                    },
                    _setStyleAttr: function(a) {
                        var b = this.domNode;
                        w.isObject(a) ? e.set(b, a) : b.style.cssText = b.style.cssText ? b.style.cssText + ("; " + a) : a;
                        this._set("style", a)
                    },
                    _attrToDom: function(a, b, e) {
                        e = 3 <=
                            arguments.length ? e : this.attributeMap[a];
                        s.forEach(w.isArray(e) ? e : [e], function(e) {
                            var m = this[e.node || e || "domNode"];
                            switch (e.type || "attribute") {
                                case "attribute":
                                    w.isFunction(b) && (b = w.hitch(this, b));
                                    e = e.attribute ? e.attribute : /^on[A-Z][a-zA-Z]*$/.test(a) ? a.toLowerCase() : a;
                                    m.tagName ? d.set(m, e, b) : m.set(e, b);
                                    break;
                                case "innerText":
                                    m.innerHTML = "";
                                    m.appendChild(this.ownerDocument.createTextNode(b));
                                    break;
                                case "innerHTML":
                                    m.innerHTML = b;
                                    break;
                                case "class":
                                    c.replace(m, b, this[a])
                            }
                        }, this)
                    },
                    get: function(a) {
                        var b =
                            this._getAttrNames(a);
                        return this[b.g] ? this[b.g]() : this._get(a)
                    },
                    set: function(a, b) {
                        if ("object" === typeof a) {
                            for (var c in a) this.set(c, a[c]);
                            return this
                        }
                        c = this._getAttrNames(a);
                        var e = this[c.s];
                        if (w.isFunction(e)) var m = e.apply(this, Array.prototype.slice.call(arguments, 1));
                        else {
                            var e = this.focusNode && !w.isFunction(this.focusNode) ? "focusNode" : "domNode",
                                d = this[e] && this[e].tagName,
                                g;
                            if (g = d)
                                if (!(g = B[d])) {
                                    g = this[e];
                                    var p = {},
                                        v;
                                    for (v in g) p[v.toLowerCase()] = !0;
                                    g = B[d] = p
                                }
                            v = g;
                            c = a in this.attributeMap ? this.attributeMap[a] :
                                c.s in this ? this[c.s] : v && c.l in v && "function" != typeof b || /^aria-|^data-|^role$/.test(a) ? e : null;
                            null != c && this._attrToDom(a, b, c);
                            this._set(a, b)
                        }
                        return m || this
                    },
                    _attrPairNames: {},
                    _getAttrNames: function(a) {
                        var b = this._attrPairNames;
                        if (b[a]) return b[a];
                        var c = a.replace(/^[a-z]|-[a-zA-Z]/g, function(a) {
                            return a.charAt(a.length - 1).toUpperCase()
                        });
                        return b[a] = {
                            n: a + "Node",
                            s: "_set" + c + "Attr",
                            g: "_get" + c + "Attr",
                            l: c.toLowerCase()
                        }
                    },
                    _set: function(a, b) {
                        var c = this[a];
                        this[a] = b;
                        this._created && b !== c && (this._watchCallbacks &&
                            this._watchCallbacks(a, c, b), this.emit("attrmodified-" + a, {
                                detail: {
                                    prevValue: c,
                                    newValue: b
                                }
                            }))
                    },
                    _get: function(a) {
                        return this[a]
                    },
                    emit: function(a, b, c) {
                        b = b || {};
                        void 0 === b.bubbles && (b.bubbles = !0);
                        void 0 === b.cancelable && (b.cancelable = !0);
                        b.detail || (b.detail = {});
                        b.detail.widget = this;
                        var e, m = this["on" + a];
                        m && (e = m.apply(this, c ? c : [b]));
                        this._started && !this._beingDestroyed && u.emit(this.domNode, a.toLowerCase(), b);
                        return e
                    },
                    on: function(a, b) {
                        var c = this._onMap(a);
                        return c ? n.after(this, c, b, !0) : this.own(u(this.domNode,
                            a, b))[0]
                    },
                    _onMap: function(a) {
                        var b = this.constructor,
                            c = b._onMap;
                        if (!c) {
                            var c = b._onMap = {},
                                e;
                            for (e in b.prototype) /^on/.test(e) && (c[e.replace(/^on/, "").toLowerCase()] = e)
                        }
                        return c["string" == typeof a && a.toLowerCase()]
                    },
                    toString: function() {
                        return "[Widget " + this.declaredClass + ", " + (this.id || "NO ID") + "]"
                    },
                    getChildren: function() {
                        return this.containerNode ? C.findWidgets(this.containerNode) : []
                    },
                    getParent: function() {
                        return C.getEnclosingWidget(this.domNode.parentNode)
                    },
                    connect: function(a, b, c) {
                        return this.own(k.connect(a,
                            b, this, c))[0]
                    },
                    disconnect: function(a) {
                        a.remove()
                    },
                    subscribe: function(a, b) {
                        return this.own(x.subscribe(a, w.hitch(this, b)))[0]
                    },
                    unsubscribe: function(a) {
                        a.remove()
                    },
                    isLeftToRight: function() {
                        return this.dir ? "ltr" == this.dir : m.isBodyLtr(this.ownerDocument)
                    },
                    isFocusable: function() {
                        return this.focus && "none" != e.get(this.domNode, "display")
                    },
                    placeAt: function(b, c) {
                        var e = !b.tagName && C.byId(b);
                        e && e.addChild && (!c || "number" === typeof c) ? e.addChild(this, c) : (e = e ? e.containerNode && !/after|before|replace/.test(c || "") ?
                            e.containerNode : e.domNode : g.byId(b, this.ownerDocument), a.place(this.domNode, e, c), !this._started && (this.getParent() || {})._started && this.startup());
                        return this
                    },
                    defer: function(a, b) {
                        var c = setTimeout(w.hitch(this, function() {
                            c && (c = null, this._destroyed || w.hitch(this, a)())
                        }), b || 0);
                        return {
                            remove: function() {
                                c && (clearTimeout(c), c = null);
                                return null
                            }
                        }
                    }
                });
                v("dojo-bidi") && l.extend(q);
                return l
            })
        },
        "dojo/Stateful": function() {
            define(["./_base/declare", "./_base/lang", "./_base/array", "./when"], function(r, s, n, l) {
                return r("dojo.Stateful",
                    null, {
                        _attrPairNames: {},
                        _getAttrNames: function(k) {
                            var b = this._attrPairNames;
                            return b[k] ? b[k] : b[k] = {
                                s: "_" + k + "Setter",
                                g: "_" + k + "Getter"
                            }
                        },
                        postscript: function(k) {
                            k && this.set(k)
                        },
                        _get: function(k, b) {
                            return "function" === typeof this[b.g] ? this[b.g]() : this[k]
                        },
                        get: function(k) {
                            return this._get(k, this._getAttrNames(k))
                        },
                        set: function(k, b) {
                            if ("object" === typeof k) {
                                for (var g in k) k.hasOwnProperty(g) && "_watchCallbacks" != g && this.set(g, k[g]);
                                return this
                            }
                            g = this._getAttrNames(k);
                            var d = this._get(k, g);
                            g = this[g.s];
                            var c;
                            "function" === typeof g ? c = g.apply(this, Array.prototype.slice.call(arguments, 1)) : this[k] = b;
                            if (this._watchCallbacks) {
                                var a = this;
                                l(c, function() {
                                    a._watchCallbacks(k, d, b)
                                })
                            }
                            return this
                        },
                        _changeAttrValue: function(k, b) {
                            var g = this.get(k);
                            this[k] = b;
                            this._watchCallbacks && this._watchCallbacks(k, g, b);
                            return this
                        },
                        watch: function(k, b) {
                            var g = this._watchCallbacks;
                            if (!g) var d = this,
                                g = this._watchCallbacks = function(a, b, c, k) {
                                    var l = function(g) {
                                        if (g) {
                                            g = g.slice();
                                            for (var k = 0, l = g.length; k < l; k++) g[k].call(d, a, b, c)
                                        }
                                    };
                                    l(g["_" +
                                        a]);
                                    k || l(g["*"])
                                };
                            !b && "function" === typeof k ? (b = k, k = "*") : k = "_" + k;
                            var c = g[k];
                            "object" !== typeof c && (c = g[k] = []);
                            c.push(b);
                            var a = {};
                            a.unwatch = a.remove = function() {
                                var a = n.indexOf(c, b); - 1 < a && c.splice(a, 1)
                            };
                            return a
                        }
                    })
            })
        },
        "dijit/Destroyable": function() {
            define(["dojo/_base/array", "dojo/aspect", "dojo/_base/declare"], function(r, s, n) {
                return n("dijit.Destroyable", null, {
                    destroy: function(l) {
                        this._destroyed = !0
                    },
                    own: function() {
                        r.forEach(arguments, function(l) {
                            var k = "destroyRecursive" in l ? "destroyRecursive" : "destroy" in
                                l ? "destroy" : "remove",
                                b = s.before(this, "destroy", function(b) {
                                    l[k](b)
                                }),
                                g = s.after(l, k, function() {
                                    b.remove();
                                    g.remove()
                                }, !0)
                        }, this);
                        return arguments
                    }
                })
            })
        },
        "dijit/_TemplatedMixin": function() {
            define("dojo/cache dojo/_base/declare dojo/dom-construct dojo/_base/lang dojo/on dojo/sniff dojo/string ./_AttachMixin".split(" "), function(r, s, n, l, k, b, g, d) {
                var c = s("dijit._TemplatedMixin", d, {
                    templateString: null,
                    templatePath: null,
                    _skipNodeCache: !1,
                    searchContainerNode: !0,
                    _stringRepl: function(a) {
                        var b = this.declaredClass,
                            c = this;
                        return g.substitute(a, this, function(a, d) {
                            "!" == d.charAt(0) && (a = l.getObject(d.substr(1), !1, c));
                            if ("undefined" == typeof a) throw Error(b + " template:" + d);
                            return null == a ? "" : "!" == d.charAt(0) ? a : a.toString().replace(/"/g, "\x26quot;")
                        }, this)
                    },
                    buildRendering: function() {
                        if (!this._rendered) {
                            this.templateString || (this.templateString = r(this.templatePath, {
                                sanitize: !0
                            }));
                            var a = c.getCachedTemplate(this.templateString, this._skipNodeCache, this.ownerDocument),
                                b;
                            if (l.isString(a)) {
                                if (b = n.toDom(this._stringRepl(a),
                                        this.ownerDocument), 1 != b.nodeType) throw Error("Invalid template: " + a);
                            } else b = a.cloneNode(!0);
                            this.domNode = b
                        }
                        this.inherited(arguments);
                        this._rendered || this._fillContent(this.srcNodeRef);
                        this._rendered = !0
                    },
                    _fillContent: function(a) {
                        var b = this.containerNode;
                        if (a && b)
                            for (; a.hasChildNodes();) b.appendChild(a.firstChild)
                    }
                });
                c._templateCache = {};
                c.getCachedTemplate = function(a, b, e) {
                    var d = c._templateCache,
                        k = a,
                        l = d[k];
                    if (l) {
                        try {
                            if (!l.ownerDocument || l.ownerDocument == (e || document)) return l
                        } catch (u) {}
                        n.destroy(l)
                    }
                    a =
                        g.trim(a);
                    if (b || a.match(/\$\{([^\}]+)\}/g)) return d[k] = a;
                    b = n.toDom(a, e);
                    if (1 != b.nodeType) throw Error("Invalid template: " + a);
                    return d[k] = b
                };
                b("ie") && k(window, "unload", function() {
                    var a = c._templateCache,
                        b;
                    for (b in a) {
                        var e = a[b];
                        "object" == typeof e && n.destroy(e);
                        delete a[b]
                    }
                });
                return c
            })
        },
        "dojo/cache": function() {
            define(["./_base/kernel", "./text"], function(r) {
                return r.cache
            })
        },
        "dojo/text": function() {
            define(["./_base/kernel", "require", "./has", "./request"], function(r, s, n, l) {
                var k;
                k = function(a, b, c) {
                    l(a, {
                        sync: !!b
                    }).then(c)
                };
                var b = {},
                    g = function(a) {
                        if (a) {
                            a = a.replace(/^\s*<\?xml(\s)+version=[\'\"](\d)*.(\d)*[\'\"](\s)*\?>/im, "");
                            var b = a.match(/<body[^>]*>\s*([\s\S]+)\s*<\/body>/im);
                            b && (a = b[1])
                        } else a = "";
                        return a
                    },
                    d = {},
                    c = {};
                r.cache = function(a, c, e) {
                    var d;
                    "string" == typeof a ? /\//.test(a) ? (d = a, e = c) : d = s.toUrl(a.replace(/\./g, "/") + (c ? "/" + c : "")) : (d = a + "", e = c);
                    a = void 0 != e && "string" != typeof e ? e.value : e;
                    e = e && e.sanitize;
                    if ("string" == typeof a) return b[d] = a, e ? g(a) : a;
                    if (null === a) return delete b[d], null;
                    d in b || k(d, !0, function(a) {
                        b[d] =
                            a
                    });
                    return e ? g(b[d]) : b[d]
                };
                return {
                    dynamic: !0,
                    normalize: function(a, b) {
                        var c = a.split("!"),
                            d = c[0];
                        return (/^\./.test(d) ? b(d) : d) + (c[1] ? "!" + c[1] : "")
                    },
                    load: function(a, m, e) {
                        a = a.split("!");
                        var l = 1 < a.length,
                            n = a[0],
                            s = m.toUrl(a[0]);
                        a = "url:" + s;
                        var u = d,
                            r = function(a) {
                                e(l ? g(a) : a)
                            };
                        n in b ? u = b[n] : m.cache && a in m.cache ? u = m.cache[a] : s in b && (u = b[s]);
                        if (u === d)
                            if (c[s]) c[s].push(r);
                            else {
                                var z = c[s] = [r];
                                k(s, !m.async, function(a) {
                                    b[n] = b[s] = a;
                                    for (var e = 0; e < z.length;) z[e++](a);
                                    delete c[s]
                                })
                            } else r(u)
                    }
                }
            })
        },
        "dojo/request": function() {
            define(["./request/default!"],
                function(r) {
                    return r
                })
        },
        "dojo/request/default": function() {
            define(["exports", "require", "../has"], function(r, s, n) {
                var l = n("config-requestProvider");
                l || (l = "./xhr");
                r.getPlatformDefaultId = function() {
                    return "./xhr"
                };
                r.load = function(k, b, g, d) {
                    s(["platform" == k ? "./xhr" : l], function(b) {
                        g(b)
                    })
                }
            })
        },
        "dojo/string": function() {
            define(["./_base/kernel", "./_base/lang"], function(r, s) {
                var n = {};
                s.setObject("dojo.string", n);
                n.rep = function(l, k) {
                    if (0 >= k || !l) return "";
                    for (var b = [];;) {
                        k & 1 && b.push(l);
                        if (!(k >>= 1)) break;
                        l += l
                    }
                    return b.join("")
                };
                n.pad = function(l, k, b, g) {
                    b || (b = "0");
                    l = String(l);
                    k = n.rep(b, Math.ceil((k - l.length) / b.length));
                    return g ? l + k : k + l
                };
                n.substitute = function(l, k, b, g) {
                    g = g || r.global;
                    b = b ? s.hitch(g, b) : function(b) {
                        return b
                    };
                    return l.replace(/\$\{([^\s\:\}]+)(?:\:([^\s\:\}]+))?\}/g, function(d, c, a) {
                        d = s.getObject(c, !1, k);
                        a && (d = s.getObject(a, !1, g).call(g, d, c));
                        return b(d, c).toString()
                    })
                };
                n.trim = String.prototype.trim ? s.trim : function(l) {
                    l = l.replace(/^\s+/, "");
                    for (var k = l.length - 1; 0 <= k; k--)
                        if (/\S/.test(l.charAt(k))) {
                            l = l.substring(0, k +
                                1);
                            break
                        }
                    return l
                };
                return n
            })
        },
        "dijit/_AttachMixin": function() {
            define("require dojo/_base/array dojo/_base/connect dojo/_base/declare dojo/_base/lang dojo/mouse dojo/on dojo/touch ./_WidgetBase".split(" "), function(r, s, n, l, k, b, g, d, c) {
                var a = k.delegate(d, {
                        mouseenter: b.enter,
                        mouseleave: b.leave,
                        keypress: n._keypress
                    }),
                    m;
                n = l("dijit._AttachMixin", null, {
                    constructor: function() {
                        this._attachPoints = [];
                        this._attachEvents = []
                    },
                    buildRendering: function() {
                        this.inherited(arguments);
                        this._attachTemplateNodes(this.domNode);
                        this._beforeFillContent()
                    },
                    _beforeFillContent: function() {},
                    _attachTemplateNodes: function(a) {
                        for (var b = a;;)
                            if (1 == b.nodeType && (this._processTemplateNode(b, function(a, b) {
                                    return a.getAttribute(b)
                                }, this._attach) || this.searchContainerNode) && b.firstChild) b = b.firstChild;
                            else {
                                if (b == a) break;
                                for (; !b.nextSibling;)
                                    if (b = b.parentNode, b == a) return;
                                b = b.nextSibling
                            }
                    },
                    _processTemplateNode: function(a, b, c) {
                        var d = !0,
                            m = this.attachScope || this,
                            g = b(a, "dojoAttachPoint") || b(a, "data-dojo-attach-point");
                        if (g)
                            for (var l = g.split(/\s*,\s*/); g =
                                l.shift();) k.isArray(m[g]) ? m[g].push(a) : m[g] = a, d = "containerNode" != g, this._attachPoints.push(g);
                        if (b = b(a, "dojoAttachEvent") || b(a, "data-dojo-attach-event")) {
                            g = b.split(/\s*,\s*/);
                            for (l = k.trim; b = g.shift();)
                                if (b) {
                                    var n = null; - 1 != b.indexOf(":") ? (n = b.split(":"), b = l(n[0]), n = l(n[1])) : b = l(b);
                                    n || (n = b);
                                    this._attachEvents.push(c(a, b, k.hitch(m, n)))
                                }
                        }
                        return d
                    },
                    _attach: function(b, c, d) {
                        c = c.replace(/^on/, "").toLowerCase();
                        c = "dijitclick" == c ? m || (m = r("./a11yclick")) : a[c] || c;
                        return g(b, c, d)
                    },
                    _detachTemplateNodes: function() {
                        var a =
                            this.attachScope || this;
                        s.forEach(this._attachPoints, function(b) {
                            delete a[b]
                        });
                        this._attachPoints = [];
                        s.forEach(this._attachEvents, function(a) {
                            a.remove()
                        });
                        this._attachEvents = []
                    },
                    destroyRendering: function() {
                        this._detachTemplateNodes();
                        this.inherited(arguments)
                    }
                });
                k.extend(c, {
                    dojoAttachEvent: "",
                    dojoAttachPoint: ""
                });
                return n
            })
        },
        "dojo/touch": function() {
            define("./_base/kernel ./aspect ./dom ./dom-class ./_base/lang ./on ./has ./mouse ./domReady ./_base/window".split(" "), function(r, s, n, l, k, b, g, d, c, a) {
                function m(a,
                    c, f) {
                    return u && f ? function(a, c) {
                        return b(a, f, c)
                    } : E ? function(f, e) {
                        var d = b(f, c, e),
                            m = b(f, a, function(a) {
                                (!B || (new Date).getTime() > B + 1E3) && e.call(this, a)
                            });
                        return {
                            remove: function() {
                                d.remove();
                                m.remove()
                            }
                        }
                    } : function(c, f) {
                        return b(c, a, f)
                    }
                }

                function e(a) {
                    do
                        if (a.dojoClick) return a.dojoClick;
                    while (a = a.parentNode)
                }

                function v(c, f, d) {
                    if (z = !c.target.disabled && e(c.target)) x = c.target, p = c.touches ? c.touches[0].pageX : c.clientX, t = c.touches ? c.touches[0].pageY : c.clientY, q = ("object" == typeof z ? z.x : "number" == typeof z ? z : 0) ||
                        4, C = ("object" == typeof z ? z.y : "number" == typeof z ? z : 0) || 4, F || (F = !0, a.doc.addEventListener(f, function(a) {
                            z = z && a.target == x && Math.abs((a.touches ? a.touches[0].pageX : a.clientX) - p) <= q && Math.abs((a.touches ? a.touches[0].pageY : a.clientY) - t) <= C
                        }, !0), a.doc.addEventListener(d, function(a) {
                            if (z) {
                                H = (new Date).getTime();
                                var c = a.target;
                                "LABEL" === c.tagName && (c = n.byId(c.getAttribute("for")) || c);
                                setTimeout(function() {
                                    b.emit(c, "click", {
                                        bubbles: !0,
                                        cancelable: !0,
                                        _dojo_click: !0
                                    })
                                })
                            }
                        }, !0), c = function(b) {
                            a.doc.addEventListener(b,
                                function(a) {
                                    !a._dojo_click && ((new Date).getTime() <= H + 1E3 && !("INPUT" == a.target.tagName && l.contains(a.target, "dijitOffScreen"))) && (a.stopPropagation(), a.stopImmediatePropagation && a.stopImmediatePropagation(), "click" == b && (("INPUT" != a.target.tagName || "radio" == a.target.type || "checkbox" == a.target.type) && "TEXTAREA" != a.target.tagName && "AUDIO" != a.target.tagName && "VIDEO" != a.target.tagName) && a.preventDefault())
                                }, !0)
                        }, c("click"), c("mousedown"), c("mouseup"))
                }
                var E = g("touch"),
                    w = 5 > g("ios"),
                    u = navigator.msPointerEnabled,
                    F, z, x, p, t, q, C, H, B, f;
                E && (u ? c(function() {
                    a.doc.addEventListener("MSPointerDown", function(a) {
                        v(a, "MSPointerMove", "MSPointerUp")
                    }, !0)
                }) : c(function() {
                    function c(a) {
                        var b = k.delegate(a, {
                            bubbles: !0
                        });
                        6 <= g("ios") && (b.touches = a.touches, b.altKey = a.altKey, b.changedTouches = a.changedTouches, b.ctrlKey = a.ctrlKey, b.metaKey = a.metaKey, b.shiftKey = a.shiftKey, b.targetTouches = a.targetTouches);
                        return b
                    }
                    f = a.body();
                    a.doc.addEventListener("touchstart", function(a) {
                        B = (new Date).getTime();
                        var c = f;
                        f = a.target;
                        b.emit(c, "dojotouchout", {
                            relatedTarget: f,
                            bubbles: !0
                        });
                        b.emit(f, "dojotouchover", {
                            relatedTarget: c,
                            bubbles: !0
                        });
                        v(a, "touchmove", "touchend")
                    }, !0);
                    b(a.doc, "touchmove", function(e) {
                        B = (new Date).getTime();
                        var d = a.doc.elementFromPoint(e.pageX - (w ? 0 : a.global.pageXOffset), e.pageY - (w ? 0 : a.global.pageYOffset));
                        d && (f !== d && (b.emit(f, "dojotouchout", {
                            relatedTarget: d,
                            bubbles: !0
                        }), b.emit(d, "dojotouchover", {
                            relatedTarget: f,
                            bubbles: !0
                        }), f = d), b.emit(d, "dojotouchmove", c(e)))
                    });
                    b(a.doc, "touchend", function(f) {
                        B = (new Date).getTime();
                        var e = a.doc.elementFromPoint(f.pageX -
                            (w ? 0 : a.global.pageXOffset), f.pageY - (w ? 0 : a.global.pageYOffset)) || a.body();
                        b.emit(e, "dojotouchend", c(f))
                    })
                }));
                s = {
                    press: m("mousedown", "touchstart", "MSPointerDown"),
                    move: m("mousemove", "dojotouchmove", "MSPointerMove"),
                    release: m("mouseup", "dojotouchend", "MSPointerUp"),
                    cancel: m(d.leave, "touchcancel", E ? "MSPointerCancel" : null),
                    over: m("mouseover", "dojotouchover", "MSPointerOver"),
                    out: m("mouseout", "dojotouchout", "MSPointerOut"),
                    enter: d._eventHandler(m("mouseover", "dojotouchover", "MSPointerOver")),
                    leave: d._eventHandler(m("mouseout",
                        "dojotouchout", "MSPointerOut"))
                };
                return r.touch = s
            })
        },
        "mojo/signup-forms/SignupFormFrame": function() {
            define("dojo/_base/declare dijit/_WidgetBase ./SignupForm dojo/query dojo/_base/lang dojo/window dojo/on dojo/dom dojo/dom-geometry dojo/dom-construct dojo/dom-style dojo/dom-attr dojo/promise/all dojo/Deferred dojo/sniff dojo/NodeList-manipulate".split(" "), function(r, s, n, l, k, b, g, d, c, a, m, e, v, E, w) {
                return r([s], {
                    version: "1.0",
                    template: 1,
                    iframe: null,
                    frameDoc: null,
                    maxWidth: 960,
                    mobileView: !1,
                    config: {},
                    subscribeUrl: "#",
                    layoutCssNode: null,
                    customCssNode: null,
                    imageUrl: null,
                    imageEdgeToEdge: null,
                    constructor: function(a) {
                        if (!a.iframe || !a.iframe.tagName || "iframe" != a.iframe.tagName.toLowerCase()) throw Error("You must specify an iframe attribute to an iframe element");
                    },
                    postMixInProperties: function() {
                        this.config.template && (this.template = this.config.template);
                        this.config.version && (this.version = this.config.version);
                        this.config.imageUrl && (this.imageUrl = this.config.imageUrl);
                        this.config.hasOwnProperty("imageEdgeToEdge") &&
                            (this.imageEdgeToEdge = this.config.imageEdgeToEdge);
                        this.config.styles && (this.styles = this.config.styles);
                        this.frameDoc = this.iframe.contentWindow.document
                    },
                    postCreate: function() {
                        this.signupForm = new n({
                            config: this.config,
                            subscribeUrl: this.subscribeUrl
                        });
                        this.frameDoc.write('\x3c!DOCTYPE html\x3e\x3chtml\x3e\x3chead\x3e\x3cmeta name\x3d"viewport" content\x3d"width\x3ddevice-width, initial-scale\x3d1, maximum-scale\x3d1, user-scalable\x3dno"/\x3e\x3c/head\x3e\x3cbody\x3e\x3c/body\x3e\x3c/html\x3e');
                        this.frameDoc.close();
                        this.signupForm.placeAt(this.frameDoc.body);
                        this.signupForm.startup();
                        v([this.loadCommonCss(), this.loadLayoutCss(), this.loadCustomCss()]).then(k.hitch(this, "updateDocHeight"));
                        g(window, "resize", k.hitch(this, function() {
                            var a = this._isMobileView();
                            a != this.mobileView && (this.mobileView = a, this.updateDocHeight())
                        }));
                        this.signupForm.on("resizeFrame", k.hitch(this, function() {
                            this.updateDocHeight()
                        }))
                    },
                    startup: function() {
                        this.inherited(arguments);
                        this.mobileView = this._isMobileView()
                    },
                    docHeight: function() {
                        return c.getContentBox(this.signupForm.domNode).h
                    },
                    updateDocHeight: function() {
                        try {
                            m.set(this.iframe, "height", this.docHeight() + "px")
                        } catch (a) {}
                    },
                    _isMobileView: function() {
                        return b.getBox().w < this.maxWidth ? !0 : !1
                    },
                    loadCommonCss: function() {
                        var a = new E,
                            b = this.frameDoc.createElement("link");
                        b.rel = "stylesheet";
                        b.type = "text/css";
                        b.href = "//s3.amazonaws.com/downloads.mailchimp.com/css/signup-forms/popup/" + this.version + "/common.css";
                        b.media = "all";
                        g(b, "load", function() {
                            a.resolve()
                        });
                        this.frameDoc.getElementsByTagName("head")[0].appendChild(b);
                        return a.promise
                    },
                    loadLayoutCss: function() {
                        this.layoutCssNode && a.destroy(this.layoutCssNode);
                        var b = new E;
                        this.layoutCssNode = this.frameDoc.createElement("link");
                        this.layoutCssNode.rel = "stylesheet";
                        this.layoutCssNode.type = "text/css";
                        this.layoutCssNode.href = "//s3.amazonaws.com/downloads.mailchimp.com/css/signup-forms/popup/" + this.version + "/layout-" + this.template + ".css";
                        this.layoutCssNode.media = "all";
                        g(this.layoutCssNode, "load", function() {
                            b.resolve()
                        });
                        this.frameDoc.getElementsByTagName("head")[0].appendChild(this.layoutCssNode);
                        return b.promise
                    },
                    loadCustomCss: function() {
                        this.customCssNode && a.destroy(this.customCssNode);
                        var b = new E;
                        this.customCssNode = this.createStyleNode();
                        var c = this.getStyleSheet(this.customCssNode);
                        if (this.styles)
                            for (var e in this.styles)
                                if (this.styles.hasOwnProperty(e)) switch (e) {
                                    case "button":
                                        for (var d in this.styles[e]) switch (d) {
                                            case "color":
                                                this.addCSSRule(c, ".button", "background-color:" + this.styles[e][d] + ";");
                                                break;
                                            case "hover_color":
                                                this.addCSSRule(c, ".button:hover", "background-color:" + this.styles[e][d] +
                                                    ";");
                                                break;
                                            case "text_color":
                                                this.addCSSRule(c, ".button", "color:" + this.styles[e][d] + ";");
                                                break;
                                            case "alignment":
                                                "right" == this.styles[e][d] ? this.addCSSRule(c, ".button", "float:right;") : "center" == this.styles[e][d] ? (this.addCSSRule(c, ".button", "float:none;margin-left:auto;margin-right:auto;"), 9 >= w("ie") ? (this.addCSSRule(c, ".button", "display:table-cell;"), this.addCSSRule(c, ".content__button", "margin-left:auto;margin-right:auto;display:table;")) : this.addCSSRule(c, ".button", "display:table;")) : this.addCSSRule(c,
                                                    ".button", "float:left;");
                                                break;
                                            case "style":
                                                "full" == this.styles[e][d] && this.addCSSRule(c, ".button", "width:100%;")
                                        }
                                        break;
                                    case "labels":
                                        for (d in this.styles[e]) switch (d) {
                                            case "color":
                                                this.addCSSRule(c, "label", "color:" + this.styles[e][d] + ";");
                                                break;
                                            case "font":
                                                this.addCSSRule(c, "label", "font-family:" + this.styles[e][d] + ";")
                                        }
                                }
                                this.imageUrl && 1 != this.template && this.addCSSRule(c, ".modalContent__image", "background-image:url(" + this.imageUrl + ");");
                        this.imageEdgeToEdge && this.addCSSRule(c, ".modalContent__image",
                            "background-size:cover;");
                        b.resolve();
                        return b.promise
                    },
                    createStyleNode: function() {
                        var a = document.createElement("style");
                        a.type = "text/css";
                        this.frameDoc.getElementsByTagName("head")[0].appendChild(a);
                        return a
                    },
                    getStyleSheet: function(a) {
                        9 > w("ie") ? a = a.styleSheet : (a.appendChild(document.createTextNode("")), a = a.sheet);
                        this.addCSSRule(a, "body", "width:100%;height:100%;", 0);
                        return a
                    },
                    addCSSRule: function(a, b, c, e) {
                        e = "undefined" !== typeof e ? e : "cssRules" in a ? a.cssRules.length : a.rules.length;
                        "insertRule" in a ?
                            a.insertRule(b + "{" + c + "}", e) : "addRule" in a && a.addRule(b, c, e)
                    }
                })
            })
        },
        "mojo/signup-forms/SignupForm": function() {
            define("dojo/_base/declare dijit/_WidgetBase dijit/_TemplatedMixin dijit/_FocusMixin dojo/_base/array dojo/query dojo/on dojo/_base/lang dojo/request/script dojo/dom-form dojo/dom-geometry dojo/dom-construct dojo/dom-style dojo/dom-attr dojo/html dojo/Evented dojo/text!./templates/form.html dojo/text!./inputs/templates/Text.html dojo/text!./inputs/templates/Address.html dojo/text!./inputs/templates/Email.html dojo/text!./inputs/templates/Birthday.html dojo/text!./inputs/templates/Date.html dojo/text!./inputs/templates/Phone.html dojo/text!./inputs/templates/Number.html dojo/text!./inputs/templates/Url.html dojo/text!./inputs/templates/RadioCheckbox.html dojo/text!./inputs/templates/Select.html".split(" "),
                function(r, s, n, l, k, b, g, d, c, a, m, e, v, E, w, u, F, z, x, p, t, q, C, H, B, f, h) {
                    var I = r([], {
                        isEmpty: function() {
                            var a;
                            k.forEach(this.inputs, d.hitch(this, function(b) {
                                a = "radio" == b.type || "checkbox" == b.type || "option" == b.tagName.toLowerCase() ? "boolean" === typeof a ? a && !this._checked(b) : !this._checked(b) : "boolean" === typeof a ? a && this._empty(b.value) : this._empty(b.value)
                            }));
                            return a
                        },
                        isChecked: function() {
                            k.some(this.inputs, d.hitch(this, function(a) {
                                if (this._checked(a)) return !0
                            }));
                            return !1
                        },
                        isEmail: function() {
                            return this._email(this.inputs[0].value)
                        },
                        isPhone: function() {
                            return this._phone(this.phoneAreaNode.value, this.phoneDetail1Node.value, this.phoneDetail2Node.value)
                        },
                        isUrl: function() {
                            return this._url(this.inputs[0].value)
                        },
                        isNumber: function() {
                            return this._number(this.inputs[0].value)
                        },
                        isBirthday: function() {
                            return this._monthDigits(this.monthNode.value) && this._dayDigits(this.dayNode.value)
                        },
                        isDate: function() {
                            return this._yearDigits(this.yearNode.value) && this._monthDigits(this.monthNode.value) && this._dayDigits(this.dayNode.value)
                        },
                        isAddress: function() {
                            return !this._empty(this.address1Node.value) &&
                                !this._empty(this.cityNode.value) && !this._empty(this.stateNode.value) && this._checked(b(":checked", this.countrySelectNode)[0]) && !this._empty(this.zipNode.value)
                        },
                        _required: function(a) {
                            return 0 < a.trim().length
                        },
                        _empty: function(a) {
                            return null === a || "undefined" === typeof a || "" === a
                        },
                        _email: function(a) {
                            return /^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(a)
                        },
                        _yearDigits: function(a) {
                            return this._digits(a) && this._range(a, [1, 9999])
                        },
                        _monthDigits: function(a) {
                            return this._digits(a) && this._range(a, [1, 12])
                        },
                        _dayDigits: function(a) {
                            return this._digits(a) && this._range(a, [1, 31])
                        },
                        _digits: function(a) {
                            return /^\d+$/.test(a)
                        },
                        _range: function(a, b) {
                            return a >= b[0] && a <= b[1]
                        },
                        _number: function(a) {
                            return this._digits(a) && !isNaN(a)
                        },
                        _minlength: function(a, b) {
                            return a.trim().length >= b
                        },
                        _maxlength: function(a, b) {
                            return a.trim().length <= b
                        },
                        _exactLength: function(a, b) {
                            return a.trim().length == b
                        },
                        _zipcode: function(a) {
                            return /^\d{5}-\d{4}$|^\d{5}$/.test(a)
                        },
                        _url: function(a) {
                            return /^(https?|s?ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(a)
                        },
                        _phone: function(a, b, c) {
                            return this._digits(a) && this._digits(b) && this._digits(c) && this._exactLength(a, 3) && this._exactLength(b, 3) && this._exactLength(c, 4)
                        },
                        _checked: function(a) {
                            return a.checked || a.selected && !this._empty(a.value)
                        },
                        _checkable: function(a) {
                            return /radio|checkbox/i.test(a.type)
                        }
                    });
                    l = r([l, I], {
                        _onBlur: function() {
                            this.inherited(arguments);
                            this.validateField()
                        },
                        validateField: function() {
                            var a = [],
                                b, c;
                            this.required && ((b = !this.isEmpty()) || a.push("This field is required."));
                            switch (this.validateAsType) {
                                case "email":
                                    b =
                                        this.isEmpty() || this.isEmail();
                                    c = "Please enter a valid email address.";
                                    break;
                                case "address":
                                    b = this.isEmpty() || this.isAddress();
                                    c = "Please enter a valid address.";
                                    break;
                                case "phone":
                                    b = this.isEmpty() || this.isPhone();
                                    c = "Please enter a valid phone number.";
                                    break;
                                case "url":
                                    b = this.isEmpty() || this.isUrl();
                                    c = "Please enter a valid url.";
                                    break;
                                case "number":
                                    b = this.isEmpty() || this.isNumber();
                                    c = "Please enter a valid number.";
                                    break;
                                case "birthday":
                                    b = this.isEmpty() || this.isBirthday();
                                    c = "Please enter a valid birthday.";
                                    break;
                                case "date":
                                    b = this.isEmpty() || this.isDate();
                                    c = "Please enter a valid date.";
                                    break;
                                case "radiocheckbox":
                                case "select":
                                    this.isEmpty() || this.isChecked();
                                default:
                                    b = !0
                            }
                            b || a.push(c);
                            this.setFieldValidationStatus(a);
                            return a
                        },
                        setFieldValidationStatus: function(a) {
                            0 < a.length ? this.setFieldAsInvalid(a[0]) : this.setFieldAsValid()
                        },
                        setFieldAsInvalid: function(a) {
                            this.inputs.addClass("invalid").removeClass("valid");
                            w.set(this.errorsNode, a);
                            v.set(this.errorsNode, "display", "block")
                        },
                        setFieldAsValid: function() {
                            this.inputs.addClass("valid").removeClass("invalid");
                            v.set(this.errorsNode, "display", "none")
                        },
                        resetField: function() {
                            this.inputs.removeClass("valid").removeClass("invalid");
                            v.set(this.errorsNode, "display", "none")
                        },
                        _getErrorsNode: function() {
                            var a = b(".invalid-error", this.domNode)[0];
                            a || (a = e.place('\x3cdiv class\x3d"invalid-error"\x3e\x3c/div\x3e', this.domNode));
                            return a
                        }
                    });
                    l = r([s, n, l], {
                        required: !1,
                        inputs: [],
                        errorsNode: null,
                        postCreate: function() {
                            this.inputs = b("input:not([type\x3d'hidden']), select option", this.domNode);
                            this.errorsNode = this._getErrorsNode()
                        }
                    });
                    var P = r([l], {
                            templateString: z,
                            validateAsType: "text"
                        }),
                        S = r([l], {
                            templateString: H,
                            validateAsType: "number"
                        }),
                        M = r([l], {
                            templateString: x,
                            validateAsType: "address",
                            postCreate: function() {
                                k.forEach([{
                                    id: "286",
                                    name: "Aaland Islands"
                                }, {
                                    id: "274",
                                    name: "Afghanistan"
                                }, {
                                    id: "2",
                                    name: "Albania"
                                }, {
                                    id: "3",
                                    name: "Algeria"
                                }, {
                                    id: "178",
                                    name: "American Samoa"
                                }, {
                                    id: "4",
                                    name: "Andorra"
                                }, {
                                    id: "5",
                                    name: "Angola"
                                }, {
                                    id: "176",
                                    name: "Anguilla"
                                }, {
                                    id: "175",
                                    name: "Antigua And Barbuda"
                                }, {
                                    id: "6",
                                    name: "Argentina"
                                }, {
                                    id: "7",
                                    name: "Armenia"
                                }, {
                                    id: "179",
                                    name: "Aruba"
                                }, {
                                    id: "8",
                                    name: "Australia"
                                }, {
                                    id: "9",
                                    name: "Austria"
                                }, {
                                    id: "10",
                                    name: "Azerbaijan"
                                }, {
                                    id: "11",
                                    name: "Bahamas"
                                }, {
                                    id: "12",
                                    name: "Bahrain"
                                }, {
                                    id: "13",
                                    name: "Bangladesh"
                                }, {
                                    id: "14",
                                    name: "Barbados"
                                }, {
                                    id: "15",
                                    name: "Belarus"
                                }, {
                                    id: "16",
                                    name: "Belgium"
                                }, {
                                    id: "17",
                                    name: "Belize"
                                }, {
                                    id: "18",
                                    name: "Benin"
                                }, {
                                    id: "19",
                                    name: "Bermuda"
                                }, {
                                    id: "20",
                                    name: "Bhutan"
                                }, {
                                    id: "21",
                                    name: "Bolivia"
                                }, {
                                    id: "22",
                                    name: "Bosnia and Herzegovina"
                                }, {
                                    id: "23",
                                    name: "Botswana"
                                }, {
                                    id: "181",
                                    name: "Bouvet Island"
                                }, {
                                    id: "24",
                                    name: "Brazil"
                                }, {
                                    id: "180",
                                    name: "Brunei Darussalam"
                                }, {
                                    id: "25",
                                    name: "Bulgaria"
                                }, {
                                    id: "26",
                                    name: "Burkina Faso"
                                }, {
                                    id: "27",
                                    name: "Burundi"
                                }, {
                                    id: "28",
                                    name: "Cambodia"
                                }, {
                                    id: "29",
                                    name: "Cameroon"
                                }, {
                                    id: "30",
                                    name: "Canada"
                                }, {
                                    id: "31",
                                    name: "Cape Verde"
                                }, {
                                    id: "32",
                                    name: "Cayman Islands"
                                }, {
                                    id: "33",
                                    name: "Central African Republic"
                                }, {
                                    id: "34",
                                    name: "Chad"
                                }, {
                                    id: "35",
                                    name: "Chile"
                                }, {
                                    id: "36",
                                    name: "China"
                                }, {
                                    id: "185",
                                    name: "Christmas Island"
                                }, {
                                    id: "37",
                                    name: "Colombia"
                                }, {
                                    id: "204",
                                    name: "Comoros"
                                }, {
                                    id: "38",
                                    name: "Congo"
                                }, {
                                    id: "183",
                                    name: "Cook Islands"
                                }, {
                                    id: "268",
                                    name: "Costa Rica"
                                }, {
                                    id: "275",
                                    name: "Cote D'Ivoire"
                                }, {
                                    id: "40",
                                    name: "Croatia"
                                }, {
                                    id: "276",
                                    name: "Cuba"
                                }, {
                                    id: "298",
                                    name: "Curacao"
                                }, {
                                    id: "41",
                                    name: "Cyprus"
                                }, {
                                    id: "42",
                                    name: "Czech Republic"
                                }, {
                                    id: "43",
                                    name: "Denmark"
                                }, {
                                    id: "44",
                                    name: "Djibouti"
                                }, {
                                    id: "289",
                                    name: "Dominica"
                                }, {
                                    id: "187",
                                    name: "Dominican Republic"
                                }, {
                                    id: "233",
                                    name: "East Timor"
                                }, {
                                    id: "45",
                                    name: "Ecuador"
                                }, {
                                    id: "46",
                                    name: "Egypt"
                                }, {
                                    id: "47",
                                    name: "El Salvador"
                                }, {
                                    id: "48",
                                    name: "Equatorial Guinea"
                                }, {
                                    id: "49",
                                    name: "Eritrea"
                                }, {
                                    id: "50",
                                    name: "Estonia"
                                }, {
                                    id: "51",
                                    name: "Ethiopia"
                                }, {
                                    id: "189",
                                    name: "Falkland Islands"
                                }, {
                                    id: "191",
                                    name: "Faroe Islands"
                                }, {
                                    id: "52",
                                    name: "Fiji"
                                }, {
                                    id: "53",
                                    name: "Finland"
                                }, {
                                    id: "54",
                                    name: "France"
                                }, {
                                    id: "193",
                                    name: "French Guiana"
                                }, {
                                    id: "277",
                                    name: "French Polynesia"
                                }, {
                                    id: "56",
                                    name: "Gabon"
                                }, {
                                    id: "57",
                                    name: "Gambia"
                                }, {
                                    id: "58",
                                    name: "Georgia"
                                }, {
                                    id: "59",
                                    name: "Germany"
                                }, {
                                    id: "60",
                                    name: "Ghana"
                                }, {
                                    id: "194",
                                    name: "Gibraltar"
                                }, {
                                    id: "61",
                                    name: "Greece"
                                }, {
                                    id: "195",
                                    name: "Greenland"
                                }, {
                                    id: "192",
                                    name: "Grenada"
                                }, {
                                    id: "196",
                                    name: "Guadeloupe"
                                }, {
                                    id: "62",
                                    name: "Guam"
                                }, {
                                    id: "198",
                                    name: "Guatemala"
                                }, {
                                    id: "270",
                                    name: "Guernsey"
                                }, {
                                    id: "63",
                                    name: "Guinea"
                                }, {
                                    id: "65",
                                    name: "Guyana"
                                }, {
                                    id: "200",
                                    name: "Haiti"
                                }, {
                                    id: "66",
                                    name: "Honduras"
                                }, {
                                    id: "67",
                                    name: "Hong Kong"
                                }, {
                                    id: "68",
                                    name: "Hungary"
                                }, {
                                    id: "69",
                                    name: "Iceland"
                                }, {
                                    id: "70",
                                    name: "India"
                                }, {
                                    id: "71",
                                    name: "Indonesia"
                                }, {
                                    id: "278",
                                    name: "Iran"
                                }, {
                                    id: "279",
                                    name: "Iraq"
                                }, {
                                    id: "74",
                                    name: "Ireland"
                                }, {
                                    id: "75",
                                    name: "Israel"
                                }, {
                                    id: "76",
                                    name: "Italy"
                                }, {
                                    id: "202",
                                    name: "Jamaica"
                                }, {
                                    id: "78",
                                    name: "Japan"
                                }, {
                                    id: "288",
                                    name: "Jersey  (Channel Islands)"
                                }, {
                                    id: "79",
                                    name: "Jordan"
                                }, {
                                    id: "80",
                                    name: "Kazakhstan"
                                }, {
                                    id: "81",
                                    name: "Kenya"
                                }, {
                                    id: "203",
                                    name: "Kiribati"
                                }, {
                                    id: "82",
                                    name: "Kuwait"
                                }, {
                                    id: "83",
                                    name: "Kyrgyzstan"
                                }, {
                                    id: "84",
                                    name: "Lao People's Democratic Republic"
                                }, {
                                    id: "85",
                                    name: "Latvia"
                                }, {
                                    id: "86",
                                    name: "Lebanon"
                                }, {
                                    id: "87",
                                    name: "Lesotho"
                                }, {
                                    id: "88",
                                    name: "Liberia"
                                }, {
                                    id: "281",
                                    name: "Libya"
                                }, {
                                    id: "90",
                                    name: "Liechtenstein"
                                }, {
                                    id: "91",
                                    name: "Lithuania"
                                }, {
                                    id: "92",
                                    name: "Luxembourg"
                                }, {
                                    id: "208",
                                    name: "Macau"
                                }, {
                                    id: "93",
                                    name: "Macedonia"
                                }, {
                                    id: "94",
                                    name: "Madagascar"
                                }, {
                                    id: "95",
                                    name: "Malawi"
                                }, {
                                    id: "96",
                                    name: "Malaysia"
                                }, {
                                    id: "97",
                                    name: "Maldives"
                                }, {
                                    id: "98",
                                    name: "Mali"
                                }, {
                                    id: "99",
                                    name: "Malta"
                                }, {
                                    id: "207",
                                    name: "Marshall Islands"
                                }, {
                                    id: "210",
                                    name: "Martinique"
                                }, {
                                    id: "100",
                                    name: "Mauritania"
                                }, {
                                    id: "212",
                                    name: "Mauritius"
                                }, {
                                    id: "241",
                                    name: "Mayotte"
                                }, {
                                    id: "101",
                                    name: "Mexico"
                                }, {
                                    id: "102",
                                    name: "Moldova, Republic of"
                                }, {
                                    id: "103",
                                    name: "Monaco"
                                }, {
                                    id: "104",
                                    name: "Mongolia"
                                }, {
                                    id: "290",
                                    name: "Montenegro"
                                }, {
                                    id: "294",
                                    name: "Montserrat"
                                }, {
                                    id: "105",
                                    name: "Morocco"
                                }, {
                                    id: "106",
                                    name: "Mozambique"
                                }, {
                                    id: "242",
                                    name: "Myanmar"
                                }, {
                                    id: "107",
                                    name: "Namibia"
                                }, {
                                    id: "108",
                                    name: "Nepal"
                                }, {
                                    id: "109",
                                    name: "Netherlands"
                                }, {
                                    id: "110",
                                    name: "Netherlands Antilles"
                                }, {
                                    id: "213",
                                    name: "New Caledonia"
                                }, {
                                    id: "111",
                                    name: "New Zealand"
                                }, {
                                    id: "112",
                                    name: "Nicaragua"
                                }, {
                                    id: "113",
                                    name: "Niger"
                                }, {
                                    id: "114",
                                    name: "Nigeria"
                                }, {
                                    id: "217",
                                    name: "Niue"
                                }, {
                                    id: "214",
                                    name: "Norfolk Island"
                                }, {
                                    id: "272",
                                    name: "North Korea"
                                }, {
                                    id: "116",
                                    name: "Norway"
                                }, {
                                    id: "117",
                                    name: "Oman"
                                }, {
                                    id: "118",
                                    name: "Pakistan"
                                }, {
                                    id: "222",
                                    name: "Palau"
                                }, {
                                    id: "282",
                                    name: "Palestine"
                                }, {
                                    id: "119",
                                    name: "Panama"
                                }, {
                                    id: "219",
                                    name: "Papua New Guinea"
                                }, {
                                    id: "120",
                                    name: "Paraguay"
                                }, {
                                    id: "121",
                                    name: "Peru"
                                }, {
                                    id: "122",
                                    name: "Philippines"
                                }, {
                                    id: "221",
                                    name: "Pitcairn"
                                }, {
                                    id: "123",
                                    name: "Poland"
                                }, {
                                    id: "124",
                                    name: "Portugal"
                                }, {
                                    id: "126",
                                    name: "Qatar"
                                }, {
                                    id: "315",
                                    name: "Republic of Kosovo"
                                }, {
                                    id: "127",
                                    name: "Reunion"
                                }, {
                                    id: "128",
                                    name: "Romania"
                                }, {
                                    id: "129",
                                    name: "Russia"
                                }, {
                                    id: "130",
                                    name: "Rwanda"
                                }, {
                                    id: "205",
                                    name: "Saint Kitts and Nevis"
                                }, {
                                    id: "206",
                                    name: "Saint Lucia"
                                }, {
                                    id: "237",
                                    name: "Saint Vincent and the Grenadines"
                                }, {
                                    id: "132",
                                    name: "Samoa (Independent)"
                                }, {
                                    id: "227",
                                    name: "San Marino"
                                }, {
                                    id: "133",
                                    name: "Saudi Arabia"
                                }, {
                                    id: "134",
                                    name: "Senegal"
                                }, {
                                    id: "266",
                                    name: "Serbia"
                                }, {
                                    id: "135",
                                    name: "Seychelles"
                                }, {
                                    id: "136",
                                    name: "Sierra Leone"
                                }, {
                                    id: "137",
                                    name: "Singapore"
                                }, {
                                    id: "302",
                                    name: "Sint Maarten"
                                }, {
                                    id: "138",
                                    name: "Slovakia"
                                }, {
                                    id: "139",
                                    name: "Slovenia"
                                }, {
                                    id: "223",
                                    name: "Solomon Islands"
                                }, {
                                    id: "140",
                                    name: "Somalia"
                                }, {
                                    id: "141",
                                    name: "South Africa"
                                }, {
                                    id: "257",
                                    name: "South Georgia and the South Sandwich Islands"
                                }, {
                                    id: "142",
                                    name: "South Korea"
                                }, {
                                    id: "311",
                                    name: "South Sudan"
                                }, {
                                    id: "143",
                                    name: "Spain"
                                }, {
                                    id: "144",
                                    name: "Sri Lanka"
                                }, {
                                    id: "293",
                                    name: "Sudan"
                                }, {
                                    id: "146",
                                    name: "Suriname"
                                }, {
                                    id: "225",
                                    name: "Svalbard and Jan Mayen Islands"
                                }, {
                                    id: "147",
                                    name: "Swaziland"
                                }, {
                                    id: "148",
                                    name: "Sweden"
                                }, {
                                    id: "149",
                                    name: "Switzerland"
                                }, {
                                    id: "285",
                                    name: "Syria"
                                }, {
                                    id: "152",
                                    name: "Taiwan"
                                }, {
                                    id: "260",
                                    name: "Tajikistan"
                                }, {
                                    id: "153",
                                    name: "Tanzania"
                                }, {
                                    id: "154",
                                    name: "Thailand"
                                }, {
                                    id: "155",
                                    name: "Togo"
                                }, {
                                    id: "232",
                                    name: "Tonga"
                                }, {
                                    id: "234",
                                    name: "Trinidad and Tobago"
                                }, {
                                    id: "156",
                                    name: "Tunisia"
                                }, {
                                    id: "157",
                                    name: "Turkey"
                                }, {
                                    id: "287",
                                    name: "Turks \x26amp; Caicos Islands"
                                }, {
                                    id: "159",
                                    name: "Uganda"
                                }, {
                                    id: "161",
                                    name: "Ukraine"
                                }, {
                                    id: "162",
                                    name: "United Arab Emirates"
                                }, {
                                    id: "262",
                                    name: "United Kingdom"
                                }, {
                                    id: "163",
                                    name: "Uruguay"
                                }, {
                                    id: "165",
                                    name: "Uzbekistan"
                                }, {
                                    id: "239",
                                    name: "Vanuatu"
                                }, {
                                    id: "166",
                                    name: "Vatican City State (Holy See)"
                                }, {
                                    id: "167",
                                    name: "Venezuela"
                                }, {
                                    id: "168",
                                    name: "Vietnam"
                                }, {
                                    id: "169",
                                    name: "Virgin Islands (British)"
                                }, {
                                    id: "238",
                                    name: "Virgin Islands (U.S.)"
                                }, {
                                    id: "188",
                                    name: "Western Sahara"
                                }, {
                                    id: "170",
                                    name: "Yemen"
                                }, {
                                    id: "173",
                                    name: "Zambia"
                                }, {
                                    id: "174",
                                    name: "Zimbabwe"
                                }], d.hitch(this, function(a) {
                                    e.place('\x3coption value\x3d"' +
                                        a.id + '"\x3e' + a.name + "\x3c/option\x3e", this.countrySelectNode, "last")
                                }));
                                this.inherited(arguments)
                            }
                        }),
                        R = r([l], {
                            templateString: p,
                            validateAsType: "email"
                        }),
                        U = r([l], {
                            templateString: t,
                            validateAsType: "birthday",
                            validateAsGroup: !0,
                            postCreate: function() {
                                this.inherited(arguments);
                                "DD/MM" == this.dateformat && (e.place(this.dayNode, this.inputsContainer, "first"), e.place(this.monthNode, this.inputsContainer, "last"))
                            }
                        }),
                        V = r([l], {
                            templateString: q,
                            validateAsType: "date",
                            validateAsGroup: !0,
                            postCreate: function() {
                                this.inherited(arguments);
                                "MM/DD/YYYY" == this.dateformat && (e.place(this.monthNode, this.inputsContainer, "first"), e.place(this.yearNode, this.inputsContainer, "last"))
                            }
                        }),
                        J = r([l], {
                            templateString: C,
                            validateAsType: "phone",
                            validateAsGroup: !0
                        }),
                        G = r([l], {
                            templateString: B,
                            validateAsType: "url"
                        }),
                        Q = r([l], {
                            templateString: f,
                            validateAsType: "radiocheckbox",
                            postCreate: function() {
                                k.forEach(this.choices, d.hitch(this, function(a, b) {
                                    var c = this.merge_id ? this.name + "-" + b : this.name + "-" + this.group_id + "-" + b,
                                        c = "mc-" + c,
                                        f = '\x3cli\x3e\x3cinput id \x3d"' +
                                        c + '" type\x3d"' + this.type + '" value\x3d"' + a.value + '" name\x3d"' + this.name;
                                    "checkbox" == this.type && (f += "[" + a.value + "]");
                                    f += '" /\x3e\x3clabel for\x3d"' + c + '"\x3e' + a.label + "\x3c/label\x3e\x3c/li\x3e";
                                    e.place(f, this.choicesContainer, "last")
                                }));
                                this.inherited(arguments)
                            }
                        }),
                        y = r([l], {
                            templateString: h,
                            validateAsType: "select",
                            postCreate: function() {
                                var a = [];
                                k.forEach(this.choices, d.hitch(this, function(b) {
                                    var c = e.toDom('\x3coption value\x3d"' + b.value + '"\x3e' + b.label + "\x3c/option\x3e");
                                    this._empty(b.label) && a.push(c);
                                    e.place(c, this.choicesContainer, "last")
                                }));
                                0 < a.length ? E.set(a[0], "selected", "selected") : e.place('\x3coption value\x3d"" selected\x3d"selected"\x3e\x3c/option\x3e', this.choicesContainer, "first");
                                this.inherited(arguments)
                            }
                        });
                    return r("SignupForm", [s, n, u], {
                        templateString: F,
                        subscribeUrl: "#",
                        fields: [],
                        buttonLabel: "Subscribe",
                        description: "",
                        footer: "",
                        config: {},
                        constructor: function() {
                            this.formIsValid = !1;
                            this.fieldNodes = []
                        },
                        postMixInProperties: function() {
                            this.fields = this.config.fields;
                            this.footer = this.config.footer;
                            this.description = this.config.description;
                            this.config.buttonLabel && (this.buttonLabel = this.config.buttonLabel)
                        },
                        postCreate: function() {
                            this.addFields();
                            w.set(this.footerContainer, this.footer);
                            w.set(this.descriptionContainer, this.description);
                            var b = this;
                            g(this.formNode, "submit", function(f) {
                                f.stopPropagation();
                                f.preventDefault();
                                b._validateForm();
                                b.formIsValid ? c.get(b._getJsonPostUrl(), {
                                    jsonp: "c",
                                    query: a.toQuery(b.formNode)
                                }).then(function(a) {
                                    console.log(a);
                                    "error" == a.result ? b._handleErrorResponse(a) :
                                        b._handleSuccessResponse(a);
                                    b.emit("resizeFrame", {})
                                }) : b.emit("resizeFrame", {})
                            })
                        },
                        addFields: function() {
                            this.fieldNodes.length && (k.forEach(this.fieldNodes, function(a) {
                                a.destroy()
                            }), this.fieldNodes = [], e.empty(this.formFieldsContainer));
                            k.forEach(this.fields, d.hitch(this, function(a) {
                                a = this._createField(a);
                                a.placeAt(this.formFieldsContainer);
                                a.startup()
                            }))
                        },
                        _validateForm: function() {
                            var a = [];
                            k.forEach(this.fieldNodes, function(b) {
                                b = b.validateField();
                                0 < b.length && a.push(b)
                            });
                            this.formIsValid = !(0 < a.length)
                        },
                        _createField: function(a) {
                            switch (a.type) {
                                case "email":
                                    a = new R(a);
                                    break;
                                case "address":
                                    a = new M(a);
                                    break;
                                case "birthday":
                                    a = new U(a);
                                    break;
                                case "date":
                                    a = new V(a);
                                    break;
                                case "phone":
                                    a = "US" == a.phoneformat ? new J(a) : new P(a);
                                    break;
                                case "number":
                                    a = new S(a);
                                    break;
                                case "select":
                                case "dropdown":
                                    a = new y(a);
                                    break;
                                case "radio":
                                case "checkbox":
                                    a = new Q(a);
                                    break;
                                case "url":
                                case "image":
                                    a = new G(a);
                                    break;
                                default:
                                    a = new P(a)
                            }
                            this.fieldNodes.push(a);
                            return a
                        },
                        _handleSuccessResponse: function(a) {
                            var c = b(".flash-success",
                                this.formResponseMessages)[0];
                            c || (c = e.place('\x3cdiv class\x3d"flash-success"\x3e\x3c/div\x3e', this.formResponseMessages));
                            w.set(c, a.msg);
                            (a = b(".flash-errors", this.formResponseMessages)[0]) && v.set(a, "display", "none");
                            this.formNode.reset();
                            k.forEach(this.fieldNodes, function(a) {
                                a.resetField()
                            });
                            v.set(this.formContentContainer, "display", "none");
                            v.set(this.formImageContainer, "display", "none")
                        },
                        _handleErrorResponse: function(a) {
                            var c = b(".flash-success", this.formResponseMessages)[0];
                            c && v.set(c, "display",
                                "none");
                            a.msg && ((c = b(".flash-errors", this.formResponseMessages)[0]) || (c = e.place('\x3cdiv class\x3d"flash-errors"\x3e\x3c/div\x3e', this.formResponseMessages)), w.set(c, a.msg), "absolute" === v.getComputedStyle(this.formImageContainer).position && v.set(this.formImageContainer, {
                                top: m.getMarginBox(c).h + "px"
                            }));
                            a.errors && k.forEach(this.fieldNodes, function(b) {
                                a.errors.hasOwnProperty(b.merge_id) ? b.setFieldAsInvalid(a.errors[b.merge_id]) : b.setFieldAsValid()
                            })
                        },
                        _getJsonPostUrl: function() {
                            var a = this.subscribeUrl;
                            return a = a.replace("/form-post?u\x3d", "/form-post-json?u\x3d")
                        },
                        toHTML: function() {
                            return this.domNode.outerHTML
                        }
                    })
                })
        },
        "dijit/_FocusMixin": function() {
            define(["./focus", "./_WidgetBase", "dojo/_base/declare", "dojo/_base/lang"], function(r, s, n, l) {
                l.extend(s, {
                    focused: !1,
                    onFocus: function() {},
                    onBlur: function() {},
                    _onFocus: function() {
                        this.onFocus()
                    },
                    _onBlur: function() {
                        this.onBlur()
                    }
                });
                return n("dijit._FocusMixin", null, {
                    _focusManager: r
                })
            })
        },
        "dijit/focus": function() {
            define("dojo/aspect dojo/_base/declare dojo/dom dojo/dom-attr dojo/dom-construct dojo/Evented dojo/_base/lang dojo/on dojo/domReady dojo/sniff dojo/Stateful dojo/_base/window dojo/window ./a11y ./registry ./main".split(" "),
                function(r, s, n, l, k, b, g, d, c, a, m, e, v, E, w, u) {
                    var F, z = new(s([m, b], {
                        curNode: null,
                        activeStack: [],
                        constructor: function() {
                            var a = g.hitch(this, function(a) {
                                n.isDescendant(this.curNode, a) && this.set("curNode", null);
                                n.isDescendant(this.prevNode, a) && this.set("prevNode", null)
                            });
                            r.before(k, "empty", a);
                            r.before(k, "destroy", a)
                        },
                        registerIframe: function(a) {
                            return this.registerWin(a.contentWindow, a)
                        },
                        registerWin: function(b, c) {
                            var e = this,
                                m = b.document && b.document.body;
                            if (m) {
                                var g = "mousedown";
                                a("touch") && (g += ",touchstart");
                                var l = d(b.document, g, function(a) {
                                        e._justMouseDowned = !0;
                                        setTimeout(function() {
                                            e._justMouseDowned = !1
                                        }, 0);
                                        if (!a || !(a.target && null == a.target.parentNode)) e._onTouchNode(c || a.target, "mouse")
                                    }),
                                    f = d(m, "focusin", function(a) {
                                        F = (new Date).getTime();
                                        if (a.target.tagName) {
                                            var b = a.target.tagName.toLowerCase();
                                            "#document" == b || "body" == b || (E.isTabNavigable(a.target) ? e._onFocusNode(c || a.target) : e._onTouchNode(c || a.target))
                                        }
                                    }),
                                    h = d(m, "focusout", function(a) {
                                        (new Date).getTime() < F + 100 || e._onBlurNode(c || a.target)
                                    });
                                return {
                                    remove: function() {
                                        l.remove();
                                        f.remove();
                                        h.remove();
                                        m = l = f = h = null
                                    }
                                }
                            }
                        },
                        _onBlurNode: function(a) {
                            this._clearFocusTimer && clearTimeout(this._clearFocusTimer);
                            this._clearFocusTimer = setTimeout(g.hitch(this, function() {
                                this.set("prevNode", this.curNode);
                                this.set("curNode", null)
                            }), 0);
                            this._justMouseDowned || (this._clearActiveWidgetsTimer && clearTimeout(this._clearActiveWidgetsTimer), this._clearActiveWidgetsTimer = setTimeout(g.hitch(this, function() {
                                delete this._clearActiveWidgetsTimer;
                                this._setStack([])
                            }), 0))
                        },
                        _onTouchNode: function(a, b) {
                            this._clearActiveWidgetsTimer &&
                                (clearTimeout(this._clearActiveWidgetsTimer), delete this._clearActiveWidgetsTimer);
                            var c = [];
                            try {
                                for (; a;) {
                                    var d = l.get(a, "dijitPopupParent");
                                    if (d) a = w.byId(d).domNode;
                                    else if (a.tagName && "body" == a.tagName.toLowerCase()) {
                                        if (a === e.body()) break;
                                        a = v.get(a.ownerDocument).frameElement
                                    } else {
                                        var m = a.getAttribute && a.getAttribute("widgetId"),
                                            g = m && w.byId(m);
                                        g && !("mouse" == b && g.get("disabled")) && c.unshift(m);
                                        a = a.parentNode
                                    }
                                }
                            } catch (f) {}
                            this._setStack(c, b)
                        },
                        _onFocusNode: function(a) {
                            a && 9 != a.nodeType && (this._clearFocusTimer &&
                                (clearTimeout(this._clearFocusTimer), delete this._clearFocusTimer), this._onTouchNode(a), a != this.curNode && (this.set("prevNode", this.curNode), this.set("curNode", a)))
                        },
                        _setStack: function(a, b) {
                            var c = this.activeStack,
                                e = c.length - 1,
                                d = a.length - 1;
                            if (a[d] != c[e]) {
                                this.set("activeStack", a);
                                var m;
                                for (m = e; 0 <= m && c[m] != a[m]; m--)
                                    if (e = w.byId(c[m])) e._hasBeenBlurred = !0, e.set("focused", !1), e._focusManager == this && e._onBlur(b), this.emit("widget-blur", e, b);
                                for (m++; m <= d; m++)
                                    if (e = w.byId(a[m])) e.set("focused", !0), e._focusManager ==
                                        this && e._onFocus(b), this.emit("widget-focus", e, b)
                            }
                        },
                        focus: function(a) {
                            if (a) try {
                                a.focus()
                            } catch (b) {}
                        }
                    }));
                    c(function() {
                        var b = z.registerWin(v.get(document));
                        a("ie") && d(window, "unload", function() {
                            b && (b.remove(), b = null)
                        })
                    });
                    u.focus = function(a) {
                        z.focus(a)
                    };
                    for (var x in z) /^_/.test(x) || (u.focus[x] = "function" == typeof z[x] ? g.hitch(z, x) : z[x]);
                    z.watch(function(a, b, c) {
                        u.focus[a] = c
                    });
                    return z
                })
        },
        "dojo/window": function() {
            define("./_base/lang ./sniff ./_base/window ./dom ./dom-geometry ./dom-style ./dom-construct".split(" "),
                function(r, s, n, l, k, b, g) {
                    s.add("rtl-adjust-position-for-verticalScrollBar", function(b, a) {
                        var d = n.body(a),
                            e = g.create("div", {
                                style: {
                                    overflow: "scroll",
                                    overflowX: "visible",
                                    direction: "rtl",
                                    visibility: "hidden",
                                    position: "absolute",
                                    left: "0",
                                    top: "0",
                                    width: "64px",
                                    height: "64px"
                                }
                            }, d, "last"),
                            l = g.create("div", {
                                style: {
                                    overflow: "hidden",
                                    direction: "ltr"
                                }
                            }, e, "last"),
                            s = 0 != k.position(l).x;
                        e.removeChild(l);
                        d.removeChild(e);
                        return s
                    });
                    s.add("position-fixed-support", function(b, a) {
                        var d = n.body(a),
                            e = g.create("span", {
                                style: {
                                    visibility: "hidden",
                                    position: "fixed",
                                    left: "1px",
                                    top: "1px"
                                }
                            }, d, "last"),
                            l = g.create("span", {
                                style: {
                                    position: "fixed",
                                    left: "0",
                                    top: "0"
                                }
                            }, e, "last"),
                            s = k.position(l).x != k.position(e).x;
                        e.removeChild(l);
                        d.removeChild(e);
                        return s
                    });
                    var d = {
                        getBox: function(b) {
                            b = b || n.doc;
                            var a = "BackCompat" == b.compatMode ? n.body(b) : b.documentElement,
                                m = k.docScroll(b);
                            if (s("touch")) {
                                var e = d.get(b);
                                b = e.innerWidth || a.clientWidth;
                                a = e.innerHeight || a.clientHeight
                            } else b = a.clientWidth, a = a.clientHeight;
                            return {
                                l: m.x,
                                t: m.y,
                                w: b,
                                h: a
                            }
                        },
                        get: function(b) {
                            if (9 > s("ie") &&
                                d !== document.parentWindow) {
                                b.parentWindow.execScript("document._parentWindow \x3d window;", "Javascript");
                                var a = b._parentWindow;
                                b._parentWindow = null;
                                return a
                            }
                            return b.parentWindow || b.defaultView
                        },
                        scrollIntoView: function(c, a) {
                            try {
                                c = l.byId(c);
                                var d = c.ownerDocument || n.doc,
                                    e = n.body(d),
                                    g = d.documentElement || e.parentNode,
                                    r = s("ie"),
                                    w = s("webkit");
                                if (!(c == e || c == g))
                                    if (!s("mozilla") && (!r && !w && !s("opera")) && "scrollIntoView" in c) c.scrollIntoView(!1);
                                    else {
                                        var u = "BackCompat" == d.compatMode,
                                            F = Math.min(e.clientWidth ||
                                                g.clientWidth, g.clientWidth || e.clientWidth),
                                            z = Math.min(e.clientHeight || g.clientHeight, g.clientHeight || e.clientHeight),
                                            d = w || u ? e : g,
                                            x = a || k.position(c),
                                            p = c.parentNode,
                                            w = function(a) {
                                                return 6 >= r || 7 == r && u ? !1 : s("position-fixed-support") && "fixed" == b.get(a, "position").toLowerCase()
                                            };
                                        if (!w(c))
                                            for (; p;) {
                                                p == e && (p = d);
                                                var t = k.position(p),
                                                    q = w(p),
                                                    C = "rtl" == b.getComputedStyle(p).direction.toLowerCase();
                                                if (p == d) {
                                                    t.w = F;
                                                    t.h = z;
                                                    d == g && (r && C) && (t.x += d.offsetWidth - t.w);
                                                    if (0 > t.x || !r || 9 <= r) t.x = 0;
                                                    if (0 > t.y || !r || 9 <= r) t.y = 0
                                                } else {
                                                    var H =
                                                        k.getPadBorderExtents(p);
                                                    t.w -= H.w;
                                                    t.h -= H.h;
                                                    t.x += H.l;
                                                    t.y += H.t;
                                                    var B = p.clientWidth,
                                                        f = t.w - B;
                                                    0 < B && 0 < f && (C && s("rtl-adjust-position-for-verticalScrollBar") && (t.x += f), t.w = B);
                                                    B = p.clientHeight;
                                                    f = t.h - B;
                                                    0 < B && 0 < f && (t.h = B)
                                                }
                                                q && (0 > t.y && (t.h += t.y, t.y = 0), 0 > t.x && (t.w += t.x, t.x = 0), t.y + t.h > z && (t.h = z - t.y), t.x + t.w > F && (t.w = F - t.x));
                                                var h = x.x - t.x,
                                                    I = x.y - t.y,
                                                    P = h + x.w - t.w,
                                                    S = I + x.h - t.h,
                                                    M, R;
                                                if (0 < P * h && (p.scrollLeft || p == d || p.scrollWidth > p.offsetHeight)) {
                                                    M = Math[0 > h ? "max" : "min"](h, P);
                                                    if (C && (8 == r && !u || 9 <= r)) M = -M;
                                                    R = p.scrollLeft;
                                                    p.scrollLeft +=
                                                        M;
                                                    M = p.scrollLeft - R;
                                                    x.x -= M
                                                }
                                                if (0 < S * I && (p.scrollTop || p == d || p.scrollHeight > p.offsetHeight)) M = Math.ceil(Math[0 > I ? "max" : "min"](I, S)), R = p.scrollTop, p.scrollTop += M, M = p.scrollTop - R, x.y -= M;
                                                p = p != d && !q && p.parentNode
                                            }
                                    }
                            } catch (U) {
                                console.error("scrollIntoView: " + U), c.scrollIntoView(!1)
                            }
                        }
                    };
                    r.setObject("dojo.window", d);
                    return d
                })
        },
        "dijit/a11y": function() {
            define("dojo/_base/array dojo/dom dojo/dom-attr dojo/dom-style dojo/_base/lang dojo/sniff ./main".split(" "), function(r, s, n, l, k, b, g) {
                var d = {
                    _isElementShown: function(b) {
                        var a =
                            l.get(b);
                        return "hidden" != a.visibility && "collapsed" != a.visibility && "none" != a.display && "hidden" != n.get(b, "type")
                    },
                    hasDefaultTabStop: function(b) {
                        switch (b.nodeName.toLowerCase()) {
                            case "a":
                                return n.has(b, "href");
                            case "area":
                            case "button":
                            case "input":
                            case "object":
                            case "select":
                            case "textarea":
                                return !0;
                            case "iframe":
                                var a;
                                try {
                                    var d = b.contentDocument;
                                    if ("designMode" in d && "on" == d.designMode) return !0;
                                    a = d.body
                                } catch (e) {
                                    try {
                                        a = b.contentWindow.document.body
                                    } catch (g) {
                                        return !1
                                    }
                                }
                                return a && ("true" == a.contentEditable ||
                                    a.firstChild && "true" == a.firstChild.contentEditable);
                            default:
                                return "true" == b.contentEditable
                        }
                    },
                    isTabNavigable: function(b) {
                        return n.get(b, "disabled") ? !1 : n.has(b, "tabIndex") ? 0 <= n.get(b, "tabIndex") : d.hasDefaultTabStop(b)
                    },
                    _getTabNavigable: function(c) {
                        function a(a) {
                            return a && "input" == a.tagName.toLowerCase() && a.type && "radio" == a.type.toLowerCase() && a.name && a.name.toLowerCase()
                        }
                        var m, e, g, l, k, s, r = {},
                            z = d._isElementShown,
                            x = d.isTabNavigable,
                            p = function(c) {
                                for (c = c.firstChild; c; c = c.nextSibling)
                                    if (!(1 != c.nodeType ||
                                            9 >= b("ie") && "HTML" !== c.scopeName || !z(c))) {
                                        if (x(c)) {
                                            var d = +n.get(c, "tabIndex");
                                            if (!n.has(c, "tabIndex") || 0 == d) m || (m = c), e = c;
                                            else if (0 < d) {
                                                if (!g || d < l) l = d, g = c;
                                                if (!k || d >= s) s = d, k = c
                                            }
                                            d = a(c);
                                            n.get(c, "checked") && d && (r[d] = c)
                                        }
                                        "SELECT" != c.nodeName.toUpperCase() && p(c)
                                    }
                            };
                        z(c) && p(c);
                        return {
                            first: r[a(m)] || m,
                            last: r[a(e)] || e,
                            lowest: r[a(g)] || g,
                            highest: r[a(k)] || k
                        }
                    },
                    getFirstInTabbingOrder: function(b, a) {
                        var m = d._getTabNavigable(s.byId(b, a));
                        return m.lowest ? m.lowest : m.first
                    },
                    getLastInTabbingOrder: function(b, a) {
                        var m = d._getTabNavigable(s.byId(b,
                            a));
                        return m.last ? m.last : m.highest
                    }
                };
                k.mixin(g, d);
                return d
            })
        },
        "dojo/request/script": function() {
            define("module ./watch ./util ../_base/array ../_base/lang ../on ../dom ../dom-construct ../has ../_base/window".split(" "), function(r, s, n, l, k, b, g, d, c, a) {
                function m(a, b) {
                    a.canDelete && u._remove(a.id, b.options.frameDoc, !0)
                }

                function e(a) {
                    q && q.length && (l.forEach(q, function(a) {
                        u._remove(a.id, a.frameDoc);
                        a.frameDoc = null
                    }), q = []);
                    return a.options.jsonp ? !a.data : !0
                }

                function v(a) {
                    return !!this.scriptLoaded
                }

                function E(a) {
                    return (a =
                        a.options.checkString) && eval("typeof(" + a + ') !\x3d\x3d "undefined"')
                }

                function w(a, b) {
                    if (this.canDelete) {
                        var c = this.response.options;
                        q.push({
                            id: this.id,
                            frameDoc: c.ioArgs ? c.ioArgs.frameDoc : c.frameDoc
                        });
                        c.ioArgs && (c.ioArgs.frameDoc = null);
                        c.frameDoc = null
                    }
                    b ? this.reject(b) : this.resolve(a)
                }

                function u(a, c, d) {
                    var f = n.parseArgs(a, n.deepCopy({}, c));
                    a = f.url;
                    c = f.options;
                    var h = n.deferred(f, m, e, c.jsonp ? null : c.checkString ? E : v, w);
                    k.mixin(h, {
                        id: F + z++,
                        canDelete: !1
                    });
                    c.jsonp && (RegExp("[?\x26]" + c.jsonp + "\x3d").test(a) ||
                        (a += (~a.indexOf("?") ? "\x26" : "?") + c.jsonp + "\x3d" + (c.frameDoc ? "parent." : "") + F + "_callbacks." + h.id), h.canDelete = !0, t[h.id] = function(a) {
                            f.data = a;
                            h.handleResponse(f)
                        });
                    n.notify && n.notify.emit("send", f, h.promise.cancel);
                    if (!c.canAttach || c.canAttach(h)) {
                        var g = u._attach(h.id, a, c.frameDoc);
                        if (!c.jsonp && !c.checkString) var l = b(g, x, function(a) {
                            if ("load" === a.type || p.test(g.readyState)) l.remove(), h.scriptLoaded = a
                        })
                    }
                    s(h);
                    return d ? h : h.promise
                }
                c.add("script-readystatechange", function(a, b) {
                    return "undefined" !== typeof b.createElement("script").onreadystatechange &&
                        ("undefined" === typeof a.opera || "[object Opera]" !== a.opera.toString())
                });
                var F = r.id.replace(/[\/\.\-]/g, "_"),
                    z = 0,
                    x = c("script-readystatechange") ? "readystatechange" : "load",
                    p = /complete|loaded/,
                    t = this[F + "_callbacks"] = {},
                    q = [];
                u.get = u;
                u._attach = function(b, c, e) {
                    e = e || a.doc;
                    var f = e.createElement("script");
                    f.type = "text/javascript";
                    f.src = c;
                    f.id = b;
                    f.async = !0;
                    f.charset = "utf-8";
                    return e.getElementsByTagName("head")[0].appendChild(f)
                };
                u._remove = function(a, b, c) {
                    d.destroy(g.byId(a, b));
                    t[a] && (c ? t[a] = function() {
                            delete t[a]
                        } :
                        delete t[a])
                };
                u._callbacksProperty = F + "_callbacks";
                return u
            })
        },
        "dojo/html": function() {
            define("./_base/kernel ./_base/lang ./_base/array ./_base/declare ./dom ./dom-construct ./parser".split(" "), function(r, s, n, l, k, b, g) {
                var d = {};
                s.setObject("dojo.html", d);
                var c = 0;
                d._secureForInnerHtml = function(a) {
                    return a.replace(/(?:\s*<!DOCTYPE\s[^>]+>|<title[^>]*>[\s\S]*?<\/title>)/ig, "")
                };
                d._emptyNode = b.empty;
                d._setNodeContent = function(a, c) {
                    b.empty(a);
                    if (c)
                        if ("string" == typeof c && (c = b.toDom(c, a.ownerDocument)), !c.nodeType &&
                            s.isArrayLike(c))
                            for (var e = c.length, d = 0; d < c.length; d = e == c.length ? d + 1 : 0) b.place(c[d], a, "last");
                        else b.place(c, a, "last");
                    return a
                };
                d._ContentSetter = l("dojo.html._ContentSetter", null, {
                    node: "",
                    content: "",
                    id: "",
                    cleanContent: !1,
                    extractContent: !1,
                    parseContent: !1,
                    parserScope: r._scopeName,
                    startup: !0,
                    constructor: function(a, b) {
                        s.mixin(this, a || {});
                        b = this.node = k.byId(this.node || b);
                        this.id || (this.id = ["Setter", b ? b.id || b.tagName : "", c++].join("_"))
                    },
                    set: function(a, b) {
                        void 0 !== a && (this.content = a);
                        b && this._mixin(b);
                        this.onBegin();
                        this.setContent();
                        var c = this.onEnd();
                        return c && c.then ? c : this.node
                    },
                    setContent: function() {
                        var a = this.node;
                        if (!a) throw Error(this.declaredClass + ": setContent given no node");
                        try {
                            a = d._setNodeContent(a, this.content)
                        } catch (b) {
                            var c = this.onContentError(b);
                            try {
                                a.innerHTML = c
                            } catch (g) {
                                console.error("Fatal " + this.declaredClass + ".setContent could not change content due to " + g.message, g)
                            }
                        }
                        this.node = a
                    },
                    empty: function() {
                        this.parseDeferred && (this.parseDeferred.isResolved() || this.parseDeferred.cancel(),
                            delete this.parseDeferred);
                        this.parseResults && this.parseResults.length && (n.forEach(this.parseResults, function(a) {
                            a.destroy && a.destroy()
                        }), delete this.parseResults);
                        b.empty(this.node)
                    },
                    onBegin: function() {
                        var a = this.content;
                        if (s.isString(a) && (this.cleanContent && (a = d._secureForInnerHtml(a)), this.extractContent)) {
                            var b = a.match(/<body[^>]*>\s*([\s\S]+)\s*<\/body>/im);
                            b && (a = b[1])
                        }
                        this.empty();
                        this.content = a;
                        return this.node
                    },
                    onEnd: function() {
                        this.parseContent && this._parse();
                        return this.node
                    },
                    tearDown: function() {
                        delete this.parseResults;
                        delete this.parseDeferred;
                        delete this.node;
                        delete this.content
                    },
                    onContentError: function(a) {
                        return "Error occurred setting content: " + a
                    },
                    onExecError: function(a) {
                        return "Error occurred executing scripts: " + a
                    },
                    _mixin: function(a) {
                        var b = {},
                            c;
                        for (c in a) c in b || (this[c] = a[c])
                    },
                    _parse: function() {
                        var a = this.node;
                        try {
                            var b = {};
                            n.forEach(["dir", "lang", "textDir"], function(a) {
                                this[a] && (b[a] = this[a])
                            }, this);
                            var c = this;
                            this.parseDeferred = g.parse({
                                rootNode: a,
                                noStart: !this.startup,
                                inherited: b,
                                scope: this.parserScope
                            }).then(function(a) {
                                return c.parseResults =
                                    a
                            }, function(a) {
                                c._onError("Content", a, "Error parsing in _ContentSetter#" + this.id)
                            })
                        } catch (d) {
                            this._onError("Content", d, "Error parsing in _ContentSetter#" + this.id)
                        }
                    },
                    _onError: function(a, b, c) {
                        a = this["on" + a + "Error"].call(this, b);
                        c ? console.error(c, b) : a && d._setNodeContent(this.node, a, !0)
                    }
                });
                d.set = function(a, b, c) {
                    void 0 == b && (console.warn("dojo.html.set: no cont argument provided, using empty string"), b = "");
                    return c ? (new d._ContentSetter(s.mixin(c, {
                        content: b,
                        node: a
                    }))).set() : d._setNodeContent(a, b, !0)
                };
                return d
            })
        },
        "dojo/parser": function() {
            define("require ./_base/kernel ./_base/lang ./_base/array ./_base/config ./dom ./_base/window ./_base/url ./aspect ./promise/all ./date/stamp ./Deferred ./has ./query ./on ./ready".split(" "), function(r, s, n, l, k, b, g, d, c, a, m, e, v, E, w, u) {
                function F(a) {
                    return eval("(" + a + ")")
                }

                function z(a) {
                    var b = a._nameCaseMap,
                        c = a.prototype;
                    if (!b || b._extendCnt < p) {
                        var b = a._nameCaseMap = {},
                            f;
                        for (f in c) "_" !== f.charAt(0) && (b[f.toLowerCase()] = f);
                        b._extendCnt = p
                    }
                    return b
                }

                function x(a, b) {
                    var c = a.join();
                    if (!t[c]) {
                        for (var f = [], e = 0, d = a.length; e < d; e++) {
                            var g = a[e];
                            f[f.length] = t[g] = t[g] || n.getObject(g) || ~g.indexOf("/") && (b ? b(g) : r(g))
                        }
                        e = f.shift();
                        t[c] = f.length ? e.createSubclass ? e.createSubclass(f) : e.extend.apply(e, f) : e
                    }
                    return t[c]
                }
                new Date("X");
                var p = 0;
                c.after(n, "extend", function() {
                    p++
                }, !0);
                var t = {},
                    q = {
                        _clearCache: function() {
                            p++;
                            t = {}
                        },
                        _functionFromScript: function(a, b) {
                            var c = "",
                                e = "",
                                d = a.getAttribute(b + "args") || a.getAttribute("args"),
                                g = a.getAttribute("with"),
                                d = (d || "").split(/\s*,\s*/);
                            g && g.length && l.forEach(g.split(/\s*,\s*/),
                                function(a) {
                                    c += "with(" + a + "){";
                                    e += "}"
                                });
                            return new Function(d, c + a.innerHTML + e)
                        },
                        instantiate: function(a, b, c) {
                            b = b || {};
                            c = c || {};
                            var e = (c.scope || s._scopeName) + "Type",
                                d = "data-" + (c.scope || s._scopeName) + "-",
                                g = d + "type",
                                m = d + "mixins",
                                k = [];
                            l.forEach(a, function(a) {
                                var c = e in b ? b[e] : a.getAttribute(g) || a.getAttribute(e);
                                if (c) {
                                    var d = a.getAttribute(m),
                                        c = d ? [c].concat(d.split(/\s*,\s*/)) : [c];
                                    k.push({
                                        node: a,
                                        types: c
                                    })
                                }
                            });
                            return this._instantiate(k, b, c)
                        },
                        _instantiate: function(b, c, e, d) {
                            function g(a) {
                                !c._started && !e.noStart &&
                                    l.forEach(a, function(a) {
                                        "function" === typeof a.startup && !a._started && a.startup()
                                    });
                                return a
                            }
                            b = l.map(b, function(a) {
                                var b = a.ctor || x(a.types, e.contextRequire);
                                if (!b) throw Error("Unable to resolve constructor for: '" + a.types.join() + "'");
                                return this.construct(b, a.node, c, e, a.scripts, a.inherited)
                            }, this);
                            return d ? a(b).then(g) : g(b)
                        },
                        construct: function(a, b, e, f, g, k) {
                            function p(a) {
                                Q && n.setObject(Q, a);
                                for (J = 0; J < L.length; J++) c[L[J].advice || "after"](a, L[J].method, n.hitch(a, L[J].func), !0);
                                for (J = 0; J < O.length; J++) O[J].call(a);
                                for (J = 0; J < N.length; J++) a.watch(N[J].prop, N[J].func);
                                for (J = 0; J < T.length; J++) w(a, T[J].event, T[J].func);
                                return a
                            }
                            var q = a && a.prototype;
                            f = f || {};
                            var r = {};
                            f.defaults && n.mixin(r, f.defaults);
                            k && n.mixin(r, k);
                            var u;
                            v("dom-attributes-explicit") ? u = b.attributes : v("dom-attributes-specified-flag") ? u = l.filter(b.attributes, function(a) {
                                return a.specified
                            }) : (k = (/^input$|^img$/i.test(b.nodeName) ? b : b.cloneNode(!1)).outerHTML.replace(/=[^\s"']+|="[^"]*"|='[^']*'/g, "").replace(/^\s*<[a-zA-Z0-9]*\s*/, "").replace(/\s*>.*$/,
                                ""), u = l.map(k.split(/\s+/), function(a) {
                                var c = a.toLowerCase();
                                return {
                                    name: a,
                                    value: "LI" == b.nodeName && "value" == a || "enctype" == c ? b.getAttribute(c) : b.getAttributeNode(c).value
                                }
                            }));
                            var t = f.scope || s._scopeName;
                            k = "data-" + t + "-";
                            var x = {};
                            "dojo" !== t && (x[k + "props"] = "data-dojo-props", x[k + "type"] = "data-dojo-type", x[k + "mixins"] = "data-dojo-mixins", x[t + "type"] = "dojoType", x[k + "id"] = "data-dojo-id");
                            for (var J = 0, G, t = [], Q, y; G = u[J++];) {
                                var A = G.name,
                                    D = A.toLowerCase();
                                G = G.value;
                                switch (x[D] || D) {
                                    case "data-dojo-type":
                                    case "dojotype":
                                    case "data-dojo-mixins":
                                        break;
                                    case "data-dojo-props":
                                        y = G;
                                        break;
                                    case "data-dojo-id":
                                    case "jsid":
                                        Q = G;
                                        break;
                                    case "data-dojo-attach-point":
                                    case "dojoattachpoint":
                                        r.dojoAttachPoint = G;
                                        break;
                                    case "data-dojo-attach-event":
                                    case "dojoattachevent":
                                        r.dojoAttachEvent = G;
                                        break;
                                    case "class":
                                        r["class"] = b.className;
                                        break;
                                    case "style":
                                        r.style = b.style && b.style.cssText;
                                        break;
                                    default:
                                        if (A in q || (A = z(a)[D] || A), A in q) switch (typeof q[A]) {
                                            case "string":
                                                r[A] = G;
                                                break;
                                            case "number":
                                                r[A] = G.length ? Number(G) : NaN;
                                                break;
                                            case "boolean":
                                                r[A] = "false" != G.toLowerCase();
                                                break;
                                            case "function":
                                                "" === G || -1 != G.search(/[^\w\.]+/i) ? r[A] = new Function(G) : r[A] = n.getObject(G, !1) || new Function(G);
                                                t.push(A);
                                                break;
                                            default:
                                                D = q[A], r[A] = D && "length" in D ? G ? G.split(/\s*,\s*/) : [] : D instanceof Date ? "" == G ? new Date("") : "now" == G ? new Date : m.fromISOString(G) : D instanceof d ? s.baseUrl + G : F(G)
                                        } else r[A] = G
                                }
                            }
                            for (u = 0; u < t.length; u++) x = t[u].toLowerCase(), b.removeAttribute(x), b[x] = null;
                            if (y) try {
                                y = F.call(f.propsThis, "{" + y + "}"), n.mixin(r, y)
                            } catch (K) {
                                throw Error(K.toString() + " in data-dojo-props\x3d'" +
                                    y + "'");
                            }
                            n.mixin(r, e);
                            g || (g = a && (a._noScript || q._noScript) ? [] : E("\x3e script[type^\x3d'dojo/']", b));
                            var L = [],
                                O = [],
                                N = [],
                                T = [];
                            if (g)
                                for (J = 0; J < g.length; J++) x = g[J], b.removeChild(x), e = x.getAttribute(k + "event") || x.getAttribute("event"), f = x.getAttribute(k + "prop"), y = x.getAttribute(k + "method"), t = x.getAttribute(k + "advice"), u = x.getAttribute("type"), x = this._functionFromScript(x, k), e ? "dojo/connect" == u ? L.push({
                                    method: e,
                                    func: x
                                }) : "dojo/on" == u ? T.push({
                                    event: e,
                                    func: x
                                }) : r[e] = x : "dojo/aspect" == u ? L.push({
                                    method: y,
                                    advice: t,
                                    func: x
                                }) : "dojo/watch" == u ? N.push({
                                    prop: f,
                                    func: x
                                }) : O.push(x);
                            a = (g = a.markupFactory || q.markupFactory) ? g(r, b, a) : new a(r, b);
                            return a.then ? a.then(p) : p(a)
                        },
                        scan: function(a, b) {
                            function c(a) {
                                if (!a.inherited) {
                                    a.inherited = {};
                                    var b = a.node,
                                        e = c(a.parent),
                                        b = {
                                            dir: b.getAttribute("dir") || e.dir,
                                            lang: b.getAttribute("lang") || e.lang,
                                            textDir: b.getAttribute(q) || e.textDir
                                        },
                                        d;
                                    for (d in b) b[d] && (a.inherited[d] = b[d])
                                }
                                return a.inherited
                            }
                            var d = [],
                                g = [],
                                m = {},
                                k = (b.scope || s._scopeName) + "Type",
                                n = "data-" + (b.scope || s._scopeName) + "-",
                                p =
                                n + "type",
                                q = n + "textdir",
                                n = n + "mixins",
                                u = a.firstChild,
                                t = b.inherited;
                            if (!t) {
                                var w = function(a, b) {
                                        return a.getAttribute && a.getAttribute(b) || a.parentNode && w(a.parentNode, b)
                                    },
                                    t = {
                                        dir: w(a, "dir"),
                                        lang: w(a, "lang"),
                                        textDir: w(a, q)
                                    },
                                    E;
                                for (E in t) t[E] || delete t[E]
                            }
                            for (var t = {
                                    inherited: t
                                }, z, y;;)
                                if (u)
                                    if (1 != u.nodeType) u = u.nextSibling;
                                    else if (z && "script" == u.nodeName.toLowerCase())(A = u.getAttribute("type")) && /^dojo\/\w/i.test(A) && z.push(u), u = u.nextSibling;
                            else if (y) u = u.nextSibling;
                            else {
                                var A = u.getAttribute(p) || u.getAttribute(k);
                                E = u.firstChild;
                                if (!A && (!E || 3 == E.nodeType && !E.nextSibling)) u = u.nextSibling;
                                else {
                                    y = null;
                                    if (A) {
                                        var D = u.getAttribute(n);
                                        z = D ? [A].concat(D.split(/\s*,\s*/)) : [A];
                                        try {
                                            y = x(z, b.contextRequire)
                                        } catch (F) {}
                                        y || l.forEach(z, function(a) {
                                            ~a.indexOf("/") && !m[a] && (m[a] = !0, g[g.length] = a)
                                        });
                                        D = y && !y.prototype._noScript ? [] : null;
                                        t = {
                                            types: z,
                                            ctor: y,
                                            parent: t,
                                            node: u,
                                            scripts: D
                                        };
                                        t.inherited = c(t);
                                        d.push(t)
                                    } else t = {
                                        node: u,
                                        scripts: z,
                                        parent: t
                                    };
                                    z = D;
                                    y = u.stopParser || y && y.prototype.stopParser && !b.template;
                                    u = E
                                }
                            } else {
                                if (!t || !t.node) break;
                                u = t.node.nextSibling;
                                y = !1;
                                t = t.parent;
                                z = t.scripts
                            }
                            var L = new e;
                            g.length ? (v("dojo-debug-messages") && console.warn("WARNING: Modules being Auto-Required: " + g.join(", ")), (b.contextRequire || r)(g, function() {
                                    L.resolve(l.filter(d, function(a) {
                                        if (!a.ctor) try {
                                            a.ctor = x(a.types, b.contextRequire)
                                        } catch (c) {}
                                        for (var e = a.parent; e && !e.types;) e = e.parent;
                                        var d = a.ctor && a.ctor.prototype;
                                        a.instantiateChildren = !(d && d.stopParser && !b.template);
                                        a.instantiate = !e || e.instantiate && e.instantiateChildren;
                                        return a.instantiate
                                    }))
                                })) :
                                L.resolve(d);
                            return L.promise
                        },
                        _require: function(a, b) {
                            var c = F("{" + a.innerHTML + "}"),
                                d = [],
                                g = [],
                                m = new e,
                                k = b && b.contextRequire || r,
                                l;
                            for (l in c) d.push(l), g.push(c[l]);
                            k(g, function() {
                                for (var a = 0; a < d.length; a++) n.setObject(d[a], arguments[a]);
                                m.resolve(arguments)
                            });
                            return m.promise
                        },
                        _scanAmd: function(a, b) {
                            var c = new e,
                                d = c.promise;
                            c.resolve(!0);
                            var g = this;
                            E("script[type\x3d'dojo/require']", a).forEach(function(a) {
                                d = d.then(function() {
                                    return g._require(a, b)
                                });
                                a.parentNode.removeChild(a)
                            });
                            return d
                        },
                        parse: function(a,
                            c) {
                            var e;
                            !c && a && a.rootNode ? (c = a, e = c.rootNode) : a && n.isObject(a) && !("nodeType" in a) ? c = a : e = a;
                            e = e ? b.byId(e) : g.body();
                            c = c || {};
                            var d = c.template ? {
                                    template: !0
                                } : {},
                                h = [],
                                m = this,
                                k = this._scanAmd(e, c).then(function() {
                                    return m.scan(e, c)
                                }).then(function(a) {
                                    return m._instantiate(a, d, c, !0)
                                }).then(function(a) {
                                    return h = h.concat(a)
                                }).otherwise(function(a) {
                                    console.error("dojo/parser::parse() error", a);
                                    throw a;
                                });
                            n.mixin(h, k);
                            return h
                        }
                    };
                s.parser = q;
                k.parseOnLoad && u(100, q, "parse");
                return q
            })
        },
        "dojo/_base/url": function() {
            define(["./kernel"],
                function(r) {
                    var s = /^(([^:/?#]+):)?(\/\/([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?$/,
                        n = /^((([^\[:]+):)?([^@]+)@)?(\[([^\]]+)\]|([^\[:]*))(:([0-9]+))?$/,
                        l = function() {
                            for (var k = arguments, b = [k[0]], g = 1; g < k.length; g++)
                                if (k[g]) {
                                    var d = new l(k[g] + ""),
                                        b = new l(b[0] + "");
                                    if ("" == d.path && !d.scheme && !d.authority && !d.query) null != d.fragment && (b.fragment = d.fragment), d = b;
                                    else if (!d.scheme && (d.scheme = b.scheme, !d.authority && (d.authority = b.authority, "/" != d.path.charAt(0)))) {
                                        for (var b = (b.path.substring(0, b.path.lastIndexOf("/") +
                                                1) + d.path).split("/"), c = 0; c < b.length; c++) "." == b[c] ? c == b.length - 1 ? b[c] = "" : (b.splice(c, 1), c--) : 0 < c && (!(1 == c && "" == b[0]) && ".." == b[c] && ".." != b[c - 1]) && (c == b.length - 1 ? (b.splice(c, 1), b[c - 1] = "") : (b.splice(c - 1, 2), c -= 2));
                                        d.path = b.join("/")
                                    }
                                    b = [];
                                    d.scheme && b.push(d.scheme, ":");
                                    d.authority && b.push("//", d.authority);
                                    b.push(d.path);
                                    d.query && b.push("?", d.query);
                                    d.fragment && b.push("#", d.fragment)
                                }
                            this.uri = b.join("");
                            k = this.uri.match(s);
                            this.scheme = k[2] || (k[1] ? "" : null);
                            this.authority = k[4] || (k[3] ? "" : null);
                            this.path =
                                k[5];
                            this.query = k[7] || (k[6] ? "" : null);
                            this.fragment = k[9] || (k[8] ? "" : null);
                            null != this.authority && (k = this.authority.match(n), this.user = k[3] || null, this.password = k[4] || null, this.host = k[6] || k[7], this.port = k[9] || null)
                        };
                    l.prototype.toString = function() {
                        return this.uri
                    };
                    return r._Url = l
                })
        },
        "dojo/promise/all": function() {
            define(["../_base/array", "../Deferred", "../when"], function(r, s, n) {
                var l = r.some;
                return function(k) {
                    var b, g;
                    k instanceof Array ? g = k : k && "object" === typeof k && (b = k);
                    var d, c = [];
                    if (b) {
                        g = [];
                        for (var a in b) Object.hasOwnProperty.call(b,
                            a) && (c.push(a), g.push(b[a]));
                        d = {}
                    } else g && (d = []);
                    if (!g || !g.length) return (new s).resolve(d);
                    var m = new s;
                    m.promise.always(function() {
                        d = c = null
                    });
                    var e = g.length;
                    l(g, function(a, g) {
                        b || c.push(g);
                        n(a, function(a) {
                            m.isFulfilled() || (d[c[g]] = a, 0 === --e && m.resolve(d))
                        }, m.reject);
                        return m.isFulfilled()
                    });
                    return m.promise
                }
            })
        },
        "dojo/date/stamp": function() {
            define(["../_base/lang", "../_base/array"], function(r, s) {
                var n = {};
                r.setObject("dojo.date.stamp", n);
                n.fromISOString = function(l, k) {
                    n._isoRegExp || (n._isoRegExp = /^(?:(\d{4})(?:-(\d{2})(?:-(\d{2}))?)?)?(?:T(\d{2}):(\d{2})(?::(\d{2})(.\d+)?)?((?:[+-](\d{2}):(\d{2}))|Z)?)?$/);
                    var b = n._isoRegExp.exec(l),
                        g = null;
                    if (b) {
                        b.shift();
                        b[1] && b[1] --;
                        b[6] && (b[6] *= 1E3);
                        k && (k = new Date(k), s.forEach(s.map("FullYear Month Date Hours Minutes Seconds Milliseconds".split(" "), function(a) {
                            return k["get" + a]()
                        }), function(a, c) {
                            b[c] = b[c] || a
                        }));
                        g = new Date(b[0] || 1970, b[1] || 0, b[2] || 1, b[3] || 0, b[4] || 0, b[5] || 0, b[6] || 0);
                        100 > b[0] && g.setFullYear(b[0] || 1970);
                        var d = 0,
                            c = b[7] && b[7].charAt(0);
                        "Z" != c && (d = 60 * (b[8] || 0) + (Number(b[9]) || 0), "-" != c && (d *= -1));
                        c && (d -= g.getTimezoneOffset());
                        d && g.setTime(g.getTime() + 6E4 *
                            d)
                    }
                    return g
                };
                n.toISOString = function(l, k) {
                    var b = function(a) {
                        return 10 > a ? "0" + a : a
                    };
                    k = k || {};
                    var g = [],
                        d = k.zulu ? "getUTC" : "get",
                        c = "";
                    "time" != k.selector && (c = l[d + "FullYear"](), c = ["0000".substr((c + "").length) + c, b(l[d + "Month"]() + 1), b(l[d + "Date"]())].join("-"));
                    g.push(c);
                    if ("date" != k.selector) {
                        c = [b(l[d + "Hours"]()), b(l[d + "Minutes"]()), b(l[d + "Seconds"]())].join(":");
                        d = l[d + "Milliseconds"]();
                        k.milliseconds && (c += "." + (100 > d ? "0" : "") + b(d));
                        if (k.zulu) c += "Z";
                        else if ("time" != k.selector) var d = l.getTimezoneOffset(),
                            a = Math.abs(d),
                            c = c + ((0 < d ? "-" : "+") + b(Math.floor(a / 60)) + ":" + b(a % 60));
                        g.push(c)
                    }
                    return g.join("T")
                };
                return n
            })
        },
        "dojo/NodeList-manipulate": function() {
            define(["./query", "./_base/lang", "./_base/array", "./dom-construct", "./NodeList-dom"], function(r, s, n, l) {
                function k(b) {
                    var a = "";
                    b = b.childNodes;
                    for (var d = 0, e; e = b[d]; d++) 8 != e.nodeType && (a = 1 == e.nodeType ? a + k(e) : a + e.nodeValue);
                    return a
                }

                function b(b) {
                    for (; b.childNodes[0] && 1 == b.childNodes[0].nodeType;) b = b.childNodes[0];
                    return b
                }

                function g(b, a) {
                    "string" == typeof b ? (b = l.toDom(b,
                        a && a.ownerDocument), 11 == b.nodeType && (b = b.childNodes[0])) : 1 == b.nodeType && b.parentNode && (b = b.cloneNode(!1));
                    return b
                }
                var d = r.NodeList;
                s.extend(d, {
                    _placeMultiple: function(b, a) {
                        for (var d = "string" == typeof b || b.nodeType ? r(b) : b, e = [], g = 0; g < d.length; g++)
                            for (var k = d[g], n = this.length, u = n - 1, s; s = this[u]; u--) 0 < g && (s = this._cloneNode(s), e.unshift(s)), u == n - 1 ? l.place(s, k, a) : k.parentNode.insertBefore(s, k), k = s;
                        e.length && (e.unshift(0), e.unshift(this.length - 1), Array.prototype.splice.apply(this, e));
                        return this
                    },
                    innerHTML: function(b) {
                        return arguments.length ?
                            this.addContent(b, "only") : this[0].innerHTML
                    },
                    text: function(b) {
                        if (arguments.length) {
                            for (var a = 0, d; d = this[a]; a++) 1 == d.nodeType && (l.empty(d), d.appendChild(d.ownerDocument.createTextNode(b)));
                            return this
                        }
                        for (var e = "", a = 0; d = this[a]; a++) e += k(d);
                        return e
                    },
                    val: function(b) {
                        if (arguments.length) {
                            for (var a = s.isArray(b), d = 0, e; e = this[d]; d++) {
                                var g = e.nodeName.toUpperCase(),
                                    k = e.type,
                                    l = a ? b[d] : b;
                                if ("SELECT" == g) {
                                    g = e.options;
                                    for (k = 0; k < g.length; k++) {
                                        var r = g[k];
                                        r.selected = e.multiple ? -1 != n.indexOf(b, r.value) : r.value == l
                                    }
                                } else "checkbox" ==
                                    k || "radio" == k ? e.checked = e.value == l : e.value = l
                            }
                            return this
                        }
                        if ((e = this[0]) && 1 == e.nodeType) {
                            b = e.value || "";
                            if ("SELECT" == e.nodeName.toUpperCase() && e.multiple) {
                                b = [];
                                g = e.options;
                                for (k = 0; k < g.length; k++) r = g[k], r.selected && b.push(r.value);
                                b.length || (b = null)
                            }
                            return b
                        }
                    },
                    append: function(b) {
                        return this.addContent(b, "last")
                    },
                    appendTo: function(b) {
                        return this._placeMultiple(b, "last")
                    },
                    prepend: function(b) {
                        return this.addContent(b, "first")
                    },
                    prependTo: function(b) {
                        return this._placeMultiple(b, "first")
                    },
                    after: function(b) {
                        return this.addContent(b,
                            "after")
                    },
                    insertAfter: function(b) {
                        return this._placeMultiple(b, "after")
                    },
                    before: function(b) {
                        return this.addContent(b, "before")
                    },
                    insertBefore: function(b) {
                        return this._placeMultiple(b, "before")
                    },
                    remove: d.prototype.orphan,
                    wrap: function(c) {
                        if (this[0]) {
                            c = g(c, this[0]);
                            for (var a = 0, d; d = this[a]; a++) {
                                var e = this._cloneNode(c);
                                d.parentNode && d.parentNode.replaceChild(e, d);
                                b(e).appendChild(d)
                            }
                        }
                        return this
                    },
                    wrapAll: function(c) {
                        if (this[0]) {
                            c = g(c, this[0]);
                            this[0].parentNode.replaceChild(c, this[0]);
                            c = b(c);
                            for (var a =
                                    0, d; d = this[a]; a++) c.appendChild(d)
                        }
                        return this
                    },
                    wrapInner: function(b) {
                        if (this[0]) {
                            b = g(b, this[0]);
                            for (var a = 0; a < this.length; a++) {
                                var d = this._cloneNode(b);
                                this._wrap(s._toArray(this[a].childNodes), null, this._NodeListCtor).wrapAll(d)
                            }
                        }
                        return this
                    },
                    replaceWith: function(b) {
                        b = this._normalize(b, this[0]);
                        for (var a = 0, d; d = this[a]; a++) this._place(b, d, "before", 0 < a), d.parentNode.removeChild(d);
                        return this
                    },
                    replaceAll: function(b) {
                        b = r(b);
                        for (var a = this._normalize(this, this[0]), d = 0, e; e = b[d]; d++) this._place(a, e, "before",
                            0 < d), e.parentNode.removeChild(e);
                        return this
                    },
                    clone: function() {
                        for (var b = [], a = 0; a < this.length; a++) b.push(this._cloneNode(this[a]));
                        return this._wrap(b, this, this._NodeListCtor)
                    }
                });
                d.prototype.html || (d.prototype.html = d.prototype.innerHTML);
                return d
            })
        },
        "url:mojo/signup-forms/templates/modal.html": '\x3cdiv\x3e\n    \x3c!-- MC MODAL --\x3e\n    \x3cdiv class\x3d"mc-modal" data-dojo-attach-point\x3d"modalContainer"\x3e\n        \x3cdiv class\x3d"mc-closeModal" data-action\x3d"close-mc-modal"\x3eclose\x3c/div\x3e\n        \x3cdiv class\x3d"mc-layout__modalContent"\x3e\n        \t\x3ciframe src\x3d"about:blank" frameborder\x3d"0" marginwidth\x3d"0" marginheight\x3d"0" scrolling\x3d"no" src\x3d"about:blank" style\x3d"width:100%;" data-dojo-attach-point\x3d"iframeContainer"\x3e\x3c/iframe\x3e\n        \x3c/div\x3e\n    \x3c/div\x3e\n\n    \x3c!-- MC MODAL OVERLAY --\x3e\n    \x3cdiv class\x3d"mc-modal-bg" data-dojo-attach-point\x3d"modalOverlay"\x3e\x3c/div\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/templates/form.html": '\x3cdiv class\x3d"modalContent"\x3e\n    \x3cdiv class\x3d"flash-block" data-dojo-attach-point\x3d"formResponseMessages"\x3e\x3c/div\x3e\n    \x3cdiv class\x3d"modalContent__content" data-dojo-attach-point\x3d"formContentContainer"\x3e\n        \n        \x3c!-- Title \x26 Description - Holds HTML from CK editor --\x3e\n        \x3cdiv class\x3d"content__titleDescription" data-dojo-attach-point\x3d"descriptionContainer"\x3e\x3c/div\x3e\n\n        \x3c!-- Form Fields --\x3e\n\t\t\x3cform action\x3d"${subscribeUrl}" accept-charset\x3d"UTF-8" method\x3d"post" enctype\x3d"multipart/form-data" data-dojo-attach-point\x3d"formNode" novalidate\x3e\n\t\t\t\x3cdiv class\x3d"content__formFields" data-dojo-attach-point\x3d"formFieldsContainer"\x3e\x3c/div\x3e\n\t\t    \x3cdiv class\x3d"content__button"\x3e\n\t\t        \x3cinput class\x3d"button" type\x3d"submit" value\x3d"${buttonLabel}" data-dojo-attach-point\x3d"submitButton"/\x3e\n\t\t    \x3c/div\x3e\n\t\t\x3c/form\x3e\n\n        \x3c!-- Footer - Holds HTML from CK editor --\x3e\n        \x3cdiv class\x3d"content__footer" data-dojo-attach-point\x3d"footerContainer"\x3e\x3c/div\x3e\n    \x3c/div\x3e\n    \x3cdiv class\x3d"modalContent__image" data-dojo-attach-point\x3d"formImageContainer"\x3e\x3c/div\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/inputs/templates/Text.html": '\x3cdiv class\x3d"field-wrapper"\x3e\n\t\x3clabel for\x3d"mc-${name}"\x3e${label}\x3c/label\x3e\n\t\x3cinput type\x3d"text" name\x3d"${name}" value\x3d"" id\x3d"mc-${name}" /\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/inputs/templates/Address.html": '\x3cdiv class\x3d"field-wrapper address"\x3e\n\t\x3cdiv\x3e\n\t    \x3clabel for\x3d"mc-${name}-addr1"\x3e${label}\x3c/label\x3e\n\t\t\x3cinput class\x3d"address1" type\x3d"text" name\x3d"${name}[addr1]" value\x3d"" id\x3d"mc-${name}-addr1" data-dojo-attach-point\x3d"address1Node" /\x3e\n\t\x3c/div\x3e\n\t\x3cdiv\x3e\n\t    \x3clabel for\x3d"mc-${name}-addr2"\x3eAddress Line 2\x3c/label\x3e\n\t\t\x3cinput class\x3d"address2" type\x3d"text" name\x3d"${name}[addr2]" value\x3d"" id\x3d"mc-${name}-addr2" /\x3e\n\t\x3c/div\x3e\n\t\x3cdiv\x3e\n\t    \x3clabel for\x3d"mc-${name}-city"\x3eCity\x3c/label\x3e\n\t\t\x3cinput class\x3d"city" type\x3d"text" name\x3d"${name}[city]" value\x3d"" id\x3d"mc-${name}-city" data-dojo-attach-point\x3d"cityNode" /\x3e\n\t\x3c/div\x3e\n\t\x3cdiv\x3e\n\t    \x3clabel for\x3d"mc-${name}-state"\x3eState/Province/Region\x3c/label\x3e\n\t\t\x3cinput class\x3d"state" type\x3d"text" name\x3d"${name}[state]" value\x3d"" id\x3d"mc-${name}-state" data-dojo-attach-point\x3d"stateNode" /\x3e\n\t\x3c/div\x3e\n\t\x3cdiv\x3e\n\t    \x3clabel for\x3d"mc-${name}-zip"\x3ePostal / Zip Code\x3c/label\x3e\n\t\t\x3cinput class\x3d"zip" type\x3d"text" name\x3d"${name}[zip]" value\x3d"" id\x3d"mc-${name}-zip" data-dojo-attach-point\x3d"zipNode" /\x3e\n\t\x3c/div\x3e\n\t\x3cdiv\x3e\n\t    \x3clabel for\x3d"mc-${name}-country"\x3eCountry\x3c/label\x3e\n\t    \x3c!-- TODO: Is there a formatting option for which country should be top of the list? --\x3e\n\t\t\x3cselect class\x3d"country" name\x3d"${name}[country]" id\x3d"mc-${name}-country" data-dojo-attach-point\x3d"countrySelectNode"\x3e\n\t\t    \x3coption value\x3d"" selected\x3e\x3c/option\x3e\n\t\t    \x3coption value\x3d"164"\x3eUSA\x3c/option\x3e\n\t\t\x3c/select\x3e\n\t\x3c/div\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/inputs/templates/Email.html": '\x3cdiv class\x3d"field-wrapper"\x3e\n\t\x3clabel for\x3d"mc-${name}"\x3e${label}\x3c/label\x3e\n\t\x3cinput type\x3d"text" name\x3d"${name}" value\x3d"" id\x3d"mc-${name}" /\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/inputs/templates/Birthday.html": '\x3cdiv class\x3d"field-wrapper birthday"\x3e\n\t\x3clabel for\x3d"mc-${name}-month"\x3e${label}\x3c/label\x3e\n\t\x3cdiv data-dojo-attach-point\x3d"inputsContainer"\x3e \n        \x3cinput class\x3d"birthday-month" type\x3d"text" placeholder\x3d"MM" maxlength\x3d"2" name\x3d"${name}[month]" value\x3d"" id\x3d"mc-${name}-month" data-dojo-attach-point\x3d"monthNode" /\x3e\n        \x3cinput class\x3d"birthday-day" type\x3d"text" placeholder\x3d"DD" maxlength\x3d"2" name\x3d"${name}[day]" value\x3d"" id\x3d"mc-${name}-day" data-dojo-attach-point\x3d"dayNode" /\x3e\n\t\x3c/div\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/inputs/templates/Date.html": '\x3cdiv class\x3d"field-wrapper date"\x3e\n\t\x3clabel for\x3d"mc-${name}-month"\x3e${label}\x3c/label\x3e\n\t\x3cdiv data-dojo-attach-point\x3d"inputsContainer"\x3e\n\t\t\x3cinput class\x3d"date-year" type\x3d"text" maxlength\x3d"4" placeholder\x3d"YYYY" name\x3d"${name}[year]" value\x3d"" id\x3d"mc-${name}-year" data-dojo-attach-point\x3d"yearNode" /\x3e\n\t\t\x3cinput class\x3d"date-month" type\x3d"text" maxlength\x3d"2" placeholder\x3d"MM" name\x3d"${name}[month]" value\x3d"" id\x3d"mc-${name}-month" data-dojo-attach-point\x3d"monthNode" /\x3e\n\t\t\x3cinput class\x3d"date-day" type\x3d"text" maxlength\x3d"2" placeholder\x3d"DD" name\x3d"${name}[day]" value\x3d"" id\x3d"mc-${name}-day" data-dojo-attach-point\x3d"dayNode" /\x3e\n\t\x3c/div\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/inputs/templates/Phone.html": '\x3cdiv class\x3d"field-wrapper phone"\x3e\n\t\x3clabel for\x3d"mc-${name}-area"\x3e${label}\x3c/label\x3e\n    \x3cdiv\x3e\n        \x3cinput class\x3d"phone-area" type\x3d"text" maxlength\x3d"3" placeholder\x3d"###" name\x3d"${name}[area]" value\x3d"" id\x3d"mc-${name}-area" data-dojo-attach-point\x3d"phoneAreaNode" /\x3e\n        \x3cinput class\x3d"phone-detail1" type\x3d"text" maxlength\x3d"3" placeholder\x3d"###" name\x3d"${name}[detail1]" value\x3d"" id\x3d"mc-${name}-detail1" data-dojo-attach-point\x3d"phoneDetail1Node" /\x3e\n       \t\x3cinput class\x3d"phone-detail2" type\x3d"text" maxlength\x3d"4" placeholder\x3d"####" name\x3d"${name}[detail2]" value\x3d"" id\x3d"mc-${name}-detail2" data-dojo-attach-point\x3d"phoneDetail2Node" /\x3e\n    \x3c/div\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/inputs/templates/Number.html": '\x3cdiv class\x3d"field-wrapper"\x3e\n\t\x3clabel for\x3d"mc-${name}"\x3e${label}\x3c/label\x3e\n\t\x3cinput type\x3d"text" name\x3d"${name}" value\x3d"" id\x3d"mc-${name}" /\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/inputs/templates/Url.html": '\x3cdiv class\x3d"field-wrapper"\x3e\n\t\x3clabel for\x3d"mc-${name}"\x3e${label}\x3c/label\x3e\n\t\x3cinput type\x3d"text" placeholder\x3d"http://" name\x3d"${name}" value\x3d"" id\x3d"mc-${name}" /\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/inputs/templates/RadioCheckbox.html": '\x3cdiv class\x3d"field-wrapper radio-group"\x3e\n\t\x3clabel for\x3d"mc-${name}"\x3e${label}\x3c/label\x3e\n\t\x3cul class\x3d"radioCheckboxContainer" data-dojo-attach-point\x3d"choicesContainer"\x3e\x3c/ul\x3e\n\x3c/div\x3e',
        "url:mojo/signup-forms/inputs/templates/Select.html": '\x3cdiv class\x3d"field-wrapper"\x3e\n\t\x3clabel for\x3d"mc-${name}"\x3e${label}\x3c/label\x3e\n\t\x3cselect name\x3d"${name}" id\x3d"mc-${name}" data-dojo-attach-point\x3d"choicesContainer"\x3e\x3c/select\x3e\n\x3c/div\x3e'
    }
});
define("mojo/signup-forms/popup", [], 1);
