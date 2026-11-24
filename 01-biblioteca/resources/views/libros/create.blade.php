@extends('layouts.app')

@section('contenido')
    <h1>Registrar Libro</h1>
    <form method="POST" action="{{ route('libros.store') }}">
        @csrf
        <label for="codigo">Código</label>
        <input id="codigo" name="codigo" type="text" maxlength="50" value="{{ old('codigo') }}" required>

        <label for="titulo">Título</label>
        <input id="titulo" name="titulo" type="text" maxlength="150" value="{{ old('titulo') }}" required>

        <label for="autor">Autor</label>
        <input id="autor" name="autor" type="text" maxlength="100" value="{{ old('autor') }}" required>

        <label for="anio_publicacion">Año de publicación</label>
        <input id="anio_publicacion" name="anio_publicacion" type="number" min="1450" max="{{ date('Y') }}" value="{{ old('anio_publicacion') }}" required>

        <br>
        <button type="submit">Guardar</button>
        <a href="{{ route('libros.index') }}">Cancelar</a>
    </form>
@endsection