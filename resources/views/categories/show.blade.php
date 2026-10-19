@extends('layouts.app')

@section('content')

<h1>Kategória</h1>

<p>
    <strong>Név:</strong>
    {{ $category->name }}
</p>

<a href="{{ route('categories.index') }}"
   class="btn btn-secondary">
    Vissza
</a>

@endsection