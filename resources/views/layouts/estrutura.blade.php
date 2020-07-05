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

    <body>

        <div align="center"><b>DINARI</b><br>Teste: <i>API: Laravel</i></div><br>

        @yield('content') <!-- Posiciona a section do doc --> 
        @stack('scripts') <!-- Scripts da página -->              
         
    </body>    
</html>