<!DOCTYPE html>
<html lang="pt-br">

    <head>
        @include('diretoria.layouts.includes.head')
    </head>

    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <!-- Header -->
                <div class="navbar-header">
                    @include('diretoria.layouts.includes.header')
                </div>

                <ul class="nav navbar-top-links navbar-right">
                    @include('diretoria.layouts.includes.header_right')
                </ul>
                <!-- /.navbar-header -->
            </nav>
            <!-- /.navbar-static-top -->

            <nav class="navbar-default navbar-static-side" role="navigation">
                @include('diretoria.layouts.includes.sidebar')
            </nav>
            <!-- /.navbar-static-side -->

            <div id="page-wrapper">
                @yield('content')
                include('diretoria.layouts.includes.footer')
            </div>                        
            
        </div>
    </body>
</html>