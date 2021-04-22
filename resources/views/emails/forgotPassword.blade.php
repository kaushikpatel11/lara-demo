<!DOCTYPE html>
<html>
  <head>
    <title>Forgot Password</title>
  </head>
  <body>
    <h2>Hey {{$reset->name}}</h2>
    <br/>
    We have received a request to reset your demo account password. If you have not initiated that request please ignore this email.
    <br/>
    <br>
    Click the following link to reset your password:
    <a href="{{ url(env('demo_WEBSITE_URL')) .'/reset-password'. '?reset-token=' . $reset->token }}">Reset your password</a>
    <br>
    <br>

  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>