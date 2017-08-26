<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>@yield('title')</title>

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<style>
    body {
        font-family: "Times New Roman", Times, serif;
    }

    input[type=radio   ]{
        margin-left:49%
    }
    input[type=text   ] {
        width: 400px;
    }
    th{
        text-align: center;
        vertical-align: middle
    }
    .inverse-dropdown{
        background-color: #222;
        border-color: #080808;
    &>li>a{
         color: #878a8a;
    &:hover{
         color: #fff;
         background-color: #000;
     }
    }
</style>