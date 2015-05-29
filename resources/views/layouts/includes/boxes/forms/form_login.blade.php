<form role="form" method="POST" action="{{ url('/auth/login') }}">
    <fieldset>
        <label>E-Mail</label>
        <div class="input-control text" data-role="input-control" >
            <input type="email" name="email" value="{{ old('email') }}" placeholder="Seu email"/>
            <button class="btn-clear"></button>
        </div>
        <label>Password</label>
        <div class="input-control text" data-role="input-control" >
            <input type="password" name="password" placeholder="Seu email"/>
            <button class="btn-clear"></button>
        </div>
        <div class="input-control checkbox" data-role="input-control" >
            <label>
                <input type="checkbox" name="remember" />
                <span class="check"></span>
                Lembre-me
            </label>
        </div>
    </fieldset>
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
</form>