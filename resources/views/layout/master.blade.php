<!DOCTYPE html>
<html lang="en">
@include('layout.components.head')
<body>
<!-- page-wrapper Start-->
<div class="page-wrapper">
  @include('layout.components.header')
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <div class="page-body">
            @include('custom-components.alert.success')
            @include('custom-components.alert.error')

            <!-- Container-fluid starts-->
            @yield('content')
            <!-- Container-fluid Ends-->
        </div>
    </div>
</div>

@include('layout.components.scripts')
</body>
</html>
