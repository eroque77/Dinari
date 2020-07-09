<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Clientes; //Carregando a Model Clientes
use App\Produtos; //Carregando a Model Produtos

class CrudController extends Controller
{
    
    public function __construct(){
        date_default_timezone_set('America/Sao_Paulo');
    }

    //CLIENTE--------------------------------------------------------------------------------------------------|
    
    //Inclui Cliente
    public function incluir_clientes(Request $request){
        /*$clientes = new Clientes(); //Model linkada com a classe Clientes      
        $clientes->nome = $request->nome;         
        
        if(strlen($request->cpf)<=11){
            $clientes->cpf = $request->cpf;
            $clientes->cnpj = '';   
        }else{
            $clientes->cpf = '';
            $clientes->cnpj = $request->cpf;
        }
         
        if($clientes->save()){
            return redirect()->route('cadastro_clientes')->with('message', "Cliente cadastrado com sucesso!");
        }
        return redirect()->route('cadastro_clientes')->with('message', "Erro ao cadastrar o cliente!");*/        
        
        $clientes_nome = $request->nome;         
        
        if(strlen($request->cpf)<=11){
            $clientes_cpf = $request->cpf;
            $clientes_cnpj = '-';   
        }else{
            $clientes_cpf = '-';
            $clientes_cnpj = $request->cpf;
        }
             
        $data=array(
            'nome' => $clientes_nome,
            'cpf' => $clientes_cpf, 
            'cnpj' => $clientes_cnpj,          
        );     
        
        $url = 'localhost/Dinari/clientes';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
       
        if($response_json){
            return redirect()->route('cadastro_clientes')->with('message', "Cliente cadastrado com sucesso!");
        }
        return redirect()->route('cadastro_clientes')->with('message', "Erro ao cadastrar o cliente!");


     }

     //Tela de Alteração
     public function alterar_clientes($id){
        $url = 'localhost/Dinari/clientes/'.$id;
        $ch = curl_init ($url);
        curl_setopt ($ch, CURLOPT_HTTPGET, true);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode ($response_json, true);
        return view('cadastro_de_clientes',compact('response'));
     }

     //Alterar Clientes
     public function alterar_clientes1(Request $request){
        $input = Input::all();        
        $url = 'localhost/Dinari/clientes/'.$request->id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($input));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close ($ch);
        $response = json_decode ($response_json, true);
        if($response!=null){
            return redirect()->route('listagem_de_clientes')->with('message', "Cliente alterado com sucesso!");            
        }
        return redirect()->route('listagem_de_clientes')->with('message', "Erro ao atualizar o cliente!");       
     }

     public function excluir_clientes($id){
        $url = 'localhost/Dinari/clientes/'.$id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);

        if($response!=null){
            if($response['response']=="Cliente Já consta em uma venda!"){
                return redirect()->route('listagem_de_clientes')->with('message', $response['response']);   
            }else{
                return redirect()->route('listagem_de_clientes')->with('message', "Cliente removido com sucesso!"); 
            }           
        }
        return redirect()->route('listagem_de_clientes')->with('message', "Erro ao excluir o cliente!");       
     }

    //PRODUTO--------------------------------------------------------------------------------------------------|
    
    //Inclui Produto
    public function incluir_produtos(Request $request){
        /*$produtos = new Produtos(); //Model linkada com a classe Produtos      
        $produtos->descricao = $request->descricao;   
        $produtos->valor = $request->valor;
        $produtos->quantidade_est = $request->quantidade_est;   
        if($produtos->save()){
            return redirect()->route('cadastro_produtos')->with('message', "Produto cadastrado com sucesso!");
        }
        return redirect()->route('cadastro_produtos')->with('message', "Erro ao cadastrar o produto!"); */

        $produtos_descricao = $request->descricao; 
        $produtos_valor = $request->valor; 
        $produtos_quantidade_est = $request->quantidade_est;         
        
        $data=array(
            'descricao' => $produtos_descricao,
            'valor' => $produtos_valor, 
            'quantidade_est' => $produtos_quantidade_est,          
        );     
        
        $url = 'localhost/Dinari/produtos';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
       
        if($response_json){
            return redirect()->route('cadastro_produtos')->with('message', "Produto cadastrado com sucesso!");
        }
        return redirect()->route('cadastro_produtos')->with('message', "Erro ao cadastrar o produto!");

     }

     //Tela de Alteração
     public function alterar_produtos($id){
        $url = 'localhost/Dinari/produtos/'.$id;
        $ch = curl_init ($url);
        curl_setopt ($ch, CURLOPT_HTTPGET, true);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode ($response_json, true);
        return view('cadastro_de_produtos',compact('response'));
     }

     //Alterar Clientes
     public function alterar_produtos1(Request $request){
        $input = Input::all();        
        $url = 'localhost/Dinari/produtos/'.$request->id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($input));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close ($ch);
        $response = json_decode ($response_json, true);
        if($response!=null){
            return redirect()->route('listagem_de_produtos')->with('message', "Produto alterado com sucesso!");            
        }
        return redirect()->route('listagem_de_produtos')->with('message', "Erro ao atualizar o produto!");       
     }

     public function excluir_produtos($id){
        $url = 'localhost/Dinari/produtos/'.$id;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response_json = curl_exec($ch);
        curl_close($ch);
        $response=json_decode($response_json, true);

        if($response!=null){
            if($response['response']=="Este item já consta em uma venda!"){
                return redirect()->route('listagem_de_produtos')->with('message', $response['response']);   
            }else{
                return redirect()->route('listagem_de_produtos')->with('message', "Produto removido com sucesso!"); 
            }           
        }
        return redirect()->route('listagem_de_produtos')->with('message', "Erro ao excluir o produto!");     
     }

     //VENDA---------------------------------------------------------------------------------------------------|

}
