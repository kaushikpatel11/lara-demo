<!DOCTYPE html>
<html>
  <head>
    <title>Change Email</title>
  </head>
  <body>
    <h2>Hey {{$user['fname']}},</h2>
    <br/>
    You're almost ready to use your new email on demo! Please follow the link below to verify your email address.
    <br>
    <br/>
    <a href="{{ url(env('demo_WEBSITE_URL')) .'/confirm-account'. '?email='.$user->temp_email.'&confirmation_token='.$user->api_token }}">Verify your email address</a>
    <br>
    <br>

  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>