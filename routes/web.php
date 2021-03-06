<?php

//Principal
Route::get('/', 'StartController@manager')->name('start');

Route::group(['prefix' => 'clientes'], function (){  
    Route::get('',['uses' => 'Api_DinariController@all_users']);
    Route::get('{id}',['uses' => 'Api_DinariController@get_client']);    
    Route::post('',['uses' => 'Api_DinariController@save_clients']);
    Route::put('{id}',['uses' => 'Api_DinariController@update_client']);
    Route::delete('{id}',['uses' => 'Api_DinariController@delete_clients']); 
});

Route::group(['prefix' => 'produtos'], function (){  
    Route::get('',['uses' => 'Api_DinariController@all_products']);
    Route::get('{id}',['uses' => 'Api_DinariController@get_product']);    
    Route::post('',['uses' => 'Api_DinariController@save_products']);
    Route::put('{id}',['uses' => 'Api_DinariController@update_product']);
    Route::delete('{id}',['uses' => 'Api_DinariController@delete_products']); 
});

Route::group(['prefix' => 'vendas'], function (){  
    Route::get('',['uses' => 'Api_DinariController@all_itens_venda']);
    //Route::get('{id}',['uses' => 'Api_DinariController@get_product']);    
    Route::post('',['uses' => 'Api_DinariController@save_itens_venda']);
    //Route::put('{id}',['uses' => 'Api_DinariController@update_client_venda']); //Ok
    //Route::post('',['uses' => 'Api_DinariController@add_product_venda']); //Ok 
    Route::delete('{id}',['uses' => 'Api_DinariController@delete_products_venda']); //Ok    
});

Route::group(['prefix' => 'venda'], function (){  
    Route::post('',['uses' => 'Api_DinariController@finalizar_venda']);
    Route::get('',['uses' => 'Api_DinariController@all_itens_venda_ok']);  
    Route::get('{id}',['uses' => 'Api_DinariController@get_venda']); 
});

//Menus
Route:: get('/cadastro_clientes', 'MenuController@cadastro_de_clientes')->name('cadastro_clientes'); 
Route:: get('/cadastro_produtos','MenuController@cadastro_de_produtos')->name('cadastro_produtos'); 


//Datatables
Route:: get('/listagem_clientes','MenuController@listagem_de_clientes')->name('listagem_de_clientes');
Route:: get('/listagem_de_clientes_dat','MenuController@listagem_de_clientes_dat')->name('listagem_de_clientes_dat');
Route:: get('/listagem_produtos','MenuController@listagem_de_produtos')->name('listagem_de_produtos');
Route:: get('/listagem_de_produtos_dat','MenuController@listagem_de_produtos_dat')->name('listagem_de_produtos_dat');

//Crud
//Clientes
Route:: post('/incluir_clientes','CrudController@incluir_clientes')->name('incluir_clientes');
Route:: get('/alterar_clientes/{id}','CrudController@alterar_clientes')->name('alterar_clientes');
Route:: post('/alterar_clientes1','CrudController@alterar_clientes1')->name('alterar_clientes1');
Route:: get('/excluir_clientes/{id}','CrudController@excluir_clientes')->name('excluir_clientes');

//Produtos
Route:: post('/incluir_produtos','CrudController@incluir_produtos')->name('incluir_produtos');
Route:: get('/alterar_produtos/{id}','CrudController@alterar_produtos')->name('alterar_produtos');
Route:: post('/alterar_produtos1','CrudController@alterar_produtos1')->name('alterar_produtos1');
Route:: get('/excluir_produtos/{id}','CrudController@excluir_produtos')->name('excluir_produtos');

//Venda
Route:: get('/criar_venda','MenuController@criar_venda')->name('criar_venda');
Route:: post('/itens_da_venda','MenuController@itens_da_venda')->name('itens_da_venda');
Route:: post('/finalizar_venda','MenuController@finalizar_venda')->name('finalizar_venda');
Route:: get('/excluir_itens_da_venda/{id}','MenuController@excluir_itens_da_venda')->name('excluir_itens_da_venda');
Route:: get('/listagem_de_itens_da_venda','MenuController@listagem_de_itens_da_venda')->name('listagem_de_itens_da_venda');

Route:: get('/listagem_de_itens_da_venda1','MenuController@listagem_de_itens_da_venda1')->name('listagem_de_itens_da_venda1');

Route:: get('/listar_vendas','MenuController@listar_vendas')->name('listar_vendas');
Route:: get('/listagem_de_vendas','MenuController@listagem_de_vendas')->name('listagem_de_vendas');
Route:: get('/consultar_venda/{id}','MenuController@consultar_venda')->name('consultar_venda');