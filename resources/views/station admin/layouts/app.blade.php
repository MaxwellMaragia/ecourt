<!DOCTYPE html>
<html lang="en">
<head>
    @include('station admin.layouts.head')
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
     @include('station admin.layouts.header')
     @include('station admin.layouts.sidebar')



     @section('main-content')
        @show

     @include('station admin.layouts.footer')
    </div>
</body>
</html>
