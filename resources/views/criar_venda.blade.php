@extends('layouts.estrutura')

@section('content')
<div class="row"> 
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center' style='font-size:18px' align='center'><b>Pedido de Venda</b></div>  
                <br>

                <div class="col-md-8 col-md-offset-2" style="margin-bottom:10px" align="left">
                    <br>
                    <button type="button" class="btn btn-info" onclick="window.location='listagem_de_vendas'">
                    <span class="glyphicon glyphicon-list"></span>&nbsp;Vendas
                    </button>                     
                </div>       

                <div class="col-md-3 col-md-offset-2">
                    <br>
                    Cliente
                    <select class="form-control" id="cliente" name="cliente" autofocus style='width:330px'>
                        @foreach($lista_de_clientes as $cli)
                            <option value="{{$cli->id}}">{{$cli->nome}}</option>
                        @endforeach
                    </select>                                   
                </div>  
                <div class="col-md-3">
                    <br>
                    Produto
                    <select class="form-control" id="produto" name="produto" autofocus style='width:330px'>
                        @foreach($lista_de_produtos as $prod)
                            <option id="{{$prod->valor}}" value="{{$prod->id}}">{{$prod->descricao}}</option>                          
                        @endforeach
                    </select>      
                </div> 
                <div class="col-md-1" align="left">
                    <br>
                    Qtde
                    <input id="qtde" name="qtde" type="text" maxlength="5" style='width:50px;height:35px'>   
                    <br><br><br>
                </div> 

                <div class="col-md-1" style="margin-bottom:10px;margin-left:-20px" align="left">
                    <br>
                    &nbsp;
                    <button type="button" class="btn btn-info" onclick="add_itens()">
                    <span class="glyphicon glyphicon-user"></span>&nbsp;Adicionar
                    </button>                     
                </div>     
                                        
                <div class="col-md-8 col-md-offset-2" align="left">                                                        
                    <table id="example" class="table table-bordered table-hidaction table-hover" cellspacing="0" width="100%">
                       <thead>
                            <tr>
                                <th style='width:1%; color:white; background-color:#1d2939;font-size:13px;'>Id</th>  
                                <th style='width:60%; color:white; background-color:#1d2939;font-size:13px'>Produto</th>
                                <th style='width:3%; color:white; background-color:#1d2939;font-size:13px'>Qtde</th>
                                <th style='width:8%; color:white; background-color:#1d2939;font-size:13px'>Valor</th>  
                                <th style='width:5%; color:white; background-color:#1d2939;font-size:13px'>Ações</th>                                                                             
                            </tr>  
                       </thead>                                                          
                    </table>  
                </div>
            </div>
            <br>
            <input type="hidden" id="tott">
            <div class="col-md-8 col-md-offset-2 text-danger" align='right'>
            <br>
                <div id='total'><b>Valor Total da Venda:&nbsp;</b>{{$valor_total_venda[0]['valor']}}</div>
            </div>
            <br>
          
            <div class="form-group">
                <div class="col-md-12" align='center'>
                    <button type="button" class="btn btn-success" onclick="finalizar_venda()">
                        Finalizar
                    </button>                     
                    <button type="button" class="btn btn-warning" onclick="window.location='{{ route('start') }}';">
                        Retornar
                    </button>                     
                </div>
            </div>  
      
        </div>
        
    </div>
@endsection

<div class="alert alert-success alert-dismissible"  id='msg' style='display:none;width:320px;height:50px;position:fixed;top:45%;left:40%;background-color:green;color:white;z-index:100' align='center'>
      Item excluído com sucesso!
</div>  

<div class="alert alert-success alert-dismissible"  id='msg1' style='display:none;width:320px;height:50px;position:fixed;top:45%;left:40%;background-color:green;color:white;z-index:100' align='center'>
      Venda Finalizada com sucesso!
</div>  
<div class="alert alert-success alert-dismissible"  id='msg2' style='display:none;width:320px;height:50px;position:fixed;top:45%;left:40%;background-color:red;color:white;z-index:100' align='center'>
      Erro ao Finalizar a Venda!
</div>  
<div class="alert alert-success alert-dismissible"  id='msg3' style='display:none;width:320px;height:50px;position:fixed;top:45%;left:40%;background-color:orange;color:black;z-index:100' align='center'>
      Estoque do Produto Insuficiente!
