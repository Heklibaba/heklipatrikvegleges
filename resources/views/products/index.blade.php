@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h1>Termékek</h1>

    <a href="{{ route('products.create') }}"
       class="btn btn-primary">

        Új termék

    </a>

</div>


<form method="GET"
      action="{{ route('products.index') }}"
      class="mb-4">

    <div class="row">

        <div class="col-md-5">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Termék keresése..."
                   value="{{ request('search') }}">

        </div>


        <div class="col-md-4">

            <select name="category_id"
                    class="form-select">

                <option value="">
                    Összes kategória
                </option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}"
                        {{ request('category_id') == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

        </div>


        <div class="col-md-3">

            <button class="btn btn-success">
                Keresés
            </button>

            <a href="{{ route('products.index') }}"
               class="btn btn-secondary">

                Törlés

            </a>

        </div>

    </div>

</form>


<table class="table table-striped table-bordered">

    <thead class="table-dark">

        <tr>

            <th>ID</th>
            <th>Név</th>
            <th>Kategória</th>
            <th>Alkoholtartalom</th>
            <th>Ár</th>
            <th>Műveletek</th>

        </tr>

    </thead>

    <tbody>

    @foreach($products as $product)

        <tr>

            <td>
                {{ $product->id }}
            </td>

            <td>
                {{ $product->name }}
            </td>

            <td>
                {{ $product->category->name }}
            </td>

            <td>
                {{ $product->alcohol_percent }}%
            </td>

            <td>
                {{ $product->price }} Ft
            </td>

            <td>

                <a href="{{ route('products.show', $product) }}"
                   class="btn btn-info btn-sm">
                    Részletek
                </a>

                <a href="{{ route('products.edit', $product) }}"
                   class="btn btn-warning btn-sm">

                    Szerkesztés

                </a>


                <form action="{{ route('products.destroy', $product) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Biztosan törlöd?')">

                        Törlés

                    </button>

                </form>

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@endsection