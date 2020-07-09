@extends ('layouts.estrutura')

<!-- Conteúdo dinâmico para cadastro de Clientes -->

@section ('content')
    <div class='row'>
        <div class="col-md-8 col-md-offset-2" align="center">
            <div class="panel panel-default"> 
                @if (@!$response['id'])
                    <div class="panel-heading" align='center'><b>Cadastro de Clientes</b></div> <!--Sombreamento -->
                    @php ($rota = 'incluir_clientes')
                @else
                    <div class="panel-heading" align='center'><b>Alteração de Clientes</b></div> <!--Sombreamento -->
                    @php ($rota = 'alterar_clientes1')
                @endif

                
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{route($rota)}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-md-3 col-md-offset-1 control-label">*Nome</label>
                                <div class="col-md-6" align="left">
                                    <input id="nome" type="text" class="form-control" name="nome" required autofocus style='width:350px' maxlength="80" autocomplete="nope" value="{{@$response['nome']}}">
                                </div>  
                                <label class="col-md-3 col-md-offset-1 control-label">*Cpf/Cnpj</label>
                                <div class="col-md-6" align="left">
                                    <input id="cpf" type="text" class="form-control" name="cpf" required autofocus style='width:200px' maxlength="14" autocomplete="nope" value="{{@$response['cpf']}}">
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
                window.location='{{ route('listagem_de_clientes') }}';
                return false;
            }else{
                window.location='{{ route('start') }}';
            }
        }

        //Só numeros:
        $('#cpf').keyup(function() {
            $(this).val(this.value.replace(/\D/g, ''));
        });
        
    </script>
@endpush