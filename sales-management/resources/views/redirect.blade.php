<!DOCTYPE html>
<html>
 <head>
  <script>
    function loadComplete(){
        window.location.href='{{ $redirect }}'
    }
    
    function closeOnLoad(myLink)
    {
        var newWindow = window.open(myLink, "connectWindow", "width=600,height=400,scrollbars=yes");
        setTimeout(
                function()
                {
                newWindow.close();
                },
            900
        );
        return false;
    }
    
    function setWebCookie(){
        @foreach($host as $value)    
            closeOnLoad('{{$value}}');
        @endforeach
        setTimeout(
                function()
                {
                    loadComplete()
                },
            1000
        );
    }
  </script>
 </head>
 <body>
  <p>
  Click <button onclick="setWebCookie()">here</button> to continue...
  <!-- <img src="{{ $value }}" style="display:none;" /> -->
  <!-- The browser no longer support it -->  
  </p>
 </body>
</html>