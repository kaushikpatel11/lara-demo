<!DOCTYPE html>
<html>
  <head>
    <title>Suggestion Email</title>
  </head>
  <body>
    <h1>New suggestion</h1>    
    <p><h2><b>User Detail:</b></h2></p>

    <br/>
    <div><b>First Name:</b> {{$suggestion->first_name}}</div>
    <div><b>Last Name:</b> {{$suggestion->last_name}}</div>
    <div><b>Email:</b> {{$suggestion->email}}</div>

    <br/>

    <p><h2><b>Suggestion Detail:</b></h2></p>
    @if($suggestion->type == 'artist')      
      <div><b>Artist Name:</b> {{$suggestion->artist_name}}</div>
      <div><b>Artist Contact:</b> {{$suggestion->artist_contact}}</div>
    @endif 

    <div><b>Suggestion Type:</b> {{$suggestion->type}}</div>
    <div><b>Event Date:</b> {{$suggestion->event_date}}</div>
    <div><b>Artist Description:</b> {{$suggestion->description}}</div>

  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>