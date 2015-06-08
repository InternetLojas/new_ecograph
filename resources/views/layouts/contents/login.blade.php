<div class="destaque_home">
    <div class="title_content">
        <h1>
            Faça seu - 
            <small>login</small>
        </h1>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="panel ">
                <div class="panel-heading bg-dark fg-white no-radius">
                    <h3 class="panel-title">Já sou cliente</h3>
                </div>
                <div class="panel-body bg-smallgray">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Epa!!</strong>Existem problemas no seu formulário.
                        <br>
                        <br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @include('layouts.includes.boxes.forms.form_login')
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <a href="#"> <img src="images/banners/box-entrar.jpg" width="100%" class="img-responsive" alt="box-entrar.jpg" title="Quero criar uma conta" /></a>
        </div>

    </div>
</div>
