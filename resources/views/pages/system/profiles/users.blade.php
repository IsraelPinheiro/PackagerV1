@extends('layouts.modal-noactions')
@section('title','Usuários de '.$profile->name)
@section('modalclass','modal-lg')
@section('content')
    <table id="datatable" class="datatable table table-striped" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th><center>Nome</center></th>
                <th><center>Email</center></th>
                <th><center>Status</center></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profile->users as $user)
                <tr>
                    <td><center>{{ $user->name }}</center></td>
                    <td><center>{{ $user->email }}</center></td>
                    <td><center>
                        @if($user->active)
                            Ativo
                        @else
                            Inativo
                        @endif
                    </center></td>
			    </tr>
            @endforeach
        </tbody>
    </table>
@stop