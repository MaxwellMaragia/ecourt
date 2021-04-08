<!DOCTYPE html>
<html lang="en">
<head>
    @include('super admin.layouts.head')
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
     @include('super admin.layouts.header')
     @include('super admin.layouts.sidebar')



     @section('main-content')
        @show

     @include('super admin.layouts.footer')
    </div>
</body>
</html>
