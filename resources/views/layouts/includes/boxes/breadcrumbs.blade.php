<!--  breadcrumb -->
<div class="section">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li>
                    <a href="{!! URL::to('inicio') !!}" >{!!Fichas::nomeCategoria($parent)!!}</a>
                </li>
                <li>
                    <a href="javascript:void(0)">{!!$ativo!!}</a>
                </li>
                <li class="active">{!! $perfil !!}</li>
            </ul>
        </div>
    </div>
</div>