var AppDateFunction = (function () {
    "use strict";
    function e() {
        function e(e) {
            var t = 0;
            return (
                e.forEach(function (e) {
                    t += e;
                }),
                t
            );
        }
        function t(e, t) {
            var n = Date.UTC(e.year, e.month - 1, e.day),
                r = Date.UTC(t.year, t.month - 1, t.day);
            return Math.abs((r - n) / 864e5);
        }
        function n(t, n) {
            var r = 0,
                a = 0;
            for (a = t.year; a <= n.year; a += 1) r += e(s[a]);
            for (a = 0; a < t.month; a += 1) r -= s[t.year][a];
            for (r += s[t.year][11], a = n.month - 1; a < 12; a += 1)
                r -= s[n.year][a];
            return (r -= t.day + 1), (r += n.day - 1);
        }
        function a(e, t) {
            var n = new Date(r(e, "MM/DD/YYYY"));
            return (
                n.setDate(n.getDate() + t),
                {
                    year: n.getFullYear(),
                    month: n.getMonth() + 1,
                    day: n.getDate(),
                }
            );
        }
        function i(e, t) {
            for (e.day += t; e.day > s[e.year][e.month - 1]; )
                (e.day -= s[e.year][e.month - 1]),
                    (e.month += 1),
                    e.month > 12 && ((e.month = 1), (e.year += 1));
            return { year: e.year, month: e.month, day: e.day };
        }
        function o(e) {
            var t = n(l, e);
            return a(c, t);
        }
        function d(e) {
            var n = t(c, e);
            return i(l, n);
        }
        function u(e, t) {
            return s[e][t - 1];
        }
        var s = [],
            l = { year: 2e3, month: 9, day: 17 },
            c = { year: 1944, month: 1, day: 1 };
        return (
            (s[2e3] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31]),
            (s[2001] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2002] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2003] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2004] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31]),
            (s[2005] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2006] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2007] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2008] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31]),
            (s[2009] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2010] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2011] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2012] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30]),
            (s[2013] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2014] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2015] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2016] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30]),
            (s[2017] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2018] = [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2019] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31]),
            (s[2020] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2021] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2022] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30]),
            (s[2023] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31]),
            (s[2024] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2025] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2026] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2027] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31]),
            (s[2028] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2029] = [31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30]),
            (s[2030] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2031] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31]),
            (s[2032] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2033] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2034] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2035] = [30, 32, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31]),
            (s[2036] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2037] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2038] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2039] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30]),
            (s[2040] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2041] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2042] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2043] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30]),
            (s[2044] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2045] = [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2046] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2047] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2048] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2049] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30]),
            (s[2050] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31]),
            (s[2051] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2052] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2053] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30]),
            (s[2054] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31]),
            (s[2055] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2056] = [31, 31, 32, 31, 32, 30, 30, 29, 30, 29, 30, 30]),
            (s[2057] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2058] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31]),
            (s[2059] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2060] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2061] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2062] = [30, 32, 31, 32, 31, 31, 29, 30, 29, 30, 29, 31]),
            (s[2063] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2064] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2065] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2066] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 29, 31]),
            (s[2067] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2068] = [31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2069] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2070] = [31, 31, 31, 32, 31, 31, 29, 30, 30, 29, 30, 30]),
            (s[2071] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2072] = [31, 32, 31, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2073] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31]),
            (s[2074] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2075] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2076] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30]),
            (s[2077] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31]),
            (s[2078] = [31, 31, 31, 32, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2079] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30]),
            (s[2080] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 30]),
            (s[2081] = [31, 31, 32, 32, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2082] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2083] = [31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2084] = [31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2085] = [31, 32, 31, 32, 30, 31, 30, 30, 29, 30, 30, 30]),
            (s[2086] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2087] = [31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30]),
            (s[2088] = [30, 31, 32, 32, 30, 31, 30, 30, 29, 30, 30, 30]),
            (s[2089] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2090] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2091] = [31, 31, 32, 31, 31, 31, 30, 30, 29, 30, 30, 30]),
            (s[2092] = [30, 31, 32, 32, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2093] = [30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2094] = [31, 31, 32, 31, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2095] = [31, 31, 32, 31, 31, 31, 30, 29, 30, 30, 30, 30]),
            (s[2096] = [30, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30]),
            (s[2097] = [31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 30, 30]),
            (s[2098] = [31, 31, 32, 31, 31, 31, 29, 30, 29, 30, 29, 31]),
            (s[2099] = [31, 31, 32, 31, 31, 31, 30, 29, 29, 30, 30, 30]),
            {
                countAdDays: t,
                countBsDays: n,
                addBsDays: i,
                addAdDays: a,
                bs2ad: o,
                ad2bs: d,
                getDaysInMonth: u,
            }
        );
    }
    function t(e) {
        function t(e) {
            var t = {},
                n = [],
                r = [];
            e.forEach(function (e, t) {
                var n = parseInt(e),
                    a = { index: t, value: n, year: !1, month: !1, day: !1 };
                n > 0 && n > 999
                    ? (a.year = !0)
                    : n > 0 && n > 12
                    ? (a.day = !0)
                    : n > 0 && n <= 12 && ((a.month = !0), (a.day = !0)),
                    r.push(a);
            });
            var a = r.filter(function (e) {
                return 1 == e.year;
            })[0];
            if (a) {
                (t.year = a.value), (n[a.index] = "YYYY");
                var i = r.filter(function (e) {
                        return 1 == e.day;
                    }),
                    o = r.filter(function (e) {
                        return 1 == e.month;
                    });
                1 == o.length
                    ? ((t.month = o[0].value),
                      (n[o[0].index] = "MM"),
                      1 == i.length
                          ? ((t.day = i[0].value), (n[i[0].index] = "DD"))
                          : ((i = i.find(function (e) {
                                return !e.month;
                            })),
                            (t.day = i.value),
                            (n[i.index] = "DD")))
                    : 2 == o.length && 0 == i.length
                    ? ((t.month = o[0].value),
                      (t.day = o[1].value),
                      (n[o[0].index] = "MM"),
                      (n[o[1].index] = "DD"))
                    : 2 == o.length &&
                      2 == i.length &&
                      ((t.month = i[0].value),
                      (t.day = i[1].value),
                      (n[i[0].index] = "MM"),
                      (n[i[1].index] = "DD"));
            }
            if (
                (t && NaN == t.year) ||
                null == t.year ||
                NaN == t.month ||
                null == t.month ||
                NaN == t.day ||
                null == t.day
            )
                (t = null), (n = null);
            else {
                var d = G(t.year, t.month);
                t.day > d && ((t = null), (n = null));
            }
            return { parsedDate: t, parsedFormat: n };
        }
        var n = e.indexOf("/") > -1,
            r = e.indexOf("-") > -1,
            a = null;
        if (n) {
            var i = e.split("/");
            3 == i.length &&
                ((a = t(i)), (a.parsedFormat = a.parsedFormat.join("/")));
        } else if (r) {
            var o = e.split("-");
            3 == o.length &&
                ((a = t(o)), (a.parsedFormat = a.parsedFormat.join("-")));
        }
        return a;
    }
    function n(e, t) {
        var n = [],
            r = { year: null, month: null, day: null };
        switch (t) {
            case "MM/DD/YYYY":
                (n = e.split("/")),
                    3 == n.length &&
                        (r = {
                            year: Number(n[2]),
                            month: Number(n[0]),
                            day: Number(n[1]),
                        });
                break;
            case "MM-DD-YYYY":
                (n = e.split("-")),
                    3 == n.length &&
                        (r = {
                            year: Number(n[2]),
                            month: Number(n[0]),
                            day: Number(n[1]),
                        });
                break;
            case "YYYY-MM-DD":
                (n = e.split("-")),
                    3 == n.length &&
                        (r = {
                            year: Number(n[0]),
                            month: Number(n[1]),
                            day: Number(n[2]),
                        });
                break;
            case "YYYY/MM/DD":
                (n = e.split("/")),
                    3 == n.length &&
                        (r = {
                            year: Number(n[0]),
                            month: Number(n[1]),
                            day: Number(n[2]),
                        });
                break;
            case "DD-MM-YYYY":
                (n = e.split("-")),
                    3 == n.length &&
                        (r = {
                            year: Number(n[2]),
                            month: Number(n[1]),
                            day: Number(n[0]),
                        });
                break;
            case "DD/MM/YYYY":
                (n = e.split("/")),
                    3 == n.length &&
                        (r = {
                            year: Number(n[2]),
                            month: Number(n[1]),
                            day: Number(n[0]),
                        });
        }
        return (
            ((r && NaN == r.year) ||
                null == r.year ||
                NaN == r.month ||
                null == r.month ||
                NaN == r.day ||
                null == r.day) &&
                (r = null),
            r
        );
    }
    function r(e, t) {
        function n(e) {
            return (e = Number(e)), e < 10 ? "0" + e : e;
        }
        var r = "";
        switch ((t = t && R.indexOf(t) > -1 ? t : "YYYY-MM-DD")) {
            case "MM/DD/YYYY":
                r = n(e.month) + "/" + n(e.day) + "/" + e.year;
                break;
            case "MM-DD-YYYY":
                r = n(e.month) + "-" + n(e.day) + "-" + e.year;
                break;
            case "YYYY-MM-DD":
                r = e.year + "-" + n(e.month) + "-" + n(e.day);
                break;
            case "YYYY/MM/DD":
                r = e.year + "/" + n(e.month) + "/" + n(e.day);
                break;
            case "DD-MM-YYYY":
                r = n(e.day) + "-" + n(e.month) + "-" + e.year;
                break;
            case "DD/MM/YYYY":
                r = n(e.day) + "/" + n(e.month) + "/" + e.year;
        }
        return r;
    }
    function a(t) {
        return new e().ad2bs(t);
    }
    function i(t) {
        return new e().bs2ad(t);
    }
    function o(e) {
        var t = G(e.year, e.month);
        return e.month > 0 && e.month <= 12 && e.day > 0 && e.day <= t;
    }
    function d() {
        var e = new Date();
        
        return { year: e.getFullYear(), month: e.getMonth(), day: e.getDay() };
    }
    function u() {
        var e = d();
        return Number(e.year);
    }
    function s() {
        var e = d();
        return Number(e.month);
    }
    function l() {
        var e = d();
        return Number(e.day);
    }
    function c() {
        return a(d());
    }
    function m() {
        var e = c();
        return Number(e.year);
    }
    function p() {
        var e = c();
        return Number(e.month);
    }
    function f() {
        var e = c();
        return Number(e.day);
    }
    function y() {
        return [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
    }
    function b(e) {
        return (e = Number(e)), isNaN(e) || e < 0 || e > 11 ? null : y()[e];
    }
    function h() {
        return [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
    }
    function v(e) {
        return (e = Number(e)), isNaN(e) || e < 0 || e > 11 ? null : h()[e];
    }
    function D() {
        return [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December",
        ];
    }
    function g(e) {
        return (e = Number(e)), isNaN(e) || e < 0 || e > 11 ? null : D()[e];
    }
    function N() {
        return [
            'Sunday',
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
        ];
    }
    function A(e) {
        return (
            (e = Number(e)), isNaN(e) || e < 0 || e > 6 ? null : N()[Number(e)]
        );
    }
    function B() {
        return ["Sun", "Mon", "Tue", "Wed", "Thu", "Fry", "Sat"];
    }
    function M() {
        return [
            "Sunday",
            "Monday",
            "Tuesday",
            "Wednesday",
            "Thursday",
            "Friday",
            "Saturday",
        ];
    }
    function F(e) {
        return (
            (e = Number(e)), isNaN(e) || e < 0 || e > 6 ? null : M()[Number(e)]
        );
    }
    function Y(e, t) {
        var n = [],
            r = "";
        return (
            t
                ? ((n = D()),
                  (r = L(e.day) + " " + n[e.month - 1] + " " + L(e.year)))
                : ((n = h()),
                  (r = e.day + " " + n[e.month - 1] + " " + e.year)),
            r
        );
    }
    function C(e) {
        return (
            e.day + " " + AppDateFunction.GetAdMonth(e.month - 1) + " " + e.year
        );
    }
    function T(e) {
        var t = AppDateFunction.BS2AD(e);
        return (t = new Date(t.year, t.month - 1, t.day)), F(t.getDay());
    }
    function E(e) {
        var t = AppDateFunction.BS2AD(e);
        return (t = new Date(t.year, t.month - 1, t.day)), A(t.getDay());
    }
    function I(e) {
        return (e = new Date(e.year, e.month - 1, e.day)), F(e.getDay());
    }
    function S(t, n) {
        var r = new e(),
            a = r.bs2ad(t);
        return (
            (a = new Date(a.year, a.month, a.day)),
            a.setDate(a.getDate() + n),
            (a = {
                year: a.getFullYear(),
                month: a.getMonth(),
                day: a.getDate(),
            }),
            r.ad2bs(a)
        );
    }
    function O(t, n) {
        return new e().countAdDays(t, n);
    }
    function x(t, n) {
        if (!o(t) || !o(n)) return !1;
        var r = new e();
        return (t = r.bs2ad(t)), (n = r.bs2ad(n)), r.countAdDays(t, n);
    }
    function w(e, t) {
        return new Date(e, t, 0).getDate();
    }
    function G(t, n) {
        return new e().getDaysInMonth(t, n);
    }
    function L(e) {
        e = e.toString();
        var t = "",
            n = 0;
        for (n = 0; n < e.length; n += 1)
            t += (function (e) {
                switch (e) {
                    case "0":
                        return "0";
                    case "1":
                        return "1";
                    case "2":
                        return "2";
                    case "3":
                        return "3";
                    case "4":
                        return "4";
                    case "5":
                        return "5";
                    case "6":
                        return "6";
                    case "7":
                        return "7";
                    case "8":
                        return "8";
                    case "9":
                        return "9";
                    default:
                        return e;
                }
            })(e[n]);
        return t;
    }
    function j(e) {
        e = e.toString();
        for (var t = "", n = 0; n < e.length; )
            (t += (function (e) {
                switch (e) {
                    case "0":
                        return 0;
                    case "1":
                        return 1;
                    case "2":
                        return 2;
                    case "3":
                        return 3;
                    case "4":
                        return 4;
                    case "5":
                        return 5;
                    case "6":
                        return 6;
                    case "7":
                        return 7;
                    case "8":
                        return 8;
                    case "9":
                        return 9;
                    default:
                        return e;
                }
            })(e[n])),
                n++;
        return t;
    }
    function k(e) {
        return e < 10 ? "0" + Number(e) : e;
    }
    function H(e, t) {
        function n(e) {
            var t = {
                0: "",
                1: "One",
                2: "Two",
                3: "Three",
                4: "Four",
                5: "Five",
                6: "Six",
                7: "Seven",
                8: "Eight",
                9: "Nine",
                10: "Ten",
                11: "Eleven",
                12: "Twelve",
                13: "Thirteen",
                14: "Fourteen",
                15: "Fifteen",
                16: "Sixteen",
                17: "Seventeen",
                18: "Eighteen",
                19: "Nineteen",
                20: "Twenty",
                30: "Thirty",
                40: "Forty",
                50: "Fifty",
                60: "Sixty",
                70: "Seventy",
                80: "Eighty",
                90: "Ninety",
            };
            e = Number(e);
            var n = e.toString();
            return e < 20 ? t[e] : t[10 * n[0]] + " " + t[n[1]];
        }
        if (((e = e || 0), isNaN(e) || Math.floor(e).toString().length > 13))
            return null;
        var r = "",
            a = 0,
            i = e.toString();
        if (i.indexOf(".") > -1) {
            var o = i.split(".");
            a = Number(o[1]);
        }
        var d = Math.floor(e % 100),
            u = null;
        e.toString().length > 2 &&
            (u = e
                .toString()
                .substring(e.toString().length - 3, e.toString().length - 2));
        var s = Math.floor(e % 1e5);
        (s = s.toString()), (s = s.substring(0, s.length - 3));
        var l = Math.floor(e % 1e7);
        (l = l.toString()), (l = l.substring(0, l.length - 5));
        var c = Math.floor(e % 1e9);
        (c = c.toString()), (c = c.substring(0, c.length - 7));
        var m = Math.floor(e % 1e11);
        (m = m.toString()), (m = m.substring(0, m.length - 9));
        var p = Math.floor(e % 1e13);
        for (
            p = p.toString(),
                p = p.substring(0, p.length - 11),
                p > 0 && (r += n(p) + " Kharab"),
                m > 0 && (r += " " + n(m) + " Arab"),
                c > 0 && (r += " " + n(c) + " Crore"),
                l > 0 && (r += " " + n(l) + " Lakh"),
                s > 0 && (r += " " + n(s) + " Thousand"),
                u > 0 && (r += " " + n(u) + " Hundred"),
                d > 0 && (r += " " + n(d)),
                "" != r.trim() && t && (r += " Rupees"),
                a > 0 && t && (r += " and " + n(a) + " Paisa");
            r.indexOf("  ") > -1;

        )
            r = r.replace("  ", " ");
        return r.trim();
    }
    function U(e, t) {
        (e = this.BS2AD(e)), (t = this.BS2AD(t));
        var n = new Date(e.year, e.month, e.day),
            r = new Date(t.year, t.month, t.day);
        return n.getTime() > r.getTime();
    }
    var R = [
        "MM-DD-YYYY",
        "MM/DD/YYYY",
        "YYYY-MM-DD",
        "YYYY/MM/DD",
        "DD-MM-YYYY",
        "DD/MM/YYYY",
    ];
    return {
        ParseDate: t,
        ValidateBsDate: o,
        CompareBsDates: U,
        ConvertToDateObject: n,
        ConvertDateFormat: r,
        AD2BS: a,
        BS2AD: i,
        GetCurrentAdDate: d,
        GetCurrentAdYear: u,
        GetCurrentAdMonth: s,
        GetCurrentAdDay: l,
        GetCurrentBsDate: c,
        GetCurrentBsYear: m,
        GetCurrentBsMonth: p,
        GetCurrentBsDay: f,
        GetAdMonths: y,
        GetAdMonth: b,
        GetBsMonths: h,
        GetBsMonth: v,
        GetBsDaysUnicode: N,
        GetBsDaysUnicodeShort: B,
        GetBsDayUnicode: A,
        GetAdDays: M,
        GetAdDay: F,
        GetBsMonthsInUnicode: D,
        GetBsMonthInUnicode: g,
        GetDaysInAdMonth: w,
        GetDaysInBsMonth: G,
        AdDatesDiff: O,
        BsDatesDiff: x,
        BsAddDays: S,
        GetBsFullDate: Y,
        GetAdFullDate: C,
        GetAdFullDay: I,
        GetBsFullDay: T,
        GetBsFullDayInUnicode: E,
        ConvertToUnicode: L,
        ConvertToNumber: j,
        Get2DigitNo: k,
        NumberToWords: H,
        NumberToWordsUnicode: H,
    };
})();
!(function () {
    function e(e, t) {
        var n = e,
            r = t + 1;
        return r > 12 && ((n += 1), (r = 1)), { year: n, month: r };
    }
    function t(e, t) {
        var n = e,
            r = t - 1;
        return r < 1 && ((n -= 1), (r = 12)), { year: n, month: r };
    }
    function n() {
        M = !0;
    }
    function r() {
        M = !1;
    }
    function a(e) {
        (document.getElementById("ndp-nepali-box").style.top = "-999px"),
            (B = !1);
    }
    function i(e) {
        var t = {};
        if (B) a("showNdpCalendarBox");
        else {
            var n = document.getElementById(e);
            (t = g(e)),
                (document.getElementById("ndp-target-id").innerHTML = e);
            var r = n.value;
            t.unicodeDate && (r = AppDateFunction.ConvertToNumber(r));
            var i = "";
            if (r) i = AppDateFunction.ConvertToDateObject(r, t.dateFormat);
            else if (
                ((i = AppDateFunction.GetCurrentBsDate()), t.disableAfter)
            ) {
                var d = AppDateFunction.ConvertToDateObject(
                    t.disableAfter,
                    t.dateFormat
                );
                AppDateFunction.CompareBsDates(i, d) && (i = d);
            }
            var s = null;
            null == i
                ? ((i = AppDateFunction.GetCurrentBsDate()), (s = ""))
                : (s = AppDateFunction.ConvertDateFormat(i, "YYYY-MM-DD"));
            o(i.year, i.month, s), u(n), (B = !0);
        }
    }
    function o(n, r, a) {
        var i = document.getElementById("ndp-nepali-box"),
            u = g(null),
            s = i
                .getElementsByTagName("table")[0]
                .getElementsByTagName("tbody");
        s.length > 0 && s[0].parentNode.removeChild(s[0]);
        var l = u.ndpYearCount || 0,
            c = document.getElementById("currentMonth");
        c.innerHTML = "";
        var m = document.createElement("SPAN");
        m.innerHTML = " ";
        var p = document.createElement("SPAN");
        p.innerHTML = AppDateFunction.GetBsMonthInUnicode(r - 1);
        var f = document.createElement("SPAN");
        (f.innerHTML = AppDateFunction.ConvertToUnicode(n)),
            u.ndpMonth && u.ndpYear
                ? (c.appendChild(y(r, n, a)), c.appendChild(b(r, n, l, a)))
                : u.ndpMonth
                ? (c.appendChild(y(r, n, a)),
                  c.appendChild(m),
                  c.appendChild(f))
                : u.ndpYear
                ? (c.appendChild(p),
                  c.appendChild(m),
                  c.appendChild(b(r, n, l, a)))
                : (c.appendChild(p), c.appendChild(m), c.appendChild(f));
        var h = e(n, r),
            v = t(n, r),
            D = h.year,
            N = h.month,
            A = v.year,
            B = v.month,
            M = document.getElementById("ndp-header"),
            F = document.getElementById("prev");
        F && F.parentNode.removeChild(F);
        var Y = document.getElementById("next");
        Y && Y.parentNode.removeChild(Y);
        var C = !0;
        if (u.disableBefore || Number.isInteger(u.disableDaysBefore)) {
            var T = null;
            (T =
                Number.isInteger(u.disableDaysBefore) &&
                u.disableDaysBefore >= 0
                    ? AppDateFunction.BsAddDays(
                          AppDateFunction.GetCurrentBsDate(),
                          -1 * u.disableDaysBefore
                      )
                    : AppDateFunction.ConvertToDateObject(
                          u.disableBefore,
                          u.dateFormat
                      )),
                AppDateFunction.CompareBsDates(T, {
                    year: A,
                    month: B,
                    day: AppDateFunction.GetDaysInBsMonth(A, B),
                }) && (C = !1);
        }
        var E = document.createElement("SPAN");
        E.setAttribute("class", "ndc-chevron ndc-left");
        var I = document.createElement("A");
        I.setAttribute("id", "prev"),
            I.setAttribute("title", "Previous Month"),
            I.setAttribute("class", C ? "ndp-prev" : "ndp-prev ndp-disabled"),
            I.setAttribute("href", "javascript:void(0)"),
            I.appendChild(E),
            C &&
                I.addEventListener("click", function () {
                    o(A, B, a);
                });
        var S = !0;
        if (u.disableAfter || Number.isInteger(u.disableDaysAfter)) {
            var O = null;
            (O =
                Number.isInteger(u.disableDaysAfter) && u.disableDaysAfter >= 0
                    ? AppDateFunction.BsAddDays(
                          AppDateFunction.GetCurrentBsDate(),
                          u.disableDaysAfter
                      )
                    : AppDateFunction.ConvertToDateObject(
                          u.disableAfter,
                          u.dateFormat
                      )),
                AppDateFunction.CompareBsDates(
                    { year: D, month: N, day: 1 },
                    O
                ) && (S = !1);
        }
        var x = document.createElement("SPAN");
        x.setAttribute("class", "ndc-chevron ndc-right");
        var w = document.createElement("A");
        w.setAttribute("id", "next"),
            w.setAttribute("title", "Next Month"),
            w.setAttribute("class", S ? "ndp-next" : "ndp-next ndp-disabled"),
            w.setAttribute("href", "javascript:void(0)"),
            w.appendChild(x),
            S &&
                w.addEventListener("click", function () {
                    o(D, N, a);
                }),
            M.appendChild(I),
            M.appendChild(w),
            i
                .getElementsByTagName("table")[0]
                .insertAdjacentElement("beforeend", d(n, r, a));
    }
    function d(e, t, n) {
        var r,
            a,
            i,
            o = g(null);
        if (n) {
            var d = AppDateFunction.ConvertToDateObject(n, "YYYY-MM-DD");
            (r = d.year), (a = d.month), (i = d.day);
        }
        var u = AppDateFunction.GetCurrentBsDate(),
            s = u.year,
            l = u.month,
            c = u.day,
            m = AppDateFunction.GetDaysInBsMonth(e, t),
            p = { year: e, month: t, day: 1 },
            y = AppDateFunction.BS2AD(p),
            b = y.year,
            h = y.month,
            v = y.day,
            D = new Date(b, h - 1, v),
            N = D.getDay(),
            A = 0,
            B = 0,
            M = N + m,
            F = "",
            Y = "",
            C = 0;
        "object" != typeof o.disableBefore &&
            o.disableBefore &&
            o.dateFormat &&
            (o.disableBefore = AppDateFunction.ConvertToDateObject(
                o.disableBefore,
                o.dateFormat
            )),
            "object" != typeof o.disableAfter &&
                o.disableAfter &&
                o.dateFormat &&
                (o.disableAfter = AppDateFunction.ConvertToDateObject(
                    o.disableAfter,
                    o.dateFormat
                )),
            !o.disableBefore &&
                Number.isInteger(o.disableDaysBefore) &&
                parseInt(o.disableDaysBefore) >= 0 &&
                (o.disableBefore = AppDateFunction.BsAddDays(
                    AppDateFunction.GetCurrentBsDate(),
                    -1 * parseInt(o.disableDaysBefore)
                )),
            !o.disableAfter &&
                Number.isInteger(o.disableDaysAfter) &&
                parseInt(o.disableDaysAfter) >= 0 &&
                (o.disableAfter = AppDateFunction.BsAddDays(
                    AppDateFunction.GetCurrentBsDate(),
                    parseInt(o.disableDaysAfter)
                ));
        for (
            var T = document.createElement("TBODY"),
                E = document.createElement("TR"),
                I = document.createElement("TD"),
                S = document.createElement("A");
            B < M;

        ) {
            if (
                ((A = B),
                A % 7 == 0 && (E = document.createElement("TR")),
                (C = A - N + 1),
                (Y =
                    e.toString() +
                    "-" +
                    AppDateFunction.Get2DigitNo(t) +
                    "-" +
                    AppDateFunction.Get2DigitNo(C)),
                (F = ""),
                (F =
                    e === r && t === a && C === i
                        ? "ndp-selected"
                        : e === s && t === l && C === c
                        ? "ndp-current"
                        : "ndp-date"),
                A < N)
            )
                (I = document.createElement("TD")), E.appendChild(I);
            else {
                if (
                    ((I = document.createElement("TD")),
                    I.setAttribute("class", F),
                    (o.disableAfter &&
                        AppDateFunction.CompareBsDates(
                            AppDateFunction.ConvertToDateObject(
                                Y,
                                "YYYY-MM-DD"
                            ),
                            o.disableAfter
                        )) ||
                        (o.disableBefore &&
                            AppDateFunction.CompareBsDates(
                                o.disableBefore,
                                AppDateFunction.ConvertToDateObject(
                                    Y,
                                    "YYYY-MM-DD"
                                )
                            )))
                )
                    (S = document.createElement("A")),
                        S.setAttribute("class", "ndp-disabled"),
                        S.setAttribute("href", "javascript:void(0)"),
                        S.setAttribute("title", Y),
                        (S.innerHTML = AppDateFunction.ConvertToUnicode(C)),
                        I.appendChild(S);
                else {
                    var O = AppDateFunction.ConvertToDateObject(
                            Y,
                            "YYYY-MM-DD"
                        ),
                        x = AppDateFunction.ConvertDateFormat(O, o.dateFormat);
                    (S = document.createElement("A")),
                        S.setAttribute("href", "javascript:void(0)"),
                        S.setAttribute("title", Y),
                        S.setAttribute("data-value", x),
                        (S.innerHTML = AppDateFunction.ConvertToUnicode(C)),
                        S.addEventListener("click", function () {
                            f(this);
                        }),
                        I.appendChild(S);
                }
                E.appendChild(I);
            }
            A % 7 == 6 &&
                (T.appendChild(E), (E = document.createElement("TR"))),
                (B += 1);
        }
        return E.children.length > 0 && T.appendChild(E), T;
    }
    function u(e) {
        var t = s(e),
            n = m(t),
            r = p(e, t),
            a = document.getElementById("ndp-nepali-box"),
            i = a.offsetHeight,
            o = t.y + e.offsetHeight;
        r < i && r < n && (o = o - i - e.offsetHeight),
            (a.style.top = o + "px"),
            (a.style.left = t.x + "px");
    }
    function s(e) {
        var t = 0,
            n = 0;
        return (t += l(e)), (n += c(e)), { x: t, y: n };
    }
    function l(e) {
        for (var t = 0; e; ) (t += e.offsetLeft), (e = e.offsetParent);
        return (t += document.firstChild.offsetLeft || 0);
    }
    function c(e) {
        for (var t = 0; e; ) (t += e.offsetTop), (e = e.offsetParent);
        return (t += document.firstChild.offsetTop || 0);
    }
    function m(e) {
        var t =
            window.pageYOffset ||
            (
                document.documentElement ||
                document.body.parentNode ||
                document.body
            ).scrollTop;
        return e.y - t;
    }
    function p(e, t) {
        var n =
            window.pageYOffset ||
            (
                document.documentElement ||
                document.body.parentNode ||
                document.body
            ).scrollTop;
        return window.innerHeight - t.y - e.offsetHeight + n;
    }
    function f(e) {
        var t = e.getAttribute("data-value"),
            n = g(),
            r = AppDateFunction.ConvertToDateObject(t, n.dateFormat);
        n.ndpEnglishInput &&
            (document.getElementById(
                n.ndpEnglishInput
            ).value = AppDateFunction.ConvertDateFormat(
                AppDateFunction.BS2AD(r),
                n.dateFormat
            ));
        var i = document.getElementById("ndp-target-id").innerHTML;
        (document.getElementById(i).value = n.unicodeDate
            ? AppDateFunction.ConvertToUnicode(t)
            : t),
            n.onChange &&
                n.onChange({
                    bs: t,
                    ad: AppDateFunction.ConvertDateFormat(
                        AppDateFunction.BS2AD(r),
                        n.dateFormat
                    ),
                    object: r,
                }),
            a("setSelectedDay");

            elem=document.getElementById(i);
            et = new CustomEvent('changed', { value: elem.value });
            elem.dispatchEvent(et);
    }
    function y(e, t, n) {
        var r = g(),
            a = 1,
            i = 12;
        if (r.disableBefore || Number.isInteger(r.disableDaysBefore)) {
            var o = null;
            (o =
                Number.isInteger(r.disableDaysBefore) &&
                r.disableDaysBefore >= 0
                    ? AppDateFunction.BsAddDays(
                          AppDateFunction.ConvertToDateObject(n, r.dateFormat),
                          -1 * r.disableDaysBefore
                      )
                    : AppDateFunction.ConvertToDateObject(
                          r.disableBefore,
                          r.dateFormat
                      )),
                o.year == t && (a = o.month);
        }
        if (r.disableAfter || Number.isInteger(r.disableDaysAfter)) {
            var d = null;
            (d =
                Number.isInteger(r.disableDaysAfter) && r.disableDaysAfter >= 0
                    ? AppDateFunction.BsAddDays(
                          AppDateFunction.ConvertToDateObject(n, r.dateFormat),
                          r.disableDaysAfter
                      )
                    : AppDateFunction.ConvertToDateObject(
                          r.disableAfter,
                          r.dateFormat
                      )),
                d.year == t && (i = d.month);
        }
        var u = AppDateFunction.GetBsMonthsInUnicode(),
            s = document.createElement("SELECT");
        return (
            s.setAttribute("id", "ndp-month-select"),
            u.forEach(function (t, n) {
                if (n >= a - 1 && n <= i - 1) {
                    var r = document.createElement("OPTION");
                    r.setAttribute("value", n + 1),
                        (r.innerHTML = t),
                        n + 1 == e && r.setAttribute("selected", "selected"),
                        s.appendChild(r);
                }
            }),
            s.addEventListener("change", function () {
                h(t, n);
            }),
            s
        );
    }
    function b(e, t, n, r) {
        var a = g(),
            i = 2e3,
            o = 2099;
        if (a.disableBefore || Number.isInteger(a.disableDaysBefore)) {
            var d = null;
            (d =
                Number.isInteger(a.disableDaysBefore) &&
                a.disableDaysBefore >= 0
                    ? AppDateFunction.BsAddDays(
                          AppDateFunction.ConvertToDateObject(r, a.dateFormat),
                          -1 * a.disableDaysBefore
                      )
                    : AppDateFunction.ConvertToDateObject(
                          a.disableBefore,
                          a.dateFormat
                      )),
                d.year > i && (i = d.year);
        }
        if (a.disableAfter || Number.isInteger(a.disableDaysAfter)) {
            var u = null;
            (u =
                Number.isInteger(a.disableDaysAfter) && a.disableDaysAfter >= 0
                    ? AppDateFunction.BsAddDays(
                          AppDateFunction.ConvertToDateObject(r, a.dateFormat),
                          a.disableDaysAfter
                      )
                    : AppDateFunction.ConvertToDateObject(
                          a.disableAfter,
                          a.dateFormat
                      )),
                u.year < o && (o = u.year);
        }
        var s = document.createElement("SELECT");
        s.setAttribute("id", "ndp-year-select");
        for (
            var l =
                    Math.round(n / 2) > 0 &&
                    parseInt(t) - Math.round(n / 2) >= i
                        ? parseInt(t) - Math.round(n / 2)
                        : i,
                c =
                    Math.round(n / 2) > 0 &&
                    parseInt(t) + Math.round(n / 2) <= o
                        ? parseInt(t) + Math.round(n / 2)
                        : o;
            l <= c;

        ) {
            var m = document.createElement("OPTION");
            m.setAttribute("value", l),
                (m.innerHTML = AppDateFunction.ConvertToUnicode(l)),
                t == l && m.setAttribute("selected", "selected"),
                s.appendChild(m),
                (l += 1);
        }
        return (
            s.addEventListener("change", function () {
                v(e, r);
            }),
            s
        );
    }
    function h(e, t) {
        (e = g().ndpYear
            ? parseInt(document.getElementById("ndp-year-select").value)
            : e),
            o(
                e,
                parseInt(document.getElementById("ndp-month-select").value),
                t
            );
    }
    function v(e, t) {
        var n = g(),
            r = document.getElementById("ndp-year-select"),
            a = document.getElementById("ndp-month-select"),
            i = parseInt(r.value);
        e = n.ndpMonth ? parseInt(a.value) : e;
        var d = D(t),
            u = d.minDate,
            s = d.maxDate;
        u && u.year == i && e <= u.month && (e = u.month),
            s && s.year == i && e >= s.month && (e = s.month),
            o(i, e, t);
    }
    function D(e) {
        var t = g(),
            n = null,
            r = null;
        if (t.disableBefore || Number.isInteger(t.disableDaysBefore)) {
            var a = null;
            (a =
                Number.isInteger(t.disableDaysBefore) &&
                t.disableDaysBefore >= 0
                    ? AppDateFunction.BsAddDays(
                          AppDateFunction.ConvertToDateObject(e, t.dateFormat),
                          -1 * t.disableDaysBefore
                      )
                    : AppDateFunction.ConvertToDateObject(
                          t.disableBefore,
                          t.dateFormat
                      )),
                (n = a);
        }
        if (t.disableAfter || Number.isInteger(t.disableDaysAfter)) {
            var i = null;
            (i =
                Number.isInteger(t.disableDaysAfter) && t.disableDaysAfter >= 0
                    ? AppDateFunction.BsAddDays(
                          AppDateFunction.ConvertToDateObject(e, t.dateFormat),
                          t.disableDaysAfter
                      )
                    : AppDateFunction.ConvertToDateObject(
                          t.disableAfter,
                          t.dateFormat
                      )),
                (r = i);
        }
        return { minDate: n, maxDate: r };
    }
    function g(e) {
        var t = {};
        if (
            (e || (e = document.getElementById("ndp-target-id").innerHTML), e)
        ) {
            var n = F[e];
            n &&
                (t = {
                    ndpTriggerButton: n.ndpTriggerButton || null,
                    ndpTriggerButtonClass: n.ndpTriggerButtonClass || null,
                    ndpTriggerButtonText: n.ndpTriggerButtonText || null,
                    ndpEnglishInput: n.ndpEnglishInput || null,
                    ndpYearCount: n.ndpYearCount || null,
                    ndpYear: n.ndpYear || null,
                    ndpMonth: n.ndpMonth || null,
                    disableDaysBefore:
                        n.disableDaysBefore ||
                        (0 == n.disableDaysBefore ? 0 : null),
                    disableDaysAfter:
                        n.disableDaysAfter ||
                        (0 == n.disableDaysAfter ? 0 : null),
                    disableBefore: n.disableBefore || null,
                    disableAfter: n.disableAfter || null,
                    dateFormat: n.dateFormat || "YYYY-MM-DD",
                    onChange: n.onChange || null,
                    unicodeDate: n.unicodeDate || null,
                    readOnlyInput: n.readOnlyInput || !1,
                });
        }
        return t;
    }
    function N() {
        var e = document.activeElement,
            t = e.getAttribute("id");
        a("ndpInputOnFocus"), i(t);
    }
    function A() {
        var e = window.event || arguments.callee.caller.arguments[0];
        27 == e.which && (a("ndpKeyDown-Esc"), e.stopPropagation());
    }
    var B = !1,
        M = !1,
        F = [];
    (Object.prototype.nepaliDatePicker = function (e) {
        function t(e) {
            e.classList.remove("ndp-nepali-calendar"),
                e.removeAttribute("ndp-calendar-data"),
                e.removeAttribute("readonly"),
                e.removeEventListener("focus", N),
                e.removeEventListener("mouseenter", n),
                e.removeEventListener("mouseleave", r),
                e.removeEventListener("keydown", A);
            var t = e.getAttribute("id");
            delete F[t];
            var a = e.nextSibling;
            a &&
                "BUTTON" == a.tagName &&
                "ndp-click-trigger" == a.getAttribute("id") &&
                a.parentNode.removeChild(a);
        }
        function o(e, t) {
            var n = e.getAttribute("id");
            if (((F[n] = t), (F[n].raw = d(t)), e.value)) {
                var r = AppDateFunction.ParseDate(e.value);
                r &&
                    r.parsedFormat &&
                    (t.dateFormat = t.dateFormat
                        ? t.dateFormat
                        : r.parsedFormat);
            }
        }
        function d(e) {
            if (null == e || "object" != typeof e) return e;
            var t = e.constructor();
            for (var n in e) e.hasOwnProperty(n) && (t[n] = e[n]);
            return t;
        }
        function u(e, t) {
            for (var n = !1; e; ) {
                e.getAttribute("id") == t && ((n = !0), (e = null)),
                    (e = e ? e.offsetParent : null);
            }
            return n;
        }
        function s() {
            var e = document.getElementById("ndp-target-id").innerHTML,
                t = document.getElementById(e),
                n = document.activeElement,
                r = t == n,
                i = u(n, "ndp-nepali-box"),
                o = "ndp-click-trigger" == n.getAttribute("id"),
                d =
                    "ndp-month-select" == n.getAttribute("id") ||
                    "ndp-year-select" == n.getAttribute("id");
            ("BODY" == n.tagName || i || o) && (r = !0),
                ((B && !M && !d) || (B && M && !r)) && a("ndpInputOnBlur");
        }
        function l(e, t) {
            var n = e.getAttribute("id");
            if (
                (e.classList.add("ndp-nepali-calendar"),
                o(e, t),
                t.ndpTriggerButton || e.addEventListener("focus", N),
                e.addEventListener("blur", s),
                e.setAttribute("autocomplete", "off"),
                e.addEventListener("keydown", A),
                t.readOnlyInput && e.setAttribute("readonly", "readonly"),
                t.ndpTriggerButton)
            ) {
                var r =
                        t.ndpTriggerButtonClass &&
                        "" !== t.ndpTriggerButtonClass
                            ? t.ndpTriggerButtonClass
                            : "",
                    a =
                        t.ndpTriggerButtonText && "" !== t.ndpTriggerButtonText
                            ? t.ndpTriggerButtonText
                            : "Pick Date",
                    i = document.createElement("BUTTON");
                i.setAttribute("id", "ndp-click-trigger"),
                    i.setAttribute("class", r),
                    i.addEventListener("click", function () {
                        p(n);
                    }),
                    i.addEventListener("blur", c),
                    (i.innerHTML = a),
                    e.insertAdjacentElement("afterend", i);
            }
        }
        function c() {
            s();
        }
        function m() {
            var e = document.getElementById("ndp-nepali-box");
            return parseInt(e.style.top) > 0;
        }
        function p(e) {
            v || ((v = !0), m() ? a("toggleCalendar") : i(e), (v = !1));
        }
        var f = this;
        if ("remove" != e) {
            if (((e = void 0 === e ? {} : e), f.length && f.length > 0))
                for (var y = 0; y < f.length; y++) l(f[y], e);
            else l(f, e);
            if (!document.getElementById("ndp-nepali-box")) {
                document.body.insertAdjacentElement(
                    "beforeend",
                    (function () {
                        var e = document.createElement("DIV");
                        e.setAttribute("id", "ndp-nepali-box"),
                            e.setAttribute("tabindex", "-1"),
                            e.setAttribute("class", "ndp-corner-all"),
                            e.addEventListener("keydown", A);
                        var t = document.createElement("SPAN");
                        t.setAttribute("id", "ndp-target-id"),
                            t.setAttribute("class", "hidden");
                        var n = document.createElement("DIV");
                        n.setAttribute("id", "ndp-header"),
                            n.setAttribute(
                                "class",
                                "ndp-corner-all ndp-header"
                            );
                        var r = document.createElement("SPAN");
                        r.setAttribute("id", "currentMonth"), n.appendChild(r);
                        var a = document.createElement("DIV");
                        a.setAttribute("id", "currentMonth");
                        var i = document.createElement("TABLE");
                        a.setAttribute("id", "ndp-table");
                        var o = document.createElement("TR");
                        o.setAttribute("class", "ndp-days"),
                            AppDateFunction.GetBsDaysUnicodeShort().forEach(
                                function (e) {
                                    var t = document.createElement("TH");
                                    (t.innerHTML = e), o.appendChild(t);
                                }
                            );
                        var d = document.createElement("THEAD");
                        d.appendChild(o);
                        var u = document.createElement("TBODY");
                        return (
                            i.appendChild(d),
                            i.appendChild(u),
                            a.appendChild(i),
                            e.appendChild(t),
                            e.appendChild(n),
                            e.appendChild(a),
                            e
                        );
                    })()
                );
                var b = document.getElementById("ndp-nepali-box");
                b.addEventListener("mouseenter", n),
                    b.addEventListener("mouseleave", r);
            }
            var h = document.querySelectorAll(".ndp-nepali-calendar");
            if (h.length > 0)
                for (var y = 0; y < h.length; y++)
                    h[y].addEventListener("mouseenter", n),
                        h[y].addEventListener("mouseleave", r);
            window.addEventListener("mouseup", function () {
                if (m()) {
                    "ndp-click-trigger" ==
                        document.activeElement.getAttribute("id") || s();
                }
            });
            var v = !1;
        } else if (f.length && f.length > 0)
            for (var y = 0; y < f.length; y++) t(f[y]);
        else t(f);
    }),
        Object.defineProperty(Object.prototype, "nepaliDatePicker", {
            enumerable: !1,
            value: nepaliDatePicker,
        });
})();
