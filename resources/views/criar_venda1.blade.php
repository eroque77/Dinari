@extends('layouts.estrutura')

@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" align='center' style='font-size:18px' align='center'><b>Pedido de Venda [<i class='text-success'>Finalizado</i>]</b></div>  
                <br>
             
                <div class="col-md-3 col-md-offset-2">
                    <br>
                    <b>Cliente</b>
                    <select class="form-control" id="cliente" name="cliente" disabled autofocus style='width:330px'>
                        @foreach($lista_de_clientes as $cli)
                            <option value="{{$cli->id}}">{{$cli->nome}}</option>
                        @endforeach
                    </select>   
                    <br>                                
                </div>  
                                                       
                <div class="col-md-8 col-md-offset-2" align="left">                                                        
                    <table id="example" class="table table-bordered table-hidaction table-hover" cellspacing="0" width="100%">
                       <thead>
                            <tr>
                                <th style='width:1%; color:white; background-color:#1d2939;font-size:13px;'>Id</th>  
                                <th style='width:60%; color:white; background-color:#1d2939;font-size:13px'>Produto</th>
                                <th style='width:3%; color:white; background-color:#1d2939;font-size:13px'>Qtde</th>
                                <th style='width:8%; color:white; background-color:#1d2939;font-size:13px'>Valor</th>                                                                                                           
                            </tr>  
                       </thead> 
                       <tbody>
                            @foreach($dados_itens as $value)
                                <tr>                              
                                    <td>{{$value['id']}}</td>
                                    <td>{{$value['descricao']}}</td>
                                    <td>{{$value['qtde_vendida']}}</td>
                                    <td>{{$value['valor_produto']}}</td>                               
                                </tr> 
                            @endforeach
                        </tbody>                                                         
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
                    <button type="button" class="btn btn-warning" onclick="window.location='{{ route('listagem_de_vendas') }}';">
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

