@extends('layouts.app')

@section('content')
    <div class="container section">
        @if (Auth::user()->hasRole('Admin'))
            <table class="table is-fullwidth is-bordered ">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($models as $model)
                        <tr>
                            <td>{{$model->name}}</td>
                            <td>{{$model->email}}</td>
                            <td>
                                <a class="button is-outlined is-info" id="modal" href="{{route('user.show', $model->id)}}">
                                    <i class="material-icons">
                                        visibility
                                    </i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="help is-danger">No Access! Only Administrator</p>
        @endif

    </div>
@endsection
