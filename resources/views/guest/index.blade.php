@extends('layouts.app')

@section('content')
    <main class="container text-center py-5">
        <div class="row">
            <div class="col-12">
                <!-- Verifica se l'utente è autenticato -->
                @auth
                    <h2>SEI LOGGATO</h2>
                    <h3>buongiorno {{ Auth::user()->name }}</h3>
                @endauth
                <!-- Se l'utente non è autenticato -->
                @guest
                    <h2>NON SEI LOGGATO</h2>
                @endguest
                <h1>I MIEI PROGETTI</h1>
                <a href="{{ route('logged.create') }}" class="btn btn-primary mb-4">CREA NUOVO</a>
            </div>
        </div>
        <div class="row">
            <!-- Ciclo per visualizzare i progetti -->
            @foreach ($projects as $project)
                <div class="col-3 mb-4">
                    <div class="card text-center">
                        <!-- Immagine del progetto (usa immagine predefinita se non c'è immagine principale) -->
                        <img class="card-img-top card-img"
                            src="{{ asset($project->main_picture ? 'storage/' . $project->main_picture : 'storage/images/pippo2.png') }}"
                            alt="{{ $project->nome }}">
                        <div class="card-header">
                            {{ $project->type->type }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->nome }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <!-- Link per visualizzare il progetto -->
                            <a href="{{ route('logged.show', $project->id) }}" class="btn btn-info text-light">SHOW</a>
                            <!-- Link per modificare il progetto -->
                            <a href="{{ route('logged.edit', $project->id) }}" class="btn btn-warning text-light">EDIT</a>
                            <!-- Form per eliminare il progetto -->
                            <form class="d-inline" method="POST" action="{{ route('logged.delete', $project->id) }}"
                                onsubmit="return confirmDelete()">
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
