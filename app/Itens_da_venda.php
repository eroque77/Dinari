<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use App\Produtos; //Carregando a Model Produtos


class Itens_da_venda extends Model
{
    protected $fillable = [
        'id_produto', 'id_cliente', 'valor_produto', 'qtde_vendida',  //Campos a serem inseridos no BD
    ];

    public function allItensVenda(){
        //return self::all();

        return Itens_da_venda::select ('itens_da_venda.id', 'descricao', 'valor_produto', 'qtde_vendida')          
                ->join('produtos', 'itens_da_venda.id_produto', '=', 'produtos.id')
                ->where('itens_da_venda.status', '=', 0)
                ->get();                
       
    }
  
    protected $table = "Itens_da_venda";

    public function saveItensVenda(){
        date_default_timezone_set('America/Sao_Paulo');
        $input = Input::all(); //Retorna um array tudo que foi enviado
        //dd($input);
        $itens = new Itens_da_venda(); 
        $itens->fill($input);  


        //Verificando Estoque
        $prd = Produtos::find($input['id_produto']);
        if($prd->quantidade_est<$input['qtde_vendida']){
            return false;
        }
       
        $itens->save();
        return $itens;   

    }

}
