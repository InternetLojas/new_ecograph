@extends('diretoria.main_admin')
@section('content')
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>Atributos da Categoria {!!$cat->name!!}</h1>
                    {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'pacote'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        <h2>Pacotes</h2>
                        <hr>
                        @forelse($pacotes as $pacote)
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="pacote[{{$pacote->id}}]" value="{{$pacote->quantity}}" @if(in_array($pacote->id,$catpacotes)) checked @endif >{{$pacote->quantity}}</label>
                                </div>
                            </div>
                        @empty
                            <p>Sem atributo pacote</p>
                        @endforelse
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Atualizar Pacote', ['class'=>'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                    {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'formato'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        <h2>Formatos</h2>
                        <hr>
                        @forelse($formatos as $formato)

                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="formato[{{$formato->id}}]" value="{{$formato->id}}" @if(in_array($formato->id,$catformatos)) checked @endif >{{$formato->valor}}</label>
                                </div>
                            </div>
                        @empty
                            <p>Sem atributo formato</p>
                        @endforelse
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success pull-right">Atualizar formato</button>
                        </div>
                    </div>
                    </form>
                    {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'papel'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        <h2>Papeis</h2>
                        <hr>
                        @forelse($papeis as $papel)
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="papel[{{$papel->id}}]" value="{{$papel->id}}" @if(in_array($papel->id,$catpapeis)) checked @endif >{{$papel->valor}}</label>
                                </div>
                            </div>
                        @empty
                            <p>Sem atributo papeis</p>
                        @endforelse
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success pull-right">Atualizar papel</button>
                        </div>
                    </div>
                    </form>
                    {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'cor'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        <h2>Cores</h2>
                        <hr>

                        @forelse($cores as $cor)
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="cor[{{$cor->id}}]" value="{{$cor->valor}}" @if(in_array($cor->id,$catcores)) checked @endif >{{$cor->valor}}</label>
                                </div>
                            </div>
                        @empty
                            <p>Sem atributo cores</p>
                        @endforelse
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success pull-right">Atualizar cores</button>
                        </div>
                    </div>
                    </form>
                    {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'enobrecimento'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        <h2>Enobrecimentos</h2>
                        <hr>
                        @forelse($enobrecimentos as $enobrecimento)
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="enobrecimento[{{$enobrecimento->id}}]" value="{{$enobrecimento->id}}" @if(in_array($enobrecimento->id,$catenobrecimentos)) checked @endif >{{$enobrecimento->valor}}</label>
                                </div>
                            </div>
                        @empty
                            <p>Sem atributo enobrecimento</p>
                        @endforelse
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success pull-right">Atualizar enobrecimento</button>
                        </div>
                    </div>
                    </form>
                    {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'acabamento'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                    <div class="form-group">
                        <h2>Acabamentos</h2>
                        <hr>
                        @forelse($acabamentos as $acabamento)
                            <div class="col-sm-3">
                                <div class="checkbox">
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="acabamento[{{$acabamento->id}}]" value="{{$acabamento->id}}" @if(in_array($acabamento->id,$catacabamentos)) checked @endif ><small><b>{{$acabamento->valor}}</b> {{$acabamento->enoblecimento}}</small></label>
                                </div>
                            </div>
                        @empty
                            <p>Sem atributo acabamentos</p>
                        @endforelse
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success pull-right">Atualizar acabamento</button>
                        </div>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@stop