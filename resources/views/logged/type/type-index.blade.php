@extends('dashboard')

@section('dashboard-content')
    <h1>index type</h1>
    <a href="{{ route('logged.typeCreate') }}" class="btn btn-primary mb-4">NUOVO TYPE</a>
    <div class="row">
        @foreach ($types as $type)
            <div class="col-3 mb-4">
                <div class="card text-center">
                    <div class="card-header">
                        {{ $type->type }}
                    </div>
                    <div class="card-body">
                        <a href="{{ route('logged.typeShow', $type->id) }}" class="btn btn-info text-light">SHOW</a>
                        <a href="{{ route('logged.edit', $type->id) }}" class="btn btn-warning text-light">EDIT</a>
                        <form class="d-inline" method="POST" action="{{ route('logged.delete', $type->id) }}"
                            onsubmit=" return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="DELETE">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
