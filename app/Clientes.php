<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Clientes extends Model
{
    protected $fillable = [
        'cpf', 'cnpj', 'nome',  //Campos a serem inseridos no BD
    ];

    //protected $hidden = ['nome']; //Não exibe a variável nome no retorno;


    //Métodos do Crud-----------------------------------------------------|
    public function allClients(){
        return self::all();
    }

    public function saveClients(){
        $input = Input::all(); //Retorna um array tudo que foi enviado
        //dd($input);
        $cliente = new Clientes(); 
        $cliente->fill($input);   //Usando Mass Assignment, salva no banco já associando o que veio do array [Só pode sr utilizado se houver $fillable]
             /* Equivalente:
                $cliente->nome = $input['nome'];
                $cliente->cpf = $input['cpf'];
                $cliente->cnpj = $input['cnpj'];
            */

        //Criptografar um Password
        //$input['password']=Hash::make($input['password']);          

        if($cliente->save()){
            return $cliente; 
        }else{
            return false;
        }      
    }

    public function getclient($id){
        $cli = self::find($id);
        if(is_null($cli)){
            return false;
        }
        return $cli;
    }

    public function delclients($id){
        $cli = self::find($id);
        if(is_null($cli)){
            return false;
        }
        return $cli->delete();
    }

    public function updateclients($id){
        $cli = self::find($id);
        if(is_null($cli)){
            return false;
        }

        $input = Input::all(); //Retorna um array tudo que foi enviado
        $cli->fill($input);   //Usando Mass Assignment, salva no banco já associando o que veio do array [Só pode sr utilizado se houver $fillable]
        $cli->save();
        return $cli;        
    }   

}