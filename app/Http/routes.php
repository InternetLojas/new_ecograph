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

/* ============================================================== */
/*            Controller HOME              */
/* ============================================================== */

Route::group(['prefix' => '/'], function() {
    Route::get('', [
        'as' => 'index',
        'uses' => 'HomeController@index'
    ]);
    Route::get('inicio', [
        'as' => 'index',
        'uses' => 'HomeController@index'
    ]);
    /*     * *se houver o login deve-se verificar o carrinho** */
    Route::get('home', [
        'as' => 'basket',
        'uses' => 'BasketController@Verifica'
    ]);
    Route::get('home.html', [
        'as' => 'index',
        'uses' => 'HomeController@index'
    ]);
    Route::get('index.html', [
        'as' => 'index',
        'uses' => 'HomeController@index'
    ]);
    Route::get('contato.html', [
        'as' => 'contato',
        'uses' => 'HomeController@Contato'
    ]);
    Route::get('termos-uso.html', [
        'as' => 'termos.uso',
        'uses' => 'HomeController@Termos'
    ]);
    Route::get('politica-privacidade.html', [
        'as' => 'politica.privacidade',
        'uses' => 'HomeController@Politica'
    ]);
    Route::get('institucional.html', [
        'as' => 'institucional',
        'uses' => 'HomeController@Institucional'
    ]);
    //retorna a view de produtos
    Route::get('produtos.html', [
        'as' => 'produtos',
        'uses' => 'ProductController@Produtos'
    ]);
    //retorna a view de orçamento
    Route::post('orcamento.html', [
        'as' => 'orcamento',
        'uses' => 'CustomerController@Orcamento'
    ]);
    //pra enviar o email
    Route::get('orcamento.html', [
        'as' => 'orcamento',
        'uses' => 'CustomerController@Orcamento'
    ]);
    /****controllers para Orçamentos *****/
    Route::get('orcamento-online.html', [
        'as' => 'orcamento.online',
        'uses' => 'CustomerController@OrcamentoOnLine'
    ]);
    Route::post('orcamento-online.html', [
        'as' => 'orcamento.online',
        'uses' => 'CustomerController@OrcamentoStore'
    ]);
    //retorna a view de informações de omo comprar
    Route::get('como-comprar.html', [
        'as' => 'comocomprar',
        'uses' => 'HomeController@ComoComprar'
    ]);
    //retorna a view do missão
    Route::get('missao.html', [
        "as" => "missao",
        "uses" => "HomeController@Missao"
    ]);
    //retorna a view do certificacao
    Route::get('certificacao.html', [
        "as" => "certificacao",
        "uses" => "HomeController@Certificacao"
    ]);
    //retorna a view do carrinho de compras
   /* Route::get('carrinho.html', [
        "as" => "carrinho",
        "uses" => "BasketController@Carrinho"
    ]);*/
});

/* ============================================================== */
/*                        Controller CUSTOMER                     */
/* ============================================================== */

Route::group(['prefix' => 'clientes'], function() {
    Route::get('logout.html', [
        'as' => 'clientes.logout',
        'uses' => 'CustomerController@Logout'
    ]);
    Route::get('login.html', [
        'as' => 'clientes.login',
        'uses' => 'CustomerController@Login'
    ]);
    Route::get('minha-conta.html', [
        'as' => 'clientes.conta',
        'uses' => 'CustomerController@Conta'
    ]);
    Route::get('conta/sucesso.html', [
        'as' => 'clientes.conta.sucesso',
        'uses' => 'CustomerController@ContaCriada'
    ]);

    /**ver detalhes de pedido**/
    Route::get('pedidos/{id}', [
        'as' => 'clientes.pedidos',
        'uses' => 'CustomerController@Pedidos'
    ]);
    /**ver detalhes de endereco**/
    Route::get('endereco/{id}', [
        'as' => 'clientes.endereco',
        'uses' => 'CustomerController@Endereco'
    ]);
    /**editar a conta**/
    Route::get('endereco/edit/{id}', [
        'as' => 'clientes.endereco.edit',
        'uses' => 'CustomerController@EnderecoEdit'
    ]);
    Route::put('{id}/endereco/update.html', [
        'as' => 'endereco.update',
        'uses' => 'CustomerController@EnderecoUpdate'
    ]);
    /**ver detalhes da conta**/
    Route::get('cadastro/{id}', [
        'as' => 'clientes.conta',
        'uses' => 'CustomerController@Conta'
    ]);
    /**editar a conta**/
    Route::get('cadastro/edit/{id}', [
        'as' => 'clientes.edit',
        'uses' => 'CustomerController@ContaEdit'
    ]);
    Route::put('{id}/cadastro/update.html', [
        'as' => 'cadastro.update',
        'uses' => 'CustomerController@CadastroUpdate'
    ]);
    /*     * *controla o modal com o form formtipoconta retorna JSON* */
    Route::post('tipoContaJson', array(
        "as" => 'clientes.tipoContaJson',
        "uses" => 'CustomerController@TipoContaJson'
    ));
    /*     * *através da modal o cliente posta o cep e tipo para criar a conta */
    Route::post('criarconta.html', array(
        "as" => 'criarconta',
        "uses" => 'CustomerController@CriarConta'
    ));
    /*     * *quando o cliente preenche o cadastro e envia os dados* */
    Route::post('cadastro.html', array(
        "as" => 'clientes.cadastro',
        "uses" => 'CustomerController@Cadastro'
    ));
});

