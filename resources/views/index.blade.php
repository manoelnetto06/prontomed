@extends('layout.app')

@section('body')

<div class="jumbotron bg-light border border-secondary">
    <div class="row">
        <div class="card-deck">
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de Pacientes</h5>
                    <p class="card=text">
                        Cadastre os Pacientes
                    </p>
                    <a href="/pacientes" class="btn btn-primary">Cadastre seus Pacientes</a>
                </div>
            </div>
            <div class="card border border-primary">
                <div class="card-body">
                    <h5 class="card-title">Cadastro de Agendamentos</h5>
                    <p class="card=text">
                        Cadastre os Agendamentos das Consultas
                    </p>
                    <a href="/agendamentos" class="btn btn-primary">Cadastre seus Agendamentos</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
