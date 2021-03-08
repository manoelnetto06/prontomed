@extends('layout.app')

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Agendamentos</h5>

            <table class="table table-ordered table-hover" id="tabelaAgendamentos">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Paciente</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <button class="btn btn-sm btn-primary" onClick="novoAgendamento()" role="button">Inserir</a>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgAgendamento">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="form-horizontal" id="formAgendamento">
                    <div class="modal-header">
                        <h5 class="modal-title">Inserir Agendamento</h5>
                    </div>

                    <div class="modal-body">
                        <input type="hidden" id="id" class="form-control">

                        <div class="form-group">
                            <label for="paciente" class="control-label">Nome do Paciente</label>
                            <div class="input-group">
                                <select class="form-control" id="paciente" required>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dataAgendamento" class="control-label">Data</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="dataAgendamento" required>
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

        function novoAgendamento() {
            $('#id').val('');
            $('#paciente').val('');
            $('#dataAgendamento').val('');

            $('#dlgAgendamento').modal('show');
        }

        function carregarPacientes() {
            $.getJSON('/api/pacientes', function(data) {
                for(i = 0; i < data.length; i++) {
                    opcao = '<option value ="' + data[i].id + '">' + data[i].nome + '</option>';

                    $('#paciente').append(opcao);
                }
            });
        }

        function carregarAgendamentos() {
            $.getJSON('/api/agendamentos', function(pacientes) {
                for(i = 0; i < pacientes.length; i++)
                {
                    linha = montarLinha(pacientes[i]);

                    $('#tabelaAgendamentos>tbody').append(linha);
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
                "<td>" + p.paciente.nome + "</td>" + //paciente_id
                "<td>" + dateToEN(p.data) + "</td>" +
                "<td>" +
                    '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
                    '<button class="btn btn-sm btn-danger" onclick="remover(' + p.id + ')"> Excluir </button> ' +
                "</td>" +
                "</tr>";

            return linha;
        }

        function editar(id) {
            $.getJSON('/api/agendamentos/' + id + "/edit", function(data) {
                $('#id').val(data.id);
                $('#paciente').val(data.paciente_id);
                $('#dataAgendamento').val(data.data);

                $('#dlgAgendamento').modal('show');
            });
        }

        function salvarAgendamento() {
            agend = {
                id : $("#id").val(),
                data: $("#dataAgendamento").val(),
                paciente_id: $("#paciente").val(),
            };

            $.ajax({
                type: "PUT",
                url: "/api/agendamentos/" + agend.id,
                context: this,
                data: agend,
                success: function(data) {
                    agend = JSON.parse(data);

                    linhas = $("#tabelaAgendamentos>tbody>tr");

                    e = linhas.filter( function(i, e) {
                        return ( e.cells[0].textContent == agend.id );
                    });

                    if (e)
                    {
                        e[0].cells[1].textContent = agend.paciente.nome;
                        e[0].cells[2].textContent = dateToEN(agend.data);
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
                url: "/api/agendamentos/" + id,
                context: this,
                success: function() {
                    linhas = $("#tabelaAgendamentos>tbody>tr");

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

        function criarAgendamento() {
            agend = {
                data: $("#dataAgendamento").val(),
                paciente_id: $("#paciente").val()
            };

            $.post("/api/agendamentos", agend, function(data) {
                agendamento = JSON.parse(data);

                console.log(agendamento);

                linha = montarLinha(agendamento);

                $('#tabelaAgendamentos>tbody').prepend(linha);
            });
        }

        $("#formAgendamento").submit( function(event){
            event.preventDefault();

            if ($("#id").val() != '')
                salvarAgendamento();
            else
                criarAgendamento();

            $("#dlgAgendamento").modal('hide');
        });

        $(function(){
            carregarAgendamentos();
            carregarPacientes();
        })

    </script>
@endsection
