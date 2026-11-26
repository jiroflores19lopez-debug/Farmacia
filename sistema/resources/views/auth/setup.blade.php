<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Configurar cuenta | FARM SJB</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>
<main class="login-wrapper d-flex align-items-center justify-content-center p-3">
    <section class="card border-0 shadow-sm login-card w-100">
        <div class="card-body p-4 p-md-5">
            <h1 class="h4 fw-bold">Configura tu farmacia</h1>
            <p class="text-secondary">Crea la primera cuenta administradora para comenzar.</p>
            @if ($errors->any())
                <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
            @endif
            <form action="{{ route('setup.store') }}" method="POST">
                @csrf
                <div class="mb-3"><label class="form-label" for="name">Nombre completo</label><input class="form-control" id="name" name="name" value="{{ old('name') }}" required maxlength="255"></div>
                <div class="mb-3"><label class="form-label" for="email">Correo electrónico</label><input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" required></div>
                <div class="mb-3"><label class="form-label" for="dni">DNI</label><input class="form-control" id="dni" name="dni" inputmode="numeric" pattern="[0-9]{8}" maxlength="8" value="{{ old('dni') }}" required></div>
                <div class="mb-3"><label class="form-label" for="password">Contraseña (mínimo 8 caracteres)</label><input class="form-control" id="password" name="password" type="password" autocomplete="new-password" required></div>
                <div class="mb-4"><label class="form-label" for="password_confirmation">Confirmar contraseña</label><input class="form-control" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required></div>
                <button class="btn btn-primary text-white w-100" type="submit">Crear cuenta y entrar</button>
            </form>
        </div>
    </section>
</main>
</body>
</html>
