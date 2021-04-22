<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <style>
    table {
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid black;
    }
    th {
      background-color: #4CAF50;
      color: white;
    }
    .img-container {
      text-align: center;
    }
  </style>
</head>
<body>
  <h2>Request Information</h2>
  <li>Status: {{$request['status']}}</li>
  <li>Notes: {{$request['notes']}}</li>
  <li>Talent Budget: {{$request['talent_budget']}}</li>
  <li>Production Budget: {{$request['production_budget']}}</li>
 
  <h2>Band Details</h2>
      <li>Name: {{$band['name']}}</li>
      <li>Email: {{$band['createdBy']['email']}}
      <li>Bio: {{$band['bio']}}</li>
      <li>State: {{$band['state']['title']}}</li>
      <li>Size: {{$band['size']}}</li>
      <li>Location: {{$band['location']}}</li>
      <li>Price From: {{$band['price_from']}}</li>
      <li>Price To: {{$band['price_to']}}</li>
      <li>Deposit %: {{$band['deposit']}}</li>
      @isset ($band['hospitalityAndProductionRider']['url'])
      <li>Production Writer: <a href={{$band['hospitalityAndProductionRider']['url']? $band['hospitalityAndProductionRider']['url'] : ""}}>Open</a></p>
      @endisset

  <h2>Event Details</h2>
      <li>Title: {{$event['title']}}</li>
      <li>Creator Name: {{$event['createdBy']['fname']}} &nbsp;{{$event['createdBy']['lname']}}</li>
      <li>Creator Email: {{$event['createdBy']['email']}}</li>
      <li>Date: {{$event['date']}}</li>
      <li>Description: {{$event['description']}}</li>
      <li>Status: {{$event['status']}}</li>
      <li>Location: {{$event['location']}}</li>
      <li>Start time: {{$event['start_time']}}</li>
      <li>End time: {{$event['end_time']}}</li>
      <li>State: {{$event['state']['title']}}</li>
      <li>Number of attendees: {{$event['number_of_attendees']}}</li>
      <li>Desired length: {{$event['desired_set_length']}}</li>
      
    @isset ($agent)
    <h2>Agent Details</h2>
      <li>Name: {{$agent['fname']}} {{$agent['lname']}}</li>
      <li>Phone Number: {{$agent['phone_number']}}</li>
      <li>Agency Name: {{$agent['organization_name']}}</li>
      <li>Email: {{$agent['email']}}</li>
    @endisset
    
</body>
</body>
</html>