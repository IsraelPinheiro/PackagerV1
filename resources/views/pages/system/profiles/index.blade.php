@extends('layouts.app')
@section('content')
	<div class="page-header mb-3">
		<h1 class="d-inline">Perfis de Acesso</h1>
		@if(json_decode(Auth::user()->profile->acl_profiles)->create)
			<button class="btn btn-primary btn-circle btn-profiles-add float-right d-inline" title="Novo" type="button">
				<i class="fas fa-plus"></i>
			</button>
		@endif
	</div>
	<div class="container-fluid">
		<table id="datatable" class="datatable table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th><center>Nome</center></th>
					<th><center>Descrição</center></th>
                    <th><center>Usuários</center></th>
					@if($userPermissions->update || $userPermissions->delete)
						<th class="noorder"></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($profiles as $profile)
					<tr>
						<td><center>{{ $profile->name }}</center></td>
                        <td><center>{{ $profile->description }}</center></td>
						<td><center>{{ $profile->users->count() }}</center></td>
						@if($userPermissions->update || $userPermissions->delete)
							<td class="toolbox">
								<center>
									<i data-id={{$profile->id}} class="fas fa-list fa-lg btn-profile-users-show pr-1" title="Listar Usuarios"></i>
									@if($userPermissions->update)
										<i data-id={{$profile->id}} class="fas fa-edit fa-lg btn-profiles-edit pr-1" title="Editar"></i>
                                    @else
                                        <i data-id={{$profile->id}} class="fas fa-eye fa-lg btn-profiles-show pr-1" title="Exibir"></i>
									@endif
									@if($userPermissions->delete)
										<i data-id={{$profile->id}} class="fas fa-trash-alt fa-lg btn-profiles-del text-danger" title="Excluir"></i>
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