/* * *verifica o cupom informado e dá o desconto* */
Route::post('desconto', array(
    "as" => 'desconto',
    "uses" => 'DescontoController@Desconto'
));

/* ============================================================== */
/*            Controller PRODUCT             */
/* ============================================================== */
Route::group(['prefix' => 'produtos'], function() {

    Route::get('detalhes/{pai}/{filho}/{nome_categoria}', [
        "as" => "produtos.detalhes",
        "uses" => "ProductController@Detalhes"
    ]);
//somente para cartao de visita grátis
    Route::get('detalhes/cartao-gratis/{pai}/{filho}/{nome_categoria}', [
        "as" => "produtos.detalhes.cartao.gratis",
        "uses" => "ProductController@DetalhesCartaoGratis"
    ]);
    //faz a validacao dos inputs para enviar para o carrinho***/
    Route::post('pdf/validar', [
        "as" => "pdf.validar",
        "uses" => "ProductController@Validar"
    ]);
    Route::post('enviarpdf.html', [
        'as' => 'produtos.enviarpdf',
        'uses' => 'ProductController@EnviarPDF'
    ]);
    Route::get('portfolio/{nome_categoria}', [
        'as' => 'produtos.index',
        'uses' => 'ProductController@Index'
    ]);
    Route::post('portfolio/{nome_categoria}', [
        'as' => 'produtos.portfolio',
        'uses' => 'ProductController@Portfolio'
    ]);
});

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
Route::get("lista_acabamento/{categoria}/{papel}/{enobrecimento}", [
    "as" => "lista_acabamento/{categoria}/{papel}/{enobrecimento}",
    "uses" => "ProductController@ListaAcabamento"
]);


/* ============================================================== */
/*            Controller STORE             */
/* ============================================================== */
Route::group(['prefix' => 'loja'], function() {
    /*     * Retorna uma página com o resumo de uma compra* */
    Route::post("resumo.html", array(
        "as" => "loja.resumo",
        "uses" => "StoreController@Resumo"
    ));
    Route::post("upload-resumo.html", array(
        "as" => "loja.uploadresumo",
        "uses" => "StoreController@UploadResumo"
    ));
    Route::post("validacaixa", array(
        "as" => "loja.validacaixa",
        "uses" => "StoreController@ValidaCaixa"));

    Route::post("process", array(
        "as" => "loja.process",
        "uses" => "ProcessController@Process"
    ));
    Route::get("busca.html", array(
        "as" => "loja.busca",
        "uses" => "StoreController@Busca"
    ));
    Route::post("checkout.html", array(
        "as" => "loja.checkout",
        "uses" => "StoreController@Checkout"
    ));
    /***controle de pedido novo***/
    Route::post("pedido", array(
        "as" => "loja.pedido",
        "uses" => "ProcessController@Pedido"
    ));
    Route::post("caixa", array(
        "as" => "loja.caixa",
        "uses" => "StoreController@Caixa"
    ));
    //executa o processamento do pedido e o pagamento
    Route::get('finalizacao.html', array(
        "as" => 'loja.finalizacao',
        "uses" => 'StoreController@Finalizacao'
    ));
});

/* ============================================================== */
/*            Controller upload            */
/* ============================================================== */

//faz envio dos innputs a serem utilizados no upload***/
Route::post('editor/personalizar/{produto}', [
    "as" => "editor.personalizar",
    "uses" => "EditorController@Personalizar"
]);
//faz a validacao dos inputs a serem armazenados na tabela***/
Route::post('editor/validar', [
    "as" => "editor.validar",
    "uses" => "EditorController@Validar"
]);

//faz uploads dos arquivos para o serviidor
Route::post('editor/upload', [
    "as" => "files.upload",
    "uses" => "EditorController@Upload"
]);
Route::post('editor/listar', [
    "as" => "editor.listar",
    "uses" => "EditorController@Listar"
]);

/* ============================================================== */
/*            Controller email            */
/* ============================================================== */
Route::group(['prefix' => 'email'], function() {
    Route::post('contato', [
        'as' => 'email.contato',
        'uses' => 'MailController@Contato'
    ]);
});

