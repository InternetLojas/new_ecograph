<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

Route::get('/', 'WelcomeController@index');
/* ============================================================== */
/*            Controller HOME              */
/* ============================================================== */

Route::group(['prefix' => '/'], function() {
    Route::get('', [
        'as' => '/index',
        'uses' => 'HomeController@index'
    ]);
    Route::get('inicio', [
        'as' => '/index',
        'uses' => 'HomeController@index'
    ]);
    /*     * *se houver o login deve-se verificar o carrinho** */
    Route::get('home', [
        'as' => 'basket',
        'uses' => 'BasketController@Verifica'
    ]);
    Route::get('home.html', [
        'as' => '/index',
        'uses' => 'HomeController@index'
    ]);
    Route::get('index.html', [
        'as' => 'index',
        'uses' => 'HomeController@index'
    ]);
    Route::get('contato.html', [
        'as' => '/contato',
        'uses' => 'HomeController@contato'
    ]);
    Route::get('entrega.html', [
        'as' => '/entrega',
        'uses' => 'HomeController@entrega'
    ]);

    Route::get('produtos.html', [
        'as' => 'produtos.produtos',
        'uses' => 'ProductController@Produtos'
    ]);

    Route::get('orcamento.html', [
        'as' => 'orcamento',
        'uses' => 'CustomerController@orcamento'
    ]);
    Route::get('como-comprar.html', [
        'as' => 'comocomprar',
        'uses' => 'HomeController@comocomprar'
    ]);

    //retorna a view do missão
    Route::get('missao.html', [
        "as" => "/missao",
        "uses" => "HomeController@Missao"
    ]);
    //retorna a view do certificacao
    Route::get('certificacao.html', [
        "as" => "/certificacao",
        "uses" => "HomeController@Certificacao"
    ]);
    //retorna a view do carrinho de compras
    Route::get('carrinho.html', [
        "as" => "/carrinho",
        "uses" => "BasketController@Carrinho"
    ]);

//retorna a view do carrinho de compras
    Route::post('resumo.html', [
        "as" => "resumo",
        "uses" => "BasketController@Resumo"
    ]);
});


/* ============================================================== */
/*                        Controller CUSTOMER                     */
/* ============================================================== */

//Route::controller('clientes', 'CustomerController');

Route::group(['prefix' => 'clientes'], function() {
    Route::get('minha-conta.html', [
        'as' => 'clientes.conta',
        'uses' => 'CustomerController@conta'
    ]);
    Route::get('logout.html', [
        'as' => 'clientes.logout',
        'uses' => 'CustomerController@logout'
    ]);
    Route::get('login.html', [
        'as' => 'clientes.login',
        'uses' => 'CustomerController@login'
    ]);
});
/* * *controla o modal com o form formtipoconta retorna JSON* */
Route::post('tipoContaJson', array(
    "as" => 'tipoContaJson',
    "uses" => 'CustomerController@TipoContaJson'
));
/* * *através da modal o cliente posta o cep e tipo para criar a conta* */
Route::post('criarconta', array(
    "as" => 'criarconta',
    "uses" => 'CustomerController@CriarConta'
));
/* * *quando o cliente preenche o cadastro e envia os dados* */
Route::post('cadastro.html', array(
    "as" => 'cadastro.cadastro',
    "uses" => 'CustomerController@Cadastro'
));

/* * *verifica o cupom informado e dá o desconto* */
Route::post('desconto', array(
    "as" => 'desconto',
    "uses" => 'DescontoController@Desconto'
));

/* ============================================================== */
/*            Controller PRODUCT             */
/* ============================================================== */
//Route::resource('/produtos', 'ProductController');


Route::group(['prefix' => 'produtos'], function() {
    Route::post('orcamento', [
        'as' => 'produtos.orcamento',
        'uses' => 'ProductController@Orcamento'
    ]);
    Route::post('portfolio.html', [
        'as' => 'produtos.portfolio',
        'uses' => 'ProductController@Listagem'
    ]);
    Route::post('enviarpdf.html', [
        'as' => 'produtos.enviarpdf',
        'uses' => 'ProductController@EnviarPDF'
    ]);
    Route::get('portfolio.html', [
        'as' => 'produtos.index',
        'uses' => 'ProductController@Index'
    ]);
});

