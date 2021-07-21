!function (e, t) {
    if ("object" == typeof exports && "object" == typeof module) module.exports = t(); else if ("function" == typeof define && define.amd) define([], t); else {
        var o = t();
        for (var r in o) ("object" == typeof exports ? exports : e)[r] = o[r]
    }
}(window, function () {
    return function (e) {
        var t = {};

        function o(r) {
            if (t[r]) return t[r].exports;
            var a = t[r] = {i: r, l: !1, exports: {}};
            return e[r].call(a.exports, a, a.exports, o), a.l = !0, a.exports
        }

        return o.m = e, o.c = t, o.d = function (e, t, r) {
            o.o(e, t) || Object.defineProperty(e, t, {enumerable: !0, get: r})
        }, o.r = function (e) {
            "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0})
        }, o.t = function (e, t) {
            if (1 & t && (e = o(e)), 8 & t) return e;
            if (4 & t && "object" == typeof e && e && e.__esModule) return e;
            var r = Object.create(null);
            if (o.r(r), Object.defineProperty(r, "default", {
                enumerable: !0,
                value: e
            }), 2 & t && "string" != typeof e) for (var a in e) o.d(r, a, function (t) {
                return e[t]
            }.bind(null, a));
            return r
        }, o.n = function (e) {
            var t = e && e.__esModule ? function () {
                return e.default
            } : function () {
                return e
            };
            return o.d(t, "a", t), t
        }, o.o = function (e, t) {
            return Object.prototype.hasOwnProperty.call(e, t)
        }, o.p = "", o(o.s = 0)
    }([function (e, t, o) {
        e.exports = o(1)
    }, function (e, t, o) {
        "use strict";
        Object.defineProperty(t, "__esModule", {value: !0}), t.default = void 0;
        var r = {
            h: {
                locale: "en-US",
                common: {
                    cancel: "Отменить",
                    confirm: "OK",
                    clear: "Очистить",
                    nullOptionText: "выберите...",
                    empty: "empty",
                    any: "any"
                },
                confirm: {title: "Подтверждение"},
                checkbox: {limitSize: "Ваш лимит: {limitSize}"},
                select: {
                    nullOptionText: "выберите...",
                    placeholder: "выберите...",
                    emptyContent: "Ничего не найдено",
                    searchPlaceHolder: "поиск",
                    limitSize: "Ваш лимит: {limitSize} ."
                },
                category: {placeholder: "Выбрать"},
                cascader: {placeholder: "Выбрать"},
                categoryModal: {
                    limitWords: "Ваш лимит: {size} ",
                    emptyContent: "Ничего не найдено",
                    total: "Все варианты"
                },
                categoryPicker: {
                    nullOptionText: "Выбрать",
                    placeholder: "Выбрать",
                    total: "Все варианты",
                    limitSize: "Ваш лимит: {0} "
                },
                autoComplate: {placeholder: "Вводите текст...", emptyContent: "Ничего не найдено"},
                validation: {
                    base: {
                        required: " can not be empty",
                        maxLen: " text length can't exceed {value} bits",
                        minLen: " text length can't be less than {value} bits",
                        max: " no more than {value}",
                        min: " can't be less than {value}"
                    },
                    type: {
                        int: " is not the correct integer format",
                        number: " is not the correct digital format",
                        email: " is not the correct mailbox format",
                        url: " is not the correct URL format",
                        tel: " is not the correct phone number format",
                        mobile: " is not the correct mobile number format",
                        globalmobile: " is not the correct international mobile number format"
                    }
                },
                date: {
                    today: "Сегодня",
                    yesterday: "Вчера",
                    year: "год",
                    month: "месяц",
                    week: "неделя",
                    quarter: "квартал",
                    day: "день",
                    header: {year: "", month: "", day: ""},
                    show: {
                        week: "{year} {weeknum}я неделя {daystart} - {dayend}",
                        weekInput: "{year} {week}я неделя",
                        quarter: "{year} {quarter}й квартал"
                    },
                    months: {
                        january: "Январь",
                        february: "Февраль",
                        march: "Март",
                        april: "Апрель",
                        may: "Май",
                        june: "Июнь",
                        july: "Июль",
                        august: "Август",
                        september: "Сентябрь",
                        october: "Октябрь",
                        november: "Ноябрь",
                        december: "Декабрь"
                    },
                    weeks: {
                        monday: "Пн",
                        tuesday: "Вт",
                        wednesday: "Ср",
                        thursday: "Чт",
                        friday: "Пт",
                        saturday: "Сб",
                        sunday: "Вс"
                    }
                },
                datepicker: {
                    placeholder: "Выбор даты",
                    startTime: "старт",
                    endTime: "финиш",
                    customize: "период",
                    start: "начало",
                    end: "конец"
                },
                wordlimit: {warn: "You are limited to enter {0} words"},
                wordcount: {warn: "You have exceeded {0} words"},
                treepicker: {selectDesc: "You have selected {0} items", placeholder: "please select"},
                search: {placeholder: "search...", searchText: "Search"},
                taginput: {limitWords: "You have exceeded the limit"},
                table: {empty: "No results found"},
                uploader: {upload: "Upload", reUpload: "ReUpload"},
                pagination: {
                    incorrectFormat: "The format of the value you entered is incorrect",
                    overSize: "The value you entered exceeds the range",
                    totalBefore: "Total",
                    totalAfter: "items",
                    sizeOfPage: "{size} items/page"
                }
            }
        };
        t.default = r
    }]).default
});
