@extends('layouts.estrutura')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center' style='font-size:18px' align='center'><b>Listagem de Clientes</b></div>    

                <div class="col-md-12" style="margin-bottom:10px" align="right">
                    <br>
                    <button type="button" class="btn btn-info" onclick="window.location='cadastro_clientes'">
                    <span class="glyphicon glyphicon-user"></span>&nbsp;Cadastrar Cliente
                    </button>                     
                </div>          
                
                <div class="panel-body">                                         
                    <table id="example" class="table table-bordered table-hidaction table-hover"  cellspacing="0" width="100%">
                       <thead>
                            <tr>
                                <th style='width:1%; color:white; background-color:#1d2939;font-size:13px;'>Id</th>  
                                <th style='width:62%; color:white; background-color:#1d2939;font-size:13px'>Nome</th>  
                                <th style='width:10%; color:white; background-color:#1d2939;font-size:13px'>Cpf</th>  
                                <th style='width:10%; color:white; background-color:#1d2939;font-size:13px'>Cnpj</th>   
                                <th style='width:9%; color:white; background-color:#1d2939;font-size:13px'>Ações</th>                                                                             
                            </tr>  
                       </thead>                                                          
                    </table>               

                </div>
            </div>         
      
        </div>
        
    </div>
@endsection

@if (strstr(session('message'), 'sucesso')) {
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:45%;left:40%;background-color:green;color:white;z-index:100' align='center'>
       {{ session('message') }}
    </div>    
@endif

@if (strstr(session('message'), 'Erro')) {
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:45%;left:40%;background-color:red;color:white;z-index:100' align='center'>
       {{ session('message') }}
    </div>  
@endif

@if (strstr(session('message'), 'consta')) {
    <div class="alert alert-success alert-dismissible" id='msg' style='width:320px;height:50px;position:fixed;top:45%;left:40%;background-color:orange;color:black;z-index:100' align='center'>
       {{ session('message') }}
    </div>  
@endif

@push ('scripts')
    <!-- DataTables -->    
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>   

  
        
    <script>
            source='{{ url('listagem_de_clientes_dat') }}';
            $(function() {
                $('#example').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: source,
                    columns: [
                                { data: 'id', name: 'id' }, 
                                { data: 'nome', name: 'nome' }, 
                                { data: 'cpf', name: 'cpf' },    
                                { data: 'cnpj', name: 'cnpj' },    
                                                           
                                {
                                    "data": "action",
                                    "render": function(data, type, row, meta){
                                        return "<button type='button' class='btn-warning btn-xs' title='Alterar' onclick='alterar_id("+row.id+")'>Alterar</button> <button type='button' class='btn-danger btn-xs' title='Alterar' onclick='excluir_id("+row.id+")'>Excluir</button>";
                                    }
                                }   
                            ],
                    
                    language: {                    
                        lengthMenu: "Mostrar _MENU_ registros por página",
                        search: "Pesquisar:",
                        info: "Mostrando (_START_ de _END_), de um total de _TOTAL_, registros",
                        ZeroRecords:    "Não foi encontrado registros",
                        EmptyTable:     "Nenhum dado disponível nessa tabela",
                        paginate: {                     
                        previous: "Anterior",
                        next:     "Próximo",                                           
                    },
                

                    }

                });
            });

    </script>

    <script>
        function alterar_id(id){
            window.location='alterar_clientes/'+id;  
        }
        function excluir_id(id){
            window.location='excluir_clientes/'+id;  
        }
    </script>

    <script>
        setTimeout(function() {     
            $('#msg').fadeOut(1500);        
        },1500);
    </script>
@endpush