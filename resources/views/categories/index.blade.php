@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">

    <h1>Alkohol kategóriák</h1>

    <a href="{{ route('categories.create') }}"
       class="btn btn-primary">
        Új kategória
    </a>

</div>


<form method="GET"
      action="{{ route('categories.index') }}"
      class="mb-3">

    <div class="row">

        <div class="col-md-8">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Kategória keresése..."
                   value="{{ request('search') }}">

        </div>

        <div class="col-md-4">

            <button class="btn btn-success">
                Keresés
            </button>

            <a href="{{ route('categories.index') }}"
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
            <th>Kategória neve</th>
            <th>Műveletek</th>
        </tr>

    </thead>

    <tbody>

    @foreach($categories as $category)

        <tr>

            <td>
                {{ $category->id }}
            </td>

            <td>
                {{ $category->name }}
            </td>

            <td>

                <a href="{{ route('categories.show', $category) }}"
                   class="btn btn-info btn-sm">
                    Részletek
                </a>

                <a href="{{ route('categories.edit', $category) }}"
                   class="btn btn-warning btn-sm">
                    Szerkesztés
                </a>


                <form action="{{ route('categories.destroy', $category) }}"
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