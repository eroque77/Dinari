<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Clientes; //Carregando a Model Clientes
use App\Produtos; //Carregando a Model Produtos
use App\Itens_da_venda; //Carregando a Model Itens_da_venda
use App\Venda; //Carregando a Model Venda
use Illuminate\Support\Facades\Input;
use Response;
use DB;

class Api_DinariController extends Controller
{
   
    protected $client = null; // [Variável estará disponível aos métodos dessa classe]
    protected $product = null;
    protected $itens = null;
    protected $venda = null;
    public function __construct(Clientes $client, Produtos $product, Itens_da_venda $itens, Venda $venda){   //DI - Injeção de dependência da Model na variavel $client
        $this->client = $client; //Usando os métodos da model clientes
        $this->product = $product; //Usando os métodos da model produtos
        $this->itens = $itens; //Usando os métodos da model itens_da_venda
        $this->venda = $venda; //Usando os métodos da model venda
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
        //Se cliente estiver em uma venda
        $cli_venda = Venda::select ('id')->where('id_cliente', '=', $id)->get();
        if($cli_venda->count()>0){ 
            return Response::json(['response'=>'Cliente Já consta em uma venda!'],400);
        }        
        
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
        //Se produto estiver em um item de venda
        $prd_venda = Itens_da_venda::select ('id')->where('id_produto', '=', $id)->get();
        if($prd_venda->count()>0){ 
            return Response::json(['response'=>'Este item já consta em uma venda!'],400);
        }      
                
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

    //VENDA--------------------------------------------------------------------------------------------------------------------------------|

    //Incluir Item de Venda
    public function save_itens_venda()
    {
        $it= $this->itens->saveItensVenda();
        
        if(!$it){
            return Response::json(['response'=>0]);
        }else{
            return Response::json(['response'=>1]);
        }        
    }

    //Listar todos os itens de venda
    public function all_itens_venda()
    {
        return Response::json($this->itens->allItensVenda(), 200);
    }

    public function delete_products_venda($id){
        $it = Itens_da_venda::find($id);
        if(is_null($it)){
            return Response::json(['response'=>0]);
        }
        $it->delete();
        return Response::json(['response'=>1]);
    }

    public function finalizar_venda(){
        date_default_timezone_set('America/Sao_Paulo');
        $input = Input::all(); //Retorna um array tudo que foi enviado
        //dd($input);
        $venda = new Venda(); 
        $venda->fill($input);          

        if($venda->save()){
            Itens_da_venda::where('status', 0)->update(['status' => $venda->id]);

            //Atualizando Estoque [Subtraindo]
            $lista_de_itens = Itens_da_Venda::select('id_produto','qtde_vendida')->where('status', '=', $venda->id)->get();
            foreach($lista_de_itens as $value){
                Produtos::where('id', $value->id_produto)->decrement('quantidade_est',$value->qtde_vendida);              
            }

            return Response::json(['response'=>1]);
        }else{
            return Response::json(['response'=>0]);
        }
    }

    public function all_itens_venda_ok(){
        return Response::json($this->venda->allItensVendaOk(), 200);
    }

    public function get_venda($id){
        $venda = $this->venda->getvenda($id);  
        if(!$venda){
            return Response::json(['response'=>'Venda não encontrada'],400);
        } 


        //Retorna os itens comprados pelo cliente
        $dados_itens = Itens_da_venda::select ('itens_da_venda.id', 'descricao', 'valor_produto', 'qtde_vendida')          
        ->join('produtos', 'itens_da_venda.id_produto', '=', 'produtos.id')
        ->where('itens_da_venda.status', '=', $venda->id)
        ->get();   
        
        return Response::json(['venda'=>$venda, 'dados'=>$dados_itens], 200);

        //return Response::json($venda, 200);
    }  

    
}