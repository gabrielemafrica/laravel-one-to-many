@extends('layouts.app')

@section('content')
    <main class="container text-center py-5">
        <div class="row">
            <div class="col-12">
                @auth
                    <h2>SEI LOGGATO</h2>
                    <H3>buongiorno {{ Auth::user()->name }}</H3>
                @endauth
                @guest
                    <h2>NON SEI LOGGATO</h2>
                @endguest
                <h1>I MIEI PROGETTI</h1>
                <a href="{{ route('logged.create') }}" class="btn btn-primary mb-4">CREA NUOVO</a>
            </div>
        </div>
        <div class="row">

            @foreach ($projects as $project)
                <div class="col-3 mb-4">
                    <div class="card text-center">
                        <img class="card-img-top"
                            src="{{ asset($project->main_picture ? 'storage/' . $project->main_picture : 'storage/images/pippo2.png') }}"
                            alt="$project->nome">
                        <div class="card-header">
                            {{ $project->type->type }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->nome }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <a href="{{ route('logged.show', $project->id) }}" class="btn btn-info text-light">SHOW</a>
                            <a href="{{ route('logged.edit', $project->id) }}" class="btn btn-warning text-light">EDIT</a>
                            <form class="d-inline" method="POST" action="{{ route('logged.delete', $project->id) }}"
                                onsubmit=" return confirmDelete()">
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="DELETE">
                            </form>
                        </div>
                        <div class="card-footer text-body-secondary">
                            {{ $project->data }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
@endsection
