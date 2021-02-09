<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <title>Sign in & Sign up Form</title>
</head>

<body>
  <div id="wellcome">
    <home-component :is_sigup="{{json_encode(true)}}"></home-component>
  </div>
</body>