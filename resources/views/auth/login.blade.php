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

    <title>Soluciones Informáticas MJ</title>
    @vite( [ 'resources/scss/login.scss' ] )
</head>
<body>
    <main class="wrapper">
        <header class="logo">
            <img src="{{ asset( 'images/logo.png' ) }}" alt="Logo SIMJ">
        </header>

        <section class="login-form col-4">
            @error('failed')
                <div class="mb-2" style="color: red; font-size: .85em;">{{ $message }}</div>
            @enderror

            <form method="post" action="{{ route( 'login' ) }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old( 'email' ) }}">
                </div>

                <div class="form-group mb-3">
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" value="{{ old( 'password' ) }}">
                </div>

                <div class="form-group mb-3 align-items-center">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Recordarme</label>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-sm btn-primary">Entrar</button>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
