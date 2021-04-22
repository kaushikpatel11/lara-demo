<!DOCTYPE html>
<html>
  <head>
    <title>Event Details Updated</title>
  </head>
  <body>
    <h2>Hey</h2>
    <br/>
    This email is to notify you that {{$event->createdBy->fname." ".$event->createdBy->lname}} changed the event "{{$event->title}}" details.
    <br/>
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>