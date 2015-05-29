<section id="portfolio" style="display:none">
    @if(Auth::check())
    <div class="row">
        <div id="info_portfolio"></div>
        @include('layouts.includes.boxes.forms.form_orcamento')
    </div>
    @else 
    <div class="row">
        <style>
            .metro .login:before {content: "login";}
        </style>
        <h2>
            <i class="icon-key-2 on-left"></i>
            Faça login <small class="on-right"> para continuar</small>
        </h2>
        <div id="login"  class="example login">
            <div class="row">
                <div class="span6">
                    <div class="panel">
                        <div class="panel-header">
                            JÁ SOU CLIENTE
                        </div>
                        <div class="panel-content">
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif

                            @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Epa!!</strong>Existem problemas no seu formulário.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            @include('layouts.includes.boxes.forms.form_login')
                        </div>
                    </div>
                </div>
                <div class="span6">
                    <div class="box_login_img">
                        <a  href="http://localhost/ecograph/create_account.php?osCsid=66vn87p5i9s6v6c4s47495qd81"><img src="images/banners/box-entrar.jpg" width="100%" alt="box-entrar.jpg" title="Quero criar uma conta" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>