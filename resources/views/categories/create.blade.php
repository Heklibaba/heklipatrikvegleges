@extends('layouts.app')

@section('content')

<h1>Új kategória</h1>

<form method="POST"
      action="{{ route('categories.store') }}">

    @csrf

    <div class="mb-3">

        <label class="form-label">
            Kategória neve
        </label>

        <input type="text"
       name="name"
       class="form-control"
       value="{{ old('name') }}">

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