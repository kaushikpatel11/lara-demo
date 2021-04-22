<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>{{ $user['fname']." ".$user['lname']}} Profile Information</title>
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
  @php  $mapToKey = [
  "id" => "id",
  "fname" => "First Name",
  "lname" => "Last Name",
  "username" => "Username",
  "email" => "E-mail",
  "phone_number" => "Phone Number",
  "university" => "University",
  "temp_email" => "Temporary Email",
  "booker_type" => "Booker Type",
  "band" => "band",
  "stripes" => "stripe",
  'thumbnail' => 'thumbnail',
  'url' => 'Profile Picture URL',
  'name' => 'Band Name',
  'created_by' => 'user id',
  'last_4_digits' => 'Card last 4 digits',
  'exp_month' => 'Card expiry month',
  'exp_year' => 'Card expiry Year',
  'brand' => 'Payment Brand',
  'type' => 'Payment type',
  'bio' => 'bio',
  'state_id' => 'state',
  'photo' => 'photo',
  'header_photo' => 'cover photo',
  'state' => 'state',
  'title' => 'title'
  ];
  @endphp
  @isset ($user['photo']['url'])
 <div class="img-container">
    <img src="{{$user['photo']['url']}}" width="100">
  </div>
  @endisset
 
  <h2>User Information</h2>
  <li>First Name: {{$user['fname']}}</li>
  <li>Last Name: {{$user['lname']}}</li>
  <li>E-mail: {{$user['email']}}</li>
  <li>Phone Number: {{$user['phone_number']}}</li>
  <li>University: {{$user['university']}}</li>
  @if ($user['temp_email'])
  <li>Temporary Email: {{$user['temp_email']}}</li>
  @endif
  @if ($user['booker_type'] && count($user['booker_type']) > 0)
  <li>Booker Type: {{$user['booker_type']['type']}}</li>
  @endif
  @if ($stripe && count($stripe) > 0)
  <h2>User Payment Methods</h2>
  <table>
    <tr>
      <th>Last 4 digit</th>
      <th>Expiry month</th>
      <th>Expiry Year</th>
      <th>Brand</th>
      <th>Type</th>
      <th>Street</th>
      <th>City</th>
      <th>Zip Code</th>
      <th>State</th>
      <th>number</th>
      
      
      
    </tr>
    @foreach ($stripe as $result)
    <tr>
      <td>{{$result['last_4_digits']}}</td>
      <td>{{$result['exp_month']}}</td>
      <td>{{$result['exp_year']}}</td>
      <td>{{$result['brand']}}</td>
      <td>{{$result['type']}}</td>
      <td>{{$result['address']['street']}}</td>
      <td>{{$result['address']['city']}}</td>
      <td>{{$result['address']['zip']}}</td>
      <td>{{$result['address']['state']['title']}}</td>
      <td>{{$result['address']['number']}}</td>
      
    </tr>
    @endforeach
  </table>
  @endif
  
  @if ($bands && count($bands) > 0)
  <h2>User Bands</h2>
  <table>
    <tr>
      <th>Name</th>
      <th>Bio</th>
      <th>Photo</th>
      <th>Cover Photo</th>
      <th>State</th>
    </tr>
    @foreach ($bands as $result)
    <tr>
      <td>{{$result['name']}}</td>
      <td>{{$result['bio']}}</td>
      @isset ($result['photo']['thumbnail'])
      <td><img src="{{$result['photo']['thumbnail']}}" width="100" ></td>
      @endisset
      @isset ($result['header_photo']['thumbnail'])
      <td><img src="{{$result['photo']['thumbnail']}}" width="100" ></td>
      @endisset
      @isset ($result['state']['title'])
      <td>{{$result['state']['title']}}</td>
      @endisset
    </tr>
    @endforeach
  </table>
  @endif
  
</body>
</body>
</html>