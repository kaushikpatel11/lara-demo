<!DOCTYPE html>
<html>
  <head>
    <title>Event Request Booker for Other band</title>
  </head>
  <body>
    <h2>Hey {{$request->band->createdBy->fname}}</h2>
    <br/>
    This email is to notify you that this event "{{$request->event->title}}" is booked to another band.
    <br/>
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>