@extends('layouts.estrutura')

@section('content')
<div class="row">
    <div class="panel panel-default">
        <div class="col-md-2" align='center'>

        </div>
        <div class="col-md-2 panel-default" align='center'>
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
                        Consultas
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
        </div>
    </div>

</div>
@endsection