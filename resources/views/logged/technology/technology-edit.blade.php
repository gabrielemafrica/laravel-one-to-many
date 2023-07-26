@extends('dashboard')

@section('dashboard-content')
    <h1>edit technology</h1>
    <div class="card border-dark mb-3 mx-auto" style="max-width: 18rem;">
        <div class="card-header">MODIFICA</div>
        <div class="card-body">
            <form method="POST" action="{{ route('logged.technologyUpdate', $technology->id) }}" class="mx-auto">

                @csrf
                @method('PUT')

                <div class="form-group my-3">
                    <input type="text" name="name" id="name" class="form-control" value="{{ $technology->name }}">
                </div>

                <div class="form-group my-3">
                    @foreach ($projects as $project)
                        <div class="form-check my-2 mx-auto" style="width: 200px">
                            <input class="form-check-input" type="checkbox" id="project{{ $project->id }}"
                                name="projects[]" value="{{ $project->id }}"
                                @foreach ($project->technology as $technologyInProject)
                                    @checked($technologyInProject->id === $technology->id) @endforeach>
                            <label class="form-check-label" for="project{{ $project->id }}">
                                {{ $project->nome }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="form-group my-3">
                    <input type="submit" value="APPLICA" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
    <div class="container text-center">
        <a href="{{ route('logged.technologyIndex') }}" class="btn btn-info text-light">INDIETRO</a>
    </div>
@endsection
