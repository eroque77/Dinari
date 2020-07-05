<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Clientes; //Carregando a Model Clientes
use App\Produtos; //Carregando a Model Produtos
use Response;

class Api_DinariController extends Controller
{
   
    protected $client = null; // [Variável estará disponível aos métodos dessa classe]
    protected $product = null;
    public function __construct(Clientes $client, Produtos $product){   //DI - Injeção de dependência da Model na variavel $client
        $this->client = $client; //Usando os métodos da model clientes
        $this->product = $product; //Usando os métodos da model produtos
        header ('Content-type: text/html; charset=UTF-8'); 
    }

    //CLIENTES--------------------------------------------------------------------------------------------------------------------------------|

    public function all_users()
    {
        //return Clientes::all(); Retorno Direto
        //Utilizando método da Model
        //return $this->client->allClients(); //Acessando o método allUsers [model clientes] que agora está injetado na variável $this->client 
        return Response::json($this->client->allClients(), 200);
    }
   
    public function save_clients()
    {
        //return $this->client->saveClients();  // Retorno Simples
        return Response::json($this->client->saveClients(),200);  //Retorno com status mais indicado
    }


    public function get_client($id){
        $cliente = $this->client->getclient($id);  
        if(!$cliente){
            return Response::json(['response'=>'Cliente não encontrado'],400);
        } 
        return Response::json($cliente, 200);
    }

    public function delete_clients($id)
    {
        $cli= $this->client->delclients($id);
        if(!$cli){
            return Response::json(['response'=>'Cliente não encontrado'],400);
        } 
        return Response::json(['response'=>'Cliente removido com sucesso!'],200);
    }

    public function update_client($id)
    {
        $cli= $this->client->updateclients($id);
        if(!$cli){
            return Response::json(['response'=>'Cliente não encontrado'],400);
        } 
        return Response::json($cli, 200);;
    }   

    //PRODUTOS--------------------------------------------------------------------------------------------------------------------------------|

    public function all_products()
    {
        return Response::json($this->product->allProducts(), 200);
    }
   
    public function save_products()
    {
        return Response::json($this->product->saveProducts(),200);  //Retorno com status mais indicado
    }

    public function get_product($id){
        $produto = $this->product->getproduct($id);  
        if(!$produto){
            return Response::json(['response'=>'Produto não encontrado'],400);
        } 
        return Response::json($produto, 200);
    }

    public function delete_products($id)
    {
        $prd= $this->product->delproducts($id);
        if(!$prd){
            return Response::json(['response'=>'Produto não encontrado'],400);
        } 
        return Response::json(['response'=>'Produto removido com sucesso!'],200);
    }

    public function update_product($id)
    {
        $prd= $this->product->updateproducts($id);
        if(!$prd){
            return Response::json(['response'=>'Produto não encontrado'],400);
        } 
        return Response::json($prd, 200);;
    }   
    
}