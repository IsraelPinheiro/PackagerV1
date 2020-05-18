@extends('layouts.app')
@section('content')
	<div class="page-header mb-3">
		<h1 class="d-inline">Caixa de Entrada</h1>
		<button class="btn btn-primary btn-circle btn-users-add float-right d-inline" title="Novo" type="button">
            <i class="fas fa-plus"></i>
        </button>
	</div>
	<div class="container-fluid">
		<table id="datatable" class="datatable table table-striped" cellspacing="0" width="100%">
			<thead>
				<tr>
                    <th><center>Remetente</center></th>
					<th><center>Título</center></th>
					<th><center>Data Envio</center></th>
					<th><center>Data Limite</center></th>
					<th><center>Arquivos</center></th>
					<th class="noorder"></th>
				</tr>
			</thead>
			<tbody>
				@foreach($packages as $package)
					<tr @if($package->expires_at && $package->expires_at->isPast()) class="table-danger" @endif>
                        <td><center>{{ $package->sender->name }}</center></td>
						<td><center>{{ $package->title }}</center></td>
                        <td><center>{{ $package->created_at->format('d/m/Y') }}</center></td>
                        <td><center>
							@if(empty($package->expires_at))
								-
							@else
								{{$package->expires_at->format('d/m/Y')}}
							@endif
						</center></td>
						<td><center>{{ $package->files->count() }}</center></td>
						<td class="toolbox">
                            <center>
                                <i data-id={{$package->id}} class="fas fa-download fa-lg btn-inbounds-download pr-1" title="Baixar Arquivos do Pacote"></i>
                                <i data-id={{$package->id}} class="fas fa-eye fa-lg btn-inbounds-show pr-1" title="Exibir"></i>
                                @if($package->directLink)
                                    <i data-key={{$package->key}} class="fas fa-link fa-lg btn-inbounds-link pr-1" title="Gerar Link Direto"></i>
                                @endif
                            </center>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
@stop