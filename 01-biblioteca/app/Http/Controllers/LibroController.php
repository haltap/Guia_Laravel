<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::orderBy('id')->get();
        return view('libros.index', ['libros' => $libros]);
    }

    public function create()
    {
        return view('libros.create');
    }

    public function store(Request $request)
    {
        $anioActual = (int) date('Y');

        $datos = $request->validate([
            'codigo' => ['required', 'string', 'max:50', 'unique:libros,codigo'],
            'titulo' => ['required', 'string', 'max:150'],
            'autor' => ['required', 'string', 'max:100'],
            'anio_publicacion' => ['required', 'integer', 'min:1450', "max:{$anioActual}"],
        ]);

        $libro = new Libro();
        $libro->codigo = $datos['codigo'];
        $libro->titulo = $datos['titulo'];
        $libro->autor = $datos['autor'];
        $libro->anio_publicacion = $datos['anio_publicacion'];
        $libro->save();

        return redirect()->route('libros.index')
            ->with('exito', 'Libro registrado correctamente.');
    }

    public function edit(int $id)
    {
        $libro = Libro::findOrFail($id);
        return view('libros.edit', ['libro' => $libro]);
    }

    public function update(Request $request, int $id)
    {
        $libro = Libro::findOrFail($id);
        $anioActual = (int) date('Y');

        $datos = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:50',
                Rule::unique('libros', 'codigo')->ignore($libro),
            ],
            'titulo' => ['required', 'string', 'max:150'],
            'autor' => ['required', 'string', 'max:100'],
            'anio_publicacion' => ['required', 'integer', 'min:1450', "max:{$anioActual}"],
        ]);

        $libro->codigo = $datos['codigo'];
        $libro->titulo = $datos['titulo'];
        $libro->autor = $datos['autor'];
        $libro->anio_publicacion = $datos['anio_publicacion'];
        $libro->save();

        return redirect()->route('libros.index')
            ->with('exito', 'Libro actualizado correctamente.');
    }

    public function destroy(int $id)
    {
        $libro = Libro::findOrFail($id);
        $libro->delete();

        return redirect()->route('libros.index')
            ->with('exito', 'Libro eliminado correctamente.');
    }
}