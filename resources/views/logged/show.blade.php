@extends('layouts.app')

@section('content')
    <main class="container text-center py-5">

        <div class="card border-dark mb-3 mx-auto" style="max-width: 18rem;">
            <div class="card-header">{{ $project->nome }}</div>
            <div class="card-body">
                <h5 class="card-title"> descrizione: </h5>
                <p class="card-text">{{ $project->descrizione }}</p>
                <h5 class="card-title"> type: </h5>
                <p class="card-text">{{ $project->type }}</p>
                <h5 class="card-title"> tecnology: </h5>
                <p class="card-text">{{ $project->tecnology }}</p>
                <h5 class="card-title"> link: </h5>
                <p class="card-text">{{ $project->link }}</p>
                <h5 class="card-title"> repo: </h5>
                <p class="card-text">{{ $project->repo }}</p>
                <h5 class="card-title"> data: </h5>
                <p class="card-text">{{ $project->data }}</p>
            </div>
        </div>

    </main>
@endsection
