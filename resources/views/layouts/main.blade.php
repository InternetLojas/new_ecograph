<!DOCTYPE html>
<html lang="pt-br">
    <head>
        @include('layouts.includes.head')
    </head>
    @if($page == 'checkout') 
    <body class="metro" onload="setTimeout(chamar_gateway(), 100 * 1000);">
        @else
    <body class="metro">
        @endif
        <div class="container ">
            @include('layouts.includes.pre_header')
        </div>
        <!--============================== header =================================-->
        <div class="container">
            @include('layouts.includes.nav')
        </div>
        <!-- /#header -->
        <div class="container">
            @if($page =='home')
            <!-- SLIDER ================================================================== -->
            @if(MOSTRA_SLIDERS=='1')
            <!-- Slider Start-->
            @include('layouts.includes.banner_slider')
            <!-- Slider End-->
            @else
            <!-- Slider Start-->
            include('layouts.includes.boxes.banner_fixo')
            @endif
            @endif
        </div>
        <div class="container">
            <div class="grid text-left">
                @yield('content')
            </div>
        </div>
        <div class="ecograph page-footer">
            <div class="page-footer-content">
                @include('layouts.includes.footer')
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
