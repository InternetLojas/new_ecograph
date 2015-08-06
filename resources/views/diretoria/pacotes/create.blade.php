@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Criar Pacotes</h1>
        @if($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $erro)
                    <li>
                        {!! $erro !!}
                    </li>
                @endforeach
            </ul>
        @endif
        {!! Form::open(['url'=>route('pacotes.store'), 'class' => 'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('category', 'Categoria: ') !!}
            {!! Form::select('category_id', $category, null, ['class' => 'form-control']) !!}
        </div>
        @for($i=0;$i<$qtd_inputs;$i++)
        <div class="form-group">
            {!! Form::label('quantity', 'Quantidade: ') !!}
            {!! Form::text('quantity[]', null, ['class' => 'form-control']) !!}
        </div>
        @endfor
        <div class="form-group">
            {!! Form::submit('Adiciona o Pacote para a categoria', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop