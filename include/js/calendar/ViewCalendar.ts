abstract class ViewCalendar{
    private contentDiv : HTMLDivElement;


    constructor(contentDiv: HTMLDivElement) {
        this.contentDiv = contentDiv;
    }
    protected abstract loadEvents(): Promise<Array<Event>>;

    public prepare(){
        this.loadEvents().then((events:Array<Event>) => {
            $(this.contentDiv).fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listWeek'
                },
                selectable:true,
                navLinks: true,
                editable: true,
                eventLimit: true,
                events:events,
                locale:'fr',
                select: (start, end) => {this.onSelect(start, end);},
                eventDrop : (event, delta, revertFunc, jsEvent, ui, view) => { this.onEventDrop(event, delta, revertFunc, jsEvent, ui, view); },
                eventResize: (event, delta, revertFunc, jsEvent, ui, view) => { this.onEventResize(event, delta, revertFunc, jsEvent, ui, view); },
                eventClick : ( event, jsEvent, view ) => {this.onEventClick(event, jsEvent, view);}
            });
        }).catch((result) => {
            console.log("Une erreur est survenue lors du chargement des informations pour le calendrier");
            console.log(result);
        });
    }
    public getContentDiv() : HTMLDivElement{
        return this.contentDiv;
    }
    protected  onEventDrop(event: any, delta: any, revertFunc: any, jsEvent: any, ui: any, view: any){
        revertFunc();
    }
    protected onEventResize(event: any, delta: any, revertFunc: any, jsEvent: any, ui: any, view: any){
        revertFunc();
    }
    protected abstract onEventClick(event: any, jsEvent: any, view: any);
    protected abstract onSelect(start: any, end: any);
}