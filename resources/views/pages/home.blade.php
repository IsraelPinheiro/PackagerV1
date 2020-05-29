@extends('layouts.app')
@section('content')
    <div class="row d-flex justify-content-center module stats">
        <div class="col-xl-3 col-md-6 mb-4 text-center">
            <div class="counter pt-3">
                <div class="number"> <span class="count">{{ $received->where("new", true)->count() }}</span></div>
                <div class="title mx-auto">Novos Pacotes</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4 text-center">
            <div class="counter pt-3">
                <div class="number"><span class="count">{{ $sent->count() }}</span></div>
                <div class="title mx-auto">Pacotes Enviados</div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4 text-center">
            <div class="counter pt-3">
                <div class="number"> <span class="count">{{ $usedSpace }}</span></div>
                <div class="title mx-auto">Armazenamento Utilizado</div>
            </div>
        </div>
    </div>
@stop