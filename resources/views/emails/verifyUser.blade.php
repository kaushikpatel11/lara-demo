<!DOCTYPE html>
<html>
  <head>
    <title>Welcome Email</title>
  </head>
  <body>
    <h2>Hey {{$user['fname']}},</h2>
    <br/>
    You're almost ready to start enjoying demo! Please follow the link below to verify your email address.
    <br>
    <br/>
    <a href="{{ url(env('demo_WEBSITE_URL')) .'/confirm-account'. '?email='. urlencode($user->email).'&confirmation_token='.urlencode($user->api_token) }}">Verify your email address</a>
    <br>
    <br>

  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>