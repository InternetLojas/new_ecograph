<!DOCTYPE html>
<html lang="pt-br">
<head>
    @include('layouts.includes.head')
</head>
@if($page == 'checkout')
    <body class="" onload="setTimeout(chamar_gateway(), 100 * 1000);">
    @elseif($page == 'detalhescv')
            <body class="" onload="Calculadora(28,'Cartão de Visita Grátis');">
            @else
        <body class="">
        @endif
        <div class="section">
            <div class="container">
                <!--============================== header =================================-->
                @include('layouts.includes.header')
                <!--============================== header =================================-->
            </div>
        </div>
        <div class="section">
            <div class="container">
                <!--============================== header =================================-->
                @include('layouts.includes.nav')
                <!--============================== header =================================-->
            </div>
        </div>
        @if ($page=="home")
            <div class="container">
                <!--============================== banner =================================-->
                <div class="col-md-12 hidden-xs section">
                    @include('layouts.includes.banner_slider')
                </div>
                <!--============================== banner =================================-->
            </div>
            @endif
                    <!--============================== conteúdo  =================================-->
            <div class="container">
                    @yield('content')
            </div>
            <!--============================== conteúdo =================================-->
            <div class="section">
                <div class="container">
                    <!-- ====================    MODAL   ========================== -->
                    @if($page != 'novaconta' && !Auth::user())
                        @include('layouts.includes.modais.tipo_conta')
                        @endif

                </div>
            </div>
            <!-- ====================    footer   ========================== -->
            <div class="section">
                <div class="container">
                    <footer class="footer">
                        @include('layouts.includes.footer')
                    </footer>
                </div>
            </div>
            <!-- ====================    SCRIPTS   ========================== -->
        @section('script')
            @include('layouts.includes.scripts')
        @show()
        @section('dinamic-script')
            @include('layouts.includes.boxes.dinamic_scripts')
        @show()
        <!-- =====================  END SCRIPTS  ======================== -->
        </body>
</html>