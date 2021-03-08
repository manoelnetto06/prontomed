@extends('layout.app')

@section('body')

<?php
     if(count($consultas) > 0){
        $array = array(
            "Data Nascimento" => date("d/m/Y", strtotime($consultas[0]->paciente->dataNascimento)) ,
            "Sexo" => $consultas[0]->paciente->sexo,
            "Telefone" => $consultas[0]->paciente->telefone,
            "Altura" => $consultas[0]->paciente->altura,
            "Peso" => $consultas[0]->paciente->peso
        );
     }

?>
    @if(count($consultas) > 0)
        <div class="card">
            <h2 class="card-header">Paciente {{ $consultas[0]->paciente->nome }} - Código {{ $consultas[0]->paciente->id }} </h2>
            <div class="row">
                @foreach($array as $chave => $valor)
                    <div class="col">
                        <div class="card-body">
                            <h5 style="font-weight:bold" class="card-title">{{ $chave }}</h5>
                            <p class="card-text">{{ $valor }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <br>

    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Anotações das Consultas</h5>

            <table class="table table-ordered table-hover" id="tabelaConsultas">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Data</th>
                        <th>Atendimento</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <button class="btn btn-sm btn-primary btn-space" onClick="novaAnotacao({{ $id }})" role="button">Inserir</button>
            <a href="/pacientes" class="btn btn-sm btn-secondary" role="button">Voltar</a>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgConsulta">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formConsulta">
                    <div class="modal-header">
                        <h5 class="modal-title">Inserir Anotações</h5>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">
                        <input type="hidden" id="paciente_id" class="form-control">

                        <div class="form-group">
                            <label for="anotacoesConsulta" class="control-label">Anotações da Consulta</label>

                            <div class="input-group">
                                <textarea id="anotacoesConsulta" rows="10" cols="60" required>
                                </textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dataConsulta" class="control-label">Data da Consulta</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="dataConsulta" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="cancel" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                     </div>
                </form>


            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script type="text/javascript">

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        function novaAnotacao(paciente_id) {
            $('#id').val('');
            $('#anotacoesConsulta').val('');
            $('#dataConsulta').val('');

            $('#paciente_id').val(paciente_id);

            $('#dlgConsulta').modal('show')
        }

        function carregarAgendamentos() {
            $.getJSON('/api/agendamentos', function(data) {
                for(i = 0; i < data.length; i++) {
                    opcao = '<option value ="' + data[i].id + '">' + data[i].nome + '</option>';

                    $('#categoriaPaciente').append(opcao);
                }
            });
        }

        function carregarConsultas(id) {
            $.getJSON('/api/consultas/' + id, function(consultas) {
                console.log(consultas);

                for(i = 0; i < consultas.length; i++)
                {
                    linha = montarLinha(consultas[i]);

                    $('#tabelaConsultas>tbody').append(linha);
                }
            });
        }

        function dateToEN(date)
        {
            return date.split('-').reverse().join('/');
        }

        function montarLinha(p) {
            var linha = "<tr>" +
                "<td>" + p.id + "</td>" +
                "<td>" + dateToEN(p.data) + "</td>" +
                "<td>" + p.atendimento + "</td>" +
                "<td>" +
                    '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
                    '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id + ')"> Excluir </button> ' +
                "</td>" +
                "</tr>";

            return linha;
        }

        function editar(id) {
            $.getJSON('/api/consultas/' + id + "/edit", function(data) {
                console.log(data);
                $('#id').val(data.id);
                $('#paciente_id').val(data.paciente_id);
                $('#dataConsulta').val(data.data);
                $('#anotacoesConsulta').val(data.atendimento);

                $('#dlgConsulta').modal('show');
            });
        }

        function salvarConsulta() {
            cons = {
                id : $("#id").val(),
                paciente_id : $("#paciente_id").val(),
                data: $("#dataConsulta").val(),
                atendimento: $("#anotacoesConsulta").val()
            };

            $.ajax({
                type: "PUT",
                url: "/api/consultas/" + cons.id,
                context: this,
                data: cons,
                success: function(data) {
                    cons = JSON.parse(data);

                    linhas = $("#tabelaConsultas>tbody>tr");

                    e = linhas.filter( function(i, e) {
                        return ( e.cells[0].textContent == cons.id );
                    });

                    if (e)
                    {
                        e[0].cells[1].textContent = dateToEN(cons.data);
                        e[0].cells[2].textContent = cons.atendimento;
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function remover(id) {
            $.ajax({
                type: "DELETE",
                url: "/api/consultas/" + id,
                context: this,
                success: function() {
                    linhas = $("#tabelaConsultas>tbody>tr");

                    e = linhas.filter( function(i, elemento) {
                        return elemento.cells[0].textContent == id;
                    });

                    if (e)
                        e.remove();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function criarConsulta() {
            con = {
                data: $("#dataConsulta").val(),
                atendimento: $("#anotacoesConsulta").val(),
                paciente_id: $("#paciente_id").val()
            };

            $.post("/api/consultas", con, function(data) {
                consulta = JSON.parse(data);

                linha = montarLinha(consulta);

                $('#tabelaConsultas>tbody').prepend(linha);
            });
        }

        $("#formConsulta").submit( function(event){
            event.preventDefault();

            if ($("#id").val() != '')
                salvarConsulta();
            else
                criarConsulta();

            $("#dlgConsulta").modal('hide');
        });

        $(function(){
            carregarConsultas(<?php echo $id; ?>);
        })

    </script>
@endsection

