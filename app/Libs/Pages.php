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
/*
 *




5 – vão estão habilitadas para inserir preço as categorias:Calendário de mesa

Calendário de bolso
Agenda
Caderno
bloco
photobook médio e grande
cartão personalizado
camiseta
capa de celular
capa galaxy 2 e 3
case de ipad



Bom, foi o que pude verificar até o momento.
 *
 * */
    public static function Page($page, $mostrar_array = false) {
        $page_view = array('contato' => 'home.pages.contato',
            'home' => 'home.pages.home',
            'sobre' => 'home.pages.sobre',
            'institucional' => 'home.pages.institucional',
            'testemunhos' => 'home.pages.testemunhos',
            'brindes' => 'home.pages.brindes',
            'politica' => 'home.pages.politica',
            'termos' => 'home.pages.termos',
            'certificacao' => 'home.pages.certificacao',
            'comocomprar' => 'home.pages.comocomprar',
            'imprimir' => 'produtos.pages.imprimir',
            'orc_imprimir' => 'clientes.pages.orc_imprimir',
            'vitrine' => 'produtos.pages.vitrine',
            'produtos' => 'produtos.pages.produtos',
            'portfolio' => 'produtos.pages.portfolio',
            'listagem' => 'produtos.pages.listagem',
            'detalhes' => 'produtos.pages.detalhes',
            'detalhescv' => 'produtos.pages.detalhescv',
            'categoria' => 'produtos.pages.categorias',
            'busca' => 'produtos.pages.buscas',
            'enviarpdf' => 'produtos.pages.enviarpdf',
            'novidadesnaocadastradas' => 'produtos.pages.novidadesnaocadastradas',
            'naocadastrado' => 'produtos.pages.naocadastrado',
            'catnaocadastrado' => 'produtos.pages.catnaocadastrado',
            'carrinho' => 'loja.pages.carrinho',
            'carrinhovazio' => 'loja.pages.carrinhovazio',
            'pagamento' => 'loja.pages.pagamento',
            'resumo' => 'loja.pages.resumo',
            'resumo_orc' => 'loja.pages.resumo_orc',
            'checkout' => 'loja.pages.checkout',
            'cancelamento' => 'loja.pages.cancelamento',
            'caixa' => 'loja.pages.caixa',
            'edicao' => 'loja.pages.edicao',
            'acabamento' => 'loja.pages.acabamento',
            'listclientes' => 'clientes.pages.listclientes',
            'orcamento' => 'clientes.pages.orcamento',
            'orcamento_online' => 'clientes.pages.orcamento_online',
            'sucesso' => 'clientes.pages.sucesso',
            'login' => 'clientes.pages.login',
            'logout' => 'clientes.pages.logout',
            'novasenha' => 'clientes.pages.novasenha',
            'novaconta' => 'clientes.pages.novaconta',
            'cadastro' => 'clientes.pages.cadastro',
            'contacriada' => 'clientes.pages.contacriada',
            'minhaconta' => 'clientes.pages.minhaconta',
            'editarconta' => 'clientes.pages.editarconta',
            'editarendereco' => 'clientes.pages.editarendereco',
            'listpedidos' => 'pedidos.listpedidos',
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
