<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2021 </strong>
</footer>
<script src="{{ asset("backend/bower_components/jquery/dist/jquery.min.js")}}"></script>
<script src="{{ asset("backend/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<script src="{{ asset('backend/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset("backend/bower_components/select2/dist/js/select2.full.min.js") }}"></script>
<script src="{{ asset("backend/dist/js/adminlte.min.js")}}"></script>
<script src="{{ asset("backend/bower_components/datatables.net/js/jquery.dataTables.min.js")}}"></script>
<script src="{{ asset("backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js")}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.min.css">
@yield("script")
<script>
    $("document").ready(function (){
        $("#view-website").on("click", function (){
            window.location.href = '/';
        });

        $('#example1').DataTable({
            'paging': true,
            'lengthChange': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': false,
            "pageLength": 10
        })

        $('.select2').select2()
    });
</script>
</body>
</html>
