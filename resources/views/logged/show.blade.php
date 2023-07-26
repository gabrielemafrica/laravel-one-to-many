@extends('layouts.app')

@section('content')
    <main class="container text-center py-5">

        <div class="card border-dark mb-3 mx-auto" style="max-width: 18rem;">
            <div class="card-header">{{ $project->nome }}</div>
            <div class="card-body">
                <h5 class="card-title"> descrizione: </h5>
                <p class="card-text">{{ $project->descrizione }}</p>
                <h5 class="card-title"> type: </h5>
                <p class="card-text">
                    <a href="{{ route('logged.typeShow', $project->type->id) }}">
                        {{ $project->type->type }}
                    </a>
                </p>
                <h5 class="card-title"> tecnology: {{ count($project->technology) }}</h5>
                <ul>
                    @foreach ($project->technology as $technology)
                        <li>
                            <a href="{{ route('logged.technologyShow', $technology->id) }}">
                                {{ $technology->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
                <p class="card-text">{{ $project->tecnology }}</p>
                <h5 class="card-title"> link: </h5>
                <p class="card-text">{{ $project->link }}</p>
                <h5 class="card-title"> repo: </h5>
                <p class="card-text">{{ $project->repo }}</p>
                <h5 class="card-title"> data: </h5>
                <p class="card-text">{{ $project->data }}</p>
            </div>
        </div>
        <a href="{{ route('guest.index') }}" class="btn btn-info text-light">HOME</a>
        <a href="{{ route('logged.edit', $project->id) }}" class="btn btn-warning text-light">EDIT</a>
        <a href="{{ route('logged.create') }}" class="btn btn-primary text-light">NEW</a>
        <form class="d-inline" method="POST" action="{{ route('logged.delete', $project->id) }}"
            onsubmit="return confirmDelete()">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" type="submit" value="DELETE">
        </form>

    </main>
@endsection
