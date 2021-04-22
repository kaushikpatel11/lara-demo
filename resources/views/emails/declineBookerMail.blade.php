<!DOCTYPE html>
<html>
  <head>
    <title>User Profile Rejected</title>
  </head>
  <body>
    <h2>Hey {{$rejection['user']->fname}}</h2>
    <br/>
    Your profile is pending on the admin approval, please add the following information.
    <br/>
    <br>
    {{$rejection['reason']}}
    <br>
    <br>
    Press <a href="{{ url(env('demo_WEBSITE_URL')) .'/users/'.$rejection['user']->id }}">here</a> to go to your profile.
  </body>
  <footer>
    <h4>Regards, <br>demo Team </h4> 
  </footer>
</html>