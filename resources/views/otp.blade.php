<!DOCTYPE HTML>
<html lang="en" >
<html>
<head>
  <title>Verify OTP</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <link rel="stylesheet" href="{{ URL::asset('styles/login.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>  
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'> 
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="body">

<div class="otp-page login-page">

  <div class="form">
    @foreach ($users as $user )
    <h1>Hello {{ $user->name }}</h1>
    <h1>{{  $user->phone }}</h1>
    @endforeach
    
    <form action="/verify/process" method="POST">
      @csrf
      
      <lottie-player src="https://assets4.lottiefiles.com/datafiles/XRVoUu3IX4sGWtiC3MPpFnJvZNq7lVWDCa8LSqgS/profile.json"  background="transparent"  speed="1"  style="justify-content: center;" loop  autoplay></lottie-player>
      <input type="text" name="otp" placeholder="&#xf007;  Input OTP"/>
      <br>
      <br>
      <button type="submit">Verify</button>
      <p class="message"></p>
    </form>

    <form class="login-form">
      <button type="button" onclick="window.location.href='{{ url('/login') }}'">Login Ulang</button>
    </form>
  </div>
</div>
@include('sweetalert::alert')
</body>
</html>