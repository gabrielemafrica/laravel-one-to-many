@extends('dashboard')

@section('dashboard-content')
    <h1>edit type</h1>
    <div class="card border-dark mb-3 mx-auto" style="max-width: 18rem;">
        <div class="card-header">MODIFICA</div>
        <div class="card-body">
            <form method="POST" action="{{ route('logged.typeUpdate', $type->id) }}" class="mx-auto">

                @csrf
                @method('PUT')

                <div class="form-group my-3">
                    <input type="text" name="type" id="type" class="form-control" value="{{ $type->type }}">
                </div>


                <div class="form-group my-3">
                    <input type="submit" value="APPLICA" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <div class="container text-center">
        <a href="{{ route('logged.typeIndex') }}" class="btn btn-info text-light">INDIETRO</a>
    </div>
@endsection
