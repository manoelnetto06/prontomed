@extends('layout.app')

@section('body')
    <div class="card border">
        <div class="card-body">
            <h5 class="card-title">Cadastro de Pacientes</h5>

            <table class="table table-ordered table-hover" id="tabelaPacientes">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Data Nascimento</th>
                        <th>Sexo</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <button class="btn btn-sm btn-primary" onClick="novoPaciente()" role="button">Inserir</a>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="dlgPaciente">
        <div class="modal-dialog" role="document">
            <div class="modal-content">


                <form class="form-horizontal" id="formPaciente">
                    <div class="modal-header">
                        <h5 class="modal-title">Inserir Paciente</h5>
                    </div>

                    <div class="modal-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                {{ dd($errors)}}
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>   {{ $error }}  </li>
                                        @endforeach
                                    </ul>
                            </div>
                        @endif

                        <input type="hidden" id="id" class="form-control">

                        <div class="form-group">
                            <label for="nomePaciente" class="control-label">Nome do Paciente</label>
                            <div class="input-group">
                                <input type="text" class="form-control"
                                       name="nomePaciente" id="nomePaciente" placeholder="Nome do Paciente" required>


                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telefonePaciente" class="control-label">Telefone</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="telefonePaciente" name="telefonePaciente" placeholder="Telefone do Paciente" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dataNascPaciente" class="control-label">Data de Nascimento</label>
                            <div class="input-group">
                                <input type="date" class="form-control" id="dataNascPaciente" name="dataNascPaciente" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sexoPaciente" class="control-label">Sexo</label>
                            <div class="input-group">
                                <select class="form-control" id="sexoPaciente" name="sexoPaciente" required>
                                    <option value="Masculino" selected>Masculino</option>
                                    <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alturaPaciente" class="control-label">Altura</label>
                            <div class="input-group">
                                <input type="number" step="any" class="form-control" id="alturaPaciente" name="alturaPaciente" placeholder="Altura do Paciente" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="pesoPaciente" class="control-label">Peso</label>
                            <div class="input-group">
                                <input type="number" step="any" class="form-control" id="pesoPaciente" name="pesoPaciente" placeholder="Peso do Paciente" required>
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

        function novoPaciente() {
            $('#id').val('');
            $('#nomePaciente').val('');
            $('#telefonePaciente').val('');
            $('#dataNascPaciente').val('');
            $('#sexoPaciente').val('');
            $('#alturaPaciente').val('');
            $('#pesoPaciente').val('');

            $('#dlgPaciente').modal('show')
        }

        function carregarAgendamentos() {
            $.getJSON('/api/agendamentos', function(data) {
                for(i = 0; i < data.length; i++) {
                    opcao = '<option value ="' + data[i].id + '">' + data[i].nome + '</option>';

                    $('#categoriaPaciente').append(opcao);
                }
            });
        }

        function carregarPacientes() {
            $.getJSON('/api/pacientes', function(pacientes) {
                for(i = 0; i < pacientes.length; i++)
                {
                    linha = montarLinha(pacientes[i]);

                    $('#tabelaPacientes>tbody').append(linha);
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
                "<td>" + p.nome + "</td>" +
                "<td>" + dateToEN(p.dataNascimento) + "</td>" +
                "<td>" + p.sexo + "</td>" +
                "<td>" + p.telefone + "</td>" +
                "<td>" +
                    '<button class="btn btn-sm btn-primary" onclick="editar(' + p.id + ')"> Editar </button> ' +
                    '<button class="btn btn-sm btn-danger btn-space" onclick="remover(' + p.id + ')"> Excluir </button> ' +
                    '<a href="/consultas/' + p.id + '" class="btn btn-sm btn-success active "> Consultas </a>&nbsp' +
                "</td>" +
                "</tr>";

            return linha;
        }

        function editar(id) {
            $.getJSON('/api/pacientes/'+id, function(data) {
                //console.log(data);
                $('#id').val(data.id);
                $('#nomePaciente').val(data.nome);
                $('#telefonePaciente').val(data.telefone);
                $('#dataNascPaciente').val(data.dataNascimento);
                $('#sexoPaciente').val(data.sexo);
                $('#alturaPaciente').val(data.altura);
                $('#pesoPaciente').val(data.peso);

                $('#dlgPaciente').modal('show');
            });
        }

        function salvarPaciente() {
            pac = {
                id : $("#id").val(),
                nome: $("#nomePaciente").val(),
                telefone: $("#telefonePaciente").val(),
                dataNascimento: $("#dataNascPaciente").val(),
                sexo: $("#sexoPaciente").val(),
                altura: $("#alturaPaciente").val(),
                peso: $("#pesoPaciente").val()
            };

            $.ajax({
                type: "PUT",
                url: "/api/pacientes/" + pac.id,
                context: this,
                data: pac,
                success: function(data) {
                    pac = JSON.parse(data);

                    linhas = $("#tabelaPacientes>tbody>tr");

                    e = linhas.filter( function(i, e) {
                        return ( e.cells[0].textContent == pac.id );
                    });

                    if (e)
                    {
                        e[0].cells[0].textContent = pac.id;
                        e[0].cells[1].textContent = pac.nome;
                        e[0].cells[2].textContent = dateToEN(pac.dataNascimento);
                        e[0].cells[3].textContent = pac.sexo;
                        e[0].cells[4].textContent = pac.telefone;
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
                url: "/api/pacientes/" + id,
                context: this,
                success: function() {
                    console.log('Apagou OK');

                    linhas = $("#tabelaPacientes>tbody>tr");

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

        function criarPaciente() {
            pac = {
                nome: $("#nomePaciente").val(),
                telefone: $("#telefonePaciente").val(),
                dataNascimento: $("#dataNascPaciente").val(),
                sexo: $("#sexoPaciente").val(),
                altura: $("#alturaPaciente").val(),
                peso: $("#pesoPaciente").val()
            };

            $.post("/api/pacientes", pac, function(data) {
                paciente = JSON.parse(data);

                linha = montarLinha(paciente);

                $('#tabelaPacientes>tbody').prepend(linha);
            });
        }

        $("#formPaciente").submit( function(event){
            event.preventDefault();

            if ($("#id").val() != '')
                salvarPaciente();
            else
                criarPaciente();

            $("#dlgPaciente").modal('hide');
        });

        $(function(){
            carregarPacientes();
        })

    </script>
@endsection