/* ============================================================== */
/*            Controller basket              */
/* ============================================================== */
Route::get('basket.html', [
    'as' => 'basket',
    'uses' => 'BasketController@Basket'
]);
//adiciona itens no carrinho

Route::get('basket/remover', [
    'as' => 'basket.remover',
    'uses' => 'BasketController@Remover'
]);
Route::get('basket/listar.html', [
    'as' => 'basket.lista',
    'uses' => 'BasketController@Lista'
]);
Route::get('basket/sessao/old', [
    'as' => 'basket.sessao.old',
    'uses' => 'BasketController@SessaoOld'
]);
Route::get('basket/sessao/new', [
    'as' => 'basket.sessao.new',
    'uses' => 'BasketController@SessaoNew'
]);
Route::post('basket/adicionar', [
    "as" => "basket.adicionar",
    "uses" => "BasketController@Adicionar"
]);
Route::post('basket/listar.html', [
    'as' => 'basket.listar',
    'uses' => 'BasketController@Listar'
]);

/* ============================================================== */
/*                          Controller Admin                      */
/* ============================================================== */

Route::group(['prefix' => 'diretoria',
    'middleware' => 'auth',
    'where'=>['id'=>'[0-9]+'],
    'where'=>['category'=>'[0-9]+']], function() {

    /**** home da diretoria *****/
    Route::get('', [
        'as' => 'diretoria.index',
        'uses' => 'AdminController@index'
    ]);

    Route::get('dashboard.html', [
        'as' => 'diretoria.index',
        'uses' => 'AdminController@index'
    ]);

    /****controllers para CATEGORIES *****/
    Route::get('categorias.html', [
        'as' => 'diretoria.categories',
        'uses' => 'AdminCategoriesController@index'
    ]);
    Route::get('atributos.html', [
        'as' => 'diretoria.atributos',
        'uses' => 'AdminAttributesController@index'
    ]);
    Route::post('categories.html', [
        'as' => 'categories.store',
        'uses' => 'AdminCategoriesController@store'
    ]);

    Route::group(['prefix' => 'categories'], function () {
        Route::get('create.html', [
            'as' => 'categories.create',
            'uses' => 'AdminCategoriesController@create'
        ]);

        //quando um id é passado
        //detalhes de uma categoria e seus produtos
        Route::get('{id}/detalhes.html',[
            'as' => 'categories.detalhes',
            'uses' => 'AdminCategoriesController@Detalhes'
        ]);
        //todos os atributos da categoria
        Route::get('{id}/atributos.html', [
            'as' => 'categories.atributos',
            'uses' => 'AdminCategoriesController@atributos'
        ]);
        Route::get('formato/edit/{id}', [
            'as' => 'categorie.formatos.edit',
            'uses' => 'AdminCategoriesController@CatformatosEdit'
        ]);
        Route::get('papel/edit/{id}', [
            'as' => 'categorie.papeis.edit',
            'uses' => 'AdminCategoriesController@CatpapeisEdit'
        ]);
        Route::get('cor/edit/{id}', [
            'as' => 'categorie.cores.edit',
            'uses' => 'AdminCategoriesController@CatcoresEdit'
        ]);
        Route::get('acabamento/edit/{id}', [
            'as' => 'categorie.acabamentos.edit',
            'uses' => 'AdminCategoriesController@CatacabamentosEdit'
        ]);

        Route::get('{id}/destroy.html', [
            'as' => 'categories.destroy',
            'uses' => 'AdminCategoriesController@destroy'
        ]);
        Route::get('{id}/edit.html', [
            'as' => 'categories.edit',
            'uses' => 'AdminCategoriesController@edit'
        ]);

        Route::put('{id}/atributo/{atributo}/update.html', [
            'as' => 'categories.atributo.update',
            'uses' => 'AdminAttributesController@updateAtributos'
        ]);

    });
    //listar individulamente os atributos
    Route::group(['prefix' => 'atributos'], function () {
        /*
  * Pacotes
  */
        Route::get('pacotes.html', [
            'as' => 'atributos.pacotes',
            'uses' => 'AdminAttributesController@pacotes'
        ]);
        Route::group(['prefix' => 'pacotes'], function () {
            Route::get('create.html', [
                'as' => 'pacotes.create',
                'uses' => 'AdminAttributesController@PacotesCreate'
            ]);
            Route::post('novopacote', [
                'as' => 'pacotes.store',
                'uses' => 'AdminAttributesController@PacotesStore'
            ]);
        });
        /*
         * Controle dos formatos
         */
        Route::get('formatos.html', [
            'as' => 'atributos.formatos',
            'uses' => 'AdminAttributesController@formatos'
        ]);
        Route::group(['prefix' => 'formatos'], function () {
            Route::get('create', [
                'as' => 'formatos.create',
                'uses' => 'AdminAttributesController@FormatosCreate'
            ]);
            Route::get('create/{id}', [
                'as' => 'category.formatos.create',
                'uses' => 'AdminAttributesController@CategoryFormatosCreate'
            ]);
            Route::post('novoformato', [
                'as' => 'formatos.store',
                'uses' => 'AdminAttributesController@FormatosStore'
            ]);
            Route::put('{id}/update.html', [
                'as' => 'quantity.update',
                'uses' => 'AdminAttributesController@QuantityUpdate'
            ]);
        });
        /*
         * Papeis
         */
        Route::get('papeis.html', [
            'as' => 'atributos.papeis',
            'uses' => 'AdminAttributesController@papeis'
        ]);
        Route::group(['prefix' => 'papeis'], function () {
            Route::get('create', [
                'as' => 'papeis.create',
                'uses' => 'AdminAttributesController@PapeisCreate'
            ]);
            Route::get('create/{id}', [
                'as' => 'category.papeis.create',
                'uses' => 'AdminAttributesController@CategoryPapeisCreate'
            ]);
            Route::post('novopapel', [
                'as' => 'papeis.store',
                'uses' => 'AdminAttributesController@PapeisStore'
            ]);
            Route::put('{id}/update.html', [
                'as' => 'weight.update',
                'uses' => 'AdminAttributesController@WeightUpdate'
            ]);
        });
        /*
  * Cores
  */

        Route::group(['prefix' => 'cores'], function () {
            Route::get('cores.html', [
                'as' => 'atributos.cores',
                'uses' => 'AdminAttributesController@cores'
            ]);

            Route::get('create', [
                'as' => 'cores.create',
                'uses' => 'AdminAttributesController@CoresCreate'
            ]);
            Route::get('create/{id}', [
                'as' => 'category.cores.create',
                'uses' => 'AdminAttributesController@CategoryCoresCreate'
            ]);
            Route::post('novacor', [
                'as' => 'cores.store',
                'uses' => 'AdminAttributesController@CoresStore'
            ]);

        });
        /*
         * Enobrecimento
         */
        Route::group(['prefix' => 'enobrecimentos'], function () {
            Route::get('enobrecimentos.html', [
                'as' => 'atributos.enobrecimentos',
                'uses' => 'AdminAttributesController@Enobrecimentos'
            ]);
            Route::get('create', [
                'as' => 'enobrecimentos.create',
                'uses' => 'AdminAttributesController@EnobrecimentosCreate'
            ]);
            Route::get('create/{id}', [
                'as' => 'category.enobrecimentos.create',
                'uses' => 'AdminAttributesController@CategoryEnobrecimentosCreate'
            ]);
            Route::post('novoenobreciemento', [
                'as' => 'enobrecimentos.store',
                'uses' => 'AdminAttributesController@EnobrecimentosStore'
            ]);

        });

        /*Route::group(['prefix' => 'cores'], function () {

            Route::post('novacor', [
                'as' => 'cores.store',
                'uses' => 'AdminAttributesController@CoresStore'
            ]);
        });*/
        Route::get('acabamentos.html', [
            'as' => 'atributos.acabamentos',
            'uses' => 'AdminAttributesController@acabamentos'
        ]);
        Route::group(['prefix' => 'acabamentos'], function () {
            Route::get('create.html', [
                'as' => 'acabamentos.create',
                'uses' => 'AdminAttributesController@AcabamentosCreate'
            ]);
            Route::get('create/{id}', [
                'as' => 'category.acabamentos.create',
                'uses' => 'AdminAttributesController@CategoryAcabamentosCreate'
            ]);
            Route::post('store', [
                'as' => 'acabamentos.store',
                'uses' => 'AdminAttributesController@AcabamentosStore'
            ]);
            Route::put('{id}/update.html', [
                'as' => 'prices.update',
                'uses' => 'AdminAttributesController@PricesUpdate'
            ]);
        });
    });

    /****controllers para CLIENTES *****/
    /***listar todos os clientes***/
    Route::get('clientes/listar.html', [
        'as' => 'clientes.listar',
        'uses' => 'AdminClientesController@index'
    ]);
    /**editar a conta**/
    Route::get('clientes/edit/{id}', [
        'as' => 'clientes.conta.edit',
        'uses' => 'AdminClientesController@ContaEdit'
    ]);

    /****controllers para Pedidos *****/
    Route::get('pedidos.html', [
        'as' => 'diretoria.pedidos',
        'uses' => 'AdminPedidosController@index'
    ]);
    Route::get('pedido/{id}/detalhe.html', [
        'as' => 'diretoria.pedido.items',
        'uses' => 'AdminPedidosController@Items'
    ]);

    /****controllers para Orçamentos *****/
    Route::get('orcamentos.html', [
        'as' => 'diretoria.orcamentos',
        'uses' => 'AdminOrcamentosController@index'
    ]);
});

