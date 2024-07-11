<x-app-layout :user="$user">
    <x-slot name="title">Días festivos</x-slot>
    <x-slot name="section">Días festivos</x-slot>

    <section id="calendar" class="mt-5" style="background-color: #fff;"></section>

    <hr>

    <section class="text-center mb-3">
        <a href="{{ route( 'calendar.festivos' ) }}" class="btn btn-primary btn-sm">
            <i class="fa-regular fa-calendar-days"></i><br> Gestionar días festivos
        </a>
    </section>

    @push('js')
        @vite( [ 'resources/js/calendar.js' ] )
    @endpush
</x-app-layout>
