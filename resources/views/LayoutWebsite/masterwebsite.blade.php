<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="icon" type="image/png" href="{{asset('Influencer/images/image_2025_02_05T09_48_41_117Z.png')}}">
</head>
<body>
    @include('PartialWebsite.csswebsite')
    @yield('content')
    @include('PartialWebsite.jswebsite')
    @if(session('success'))
 <script>
  var message ="{{session('success')}}";
 toastr.success(message);</script>
@endif
@if(session('error'))
 <script>
  var message ="{{session('error')}}";
 toastr.error();(message);</script>
@endif
</body>
</html>