<!DOCTYPE html>
<html>
  <head>
    <title>Email Changed Successfully</title>
  </head>
  <body>
    <h2>Hey {{$user['fname']}}</h2>
    <br/>
    This is to confirm that you requested to change demo account email to {{$user['temp_email']}} .
    <br/>
    <br>
    Please contact support if you encounter any problems logging in.
    <br>
    <br>

  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>