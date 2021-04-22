<!DOCTYPE html>
<html>
  <head>
    <title>Event Request Confirmed</title>
  </head>
  <body>
    <h2>Hey {{$bandRequest->createdBy->fname}}</h2>
    <br/>
    Please be notified that "{{$bandRequest->band->name}}" has just confirmed your request for the event "{{$bandRequest->event->title}}", if you want this talent to perform in your event,
     you just need to send him your final confirmation.
    <br/>
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>