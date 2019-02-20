<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', config('app.name'))</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600' rel='stylesheet' type='text/css'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- CSS -->
    <link href="{{ mix(Spark::usesRightToLeftTheme() ? 'css/app-rtl.css' : 'css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    @stack('scripts')

    <!-- Global Spark Object -->
    <script>
        window.Spark = @json(array_merge(Spark::scriptVariables(), []));
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
</head>
<body>
    <div id="spark-app" v-cloak>
        <!-- Navigation -->
        @if (Auth::check())
            @include('spark::nav.user')

        @else
            {{-- @include('spark::nav.guest') --}}
            <div class="login-background"  style="background-image:url({{ asset('images/bg-login.jpg') }});"></div>
        @endif
          <!-- Main Content -->
        <div class="row">
                @if (Auth::check())
                <div class="wrapper">
            <nav id="sidebar">

                @include('spark::nav.user-left')

            </nav>
        </div>
            <main class="py-4 col-md-9">
                    @yield('content')
                </main>
            @else
            <main class="py-4 col-md-9 mx-auto">
                    @yield('content')
                </main>
            @endif

        </div>

        <!-- Application Level Modals -->
        @if (Auth::check())
            @include('spark::modals.notifications')
            @include('spark::modals.support')
            @include('spark::modals.session-expired')
        @endif
    </div>

    <!-- JavaScript -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script src="{{ asset('js/gmaps.js') }}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPTtrYvFKQQLcrKoHzTdmtB9-0e_cx8Qo&region=EC&callback=initMap">
    </script>
         <script src="{{ asset('js/charts.js') }}"> </script>
      <script>
          $(document).ready(function () {
            $(window).resize(function(e) {
                if($(window).width()>=760){
                  $("#sidebar").removeClass("active");
                  $("#sidebar").removeClass("fixed");
                }else{
                  $("#sidebar").addClass("active");
                  $("#sidebar").addClass("fixed");
                }
              });
          
              $('#sidebarcollapse').on('click', function () {
                  console.log("hello");
                  $('#sidebar').toggleClass('active');
                  //$('#sidebar').toggleClass('in');
                  //$('a[aria-expanded=true]').attr('aria-expanded', 'false');
              });
          });
      </script>
</body>
</html>
