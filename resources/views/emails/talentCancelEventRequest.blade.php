<!DOCTYPE html>
<html>
  <head>
    <title>Event Request Canceled</title>
  </head>
  <body>
    <h2>Hey {{$bandRequest->createdBy->fname}}</h2>
    <br/>
    Please be notified that "{{$bandRequest->band->name}}" has just canceled your request for the event "{{$bandRequest->event->title}}".
    <br/>
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>