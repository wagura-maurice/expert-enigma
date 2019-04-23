<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Laravel Excel Import csv and XLS file in Database</title>

<!-- Styles -->
<link rel="stylesheet" href="{{ URL::to('css/app.css') }}">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
<style type="text/css">
*{padding:0;margin:0;}

html, body {
/*font-family:Verdana, Geneva, sans-serif;
background-color:#CCC;
font-size:12px;*/
background-color: #fff;
color: #636b6f;
font-family: 'Raleway', sans-serif;
font-weight: 100;
height: 100vh;
margin: 0;
padding: 5%
}

.label-container{
position:fixed;
bottom:48px;
right:105px;
display:table;
visibility: hidden;
}

.label-text{
color:#FFF;
background:rgba(51,51,51,0.5);
display:table-cell;
vertical-align:middle;
padding:10px;
border-radius:3px;
}

.label-arrow{
display:table-cell;
vertical-align:middle;
color:#333;
opacity:0.5;
}

.float{
position:fixed;
width:60px;
height:60px;
bottom:40px;
right:40px;
background-color:#3196d1;
color:#FFF;
border-radius:50px;
text-align:center;
box-shadow: 2px 2px 3px #999;
z-index:1000;
animation: bot-to-top 2s ease-out;
}

ul{
position:fixed;
right:40px;
padding-bottom:20px;
bottom:80px;
z-index:100;
}

ul li{
list-style:none;
margin-bottom:10px;
}

ul li a{
background-color:#3196d1;
color:#FFF;
border-radius:50px;
text-align:center;
box-shadow: 2px 2px 3px #999;
width:60px;
height:60px;
display:block;
}

ul:hover{
visibility:visible!important;
opacity:1!important;
}


.my-float{
font-size:24px;
margin-top:18px;
}

a#menu-share + ul{
visibility: hidden;
}

a#menu-share:hover + ul{
visibility: visible;
animation: scale-in 0.5s;
}

a#menu-share i{
animation: rotate-in 0.5s;
}

a#menu-share:hover > i{
animation: rotate-out 0.5s;
}

@keyframes bot-to-top {
0%   {bottom:-40px}
50%  {bottom:40px}
}

@keyframes scale-in {
from {transform: scale(0);opacity: 0;}
to {transform: scale(1);opacity: 1;}
}

@keyframes rotate-in {
from {transform: rotate(0deg);}
to {transform: rotate(360deg);}
}

@keyframes rotate-out {
from {transform: rotate(360deg);}
to {transform: rotate(0deg);}
}
</style>
</head>
<body>
<div class="container">

<h2 class="text-center">
Laravel Excel/CSV Import
</h2>

@if ( Session::has('success') )
<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
<span class="sr-only">Close</span>
</button>
<strong>{{ Session::get('success') }}</strong>
</div>
@endif

@if ( Session::has('error') )
<div class="alert alert-danger alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
<span class="sr-only">Close</span>
</button>
<strong>{{ Session::get('error') }}</strong>
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<div>
@foreach ($errors->all() as $error)
<p>{{ $error }}</p>
@endforeach
</div>
</div>
@endif

@yield('content')

<a href="#" class="float" id="menu-share">
<i class="fa fa-share my-float"></i>
</a>
<ul>
<li>
<a href="{{ route('maize') }}">
<i class="fa fa-tree my-float"></i>
</a>
</li>
<li>
<a href="{{ route('loans') }}">
<i class="fa fa-money my-float"></i>
</a>
</li>
<li>
<a href="{{ route('home') }}">
<i class="fa fa-home my-float"></i>
</a>
</li>
</ul>

</div>
</body>
</html>