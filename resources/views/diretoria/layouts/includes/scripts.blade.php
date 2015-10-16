
<script type="text/javascript" src="https://cdn.ckeditor.com/4.4.3/standard/config.js?t=E6FD"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.ckeditor.com/4.4.3/standard/skins/moono/editor_gecko.css?t=E6FD">
<script type="text/javascript" src="https://cdn.ckeditor.com/4.4.3/standard/lang/pt-br.js?t=E6FD"></script>
<script type="text/javascript" src="https://cdn.ckeditor.com/4.4.3/standard/styles.js?t=E6FD"></script>
<!-- jQuery 2.1.4 -->
<script src="{{ asset('//code.jquery.com/jquery.js')}}"></script>
<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js')}}"></script>

<!-- FastClick -->
<script src="{{ asset('admin/plugins/fastclick/fastclick.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/app.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>


<script>

    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('description');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });

</script>