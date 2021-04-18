<!DOCTYPE html>
<html lang="en">
<head>
    @include('prosecutor.layouts.head')
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
     @include('prosecutor.layouts.header')
     @include('prosecutor.layouts.sidebar')



     @section('main-content')
        @show

     @include('prosecutor.layouts.footer')
    </div>
</body>
</html>
