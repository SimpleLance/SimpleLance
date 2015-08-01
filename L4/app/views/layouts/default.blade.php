<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')SimpleLance</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/jquery-ui.theme.css" rel="stylesheet">
    <link href="/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/datepicker3.css"/>
    @yield('head')
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">{{ Config::get('simplelance.site_name')}}</a>
        </div>
        @if (Sentry::check())
            <ul class="nav navbar-top-links navbar-right">
                Hello {{ Sentry::getUser()->username }}!
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu">
                        <li>
                            <a href="/users/{{ Sentry::getUser()->id }}"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        @else
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a href="/login">Log In</a>
                </li>
            </ul>
        @endif
        <div class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    @if (Sentry::check())
                        @if (Sentry::inGroup(Sentry::findGroupByName('Admins')))
                            <!-- Admin Menu -->
                            @include('layouts.menus.admin')
                            <!-- /admin menu -->
                        @endif
                        @if (Sentry::inGroup(Sentry::findGroupByName('Users')) && !Sentry::inGroup(Sentry::findGroupByName('Admins')))
                            <!-- customer menu -->
                            @include('layouts.menus.user')
                            <!-- /customer menu -->
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    <div id="page-wrapper">
        <!-- Notifications -->
        @include('Sentinel::layouts/notifications')
        <!-- ./ notifications -->

        @yield('content')
    </div>
</div>
<script src="/js/jquery-2.1.3.min.js"></script>
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/metisMenu.min.js"></script>
<script src="/js/scripts.js"></script>
<script src="/js/bootstrap-datepicker.js"></script>
@yield('footer')
</body>
</html>