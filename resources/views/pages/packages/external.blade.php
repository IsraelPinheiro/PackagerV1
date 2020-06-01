@extends('layouts.app-package')
@section('content')
    <img src="{{ asset('/img/logo_h.png') }}" style="max-height:100%;max-width:40%;display: inline-block;" class="img-fluid center-block pt-2 px-4" alt="Packager Logo">
    <form id="FormModal" class="px-4 my-4">
        @csrf
        {{-- Package Title --}}
        <div class="row">
            <div class="col-md-10">
                <div class="form-group">
                    <label for="Title">Título</label>
                    <input name="Title" type="text" class="form-control" value="{{ $package->title }}" disabled>
                </div>
            </div>
            <div id="ExpirationDateContainer" class="col-md-2">
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
        {{-- Descrição --}}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="Description">Descrição</label>
                    <textarea name="Description" class="form-control" rows="3" disabled>{{ $package->description }}</textarea>
                </div>
            </div>
        </div>

        {{-- Direct Link --}}
        <div class="row">
            
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