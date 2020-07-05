<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class Produtos extends Model
{
    protected $fillable = [
        'descricao', 'valor', 'quantidade_est',  //Campos a serem inseridos no BD
    ];

    //protected $hidden = ['nome']; //Não exibe a variável nome no retorno;


    //Métodos do Crud-----------------------------------------------------|
    public function allProducts(){
        return self::all();
    }

    public function saveProducts(){
        $input = Input::all(); //Retorna um array tudo que foi enviado
        //dd($input);
        $produto = new Produtos(); 
        $produto->fill($input);   //Usando Mass Assignment, salva no banco já associando o que veio do array [Só pode sr utilizado se houver $fillable]
             /* Equivalente:
                $cliente->nome = $input['nome'];
                $cliente->cpf = $input['cpf'];
                $cliente->cnpj = $input['cnpj'];
            */

        //Criptografar um Password
        //$input['password']=Hash::make($input['password']);          

        $produto->save();
        return $produto;       
    }

    public function getproduct($id){
        $prd = self::find($id);
        if(is_null($prd)){
            return false;
        }
        return $prd;
    }

    public function delproducts($id){
        $prd = self::find($id);
        if(is_null($prd)){
            return false;
        }
        return $prd->delete();
    }

    public function updateproducts($id){
        $prd = self::find($id);
        if(is_null($prd)){
            return false;
        }

        $input = Input::all(); //Retorna um array tudo que foi enviado
        $prd->fill($input);   //Usando Mass Assignment, salva no banco já associando o que veio do array [Só pode sr utilizado se houver $fillable]
        $prd->save();
        return $prd;        
    }

}