<!DOCTYPE html>
<html>
<head>
  <title>Promotional Email</title>
</head>
<body>
  <h3>Hey</h3>
  <br/>
  Please be notified about our new promotions:
  <p><b>{{$body->title}}</b><br>
    <br>
    {{$body->description}}<br>
    <br/>
    @isset($body->photo->url)
    <img src= {{$body->photo->url}} width="550" height="370"/>
    @endisset
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
  </html>