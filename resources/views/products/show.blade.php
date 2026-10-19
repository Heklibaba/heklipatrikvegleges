@extends('layouts.app')

@section('content')

<h1>Termék adatai</h1>

<p>
    <strong>Név:</strong>
    {{ $product->name }}
</p>

<p>
    <strong>Kategória:</strong>
    {{ $product->category->name }}
</p>

<p>
    <strong>Alkoholtartalom:</strong>
    {{ $product->alcohol_percent }}%
</p>

<p>
    <strong>Ár:</strong>
    {{ $product->price }} Ft
</p>

<a href="{{ route('products.index') }}"
   class="btn btn-secondary">
    Vissza
</a>

@endsection