<!-- jQuery  -->
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/waves.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- pdfmake for PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" 
  integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" 
  crossorigin="anonymous" referrerpolicy="no-referrer">
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

<script type="text/javascript">
  function confirmation(ev)
  {
    ev.preventDefault();
    var urlToRedirect  = ev.currentTarget.getAttribute('href');
    console.log(urlToRedirect);
    swal({
       title: "Are you sure you want to delete this ",
       text: "You won't be able to revert this delete ",
       icon: "warning",
       buttons: true, 
       dangerMode: true,
    })
    .then((willCancel)=>
    {
       if(willCancel)
       {
          window.location.href = urlToRedirect;
       }
    });
  }
</script>

<script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
<script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<script src="https://apexcharts.com/samples/assets/series1000.js"></script>
<script src="https://apexcharts.com/samples/assets/ohlc.js"></script>
<script src="{{ asset('assets/pages/jquery.dashboard.init.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.js') }}"></script>

 <!-- App favicon -->
 <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

 <!-- DataTables CSS -->

<link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css" rel="stylesheet">


<!-- DataTables -->
<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css" rel="stylesheet')}}" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<link href="{{ asset('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">

<!-- App css -->

<link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/metismenu.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
