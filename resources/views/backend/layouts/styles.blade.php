<!-- Plugins css -->
<link href="{{ asset('backend/assets/plugins/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/plugins/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/plugins/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/plugins/datatables/select.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />

<!-- App css -->
<link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/summernote/summernote-bs4.min.css') }}" rel="stylesheet">
<link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/css/theme.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/assets/css/simplelightbox.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet" type="text/css" />


<style type="text/css">
    .requiredstar{
        color: #FF0000;
        font-size: 13px;
        vertical-align: middle;
        padding-left: 5px;
    }

    .texttonote{
        color: #FF0000;
        font-size: 13px;
        vertical-align: middle;
    }
    
    #loaderdiv {
        width: 100%;
        height: 100vh;
        overflow: hidden; 
        position: absolute;
        object-fit: fill;
        left: 0px;
        top: 0px;
        background-color: black;
        opacity: 0.7;
        filter: alpha(opacity=70); /* For IE8 and earlier */
        z-index:1000000;
        display: none;
    }

    #loaderdiv img {
        position: absolute;
        top: 35%;
        left: 45%;
        width: 200px;
        height: 200px;
    }

    #loaderdiv p {
        position: absolute;
        top: 57%;
        left: 49%;
        font-size: 24px;
        color: #FFF;
    }

    .tblbordered {
        border: 1px solid #000 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }

    .tblbordered td, .tblbordered tr, .tblbordered th  {
        border: 1px solid #000 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
</style>