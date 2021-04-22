<!DOCTYPE html>
<html>
  <head>
    <title>Event Request Confirmed and Pending full payment</title>
  </head>
  <body>
    <h2>Hey {{$bandRequest->createdBy->fname}}</h2>
    <br/>
    This email is to notify you that "{{$bandRequest->band->name}}" accepted your request for the event "{{$bandRequest->event->title}}", and event is now pending full payment.
    <br/>
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>