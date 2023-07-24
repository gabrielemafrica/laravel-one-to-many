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
            </div>
        </div>
        <div class="row">

            @foreach ($projects as $project)
                <div class="col-3 mb-4">
                    <div class="card text-center">
                        <div class="card-header">
                            {{-- {{ $project->type }} --}}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $project->nome }}</h5>
                            <p class="card-text">{{ $project->description }}</p>
                            <a href="{{ route('logged.show', $project->id) }}" class="btn btn-info text-light">SHOW</a>
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
