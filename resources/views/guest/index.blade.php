@extends('layouts.app')

@section('content')
    <main class="container text-center py-5">
        <h1>I MIEI PROGETTI</h1>
        <ul class="list-unstyled d-flex flex-wrap gap-3 justify-content-center">
            @foreach ($projects as $project)
                <li class="mt-3 w-25">
                    <div class="border border-primary py-4">
                        {{ $project->nome }}
                        <br>
                        <a href="{{ route('logged.show', $project->id) }}" class="btn btn-info">SHOW</a>

                    </div>
                </li>
            @endforeach
        </ul>
    </main>
@endsection
