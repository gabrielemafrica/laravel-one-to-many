@extends('layouts.app')

@section('content')
    <main class="container text-center py-5">
        <h1 class="text-success"><u> {{ $project->nome }} </u></h1>

        <div class="text-danger"> descrizione: </div>
        <div class="container text-info bg-secondary w-50 mb-3"> {{ $project->descrizione }} </div>
        <div class="text-danger"> type: </div>
        <div class="container text-info bg-secondary w-50 mb-3"> {{ $project->type }} </div>
        <div class="text-danger"> tecnology: </div>
        <div class="container text-info bg-secondary w-50 mb-3"> {{ $project->tecnology }} </div>
        <div class="text-danger"> link: </div>
        <div class="container text-info bg-secondary w-50 mb-3"> {{ $project->link }} </div>
        <div class="text-danger"> project:->repo </div>
        <div class="container text-info bg-secondary w-50 mb-3"> {{ $project->repo }} </div>
        <div class="text-danger"> $project:->data </div>
        <div class="container text-info bg-secondary w-50 mb-3"> {{ $project->data }} </div>

    </main>
@endsection
