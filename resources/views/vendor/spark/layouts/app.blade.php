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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker3.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.14.1/dist/bootstrap-table.min.css">
    <!-- CSS -->
    <link href="{{ mix(Spark::usesRightToLeftTheme() ? 'css/app-rtl.css' : 'css/app.css') }}" rel="stylesheet">

    <!-- flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Scripts -->
    @stack('scripts')

    <!-- Global Spark Object -->
    <script>
        window.Spark = @json(array_merge(Spark::scriptVariables(), []));
    </script>
    
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
         
            <nav id="sidebar" class="col-md-3">

                @include('spark::nav.user-left')
            </nav>
            
            <main class="py-4  col-md-9 mx-auto">
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
    <!-- flatpickr -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="/js/sweetalert.min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPTtrYvFKQQLcrKoHzTdmtB9-0e_cx8Qo&libraries=drawing,geometry,places&region=EC&callback=initMap">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/bootstrap-table@1.14.1/dist/bootstrap-table.min.js"></script>
  
    </script>
    
      <script>
          $(function () {
            if($(window).width()>=765){
                $("#sidebar").removeClass("active");
                $("#sidebar").removeClass("fixed");
              }else{
                $("#sidebar").addClass("active");
                $("#sidebar").addClass("fixed");
             
              }
             
              $('#sidebar').on('focusout', function () {
                if($(window).width()<=765){
                    $('#sidebar').toggleClass('active');
                }
                
             });
            $(window).resize(function(e) {
                if($(window).width()>=765){
                  $("#sidebar").removeClass("active");
                  $("#sidebar").removeClass("fixed");
                }else{
                  $("#sidebar").addClass("active");
                  $("#sidebar").addClass("fixed");
                }
              });
          
              $('#sidebarcollapse').on('click', function () {
                  $('#sidebar').toggleClass('active');
               });
               
        });
      </script>
    @yield('cultivation-scripts')
    @yield('custom-scripts')
</body>
</html>
