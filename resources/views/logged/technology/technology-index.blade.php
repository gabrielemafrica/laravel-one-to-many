@extends('dashboard')

@section('dashboard-content')
    <h1>index technologies</h1>
    <a href="{{ route('logged.create') }}" class="btn btn-primary mb-4">NEW TECHNOLOGIY</a>
    <div class="row">
        @foreach ($technologies as $technology)
            <div class="col-3 mb-4">
                <div class="card text-center">
                    <div class="card-header">
                        {{ $technology->name }}
                    </div>
                    <div class="card-body">
                        <a href="{{ route('logged.technologyShow', $technology->id) }}"
                            class="btn btn-info text-light">SHOW</a>
                        <a href="{{ route('logged.edit', $technology->id) }}" class="btn btn-warning text-light">EDIT</a>
                        <form class="d-inline" method="POST" action="{{ route('logged.delete', $technology->id) }}"
                            onsubmit=" return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="DELETE">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
