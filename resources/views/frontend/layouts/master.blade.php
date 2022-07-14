<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <link href="{{asset('css/main.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
@yield('content')
<script src="{{asset('js/frontend.js')}}" defer></script>
<script>
    document.getElementById("footer-date").innerText = new Date().getFullYear();
</script>
</body>
