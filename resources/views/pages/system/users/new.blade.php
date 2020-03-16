@extends('layouts.modal')
@section('title','Novo Usuário')
@section('content')
	<form id="FormModal">
		@csrf
        {{-- Nome e Email --}}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="Name">Nome</label>
					<input name="Name" type="text" class="form-control" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="Email">Email</label>
					<input name="Email" type="email" class="form-control" required>
				</div>
			</div>
		</div>
        {{-- Perfil --}}
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
                    <label for="Profile">Perfil</label>
                    <select name="Profile" class="form-control">
                        <option selected disabled>Selecione um Perfil</option>
                        @foreach ($profiles as $profile)
                            <option value="{{$profile->id}}">{{$profile->name}}</option>
                        @endforeach
                    </select>
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
	<button type="submit" class="btn btn-primary btn-users-store">Salvar</button>
@stop