<x-app-layout :user="$user">
    <x-slot name="title">Días festivos - Listado</x-slot>
    <x-slot name="section">Días festivos - Listado</x-slot>

    <section class="mt-5">
        <article class="mb-2 text-end">
            <a href="{{ route( 'calendar.festivos.create' ) }}" class="btn btn-primary"><i class="fa-regular fa-calendar-plus"></i><br> Nuevo festivo</a>
        </article>

        <hr>

        @if( $festivos->isEmpty() )
            <article class="text-center">
                <em>Aún no se han creado días festivos</em>
            </article>
        @else
            <article>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Día</th>
                        <th>Nombre</th>
                        <th>Color</th>
                        <th>Todos los años</th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach( $festivos as $festivo )
                        <tr>
                            <td>{{ ( $festivo->day < 10 ) ? '0' : '' }}{{ $festivo->day }}-{{ ( $festivo->month < 10 ) ? '0' : '' }}{{ $festivo->month }}-{{ $festivo->year }}</td>
                            <td>{{ $festivo->name }}</td>
                            <td style="vertical-align: middle;"><div class="d-inline-block" style="width: 10px; height: 10px; background-color:{{ $festivo->color }};"></div> {{ $festivo->color }}</td>
                            <td>{{ ( $festivo->recurrent == 1 ) ? 'Sí' : 'No' }}</td>
                            <td style="text-align: right">
                                <a href="{{ route( 'calendar.festivos.edit', [ 'id_festivo' => $festivo->id_calendar ] ) }}"><i class="fa-regular fa-pen-to-square" title="Editar día festivo"></i></a>
                                <i class="fa-regular fa-trash-can" style="cursor:pointer; color: red;" title="Borrar día festivo" onclick="deleteFestivo('{{ $festivo->name }}',{{ $festivo->id_calendar }})"></i>
                            </td>
                        </tr>
                    @endforeach
                </table>

                <div class="mt-1">
                    {{ $festivos->links() }}
                </div>
            </article>
        @endif

        <hr>

        <article class="text-center">
            <a href="{{ route( 'calendar.index' ) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-calendar"></i><br> Volver al calendario</a>
        </article>
    </section>

    @push('js')
        <script>
            function deleteFestivo(name, id) {
                let confirmar = confirm('¿realmente quieres borrar el festivo ' + name + '?');

                if(confirmar) {
                    location.href = "/calendar/festivos/" + id + "/delete";
                }
            }
        </script>
    @endpush
</x-app-layout>
