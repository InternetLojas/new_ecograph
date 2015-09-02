@extends('diretoria.main_admin')
@section('content')
    <div class="container">
        <h1>Criar Acabamentos</h1>
        @if($errors->any())
            <ul class="alert alert-warning">
                @foreach($errors->all() as $erro)
                    <li>
                        {!! $erro !!}
                    </li>
                @endforeach
            </ul>
        @endif
        {!! Form::open(['url'=>route('acabamentos.store'), 'class' => 'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('category', 'Categoria: ') !!}
            {!! Form::select('category_id', $category, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            <div class="col-md-4">
                {!! Form::label('valor', 'Acabamento: ') !!}
            </div>
            <div class="col-md-4">
                {!! Form::label('valor', 'Enobrecimentos: ') !!}
            </div>
        </div>
        @for($i=0;$i<$qtd_inputs;$i++)
            <div class="form-group">
                <div class="col-md-4">
                    {!! Form::text('valor[]', null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::select('enobrecimento[]', $enobrecimentos, null, ['class' => 'form-control']) !!}
                </div>
            </div>
        @endfor
        <div class="form-group">
            {!! Form::submit('Adicionar o Acabamento para a categoria', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop