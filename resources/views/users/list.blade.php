<x-app-layout :user="$user">
    <x-slot name="title">Usuarios</x-slot>
    <x-slot name="section">Usuarios</x-slot>

    <div class="buttons py-3 text-end">
        <a href="{{ route( 'users.create' ) }}" class="btn btn-primary" title="Nuevo usuario">
            <i class="fa-solid fa-user-plus"></i>
        </a>
    </div>

    <div class="list pb-3">
        @if( $users->isEmpty() )
            <em>No existen usuarios en la base de datos</em>
        @else
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>E-mail</th>
                        <th width="125px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $users as $user )
                        <tr style="vertical-align: middle;">
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td style="text-align:right;">
                                <a href="{{ route( 'users.edit', [ 'user_id' => $user->id ] ) }}" title="Editar"><i class="fa-solid fa-user-pen"></i></a>&nbsp;
                                <i class="fa-solid fa-user-minus delete-user" title="Borrar" onclick="deleteUser({{ $user->id }}, '{{ $user->name }}')"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="col-12 mt-2">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    @push( 'js' )
        <script>
            function deleteUser(id, name) {
                let del = confirm('¿realmente desea borrar el usuario ' + name + '?');
                if (del) {
                    location.href = '/users/' + id + '/delete';
                }
            }
        </script>
    @endpush
</x-app-layout>
