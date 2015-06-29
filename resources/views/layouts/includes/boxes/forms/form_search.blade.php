
<div class="section">
    <div class="row">
        <div class=" col-md-12">
            <!-- Search -->
            {!! Form::open(array(
            'url'=>url::to('loja/busca'), 
            'method' => 'get', 
            'name'=>'search',
            'class'=>'form-horizontal',
            'id'=>'search',
            'role'=>'form'))
            !!}
            <div class="form-group">
                <div class="col-sm-12">
                    <div class="input-group input-group-lg">
                        <input type="text" name="keyword" id="keyword" class="form-control no-radius" placeholder="Código ou nome do produto"  >
                        <span class="input-group-addon no-radius btn-search" style="">
                            <a href="javascript:void(0);" onclick="return SearchVerifica()">
                                <i class="fa fa-search"  style="color:#ffffff"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

