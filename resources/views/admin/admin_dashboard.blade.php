<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title> Новостной сайт</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    <!-- Plugins css -->
    <link href="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <!-- Bootstrap css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }} " rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }} " rel="stylesheet" type="text/css" id="app-style"/>
    <!-- icons -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }} " rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <!-- Head js -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="{{ asset('backend/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- third party css end -->
    <link href="{{ asset('backend/assets/libs/mohithg-switchery/switchery.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="{{ asset('backend/assets/js/head.js') }} "></script>


</head>

<!-- body start -->
<body data-layout-mode="default" data-theme="light" data-topbar-color="light" data-menu-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='false'>

<!-- Begin page -->
<div id="wrapper">
    <!-- Topbar Start -->
    @include('admin.inc.header')
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
        @include('admin.inc.sidebar')
    <!-- Left Sidebar End -->
    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <div class="content-page">
        @yield('admin')
        <!-- Footer Start -->
        @include('admin.inc.footer')
        <!-- end Footer -->
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
</div>
<!-- END wrapper -->
<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<!-- Vendor js -->
<script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>
<!-- Plugins js-->
<script src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<!-- Dashboar 1 init js-->
<script src="{{ asset('backend/assets/js/pages/dashboard-1.init.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/pdfmake/build/pdfmake.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/pdfmake/build/vfs_fonts.js') }}"></script>
<!-- Datatables init -->
<script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('backend/assets/js/code.js') }}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script><!-- App js-->
<script src="{{ asset('backend/assets/js/validate.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/app.min.js') }}"></script>
<script>
    @if(Session::has('message'))
    let type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif


    $(document).ready(function() {
        $(document).on('click', ".updatePageStatus", function() {
            let status = $(this).children("i").attr("status");
            let page_id = $(this).attr("page_id")
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:"post",
                url:'/admin/pages/update-status',
                data:{status:status,page_id:page_id},
                success:function (resp){
                    if(resp['status']==0){
                        $("#page-"+page_id).html("<i class='fas fa-toggle-off' style='color:gray; font-size: 34px' status='InActive'></i> ");
                    } else  if(resp['status']==1) {
                        $("#page-"+page_id).html("<i class='fas fa-toggle-on' style='color:#3f6ed3; font-size: 34px' status='Active'></i> ");
                    }
                }, error:function(resp){
                    alert("Error")
                }

            })


        });
    });
</script>

<script src="{{ asset('backend/assets/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/mohithg-switchery/switchery.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/multiselect/js/jquery.multi-select.js') }}"></script>
<script src="{{ asset('backend/assets/libs/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('backend/assets/libs/devbridge-autocomplete/jquery.autocomplete.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('backend/assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

<!-- Init js-->

<script>
    $(document).ready(function() {
        $('#basic-datatable').dataTable({
            stateSave: true,
            destroy: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/ru.json',
            },
        });
    });


</script>
<script src="{{ asset('backend/assets/js/pages/form-advanced.init.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({

                  toolbar: [ 
                     ['style', ['style', 'bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
                    ['font', ['fontname', 'fontsize', 'fontsizeunit']],
                    ['fontstyle', ['forecolor', 'backcolor']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['misc', ['undo', 'redo']]

                   ],
                tabsize: 2,
                height: 300
            });
            $('#summernote2').summernote({

                   toolbar: [ 
                     ['style', ['style', 'bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
                    ['font', ['fontname', 'fontsize', 'fontsizeunit']],
                    ['fontstyle', ['forecolor', 'backcolor']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['misc', ['undo', 'redo']]

                   ],


                tabsize: 2,
                height: 300
            });
            $('#summernote3').summernote({

                   toolbar: [ 
                     ['style', ['style', 'bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
                    ['font', ['fontname', 'fontsize', 'fontsizeunit']],
                    ['fontstyle', ['forecolor', 'backcolor']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video', 'table', 'hr']],
                    ['view', ['fullscreen', 'codeview', 'help']],
                    ['misc', ['undo', 'redo']]

                   ],

                   
                tabsize: 2,
                height: 300
            });

        });
    </script>
</body>
</html>
