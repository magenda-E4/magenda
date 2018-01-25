var ViewCalendar = /** @class */ (function () {
    function ViewCalendar(contentDiv) {
        this.contentDiv = contentDiv;
    }
    ViewCalendar.prototype.prepare = function () {
        var _this = this;
        this.loadEvents().then(function (events) {
            $(_this.contentDiv).fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                selectable: true,
                navLinks: true,
                editable: true,
                eventLimit: true,
                events: events,
                locale: 'fr',
                select: function (start, end) { _this.onSelect(start, end); },
                eventDrop: function (event, delta, revertFunc, jsEvent, ui, view) { _this.onEventDrop(event, delta, revertFunc, jsEvent, ui, view); },
                eventResize: function (event, delta, revertFunc, jsEvent, ui, view) { _this.onEventResize(event, delta, revertFunc, jsEvent, ui, view); },
                eventClick: function (event, jsEvent, view) { _this.onEventClick(event, jsEvent, view); }
            });
        }).catch(function (result) {
            console.log("Une erreur est survenue lors du chargement des informations pour le calendrier");
            console.log(result);
        });
    };
    ViewCalendar.prototype.getContentDiv = function () {
        return this.contentDiv;
    };
    ViewCalendar.prototype.onEventDrop = function (event, delta, revertFunc, jsEvent, ui, view) {
        revertFunc();
    };
    ViewCalendar.prototype.onEventResize = function (event, delta, revertFunc, jsEvent, ui, view) {
        revertFunc();
    };
    return ViewCalendar;
}());
