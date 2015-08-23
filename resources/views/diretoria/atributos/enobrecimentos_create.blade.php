@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Criar Enobrecimentos</h1>
        @if($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $erro)
                    <li>
                        {!! $erro !!}
                    </li>
                @endforeach
            </ul>
        @endif
        {!! Form::open(['url'=>route('enobrecimentos.store'), 'class' => 'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('category', 'Categoria: ') !!}
            {!! Form::select('category_id', $category, null, ['class' => 'form-control']) !!}
        </div>
        @for($i=0;$i<$qtd_inputs;$i++)
            <div class="form-group">
                {!! Form::label('valor', 'Nome do enobrecimento: ') !!}
                {!! Form::text('valor[]', null, ['class' => 'form-control']) !!}
            </div>
        @endfor
        <div class="form-group">
            {!! Form::submit('Adicionar o Enobrecimento para a categoria', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop