<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<body hoe-navigation-type="vertical" hoe-nav-placement="left" theme-layout="wide-layout">
    <div id="hoeapp-wrapper" class="hoe-hide-lpanel" hoe-device-type="desktop">
    @include('includes.navbar')
    <div id="hoeapp-container" hoe-color-type="lpanel-bg7" hoe-lpanel-effect="shrink">
    @include('includes.sidebar')
    <section id="main-content">
        @include('includes.warnhandler')
        <div class="space-30"></div>
            <div class="container">
            @yield('content')
            </div>
        </div>
    </section>
    </div>
    </div>
    @include('includes.scripts')
    @yield('scripts')
</body>
</html>