@extends('layouts.app')

@section('content')
    <main class="container text-center py-5">
        <h1>devi essere loggato per vedere i contenuti</h1>
        <a href="{{ route('login') }}" class="btn btn-info text-light">VAI AL LOGIN</a>
    </main>
@endsection
