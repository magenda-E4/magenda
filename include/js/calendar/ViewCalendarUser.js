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
var ViewCalendarUser = /** @class */ (function (_super) {
    __extends(ViewCalendarUser, _super);
    function ViewCalendarUser(contentDiv, iduser) {
        var _this = _super.call(this, contentDiv) || this;
        _this.iduser = iduser;
        return _this;
    }
    ViewCalendarUser.prototype.onSelect = function (start, end) {
    };
    ViewCalendarUser.prototype.onEventClick = function (event, jsEvent, view) {
        var _this = this;
        if (confirm("Êtes vous sur de vouloir annuler votre rendez-vous ?")) {
            var url = "?controller=event&action=setNotMeOn&api=1";
            var dataContent = "idevent=" + event.id;
            $.ajax({
                type: "POST",
                url: url,
                data: dataContent,
                success: function (result) {
                    if (result.success) {
                        $(_this.getContentDiv()).fullCalendar('removeEvents', [event.id]);
                    }
                },
                dataType: "json"
            });
        }
    };
    ViewCalendarUser.prototype.loadEvents = function () {
        var _this = this;
        return new Promise(function (resolve, reject) {
            var url = "?controller=event&action=selectAll&api=1";
            var data = "iduser=" + _this.iduser;
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
    return ViewCalendarUser;
}(ViewCalendar));
