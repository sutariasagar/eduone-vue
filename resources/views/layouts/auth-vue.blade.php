<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>


<body class="cui-config-borderless cui-menu-left-toggled cui-menu-colorful cui-menu-left-shadow">
<div class="cui-initial-loading"></div>
<input type="hidden" id="exam_url" value="{{env('EXAM_URL')}}" />
<input type="hidden" id="main_app_url" value="{{env('MIX_MAIN_APP_URL')}}" />
<div id="app">

</div>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}

@include('partials.javascripts')
</body>
</html>
