@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="columns is-marginless is-centered">
            <div class="column is-7">
                <nav class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Dashboard
                        </p>
                    </header>

                    <div class="card-content">
                        You are logged in as {{Auth::user()->roles()->first()->name}},
                        @if (Auth::user()->hasRole('Admin'))
                            <a href="{{route('user.index')}}">GoTo ACL</a>
                        @else
                            you cannot access this <a href="{{route('user.index')}}">this page</a>
                        @endif
                    </div>
                </nav>
            </div>
        </div>
    </div>
@endsection
