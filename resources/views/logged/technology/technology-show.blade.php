@extends('dashboard')

@section('dashboard-content')
    <h1>show technology</h1>
    <a href="{{ route('logged.create') }}" class="btn btn-primary mb-4">NEW TECHNOLOGIY</a>
    <div class="card border-dark mb-3 mx-auto" style="max-width: 18rem;">
        <div class="card-header">{{ $technology->name }}</div>
        <div class="card-body">
            <h5 class="card-title"> projects: {{ count($technology->projects) }}</h5>
            <ol>
                @foreach ($technology->projects as $project)
                    <li>
                        <a href="{{ route('logged.show', $project->id) }}">{{ $project->nome }}</a>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
    <div class="container text-center">
        <a href="{{ route('logged.technologyIndex') }}" class="btn btn-info text-light">ALL</a>
        <a href="{{ route('logged.edit', $project->id) }}" class="btn btn-warning text-light">EDIT</a>
        <a href="{{ route('logged.create') }}" class="btn btn-primary text-light">NEW</a>
        <form class="d-inline" method="POST" action="{{ route('logged.delete', $project->id) }}"
            onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" type="submit" value="DELETE">
        </form>
    </div>
@endsection
