        @foreach(Banners::ativos('2') as $palco=>$destaque)
         <div class="span6">
            <div class="thumb_novidades">
                <a href="{{URL::to('produtos/detalhes/' .$destaque['parent_id'].'/'.$destaque['id'].'/'.URLAmigaveis::Slug($destaque['categories_name'],'-',true).'.html')}}" title="Saiba mais sobre {{ $destaque['categories_name'] }}">
                    {!! HTML::image('images/banners/novidades/new-'.$destaque['id'].'.jpg',$destaque['id'].'.jpg', array('class' => '')) !!}
                </a>                                                 
            </div>
        </div>
        @endforeach

 