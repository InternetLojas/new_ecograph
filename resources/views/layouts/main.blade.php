<!DOCTYPE html>
<html lang="pt-br">
    <head>
        @include('layouts.includes.head')
    </head>
    @if($page == 'checkout')
    <body class="ecograph" onload="setTimeout(chamar_gateway(), 100 * 1000);">
        @else
    <body class="ecograph">
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
        <div class="section">
            <div class="container">
                <!--============================== banner =================================-->
                <div class="wrapper">                    
                    <div class="banner">
                        @include('layouts.includes.banner_slider')
                    </div>
                </div>
                <!--============================== banner =================================-->
            </div>
        </div>
        @endif
        <!--============================== conteúdo  =================================-->
        <div class="container">
            <div class="wrapper">
                @yield('content')
            </div>
        </div>
        <!--============================== conteúdo =================================-->
        <!-- ====================    SCRIPTS   ========================== -->
        <footer class="section section-primary">
            @include('layouts.includes.footer')
        </footer>
        <div class="section">
            <div class="container">
                <!-- ====================    MODAL   ========================== -->
                @if($page != 'novaconta' && !Auth::user())
                @include('layouts.includes.modais.tipo_conta')
                @endif
                <!-- ====================    SCRIPTS   ========================== -->
                @section('script')
                @include('layouts.includes.scripts')
                @show()
                @section('dinamic-script')
                @include('layouts.includes.boxes.dinamic_scripts')
                @show()
                <!-- =====================  END SCRIPTS  ======================== -->
            </div>
        </div>
    </body>
</html>