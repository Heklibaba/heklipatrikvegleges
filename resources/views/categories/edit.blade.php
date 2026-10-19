@extends('layouts.app')

@section('content')

<h1>Kategória szerkesztése</h1>

<form method="POST"
      action="{{ route('categories.update', $category) }}">

    @csrf
    @method('PUT')

    <div class="mb-3">

        <label class="form-label">
            Kategória neve
        </label>

        <input type="text"
               name="name"
               class="form-control"
               value="{{ $category->name }}">

    </div>


    <button class="btn btn-success">
        Mentés
    </button>

    <a href="{{ route('categories.index') }}"
       class="btn btn-secondary">
        Vissza
    </a>

</form>

@endsection