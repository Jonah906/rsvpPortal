<!-- Overlay-->
<div class="menu-overlay"></div>

<!-- jQuery  -->
<script src="{{ asset('backend/assets/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/metismenu.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/waves.js') }}"></script>
<script src="{{ asset('backend/assets/js/simplebar.min.js') }}"></script>

@if (!empty($js) && $js == 'dashboard')
    <script>
        var chartData = {!! $chart_data !!};
        console.log(chartData);
    </script>
    <script src="{{ asset('backend/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('backend/assets/plugins/morris-js/morris.min.js') }}"></script>
    <script src="{{ asset('backend/assets/pages/dashboard-demo.js') }}"></script>
@endif

<!-- DataTables & plugins -->
<script src="{{ asset('backend/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/dataTables.select.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('backend/assets/js/html2canvas.js') }}"></script>
<script src="{{ asset('backend/assets/plugins/select2/js/select2.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@if (!empty($js) && $js == 'gallery')
    <script src="{{ asset('backend/assets/js/simple-lightbox.min.js') }}"></script>
@endif

<!-- Datatables init -->
<script src="{{ asset('backend/assets/pages/datatables-demo.js') }}"></script>

<!-- App js -->
<script src="{{ asset('backend/assets/js/theme.js') }}"></script>

<script type="text/javascript">
    $(function() {
        $("#basictbl").DataTable({
            "ordering": false,
            "pageLength": 50
        });

        $(".select2_control").select2();
    });
</script>

<script src="{{ asset('assets/js/toastr.min.js') }}"></script>

<script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info')}}"
    switch(type){
      case 'info':
        toastr.info("{{Session::get('message')}}");
      break;

      case 'success':
        toastr.success("{{Session::get('message')}}");
      break;

      case 'warning':
        toastr.warning("{{Session::get('message')}}");
      break;

      case 'error':
        toastr.error("{{Session::get('message')}}");
      break;
    }
  @endif
</script>