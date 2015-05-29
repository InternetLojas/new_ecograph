<?php

/*
  |--------------------------------------------------------------------------
  | Class Aliases
  |--------------------------------------------------------------------------
  |
  | This array of class aliases will be registered when this application
  | is started. However, feel free to register as many as you wish as
  | the aliases are "lazy" loaded so they don't hinder performance.
  |
 */

Class Pages {

    public static function Page($page, $mostrar_array = false) {
        $page_view = array('contato' => 'home.pages.contato',
            'home' => 'home.pages.home',
            'sobre' => 'home.pages.sobre',
            'entrega' => 'home.pages.entrega',
            'testemunhos' => 'home.pages.testemunhos',
            'brindes' => 'home.pages.brindes',
            'imprimir' => 'produtos.pages.imprimir',
            'politica' => 'home.pages.politica',
            'missao' => 'home.pages.missao',
            'certificacao' => 'home.pages.certificacao',
            'produtos' => 'produtos.pages.produtos',
            'listagem' => 'produtos.pages.listagem',
            'detalhes' => 'produtos.pages.detalhes',
            'categoria' => 'produtos.pages.categorias',
            'busca' => 'produtos.pages.buscas',
            'novidadesnaocadastradas' => 'produtos.pages.novidadesnaocadastradas',
            'naocadastrado' => 'produtos.pages.naocadastrado',
            'catnaocadastrado' => 'produtos.pages.catnaocadastrado',
            'carrinho' => 'loja.pages.carrinho',
            'carrinhovazio' => 'loja.pages.carrinhovazio',
            'pagamento' => 'loja.pages.pagamento',
            'resumo' => 'loja.pages.resumo',
            'checkout' => 'loja.pages.checkout',
            'cancelamento' => 'loja.pages.cancelamento',
            'caixa' => 'loja.pages.caixa',
            'edicao' => 'loja.pages.edicao',
            'acabamento' => 'loja.pages.acabamento',
            'orcamento' => 'clientes.pages.orcamento',
            'comocomprar' => 'home.pages.comocomprar',
            'sucesso' => 'clientes.pages.sucesso',
            'login' => 'clientes.pages.login',
            'logout' => 'clientes.pages.logout',
            'novasenha' => 'clientes.pages.novasenha',
            'novaconta' => 'clientes.pages.novaconta',
            'cadastro' => 'clientes.pages.cadastro',
            'minhaconta' => 'clientes.pages.minhaconta',
            'editarconta' => 'clientes.pages.editarconta',
            'editarendereco' => 'clientes.pages.editarendereco',
            'editarpedido' => 'clientes.pages.editarpedido',
            'pedidos' => 'clientes.pages.pedidos',
            'convite' => 'clientes.pages.conviteamigo',
            'editor' => 'editor.pages.edicao',
            'shopping' => 'google.pages.googleshopping'
        );
        if ($mostrar_array) {
            return $page_view;
        } else {
            return $page_view[$page];
        }
    }

}