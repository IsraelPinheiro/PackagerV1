@extends('layouts.app')
@section('content')
	<div class="page-header mb-3">
		<h1 class="d-inline">Dashboard Gerencial</h1>
	</div>
	<div class="container-fluid">
        <div class="row">
			<div class="col-xl-3 col-md-6 mb-4">
            	<div class="card border-left-primary shadow h-100 py-2">
                	<div class="card-body">
                  		<div class="row no-gutters align-items-center">
                    		<div class="col mr-2">
                      			<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Usuários Ativos</div>
                      			<div id="userActiveCount" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    		</div>
                    		<div class="col-auto">
                    			<i class="fas fa-user fa-2x text-gray-300"></i>
                    		</div>
                  		</div>
                	</div>
              	</div>
            </div>
			<div class="col-xl-3 col-md-6 mb-4">
            	<div class="card border-left-primary shadow h-100 py-2">
                	<div class="card-body">
                  		<div class="row no-gutters align-items-center">
                    		<div class="col mr-2">
                      			<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Acessos Individuais (Acesso últimos 7 Dias)</div>
                      			<div id="userActiveLastWeek" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    		</div>
                    		<div class="col-auto">
                    			<i class="far fa-clock fa-2x text-gray-300"></i>
                    		</div>
                  		</div>
                	</div>
              	</div>
            </div>
			<div class="col-xl-3 col-md-6 mb-4">
            	<div class="card border-left-primary shadow h-100 py-2">
                	<div class="card-body">
                  		<div class="row no-gutters align-items-center">
                    		<div class="col mr-2">
                      			<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Perfís de Usuário</div>
                      			<div id="profileCount" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    		</div>
                    		<div class="col-auto">
                    			<i class="fas fa-users fa-2x text-gray-300"></i>
                    		</div>
                  		</div>
                	</div>
              	</div>
            </div>
			<div class="col-xl-3 col-md-6 mb-4">
            	<div class="card border-left-primary shadow h-100 py-2">
                	<div class="card-body">
                  		<div class="row no-gutters align-items-center">
                    		<div class="col mr-2">
                      			<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pacotes Enviados</div>
                      			<div id="packageCount" class="h5 mb-0 font-weight-bold text-gray-800">0</div>
                    		</div>
                    		<div class="col-auto">
                    			<i class="fas fa-archive fa-2x text-gray-300"></i>
                    		</div>
                  		</div>
                	</div>
              	</div>
            </div>
        </div>
		<div class="row">
			<div class="col-xl-6 col-md-6 col-lg-5">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Uusários/Perfil</h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						<div class="chart-pie pt-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
							<canvas id="ChartUsersProfile" width="272" height="253" class="chartjs-render-monitor" style="display: block; width: 272px; height: 253px;"></canvas>
						</div>
					</div>
				</div>
            </div>
			<div class="col-xl-6 col-md-6 col-lg-5">
				<div class="card shadow mb-4">
					<!-- Card Header - Dropdown -->
					<div class="card-header py-3">
						<h6 class="m-0 font-weight-bold text-primary">Tipo de Arquivo</h6>
					</div>
					<!-- Card Body -->
					<div class="card-body">
						<div class="chart-pie pt-4"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
							<canvas id="ChartFileType" width="272" height="253" class="chartjs-render-monitor" style="display: block; width: 272px; height: 253px;"></canvas>
						</div>
					</div>
				</div>
            </div>
		</div>
	</div>
@stop