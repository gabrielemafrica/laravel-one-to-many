@extends('layouts.app')

@section('content')
    <main class="container text-center py-5">
        <h1>modifica</h1>

        <form method="POST" action="{{ route('logged.update', $project->id) }}" class="w-50 mx-auto">

            @csrf
            @method('PUT')

            <div class="form-group my-3">
                <input type="text" name="nome" id="nome" class="form-control" value="{{ $project->nome }}">
            </div>

            <div class="form-group my-3">
                <textarea rows="4" name="descrizione" id="descrizione" class="form-control">{{ $project->descrizione }}</textarea>
            </div>

            <div class="form-group my-3">
                <input type="text" name="tecnology" id="tecnology" class="form-control"
                    value="{{ $project->tecnology }}">
            </div>

            <div class="form-group my-3">
                <input type="text" name="link" id="link" class="form-control" value="{{ $project->link }}">
            </div>

            <div class="form-group my-3">
                <input type="text" name="repo" id="repo" class="form-control" value="{{ $project->repo }}">
            </div>

            <div class="form-group my-3">
                <input type="date" name="data" id="data" class="form-control" value="{{ $project->data }}">
            </div>

            <div class="form-group my-3">
                <select name="type_id" id="type_id" class="form-select">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id == $project->type_id ? 'selected' : '' }}>
                            {{ $type->type }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group my-3">
                <input type="submit" value="MODIFICA" class="btn btn-primary">
            </div>
        </form>
    </main>
@endsection
