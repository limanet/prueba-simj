<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public $user;

    public function __construct() {
        $this->user = Auth::user();
    }

    /**
     * Método para mostrar el calendario
     */
    public function index() {
        return view( 'calendar.index', [ 'user' => $this->user ] );
    }

    /*
     * Método que muestra el listado de los días festivos creados
     */
    public function FestivosList()
    {
        $festivos = Calendar::orderBy( 'year', 'ASC' )->orderBy( 'month', 'ASC' )->orderBy( 'day', 'ASC' )->paginate(25);


        return view( 'calendar.list', [
            'user'     => $this->user,
            'festivos' => $festivos,
        ] );
    }

    /*
     * Método que muestra el formulario para crear un nuevo día festivo
     */
    public function newFestivo()
    {
        return view( 'calendar.form', [ 'user' => $this->user ] );
    }

    /*
     * Método para mostrar el formulario para editar un día festivo
     */
    public function editFestivo( Request $request )
    {
        $id_festivo = $request->id_festivo;

        // Cargamos los datos del festivo que recibimos como parámetro
        $festivo = Calendar::find( $id_festivo );

        if ( $festivo ) {
            // Si el festivo existe, mostramos el formulario para editarlo
            $date = $festivo->year . '-' . ( ($festivo->month < 10) ? '0' : '' ) . $festivo->month . '-' . ( ($festivo->day < 10) ? '0' : '' ) . $festivo->day;

            //dd($date);

            return view( 'calendar.form', [
                'user'       => $this->user,
                'id_festivo' => $id_festivo,
                'festivo'    => $festivo,
                'date'       => $date,
            ] );
        } else {
            // Si no existe el festivo, regresamos al listado de festivos
            return redirect()->route( 'calendar.festivos' );
        }
    }

    /*
     * Método que guarda los datos del día festivo
     */
    public function storeFestivo(Request $request)
    {
        // Validamos el formulario
        $request->validate( [
            'name'  => 'required',
            'date'  => 'required',
            'color' => 'required|hex_color'
        ], [
            'name.required'   => 'Por favor, indique el nombre festivo.',
            'date.required'   => 'Por favor, indique la fecha del festivo.',
            'color.required'  => 'Por favor, indique el color.',
            'color.hex_color' => 'Por favor, indique un color válido.'
        ] );

        // Descomponemos la fecha
        list( $year, $month, $day ) = explode( '-', $request->date );

        // Guardamos el festivo en la base de datos
        $festivo            = ( $request->has( 'id_festivo' ) ) ? Calendar::find( $request->id_festivo ) : new Calendar;
        $festivo->name      = $request->name;
        $festivo->year      = $year;
        $festivo->month     = $month;
        $festivo->day       = $day;
        $festivo->color     = $request->color;
        $festivo->recurrent = ( $request->has( 'recurrent' ) ) ? 1 : 0;
        $festivo->save();

        // Volvemos al listado de días festivos
        return redirect()->route( 'calendar.festivos' );
    }

    /*
     * Método para borrar un día festivo
     */
    public function deleteFestivo( Request $request ) {
        Calendar::where( 'id_calendar', $request->id_festivo )->delete();
        return redirect()->back();
    }


    public function ajaxCalendar( Request $request )
    {
        $calendar = Calendar::get();

        return response()->json( $calendar );
    }
}
