<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials._head')
  </head>
  <body>
    @include('partials._nav')    

    @yield('blurred')
    <div class="container" id="app">
      @include('partials._messages')
      
      @yield('content')

      @include('partials._footer')

      @yield('addon')
        @include('partials._modal')
    </div> <!-- end of .container --> 

        @include('partials._javascript')

        @yield('scripts')
  </body>
</html>
