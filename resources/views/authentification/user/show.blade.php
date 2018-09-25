@extends('layouts.app')

@section('content')
    <div class="container section">
        <h1 class="title">Detail {{$model->name}}</h1>
        <div class="columns">
            <div class="column">
                <table class="table is-fullwidth is-bordered">
                    <tr>
                        <td>Nama</td>
                        <td>{{$model->name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{$model->email}}</td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="columns">
            <div class="column">
                <h2 class="subtitle">Pilih Role</h2>
                <form class="" action="{{route('user.add_role', $model->id)}}" method="post">
                    @csrf
                    <div class="field">
                        <div class="select is-fullwidth">
                            <select name="role_id">
                                <option disabled selected>Pilih Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="button is-outlined is-info is-pulled-right">Simpan</button>
                </form>
            </div>
        </div>
        <div class="columns">
            <div class="column">
                <table class="table is-fullwidth is-bordered">
                    <tr>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                    @foreach ($model->roles()->get() as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td>
                                <form class="" action="{{route('user.remove_role', $model->id)}}" method="get">
                                    @csrf
                                    <input type="hidden" name="role_id" value="{{$role->id}}">
                                    <button type="submit" class="button is-outlined is-info" >
                                        <i class="material-icons">
                                            delete
                                        </i>
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <br>
    </div>
@endsection
