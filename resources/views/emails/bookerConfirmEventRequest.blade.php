<!DOCTYPE html>
<html>
  <head>
    <title>Event Request Approved</title>
  </head>
  <body>
    <h2>Hey {{$bandRequest->band->createdBy->fname}}</h2>
    <br/>
    Please be notified that "{{$bandRequest->createdBy->fname}}" has just approved your request for the event "{{$bandRequest->event->title}}" and it is now pending for payment.
    <br/>
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>