Route::get('produtos/detalhes/{pai}/{filho}/{nome_categoria}', [
    "as" => "produtos.detalhes",
    "uses" => "ProductController@Detalhes"
]);

/* ============================================================== */
/*            Controller DE RETORNO JSON                          */
/* ============================================================== */
Route::post('calculadora', [
    "as" => "calculadora",
    "uses" => "ProductController@Calculadora"
]);

Route::post('calcula_preco', [
    "as" => "calcula_preco",
    "uses" => "PricesController@Precos"
]);
Route::post('calcula_frete/{cep}', [
    "as" => "calcula_preco/{cep}",
    "uses" => "PricesController@Fretes"
]);

Route::get("lista_perfis/{categoria}", [
    "as" => "lista_perfis/{categoria}",
    "uses" => "PerfilController@Lista"
]);


/* ============================================================== */
/*            Controller basket              */
/* ============================================================== */

//adiciona itens no carrinho
Route::post('adicionar', [
    "as" => "adicionar",
    "uses" => "BasketController@Adicionar"
]);
//retorna uma view
Route::post('basket', [
    "as" => "basket",
    "uses" => "BasketController@Listar"
]);
Route::get('basket/atualizar', [
    'as' => 'basket.atualizar',
    'uses' => 'BasketController@Atualizar'
]);
Route::get('basket/remover', [
    'as' => 'basket.remover',
    'uses' => 'BasketController@Remover'
]);
Route::group(['prefix' => 'carrinho'], function() {
    /*     * Retorna uma página com o resumo de uma compra* */
    Route::get('lista.html', [
        'as' => 'carrinho.lista',
        'uses' => 'BasketController@Lista'
    ]);
});

/* ============================================================== */
/*            Controller STORE             */
/* ============================================================== */
Route::group(['prefix' => 'loja'], function() {
    /*     * Retorna uma página com o resumo de uma compra* */
    Route::post("resumo.html", array(
        "as" => "resumo.resumo",
        "uses" => "StoreController@Resumo"
    ));
    Route::post("validacaixa", array(
        "as" => "validacaixa.validacaixa",
        "uses" => "StoreController@ValidaCaixa"));
    Route::post("process", array(
        "as" => "process.process",
        "uses" => "ProcessController@Process"
    ));
    Route::get("busca/", array(
        "as" => "busca.busca",
        "uses" => "StoreController@Busca"
    ));
    Route::post("checkout.html", array(
        "as" => "checkout.checkout",
        "uses" => "StoreController@Checkout"
    ));
    Route::post("pedido", array(
        "as" => "pedido.pedido",
        "uses" => "ProcessController@Pedido"
    ));
    Route::post("caixa", array(
        "as" => "caixa.caixa",
        "uses" => "StoreController@Caixa"
    ));
});

/* ============================================================== */
/*            Controller upload            */
/* ============================================================== */

//faz uploads dos arquivos para o serviidor
Route::post('edicao/{produto}', [
    "as" => "editor.index",
    "uses" => "EditorController@Index"
]);
//faz envio dos innputs a serem utilizados no upload***/
Route::post('editor/personalizar.html', [
    "as" => "editor.personalizar",
    "uses" => "EditorController@Personalizar"
]);
//faz a validacao dos inputs a serem armazenados na tabela***/
Route::post('editor/validar', [
    "as" => "editor.validar",
    "uses" => "EditorController@Validar"
]);
//faz envio dos innputs a serem utilizados no upload***/
Route::post('editor/carregar', [
    "as" => "editor.carregar",
    "uses" => "EditorController@Carregar"
]);
//faz uploads dos arquivos para o serviidor
Route::post('editor/upload', [
    "as" => "files.upload",
    "uses" => "EditorController@Upload"
]);

/* ============================================================== */
/*            Controller email            */
/* ============================================================== */
Route::group(['prefix' => 'email'], function() {
    Route::post('contato', [
        'as' => 'contato',
        'uses' => 'MailController@Contato'
    ]);
});
/*Route::get("loja/frete/{p}/{c}", array(
    "as" => "loja/frete/{p}/{c}",
    "uses" => "StoreController@Frete"
));


/* * *quando o cliente informa o código de desconto namodal* *
Route::post('loja/desconto', array(
    "as" => 'loja/desconto',
    "uses" => 'StoreController@Desconto'
));*/