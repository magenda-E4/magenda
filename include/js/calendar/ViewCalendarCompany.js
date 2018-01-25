var __extends = (this && this.__extends) || (function () {
    var extendStatics = Object.setPrototypeOf ||
        ({ __proto__: [] } instanceof Array && function (d, b) { d.__proto__ = b; }) ||
        function (d, b) { for (var p in b) if (b.hasOwnProperty(p)) d[p] = b[p]; };
    return function (d, b) {
        extendStatics(d, b);
        function __() { this.constructor = d; }
        d.prototype = b === null ? Object.create(b) : (__.prototype = b.prototype, new __());
    };
})();
var ViewCalendarCompany = /** @class */ (function (_super) {
    __extends(ViewCalendarCompany, _super);
    function ViewCalendarCompany(contentDiv, idcompany) {
        var _this = _super.call(this, contentDiv) || this;
        _this.idcompany = idcompany;
        return _this;
    }
    ViewCalendarCompany.prototype.onSelect = function (start, end) {
        var _this = this;
        var url = "?controller=event&action=addEvent&api=1";
        var dataContent = "idcompany=" + this.idcompany + "&start=" + encodeURI(start.format("Y-m-d H:m:s")) + "&end=" + encodeURI(end.format("Y-m-d H:m:s"));
        $.ajax({
            type: "POST",
            url: url,
            data: dataContent,
            success: function (result) {
                if (result.success) {
                    _this.prepare();
                }
            },
            dataType: "json"
        });
    };
    ViewCalendarCompany.prototype.onEventClick = function (event, jsEvent, view) {
        var _this = this;
        if (event.user_id > 0 && event.backgroundColor == "green") {
            var url = "?controller=event&action=setNotMeOn&api=1";
            var dataContent = "idevent=" + event.id;
            $.ajax({
                type: "POST",
                url: url,
                data: dataContent,
                success: function (result) {
                    if (result.success) {
                        event.title = "Disponible";
                        event.user_id = null;
                        event.backgroundColor = "#337ab7";
                        $(_this.getContentDiv()).fullCalendar('renderEvent', event);
                    }
                },
                dataType: "json"
            });
        }
        else if (!(event.user_id > 0)) {
            var url = "?controller=event&action=setMeOn&api=1";
            var dataContent = "idevent=" + event.id;
            $.ajax({
                type: "POST",
                url: url,
                data: dataContent,
                success: function (result) {
                    if (result.success) {
                        event.title = "Réservé par vous";
                        event.user_id = result.user_id;
                        event.backgroundColor = "green";
                        $(_this.getContentDiv()).fullCalendar('renderEvent', event);
                    }
                },
                dataType: "json"
            });
        }
    };
    ViewCalendarCompany.prototype.onEventDrop = function (event, delta, revertFunc, jsEvent, ui, view) {
        var data = delta._data;
        var deltaInMinute = data.minutes + (data.hours + ((data.days + (data.months * 31)) * 24)) * 60;
        var url = "?controller=event&action=updateStartDate&api=1";
        var dataContent = "idevent=" + event.id + "&minutes=" + deltaInMinute;
        $.ajax({
            type: "POST",
            url: url,
            data: dataContent,
            success: function (result) {
                if (!result.success)
                    revertFunc();
            },
            dataType: "json"
        });
    };
    ViewCalendarCompany.prototype.onEventResize = function (event, delta, revertFunc, jsEvent, ui, view) {
        var data = delta._data;
        var deltaInMinute = data.minutes + (data.hours + ((data.days + (data.months * 31)) * 24)) * 60;
        var url = "?controller=event&action=updateEndDate&api=1";
        var dataContent = "idevent=" + event.id + "&minutes=" + deltaInMinute;
        $.ajax({
            type: "POST",
            url: url,
            data: dataContent,
            success: function (result) {
                if (!result.success)
                    revertFunc();
            },
            dataType: "json"
        });
    };
    ViewCalendarCompany.prototype.loadEvents = function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            var url = "?controller=event&action=selectAll&api=1";
            var data = "idcompany=" + _this.idcompany;
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function (result) { resolve(result); },
                error: function (result) { reject(result); },
                dataType: "json"
            });
        });
    };
    return ViewCalendarCompany;
}(ViewCalendar));
