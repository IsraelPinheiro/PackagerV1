@extends('layouts.app')
@section('content')
	<div class="page-header mb-3">
		<h1 class="d-inline">Backups do Sistema</h1>
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
					<th><center>Id</center></th>
					<th><center>Nome</center></th>
					<th><center>Data</center></th>
					<th><center>Hash MD5</center></th>
					@if($userPermissions->download || $userPermissions->restore || $userPermissions->delete)
						<th class="noorder"></th>
					@endif
				</tr>
			</thead>
			<tbody>
				@foreach($backups as $backup)
					<tr>
						<td><center>{{ $backup->id }}</center></td>
						<td><center>{{ $backup->name }}</center></td>
						<td><center>{{ $backup->created_at->format('d/m/Y') }}</center></td>
                        <td><center>{{ $backup->md5 }}</center></td>
						@if($userPermissions->download || $userPermissions->restore || $userPermissions->delete)
							<td class="toolbox">
								<center>
									@if($userPermissions->download)
										<i data-id={{$backup->id}} class="fas fa-edit fa-lg btn-backup-download pr-1" title="Editar"></i>
                                    @endif
                                    @if($userPermissions->restore)
                                        <i data-id={{$backup->id}} class="fas fa-eye fa-lg btn-backup-restore pr-1" title="Exibir"></i>
									@endif
									@if($userPermissions->delete)
										<i data-id={{$backup->id}} class="fas fa-trash-alt fa-lg btn-restore-del text-danger" title="Excluir"></i>
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