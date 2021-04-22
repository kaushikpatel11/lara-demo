<!DOCTYPE html>
<html>
  <head>
    <title>Event remainder received</title>
  </head>
  <body>
    <h2>Hey {{$bandRequest->band->createdBy->fname}}</h2>
    <br/>
    This email is to notify you that the remainder is sent by "{{$bandRequest->createdBy->fname}}" for the following event "{{$bandRequest->event->title}}".
    <br/>
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>