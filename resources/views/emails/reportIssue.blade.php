<!DOCTYPE html>
<html>
  <head>
    <title>Request Reported</title>
  </head>
  <body>
    <h2>Hey {{$issue['request']->createdBy->fname}}</h2>
    <br/>
    Please be notified that Admin has just reported an issue in your request for the event "{{$issue['request']->event->title}}".
    <p><b>Details : </b><br>
        <br>
        Band Name : {{$issue['request']->band->name}},<br>
        Date : {{$issue['request']->event->date}},<br>
        Location : {{$issue['request']->event->location}},<br>
        Number of Attendees : {{$issue['request']->event->number_of_attendees}},<br>
        Budget : {{$issue['request']->talent_budget}},<br>
        Start time : {{$issue['request']->event->start_time}},<br>
        Length : {{$issue['request']->event->desired_set_length}} minutes,<br>
        Notes : {{$issue['request']->notes}},<br>
        Status : {{$issue['request']->status}}
    </p>
    <b>Reason :</b> {{$issue['reason']}}
    <br/>
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>