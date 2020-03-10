<meta charset="utf-8">
<title>
    {{ trans('quickadmin.quickadmin_title') }}
</title>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="dp-date" content="{{ config('app.date_format_moment') }}">
<meta name="dp-time" content="{{ config('app.time_format_moment') }}">
<meta name="dp-datetime" content="{{ config('app.datetime_format_moment') }}">
<meta name="app-locale" content="{{ App::getLocale() }}">

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

<!-- Font Awesome -->

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->


{{--<link rel="stylesheet" href="{{ url('adminlte/bootstrap/css/bootstrap.min.css') }}">--}}
{{--<link rel="stylesheet" href="{{ url('adminlte/css/AdminLTE.min.css') }}">--}}
{{--<link rel="stylesheet" href="{{ url('adminlte/css/custom.css') }}">--}}
{{--<link rel="stylesheet" href="{{ url('adminlte/css/skins/skin-blue.min.css') }}">--}}
<link rel="stylesheet" href="{{ mix('/client/css/app.css') }}">

{{--<script src="{{ URL::asset('cleanui/vendors/jquery/dist/jquery.min.js') }}" type="text/javascript" charset="utf-8"></script>--}}
