@extends('layouts.modal-noactions')
@section('title',$backup->name)
@section('content')
	<form id="FormModal">
		@csrf
        {{-- Nome e Email --}}
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="Name">Nome</label>
					<input name="Name" type="text" class="form-control" value="{{ $backup->name }}" disabled>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="Creation">Criação</label>
					<input name="Creation" type="text" class="form-control" value="{{ $backup->created_at->format('d/m/Y H:i:s') }}" disabled>
				</div>
			</div>
        </div>
        <div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Hash">Hash MD5</label>
					<input name="Hash" type="text" class="form-control" value="{{ $backup->md5 }}" disabled>
				</div>
			</div>
		</div>
	</form>
@stop