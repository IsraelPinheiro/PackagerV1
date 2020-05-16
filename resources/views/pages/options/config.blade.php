@extends('layouts.modal')
@section('title','Meus Dados')
@section('content')
	<form id="FormModal">
		@csrf
        {{-- Nome e Email --}}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="Name">Nome</label>
					<input name="Name" type="text" class="form-control" value="{{ $user->name }}" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="Email">Email</label>
					<input name="Email" type="email" class="form-control" value="{{ $user->email }}" required>
				</div>
			</div>
		</div>

        {{-- Storage Limits --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<h5>Meus Limites de Uso</h5>
				</div>
			</div>
		</div>
		<div id="storageLimits" class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="max_file_size">Tamanho Máximo por arquivo</label>
                    @if($user->override_storage_limits)
                        <input name="max_file_size" type="text" value="@if($user->max_file_size==0) Ilimitado @else {{ $user->max_file_size." MB" }} @endif" min="0" class="form-control" readonly>
                    @else
                        <input name="max_file_size" type="text" value="@if($user->profile->max_file_size==0) Ilimitado @else {{ $user->profile->max_file_size." MB" }} @endif" min="0" class="form-control" readonly>
                    @endif
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
					<label for="max_package_size">Tamanho Máximo por Pacote</label>
                    @if($user->override_storage_limits)
                        <input name="max_package_size" type="text" value="@if($user->max_package_size==0) Ilimitado @else {{ $user->max_package_size." MB" }} @endif" min="0" class="form-control" readonly>
                    @else
                        <input name="max_package_size" type="text" value="@if($user->profile->max_package_size==0) Ilimitado @else {{ $user->profile->max_package_size." MB" }} @endif" min="0" class="form-control" readonly>
                    @endif
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
					<label for="max_storage_size">Capacidade de Armazenamento</label>
                    @if($user->override_storage_limits)
                        <input name="max_storage_size" type="text" value="@if($user->max_storage_size==0) Ilimitado @else {{ $user->max_storage_size." MB" }} @endif" min="0" class="form-control" readonly>
                    @else
                        <input name="max_storage_size" type="text" value="@if($user->profile->max_storage_size==0) Ilimitado @else {{ $user->profile->max_storage_size." MB" }} @endif" min="0" class="form-control" readonly>
                    @endif
				</div>
			</div>
		</div>
	</form>
@stop
@section('actions')
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	<button type="submit" class="btn btn-primary btn-update-config">Salvar</button>
@stop