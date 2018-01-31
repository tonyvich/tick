<!DOCTYPE html>
<html>
    <head>
        <!-- Meta data -->
        <meta charset="utf-8">
        <meta name="description" content="Responsive, Bootstrap, BS4" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ trans('installer_messages.title') }}</title>
        
        <!-- for ios 7 style, multi-resolution icon of 152x152 -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
        <link rel="apple-touch-icon" href="images/logo.png">
        <meta name="apple-mobile-web-app-title" content="Flatkit">
        <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="shortcut icon" sizes="196x196" href="images/logo.png">
    
        <!-- style -->
        <link href="{{ asset('css/animate.css/animate.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/glyphicons/glyphicons.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/material-design-icons/material-design-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('css/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">
        <link href="{{ asset('css/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- build:css css/styles/app.min.css -->
        <link href="{{ asset('css/styles/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styles/style.css') }}" rel="stylesheet">
        <!-- endbuild -->
        <link href="{{ asset('css/styles/font.css') }}" rel="stylesheet">
        
        @yield('style')
        <script>
            window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
            ]); ?>
        </script>

    </head>
    <body>
        <div class="app" id="app">
            <!-- ############ LAYOUT START-->
            <div class="padding">
                <div class="navbar">
                    <div class="pull-center">
                        <!-- brand -->
                        <a href="#" class="navbar-brand">
                            <span class="hidden-folded inline">@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ trans('installer_messages.title') }}</span>
                        </a>
                        <!-- / brand -->
                    </div>
                </div>
            </div>
            <div class="b-t">
                <div class="center-block w-auto-xs p-y-md text-center" style="width:450px;">
                    <div class="box">
                        <div class="box-header indigo">
                            <h3>@yield('title')</h3>
                        </div>
                        <div class="box-body">
                            @if (session('message'))
                                <p class="alert text-center">
                                    <strong>
                                        @if(is_array(session('message')))
                                            {{ session('message')['message'] }}
                                        @else
                                            {{ session('message') }}
                                        @endif
                                    </strong>
                                </p>
                            @endif
                            @if(session()->has('errors'))
                                <div class="alert alert-danger" id="error_alert">
                                    <button type="button" class="close" id="close_alert" data-dismiss="alert" aria-hidden="true">
                                        <i class="fa fa-close" aria-hidden="true"></i>
                                    </button>
                                    <h4>
                                        <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i>
                                        {{ trans('installer_messages.forms.errorTitle') }}
                                    </h4>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @yield('container')
                        </div>
                    </div>                        
                </div>
            </div>
            <!-- ############ LAYOUT END-->
        </div>

        <!-- build:js scripts/app.min.js -->
        <!-- jQuery -->
        <script src="{{ asset('libs/jquery/dist/jquery.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('libs/tether/dist/js/tether.min.js') }}"></script>
        <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.js') }}"></script>
        <!-- core -->
        <script src="{{ asset('libs/jQuery-Storage-API/jquery.storageapi.min.js') }}"></script>
        <script src="{{ asset('libs/PACE/pace.min.js') }}"></script>
        <script src="{{ asset('libs/jquery-pjax/jquery.pjax.js') }}"></script>
        <script src="{{ asset('libs/blockUI/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('libs/jscroll/jquery.jscroll.min.js') }}"></script>

        <script src="{{ asset('scripts/config.lazyload.js') }}"></script> 
        <script src="{{ asset('scripts/ui-load.js') }}"></script>
        <script src="{{ asset('scripts/ui-jp.js') }}"></script>
        <script src="{{ asset('scripts/ui-include.js') }}"></script>
        <script src="{{ asset('scripts/ui-device.js') }}"></script>
        <script src="{{ asset('scripts/ui-form.js') }}"></script>
        <script src="{{ asset('scripts/ui-modal.js') }}"></script>
        <script src="{{ asset('scripts/ui-nav.js') }}"></script>
        <script src="{{ asset('scripts/ui-list.js') }}"></script>
        <script src="{{ asset('scripts/ui-screenfull.js') }}"></script>
        <script src="{{ asset('scripts/ui-scroll-to.js') }}"></script>
        <script src="{{ asset('scripts/ui-toggle-class.js') }}"></script>
        <script src="{{ asset('scripts/ui-taburl.js') }}"></script>
        <script src="{{ asset('scripts/app.js') }}"></script>
        <script src="{{ asset('scripts/ajax.js') }}"></script>
        <!-- endbuild -->
        @yield('scripts')
        <script type="text/javascript">
            var x = document.getElementById('error_alert');
            var y = document.getElementById('close_alert');
            y.onclick = function() {
                x.style.display = "none";
            };
        </script>
    </body>
</html>
