<!DOCTYPE html>
<html>
  <head>
    <title>Contact us form submission</title>
  </head>
  <body>
    <h3>Contact Request</h3>
    <br/>
    Please be notified that "{{$contact['name']}}" has just submitted a form to contact us with the below details:
    <br/>
    <br>
    <b>Name:</b> "{{$contact['name']}}",
    <br>
    <b>Email:</b> "{{$contact['email']}}",
    <br>
    <b>Message:</b> "{{$contact['message']}}"
    <br>
    <br>
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>