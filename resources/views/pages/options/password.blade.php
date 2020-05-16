@extends('layouts.modal')
@section('title','Alterar Senha')
@section('content')
	<form id="FormModal">
		@csrf
        {{-- Password and Confirmation --}}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="password">Nova Senha</label>
					<input name="password" id="password" type="password" class="form-control" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="password_confirmation">Confirmar Senha</label>
					<input name="password_confirmation" id="password_confirmation" type="password" class="form-control" required>
				</div>
			</div>
		</div>
	</form>
@stop
@section('actions')
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	<button type="submit" class="btn btn-primary btn-update-password">Salvar</button>
@stop