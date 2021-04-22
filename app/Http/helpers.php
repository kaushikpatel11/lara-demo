<?php
use App\EventHistory;
use LaravelFCM\Message\OptionsBuilder;
use LaravelFCM\Message\PayloadDataBuilder;
use LaravelFCM\Message\PayloadNotificationBuilder;
use App\Mail\ApprovalMail;
use App\Mail\ApprovalBookerMail;
use Twilio\Rest\Client;
use Twilio\Jwt\ClientToken;
use App\LinkAgentBand;
use App\State;


if (!function_exists('curlRequest')) {
  /**
   * Create a curl Request.
   *
   * @param  string $url
   * @param  array $headers
   * @param  string $method
   * @param  string $body
   * @return mixed|\Illuminate\Foundation\Application
   */
  function curlRequest($url, $headers, $method, $body) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    if ($method == "POST") {
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    } elseif ($method == "PUT") {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    } elseif ($method == "DELETE") {
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    }
    $output = curl_exec($ch);
    if ($output === false) {
      errorLog("request " . $url . ": ", array('error' => curl_error($ch), 'body' => $body));
      http_response_code(400);
      print '<div class="alert alert-danger" role="alert">Something went wrong</div>';
      die();
    } else {
      errorLog("request " . $url . ": ", array('body' => $body, 'output' => $output));
    }
    curl_close($ch);
    return $output;
  }
}

