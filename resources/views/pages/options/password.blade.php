@extends('layouts.modal')
@section('title','Alterar Senha')
@section('content')
	<form id="FormModal">
		@csrf
        {{-- Password and Confirmation --}}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="Password">Nova Senha</label>
					<input name="Password" id="Password" type="password" class="form-control" required>
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
	<button type="submit" class="btn btn-primary btn-update-password">Salvar</button>
@stop