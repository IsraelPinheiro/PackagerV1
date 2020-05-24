@extends('layouts.app')
@section('content')
	<div class="page-header mb-3">
		<h1 class="d-inline">Backups do Sistema</h1>
		@if(json_decode(Auth::user()->profile->acl_backups)->create)
			<button class="btn btn-primary btn-circle btn-backups-run float-right d-inline" title="Novo Backup Manual" type="button">
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
					<th class="noorder"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($backups as $backup)
					<tr>
						<td><center>{{ $backup->id }}</center></td>
						<td><center>{{ $backup->name }}</center></td>
						<td><center>{{ $backup->created_at->format('d/m/Y') }}</center></td>
                        <td><center>{{ $backup->md5 }}</center></td>
						<td class="toolbox">
							<center>
								<i data-id={{$backup->id}} class="fas fa-eye fa-lg btn-backups-show pr-1" title="Exibir"></i>
								@if($userPermissions->download)
									<i data-id={{$backup->id}} class="fas fa-download fa-lg btn-backups-download pr-1" title="Download"></i>
								@endif
								@if($userPermissions->restore)
									<i data-id={{$backup->id}} class="fas fa-undo fa-lg btn-backups-restore pr-1 disabled" title="Restaurar Backup"></i>
								@endif
								@if($userPermissions->delete)
									<i data-id={{$backup->id}} class="fas fa-trash-alt fa-lg btn-backups-del text-danger" title="Excluir"></i>
								@endif
							</center>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop