@extends('layouts.modal-noactions')
@section('title',$package->title)
@section('content')
	<form id="FormModal">
		@csrf
		{{-- Package Title --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Title">Título</label>
					<input name="Title" type="text" class="form-control" value="{{ $package->title }}" disabled>
				</div>
			</div>
		</div>
		{{-- Descrição --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Description">Descrição</label>
					<textarea name="Description" class="form-control" rows="3" disabled>{{ $package->description }}</textarea>
				</div>
			</div>
		</div>

		{{-- Recipient --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Recipient">Destinatário</label>
					<input name="Recipient" type="text" class="form-control" value="{{ $package->recipient->name }}" disabled>
				</div>
			</div>
		</div>

		{{-- Direct Link --}}
		<div class="row">
			<div class="col-md-6">
                <div class="form-group">
                    <label for="DirectLinkStatus">Link Direto</label>
                    @if(!$package->key && !$package->password)
                        <input name="DirectLinkStatus" id="DirectLinkStatus" type="text" value="Inativo" class="form-control" disabled>
                    @elseif($package->key && !$package->password)
                        <div class="input-group">
                            <input name="DirectLinkStatus" id="DirectLinkStatus" type="text" value="Permitido" class="form-control" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">
                                    <i data-key={{$package->key}} class="fas fa-link btn-outbounds-link pr-1" title="Gerar Link Direto"></i>
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="input-group">
                            <input name="DirectLinkStatus" id="DirectLinkStatus" type="text" value="Permitido com Senha" class="form-control" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-secondary" type="button">
                                    <i data-key={{$package->key}} class="fas fa-link btn-outbounds-link pr-1" title="Gerar Link Direto"></i>
                                </button>
                            </div>
                        </div>
                        
                    @endif
                </div>
			</div>
			<div id="ExpirationDateContainer" class="col-md-6">
				<div class="form-group">
					<label for="ExpirationDate">Data Limite de Acesso</label>
                    @if($package->expires_at)
                        <input name="ExpirationDate" id="ExpirationDate" type="text" value="{{$package->expires_at->format('d/m/Y')}}" class="form-control" disabled>
                    @else
                        <input name="ExpirationDate" id="ExpirationDate" type="text" value="Não Expira" class="form-control" disabled>
                    @endif
				</div>
			</div>
		</div>

		{{-- Drop Zone --}}
		<div class="row">
			<div class="col-md-12">
                @foreach ($package->files as $file)
                    <div class="input-group pb-1">
                        <input name="DirectLinkStatus" id="DirectLinkStatus" type="text" value="{{$file->originalName}}" class="form-control" disabled>
                        <div class="input-group-append">
							<a class="btn btn-primary" href="{{ route('outbounds.download.file',['file' => $file->id]) }}" role="button">
								<i class="fas fa-download btn-file-download pr-1" title="Baixar Arquivo"></i>
							</a>
                        </div>
                    </div>
				@endforeach
				<a class="btn btn-primary btn-block" href="{{ route('outbounds.download.package',['package' => $package->id]) }}" role="button">
					<i data-key={{$package->id}} class="fas fa-download btn-file-download pr-1" title="Baixar o pacote de arquivos"></i>
                    Baixar Pacote
				</a>
			</div>
		</div>
	</form>
@stop