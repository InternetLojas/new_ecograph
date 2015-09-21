<?php $page='reminder';$title='Modificar minha senha'?>
@extends('layouts.main')

@section('content')

    <div class="destaque_home">
        <div class="title_content">
            <h1>
                Mude -
                <small>sua senha</small>
            </h1>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="panel ">
                    <div class="panel-heading bg-dark fg-white no-radius">
                        <h3 class="panel-title">Alterar Senha</h3>
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
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group">
                                    <label class="col-md-4 control-label">E-Mail</label>
                                    <div class="col-md-6">
                                        <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Senha</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label">Confirme a senha</label>
                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-success pull-right">
                                            Confirmar mudança
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <a href="#"> <img src="images/banners/box-entrar.jpg" width="100%" class="img-responsive" alt="box-entrar.jpg" title="Quero criar uma conta" /></a>
            </div>
        </div>
    </div>


@endsection
