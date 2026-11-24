<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo de Libros</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; color: #172033; }
        main { max-width: 960px; margin: auto; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input, select, textarea, button { padding: 8px; margin: 4px 0; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        .error { color: #a01818; }
        .exito { color: #14613e; font-weight: bold; }
        .acciones { display: flex; gap: 8px; align-items: center; }
    </style>
</head>
<body>
<main>
    @auth
        <p>Sesión de {{ auth()->user()->name }} ({{ auth()->user()->username }})</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Cerrar sesión</button>
        </form>
    @endauth

    @if (session('exito'))
        <p class="exito">{{ session('exito') }}</p>
    @endif

    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @yield('contenido')
</main>
</body>
</html>