if (!function_exists('errorLog')) {
  /**
   * Log error.
   *
   * @param  string $label
   * @param  array $error
   * @return mixed|\Illuminate\Foundation\Application
   */

  function errorLog($label, $error = array()) {
    //$error['server'] = $_SERVER;
    if (is_array($error) || is_object($error)) {
      $error = json_encode($error);
    }
    error_log('[FNB-GCS][' . date('Y-m-d H:i:s') . ']: ' . $label . $error . '


  ');
  }
}
if (!function_exists('buildMultiPartBody')) {
  /**
   * PHP's curl extension won't let you pass in strings as multipart file upload bodies; you
   * have to direct it at an existing file (either with deprecated @ syntax or the CURLFile
   * type). You can use php://temp to get around this for one file, but if you want to upload
   * multiple files then you've got a bit more work.
   *
   * This function manually constructs the multipart request body from strings and injects it
   * into the supplied curl handle, with no need to touch the file system.
   *
   * @param $delimiter string a unique string to use for the each multipart boundary
   * @param $fields string[] fields to be sent as fields rather than files, as key-value pairs
   * @param $files string[] fields to be sent as files, as key-value pairs
   * @return string the form data
   * @see http://stackoverflow.com/a/3086055/2476827 was what I used as the basis for this
   **/

  function buildMultiPartBody($delimiter, $fields, $files) {
    $data = '';

    foreach ($fields as $name => $content) {
      $data .= "--" . $delimiter . "\r\n"
        . 'Content-Disposition: form-data; name="' . $name . "\"\r\n\r\n"
        . $content . "\r\n";
    }

    foreach ($files as $name => $content) {
      $data .= "--" . $delimiter . "\r\n"
        . 'Content-Disposition: form-data; name="' . $name . '"; filename="' . $content['fileName'] . '"' . "\r\n\r\n"
        . $content['fileContent'] . "\r\n";
    }

    $data .= "--" . $delimiter . "--\r\n";

    return $data;
  }
}

if (!function_exists('convertDateFormat')) {

  function convertDateFormat($dateString, $withTimeZone) {
    if ($withTimeZone) {
      $formattedDate = str_replace("000Z", "Z", date_format(date_create($dateString), "Y-m-d\TH:i:s.u\Z"));
    } else {
      $formattedDate = date_format(date_create($dateString), "Y-m-d H:i:s");
    }

    return $formattedDate;
  }
}

if (!function_exists('cbcEncryptDecryptJSON')) {
  /**
   * Encrypt/Decrypt text/JSON using AES 256 CBC encryption.
   *
   * @param  string $text
   * @param  boolean $encrypt
   * @return string
   */
  function cbcEncryptDecryptJSON($text, $encrypt = true) {
    $key = env("ENCRYPTION_KEY");
    $iv = env("ENCRYPTION_IV");
    $cipher = "aes-256-cbc";
    if ($encrypt) {
      $finalText = openssl_encrypt($text, $cipher, $key, $options = 0, $iv);
    } else {
      $finalText = openssl_decrypt($text, $cipher, $key, $options = 0, $iv);
    }
    return $finalText;
  }
}

function UpdateHistory($date, $title, $value, $notes, $eventId, $userId, $requestId, $role) {
  try {
    $history = new EventHistory;
    $history->action = $title;
    $history->date = $date;
    $history->notes = $notes;
    $history->createdBy()->associate($userId);
    $history->event()->associate($eventId);
    $history->request()->associate($requestId);
    $history->role = $role;
    $history->value = $value;
    $history->save();
    return true;
  } catch (\Exception $e) {
    return false;
  }
}

function sendNotification($body, $title, $token, $message) {
  $optionBuilder = new OptionsBuilder();
  $optionBuilder->setTimeToLive(2419200); //Set time the message is stored in Firebase (4 Weeks)
  
  $notificationBuilder = new PayloadNotificationBuilder();
  $notificationBuilder->setBody($body)
    ->setTitle($title)
    ->setSound('default');

  $dataBuilder = new PayloadDataBuilder();
  $dataBuilder->addData($message);

  $option = $optionBuilder->build();
  $notification = $notificationBuilder->build();
  $data = $dataBuilder->build();
  if (!empty($token)) {
    $downstreamResponse = FCM::sendTo($token, $option, $notification, $data);
    $downstreamResponse->numberSuccess();
    $downstreamResponse->numberFailure();
    $downstreamResponse->numberModification();
    return true;
  } else {
    return false;
  }

}

function GetUserGeneralNotificationType($user, $talentEmail, $bookerEmail, $userRole, $body, $type, $bookerPushToken, $talentPushToken, $id) {
  $userNotificationType = $user->notification->where("name", "GENERAL")->pluck("type")->toArray();
  foreach ($userNotificationType as $notificationType) {
    switch ($notificationType) {
    case "EMAIL":
      sendRequestEmail($talentEmail, $bookerEmail, $userRole, $body, $type);
      break;
    case "SMS":
      sendRequestSms($user->phone_number, $user->phone_number, $type, $userRole, $id);
      break;
    case "PUSH":
      sendRequestNotification($bookerPushToken, $talentPushToken, $type, $userRole, $id);
      break;
    default:
      return response()->formatted(400, "INVALID", "request", Log::error($e), "error");
    }
  }
}

function sendRequestEmail($talentEmail, $bookerEmail, $userRole, $body, $type) {
  switch ($type) {
  case 'APPROVAL':
    if ($userRole == "TALENT") {
      \Mail::to($talentEmail)->send(new ApprovalMail($body));
    } else if ($userRole == "BOOKER") {
      \Mail::to($bookerEmail)->send(new ApprovalBookerMail($body));
    }
    break;
  default:
    return response()->formatted(400, "INVALID", "request", Log::error($e), "error");
  }
}

function sendRequestNotification($bookerPushToken, $talentPushToken, $type, $userRole, $id) {
  switch ($type) {
  case 'APPROVAL':
    if ($userRole == "TALENT") {
      sendNotification('Your profile is approved by the admin. ', null, $talentPushToken, ['type' => 'PROFILE_APPROVED', 'id' => $id]);
    } else if ($userRole == "BOOKER") {
      sendNotification('Your profile is approved. You can now Create an event and request bands to perform. ', null, $bookerPushToken, ['type' => 'BOOKER_APPROVED', 'id' => $id]);
    }
    break;
  default:
    return response()->formatted(400, "INVALID", "request", Log::error($e), "error");
  }
}

function sendRequestSms($bookerPhoneNumber, $talentPhoneNumber, $type, $userRole, $id) {
  switch ($type) {
  case 'APPROVAL':
    if ($userRole == "TALENT") {
      sendSms([$talentPhoneNumber], 'Your profile is approved by the admin. ');
    } else if ($userRole == "BOOKER") {
      sendSms([$bookerPhoneNumber], 'Your profile is approved. You can now Create an event and request bands to perform. ');
    }
    break;
  default:
    return response()->formatted(400, "INVALID", "request", Log::error($e), "error");
  }
}

function sendSms($numbers, $body) {
  $accountSid = env('TWILIO_ACCOUNT_SID');
  $authToken = env('TWILIO_AUTH_TOKEN');
  $client = new Client($accountSid, $authToken);
  if (!empty($numbers)) {
    try {
      foreach ($numbers as $number) {
        if ($number !== null) {
          try {
            $message = $client->messages->create(
              $number,
              array(
                'from' => env('TWILIO_FROM_NUMBER'),
                'body' => $body,
              )
            );
            $status = $message->status;
            if ($status === "undelivered" || $status === "failed") {
              Log::info('SMS not sent to .' . $number);
            } else {
              Log::info('SMS sent successfully to .' . $number);
            }
          } catch (\Exception $e) {
            Log::info('SMS not sent to .' . $number);
            Log::error('Error is.' . $e);
          }
        }
      }
      return response()->formatted(201, "SMS_SENT", "notification", 'Sent successfully.', "item");
    } catch (\Exception $e) {
      return response()->formatted(500, "INVALID", "notification", Log::error($e), "error");
    }
  }
}


if (!function_exists('check_band_have_agent')) {

    function check_band_have_agent($bandId){

      $link=LinkAgentBand::select('id')
      ->where(['band_id'=>$bandId])
      ->where(function($query){
        $query->where('request_status','ACCEPTED_BY_TALENT')
        ->orwhere('request_status','ACCEPTED_BY_AGENT'); 
      })
      ->first();  

      if(empty($link)){
        return FALSE;
      }else{
        return TRUE;
      }

    }
}   

if (!function_exists('currency_abbreviation_convert')) {
  function currency_abbreviation_convert($currency){

    $num=$currency;
    if($num>=1000) {
        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('K', 'M', 'B', 'T');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        return $x_display;
    }

    return $num;

  }

  if(!function_exists('generate_array_for_request_widget_agent')){

    function generate_array_for_request_widget_agent($key_wise){

      //add status for display 0 record when status is not available   
      if(!array_key_exists('CANCELED_BY_TALENT',$key_wise)){
        $key_wise['CANCELED_BY_TALENT']=(object)['status' => 'CANCELED_BY_TALENT','total' => 0,'total_budget' => 0];            
      }
      
      if(!array_key_exists('OPEN',$key_wise)){
        $key_wise['OPEN']=(object)['status' => 'OPEN','total' => 0,'total_budget' => 0];            
      }

      if(!array_key_exists('ACCEPTED_BY_TALENT',$key_wise)){
        $key_wise['ACCEPTED_BY_TALENT']=(object)['status' => 'ACCEPTED_BY_TALENT','total' => 0,'total_budget' => 0];            
      }        

      if(!array_key_exists('CANCELED_BY_BOOKER',$key_wise)){
        $key_wise['CANCELED_BY_BOOKER']=(object)['status' => 'CANCELED_BY_BOOKER','total' => 0,'total_budget' => 0];            
      }

      
      if(!array_key_exists('PENDING_DEPOSIT',$key_wise)){
        $key_wise['PENDING_DEPOSIT']=(object)['status' => 'PENDING_DEPOSIT','total' => 0,'total_budget' => 0];            
      }

      if(!array_key_exists('PENDING_REMAINDER',$key_wise)){
        $key_wise['PENDING_REMAINDER']=(object)['status' => 'PENDING_REMAINDER','total' => 0,'total_budget' => 0];            
      }
      

      if(!array_key_exists('APPROVED',$key_wise)){
        $key_wise['APPROVED']=(object)['status' => 'APPROVED','total' => 0,'total_budget' => 0];            
      }

      if(!array_key_exists('REJECTED_BY_TALENT',$key_wise)){
        $key_wise['REJECTED_BY_TALENT']=(object)['status' => 'REJECTED_BY_TALENT','total' => 0,'total_budget' => 0];            
      }

      if(!array_key_exists('COMPLETED',$key_wise)){
        $key_wise['COMPLETED']=(object)['status' => 'COMPLETED','total' => 0,'total_budget' => 0];            
      }
      
      if(!array_key_exists('PENDING_FULL_PAYMENT',$key_wise)){
        $key_wise['PENDING_FULL_PAYMENT']=(object)['status' => 'PENDING_FULL_PAYMENT','total' => 0,'total_budget' => 0];            
      }

      //return $key_wise;

      //for merge two values  PENDING_REMAINDER &  PENDING_DEPOSIT
      $pending_marge_array=array(
        'status' => 'PENDING_DEPOSIT',
        'total' => 0,
        'total_budget' => 0
      );

      $pending_marge_status=false;
      $all_events_modified=array();
      

      foreach($key_wise as $key => $key_wise_single){           
            switch ($key) {
              case "OPEN":                    
                $all_events_modified[0]=$key_wise_single;
                break;

              case "PENDING_REMAINDER":                                  
                $pending_marge_status=true;
                $pending_marge_array['total']=   $pending_marge_array['total']+$key_wise_single->total;
                $pending_marge_array['total_budget']=   $pending_marge_array['total_budget']+$key_wise_single->total_budget;
                break;
              case "PENDING_DEPOSIT":                    
                $pending_marge_status=true;
                $pending_marge_array['total']=   $pending_marge_array['total']+$key_wise_single->total;
                $pending_marge_array['total_budget']=   $pending_marge_array['total_budget']+$key_wise_single->total_budget;
                break;

              case "PENDING_FULL_PAYMENT":              
                $all_events_modified[4]=$key_wise_single;
                break;  

              case "ACCEPTED_BY_TALENT":              
                $all_events_modified[1]=$key_wise_single;
                break;                 
            
              case "APPROVED":              
                $all_events_modified[5]=$key_wise_single;
                break;
              case "COMPLETED":              
                $all_events_modified[6]=$key_wise_single;
                break;
              case "REJECTED_BY_TALENT":              
                $all_events_modified[7]=$key_wise_single;
                break;
              case "CANCELED_BY_BOOKER":         
                $all_events_modified[8]=$key_wise_single;
                break;
              case "CANCELED_BY_TALENT":                     
                $all_events_modified[9]=$key_wise_single;
                break;                  
            } 
      }

      if($pending_marge_status){ //add merge array
        $all_events_modified[3]=(object)$pending_marge_array;
      }      

      ksort($all_events_modified);//sort array by array position       
      
      return $all_events_modified;
    }

  }


  if(!function_exists('create_connect_account_in_stripe')){
    function create_connect_account_in_stripe($request,$accounttoken,$talent_user){  
          $stateID = $request['state.id'];
          $state = State::where('id', $stateID)->first();
          $state_abbreviation_code = $state->abbreviation_code;                   

          $url = 'https://api.stripe.com/v1/accounts'; 
          $headers = array(
            'Content-Type: application/x-www-form-urlencoded',
            'Authorization: Bearer ' . env('STRIPE_SECRET')
          );
          $method = 'POST';            
          $body = http_build_query(
            [          
              "type" => 'custom',
              "country" => 'US',
              "email" =>$talent_user->email,          
              "business_type"=> "individual",
              "external_account" =>$accounttoken,
              "default_currency" =>"usd",             
              "company" => [
                  // 'address' => [
                  //   'city' =>$request['city'],
                  //   'country' =>"US",
                  //   'line1' => $request['street'],
                  //   'line2' => "",
                  //   'postal_code' => $request['zip'],                  
                  //   'state' => $state_abbreviation_code,
                  // ],
                  'phone' =>$talent_user->phone_number
              ],
              
              "capabilities" => [
                        //"card_payments" => ["requested" => "true"],
                        "transfers" => ["requested" => "true"]
              ],    
              
              "tos_acceptance" => [
                "service_agreement" => "full",                
                "date" =>time(),
                "ip" => "122.179.134.148"
              ],

              "individual" => [
                    // 'dob' => [
                    //   'day' => $request['dob_day'],
                    //   'month' => $request['dob_month'],
                    //   'year' => $request['dob_year']
                    // ],
                    'email' =>$talent_user->email,                
                    "first_name" =>$talent_user->fname,
                    "last_name" => $talent_user->lname,
                    //"gender" => $request['gender'],
                    "phone" => $talent_user->phone_number,                    
                    //"id_number" => $request['id_number'],
              ],


            ]                               
          );
          return  curlRequest($url, $headers, $method, $body);
      }
  }  


  if(!function_exists('create_bank_connect_account_token')){
    function create_bank_connect_account_token($body){
        $url="https://api.stripe.com/v1/tokens";
        $headers = array(
          'Content-Type: application/x-www-form-urlencoded', 
          'Authorization: Bearer ' . env('STRIPE_SECRET')
          
        ); 
        $method="POST";      
      return curlRequest($url, $headers, $method, $body);   
    } 
  }
  
  if(!function_exists('transfer_to_stipe_connected_bank_account')){
      function transfer_to_stipe_connected_bank_account($body){    
          $url="https://api.stripe.com/v1/transfers";
          $headers = array(
            'Content-Type: application/x-www-form-urlencoded',         
            'Authorization: Bearer ' . env('STRIPE_SECRET')
          ); 
          $method="POST";        
          return  curlRequest($url, $headers, $method, $body);
      }
  }

  if(!function_exists('stripe_accept_terms_of_service')){
      function stripe_accept_terms_of_service(){
        $url="https://api.stripe.com/v1/accounts/acct_1IWalJQXwhP8A4nd";
          $headers = array(
            'Content-Type: application/x-www-form-urlencoded',         
            'Authorization: Bearer ' . env('STRIPE_SECRET')
          );
          $method="post";
          $body = http_build_query(
            [
              "tos_acceptance" => [
                    "service_agreement" => "recipient",                
                    "date" =>time(),
                    "ip" => "122.179.134.148"
              ]                                
            ]            
          );
          echo  curlRequest($url, $headers, $method, $body);
      }
  }

}