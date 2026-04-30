<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // === AÑADE ESTO ===
    public function __construct()
    {
        $this->middleware('auth');
    }
    // ==================

    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    // 2. MOSTRAR FORMULARIO DE CREAR
    public function create()
    {
        return view('productos.create');
    }

    // 3. GUARDAR NUEVO PRODUCTO
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado');
    }

    // 4. MOSTRAR FORMULARIO DE EDICIÓN
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', compact('producto'));
    }

    // 5. ACTUALIZAR (UPDATE) EN LA BASE DE DATOS
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado');
    }

    // 6. ELIMINAR (DESTROY)
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado');
    }
}