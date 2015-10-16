<?php

namespace Ecograph\Http\Controllers;

use Ecograph\Http\Requests;
use Ecograph\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Ecograph\Libs\Layout;
use Ecograph\Libs\Banners;


class HomeController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Home Controller
      |--------------------------------------------------------------------------
      |
      | This controller renders your application's "dashboard" for users that
      | are authenticated. Of course, you are free to change or remove the
      | controller as you wish. It is just here to get your app started!
      |
     */

    private $layout;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Layout $layout) {
        $this->layout = $layout;
    }

    /**
     * Mosta página inicial.
     *
     * @return View
     */
    public function index() {
        $sliders = Banners::ativos(3);
        $layout = \Layout::classes(0);

        return view('home.index',compact('sliders'))
            ->with('title', STORE_NAME . ' Impressos em geral por tema ou profissão')
            ->with('page', 'home')
            ->with('ativo', 'Home')
            ->with('rota', '/')
            ->with('layout', $layout);
    }
    /**
     * Mosta página como comprar.
     *
     * @return View
     */
    public function contato() {

        $layout = $this->layout->classes('0');
        return view('home.index')
        ->with('title', STORE_NAME . ' Contato')
        ->with('page', 'contato')
        ->with('ativo', 'Contato')
        ->with('rota', 'contato.html')
        ->with('layout', $layout);
    }
    public function termos() {
        $layout = $this->layout->classes('0');
        return view('home.index')
            ->with('title', STORE_NAME . ' Termos de Uso')
            ->with('page', 'termos')
            ->with('ativo', 'Termos de Uso')
            ->with('layout', $layout);
    }
    public function politica() {
        $layout = $this->layout->classes('0');
        return view('home.index')
            ->with('title', STORE_NAME . ' Política de Privacidade')
            ->with('page', 'politica')
            ->with('ativo', 'Política de Privacidade')
            ->with('layout', $layout);
    }
    /**
     * Mosta página entrega.
     *
     * @return View
     */
    public function institucional() {
        $layout = $this->layout->classes('0');
        return view('home.index')
            ->with('title', STORE_NAME . ' Institucional')
            ->with('page', 'institucional')
            ->with('ativo', 'Institucional')
            ->with('layout', $layout);
    }
    /**
     * Mosta página como comprar.
     *
     * @return View
     */
    public function comocomprar() {

        $layout = $this->layout->classes('0');
        return view('home.index')->with('title', STORE_NAME . ' Como comprar')->with('page', 'comocomprar')->with('ativo', 'Como Comprar')->with('rota', '/comocomprar')->with('layout', $layout);
    }
    public function missao() {
        $layout = $this->layout->classes('0');
        return view('home.index')->with('title', ' Missão da ' . STORE_NAME)->with('page', 'missao')->with('ativo', 'Nossa Missão')->with('rota', '/missao.html')->with('layout', $layout);
    }

    public function certificacao() {
        $layout = $this->layout->classes('0');
        return view('home.index')->with('title', ' Missão da ' . STORE_NAME)->with('page', 'certificacao')->with('ativo', 'Certificacao')->with('rota', '/certificacao.html')->with('layout', $layout);
    }

    /**
     * Mosta página sobre.
     *
     * @return View
     */
    public function sobre() {

        $layout = $this->layout->classes('0');
        return view('home.index')->with('title', STORE_NAME . ' Sobre')->with('page', 'sobre')->with('ativo', 'Sobre')->with('rota', '/sobre')->with('layout', $layout);
    }



}
