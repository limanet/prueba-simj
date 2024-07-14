@props( [
    'user'
] )
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>SIMJ {{ isset( $title ) ? ' - ' . $title : '' }}</title>

    @vite( [ 'resources/scss/app.scss' ] )
    @stack( 'css' )
</head>
<body>
    <aside class="app-menu">
        <header class="app-menu__header">
            <div class="app-menu__logo">
                <img src="{{ asset( 'images/logo.png' ) }}" alt="Logo">
            </div>
        </header>

        <section class="app-menu__name">
            {{ $user->name }}
        </section>

        <section class="app-menu__logout">
            <a href="{{ route( 'logout' ) }}">
                <span>Salir</span> <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        </section>

        <div class="app-menu__content">
            <x-menu-item
                icon="fa-regular fa-user"
                title="Usuarios"
                route="{{ route( 'users.index' ) }}"
                :active="Route::is( 'users*' )"
            >
            </x-menu-item>
            <x-menu-item
                icon="fa-regular fa-calendar"
                title="Festivos"
                route="{{ route( 'calendar.index' ) }}"
                :active="Route::is( 'calendar*' )"
            ></x-menu-item>
        </div>
    </aside>

    <main class="app-content container-fluid">
        <header class="app-content__section">
            {{ $section }}
        </header>

        {{ $slot }}
    </main>

    @vite( [ 'resources/js/app.js' ] )
    @stack( 'js' )
</body>
</html>
