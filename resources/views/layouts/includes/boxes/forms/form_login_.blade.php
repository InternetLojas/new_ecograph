
<div class="col-sm-12">
    <form role="form" method="POST" action="{{ url('/auth/login') }}" class="form-horizontal">
        <div class="form-group">
            <div class="input-group input-group-lg">
                <label>E-Mail</label>

                <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Seu email"/>

            </div>
            <div class="input-group input-group-lg">
                <label>Sua senha</label>

                <input type="password" name="password" class="form-control" placeholder="Seu email"/>

            </div>
            <div class="input-control checkbox" data-role="input-control" >
                <label>
                    <input type="checkbox" name="remember" />
                    <span class="check"></span>
                    Lembre-me
                </label>
            </div>

            <label></label>
            <div class="input-control">
                @if (Session::has('facebook_id'))
                {{$get_me =  Session::get('me')}}
                {{ Form::hidden('first_name', $get_me['first_name']) }}
                {{ Form::hidden('last_name', $get_me['last_name']) }}
                {{ Form::hidden('email', $get_me['email']) }}
                @endif 
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <button type="submit" class="large inverse" >Logar</button>
                <a class="button large warning" href="{{ url('/password/email') }}">Esqueceu a senha?</a>
            </div>

        </div>
    </form>
</div>
