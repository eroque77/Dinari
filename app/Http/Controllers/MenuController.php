<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;

use App\Clientes; //Carregando a Model Clientes
use App\Produtos; //Carregando a Model Produtos
use App\Itens_da_venda; //Carregando a Model Itens_da_venda
use App\Venda; //Carregando a Model Itens_da_venda
use Yajra\Datatables\Datatables;

/*Datatables
   composer require yajra/laravel-datatables-oracle:"~7.0"
   config / app.php

   'providers' => [  
      ....
      Yajra\Datatables\DatatablesServiceProvider::class ,
   ]
   'aliases' => [  
      ....
      'Datatables' => Yajra\Datatables\Facades\Datatables::class,     
*/

class MenuController extends Controller
{
   
    public function cadastro_de_clientes(){
        return view('cadastro_de_clientes');
    } 

    public function cadastro_de_produtos(){
        return view('cadastro_de_produtos');
    } 

    public function listagem_de_clientes(){                        
        return view('listagem_de_clientes');
    }

    public function listagem_de_clientes_dat(){     
        $url = 'localhost/Dinari/clientes';
        $ch = curl_init ($url);
        curl_setopt ($ch, CURLOPT_HTTPGET, true);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode ($response_json, true);       
        return Datatables::of($response)->make(true);        
    }

    public function listagem_de_produtos(){                        
        return view('listagem_de_produtos');
    }

    public function listagem_de_produtos_dat(){          
        $url = 'localhost/Dinari/produtos';
        $ch = curl_init ($url);
        curl_setopt ($ch, CURLOPT_HTTPGET, true);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode ($response_json, true);       
        return Datatables::of($response)->make(true);         
    }

    
    public function criar_venda(){
        $lista_de_clientes = Clientes::select ('id','nome')->get();
        $lista_de_produtos = Produtos::select ('id','descricao','valor')->get();       
        $valor_total_venda= Itens_da_venda::select (DB::raw('sum(valor_produto*qtde_vendida) as valor'))->where('status', '=', 0)->get();          
        $soma_produtos= Itens_da_venda::select (DB::raw('sum(qtde_vendida) as qtde'))->where('status', '=', 0)->get();  

        return view('criar_venda', compact('lista_de_clientes', 'lista_de_produtos', 'valor_total_venda','soma_produtos'));        
    }

    public function itens_da_venda(Request $request){
        $id_produto = $request->produto; 
        $id_cliente = $request->id_cliente; 
        $valor_produto=$request->valor_produto;                                         
        $qtde_vendida = $request->qtde_vendida;
        
        $data=array(
            'id_produto' => $id_produto,
            'id_cliente' => $id_cliente, 
            'valor_produto' => $valor_produto,
            'qtde_vendida' => $qtde_vendida,   
        );     
        
        $url = 'localhost/Dinari/vendas';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        //$response=json_decode($response_json, true); 

        echo $response_json;  

    }

    public function listagem_de_itens_da_venda(){     
        $url = 'localhost/Dinari/vendas';
        $ch = curl_init ($url);
        curl_setopt ($ch, CURLOPT_HTTPGET, true);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode ($response_json, true);  
        return Datatables::of($response)->make(true);        
    }

    public function excluir_itens_da_venda($id){
        $url = 'localhost/Dinari/vendas/'.$id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        //$response=json_decode($response_json, true);
        echo $response_json;
    }

    public function finalizar_venda(Request $request){
        date_default_timezone_set('America/Sao_Paulo');
        $id_cliente = $request->id_cliente; 
        $soma_total = $request->soma_total; 
               
        $data=array(
            'id_cliente' => $id_cliente, 
            'soma_produtos' => $soma_total, 
            'data_finalizacao' => date('d-m-Y H:i:s'),             
        );     
        
        $url = 'localhost/Dinari/venda';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        //$response=json_decode($response_json, true); 
        echo $response_json;              
    }

    public function listar_vendas(){     
        $url = 'localhost/Dinari/venda';
        $ch = curl_init ($url);
        curl_setopt ($ch, CURLOPT_HTTPGET, true);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode ($response_json, true);       
        return Datatables::of($response)->make(true); 
    }

    public function listagem_de_vendas(){  
        $valor_total = Venda::select (DB::raw('sum(soma_produtos) as valor'))->get();                             
        return view('listagem_de_vendas', compact('valor_total'));
    }

   
    public function consultar_venda($id){
        $url = 'localhost/Dinari/venda/'.$id;
        $ch = curl_init ($url);
        curl_setopt ($ch, CURLOPT_HTTPGET, true);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode ($response_json, true);
        //dd($response);
        //dd($response['venda']['id_cliente']); //Json decodificado
        $dados_itens=$response['dados'];
        //dd($dados_itens);

        $lista_de_clientes = Clientes::select ('id','nome')->where('id', '=', $response['venda']['id_cliente'])->get();
        $lista_de_produtos = Produtos::select ('id','descricao','valor')->get();       
        $valor_total_venda= Itens_da_venda::select (DB::raw('sum(valor_produto*qtde_vendida) as valor'))->where('status', '=', $response['venda']['id'])->get();       
        return view('criar_venda1', compact('lista_de_clientes', 'lista_de_produtos', 'valor_total_venda', 'dados_itens'));          

     }    

}
