<!DOCTYPE html>
<html>
  <head>
    <title>Event remainder sent</title>
  </head>
  <body>
    <h2>Hey {{$bandRequest->createdBy->fname}}</h2>
    <br/>
    This email is to notify you that you sent the remainder to this band "{{$bandRequest->band->name}}" for the following event "{{$bandRequest->event->title}}".
    <br/>
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>