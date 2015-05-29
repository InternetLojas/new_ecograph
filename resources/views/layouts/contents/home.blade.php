<!-- HOME-->
    <div class="row">
        <h2 class="subheader-secondary bold">Escolha seu produto<small> </small></h2>
        @include('layouts.includes.produtos_destaque')
    </div>
    <div class="row">
        <h2 class="subheader-secondary bold">Novidades</h2>
        <div class="row">
            @include('layouts.includes.produtos_novos')     
        </div>
    </div>
    <div class="row">
        <h2 class="subheader-secondary bold">Todos produtos<small></small></h2>
        @include('layouts.includes.produtos_todos')     
    </div>
