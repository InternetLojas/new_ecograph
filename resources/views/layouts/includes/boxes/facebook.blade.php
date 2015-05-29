<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&appId={{FB_APP_ID}}&version=v2.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script> 
<!--<div class="fb-like-box" data-href="http://www.facebook.com/{{FAN_PAGE}}" data-width="350" data-show-faces="true" data-colorscheme="dark" data-stream="false" data-show-border="false" data-header="false"  data-height="240"></div>-->
  <div class="fb-like pull-left" data-href="{{Request::url()}}" data-width="350" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
