@extends ('layouts.estrutura')

<!-- Conteúdo dinâmico para cadastro de Clientes -->

@section ('content')
    <div class='row'>
        <div class="col-md-8 col-md-offset-2" align="center">
            <div class="panel panel-default"> 
                @if (@!$response['id'])
                    <div class="panel-heading" align='center'><b>Cadastro de Produtos</b></div> <!--Sombreamento -->
                    @php ($rota = 'incluir_produtos')
                @else
                    <div class="panel-heading" align='center'><b>Alteração de Produtos</b></div> <!--Sombreamento -->
                    @php ($rota = 'alterar_produtos1')
                @endif

                     <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{route($rota)}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-3 col-md-offset-1 control-label">*Descrição</label>
                                <div class="col-md-6" align="left">
                                    <input id="descricao" type="text" class="form-control" name="descricao" required autofocus style='width:350px' maxlength="50" autocomplete="nope" value="{{@$response['descricao']}}">
                                </div>  
                                <label class="col-md-3 col-md-offset-1 control-label">*Valor</label>
                                <div class="col-md-6" align="left">
                                    <input data-accept-dot="1" id="valor" type="text" class="form-control only-number" name="valor" required autofocus style='width:80px' maxlength="8" autocomplete="nope" value="{{@$response['valor']}}">
                                </div>
                                <label class="col-md-3 col-md-offset-1 control-label">*Quantidade em Estoque</label>
                                <div class="col-md-6" align="left">
                                    <input id="quantidade_est" type="text" class="form-control" name="quantidade_est" required autofocus style='width:70px' maxlength="4" autocomplete="nope" value="{{@$response['quantidade_est']}}">
                                </div>

                                <input id="id" name="id" type="hidden" value="{{@$response['id']}}"> 
                                                              
                                <div class="form-group">
                                    <div class="col-md-12" style="padding-left:75%;padding-top:3%">
                                        <button type="button" class="btn btn-warning" onclick="retornar()">
                                            Retornar
                                        </button>  
                                        
                                        <button type="submit" class="btn btn-success">
                                            @if(!@$response)                                               
                                                Cadastrar                                                
                                            @else
                                                Alterar
                                                <input type='hidden' value='alt' name='tipo' id='tipo'>
                                            @endif
                                        </button>
                                    </div>
                                </div>  

                            </div>
                        </form>
                    </div>
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

@push ('scripts')
    <script>
        setTimeout(function() {     
            $('#msg').fadeOut(1500);        
        },1500);
    </script>
@endpush

@push ('scripts')
    <script>
        function retornar(){
            if($('#tipo').val()=='alt'){
                window.location='{{ route('listagem_de_produtos') }}';
                return false;
            }else{
                window.location='{{ route('start') }}';
            }
        }

        //Só numeros e ponto:
        jQuery(function($) {
            $(document).on('keypress', 'input.only-number', function(e) {
                var $this = $(this);
                var key = (window.event)?event.keyCode:e.which;
                var dataAcceptDot = $this.data('accept-dot');
                var dataAcceptComma = $this.data('accept-comma');
                var acceptDot = (typeof dataAcceptDot !== 'undefined' && (dataAcceptDot == true || dataAcceptDot == 1)?true:false);
                var acceptComma = (typeof dataAcceptComma !== 'undefined' && (dataAcceptComma == true || dataAcceptComma == 1)?true:false);

                    if((key > 47 && key < 58)
                || (key == 46 && acceptDot)
                || (key == 44 && acceptComma)) {
                    return true;
                } else {
                        return (key == 8 || key == 0)?true:false;
                    }
            });
        });
    </script>
@endpush