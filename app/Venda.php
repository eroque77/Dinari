<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    
    protected $table = "Venda";
    

    protected $fillable = [
        'soma_produtos', 'id_cliente', 'data_finalizacao',  //Campos a serem inseridos no BD
    ];

    public function allItensVendaOk(){
        //return self::all();

        return Venda::select ('venda.id', 'clientes.nome', 'venda.soma_produtos', 'venda.data_finalizacao')          
            ->join('clientes', 'clientes.id', '=', 'venda.id_cliente')->get();               
        
    }

    public function getvenda($id){
        $vnd = self::find($id);
        if(is_null($vnd)){
            return false;
        }
        return $vnd;
    }
}
