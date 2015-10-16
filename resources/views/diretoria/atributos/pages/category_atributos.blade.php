<!-- START ACCORDION & CAROUSEL-->
<h2 class="page-header">{{$description->categories_name}}</h2>
<div class="row">
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Atributos</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                <div class="box-group" id="accordion">
                    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                    <div class="panel box box-primary">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                    Pacotes
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="">
                                {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'pacote'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                                <div class="box-body  with-border">
                                    <!--pacotes-->
                                    <div class="form-group">
                                        @forelse($pacotes as $pacote)
                                            <div class="col-sm-3">
                                                <div class="checkbox">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" name="pacote[{{$pacote->id}}]" value="{{$pacote->quantity}}" @if(in_array($pacote->id,$catpacotes)) checked @endif >{{$pacote->quantity}}</label>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>

                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="btn-group pull-right">


                                        @if(count($pacotes)==0)
                                            <a  class="btn bg-maroon btn-flat margin" href="{{route('pacotes.create')}}" > Criar Pacote </a>
                                        @else
                                            <a class="btn bg-maroon btn-flat margin" href="{{ route('atributos.pacotes') }}" title="Editar pacote da categoria {{$description->categories_name}} ">Configurar o pacote</a>
                                            {!! Form::submit('Atualizar Pacote', ['class'=>'btn bg-maroon btn-flat margin']) !!}
                                        @endif


                                    </div>
                                </div><!-- box-foote-->
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-danger">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                    Formatos
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="">
                                {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'formato'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                                <div class="box-body  with-border">
                                    <!--formatos-->
                                    <div class="form-group">
                                        @forelse($formatos as $formato)
                                            <div class="col-sm-4">
                                                <div class="checkbox-inline">
                                                    <label>
                                                        <input type="checkbox" name="formato[{{$formato->id}}]" value="{{$formato->id}}" @if(in_array($formato->id,$catformatos)) checked @endif >
                                                        {{$formato->valor}}
                                                    </label>
                                                </div>
                                            </div>
                                        @empty
                                            <p>Sem atributo formato</p>
                                        @endforelse
                                    </div>

                                </div><!-- /.box-body -->
                                <div class="box-footer">
                                    <div class="btn-group pull-right">
                                        <button type="submit" class="btn bg-maroon btn-flat margin"> Atualizar formato</button>
                                        <a  class="btn bg-maroon btn-flat margin" href="{{route('category.formatos.create',['id'=>$cat->id])}}" > Criar novo Formato </a>
                                        <a class="btn bg-maroon btn-flat margin" href="{{ route('categorie.formatos.edit', ['id'=> $cat->id ]) }}" title="Editar formato da {{$description->categories_name}} ">Configurar o formato</a>
                                    </div>

                                </div><!-- box-foote-->
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                    Papeis
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'papel'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                            <div class="box-body  with-border">
                                <!--papeis-->
                                <div class="form-group">
                                    @forelse($papeis as $papel)
                                        <div class="col-sm-4">
                                            <div class="checkbox-inline">
                                                <label>
                                                    <input type="checkbox" name="papel[{{$papel->id}}]" value="{{$papel->id}}" @if(in_array($papel->id,$catpapeis)) checked @endif >
                                                    {{$papel->valor}}
                                                </label>
                                            </div>
                                        </div>
                                    @empty
                                        <p>Sem atributo papeis</p>
                                    @endforelse
                                </div>

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn bg-maroon btn-flat margin"> Atualizar papel</button>
                                    <a  class="btn bg-maroon btn-flat margin" href="{{route('category.papeis.create',['id'=>$cat->id])}}" > Criar novo Papel </a>
                                    <a class="btn bg-maroon btn-flat margin" href="{{ route('categorie.papeis.edit', ['id'=> $cat->id ]) }}" title="Editar papel da {{$description->categories_name}} ">Configurar papel/material</a>
                                </div>

                            </div><!-- box-foote-->
                            </form>
                        </div>
                    </div>
                    <div class="panel box box-warning">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                    Enobrecimento
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse">
                            {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'enobrecimento'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                            <div class="box-body  with-border">
                                <!--enobrecimentos-->
                                <div class="form-group">
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

                                </div>

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn bg-maroon btn-flat margin"> Atualizar enobrecimento</button>
                                </div>

                            </div><!-- box-foote-->
                            </form>
                        </div>
                    </div>
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
                                    Cores
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFive" class="panel-collapse collapse">
                            {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'cor'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                            <div class="box-body  with-border">
                                <!--cores-->

                                <div class="form-group">
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

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn bg-maroon btn-flat margin"> Atualizar cores</button>
                                    <a  class="btn bg-maroon btn-flat margin" href="{{route('category.cores.create',['id'=>$cat->id])}}" > Criar nova Cor </a>
                                    <a class="btn bg-maroon btn-flat margin" href="{{ route('categorie.cores.edit', ['id'=> $cat->id ]) }}" title="Editar cor da {{$description->categories_name}} ">Configurar cores</a>
                                </div>

                            </div><!-- box-foote-->
                            </form>
                        </div>
                    </div>
                    <div class="panel box box-success">
                        <div class="box-header with-border">
                            <h4 class="box-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseSix">
                                    Acabamentos
                                </a>
                            </h4>
                        </div>
                        <div id="collapseSix" class="panel-collapse collapse">
                            {!! Form::open(['route' =>['categories.atributo.update',$cat->id,'acabamento'],'method'=>'put', 'class' => 'form-horizontal']) !!}
                            <div class="box-body  with-border">
                                <!--acabamentos-->
                                <div class="form-group">
                                    @forelse($acabamentos as $acabamento)
                                        <div class="col-sm-4">
                                            <div class="checkbox-inline">
                                                <label >
                                                    <input type="checkbox" name="acabamento[{{$acabamento->id}}]" value="{{$acabamento->id}}" @if(in_array($acabamento->id,$catacabamentos)) checked @endif ><small><b>{{$acabamento->valor}}</b> {{$acabamento->enoblecimento}}</small>
                                                </label>
                                            </div>
                                        </div>
                                    @empty
                                        <p>Sem atributo acabamentos</p>
                                    @endforelse
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class="btn-group pull-right">
                                    <button type="submit" class="btn bg-maroon btn-flat margin"> Atualizar acabamento</button>
                                    <a  class="btn bg-maroon btn-flat margin" href="{{route('category.acabamentos.create',['id'=>$cat->id])}}" > Criar novo Acabamento </a>
                                    <a class="btn bg-maroon btn-flat margin" href="{{ route('categorie.acabamentos.edit', ['id'=> $cat->id ]) }}" title="Editar acabamento da {{$description->categories_name}} ">Configurar acabamento</a>
                                </div>

                            </div><!-- box-foote-->
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
    <div class="col-md-6">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Descrição</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!!$description->categories_info!!}
                {!!$description->categories_descricao!!}
                {!! HTML::image('images/'.$cat->categories_image, $alt='preloading.gif', array('style'=>'style="display:block;width:100%; max-width:128px; margin:auto"', 'title'=>'Aguarde enquanto estamos redirecionando seu pedido.')) !!}

            </div><!-- /.box-body -->
            <div class="box-footer">
                <div class="btn-group">
                    <a class="btn btn-default" href="{{ route('categories.detalhes',['id'=> $cat->id ] ) }}" title="Ver os produtos {{$description->categories_name}}">
                        <i class="fa fa-align-left"></i> Ver os produtos</a>
                    <a class="btn btn-default" href="{{ route('categories.edit', ['id'=> $cat->id ]) }}" title="Editar categoria {{$description->categories_name}}">
                        <i class="fa fa-align-center"></i> Editar Categoria</a>
                    <a class="btn btn-default" href="#" title="Eliminar categoria {{$description->categories_name}}">
                        <i class="fa fa-align-right"></i> Eliminar a categoria</a>
                </div>
            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->



