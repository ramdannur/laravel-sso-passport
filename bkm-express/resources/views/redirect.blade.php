<!DOCTYPE html>
<html>
 <head>
  <script>
   function loadComplete(){
    window.location.href='{{ $redirect }}'
   }
  </script>
 </head>
 <body onload="loadComplete()">
  <p>
  Please Wait...
  </p>
  @foreach($host as $value)
  <img src="{{ $value }}" style="display:none;" />
  @endforeach
 </body>
</html>