</div>  

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

@push ('scripts')
    <!-- DataTables -->    
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>   
        
    <script>
            source='{{ url('listagem_de_itens_da_venda') }}';
            $(function() {
                $('#example').DataTable({
                    processing: false,
                    serverSide: true,
                    ajax: source,
                    columns: [
                                { data: 'id', name: 'id' }, 
                                { data: 'descricao', name: 'descricao' }, 
                                { data: 'qtde_vendida', name: 'qtde_vendida' },
                                { data: 'valor_produto', name: 'valor_produto' },                                 
                                                                                         
                                {
                                    "data": "action",
                                    "render": function(data, type, row, meta){
                                        return "<button type='button' class='btn-danger btn-xs' title='Excluir Item' onclick='excluir_id("+row.id+")'>Excluir</button>";
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
        function excluir_id(id){
            $.ajax({           
                type: "GET",           
                url: 'excluir_itens_da_venda/'+id,
                data: {id:id},
                datatype: 'json',
                success: function(data){
                    var obj = jQuery.parseJSON(data);  
                    if(obj.response==1){
                        document.getElementById('msg').style.display='inline';
                        setTimeout(function(){    
                            location.reload();
                        }, 3000);
                        
                    }                           
                },
                
            });  
        }
    </script>

    <script>
        setTimeout(function() {     
            $('#msg').fadeOut(1500);        
        },1500);
    </script>

    <script>
        soma=0;
        add=0;
        function add_itens(){   
            id_cliente=$("#cliente option:selected").val();
            produto=$("#produto option:selected").val();  
            qtde_vendida=$('#qtde').val();  
            valor_produto=$('#produto option:selected').prop("id"); 

            if(typeof dec === "undefined"){
                dec="<?php echo $valor_total_venda[0]['valor']; ?>";
            }else{
                dec=soma;
            }

            if(!dec){
                dec=0;
            }
                              
            soma=parseFloat(valor_produto)*parseInt(qtde_vendida) + parseFloat(dec);
                                            
            $.ajax({           
                type: "POST",           
                url: '{{ url('itens_da_venda') }}',
                data: {id_cliente:id_cliente,produto:produto,qtde_vendida:qtde_vendida,valor_produto:valor_produto},
                datatype: 'json',
                success: function(data){
                    var obj = jQuery.parseJSON(data);  
                   
                    if(obj.response==1){
                        //$('#example').dataTable().fnDestroy();
                        $('#example').dataTable().fnClearTable();
                        
                        var table = $('#example').DataTable();        
                        table.ajax.url('listagem_de_itens_da_venda').load();  
                        document.getElementById('total').innerHTML='Valor Total da Venda:&nbsp;'+soma.toFixed(2); 
                        $('#tott').val(soma.toFixed(2));   
                        add=add+1;       
                        
                    }  

                    if(obj.response==0) {
                        document.getElementById('msg3').style.display='inline'; 

                        soma=parseFloat(dec);

                        setTimeout(function(){    
                            document.getElementById('msg3').style.display='none';
                        }, 3000);
                    }                        
                },
                
            });            
               
        }


        function finalizar_venda(){
            numrecords=$("#example").dataTable().fnSettings().fnRecordsTotal();
            if(numrecords==0){
                return false;
            }
        
            cliente=$("#cliente option:selected").val();  
            soma_total=$('#tott').val();

            if(add==0){
                soma_total="<?php echo $valor_total_venda[0]['valor']; ?>";
            }
           
            $.ajax({           
                type: "POST",           
                url: '{{ url('finalizar_venda') }}',
                data: {id_cliente:cliente,soma_total:soma_total},
                datatype: 'json',
                success: function(data){
                    var obj = jQuery.parseJSON(data);  
                    if(obj.response==1){
                        document.getElementById('msg1').style.display='inline';
                        setTimeout(function(){    
                            window.location='{{ route('start') }}';
                        }, 3000);                        
                    }else{
                        setTimeout(function(){ 
                            document.getElementById('msg2').style.display='inline';   
                            window.location='{{ route('start') }}';
                        }, 3000); 
                    }                          
                },
                
            });                  
        }  

      //Só numeros:
      $('#qtde').keyup(function() {
            $(this).val(this.value.replace(/\D/g, ''));
        });     

    </script>
@endpush