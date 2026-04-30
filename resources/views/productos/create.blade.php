@extends('layouts.app')
@section('content')
<div class="container">
    <h2>Agregar Producto</h2>
    <form action="{{ route('productos.store') }}" method="POST">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" class="form-control mb-2" required>
        <input type="number" name="precio" placeholder="Precio" class="form-control mb-2" required>
        <input type="number" name="stock" placeholder="Stock" class="form-control mb-2" required>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>
@endsection