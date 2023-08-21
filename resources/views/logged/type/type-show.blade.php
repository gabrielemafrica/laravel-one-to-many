@extends('dashboard')

@section('dashboard-content')
    <h1>show di type</h1>
    <a href="{{ route('logged.typeCreate') }}" class="btn btn-primary mb-4">NUOVO TYPE</a>
    <div class="card border-dark mb-3 mx-auto" style="max-width: 18rem;">
        <div class="card-header">{{ $type->type }}</div>
        <div class="card-body">
            <h5 class="card-title"> projects: {{ count($type->projects) }}</h5>
            <ol>
                @foreach ($type->projects as $project)
                    <li>
                        <a href="{{ route('logged.show', $project->id) }}">{{ $project->nome }}</a>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
    <div class="container text-center">
        <a href="{{ route('logged.typeIndex') }}" class="btn btn-info text-light">ALL</a>
        <a href="{{ route('logged.typeEdit', $type->id) }}" class="btn btn-warning text-light">EDIT</a>
        <a href="{{ route('logged.create') }}" class="btn btn-primary text-light">NEW</a>
        <div>se elimini, seleziona dove sposti i progetti collegati</div>
        <form class="my-2" method="POST" action="{{ route('logged.typeDelete', $type->id) }}"
            onsubmit=" return confirmDelete()">
            @csrf
            @method('DELETE')
            <input class="btn btn-danger" type="submit" value="DELETE">
            <select name="type_id" id="type_id">
                @foreach ($types as $typeTo)
                    <option value="{{ $typeTo->id }}" @disabled($type->id === $typeTo->id)>
                        {{ $typeTo->type }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
@endsection
