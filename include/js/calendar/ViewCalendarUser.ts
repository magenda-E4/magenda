class ViewCalendarUser extends ViewCalendar{
    protected onSelect(start: any, end: any) {
    }
    protected onEventClick(event: any, jsEvent: any, view: any) {
        if (confirm("Êtes vous sur de vouloir annuler votre rendez-vous ?")) {
            let url = "?controller=event&action=setNotMeOn&api=1";
            let dataContent = "idevent="+event.id;
            $.ajax({
                type: "POST",
                url: url,
                data: dataContent,
                success: (result) => {
                    if(result.success){
                        $(this.getContentDiv()).fullCalendar( 'removeEvents', [event.id]);
                    }
                },
                dataType: "json"
            });
        }
    }
    private iduser : number;


    constructor(contentDiv: HTMLDivElement, iduser: number) {
        super(contentDiv);
        this.iduser = iduser;
    }
    protected loadEvents(): Promise<Array<Event>> {
        return new Promise<Array<Event>>((resolve : Function, reject : Function) => {
            let url = "?controller=event&action=selectAll&api=1";
            let data = "iduser="+this.iduser;
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: (result) => {resolve(result)},
                error: (result) => {reject(result)},
                dataType: "json"
            });
        });
    }
}