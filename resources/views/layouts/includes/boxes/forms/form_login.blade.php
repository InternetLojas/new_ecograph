<div class="destaque_home">
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
        <div class="form-group">
            <div class="col-sm-2">
                <label for="email" class="control-label">Email</label>
            </div>
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" id="email" placeholder="Seu email" value="{{ old('email') }}" required>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-2">
                <label for="password" class="control-label">Senha</label>
            </div>
            <div class="col-sm-10">
                <input type="password" class="form-control" name="password" id="password" placeholder="Sua senha" required>
                @if (Session::has('facebook_id'))
                {{$get_me =  Session::get('me')}}
                {{ Form::hidden('first_name', $get_me['first_name']) }}
                {{ Form::hidden('last_name', $get_me['last_name']) }}
                {{ Form::hidden('email', $get_me['email']) }}
                @endif 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label class="text-medio">
                        <input type="checkbox">Lembre-me
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-11">
                <a class="btn btn-link" href="{{ url('/password/email') }}">Esqueceu a senha?</a>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-lg bg-green pull-right no-radius fg-white">Logar</button>
            </div>
        </div>
    </form>

</div>