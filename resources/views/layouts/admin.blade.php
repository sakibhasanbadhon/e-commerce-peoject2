<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title> </title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="{{ asset('/') }}assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="{{ asset('/') }}assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->

     {{-- dataTAbles --}}
     <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
     <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet">

     <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">

    <link href="{{ asset('/') }}assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="{{ asset('/') }}assets/css/main.min.css" rel="stylesheet" />

    {{-- summernote link --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    {{-- drofify link --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" integrity="sha512-In/+MILhf6UMDJU4ZhDL0R0fEpsp4D3Le23m6+ujDWXwl3whwpucJG1PEmI3B07nyJx+875ccs+yX2CqQJUxUw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- PAGE LEVEL STYLES-->
    <link href="{{ asset('/') }}assets/toastr.css" rel="stylesheet" />
    <style>

        /* css switch style */

        .toggle-switch {
            position: relative;
            width: 100px;
        }

        .switch-label {
            position: absolute;
            width: 84%;
            height: 30px;
            background-color: red;
            border-radius: 50px;
            cursor: pointer;
        }

        .switch-label input {
            position: absolute;
            display: none;
        }

        .switch_slider {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50px;
            color:white;
            transition: 0.3s;
            padding: 2px 0 0 9px;
        }

        .switch-label input:checked ~ .switch_slider {
            background-color: green;
        }

        .switch_slider::before {
            content: "";
            position: absolute;
            top: 1px;
            left: 3px;
            width: 30px;
            height: 28px;
            border-radius: 50%;
            box-shadow: inset 0px 0px 0px 0px #d8dbe0;
            background-color: #f9f8f8;
            transition: 0.8s;
        }

        .switch-label input:checked ~ .switch_slider::before {
            transform: translateX(50px);
            background-color: 28292c;
            box-shadow: none;
        }

        /* switch end */


        .table th{
            font-weight: 600 !important;
        }
        .table th:first-child,
        .table tr td:first-child{
            text-align: left;
            padding-left: 15px;
        }
        .table th:last-child,
        .table tr td:last-child{
            text-align: right;
            padding-right: 15px;
        }
        .pr-15{
            padding-right: 15px;
        }
        .dataTables_length,
        .dataTables_info{
            padding-left: 15px
        }

    </style>

</head>

<body class="fixed-navbar">
    @guest

    @else

    <div class="page-wrapper">
        <!-- START HEADER-->
        @include('admin.include.header')
        <!-- END HEADER-->

        <!-- START SIDEBAR-->
        @include('admin.include.sidebar')
        <!-- END SIDEBAR-->

     @endguest

        @yield('auth-content') <!--for login and registration-->

        <!-- START PAGE CONTENT-->
        <div class="content-wrapper">
            <div class="page-content fade-in-up">

                @yield('content')

            </div>
        </div>

        <!-- END PAGE CONTENT-->
    </div>

    <!-- BEGIN THEME CONFIG PANEL-->
    {{-- <div class="theme-config">
        <div class="theme-config-toggle"><i class="fa fa-cog theme-config-show"></i><i class="ti-close theme-config-close"></i></div>
        <div class="theme-config-box">
            <div class="text-center font-18 m-b-20">SETTINGS</div>
            <div class="font-strong">LAYOUT OPTIONS</div>
            <div class="check-list m-b-20 m-t-10">
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedNavbar" type="checkbox" checked>
                    <span class="input-span"></span>Fixed navbar</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input id="_fixedlayout" type="checkbox">
                    <span class="input-span"></span>Fixed layout</label>
                <label class="ui-checkbox ui-checkbox-gray">
                    <input class="js-sidebar-toggler" type="checkbox">
                    <span class="input-span"></span>Collapse sidebar</label>
            </div>
            <div class="font-strong">LAYOUT STYLE</div>
            <div class="m-t-10">
                <label class="ui-radio ui-radio-gray m-r-10">
                    <input type="radio" name="layout-style" value="" checked="">
                    <span class="input-span"></span>Fluid</label>
                <label class="ui-radio ui-radio-gray">
                    <input type="radio" name="layout-style" value="1">
                    <span class="input-span"></span>Boxed</label>
            </div>
            <div class="m-t-10 m-b-10 font-strong">THEME COLORS</div>
            <div class="d-flex m-b-20">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Default">
                    <label>
                        <input type="radio" name="setting-theme" value="default" checked="">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-white"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue">
                    <label>
                        <input type="radio" name="setting-theme" value="blue">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green">
                    <label>
                        <input type="radio" name="setting-theme" value="green">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple">
                    <label>
                        <input type="radio" name="setting-theme" value="purple">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange">
                    <label>
                        <input type="radio" name="setting-theme" value="orange">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink">
                    <label>
                        <input type="radio" name="setting-theme" value="pink">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-ebony"></div>
                    </label>
                </div>
            </div>
            <div class="d-flex">
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="White">
                    <label>
                        <input type="radio" name="setting-theme" value="white">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Blue light">
                    <label>
                        <input type="radio" name="setting-theme" value="blue-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-blue"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Green light">
                    <label>
                        <input type="radio" name="setting-theme" value="green-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-green"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Purple light">
                    <label>
                        <input type="radio" name="setting-theme" value="purple-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-purple"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Orange light">
                    <label>
                        <input type="radio" name="setting-theme" value="orange-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-orange"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
                <div class="color-skin-box" data-toggle="tooltip" data-original-title="Pink light">
                    <label>
                        <input type="radio" name="setting-theme" value="pink-light">
                        <span class="color-check-icon"><i class="fa fa-check"></i></span>
                        <div class="color bg-pink"></div>
                        <div class="color-small bg-silver-100"></div>
                    </label>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- END THEME CONFIG PANEL-->
    <!-- BEGIN PAGA BACKDROPS-->
    <div class="sidenav-backdrop backdrop"></div>
    <div class="preloader-backdrop">
        <div class="page-preloader">Loading</div>
    </div>
    <!-- END PAGA BACKDROPS-->

    <!-- CORE PLUGINS-->
    <script src="{{ asset('/') }}assets/vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/vendors/popper.js/dist/umd/popper.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/vendors/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/vendors/metisMenu/dist/metisMenu.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/vendors/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL PLUGINS-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="{{ asset('/') }}assets/vendors/chart.js/dist/Chart.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/vendors/jvectormap/jquery-jvectormap-2.0.3.min.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <script src="{{ asset('/') }}assets/vendors/jvectormap/jquery-jvectormap-us-aea-en.js" type="text/javascript"></script>

    <script src="{{ asset('/') }}assets/js/custom.js" type="text/javascript"></script>


      {{-- =================== Datatables Script ================== --}}
      <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
      <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
      <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    <!-- CORE SCRIPTS-->
    <script src="{{ asset('/') }}assets/js/app.min.js" type="text/javascript"></script>

    {{-- Drofify link --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js" integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- summer note js link --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    {{-- toastr message --}}
    <script src="{{ asset('/') }}assets/toastr.min.js" type="text/javascript"></script>
    <!-- PAGE LEVEL SCRIPTS-->
    <script src="{{ asset('/') }}assets/js/scripts/dashboard_1_demo.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.min.js" integrity="sha512-SXJkO2QQrKk2amHckjns/RYjUIBCI34edl9yh0dzgw3scKu0q4Bo/dUr+sGHMUha0j9Q1Y7fJXJMaBi4xtyfDw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        var _token = "{{ csrf_token() }}";
    </script>

    <script>

        // summernote run code
        $(document).ready(function() {
            $('#summernote').summernote();
        });


        // sweet alert delete warning
        function deleteWarning(url,data_id){
                    Swal.fire({
                    title: 'Are you sure?',
                    text: "To Delete this Data",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Confirm'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,
                                type: "post",
                                data:{_token:_token,data_id:data_id},
                                success: function (response) {
                                    if (response.status =='success') {
                                        table.ajax.reload();
                                        toastr.success('Data Delete Success');
                                    }
                                },
                                error: function (response) {
                                    toastr.error('Opps! Something went wrong');

                                }
                            });
                        }
                    })
                }



        @if (Session::has('message'))
            var type ="{{ Session::get('alert-type','info') }}"
            switch(type){
                case 'success':
                    toastr.success("{{ Session::get('message') }}")
                    break;
                case 'info':
                    toastr.info("{{ Session::get('message') }}")
                    break;
                case 'warning':
                    toastr.warning("{{ Session::get('message') }}")
                    break;
                case 'error':
                    toastr.error("{{ Session::get('message') }}")
                    break;
            }
        @endif



        function alertMessage(status,message){

            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            switch(status) {
                case 'success':
                    toastr.success(message)
                    break;
                case 'error':
                    toastr.error(message)
                    break;
                case 'warning':
                    toastr.warning(message)
                    break;
                case 'info':
                    toastr.info(message)
                    break;
                }


            }

            @if (session()->get('success'))
                alertMessage('success',"{{ session()->get('success') }}");
            @elseif (session()->get('error'))
                alertMessage('error',"{{ session()->get('error') }}");
            @elseif (session()->get('info'))
                alertMessage('info',"{{ session()->get('info') }}");
            @elseif (session()->get('warning'))
                alertMessage('warning',"{{ session()->get('warning') }}");
            @endif


            $('.dropify').dropify();

    </script>


@stack('scripts')

</body>

</html>
