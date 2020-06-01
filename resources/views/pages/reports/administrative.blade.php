@extends('layouts.app')
@section('content')
	<div class="page-header mb-3">
		<h1 class="d-inline">Relatórios Adminsitrativos</h1>
	</div>
	<div class="container-fluid">
    	<form id="FormModal">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="Report">Relatório</label>
                        <select name="Report" class="form-control" required>
                            <option selected disabled>Selecione um Relatório</option>
                            <option value="0">Consumo por Usuário</option>
                            <option value="1">Pacotes por Usuário</option>
                            <option value="2">Distribuição de Arquivos</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="DateStart">Início</label>
                        <input name="DateStart" id="DateStart" type="date" min="{{\Carbon\Carbon::now()->subYear(2)->format('Y-m-d')}}" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="DateEnd">Fim</label>
                        <input name="DateEnd" id="DateEnd" type="date" max="{{\Carbon\Carbon::now()->format('Y-m-d')}}" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" class="form-control">
                    </div>
                </div>
                
            </div>
            <div class="row">
                <div class="col-md-4">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Gerar Relatório</button>
                </div>
            </div>
        </form>

	</div>
@stop