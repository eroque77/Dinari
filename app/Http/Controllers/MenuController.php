<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Clientes; //Carregando a Model Clientes
use App\Produtos; //Carregando a Model Produtos
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

}
