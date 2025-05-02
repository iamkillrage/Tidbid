<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification Mail</title>
</head>
<body>
    <h1>Verification Mail</h1>
    <span>Hi</span>
    <span><div>Your verification code - <h3>{{isset($mailData['otp'])?$mailData['otp']:''}}</h3></div></span>
</body>
</html>