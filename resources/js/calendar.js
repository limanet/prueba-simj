import Calendar from "js-year-calendar";
import "js-year-calendar/locales/js-year-calendar.es.js";
import "js-year-calendar/dist/js-year-calendar.css"



// Función para obtener el año actual
const getCurrentYear = () => {
    let date = new Date();
    return date.getFullYear();
};


// Función para obtener los días festivos
async function getFestivos() {
    let call = await fetch('/ajax/calendar');
    let recived_days = await call.text();
    let days = JSON.parse(recived_days);

    let events = setEvents( days );
    calendar.setDataSource( events );
}

// Función para la creación de los eventos
function setEvents( days ) {
    let events = [];

    if (days.length > 0) {
        for( let i = 0; i < days.length; i++ ) {
            if ( ! days[i].recurrent ) { // El evento no se repite de forma anual
                let event = {
                    id: days[i].id_calendar,
                    startDate: new Date( days[i].year, days[i].month - 1, days[i].day ),
                    endDate: new Date( days[i].year, days[i].month - 1, days[i].day ),
                    color: days[i].color,
                    name: days[i].name,
                };

                events.push( event );
            } else { // El evento se repite anualmente
                let year = days[i].year;
                let end_year = year + 50;
                for (let j = 0; j < end_year; j++) { // Como el comando de frecuencia no funciona, hacemos q se repita el evento durante 50 años para que dé la sensación de que se repite anualmente
                    let event = {
                        id: days[i].id_calendar,
                        startDate: new Date( year, days[i].month - 1, days[i].day ),
                        endDate: new Date( year, days[i].month - 1, days[i].day ),
                        color: days[i].color,
                        name: days[i].name,
                    };

                    events.push( event );
                    year++;
                }
            }
        }
    }

    return events;
}

// Obtenemos los días festivos
const events = getFestivos();

// Inicializamos el calendario
const calendar = new Calendar('#calendar',{
    style: 'background',
    language: 'es',
    dataSource: events,
    minDate: new Date( getCurrentYear(), 0, 1 ),
    mouseOnDay: function (e) {
        if (e.events.length > 0) {
            let content = '';

            for( let i = 0; i < e.events.length; i++ ) {
                content += '<div>' + e.events[i].name + '</div>'
            }

            $(e.element).popover({
                trigger: 'manual',
                container: 'body',
                html:true,
                content: content
            });

            $(e.element).popover('show');
        }
    },
    mouseOutDay: function (e) {
        if (e.events.length > 0) {
            $(e.element).popover('hide');
        }
    },
});
