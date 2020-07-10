@extends('layouts.estrutura')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center' style='font-size:18px' align='center'><b>Listagem de Vendas</b></div>  

                <div class="col-md-12" style="margin-bottom:10px" align="right">
                    <br>
                    <button type="button" class="btn btn-info" onclick="window.location='criar_venda'">
                    <span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Criar Venda
                    </button>                     
                </div>          

                <div class="panel-body">              
                                       
                    <table id="example" class="table table-bordered table-hidaction table-hover" cellspacing="0" width="100%">
                       <thead>
                            <tr>
                                <th style='width:2%; color:white; background-color:#1d2939;font-size:13px;'>Id</th>  
                                <th style='width:65%; color:white; background-color:#1d2939;font-size:13px'>Nome</th>  
                                <th style='width:6%; color:white; background-color:#1d2939;font-size:13px'>Total Venda</th>  
                                <th style='width:12%; color:white; background-color:#1d2939;font-size:13px'>Data Finalização</th>  
                                <th style='width:4%; color:white; background-color:#1d2939;font-size:13px'>Ações</th>                                                                             
                            </tr>  
                       </thead>                                                          
                    </table>               

                </div>
            </div>         

            <div class="col-md-12 text-success" align='right'>
                <div id='total'><b>Total de Vendas:&nbsp;</b>{{$valor_total[0]['valor']}}</div>
                <br>
            </div>
            
      
        </div>
        
    </div>
@endsection

@push ('scripts')
    <!-- DataTables -->    
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>   
        
    <script>
            source='{{ url('listar_vendas') }}';
            $(function() {
                $('#example').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: source,
                    columns: [
                                { data: 'id', name: 'id' }, 
                                { data: 'nome', name: 'nome' }, 
                                { data: 'soma_produtos', name: 'soma_produtos' },    
                                { data: 'data_finalizacao', name: 'data_finalizacao' },    
                                                           
                                {
                                    "data": "action",
                                    "render": function(data, type, row, meta){
                                        return "<button type='button' class='btn-warning btn-xs' title='Alterar' onclick='consultar_venda("+row.id+")'>Detalhes</button>";
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
                    }
                    }

                });
            });

    </script>

    <script>
        function consultar_venda(id){
            window.location='consultar_venda/'+id;  
        }      
    </script>

    <script>
        setTimeout(function() {     
            $('#msg').fadeOut(1500);        
        },1500);
    </script>

@endpush

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


