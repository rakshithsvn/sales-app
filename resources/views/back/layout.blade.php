<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@lang('Sales App - Administration')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  {{--<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}

  <link rel="shortcut icon" href="/assets/images/logo/favicon.png" type="image/x-icon">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

<!-- CSS only -->
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

  <link href="{{asset('adminlte/lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">

  {{-- <link href="{{asset('lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE.min.css') }}"> --}}

  <!-- AdminLTE Skins. -->
  <link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-blue.css') }}">
  {{-- <link rel="stylesheet" href="{{ asset('adminlte/css/skins/skin-blue.min.css') }}"> --}}

  <!-- Vue Js -->
  <script src="{{ asset('plugins/vue/vue.js') }}"></script>
  <script src="{{ asset('plugins/vue/axios.min.js') }}"></script>

  <link href="{{asset('plugins/vue-snotify/material.css')}}" rel="stylesheet">
  <script src="{{ asset('plugins/vue-snotify/vue-snotify.min.js') }}"></script>

  @yield('css')

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

      <!-- Logo -->
      <a href="{{ route('dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><img src="/adminlte/img/AdminLTELogo.png" class="img-fluid"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>@lang('Master Admin')</b></span>
      </a>

      <!-- Header Navbar -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- Notifications Menu -->
            <!-- @if ($countNotifications ?? '') -->
            <li class="dropdown notifications-menu">
              <!-- Menu toggle button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>

                <span class="label label-warning">{{ @$countNotifications ?? '' }}</span>

              </a>
              <ul class="dropdown-menu">
                <li class="header">@lang('New notifications')</li>
                <li>
                  <!-- Inner Menu: contains the notifications -->
                  <ul class="menu">
                    <li><!-- start notification -->
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> {{ $countNotifications ?? '' }} @lang('new') {{ trans_choice(__('comment|comments'), $countNotifications ?? '') }}
                      </a>
                    </li>
                    <!-- end notification -->
                  </ul>
                </li>
                <li class="footer"><a href="{{ route('notifications.index', [auth()->id()]) }}">@lang('View')</a></li>
              </ul>
            </li>
            <!-- @endif -->

            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <span class="fa fa-user"> </span>
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <span class="hidden-xs">{{ auth()->user()->name }}</span>
                {{-- <span class="fa fa-caret-down" style="margin-left: 5px"></span> --}}
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <span class="fa fa-user"> </span>
                  <p>{{ auth()->user()->name }}</p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">

                 <div class="pull-left">

                  <a href="{{ route('users.changepassword') }}" class="btn btn-default btn-flat">@lang('Change Password')
                  </a>
                </div>

                <div class="pull-right">
                  <a id="logout" href="#" class="btn btn-default btn-flat">@lang('Sign out')</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hide">
                    {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        @if(auth()->user()->role == 'admin')

        <li>
          <a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> <span>@lang('Dashboard')</span></a>
        </li>

        <!-- <li>
          <a href="{{ route('home.index') }}"><i class="fa fa-home"></i> <span>@lang('Home')</span></a>
        </li> -->

        <li><a href="{{ route('event-users.index') }}"><i class="fa fa-user-circle-o"></i><span>@lang('Users')</span></a></li>

        <li>
          <a href="{{ route('products.index') }}"><i class="fa fa-product-hunt"></i> <span>@lang('Products')</span></a>
        </li>

        <li>
          <a href="{{ route('dealers.index') }}"><i class="fa fa-industry"></i> <span>@lang('Dealers')</span></a>
        </li>

        <li>
          <a href="{{ route('prospects.graduation-index') }}"><i class="fa fa-shopping-cart"></i> <span>@lang('Purchase History')</span></a>
        </li>

        <li>
          <a href="{{ route('help-messages.index') }}"><i class="fa fa-question-circle"></i> <span>@lang('Help Messages')</span></a>
        </li>

        

        <!-- <li><a href="{{ route('gallery.index') }}"><i class="fa fa-file-image-o"></i><span>@lang('Event Agenda')</span></a></li>

        @include('back.partials.treeview', [
          'icon' => 'users',
          'type' => 'faculty',
          'items' => [
            [
              'route' => route('faculties.index'),
              'command' => 'list',
              'color' => 'yellow',
            ],
            [
              'route' => route('faculties.create'),
              'command' => 'create',
              'color' => 'green',
            ],
            [
              'route' => route('link-faculties.index'),
              'command' => 'link-faculty-post',
              'color' => 'blue',
            ],
          ],
          ])
          
        <li><a href="{{ route('notifications.index') }}"><i class="fa fa-bell-o"></i> <span>@lang('Notifications')</span></a></li>


        <li><a href="{{ route('link-users.index') }}"><i class="fa fa-link"></i><span>@lang('Link Users')</span></a></li>
        

        <li><a href="{{ route('parent-menus.index') }}"><i class="fa fa-th "></i> <span>@lang('Parent Menu')</span></a></li>

        <li><a href="{{ route('sub-menus.index') }}"><i class="fa fa-bars "></i> <span>@lang('Sub Menu')</span></a></li>

        <li><a href="{{ route('child-menus.index') }}"><i class="fa fa-minus-square-o"></i> <span>@lang('Child Menu')</span></a></li>

        {{-- <li><a href="{{ route('sub-child-menus.index') }}"><i class="fa fa-minus-square"></i> <span>@lang('Sub Child Menu')</span></a></li> --}}

        <li><a href="{{ route('categories.index') }}"><i class="fa fa-list"></i> <span>@lang('Categories')</span></a></li>


        @include('back.partials.treeview', [
          'icon' => 'file-text',
          'type' => 'post',
          'items' => [
            [
              'route' => route('posts.index'),
              'command' => 'list',
              'color' => 'blue',
            ],
            [
              'route' => route('posts.index', ['new' => 'on']),
              'command' => 'new',
              'color' => 'yellow',
            ],
            [
              'route' => route('posts.create'),
              'command' => 'create',
              'color' => 'green',
            ],
            [
              'route' => route('post-link-pages.index'),
              'command' => 'post-external-link',
              'color' => 'red',
            ],
          ],
          ]) -->

          <!-- <li><a href="{{ route('sliders.index') }}"><i class="fa fa-sliders"></i> <span>@lang('Sliders')</span></a></li> -->

          <!-- <li><a href="{{ route('medias.index') }}"><i class="fa fa-upload"></i> <span>@lang('Upload Images')</span></a></li> -->

          <!-- <li><a href="{{ route('albums.index') }}"><i class="fa fa-image"></i> <span>@lang('Gallery Photos')</span></a></li>

          <li><a href="{{ route('videos.upload-video') }}"><i class="fa fa-video-camera"></i> <span>@lang('Videos Gallery')</span></a></li> -->

          <!-- <li><a href="{{ route('placement.create') }}"><i class="fa fa-handshake-o"></i> <span>@lang('Careers')</span></a></li> -->

          <!-- <li><a href="{{ route('roi.index') }}"><i class="fa fa-calculator"></i> <span>@lang('ROI Credentials')</span></a></li>

          <li><a href="{{ route('albums.upload-photos') }}"><i class="fa fa-handshake-o"></i> <span>@lang('Our Clients')</span></a></li>

          <li><a href="{{ route('features.index') }}"><i class="fa fa-plus-square"></i> <span>@lang('Choose Us')</span></a></li>

          <li><a href="{{ route('choose.index') }}"><i class="fa fa-calculator"></i> <span>@lang('Statistics Count')</span></a></li>

          <li><a href="{{ route('prospects.index') }}"><i class="fa fa-upload"></i> <span>@lang('Upload Files')</span></a></li>

          <li><a href="{{ route('testimonials.index') }}"><i class="fa fa-envelope-open"></i> <span>@lang('Testimonials Details')</span></a></li>

          <li><a href="{{ route('prospects.graduation-index') }}"><i class="fa fa-graduation-cap"></i> <span>@lang('Alumni Register')</span></a></li> -->

          <!-- <li><a href="{{ route('prospects.application-index') }}"><i class="fa fa-stethoscope"></i> <span>@lang('Doctor Appointment')</span></a></li> -->

          <!-- <li><a href="{{ route('prospects.sms-index') }}"> <i class="fa fa-envelope"></i> <span>SMS Report</span></a> </li> -->

          <!-- <li><a href="{{ route('address.index') }}"><i class="fa fa-address-card"></i> <span>@lang('Address')</span></a></li> -->

          @if ($countNotifications ?? '')
          <li><a href="{{ route('notifications.index', [auth()->id()]) }}"><i class="fa fa-bell"></i> <span>@lang('Notifications')</span></a></li>
          @endif


          @include('back.partials.treeview', [
            'icon' => 'user',
            'type' => 'user',
            'items' => [
              [
                'route' => route('users.index'),
                'command' => 'list',
                'color' => 'blue',
              ],
            
              [
                'route' => route('users.create'),
                'command' => 'create',
                'color' => 'green',
              ],
            ],
            ])

       {{--   @include('back.partials.treeview', [
            'icon' => 'envelope',
            'type' => 'contact',
            'items' => [
              [
                'route' => route('contacts.index'),
                'command' => 'list',
                'color' => 'blue',
              ],
              [
                'route' => route('contacts.index', ['new' => 'on']),
                'command' => 'new',
                'color' => 'yellow',
              ],
            ],
          ])

          @include('back.partials.treeview', [
            'icon' => 'comment',
            'type' => 'comment',
            'items' => [
              [
                'route' => route('comments.index'),
                'command' => 'list',
                'color' => 'blue',
              ],
              [
                'route' => route('comments.index', ['new' => 'on']),
                'command' => 'new',
                'color' => 'yellow',
              ],
            ],
          ])

          --}}

          @endif

        </ul>
        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1> {{ @$title }} </h1>
        <div class="btn-layout pull-right"> @yield('button') </div>
      {{--<ol class="breadcrumb">
        @foreach ($breadcrumbs as $item)
          <li @if ($loop->last && $item['url'] === '#') class="active" @endif>
            @if ($item['url'] !== '#')
              <a href="{{ $item['url'] }}">
            @endif
            @isset($item['icon'])
              <span class="fa fa-{{ $item['icon'] }}"></span>
            @endisset
            {{ $item['name'] }}
            @if ($item['url'] !== '#')
              </a>
            @endif
          </li>
        @endforeach
      </ol>--}}
    </section>

    <!-- Main content -->
    <section class="content">
      @yield('main')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->
    <div class="pull-right">
      <strong>Copyright &copy; {{ now()->year }} <a href="{{route('home')}}">@lang('Sales App')</a> . </strong> @lang('All rights reserved').
    </div>
  </footer>

</div>

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3.2.0 -->
<script src="https://code.jquery.com/jquery-3.2.0.min.js"></script>
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/sweetalert2/6.3.8/sweetalert2.min.js"></script>

@yield('js')

<!-- Vue Js -->
<script src="{{ asset('js/ImageUploadComponent.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/app.min.js') }}"></script>

<!-- Commom -->
{{--<script src="/adminlte/js/common.js"></script>--}}

<!-- Optionally, you can add Slimscroll and FastClick plugins.about-us#
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->

     <script>
      $(function() {
        $('#logout').click(function(e) {
          e.preventDefault();
          $('#logout-form').submit()
        })

        $(window).on('unload', function(e) {
          e.preventDefault();
          $('#logout-form').submit()
        });

        $(window).on('beforeunload', function(e) {
          e.preventDefault();
          $('#logout-form').submit()
        });
      });
    </script>
  </body>
  </html>
