<!DOCTYPE html>
<html lang="en">
<head>
    @include('court admin.layouts.head')
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
     @include('court admin.layouts.header')
     @include('court admin.layouts.sidebar')



     @section('main-content')
        @show

     @include('court admin.layouts.footer')
    </div>
</body>
</html>
