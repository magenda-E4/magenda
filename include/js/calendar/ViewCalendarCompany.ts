class ViewCalendarCompany extends ViewCalendar{

    protected onSelect(start: Moment, end: Moment) {
        let url = "?controller=event&action=addEvent&api=1";
        let dataContent = "idcompany="+this.idcompany+"&start="+encodeURI(start.format("Y-m-d H:m:s"))+"&end="+encodeURI(end.format("Y-m-d H:m:s"));
        $.ajax({
            type: "POST",
            url: url,
            data: dataContent,
            success: (result) => {
                if(result.success){
                    this.prepare();
                }
            },
            dataType: "json"
        });
    }
    protected onEventClick(event: any, jsEvent: any, view: any) {
        if(event.user_id > 0 && event.backgroundColor == "green"){
            let url = "?controller=event&action=setNotMeOn&api=1";
            let dataContent = "idevent="+event.id;
            $.ajax({
                type: "POST",
                url: url,
                data: dataContent,
                success: (result) => {
                    if(result.success){
                        event.title = "Disponible";
                        event.user_id = null;
                        event.backgroundColor = "#337ab7";
                        $(this.getContentDiv()).fullCalendar( 'renderEvent', event);
                    }
                },
                dataType: "json"
            });
        }else if(!(event.user_id > 0)){
            let url = "?controller=event&action=setMeOn&api=1";
            let dataContent = "idevent="+event.id;
            $.ajax({
                type: "POST",
                url: url,
                data: dataContent,
                success: (result) => {
                    if(result.success){
                        event.title = "Réservé par vous";
                        event.user_id = result.user_id;
                        event.backgroundColor = "green";
                        $(this.getContentDiv()).fullCalendar( 'renderEvent', event);
                    }
                },
                dataType: "json"
            });
        }
    }

    protected onEventDrop(event: any, delta: any, revertFunc: any, jsEvent: any, ui: any, view: any) {
        let data = delta._data;
        let deltaInMinute = data.minutes + (
            data.hours + (
            (data.days + (
                    data.months * 31
                )
            ) * 24)) * 60;
        let url = "?controller=event&action=updateStartDate&api=1";
        let dataContent = "idevent="+event.id+"&minutes="+deltaInMinute;
        $.ajax({
            type: "POST",
            url: url,
            data: dataContent,
            success: (result) => {
                if(!result.success) revertFunc();
            },
            dataType: "json"
        });
    }
    protected onEventResize(event: any, delta: any, revertFunc: any, jsEvent: any, ui: any, view: any) {
        let data = delta._data;
        let deltaInMinute = data.minutes + (
            data.hours + (
            (data.days + (
                    data.months * 31
                )
            ) * 24)) * 60;
        let url = "?controller=event&action=updateEndDate&api=1";
        let dataContent = "idevent="+event.id+"&minutes="+deltaInMinute;
        $.ajax({
            type: "POST",
            url: url,
            data: dataContent,
            success: (result) => {
                if(!result.success) revertFunc();
            },
            dataType: "json"
        });
    }




    private idcompany : number;

    constructor(contentDiv: HTMLDivElement, idcompany: number) {
        super(contentDiv);
        this.idcompany = idcompany;
    }
    protected loadEvents(): Promise<Array<Event>> {
        return new Promise<Array<Event>>((resolve : Function, reject : Function) => {
            let url = "?controller=event&action=selectAll&api=1";
            let data = "idcompany="+this.idcompany;
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
interface Event{
    id : number,
    startdatetime: string,
    enddatetime: string,
    company_id: number,
    price: number,
    user_id?: number,
    promotion: number,
}