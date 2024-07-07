<x-app-layout :user="$logged_user">
    <x-slot name="title">Usuarios - {{ ( isset( $user_id ) ) ? 'Editar' : 'Nuevo' }} usuario</x-slot>
    <x-slot name="section">Usuarios - {{ ( isset( $user_id ) ) ? 'Editar' : 'Nuevo' }} usuario</x-slot>

    <section class="users-form py-3 col-6">
        <form method="post" action="">
            @csrf

            @isset( $user_id )
                <input type="hidden" name="user_id" value="{{ $user_id }}">
            @endisset

            <div class="form-gruop mb-3">
                <label for="name" class="mb-1">Nombre*</label>
                <input type="text"
                    name="name"
                    id="name"
                    @class( [
                        'form-control',
                        'is-invalid' => $errors->has( 'name' )
                    ] )
                    value="{{ old( 'name', $user->name ?? null ) }}"
                >
                @error('name')
                    <div class="mt-1" style="color: red; font-size: .85em;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="email" class="mb-1">E-mail*</label>
                <input type="email"
                    name="email"
                    id="email"
                    @class( [
                        'form-control',
                        'is-invalid' => $errors->has( 'email' )
                    ] )
                    value="{{ old( 'email', $user->email ?? null ) }}"
                >
                @error('email')
                    <div class="mt-1" style="color: red; font-size: .85em;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password" class="mb-1">Contraseña</label>
                <input type="password"
                    name="password"
                    id="password"
                    @class( [
                        'form-control',
                        'is-invalid' => $errors->has( 'password' )
                    ] )
                    value="{{ old( 'password' ) }}"
                >
                @error('password')
                    <div class="mt-1" style="color: red; font-size: .85em;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password_confirmation" class="mb-1">Confirmar contraseña</label>
                <input type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    @class( [
                        'form-control',
                        'is-invalid' => $errors->has( 'password_confirmation' )
                    ] )
                    value="{{ old( 'password_confirmation' ) }}"
                >
                @error('password_confirmation')
                    <div class="mt-1" style="color: red; font-size: .85em;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-outline-primary">
                    Aceptar
                </button>

                <a href="{{ route( 'users.index' ) }}" class="btn btn-outline-secondary">
                    Cancelar
                </a>
            </div>
        </form>
    </section>
</x-app-layout>
