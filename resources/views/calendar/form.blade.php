<x-app-layout :user="$user">
    <x-slot name="title">Festivos - {{ ( isset( $id_festivo ) ) ? 'Editar' : 'Nuevo' }} festivo</x-slot>
    <x-slot name="section">Festivos - {{ ( isset( $id_festivo ) ) ? 'Editar' : 'Nuevo' }} festivo</x-slot>

    <form method="post" action="{{ url()->current() }}" class="mt-5 col-6">
        @csrf

        @isset( $id_festivo )
            <input type="hidden" name="id_festivo" value="{{ $id_festivo }}">
        @endisset

        <div class="form-group mb-3">
            <label for="name" class="mb-1">Nombre*</label>
            <input
                type="text"
                name="name"
                id="name"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has( 'name' ),
                ])
                value="{{ old('name', $festivo->name ?? null) }}"
            >
            @error('name')
                <div class="mt-1" style="font-size: .85em; color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="">Fecha*</label>
            <input
                type="date"
                name="date"
                id="date"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has( 'date' ),
                ])
                value="{{ old('date', $date ?? null) }}"
            >
            @error('date')
                <div class="mt-1" style="font-size: .85em; color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="color">Color*</label>
            <input
                type="color"
                name="color"
                id="color"
                @class([
                    'form-control',
                    'is-invalid' => $errors->has( 'color' ),
                ])
                value="{{ old('color', $festivo->color ?? null) }}"
            >
            @error('color')
                <div class="mt-1" style="color: red; font-size: .85em;">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <input type="checkbox" name="recurrent" id="recurrent" value="recurrent" @checked(old('recurrent', $festivo->recurrent ?? null))>
            <label for="recurrent">Se repite todos los años</label>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-sm btn-outline-primary">Guardar</button>
            <a href="{{ route( 'calendar.festivos' ) }}" class="btn btn-sm btn-outline-secondary">Cancelar</a>
        </div>
    </form>
</x-app-layout>
