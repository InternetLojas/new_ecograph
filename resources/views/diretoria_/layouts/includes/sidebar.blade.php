<div class="sidebar-collapse">
    <ul class="nav" id="side-menu">
        <li class="sidebar-search">
            <div class="input-group custom-search-form">
                <input type="text" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
            <!-- /input-group -->
        </li>
        <!-- <li>
            <a href="@if($page != '') ./ @else diretoria @endif"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
        </li>-->
        <li>
            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Minha Loja<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="flot.html">Configuração da Loja</a>
                </li>
                <li>
                    <a href="morris.html">Outro Link</a>
                </li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <li>
            <a href="#"><i class="fa fa-edit fa-fw"></i> Categorias<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{route('diretoria.categories')}}">Listar</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-edit fa-fw"></i> Atributos<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{route('diretoria.atributos')}}">Listar</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-edit fa-fw"></i> Editar<span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li>
                            <a href="{{route('atributos.pacotes')}}">Pacotes</a>
                        </li>
                        <li>
                            <a href="{{route('atributos.formatos')}}">Formatos</a>
                        </li>
                        <li>
                            <a href="{{route('atributos.papeis')}}">Papeis</a>
                        </li>
                        <li>
                            <a href="{{route('atributos.cores')}}">Cores</a>
                        </li>
                        <li>
                            <a href="{{route('atributos.enobrecimentos')}}">Enobrecimentos</a>
                        </li>
                        <li>
                            <a href="{{route('atributos.acabamentos')}}">Acabamentos</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Clientes<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{route('diretoria.clientes')}}">Gerenciar Clientes</a>
                </li>
            </ul>
            <!-- /.nav-second-level -->
        </li>
        <li>
            <a href="#"><i class="fa fa-edit fa-fw"></i> Pedidos<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{route('diretoria.pedidos')}}">Gerenciar Pedidos</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-edit fa-fw"></i> Orçamentos<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="{{route('diretoria.orcamentos')}}">Listar Orçamentos</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Configuração<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="#">Metodos de Envio</a>
                </li>
                <li>
                    <a href="#">Métodos de Pagamento <span class="fa arrow"></span></a>
                    <ul class="nav nav-third-level">
                        <li>
                            <a href="#">PayPal</a>
                        </li>
                        <li>
                            <a href="#">Bcash</a>
                        </li>
                        <li>
                            <a href="#">Gerência Net</a>
                        </li>
                    </ul>
                    <!-- /.nav-third-level -->
                </li>
            </ul>
            <!-- /.nav-second-level -->
        </li>

    </ul>
    <!-- /#side-menu -->
</div>
<!-- /.sidebar-collapse -->