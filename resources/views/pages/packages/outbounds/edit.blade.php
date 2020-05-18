@extends('layouts.modal')
@section('title',$package->title)
@section('content')
@stop
@section('actions')
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	<button type="submit" class="btn btn-primary btn-package-update" data-id={{$package->id}}>Salvar</button>
@stop