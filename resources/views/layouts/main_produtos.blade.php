<!DOCTYPE html>
<html lang="pt-br">
    <head>
        @include('layouts.includes.head')
    </head>
    <body class="ecograph">
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
        <!--============================== conteúdo  =================================-->
        @yield('content')
        <!--============================== conteúdo =================================-->
        <!-- ====================    SCRIPTS   ========================== -->
        <footer class="section section-primary">
            @include('layouts.includes.footer')
        </footer>
        <div class="section">
            <div class="container">
                <!-- ====================    SCRIPTS   ========================== -->
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