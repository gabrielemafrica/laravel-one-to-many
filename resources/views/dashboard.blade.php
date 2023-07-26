@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('SEI LOGGATO!') }}
                        <br>
                        <a class="btn btn-info text-light my-3" href="{{ route('logged.typeIndex') }}"> show TYPES </a>
                        <a class="btn btn-success text-light my-3" href="{{ route('logged.technologyIndex') }}"> show
                            TECHNOLOGIES </a>
                        @yield('dashboard-content')

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
