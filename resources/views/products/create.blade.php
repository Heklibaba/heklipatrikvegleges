@extends('layouts.app')

@section('content')

<h1>Új termék</h1>

<form method="POST"
      action="{{ route('products.store') }}">

    @csrf


    <div class="mb-3">

        <label class="form-label">
            Termék neve
        </label>

        <input type="text"
               name="name"
               class="form-control">

    </div>


    <div class="mb-3">

        <label class="form-label">
            Kategória
        </label>

        <select name="category_id"
                class="form-select">

            @foreach($categories as $category)

                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>

            @endforeach

        </select>

    </div>


    <div class="mb-3">

        <label class="form-label">
            Alkoholtartalom (%)
        </label>

        <input type="number"
               step="0.1"
               name="alcohol_percent"
               class="form-control">

    </div>


    <div class="mb-3">

        <label class="form-label">
            Ár (Ft)
        </label>

        <input type="number"
               name="price"
               class="form-control">

    </div>


    <button class="btn btn-success">
        Mentés
    </button>

    <a href="{{ route('products.index') }}"
       class="btn btn-secondary">
        Vissza
    </a>

</form>

@endsection