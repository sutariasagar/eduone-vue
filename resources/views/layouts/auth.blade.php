<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.head')
</head>


<body class="cui-config-borderless cui-menu-left-toggled cui-menu-colorful cui-menu-left-shadow">
<div class="cui-initial-loading"></div>

<input type="hidden" id="exam_url" value="{{env('EXAM_URL')}}" />
<input type="hidden" id="main_app_url" value="{{env('MAIN_APP_EXAM_URL')}}" />
<div class="cui-login" style="background-image: url(/cleanui/components/pages/common/img/login/login.png)">

<div class="cui-login-header">
    <div class="row">
        <div class="col-lg-6">
            <div class="cui-login-header-logo">
                <a href="javascript: history.back();">
                    <img src="/cleanui/components/dummy-assets/common/img/logo.png" alt="EDU One">
                </a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="cui-login-header-menu">
                <ul class="list-unstyled list-inline">
                    <li class="list-inline-item active"><a href="/login">Login</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
        @yield('content')
</div>




</body>
</html>
