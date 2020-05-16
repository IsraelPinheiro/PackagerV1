@extends('layouts.modal')
@section('title',$user->name)
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
        {{-- Profile and Status --}}
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
                    <label for="Profile">Perfil</label>
                    <select name="Profile" class="form-control">
                        @foreach ($profiles as $profile)
                            <option value="{{$profile->id}}" @if($profile->id == $user->profile->id) selected @endif>{{$profile->name}}</option>
                        @endforeach
                    </select>
                </div>
			</div>
             <div class="col-md-6">
                <div class="form-group">
                    <label for="Status">Situação</label>
                    <select name="Status" class="form-control">
                        <option value="1" @if($user->active) selected @endif>Ativo</option>
                        <option value="0" @if(!$user->active) selected @endif>Inativo</option>
                    </select>
                </div>
			</div>
		</div>

        {{-- Storage Limits --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<div class="checkbox checkbox-primary pr-2">
						<input name="limitsSwitch" id="limitsSwitch" type="checkbox" @if($user->override_storage_limits) checked @endif hidden>
						<label for="limitsSwitch">Sobrescrever Limites de Armazenamento</label>
					</div>
				</div>
			</div>
		</div>
		<div id="storageLimits" class="row @if(!$user->override_storage_limits) d-none @endif">
			<div class="col-md-6">
				<div class="form-group">
					<label for="max_file_size">Tamanho Máximo por arquivo</label>
					<input name="max_file_size" type="number" value="{{ $user->max_file_size }}" min="0" class="form-control" required>
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
					<label for="max_package_size">Tamanho Máximo por Pacote</label>
					<input name="max_package_size" type="number" value="{{ $user->max_package_size }}" min="0" class="form-control" required>
				</div>
			</div>
            <div class="col-md-6">
				<div class="form-group">
					<label for="max_storage_size">Capacidade de Armazenamento</label>
					<input name="max_storage_size" type="number" value="{{ $user->max_storage_size }}" min="0" class="form-control" required>
				</div>
			</div>
		</div>

        {{-- Senha e Confirmação --}}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="Password">Senha</label>
					<input name="Password" id="Password" type="password" class="form-control" minlength="6" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="Password_confirmation">Confirmar Senha</label>
					<input name="Password_confirmation" id="Password_confirmation" type="password" class="form-control" required>
				</div>
			</div>
		</div>
	</form>
@stop
@section('actions')
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	<button type="submit" class="btn btn-primary btn-users-update" data-id={{$user->id}}>Salvar</button>
@stop