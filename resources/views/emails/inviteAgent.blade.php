<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Invitation from the demo Agent</title>
    <meta name="Description" content="" />
    <meta name="Keywords" content=""/>
    <link rel="canonical" href="https://www.demo.com" />
    <link rel="icon" href="https://staging.demo.com/favicon-32x32.png">
    <link rel="shortcut icon" href="https://staging.demo.com/favicon-32x32.png">
    <link rel="apple-touch-icon" sizes="57x57" href="https://staging.demo.com/favicon-32x32.png">
    <meta name="msapplication-TileImage" content="https://staging.demo.com/favicon-32x32.png">
  </head>
  <body>
    <table cellspacing="0" cellpadding="0px" width="600px" align="center" style="background-color: #080522;">
        <!-- Header Section -->
        <tr>
            <td>
                <table cellspacing="0" cellpadding="0px" width="100%" style="color: #ffffff; border-bottom: 1px solid #64FECC;">
                    <tr>
                        <td align="left" valign="middle" width="30%">
                            <a aria-current="page" href="{{url(env('demo_WEBSITE_URL'))}}" style="display: inline-block;text-decoration:none;">
                                <img src="https://tc-demo-dev.s3.us-east-2.amazonaws.com/assets/email-demo-logo-white.png" style="width: 147px; margin-left: 20px; vertical-align: middle;">
                            </a>
                        </td>
                        <td style="padding:10px 20px;" width="70%">
                            <h2 style="font-weight: bold; color: #64FECC; font-size: 20px; text-align: right;">Invitation from the demo Agent</h2>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <!-- Container Section -->
        <tr>
            <td style="padding:20px 30px;min-height:300px; vertical-align: top;">
            @if ($user_data)
                <h3 style="font-size: 18px;margin-bottom: 10px; color:#ffffff">Hey {{$user_data['fname']}} {{$user_data['lname']}},</h3>
                <p style="color:#ffffff"> {{$user['fname']}}  {{$user['lname']}} Invited you to Associate with the band now.</p>
                <p style="margin-top:60px;margin-bottom: 40px;">
                   <a href="{{ url(env('demo_WEBSITE_URL')) .'/update/band-request-status'. '?confirmation_token='.urlencode($user->api_token).'&agent_token='.urlencode($user_data['api_token']).'&status='.urlencode('ACCEPTED_BY_AGENT') }}" style="background-color: #64FECC; border:2px solid #64FECC; color: #0F24FD; border-radius: 3px; font-weight: bold; font-size: 15px; text-decoration: none; padding:12px 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; margin-right: 15px">Approve</a>
                    <a href="{{ url(env('demo_WEBSITE_URL')) .'/update/band-request-status'. '?confirmation_token='.urlencode($user->api_token).'&agent_token='.urlencode($user_data['api_token']).'&status='.urlencode('REJECTED_BY_AGENT') }}" style="background-color: transparent; border:2px solid #64FECC; color: #64FECC; border-radius: 3px; font-weight: bold; font-size: 15px; text-decoration: none; padding:12px 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;">Reject</a>
                </p>
              @else
                <h3 style="font-size: 18px;margin-bottom: 10px; color:#ffffff">Hey,</h3>
                <p style="color:#ffffff">{{$user['fname']}}  {{$user['lname']}}, Invited you to Create a AGENT Profile with the demo</p>
                <p style="margin-top:60px;margin-bottom: 40px;">
                   <a href="{{ url(env('demo_WEBSITE_URL')) }}" style="background-color: #64FECC; border:2px solid #64FECC; color: #0F24FD; border-radius: 3px; font-weight: bold; font-size: 15px; text-decoration: none; padding:12px 20px; box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; margin-right: 15px">Create a Profile</a>
                </p>
              @endif
            </td>
        </tr>
        <!-- Footer Section -->
        <tr>
            <td>
                <table cellspacing="0" cellpadding="0px" width="100%" style="background-color: rgb(0, 0, 0); color: rgb(100, 254, 204);">
                    <tr>
                        <td align="right" valign="middle" style="padding:20px 20px; font-size: 15px; font-weight: 500;">
                            Regards, demo Team
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
  </body>
</html>