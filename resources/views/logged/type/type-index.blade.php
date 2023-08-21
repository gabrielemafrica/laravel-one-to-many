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
                        <a href="{{ route('logged.typeEdit', $type->id) }}" class="btn btn-warning text-light">EDIT</a>
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
                </div>
            </div>
        @endforeach
    </div>
@endsection
