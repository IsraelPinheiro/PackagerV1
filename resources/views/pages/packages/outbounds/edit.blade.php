@extends('layouts.modal')
@section('title',$package->title)
@section('content')
	<form id="FormModal" enctype="multipart/form-data">
		@csrf
		{{-- Package Title --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Title">Título</label>
					<input name="Title" type="text" class="form-control" value="{{ $package->title }}" required>
				</div>
			</div>
		</div>
		{{-- Descrição --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Description">Descrição</label>
					<textarea name="Description" class="form-control" rows="4">{{ $package->description }}</textarea>
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
								@if($package->recipient_id == $user->id ){
									<option value="{{$user->id}}" selected>{{$user->name}}</option>
								}
								@else{
									<option value="{{$user->id}}">{{$user->name}}</option>
								}
								@endif
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
						@if($package->key)
							@if($package->password)
								<option value="0">Inativo</option>
								<option value="1">Permitido</option>
								<option value="2" selected>Permitido com Senha</option>
							@else
								<option value="0">Inativo</option>
								<option value="1" selected>Permitido</option>
								<option value="2">Permitido com Senha</option>
							@endif
						@else
							<option value="0" selected>Inativo</option>
							<option value="1">Permitido</option>
							<option value="2">Permitido com Senha</option>
						@endif
                    </select>
                </div>
			</div>
			<div id="passwordContainer" class="col-md-6 @if(!$package->password) d-none @endif">
				<div class="form-group">
					<label for="Password">Senha de Acesso</label>
					<input name="Password" id="Password" type="password" placeholder="Alterar Senha" class="form-control" minlength="6">
				</div>
			</div>
		</div>

		{{-- Expiration Date --}}
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
                    <label for="ExpirationDateStatus">Limite de Acesso</label>
                    <select name="ExpirationDateStatus" id="ExpirationDateStatus" class="form-control">
						<option value="0" @if(!$package->expires_at) selected @endif>Acesso não Expira</option>
						<option value="1" @if($package->expires_at) selected @endif>Acesso Expira</option>
                    </select>
                </div>
			</div>
			<div id="ExpirationDateContainer" class="col-md-6 @if(!$package->expires_at) d-none @endif">
				<div class="form-group">
					<label for="ExpirationDate">Data Limite de Acesso</label>
					@if($package->expires_at)
						<input name="ExpirationDate" id="ExpirationDate" type="date" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" value="{{$package->expires_at->format('Y-m-d')}}" class="form-control">
					@else
						<input name="ExpirationDate" id="ExpirationDate" type="date" min="{{\Carbon\Carbon::now()->format('Y-m-d')}}" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control">
					@endif
				</div>
			</div>
		</div>
	</form>
@stop
@section('actions')
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	<button type="submit" class="btn btn-primary btn-package-update" data-id={{$package->id}}>Salvar</button>
@stop