@extends('layouts.modal')
@section('title',$profile->name)
@section('modalclass','modal-lg')
@section('content')
	<form id="FormModal">
		@csrf
        {{-- Nome --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Name">Nome</label>
					<input name="Name" type="text" class="form-control" value="{{ $profile->name }}" required>
				</div>
			</div>
		</div>
		{{-- Descrição --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="Description">Descrição</label>
					<textarea name="Description" class="form-control" rows="4">{{ $profile->description }}</textarea>
				</div>
			</div>
		</div>

        {{-- Limites --}}
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="max_file_size">Tamanho Máximo por arquivo</label>
					<input name="max_file_size" type="number" value="{{ $profile->max_file_size }}" min="0" class="form-control" required>
				</div>
			</div>
            <div class="col-md-4">
				<div class="form-group">
					<label for="max_package_size">Tamanho Máximo por Pacote</label>
					<input name="max_package_size" type="number" value="{{ $profile->max_package_size }}" min="0" class="form-control" required>
				</div>
			</div>
            <div class="col-md-4">
				<div class="form-group">
					<label for="max_storage_size">Capacidade de Armazenamento</label>
					<input name="max_storage_size" type="number" value="{{ $profile->max_storage_size }}" min="0" class="form-control" required>
				</div>
			</div>
		</div>

		{{-- ACL --}}
    
		{{-- Relatórios --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<h5 data-toggle="collapse" href="#Relatorios"><i class="fas fa-angle-right pr-2"></i>Relatórios</h5>
				</div>
			</div>
		</div>
		<div class="collapse" id="Relatorios">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-inline">
						<div class="checkbox checkbox-primary pr-2">
							<input name="relatorios_operacionais_read" id="relatorios_operacionais_read" type="checkbox" @if(json_decode($profile->acl_reports_operational)->read) checked @endif hidden>
							<label for="relatorios_operacionais_read">Relatórios Operacionais</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="relatorios_administrativos_read" id="relatorios_administrativos_read" type="checkbox" @if(json_decode($profile->acl_reports_administrative)->read) checked @endif hidden>
							<label for="relatorios_administrativos_read">Relatórios Administrativos</label>
						</div>
					</div>
				</div>
			</div>
		</div>

        {{-- Dashboards --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<h5 data-toggle="collapse" href="#Dashboards"><i class="fas fa-angle-right pr-2"></i>Dashboards</h5>
				</div>
			</div>
		</div>
		<div class="collapse" id="Dashboards">
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-inline">
						<div class="checkbox checkbox-primary pr-2">
							<input name="dashboards_gerencial_read" id="dashboards_gerencial_read" type="checkbox" @if(json_decode($profile->acl_dashboards_management)->read) checked @endif hidden>
							<label for="dashboards_gerencial_read">Dashboard Gerencial</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="dashboards_operacional_read" id="dashboards_operacional_read" type="checkbox" @if(json_decode($profile->acl_dashboards_operational)->read) checked @endif hidden>
							<label for="dashboards_operacional_read">Dashboard Operacional</label>
						</div>
					</div>
				</div>
			</div>
		</div>

        {{-- System Audit --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<h5 data-toggle="collapse" href="#Audit"><i class="fas fa-angle-right pr-2"></i>Auditoria do Sistema</h5>
				</div>
			</div>
		</div>
		<div class="collapse" id="Audit">
            {{-- Access Logs --}}
			<div class="row">
				<div class="col-md-12">
					<label class="pr-4">Acessos</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-inline">
						<div class="checkbox checkbox-primary pr-2">
							<input name="audit_access_read" id="audit_access_read" type="checkbox" @if(json_decode($profile->acl_audit_accessLogs)->read) checked @endif hidden>
							<label for="audit_access_read">Visualizar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="audit_access_download" id="audit_access_download" type="checkbox" @if(json_decode($profile->acl_audit_accessLogs)->download) checked @endif hidden>
							<label for="audit_access_download">Download</label>
						</div>
					</div>
				</div>
			</div>
            {{-- Change Logs --}}
			<div class="row">
				<div class="col-md-12">
					<label class="pr-4">Alterações</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-inline">
						<div class="checkbox checkbox-primary pr-2">
							<input name="audit_change_read" id="audit_change_read" type="checkbox" @if(json_decode($profile->acl_audit_changeLogs)->read) checked @endif hidden>
							<label for="audit_change_read">Visualizar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="audit_change_download" id="audit_change_download" type="checkbox" @if(json_decode($profile->acl_audit_changeLogs)->download) checked @endif hidden>
							<label for="audit_change_download">Download</label>
						</div>
					</div>
				</div>
			</div>
		</div>

		{{-- System --}}
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<h5 data-toggle="collapse" href="#Sistema"><i class="fas fa-angle-right pr-2"></i>Sistema</h5>
				</div>
			</div>
		</div>
		<div class="collapse" id="Sistema">
			{{-- Usuários --}}
			<div class="row">
				<div class="col-md-12">
					<label class="pr-4">Usuários</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-inline">
						<div class="checkbox checkbox-primary pr-2">
							<input name="users_read" id="users_read" type="checkbox" @if(json_decode($profile->acl_users)->read) checked @endif hidden>
							<label for="users_read">Visualizar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="users_create" id="users_create" type="checkbox" @if(json_decode($profile->acl_users)->create) checked @endif hidden>
							<label for="users_create">Criar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="users_update" id="users_update" type="checkbox" @if(json_decode($profile->acl_users)->update) checked @endif hidden>
							<label for="users_update">Editar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="users_delete" id="users_delete" type="checkbox" @if(json_decode($profile->acl_users)->delete) checked @endif hidden>
							<label for="users_delete">Excluir</label>
						</div>
					</div>
				</div>
			</div>
			{{-- User Profiles --}}
			<div class="row">
				<div class="col-md-12">
					<label class="pr-4">Perfis de Usuário</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-inline">
						<div class="checkbox checkbox-primary pr-2">
							<input name="profiles_read" id="profiles_read" type="checkbox" @if(json_decode($profile->acl_profiles)->read) checked @endif hidden>
							<label for="profiles_read">Visualizar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="profiles_create" id="profiles_create" type="checkbox" @if(json_decode($profile->acl_profiles)->create) checked @endif hidden>
							<label for="profiles_create">Criar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="profiles_update" id="profiles_update" type="checkbox" @if(json_decode($profile->acl_profiles)->update) checked @endif hidden>
							<label for="profiles_update">Editar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="profiles_delete" id="profiles_delete" type="checkbox" @if(json_decode($profile->acl_profiles)->delete) checked @endif hidden>
							<label for="profiles_delete">Excluir</label>
						</div>
					</div>
				</div>
			</div>
			{{-- Backups --}}
			<div class="row">
				<div class="col-md-12">
					<label class="pr-4">Backups</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-inline">
                        <div class="checkbox checkbox-primary pr-2">
							<input name="backups_create" id="backups_create" type="checkbox" @if(json_decode($profile->acl_backups)->create) checked @endif hidden>
							<label for="backups_create">Gerar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="backups_read" id="backups_read" type="checkbox" @if(json_decode($profile->acl_backups)->read) checked @endif hidden>
							<label for="backups_read">Visualizar</label>
						</div>
                        <div class="checkbox checkbox-primary pr-2">
							<input name="backups_restore" id="backups_restore" type="checkbox" @if(json_decode($profile->acl_backups)->restore) checked @endif hidden>
							<label for="backups_restore">Restaurar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="backups_download" id="backups_download" type="checkbox" @if(json_decode($profile->acl_backups)->download) checked @endif hidden>
							<label for="backups_download">Download</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="backups_delete" id="backups_delete" type="checkbox" @if(json_decode($profile->acl_backups)->delete) checked @endif hidden>
							<label for="backups_delete">Excluir</label>
						</div>
					</div>
				</div>
			</div>
			{{-- Configurações --}}
			<div class="row">
				<div class="col-md-12">
					<label class="pr-4">Configurações</label>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group form-inline">
						<div class="checkbox checkbox-primary pr-2">
							<input name="config_read" id="config_read" type="checkbox" @if(json_decode($profile->acl_config)->read) checked @endif hidden>
							<label for="config_read">Visualizar</label>
						</div>
						<div class="checkbox checkbox-primary pr-2">
							<input name="config_update" id="config_update" type="checkbox" @if(json_decode($profile->acl_config)->update) checked @endif hidden>
							<label for="config_update">Editar</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@stop
@section('actions')
	<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
	<button type="submit" class="btn btn-primary btn-profiles-update" data-id={{$profile->id}}>Salvar</button>
@stop