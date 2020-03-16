@extends('layouts.app')
@section('content')
	<div class="page-header mb-3">
		<h1 class="d-inline">Usuários</h1>
		@if(json_decode(Auth::user()->profile->acl_users)->create)
			<button class="btn btn-primary btn-circle btn-users-add float-right d-inline" title="Novo" type="button">
				<i class="fas fa-plus"></i>
			</button>
		@endif
	</div>
	<div class="container-fluid">
		<table id="datatable" class="datatable table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><center>Nome</center></th>
					<th><center>Perfil</center></th>
					<th><center>Email</center></th>
					<th><center>Último Login</center></th>
					<th><center>Status</center></th>
					@if($userPermissions->update || $userPermissions->delete)
						<th class="noorder"></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td><center>{{ $user->name }}</center></td>
						<td><center>{{ $user->profile->name }}</center></td>
						<td><center>{{ $user->email }}</center></td>
						<td><center>
							@if(empty($user->lastAccess->accessed_at))
								-
							@else
								{{$user->lastAccess->accessed_at->format('d/m/Y')}}
							@endif
						</center></td>
						<td><center>
                            @if($user->active)
                                Ativo
                            @else
                                Inativo
                            @endif
						</center></td>
						@if($userPermissions->update || $userPermissions->delete)
							<td class="toolbox">
								<center>
									@if($userPermissions->update)
										<i data-id={{$user->id}} class="fas fa-edit fa-lg btn-users-edit pr-1" title="Editar"></i>
                                    @else
                                        <i data-id={{$user->id}} class="fas fa-eye fa-lg btn-users-show pr-1" title="Exibir"></i>
									@endif
									@if($userPermissions->delete)
										<i data-id={{$user->id}} class="fas fa-trash-alt fa-lg btn-users-del text-danger" title="Excluir"></i>
									@endif
								</center>
							</td>
						@endif
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop