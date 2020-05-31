@extends('layouts.modal')
@section('title','Novo Pacote de Arquivos')
@section('content')
	<form id="FormModal" enctype="multipart/form-data">
		@csrf
		{{-- Package Title --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Title">Título</label>
					<input name="Title" type="text" class="form-control" required>
				</div>
			</div>
		</div>
		{{-- Descrição --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Description">Descrição</label>
					<textarea name="Description" class="form-control" rows="4"></textarea>
				</div>
			</div>
		</div>

		{{-- Recipient --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Recipient">Destinatário</label>
					<select name="Recipient" class="form-control" required>
						<option selected disabled>Selecione um Destinatário</option>
						@foreach ($users as $user)
							@if($user->id!=Auth::user()->id)
								<option value="{{$user->id}}">{{$user->name}}</option>
							@endif
						@endforeach
					</select>
				</div>
			</div>
		</div>

		{{-- Direct Link --}}
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
                    <label for="DirectLinkStatus">Link Direto</label>
                    <select name="DirectLinkStatus" id="DirectLinkStatus" class="form-control">
                        <option value="0">Inativo</option>
						<option value="1">Permitido</option>
						<option value="2">Permitido com Senha</option>
                    </select>
                </div>
			</div>
			<div id="passwordContainer" class="col-md-6 d-none">
				<div class="form-group">
					<label for="Password">Senha de Acesso</label>
					<input name="Password" id="Password" type="password" class="form-control" minlength="6">
				</div>
			</div>
		</div>

		{{-- Expiration Date --}}
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
                    <label for="ExpirationDateStatus">Limite de Acesso</label>
                    <select name="ExpirationDateStatus" id="ExpirationDateStatus" class="form-control">
                        <option value="0">Acesso não Expira</option>
						<option value="1">Acesso Expira</option>
                    </select>
                </div>
			</div>
			<div id="ExpirationDateContainer" class="col-md-6 d-none">
				<div class="form-group">
					<label for="ExpirationDate">Data Limite de Acesso</label>
					<input name="ExpirationDate" id="ExpirationDate" type="date" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control">
				</div>
			</div>
		</div>
		{{-- Drop Zone --}}
		<div class="row">
			<div class="col-md-12">
				<label>Arquivos Para Envio</label>
				<div class="input-group">
					<div class="custom-file">
    					<input type="file" class="custom-file-input" id="Files" name="Files" multiple>
						<label id="FileName" class="custom-file-label noafter" for="Files" >Selecione os Arquivos</label>
  					</div>
					<div class="input-group-append d-none">
    					<button class="btn btn-danger btn-remove" type="button"><i class="fas fa-trash-alt"></i></button>
  					</div>
					<div class="input-group-append">
    					<label class="input-group-text" for="Files"><i class="fas fa-search"></i></label>
  					</div>
				</div>
			</div>
		</div>
	</form>
@stop
@section('actions')
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	<button type="submit" class="btn btn-primary btn-package-send">Enviar</button>
@stop