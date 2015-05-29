<div class="banner-templates" style="background: url('images/banners/produtos/box-top-left-{!!$head[0]!!}.jpg') left top repeat-x; padding:0">
    <div class="banner-infos ">
        <p class="nome_categ">{!!$head[0]!!}</p>
        {!!$head[1]!!}
        <div class="clearfix"></div>
        <ul class="unstyled inline breadcrumb" >
            <li>
                <a href="#" >{!!$head[0]!!}</a>
                <span class="divider">>></span>
            </li>
            <li class="active">
                {!!$nome_filho!!}
                <span class="divider">>></span>
            </li>
            <li>{!!$perfil['nome_perfil']!!}</li>
        </ul>                    
    </div>
    <div class="banner-template-img visible-desktop">
        <img src="images/{!!$head[2]!!}" width="100%" alt="{!!$head[2]!!}" />
    </div>
</div>
<h2 class="title">{!!$nome_filho!!}</h2>
<div class="clearfix"></div>
<div class="row">
    <div class="place-left padding10">
        include('layouts.includes.boxes.facebook')
    </div>
</div> 
<div class="row">
    include('layouts.includes.boxes.paginador')
</div>