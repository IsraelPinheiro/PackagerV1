@extends('layouts.modal-noactions')
@section('title',$user->name)
@section('content')
	<form id="FormModal">
		@csrf
        {{-- Nome e Email --}}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="Name">Nome</label>
					<input name="Name" type="text" class="form-control" value="{{ $user->name }}" readonly>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="Email">Email</label>
					<input name="Email" type="email" class="form-control" value="{{ $user->email }}" readonly>
				</div>
			</div>
		</div>
        {{-- Profile and Status --}}
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
                    <label for="Profile">Perfil</label>
					<input name="Profile" type="text" class="form-control" value="{{ $user->profile->name }}" readonly>
                </div>
			</div>
             <div class="col-md-6">
                <div class="form-group">
                    <label for="Status">Situação</label>
					<input name="Status" type="text" class="form-control" value="@if($user->active) Ativo @else Inativo @endif" readonly>
                </div>
			</div>
		</div>

        {{-- Storage Limits --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<div class="checkbox checkbox-primary pr-2">
						<input name="limitsSwitch" id="limitsSwitch" type="checkbox" @if($user->override_storage_limits) checked @endif disabled hidden>
						<label for="limitsSwitch">Sobrescrever Limites de Armazenamento</label>
					</div>
				</div>
			</div>
		</div>
		<div id="storageLimits" class="row @if(!$user->override_storage_limits) d-none @endif">
			<div class="col-md-6">
				<div class="form-group">
					<label for="max_file_size">Tamanho Máximo por arquivo</label>
					<input name="max_file_size" type="text" value="{{ $user->max_file_size }}" class="form-control" readonly>
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
					<label for="max_package_size">Tamanho Máximo por Pacote</label>
					<input name="max_package_size" type="text" value="{{ $user->max_package_size }}" class="form-control" readonly>
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
					<label for="max_storage_size">Capacidade de Armazenamento</label>
					<input name="max_storage_size" type="text" value="{{ $user->max_storage_size }}" class="form-control" readonly>
				</div>
			</div>
		</div>
	</form>
@stop