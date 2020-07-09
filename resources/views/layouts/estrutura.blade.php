<!DOCTYPE html>
<html>
    <head>
        <!-- Jquery -->
        <script src="//code.jquery.com/jquery.js"></script>

        <title>Dinari - Teste</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">  
        <!-- Bootstrap JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
        <!-- Datatables -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css"> 
    </head>

    <style>
        td{
            vertical-align:middle !important;        
        }  

        #example td:first-child {text-align:center;}
    </style>

    <body style='overflow-x:hidden'>

        <div align="center"><b>DINARI</b><br>Teste: <i>API: Laravel</i></div><br>


        <!--MENU FIXO -->
        <div class="row">
            <div class="panel panel-default">
                <div class="col-md-2" align='center'>

                </div>
                <div class="col-md-3 panel-default" align='center'>
                    <ul class="nav navbar-nav navbar-center bg-danger">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Cadastros
                            </a>
                            <ul class="dropdown-menu" role="menu"  style='width:250px'>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <div style='margin-left:18px'><a href="{{route('cadastro_clientes')}}">Cadastro de Clientes</a></div>
                                </a>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <div style='margin-left:18px'><a href="{{route('listagem_de_clientes')}}">Listagem de Clientes</a></div>
                                </a>
                            </ul>               
                        <li>
                    </ul>

                    <ul class="nav navbar-nav navbar-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Produtos
                            </a>
                            <ul class="dropdown-menu" role="menu"  style='width:250px'>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <div style='margin-left:18px'><a href="{{route('cadastro_produtos')}}">Cadastro de Produtos</a></div>
                                </a>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <div style='margin-left:18px'><a href="{{route('listagem_de_produtos')}}">Listagem de Produtos</a></div>
                                </a>
                            </ul>               
                        <li>
                    </ul>

                    <ul class="nav navbar-nav navbar-center">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Venda
                            </a>
                            <ul class="dropdown-menu" role="menu"  style='width:250px'>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <div style='margin-left:18px'><a href="{{route('criar_venda')}}">Criar Venda</a></div>
                                </a>   
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" >
                                    <div style='margin-left:18px'><a href="{{route('listagem_de_vendas')}}">Listagem de Vendas</a></div>
                                </a>                      
                            </ul>               
                        <li>
                    </ul>
                </div>
            </div>
        </div>

        <!--FIM MENU FIXO -->




        @yield('content') <!-- Posiciona a section do doc --> 
        @stack('scripts') <!-- Scripts da página -->              
         
    </body>    
</html>
