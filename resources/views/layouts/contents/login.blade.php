<!-- LOGIN-->
<div class="row">
    <div class="span7 fg-white border">
        <div class="panel">
            <div class="panel-header bg-dark padding20">
                <h1 class="fg-white padding5"> JÁ SOU CLIENTE</h1>
            </div>
            <div class="panel-content text-left bg-gray">
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
    <div class="span5">
        <div class="box_login_img">
            <a href="#"> <img src="images/banners/box-entrar.jpg" width="100%" alt="box-entrar.jpg" title="Quero criar uma conta" /></a>
        </div>
    </div>
</div>
